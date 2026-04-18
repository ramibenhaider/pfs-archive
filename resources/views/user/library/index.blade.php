@extends('layouts.user-layout')

@section('title', 'دار الوثائق')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    .logo-area {
        width: 100%;
        padding: 5px 0 0 0;
        text-align: center;
    }

    .logo-area img {
        max-width: min(900px, 100%);
        height: auto;
        display: block;
        margin: 0 auto;
    }

    .container {
        max-width: 900px;
        margin: 40px auto 0 auto;
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
        font-size: clamp(13px, 3.5vw, 15px);
    }

    .note-section-card {
        background: #fff;
        border-radius: 15px;
        padding: clamp(15px, 4vw, 25px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 30px;
        border-top: 4px solid #3B524A;
        box-sizing: border-box;
    }

    .section-header {
        color: #3B524A;
        font-weight: bold;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: clamp(14px, 4vw, 16px);
        flex-wrap: wrap;
    }

    .notes-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 30px;
        padding: clamp(12px, 3vw, 18px) clamp(14px, 4vw, 22px);
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 6px 16px rgba(0,0,0,0.06);
        box-sizing: border-box;
    }

    .custom-table-wrapper {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        border-radius: 12px;
    }

    .custom-table {
        width: 100%;
        min-width: 500px;
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    .custom-table thead {
        background-color: #3B524A;
        color: white;
    }

    .custom-table th, .custom-table td {
        padding: clamp(10px, 2.5vw, 15px);
        text-align: center;
        vertical-align: middle;
        font-size: clamp(12px, 3vw, 15px);
        white-space: nowrap;
    }

    .btn-main {
        background-color: #3B524A !important;
        color: white !important;
        border-radius: 8px !important;
        padding: 8px clamp(12px, 3vw, 20px) !important;
        border: none !important;
        transition: 0.3s;
        font-size: clamp(13px, 3.5vw, 15px);
        white-space: nowrap;
    }

    .btn-main:hover {
        background-color: #497033 !important;
        transform: translateY(-2px);
    }

    .btn-main:active {
        transform: translateY(0);
    }

    .custom-input {
        border-radius: 10px !important;
        padding: 12px 15px !important;
        border: 1px solid #ddd !important;
        width: 100%;
        box-sizing: border-box;
        font-size: clamp(13px, 3.5vw, 15px);
    }

    .ts-control {
        border-radius: 10px !important;
        padding: 10px !important;
        border: 1px solid #ddd !important;
    }

    .ts-wrapper.is-invalid .ts-control {
        border-color: red !important;
    }

    @media (max-width: 600px) {
        .notes-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .notes-toolbar .btn-main {
            width: 100%;
            text-align: center;
        }
    }

    @media (max-width: 480px) {
        .container {
            margin-top: 20px;
        }

        .note-section-card {
            border-radius: 12px;
        }
    }

    @media (max-width: 360px) {
        .note-section-card {
            border-radius: 0;
        }
    }
</style>
@endpush

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
                        <th>العنوان</th>
                        <th>الملاحظة</th>
                        <th>تاريخ الإضافة</th>
                        <th>تاريخ آخر تعديل</th>
                        <th>إجراءات</th>
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

    <div class="row">
        <div class="col-md-6">
            <div class="note-section-card">
                <h5 class="section-header">رفع المستندات</h5>
                <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">الموظف</label>
                        <select name="employee_id" id="select-employee-doc" class="searchable-select @error('employee_id', 'doc_errors') is-invalid @enderror" placeholder="ابحث عن موظف...">
                            <option value=""></option>
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
                    </div>

                    <div class="mb-3">
                        <label class="form-label">الملفات</label>
                        <input type="file" name="files[]" class="form-control custom-input" accept=".pdf,.doc,.docs,.xls,.xlsx" multiple>
                        @error('files', 'doc_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('files.*', 'doc_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('comments', 'doc_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @error('comments.*', 'doc_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($currentUser->hasPermission('createDocuments'))
                        <button type="submit" class="btn-main w-100">بدء الرفع</button>
                    @else
                        <button type="button" class="btn-main w-100" disabled>غير مصرح لك برفع الملفات</button>
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
                        <select name="employee_id" id="select-employee-note" class="searchable-select @error('employee_id', 'note_errors') is-invalid @enderror" placeholder="ابحث عن موظف...">
                            <option value=""></option>
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
                        <input type="text" name="title" class="form-control custom-input">
                        @error('title', 'note_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">نص الملاحظة</label>
                        <textarea name="note" class="form-control custom-input" rows="3"></textarea>
                        @error('note', 'note_errors')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn-main w-100">حفظ الملاحظة</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
@endsection