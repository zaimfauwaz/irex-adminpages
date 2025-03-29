<?php

namespace App\Http\Controllers;

use App\Models\FaqList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\OpenAI\TaggerService;

class FaqController extends Controller
{

    protected $taggerService;
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->taggerService = new TaggerService();
        if (!Auth::check() || !Auth::user()->is_admin) {
            abort(403, 'Unauthorized access');
        }
    }

    public function index()
    {
        $faqlists = FaqList::orderBy('faq_id', 'asc')->paginate(10);
        return view('faqlist.index', compact('faqlists'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('faqlist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $faqlist = FaqList::create([
            'faq_question' => $request->question,
            'faq_answer' => $request->answer,
            'faq_category' => $request->category,
            'faq_status' => $request->status,
        ]);
        return redirect()->route('faqlist.index')->with('success', 'Faq Information created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($faq_id)
    {
        $faqlist = FaqList::findOrFail($faq_id);
        return view('faqlist.show', compact('faqlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FaqList $faqlist)
    {
        return view('faqlist.edit', compact('faqlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $faq_id)
    {
        $faq = FaqList::where('faq_id', $faq_id)->firstOrFail();

        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'status' => 'required|boolean',
        ]);

        $faq->update([
            'faq_question' => $request->question,
            'faq_answer' => $request->answer,
            'faq_category' => $request->category,
            'faq_status' => $request->status,
        ]);

        return redirect()->route('faqlist.index')->with('success', 'Faq Information modified successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FaqList $faqlist)
    {
        $faqlist->delete();
        return redirect()->route('faqlist.index');
    }


}
