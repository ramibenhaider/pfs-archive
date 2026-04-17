@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم')
@section('sidebar-fields', 'active')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
    body { 
        margin: 0; 
        padding: 0; 
        font-family: "Cairo", sans-serif; 
        background-color: #e8e8e8 !important; 
    }

    .section-title { 
        color: #3B524A; 
        margin-top: 35px; 
        margin-bottom: 15px; 
        font-size: 22px; 
        border-right: 5px solid #3B524A; 
        padding-right: 10px; 
    }

    .form-grid { 
        display: grid; 
        gap: 18px; 
        align-items: start; 
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    }

    .side-card-unique { border: 1px solid #3B524A !important; border-radius: 10px !important; overflow: hidden; }
    .side-card-header { background-color: #3B524A; color: white; padding: 10px 15px; }
    .side-title { font-weight: bold; font-size: 1rem; }
    .total-count-badge { background-color: #ffffff; color: #3B524A; padding: 2px 8px; border-radius: 4px; font-weight: bold; font-size: 0.85rem; min-width: 25px; text-align: center; }
    
    .search-form { display: flex; gap: 0; width: 100%; direction: rtl; }
    .search-form input { flex: 1; height: 50px; padding: 0 15px; border: 1px solid #ccc; border-radius: 0 10px 10px 0 !important; font-size: 16px; background-color: #fff; text-align: center; outline: none; }
    .search-submit { height: 50px; padding: 0 25px; background-color: #3B524A !important; color: #fff !important; border: 1px solid #3B524A; border-radius: 10px 0 0 10px !important; font-size: 16px; font-weight: bold; cursor: pointer; white-space: nowrap; transition: 0.25s; }
    
    .side-list { max-height: 300px; overflow-y: auto; }
    .invalid-feedback { color: red; font-size: 13px; margin-top: 5px; display: block; }
    .is-invalid { border-color: red !important; }

    @media (max-width: 768px) {
        div[style*="margin-right: 260px"] {
            margin-right: 0 !important;
            padding: 10px !important;
        }

        .form-grid {
            grid-template-columns: 1fr !important; 
        }

        .search-form input {
            font-size: 14px;
            padding: 0 10px;
        }

        .search-submit {
            padding: 0 15px;
            font-size: 14px;
        }

        .form-control.me-2 {
            width: 100% !important;
            margin-bottom: 5px;
        }

        .d-flex.justify-content-between {
            flex-wrap: wrap; 
        }
</style>
@endpush

@section('content')
<div style="margin-right: 260px; padding: 20px; direction: rtl;">
    <h2 class="section-title">إدارة البيانات والمدخلات</h2>

    <div class="form-grid" style="grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));">

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">خطوط الطيران</span>
                <span class="total-count-badge">{{ $airlines->count() ?? 0 }}</span>
            </div>
            <div class="p-3 bg-white">
                <form action="{{ route('admin.airline.store') }}" method="POST" class="search-form">
                    @csrf
                    <input type="text" name="airline_name" class="@error('airline_name', 'airline_name.create') is-invalid @enderror" placeholder="إضافة خط طيران جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                @error('airline_name', 'airline_name.create') <div class="invalid-feedback mb-2">{{ $message }}</div> @enderror

                <div class="side-list">
                    @error('airline_name', 'airline_name.edit') <div class="invalid-feedback border-bottom pb-2">{{ $message }}</div> @enderror
                    
                    @foreach ($airlines as $airline)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="{{ route('admin.airline.update', encodeId($airline->id)) }}" method="POST" class="d-flex align-items-center flex-grow-1">
                                @csrf
                                @method('PUT')
                                <input type="text" name="airline_name" value="{{ $airline->airline_name }}" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="{{ route('admin.airline.destroy', encodeId($airline->id)) }}" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">الإدارات</span>
                <span class="total-count-badge">{{ $management->count() ?? 0 }}</span>
            </div>
            <div class="p-3 bg-white">
                <form action="{{ route('admin.management.store') }}" method="POST" class="search-form">
                    @csrf
                    <input type="text" name="management_name" class="@error('management_name', 'management_name.create') is-invalid @enderror" placeholder="اسم الإدارة الجديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                @error('management_name', 'management_name.create') <div class="invalid-feedback mb-2">{{ $message }}</div> @enderror

                <div class="side-list">
                    @error('management_name', 'management_name.edit') <div class="invalid-feedback border-bottom pb-2">{{ $message }}</div> @enderror
                    @foreach ($management as $manage)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="{{ route('admin.management.update', encodeId($manage->id)) }}" method="POST" class="d-flex align-items-center flex-grow-1">
                                @csrf
                                @method('PUT')
                                <input type="text" name="management_name" value="{{ $manage->management_name }}" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="{{ route('admin.management.destroy', encodeId($manage->id)) }}" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">المسميات الوظيفية</span>
                <span class="total-count-badge">{{ $job_titles->count() ?? 0 }}</span>
            </div>
            <div class="p-3 bg-white">
                <form action="{{ route('admin.job_title.store') }}" method="POST" class="search-form">
                    @csrf
                    <input type="text" name="job_title_name" class="@error('job_title_name', 'job_title_name.create') is-invalid @enderror" placeholder="مسمى وظيفي جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                @error('job_title_name', 'job_title_name.create') <div class="invalid-feedback mb-2">{{ $message }}</div> @enderror

                <div class="side-list">
                    @error('job_title_name', 'job_title_name.edit') <div class="invalid-feedback border-bottom pb-2">{{ $message }}</div> @enderror
                    @foreach ($job_titles as $job_title)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="{{ route('admin.job_title.update', encodeId($job_title->id)) }}" method="POST" class="d-flex align-items-center flex-grow-1">
                                @csrf
                                @method('PUT')
                                <input type="text" name="job_title_name" value="{{ $job_title->job_title_name }}" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="{{ route('admin.job_title.destroy', encodeId($job_title->id)) }}" onsubmit="return confirm('هل أنت متأكد؟')" method="POST" class="m-0 ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">أنواع المستندات</span>
                <span class="total-count-badge">{{ $document_types->count() ?? 0 }}</span>
            </div>
            <div class="p-3 bg-white">
                <form action="{{ route('admin.document_type.store') }}" method="POST" class="mb-2">
                    @csrf
                    <div class="d-flex flex-column gap-2">
                        <input type="text" name="type" class="form-control form-control-sm @error('type', 'type.create') is-invalid @enderror" placeholder="نوع (عربي)..." required>
                        <input type="text" name="typeEn" class="form-control form-control-sm @error('typeEn', 'type.create') is-invalid @enderror" placeholder="Type (En)..." required>
                        <button type="submit" class="search-submit w-100" style="margin: 0; height: 35px; border-radius:8px !important;">إضافة</button>
                    </div>
                </form>
                @if($errors->hasBag('type.create')) <div class="invalid-feedback mb-2">{{ $errors->getBag('type.create')->first() }}</div> @endif

                <div class="side-list">
                    @error('type', 'type.edit') <div class="invalid-feedback border-bottom pb-2">{{ $message }}</div> @enderror
                    @foreach ($document_types as $document_type)
                        <div class="d-flex align-items-center border-bottom py-2">
                            <form action="{{ route('admin.document_type.update', encodeId($document_type->id)) }}" method="POST" class="d-flex align-items-center flex-grow-1">
                                @csrf
                                @method('PUT')
                                <input type="text" name="type" value="{{ $document_type->type }}" class="form-control form-control-sm me-2">
                                <input type="hidden" name="typeEn" value="{{ $document_type->typeEn }}">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="{{ route('admin.document_type.destroy', encodeId($document_type->id)) }}" onsubmit="return confirm('حذف؟')" method="POST" class="ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">الجنسيات</span>
                <span class="total-count-badge">{{ $nationalities->count() ?? 0 }}</span>
            </div>
            <div class="p-3 bg-white">
                <form action="{{ route('admin.nationality.store') }}" method="POST" class="search-form">
                    @csrf
                    <input type="text" name="nationality_name" class="@error('nationality_name', 'nationality_name.create') is-invalid @enderror" placeholder="جنسية جديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                @error('nationality_name', 'nationality_name.create') <div class="invalid-feedback mb-2">{{ $message }}</div> @enderror

                <div class="side-list">
                    @error('nationality_name', 'nationality_name.edit') <div class="invalid-feedback border-bottom pb-2">{{ $message }}</div> @enderror
                    @foreach ($nationalities as $nationality)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <form action="{{ route('admin.nationality.update', encodeId($nationality->id)) }}" method="POST" class="d-flex align-items-center flex-grow-1">
                                @csrf
                                @method('PUT')
                                <input type="text" name="nationality_name" value="{{ $nationality->nationality_name }}" class="form-control me-2">
                                <button type="submit" style="border:none; background:none; color:blue; white-space:nowrap;">تعديل</button>
                            </form>
                            <form action="{{ route('admin.nationality.destroy', encodeId($nationality->id)) }}" onsubmit="return confirm('حذف؟')" method="POST" class="m-0 ms-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="border:none; background:none; color:red; white-space:nowrap;">حذف</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
@endsection