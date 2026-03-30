@extends('layouts.index-layout')

@section('title')
    مذكرة الملاحظات
@endsection

@section('styles')
    "{{ asset('notes/styles.css') }}"
@endsection

@section('content')
<form action="{{ route('images.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>ارفع الصور:</label>
    <input type="file" name="images[]" multiple>

    <button type="submit">رفع</button>

    <select name="employee_id">
        <option value="21">21</option>
        <option value="22">22</option>
        <option value="23">23</option>
    </select>
        <select name="document_type_id">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
    </select>
</form>

@endsection