@extends('layouts.adminedit')
@section('title','FAQ Management Editor | iREX Admin')
@section('alias', 'FAQ')

@section('content')
    <form action="{{route('faqlist.update', $faqlist->faq_id)}}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">FAQ Question</label>
            <input type="text" name="question" class="form-control" value="{{$faqlist->faq_question}}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">FAQ Answer</label>
            <textarea name="answer" class="form-control" required>{{$faqlist->faq_answer}}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category of Inquiry</label>
            <select name="category" class="form-control">
                <option value="General" {{ $faqlist->faq_category == 'General' ? 'selected' : '' }}>General Inquiry</option>
                <option value="Product" {{ $faqlist->faq_category == 'Product' ? 'selected' : '' }}>Product/Stock Related Inquiry</option>
                <option value="Account" {{ $faqlist->faq_category == 'Account' ? 'selected' : '' }}>Account Related Inquiry</option>
                <option value="Payment" {{ $faqlist->faq_category == 'Payment' ? 'selected' : '' }}>Payment/Billing Related Inquiry</option>
                <option value="Technical" {{ $faqlist->faq_category == 'Technical' ? 'selected' : '' }}>Technical Related Inquiry</option>
                <option value="Promotion" {{ $faqlist->faq_category == 'Promotion' ? 'selected' : '' }}>Promotions and Offers</option>
                <option value="Other" {{ $faqlist->faq_category == 'Other' ? 'selected' : '' }}>Miscellaneous</option>
            </select>
        </div>


        <div class="mb-3">
            <label class="form-label">Activate This Inquiry Set?</label>
            <select name="status" class="form-control">
                <option value="1" {{ $faqlist->faq_status == 1 ? 'selected' : '' }}>Yes</option>
                <option value="0" {{ $faqlist->faq_status == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Generated Tags:</label>
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
        </div>

        <div>Note that tags are automatically generated from your dataset. Powered by OpenAI API.</div>
        <button type="submit" class="btn btn-primary">Modify FAQ</button>
        <a href="{{ route('faqlist.index') }}" class="btn btn-secondary">Cancel</a>

    </form>
@endsection
