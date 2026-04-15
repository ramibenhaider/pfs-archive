@extends('layouts.user-layout')

@section('content')
<div class="container-createEmployee">
    <div class="mb-3">
        <a href="{{ route('employee.edit', encodeId($employee->id)) }}" class="btn-back-note" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
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
                @if($currentUser->hasPermission('previewDocuments'))
                    @php
                        $signedUrl = URL::temporarySignedRoute('documents.preview', now()->addMinutes(60), ['path' => $document->file_path]);
                    @endphp
                    <button type="button" onclick="viewDocument('{{ $signedUrl }}', '{{ $document->original_name }}')" class="btn btn-primary">
                        <i class="fa fa-eye"></i> معاينة المستند
                    </button>
                @else
                    <button type="button" class="btn-delete-sm disabled-btn"><i class="fa fa-eye"></i>غير مصرح لك بمعاينة المستندات</button>                
                @endif
        </form>
        @if($currentUser->hasPermission('deleteDocuments'))
                <form action="{{ route('documents.destroy', $document->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستند نهائياً؟');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
                        حذف المستند
                    </button>
                </form>
            </div>
        @else       
                <button type="button" class="btn-delete-sm disabled-btn" style="padding: 10px 30px !important; height: 100%; cursor: pointer;" disabled>
                    غير مصرح لك بحذف المستندات
                </button>
            </div>
        @endif
    </div>
    <hr>
    @endforeach

</div>
@endsection