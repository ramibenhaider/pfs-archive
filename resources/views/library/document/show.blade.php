@extends('layouts.index-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')
@foreach ($documents as $document)
<h1>{{ $document->employee->name }}</h1>
<h2>{{ $document->document_type->type }}</h2>
<h3>{{ $document->original_name }}</h3>
<h3>{{ $document->comment }}</h3>
@endforeach
@endsection
