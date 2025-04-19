@extends('layouts.kbtables')
@section('title', 'FAQ Manager | iREX Admin')


@section('content')
    <div class="d-flex justify-content-end mb-3">
{{--        {{ route('faqlist.masscreate') }}--}}
{{--        <a href="{{ route('faqlist.uploadform') }}" class="btn btn-sm btn-info mx-2">--}}
{{--            <i class="bi bi-stars"></i> Upload Dataset--}}
{{--        </a>--}}
        <a href="{{ route('faqlist.create') }}" class="btn btn-sm btn-success">
            <i class="bi bi-plus"></i> New FAQ List
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered">
            @empty($faqlists)
                <tbody>No FAQ is saved.</tbody>
            @else
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="max-width: 250px;">Questions</th>
                        <th style="max-width: 300px;">Answers</th>
                        <th>Category</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($faqlists as $faqlist)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td style="max-width: 250px;">{{$faqlist->faq_question}}</td>
                        <td style="max-width: 300px;">{{$faqlist->faq_answer}}</td>
                        <td>{{$faqlist->faq_category}}</td>
                        <td>
                            @if($faqlist->faq_status==1)
                                <span class="badge bg-success text-white">Active</span>
                            @elseif($faqlist->faq_status==0)
                                <span class="badge bg-danger text-white">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('faqlist.show', $faqlist->faq_id)}}" class="btn btn-sm btn-info mb-1">
                                <i class="bi bi-view-list"></i> View</a>
                            <a href="{{route('faqlist.edit', $faqlist->faq_id)}}" class="btn btn-sm btn-warning mb-1">
                                <i class="bi bi-pencil"></i> Edit</a>
                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal-{{$faqlist->faq_id}}">
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
@foreach ($faqlists as $faq)
    @include('faqlist.deleter', ['faq'=> $faq])
@endforeach
