@extends('layouts.index-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')
@if (session('success'))
    <div id="success" class="success-message">
        {{ session('success') }}
    </div>
@elseif(session('warning'))
    <div id="warning" class="warning-message">
        {{ session('warning') }}
    </div>
@endif
<div class="container-createEmployee">
    <div class="mb-3">
        <a href="{{ route('employee.show', $employee->id) }}" class="btn-back-note" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <span>&larr;</span> رجوع
        </a>
    </div>

    @foreach ($documents as $document)
    <div class="edit-note-container" style="margin-bottom: 30px;">
        <div class="edit-note-header">
            <h1>تعديل بيانات المستند</h1>
        </div>

        <form action="{{ route('documents.update', $document->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>اسم الموظف</label>
                    <input type="text" value="{{ $document->employee->name }}" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group">
                    <label>نوع المستند</label>
                    <input type="text" value="{{ $document->document_type->type }}" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>اسم الملف</label>
                    <input type="text" value="{{ $document->original_name }}" disabled class="custom-input" readonly>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label-custom">التعليق</label>
                    <textarea name="comment" class="form-control custom-input custom-textarea auto-resize" placeholder="أدخل ملاحظاتك هنا...">{{ $document->comment }}</textarea>
                </div>
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn-save-note">حفظ التعديلات</button>
        </form>

                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستند نهائياً؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
                        حذف المستند
                    </button>
                </form>
            </div>
    </div>
    <hr>
    @endforeach

</div>
<script src="{{ asset('script.js') }}"></script>
@endsection
