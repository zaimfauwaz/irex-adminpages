@extends('layouts.adminshow')
@section('title','FAQ Management Viewer | iREX Admin')

@section('content')
    <h5 class="card-title"><strong>FAQ No #{{ $faqlist->faq_id }}</strong></h5>
    <p><strong>Question:</strong> {{ $faqlist->faq_question }}</p>
    <p><strong>Answer:</strong> {{ $faqlist->faq_answer }}</p>
    <p><strong>Category:</strong> {{ $faqlist->faq_category }}</p>
    <p><strong>Created:</strong> {{$faqlist->created_at}}</p>
    <p><strong>Last Modified:</strong> {{$faqlist->updated_at}}</p>
    <p><strong>Status: </strong></p>
    @if($faqlist->faq_status==1)
        <span class="badge bg-success text-white">Active</span>
    @elseif($faqlist->faq_status==0)
        <span class="badge bg-danger text-white">Inactive</span>
    @endif
    <p><strong>Tags:</strong></p>
        @php
            $tags = $faqlist->faq_tags;
        @endphp
        @if(!empty($tags))
            @foreach($tags as $tag)
                <span class="badge bg-info text-white">{{ $tag }}</span>
            @endforeach
        @else
            <p>No tags available.</p>
        @endif
    <div class="d-flex justify-content-end">
        <a href="{{ route('faqlist.index') }}" class="btn btn-primary mt-3">
            <i class="bi bi-arrow-left-circle"></i> Return</a>
    </div>
@endsection
