@extends('layouts.admincreate')
@section('title', 'FAQ Management Creator | iREX Admin')
@section('alias', 'FAQ Set')

@section('content')
    <form action="{{ route('faqlist.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">FAQ Question</label>
            <input type="text" name="question" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">FAQ Answer</label>
            <textarea name="answer" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Category of Inquiry</label>
            <select name="category" class="form-control">
                <option value="General">General Inquiry</option>
                <option value="Product">Product/Stock Related Inquiry</option>
                <option value="Account">Account Related Inquiry</option>
                <option value="Payment">Payment/Billing Related Inquiry</option>
                <option value="Technical">Technical Related Inquiry</option>
                <option value="Promotion">Promotions and Offers</option>
                <option value="Other">Miscellaneous</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Activate This Inquiry Set?</label>
            <select name="status" class="form-control">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Add FAQ</button>
        <a href="{{ route('faqlist.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
@endsection
