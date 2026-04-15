@extends('layouts.user-layout')

@section('title', 'تعديل الملاحظة')

@section('content')
<div class="container">
    <div class="edit-note-container">

        <div class="edit-note-header text-center">
            <h1>@yield('note-title')</h1>
        </div>

        <form method="POST" action="@yield('action')">
            @csrf
            @yield('method')

            <div class="mb-4">
                <label class="form-label-custom">العنوان</label>
                <input type="text" name="title" 
                       value="{{ old('title', $note->title ?? $myNote->title ?? '') }}" 
                       class="form-control custom-input @error('title') is-invalid @enderror"
                       placeholder="أدخل عنوان الملاحظة">
                @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label-custom">الملاحظة التفصيلية</label>
                <textarea name="note" class="form-control custom-input custom-textarea @error('note') is-invalid @enderror"placeholder="اكتب ملاحظاتك هنا...">{{ old('note', $note->note ?? $myNote ?? '') }}</textarea>
                @error('note')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="edit-actions">
                <button type="submit" class="btn btn-save-note">
                    <i class="bi bi-check-lg"></i> حفظ
                </button>
                <a href=@yield('backTo') class="btn btn-back-note"><i class="bi bi-arrow-right"></i>عودة</a>
        </form>
                @yield('deleteButton')
            </div>
    </div>
</div>
@endsection