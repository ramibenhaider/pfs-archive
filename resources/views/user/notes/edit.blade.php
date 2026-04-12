@extends('layouts.user-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')
<div class="container">
    <div class="edit-note-container">

        <div class="edit-note-header text-center">
            <h1>تعديل ملاحظة: {{ $note->employee->name }}</h1>
        </div>

        <form method="POST" action="{{ route('note.update', $note->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label-custom">العنوان</label>
                <input type="text" name="title" 
                       value="{{ old('title', $note->title) }}" 
                       class="form-control custom-input @error('title') is-invalid @enderror"
                       placeholder="أدخل عنوان الملاحظة">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">الملاحظة التفصيلية</label>
                <textarea name="note" class="form-control custom-input custom-textarea @error('note') is-invalid @enderror"placeholder="اكتب ملاحظاتك هنا...">{{ old('note', $note->note) }}</textarea>
                @error('note')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn btn-save-note">
                    <i class="bi bi-check-lg"></i> حفظ التعديلات
                </button>
                <a href="{{ route('employee.edit', encodeId($note->employee->id)) }}" 
                   class="btn btn-back-note" 
                   onclick="return confirm('هل أنت متأكد؟ لم تقم بحفظ التعديلات!')">
                    <i class="bi bi-arrow-right"></i> رجوع
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('script.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const textarea = document.querySelector('.custom-textarea');
        
        // وظيفة لتعديل الارتفاع
        function autoResize() {
            textarea.style.height = 'auto'; // إعادة التعيين لحساب الطول الجديد
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        // تشغيل الوظيفة فور تحميل الصفحة لعرض النص الموجود كاملاً
        autoResize();

        // تشغيل الوظيفة أثناء الكتابة (إذا أراد المستخدم التعديل)
        textarea.addEventListener('input', autoResize);
    });
</script>
@endpush