@extends('layouts.user-layout')

@section('title', 'بيانات الموظف')

@push('styles')
<style>
    body {
        margin: 0; padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }

    .emp-main-card-unique {
        border: 1px solid #3B524A !important;
        border-radius: 12px !important;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        background: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .card-header-unique {
        background-color: #3B524A !important;
        color: #ffffff !important;
        padding: clamp(10px, 3vw, 15px) clamp(12px, 4vw, 20px);
        font-size: clamp(14px, 4vw, 16px);
    }

    .list-group-item {
        flex-wrap: wrap;
        gap: 6px;
        font-size: clamp(13px, 3.5vw, 15px);
    }
    .list-group-item strong {
        min-width: clamp(120px, 30vw, 160px);
        color: #333;
    }

    .auto-resize { resize: none; overflow: hidden; }

    .side-card-unique {
        border: 1px solid #3B524A !important;
        border-radius: 10px !important;
        overflow: hidden;
        background: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .side-card-header {
        background-color: #3B524A;
        color: white;
        padding: clamp(8px, 2.5vw, 10px) clamp(10px, 3vw, 15px);
        font-weight: bold;
        font-size: clamp(13px, 3.5vw, 15px);
    }

    .total-count-badge {
        background-color: #ffffff;
        color: #3B524A;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
    }

    .pfs-doc-container { direction: rtl; }
    .pfs-doc-wrapper:hover { background-color: #f9fafb; }
    .pfs-doc-title-link {
        color: #000 !important;
        font-weight: 700;
        font-size: clamp(12px, 3.5vw, 0.92rem);
    }

    .pfs-count-square {
        background-color: #f1f5f9;
        color: #64748b;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 5px; border: 1px solid #e2e8f0;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .switch-container {
        position: relative; display: inline-block;
        width: 44px; height: 22px;
        flex-shrink: 0;
    }
    .switch-container input { opacity: 0; width: 0; height: 0; }
    .slider {
        position: absolute; cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #D30E00; transition: .4s; border-radius: 34px;
    }
    .slider:before {
        position: absolute; content: "";
        height: 16px; width: 16px; left: 3px; bottom: 3px;
        background-color: white; transition: .4s; border-radius: 50%;
    }
    input:checked + .slider { background-color: #28a745; }
    input:checked + .slider:before { transform: translateX(22px); }

    .btn-save-custom {
        background-color: #3B524A !important;
        color: white !important;
        padding: 6px clamp(12px, 3vw, 20px) !important;
        border-radius: 8px !important;
        transition: 0.3s;
        font-size: clamp(13px, 3.5vw, 15px);
        white-space: nowrap;
    }
    .btn-save-custom:hover { background-color: #497033; }

    .view-all-link {
        color: #3B524A;
        font-weight: bold;
        text-decoration: none;
        font-size: clamp(12px, 3vw, 0.85rem);
    }
    .view-all-link:hover { text-decoration: underline; }

    .disabled-btn { opacity: 0.5; cursor: not-allowed; filter: grayscale(1); }
    .move-this { padding: clamp(15px, 4vw, 30px) 0; }

    @media (max-width: 768px) {
        .list-group-item {
            flex-direction: column;
            align-items: flex-start !important;
        }

        .list-group-item strong {
            min-width: unset;
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        .card-header-unique {
            flex-wrap: wrap;
            gap: 8px;
        }

        .side-card-header {
            flex-wrap: wrap;
            gap: 6px;
        }

        .btn-save-custom {
            width: 100%;
            text-align: center;
        }

        .move-this {
            padding: 15px 0;
        }
    }
</style>
@endpush

@section('content')
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
                        <li class="list-group-item d-flex align-items-start py-3">
                            <strong>الاسم:</strong>
                            <div class="flex-grow-1 ms-4">
                                <textarea name="name" rows="1" class="form-control auto-resize @error('name') is-invalid @enderror">{{ old('name', $employee->name) }}</textarea>
                                @error('name') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>
                        
                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>الرقم الوظيفي:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="job_number" class="form-control @error('job_number') is-invalid @enderror" value="{{ old('job_number', $employee->job_number) }}">
                                @error('job_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>رقم الهوية:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="id_number" class="form-control @error('id_number') is-invalid @enderror" value="{{ old('id_number', $employee->id_number) }}">
                                @error('id_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>تاريخ انتهاء الهوية:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="date" name="expiry_date_id" class="form-control @error('expiry_date_id') is-invalid @enderror" value="{{ old('expiry_date_id', $employee->expiry_date_id) }}">
                                @error('expiry_date_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>رقم الجواز:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="passport_number" class="form-control @error('passport_number') is-invalid @enderror" value="{{ old('passport_number', $employee->passport_number) }}">
                                @error('passport_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>

                        <li class="list-group-item d-flex align-items-center py-3">
                            <strong>الجوال:</strong>
                            <div class="flex-grow-1 ms-4">
                                <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number', $employee->phone_number) }}">
                                @error('phone_number') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                            </div>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الإدارة:</strong>
                            <select name="management_id" class="form-select w-50">
                                @foreach ($managements as $management)
                                    <option value="{{ $management->id }}" {{ old('management_id', $employee->management_id) == $management->id ? 'selected' : '' }}>
                                        {{ $management->management_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>المسمى الوظيفي:</strong>
                            <select name="job_title_id" class="form-select w-50">
                                @foreach ($job_titles as $job_title)
                                    <option value="{{ $job_title->id }}" {{ old('job_title_id', $employee->job_title_id) == $job_title->id ? 'selected' : '' }}>
                                        {{ $job_title->job_title_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>خطوط الطيران:</strong>
                            <select name="airline_id" class="form-select w-50">
                                @foreach ($airlines as $airline)
                                    <option value="{{ $airline->id }}" {{ old('airline_id', $employee->airline_id) == $airline->id ? 'selected' : '' }}>
                                        {{ $airline->airline_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الجنسية:</strong>
                            <select name="nationality_id" class="form-select w-50">
                                @foreach ($nationalities as $nationality)
                                    <option value="{{ $nationality->id }}" {{ old('nationality_id', $employee->nationality_id) == $nationality->id ? 'selected' : '' }}>
                                        {{ $nationality->nationality_name }}
                                    </option>
                                @endforeach
                            </select>
                        </li>

                        <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                            <strong>الحالة (موظف - غير موظف)</strong>
                            <label class="switch-container">
                                <input type="checkbox" name="is_active" value="1" {{ (old('is_active') ?? $employee->is_active) == 1 ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </li>
                    </ul>
                    <div class="card-footer d-flex justify-content-between bg-white py-3">
                        <a href="{{ route('employee.index') }}" class="btn btn-outline-secondary btn-sm">رجوع</a>
                        @if($currentUser->hasPermission('updateEmployees'))
                            <button type="submit" class="btn btn-save-custom btn-sm">حفظ التعديلات</button>
                        @else
                            <button type="button" class="btn btn-save-custom disabled-btn btn-sm">غير مصرح لك بالتعديل</button>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span>المستندات</span>
                    <span class="total-count-badge">{{ $employee->documents->count() }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush pfs-doc-container">
                        @forelse($documentTypes as $document_type)
                            <li class="list-group-item p-0 pfs-doc-wrapper">
                                <a href="{{ route('documents.showTypeFiles', [encodeId($employee->id), encodeId($document_type->id)]) }}" 
                                   class="pfs-doc-title-link d-flex justify-content-between align-items-center p-3 text-decoration-none">
                                    <span><i class="fas fa-file-alt me-2"></i> {{ $document_type->type }}</span>
                                    <span class="pfs-count-square">{{ $document_type->documents_count ?? 0 }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-4 text-muted">لا توجد مستندات</li>
                        @endforelse
                    </ul>
                    @if($currentUser->hasPermission('showDocuments'))
                        <div class="card-footer text-center bg-white border-0">
                            <a href="{{ route('documents.show', encodeId($employee->id)) }}" class="view-all-link">مشاهدة الكل</a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card side-card-unique mb-4">
                <div class="side-card-header d-flex justify-content-between align-items-center">
                    <span>آخر الملاحظات</span>
                    <span class="total-count-badge">{{ $employee->notes->count() }}</span>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($employee->notes->take(5) as $note)
                            <li class="list-group-item side-item">
                                <a href="{{ route('note.edit', encodeId($note->id)) }}" class="text-decoration-none text-dark d-block">
                                    <i class="fas fa-sticky-note me-2 text-muted"></i> {{ Str::limit($note->title, 40) }}
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-center py-4 text-muted">لا توجد ملاحظات</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="text-center move-this">
    <a href="{{ route('note.index') }}" class="view-all-link">
        <i class="fas fa-plus-circle"></i> إضافة مستند جديد أو ملاحظة من هنا
    </a>
</div>
@endsection