@extends('layouts.index-layout')

@push('styles')
<link rel="stylesheet" style="{{ asset('styles.css') }}">
@endpush

@section('content')
@error('same')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
<h1>{{ $note->employee->name }}</h1>
<br>
<form method="POST" action="{{ route('note.update', $note->id) }}">
    @csrf
    @method('PUT')
        <label>العنوان</label>
        <input type="text" name="title" value="{{ old('title', $note->title) }}" class="form-control @error('title') is-invalid @enderror">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
<br>
        <label>الملاحظة</label>
        <textarea name="note" class="form-control @error('note') is-invalid @enderror">{{ old('note', $note->note) }}</textarea>
        @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
<br>
        <button type="submit">حفظ التعديل</button>
        <a href="{{ route('library.index') }}" onclick="return confirm('هل أنت متأكد؟ لم تقم بإجراء تعديل!')">رجوع</a>
        </form>
@endsection