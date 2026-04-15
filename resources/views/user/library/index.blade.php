@extends('layouts.user-layout')

@section('title', 'دار الوثائق')

@section('content')
<div class="container py-4">
    
    <a href="{{ route('employee.index') }}" class="btn btn-back-note">
        <i class="bi bi-x-circle"></i> عودة للرئيسية
    </a>
            <br><br>
   <div class="note-section-card">
    <div class="notes-toolbar">
        <h5 class="notes-toolbar__title">ملاحظاتي الشخصية</h5>
        <a href="{{ route('myNote.create') }}"
           class="btn-main d-flex justify-content-center align-items-center text-decoration-none"
           style="width: 250px; height: 45px; margin: 0 auto;">إضافة ملاحظة شخصية +
        </a>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th><strong>العنوان</strong></th>
                    <th><strong>الملاحظة</strong></th>
                    <th><strong>تاريخ الإضافة</strong></th>
                    <th><strong>تاريخ آخر تعديل</strong></th>
                    <th><strong>إجراءات</strong></th>
                </tr>
            </thead>
            <tbody>
            @foreach ($myNotes as $myNote)
                <tr>
                    <td>{{ Str::limit($myNote->title, 50) }}</td>
                    <td>{{ Str::limit($myNote->note, 50) }}</td>
                    <td>{{ $myNote->created_at->format('Y-m-d') }}</td>
                    <td>{{ $myNote->updated_at }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('myNote.edit', encodeId($myNote->id)) }}" class="btn btn-edit-sm">عرض</a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">
        {{ $myNotes->links() }}
    </div>
</div>
<!--############################################################################################################################-->
<div class="row">
    <div class="col-md-6">
        <div class="note-section-card">
            <h5 class="section-header">رفع المستندات</h5>
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">الموظف</label>
                    <select name="employee_id" id="employee_id" class="form-select custom-input @error('employee_id', 'doc_errors') is-invalid @enderror">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id', 'doc_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">نوع المستند</label>
                    <select name="document_type_id" class="form-select custom-input @error('document_type_id', 'doc_errors') is-invalid @enderror">
                        @foreach ($document_types as $document_type)
                            <option value="{{ $document_type->id }}" {{ old('document_type_id') == $document_type->id ? 'selected' : '' }}>{{ $document_type->type }}</option>
                        @endforeach
                    </select>
                    @error('document_type_id', 'doc_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">الملفات</label>
                    <input type="file" id="fileInput"
                        class="form-control custom-input @if($errors->doc_errors->has('files') || $errors->doc_errors->has('files.*')) is-invalid @enderror"
                        multiple accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <div id="fileList" class="mt-2"></div>
                    <input type="file" name="files[]" id="hiddenFiles" multiple style="display:none">
                    @error('files', 'doc_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                    @error('files.*', 'doc_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                @if($currentUser->hasPermission('createDocuments'))
                    <button type="submit" class="btn-main w-100">بدء الرفع</button>
                @elseif(!$currentUser->is_ac)
                    <button type="button" class="btn-main w-100 disabled-btn">غير مصرح لك برفع ملف</button>
                @endif
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="note-section-card">
            <h5 class="section-header">إضافة ملاحظة جديدة</h5>
            <form action="{{ route('note.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">الموظف</label>
                    <select name="employee_id" id="employee_id_note" class="form-select custom-input @error('employee_id', 'note_errors') is-invalid @enderror">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id', 'note_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">عنوان الملاحظة</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control custom-input @error('title', 'note_errors') is-invalid @enderror">
                    @error('title', 'note_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">نص الملاحظة</label>
                    <textarea name="note" class="form-control custom-input @error('note', 'note_errors') is-invalid @enderror" rows="3"placeholder="اكتب ملاحظاتك هنا...">{{ old('note') }}</textarea>
                    @error('note', 'note_errors')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                    <button type="submit" class="btn-main w-100">حفظ الملاحظة</button>
            </form>

        </div>
    </div>
</div>
@endsection