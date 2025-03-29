@extends('layouts.adminshow')
@section('title','Product Management Viewer | iREX Admin')

@section('content')
    <h5 class="card-title"><strong>{{ $product->RSkuNo }}</strong></h5>
    <p><strong>SKU Key Code:</strong> {{ $product->RSkuKey }}</p>
    <p><strong>SKU Key No:</strong> {{ $product->RSkuNo }}</p>
    <p><strong>Item Full Name:</strong> {{ $product->RSkuName1 }}</p>
    <p><strong>Item Code Name:</strong> {{ $product->RSkuName2 }}</p>
    <p><strong>Item Product Name:</strong> {{ $product->RSkuPrName }}</p>
    <p><strong>Item Brand Name:</strong> {{ $product->RSkuBrnName }}</p>
    <p><strong>Item Type:</strong> {{ $product->RSkuType }}</p>
    <p><strong>Unit of Measurement:</strong> {{ $product->RUom }}</p>
    <p><strong>Price per Unit:</strong> RM {{ $product->RSkuPrice }}</p>
    <p><strong>Minimum Purchase Quantity:</strong> {{ $product->RSkuMoq }}</p>
    <p><strong>Quantity on Hand Available:</strong> {{ $product->RQoh }}</p>
    <div class="mb-3">
        <p><strong>Tags:</strong>
            @php
                $tags = $product->RSkuTags;
            @endphp
            @if(!empty($tags))
                @foreach($tags as $tag)
                    <span class="badge bg-info text-white">{{ $tag }}</span>
                @endforeach
            @else
                <p>No tags available.</p>
            @endif
        </p>
    </div>

    <hr class="table-group-divider">
    <div class="mb-3">
        <p><strong>Extra Attributes</strong></p>
        @php
            $attributes = $product->RSkuAttributes;
        @endphp
        @empty($attributes)
            <p>No additional attributes available for this item.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Additional Attributes</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $key => $value)
                            @if(is_array($value))
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $key }}</strong></td>
                                    <td>{{implode(', ', $value)}}</td>
                                </tr>
                            @else
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><strong>{{ $key }}</strong></td>
                                    <td>{{$value}}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endempty
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Return</a>
    </div>
@endsection
