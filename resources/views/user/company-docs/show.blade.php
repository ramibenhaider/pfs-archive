@extends('layouts.user-layout')

@push('styles')
<style>
body {
  margin: 0;
  padding: 0;
  font-family: "Cairo", sans-serif;
  background-color: #e8e8e8 !important;
}

.invalid-feedback { color: red; font-size: 13px; margin-top: 5px; }
.is-invalid { border-color: red !important; }

.logo-area {
  width: 100%;
  padding: 5px 0 0 0;
  text-align: center;
}

.logo-area img {
  max-width: min(800px, 100%);
  height: auto;
  display: block;
  margin: 0 auto;
}

.container-createEmployee {
    max-width: 1000px;
    margin: 20px auto;
    padding: clamp(12px, 4vw, 20px);
    box-sizing: border-box;
}

.btn-back-note {
    background-color: #6c757d !important;
    color: #ffffff !important;
    text-decoration: none !important;
    padding: 10px clamp(16px, 4vw, 30px) !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
}

.btn-back-note:hover {
    background-color: #5a6268 !important;
    color: #ffffff !important;
}

.edit-note-container {
    max-width: 700px;
    margin: clamp(20px, 5vw, 40px) auto;
    background: #fff;
    padding: clamp(16px, 5vw, 30px);
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
    box-sizing: border-box;
    width: calc(100% - 24px);
}

.edit-note-header {
    border-bottom: 2px solid #f0f0f0;
    margin-bottom: 25px;
    padding-bottom: 15px;
}

.edit-note-header h1 {
    font-size: clamp(18px, 5vw, 24px);
    color: #3B524A;
    margin: 0;
    font-weight: bold;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    align-items: start;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 6px;
    font-weight: bold;
    color: #333;
    font-size: clamp(13px, 3.5vw, 15px);
}

.form-group input,
.form-group select {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #bbb;
    font-size: clamp(13px, 3.5vw, 15px);
    font-family: "Cairo", sans-serif;
    width: 100%;
    box-sizing: border-box;
}

.form-label-custom {
    font-weight: bold;
    color: #444;
    margin-bottom: 8px;
    display: block;
    font-size: clamp(14px, 4vw, 16px);
}

.custom-input {
    border-radius: 10px !important;
    padding: 12px 15px !important;
    border: 1px solid #ddd !important;
    transition: all 0.3s ease;
    width: 100%;
    box-sizing: border-box;
    font-size: clamp(13px, 3.5vw, 15px);
}

.custom-input:focus {
    border-color: #3B524A !important;
    box-shadow: 0 0 0 0.2rem rgba(126, 2, 2, 0.1) !important;
}

.custom-textarea {
    min-height: 150px;
    resize: none;
    overflow: hidden;
    line-height: 1.6;
}

.auto-resize {
    resize: none;
    overflow: hidden;
}

.edit-actions {
    margin-top: 30px;
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    justify-content: center;
}

.btn-save-note {
    background-color: #3B524A !important;
    color: #ffffff !important;
    border: none !important;
    padding: 10px clamp(16px, 4vw, 30px) !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
    min-width: 120px;
    text-align: center;
}

.btn-save-note:hover {
    background-color: #497033 !important;
    transform: translateY(-2px);
}

.btn-save-note:active {
    transform: translateY(0);
}

.btn-delete-small { color: #497033; }

.btn-delete-sm {
    background-color: #D20E00 !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 5px 12px !important;
    font-size: 14px !important;
    color: white !important;
}

@media (max-width: 600px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .container-createEmployee {
        margin-top: 10px;
    }

    .edit-note-container {
        width: calc(100% - 16px);
        border-radius: 12px;
    }

    .edit-actions {
        flex-direction: column;
        align-items: stretch;
    }

    .btn-save-note,
    .btn-back-note {
        width: 100%;
        text-align: center;
    }
}

.disabled-btn {
    background-color: #b0b0b0 !important;
    color: #ffffff !important;
    cursor: not-allowed;
    opacity: 0.8;
}

@media (max-width: 360px) {
    .edit-note-container {
        width: 100%;
        border-radius: 0;
        margin: 10px auto;
    }
}
</style>
@endpush

@section('content')
<div class="container-createEmployee" dir="rtl">
    <div style="max-width: 700px; margin: 0 auto 20px auto; padding: 0 12px; box-sizing: border-box; text-align: right;">
        <a href="{{ route('company-docs.index') }}" class="btn-back-note" style="text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
            <i class="fas fa-arrow-right"></i> رجوع
        </a>
    </div>

    @foreach ($company_documents as $company_document)
    <div class="edit-note-container" style="margin-bottom: 30px;">
        <div class="edit-note-header">
            <h1>تعديل بيانات المستند</h1>
        </div>

        <form action="{{ route('company-docs.update', $company_document->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label>الشركة</label>
                    <select name="airline_id">
                        @foreach ($airlines as $airline)
                            <option value="{{ $airline->id }}" {{ old('airline_id', $company_document->airline_id) == $airline->id ? 'selected' : '' }}
                                class="@error('airline_id') is-invalid @enderror">{{ $airline->airline_name }}</option>
                        @endforeach
                    </select>
                    @error('airline_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group">
                    <label>نوع المستند</label>
                    <select name="company_document_type_id">
                        @foreach ($company_document_types as $type)
                            <option value="{{ $type->id }}" {{ old('company_document_type_id', $company_document->company_document_type_id) == $type->id ? 'selected' : '' }}
                                class="@error('company_document_type_id') is-invalid @enderror">{{ $type->name }}</option>
                        @endforeach
                    </select>
                    @error('company_document_type_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>اسم الملف</label>
                    <input type="text" value="{{ $company_document->original_name }}" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label-custom">التعليق</label>
                    <textarea name="comment" class="form-control custom-input custom-textarea auto-resize @error('comment') is-invalid @enderror" placeholder="أدخل ملاحظاتك هنا...">{{ $company_document->comment }}</textarea>
                    @error('comment') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="edit-actions">
                <button type="submit" class="btn-save-note">حفظ التعديلات</button>
                @if($currentUser->hasPermission('previewDocuments'))
                    @php
                        $officeUrl = URL::temporarySignedRoute('company-docs.office.preview', now()->addMinutes(60), ['id' => $company_document->id]);
                    @endphp
                    <button type="button" onclick="viewDocument('{{ $officeUrl }}', '{{ $company_document->original_name }}')" class="btn btn-primary">
                        <i class="fa fa-eye"></i> معاينة المستند
                    </button>
                @else
                    <button type="button" class="btn-delete-sm disabled-btn" disabled><i class="fa fa-eye"></i>غير مصرح لك بمعاينة المستندات</button>                
                @endif
        </form>
        @if($currentUser->hasPermission('deleteDocuments'))
                <form action="{{ route('company-docs.destroy', $company_document->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستند نهائياً؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
                        حذف المستند
                    </button>
                </form>
            </div>
        @else       
                <button type="button" class="btn-delete-sm disabled-btn" disabled><i class="fa fa-eye"></i>
                    غير مصرح لك بحذف المستندات
                </button>
            </div>
        @endif
    </div>
    <hr>
    @endforeach

</div>
@endsection