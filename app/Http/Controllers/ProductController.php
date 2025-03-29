<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
    }

    public function index()
    {
        $products = Product::orderBy('RSkuNo', 'asc')->paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentSku = Product::generateRSkuKey();
        return view('product.create', compact('currentSku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'RSkuKey'        => 'numeric|min:1|max:18446744073709551615', // BIGINT UNSIGNED
            'RSkuNo'         => 'string|max:31',  // VARCHAR(31)
            'RUom'           => 'string|max:7',   // VARCHAR(7)
            'RSkuName1'      => 'string|max:255', // VARCHAR(255)
            'RSkuName2'      => 'string|max:31',  // VARCHAR(31)
            'RSkuMoq'        => 'integer|min:1',  // INT
            'RSkuPr'         => 'string|max:127', // VARCHAR(127)
            'RSkuPrName'     => 'string|max:127', // VARCHAR(127)
            'RSkuBrn'        => 'string|max:127', // VARCHAR(127)
            'RSkuBrnName'    => 'string|max:127', // VARCHAR(127)
            'RSkuPrice'      => 'numeric|min:0',  // DOUBLE
            'RQoh'           => 'integer|min:0',  // INT = 0 (Assumed default)
            'RSkuType'       => 'string|max:63',  // VARCHAR(63)

            // For custom attributes only
            // Key - validation must be strict
            'custom_attributes.key.*' => [
                'required',
                'string',
                'max:63',
                'regex:/^(?![0-9])[\w]+$/',
                'not_regex:/\s/',
                'not_regex:/[^A-Za-z0-9_]/',
            ],
            'custom_attributes.value.*' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[\x00-\x1F\x7F]/',
                'not_regex:/["\\\\]/'
            ]
        ]);

        $keys = $request->input('custom_attributes.key');
        $values = $request->input('custom_attributes.value');

        $attributes = $this->getCustomAttributes($keys, $values);

        Product::create([
            'RSkuKey'=> $request->RSkuKey,
            'RSkuNo'=> $request->RSkuNo,
            'RUom'=>$request->RUom,
            'RSkuName1'=>$request->RSkuName1,
            'RSkuName2'=>$request->RSkuName2,
            'RSkuMoq'=>$request->RSkuMoq,
            'RSkuPr'=>$request->RSkuPrName,
            'RSkuPrName'=>$request->RSkuPrName,
            'RSkuBrn'=>$request->RSkuBrnName,
            'RSkuBrnName'=>$request->RSkuBrnName,
            'RSkuPrice'=>$request->RSkuPrice,
            'RQoh'=>$request->RQoh,
            'RSkuType'=>$request->RSkuType,
            'RSkuAttributes'=>$attributes,
        ]);
        return redirect()->route('product.index')->with('success', 'Product added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($sku_key)
    {
        $product = Product::findOrFail($sku_key);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $sku_key)
    {
        $product = Product::where('RSkuKey', $sku_key)->firstOrFail();

        $request->validate([
            'RSkuNo'         => 'string|max:31',
            'RUom'           => 'string|max:7',
            'RSkuName1'      => 'string|max:255',
            'RSkuName2'      => 'string|max:31',
            'RSkuMoq'        => 'integer|min:1',
            'RSkuPr'         => 'string|max:127',
            'RSkuPrName'     => 'string|max:127',
            'RSkuBrn'        => 'string|max:127',
            'RSkuBrnName'    => 'string|max:127',
            'RSkuPrice'      => 'numeric|min:0',
            'RQoh'           => 'integer|min:0',
            'RSkuType'       => 'string|max:63',

            // For custom attributes only
            // Key - validation must be strict
            'custom_attributes.key.*' => [
                'required',
                'string',
                'max:63',
                'regex:/^(?![0-9])[\w]+$/',
                'not_regex:/\s/',
                'not_regex:/[^A-Za-z0-9_]/',
            ],
            'custom_attributes.value.*' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[\x00-\x1F\x7F]/',
                'not_regex:/["\\\\]/'
            ]
        ]);

        $keys = $request->input('custom_attributes.key');
        $values = $request->input('custom_attributes.value');
        $attributes = $this->getCustomAttributes($keys, $values);

        $product->update([
            'RSkuNo'=> $request->RSkuNo,
            'RUom'=>$request->RUom,
            'RSkuName1'=>$request->RSkuName1,
            'RSkuName2'=>$request->RSkuName2,
            'RSkuMoq'=>$request->RSkuMoq,
            'RSkuPr'=>$request->RSkuPrName,
            'RSkuPrName'=>$request->RSkuPrName,
            'RSkuBrn'=>$request->RSkuBrnName,
            'RSkuBrnName'=>$request->RSkuBrnName,
            'RSkuPrice'=>$request->RSkuPrice,
            'RQoh'=>$request->RQoh,
            'RSkuType'=>$request->RSkuType,
            'RSkuAttributes'=>$attributes,
        ]);

        return redirect()->route('product.index')->with('success', 'Product modified successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }

    private function getCustomAttributes($keys, $values):array{
        $attributes = [];

        // Duplication checks - if the custom attributes are set duplicate with different values, these values will be merged into an array (under one custom attribute family).
        foreach ($keys as $index=>$key) {
            if (!isset($attributes[$key])) {
                $attributes[$key] = $values[$index];
            } else {
                if (!is_array($attributes[$key])) {
                    $attributes[$key] = [$attributes[$key]];
                }
                $attributes[$key][] = $values[$index];
            }
        }
        return $attributes;
    }
}
