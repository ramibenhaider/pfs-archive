@extends('layouts.index-layout')

@section('title')
    مذكرة الملاحظات
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('styles.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')

<a href="{{ route('index') }}">إغلاق</a>

    {{-- قسم رفع الملفات --}}
    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" id="fileInput" multiple
               accept=".pdf,.doc,.docx,.xls,.xlsx">

        {{-- قائمة الملفات + التعليقات + زر الحذف --}}
        <div id="fileList"></div>

        {{-- ملفات حقيقية تُرسل للسيرفر --}}
        <input type="file" name="files[]" id="hiddenFiles" multiple
               accept=".pdf,.doc,.docx,.xls,.xlsx" style="display:none"class="form-control @error('files') is-invalid @enderror">
                @error('files')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror

        <select name="employee_id" id="employee_id" class="form-control @error('employee_id') is-invalid @enderror">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
        @error('employee_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <select name="document_type_id">
            @foreach ($document_types as $document_type)
                <option value="{{ $document_type->id }}">{{ $document_type->type }}</option>
            @endforeach
        </select>
        <button type="submit">رفع</button>
    </form>

    {{-- قسم الملاحظات --}}
    <h1>الملاحظات</h1>

    <form action="{{ route('note.store') }}" method="POST">
        @csrf

        <select name="employee_id" id="employee_id_note" class="form-control @error('employee_id') is-invalid @enderror">
            @foreach ($employees as $employee)
                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
            @endforeach
        </select>
        @error('employee_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label>العنوان</label>
        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label>الملاحظة</label>
        <textarea name="note" class="form-control @error('note') is-invalid @enderror"></textarea>
        @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <button type="submit">حفظ الملاحظة</button>
    </form>

    <form method="GET" action="{{ route('search_notes') }}">
        <br>
    <select name="employee_id" id="employee_id_search_notes">
        @foreach ($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
        @endforeach
    </select>
    <button type="submit">ابحث</button>
    </form>
    
    <br>

    <table>
        <thead>
            <tr>
                <th>الاسم</th>
                <th>العنوان</th>
                <th>الملاحظة</th>
                <th>تاريخ الإضافة</th>
                <th>تاريخ آخر تعديل</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($notes as $note)
            <tr>
                <td>{{ $note->employee->name }}</td>
                <td>{{ $note->title }}</td>
                <td>{{ $note->note }}</td>
                <td>{{ $note->created_at }}</td>
                <td>{{ $note->updated_at }}</td>
                <td><form method="POST"
                action="{{ route('note.destroy', $note->id) }}" onclick="return confirm('هل أنت متأكد من الحذف؟')">
                @csrf
                @method('DELETE')
                <button type="submit">حذف</button>
                </form>
                </td>
                <td>
                    <form method="GET" action="{{ route('note.edit', $note->id) }}">
                        @csrf
                        <button type="submit">تعديل</button>
                </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection

@push('scripts')
    <script src="{{ asset('script.js') }}"></script>
@endpush
