@extends('layouts.admin-layout')

@section('title', 'لوحة التحكم')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

<style>
.nags-action-group {
    display: flex;
    gap: 10px;
    align-items: center;
}
</style>
@endpush

@section('content')
<div style="margin-right: 260px; padding: 20px; direction: rtl;">

    <h2 class="section-title">إدارة البيانات والمدخلات</h2>

    <div class="form-grid" style="grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));">
        
        {{-- خطوط الطيران --}}
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">خطوط الطيران</span>
                <span class="total-count-badge">{{ $airlines->count() ?? 0 }}</span>
            </div>

            <div class="p-3 bg-white">
                <form action="{{ route('admin.airline.store') }}" method="POST" class="search-form mb-3">
                    @csrf
                    <input type="text" name="airline_name" placeholder="إضافة خط طيران جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>
                
                <div class="side-list">
                    @foreach ($airlines as $airline)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="{{ route('admin.airline.update', encodeId($airline->id)) }}" method="POST" class="d-flex align-items-center w-100">
                            @csrf
                            @method('PUT')

                            <input type="text" name="airline_name" value="{{ $airline->airline_name }}" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="{{ route('admin.airline.destroy', encodeId($airline->id)) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- الإدارات --}}
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">الإدارات</span>
                <span class="total-count-badge">{{ $management->count() ?? 0 }}</span>
            </div>

            <div class="p-3 bg-white">
                <form action="{{ route('admin.management.store') }}" method="POST" class="search-form mb-3">
                    @csrf
                    <input type="text" name="management_name" placeholder="اسم الإدارة الجديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    @foreach ($management as $manage)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="{{ route('admin.management.update', encodeId($manage->id)) }}" method="POST" class="d-flex align-items-center w-100">
                            @csrf
                            @method('PUT')

                            <input type="text" name="management_name" value="{{ $manage->management_name }}" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="{{ route('admin.management.destroy', encodeId($manage->id)) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- المسميات الوظيفية --}}
        <div class="side-card-unique">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span class="side-title">المسميات الوظيفية</span>
                <span class="total-count-badge">{{ $job_titles->count() ?? 0 }}</span>
            </div>

            <div class="p-3 bg-white">
                <form action="{{ route('admin.job_title.store') }}" method="POST" class="search-form mb-3">
                    @csrf
                    <input type="text" name="job_title_name" placeholder="مسمى وظيفي جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    @foreach ($job_titles as $job_title)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="{{ route('admin.job_title.update', encodeId($job_title->id)) }}" method="POST" class="d-flex align-items-center w-100">
                            @csrf
                            @method('PUT')

                            <input type="text" name="job_title_name" value="{{ $job_title->job_title_name }}" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="{{ route('admin.job_title.destroy', encodeId($job_title->id)) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
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
                <form action="{{ route('admin.document_type.store') }}" method="POST" class="search-form mb-3">
                    @csrf
                    <input type="text" name="type" placeholder="نوع مستند جديد..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    @foreach ($document_types as $document_type)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="{{ route('admin.document_type.update', encodeId($document_type->id)) }}" method="POST" class="d-flex align-items-center w-100">
                            @csrf
                            @method('PUT')

                            <input type="text" name="type" value="{{ $document_type->type }}" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="{{ route('admin.document_type.destroy', encodeId($document_type->id)) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
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
                <form action="{{ route('admin.nationality.store') }}" method="POST" class="search-form mb-3">
                    @csrf
                    <input type="text" name="nationality_name" placeholder="جنسية جديدة..." required>
                    <button type="submit" class="search-submit">إضافة</button>
                </form>

                <div class="side-list">
                    @foreach ($nationalities as $nationality)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">

                        <form action="{{ route('admin.nationality.update', encodeId($nationality->id)) }}" method="POST" class="d-flex align-items-center w-100">
                            @csrf
                            @method('PUT')

                            <input type="text" name="nationality_name" value="{{ $nationality->nationality_name }}" class="form-control me-2">

                            <div class="nags-action-group">

                                <button type="submit" style="border:none; background:none; color:blue;">
                                    تعديل
                                </button>
                        </form>

                                <form action="{{ route('admin.nationality.destroy', encodeId($nationality->id)) }}" method="POST" class="m-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border:none; background:none; color:red;">
                                        حذف
                                    </button>
                                </form>

                            </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('script.js') }}"></script>
@endsection