@extends('layouts.index-layout')

@section('title', 'المكتبة')

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')
<div class="container py-4">
    
    <a href="{{ route('index') }}" class="main-btn close-btn-fix">
        <i class="bi bi-x-circle"></i> رجوع
    </a>

   <div class="note-section-card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="section-header m-0">سجل الملاحظات</h5>
        
        <form method="GET" action="{{ route('search_notes') }}" class="search-form d-flex gap-0">
            <select name="employee_id" class="form-select flex-grow-1" id="employee_id_search_notes">
                <option value="">كل الموظفين</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn-main">بحث</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>الموظف</th>
                    <th>العنوان</th>
                    <th>الملاحظة</th>
                    <th>تاريخ الإضافة</th>
                    <th>إجراءات</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($notes as $note)
                <tr>
                    <td><strong>{{ $note->employee->name }}</strong></td>
                    <td>{{ $note->title }}</td>
                    <td>{{ Str::limit($note->note, 50) }}</td>
                    <td>{{ $note->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('note.edit', $note->id) }}" class="btn btn-edit-sm">عرض</a>
                            <form method="POST" action="{{ route('note.destroy', $note->id) }}" onsubmit="return confirm('حذف؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete-sm">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper">
        {{ $notes->links() }}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="note-section-card">
            <h5 class="section-header">رفع المستندات</h5>
            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">اختر الموظف</label>
                    <select name="employee_id" id="employee_id" class="form-select custom-input @error('employee_id') is-invalid @enderror">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">نوع المستند</label>
                    <select name="document_type_id" class="form-select custom-input @error('document_type_id') is-invalid @enderror">
                        @foreach ($document_types as $document_type)
                            <option value="{{ $document_type->id }}" {{ old('document_type_id') == $document_type->id ? 'selected' : '' }}>{{ $document_type->type }}</option>
                        @endforeach
                    </select>
                    @error('document_type_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">الملفات</label>
                    <input type="file" id="fileInput" class="form-control custom-input @error('files') is-invalid @enderror" multiple accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <div id="fileList" class="mt-2"></div>
                    <input type="file" name="files[]" id="hiddenFiles" multiple style="display:none">
                    @error('files')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn-main w-100">بدء الرفع</button>
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
                    <select name="employee_id" id="employee_id_note" class="form-select custom-input @error('employee_id') is-invalid @enderror">
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                        @endforeach
                    </select>
                    @error('employee_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">عنوان الملاحظة</label>
                    <input type="text" name="title" value="{{ old('title') }}" class="form-control custom-input @error('title') is-invalid @enderror">
                    @error('title')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">نص الملاحظة</label>
                    <textarea name="note" class="form-control custom-input @error('note') is-invalid @enderror" rows="3">{{ old('note') }}</textarea>
                    @error('note')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
                    <button type="submit" class="btn-main w-100">حفظ الملاحظة</button>
            </form>

        </div>
    </div>
</div>
@endsection
@push('scripts')
    {{-- استدعاء ملف السكريبت الخاص بك --}}
    <script src="{{ asset('script.js') }}"></script>
    
    {{-- سكريبت إضافي بسيط لتنسيق الـ textarea تلقائياً --}}
    <script>
        document.querySelectorAll('textarea').forEach(el => {
            el.addEventListener('input', () => {
                el.style.height = 'auto';
                el.style.height = el.scrollHeight + 'px';
            });
        });
    </script>
@endpush