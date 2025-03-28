@extends('layouts.kbtables')
@section('title', 'Products Manager | iREX Admin')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('product.create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus"></i> New Product
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            @empty($products)
                <tbody>Product List is empty.</tbody>
            @else
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RSkuKey</th>
                        <th>RSkuNo</th>
                        <th>RSkuName1</th>
                        <th>RUom</th>
                        <th>RSkuPrName</th>
                        <th>RSkuBrnName</th>
                        <th>RSkuPrice</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$product->RSkuKey}}</td>
                        <td>{{$product->RSkuNo}}</td>
                        <td>{{$product->RSkuName1}}</td>
                        <td>{{$product->RUom}}</td>
                        <td>{{$product->RSkuPrName}}</td>
                        <td>{{$product->RSkuBrnName}}</td>
                        <td>{{$product->RSkuPrice}}</td>
                        <td>
                            <a href="{{ route('product.show', $product->RSkuKey) }}" class="btn btn-sm btn-info mb-1">
                                <i class="bi bi-view-list"></i> View</a>
                            <a href="{{ route('product.edit', $product->RSkuKey) }}" class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-pencil"></i> Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $product->RSkuKey }}">
                                <i class="bi bi-trash"></i> Delete </button>
                        </td>
                    </tr>
                @endforeach
                <p>Note that redundant columns are not shown, only the best one is shown.</p>
                </tbody>
            @endempty
        </table>
    </div>
@endsection

<!-- Include the Delete Modal -->
@foreach ($products as $prod)
    @include('product.deleter', ['prod'=> $prod])
@endforeach
