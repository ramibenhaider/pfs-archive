@extends('layouts.index-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('title')
بيانات الموظف
@endsection

@section('content')
<div class="container mt-4" dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الاسم:</strong>
                        <textarea class="text-muted form-control auto-resize" rows="1">{{ $employee->name }}</textarea>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الرقم الوظيفي:</strong>
                        <span class="text-muted">{{ $employee->job_number }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>رقم الهوية:</strong>
                        <span class="text-muted">{{ $employee->id_number }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>رقم جواز السفر:</strong>
                        <span class="text-muted">{{ $employee->passport_number }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>تاريخ انتهاء الهوية:</strong>
                        <span class="text-muted">{{ $employee->expiry_date_id }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الإدارة:</strong>
                        <span class="text-muted">{{ $employee->management->management_name }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <strong>الجنسية:</strong>
                        <span class="text-muted">{{ $employee->nationality->nationality_name }}</span>
                    </li>
                </ul>

                <div class="card-footer">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">رجوع</a>
                    <a href="#" class="btn btn-primary btn-sm">حفظ التعديلات</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection