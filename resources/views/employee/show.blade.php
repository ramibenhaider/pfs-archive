
@extends('layouts.index-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('title')
بيانات الموظف
@endsection

@section('content')
@if (session('success'))
    <div id="success-message" class="success-message">
        {{ session('success') }}
    </div>
@endif
@if (session('warning'))
    <div id="warning" class="warning-message">
        {{ session('warning') }}
    </div>
@endif

<div class="container-fluid mt-3" dir="rtl">
    <div class="row">
        <div class="col-md-7 mb-4">
            <div class="card emp-main-card-unique">
                <div class="card-header-unique">
                    <h5 class="mb-0">بيانات الموظف</h5>
                </div>
                <form method="POST" action="{{ route('employee.update', $employee->id) }}">
                    @csrf
                    @method('PUT')
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <div class="d-flex align-items-start">
                                <strong style="min-width: 160px;" class="mt-1">الاسم:</strong>
                                <div class="flex-grow-1 ms-4"> 
                                    <textarea name="name" rows="1" 
                                        class="form-control text-muted auto-resize @error('name') is-invalid @enderror"
                                        style="resize: none; overflow: hidden;"
                                    >{{ trim(old('name', $employee->name)) }}</textarea>
                                    @error('name')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">الرقم الوظيفي:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="job_number" 
                                        class="form-control text-muted @error('job_number') is-invalid @enderror" 
                                        value="{{ old('job_number', $employee->job_number) }}">
                                    @error('job_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم الهوية:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="id_number" 
                                        class="form-control text-muted @error('id_number') is-invalid @enderror" 
                                        value="{{ old('id_number', $employee->id_number) }}">
                                    @error('id_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم جواز السفر:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="passport_number" 
                                        class="form-control text-muted @error('passport_number') is-invalid @enderror" 
                                        value="{{ old('passport_number', $employee->passport_number) }}">
                                    @error('passport_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">رقم الجوال:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="text" name="phone_number" 
                                        class="form-control text-muted @error('phone_number') is-invalid @enderror" 
                                        value="{{ old('phone_number', $employee->phone_number) }}">
                                    @error('phone_number')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="d-flex align-items-center">
                                <strong style="min-width: 160px;">تاريخ انتهاء الهوية:</strong>
                                <div class="flex-grow-1 ms-4">
                                    <input type="date" name="expiry_date_id" 
                                        class="form-control text-muted @error('expiry_date_id') is-invalid @enderror" 
                                        value="{{ old('expiry_date_id', $employee->expiry_date_id) }}">
                                    @error('expiry_date_id')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الإدارة:</strong>
                            <select name="management_id" class="form-select w-50 text-muted" >
                            @foreach ($managements as $management)
                                <option value="{{ $management->id }}"
                                    {{ old('management_id', $management->id) == $employee->management_id ? 'selected':''}}>
                                    {{ $management->management_name }}
                                </option>
                            @endforeach
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="form-select w-50 text-muted">
                            @foreach ($nationalities as $nationality)
                                <option value="{{ $nationality->id }}"
                                    {{ old('nationality_id', $nationality->id) == $employee->nationality_id ? 'selected':'' }}>
                                    {{ $nationality->nationality_name }}
                                </option>
                            @endforeach
                            </select>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <strong>الحالة (موظف - غير موظف)</strong>
                            <label class="switch-container">
                                <input type="checkbox" name="is_active"
                                    value="1" {{ (old('is_active') ?? $employee->is_active) == 1 ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="card-footer d-flex justify-content-between border-top-0 bg-white">
                        <a href="{{ route('index') }}" class="btn btn-secondary btn-sm">رجوع</a>
                        <button type="submit" class="btn btn-save-custom btn-sm">حفظ التعديلات</button>
                    </div>
                </form>
            </div>
        </div>
<!-- ###################################################################################################################-->
        <div class="col-md-5">
            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">الملاحظات</span>
                    <span class="total-count-badge">{{ $employee->notes->count() ?? 0 }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush side-list">
                        @forelse($employee->notes as $note)
                        <li class="list-group-item d-flex justify-content-between align-items-center side-item">
                            <span class="text-truncate" style="max-width: 70%;">{{ $note->note }}</span>
                            <div class="side-actions">
                                <a href="#" class="btn-edit-small"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-delete-small"><i class="fas fa-trash"></i></a>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item text-center text-muted">لا توجد ملاحظات</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    <a href="#" class="view-all-link">مشاهدة الكل</a>
                </div>
            </div>
<!--################################################################################################################-->
            <div class="card side-card-unique">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span class="side-title">المستندات</span>
                    <span class="total-count-badge">{{ $employee->documents->count() ?? 0 }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush side-list">
                        @forelse($employee->documents as $doc)
                        <li class="list-group-item d-flex justify-content-between align-items-center side-item">
                            <div class="d-flex align-items-center">
                                <span class="inner-item-count me-2">{{ $doc->files_count ?? 0 }}</span>
                                <span class="text-truncate">{{ $doc->file_path }}</span>
                            </div>
                            <div class="side-actions">
                                <a href="#" class="btn-edit-small"><i class="fas fa-edit"></i></a>
                                <a href="#" class="btn-delete-small"><i class="fas fa-trash"></i></a>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item text-center text-muted">لا توجد مستندات</li>
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-center bg-white border-0">
                    <a href="#" class="view-all-link">مشاهدة الكل</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection