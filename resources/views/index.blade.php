@extends('layouts.index-layout')

@section('title')
  الصفحة الرئيسية
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('content')

    @if (session('success'))
      <div id="success" class="success-message">
          {{ session('success') }}
      </div>
    @endif

  <div class="container">

    <!-- صف البحث -->
    <div class="search-row">

      <!-- زر الملاحظات -->
      <div class="btn-wrapper">
        <a href="{{ route('library.index') }}" class="main-btn">
          <svg class="icon" width="22" height="22" viewBox="0 0 24 24" fill="#ffffff">
            <path d="M10 4l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4h8z"/>
          </svg>
        </a>
        <div class="tooltip">دار الوثائق</div>
      </div>
 
      <!-- مربع البحث -->
      <form action="{{ url('search') }}" method="GET" class="search-form">
        <input type="search" name="search" placeholder="البحث عن موظف (الاسم - رقم الهوية - الرقم الوظيفي)"/>
        <button type="submit" value="Search" class="search-submit">ابحث</button>
      </form>

      <!-- زر إضافة موظف -->
      <div class="btn-wrapper">
        <a href="{{ route('employee.create') }}" class="main-btn">
          <span class="icon" style="font-size:26px;">+</span>
        </a>
        <div class="tooltip">إضافة موظف</div>
      </div>

    </div>

<div class="employee-list">

    @foreach ($employee as $emp)
        <div class="employee-row">

            <div class="emp-info">
                <span class="emp-name">{{ $emp->name }}</span>
                <span class="emp-id">رقم الهوية: {{ $emp->id_number ?? 'لم يتم التحديد' }}</span>
                <span class="emp-job">الرقم الوظيفي: {{ $emp->job_number ?? 'لم يتم التحديد' }}</span>
            </div>

            <div class="emp-status">
              @if($emp->is_active == 1) 
                  <span class="badge badge-active">موظف</span>
              @else
                  <span class="badge badge-inactive">غير موظف</span>
              @endif
            </div>

            <div class="emp-action">
              <a href="{{ route('employee.show', $emp->id) }}" class="view-btn-row">عرض بيانات الموظف</a>
            </div>
        </div>
    @endforeach

</div>

<div class="pagination-wrapper">
  {{ $employee->links() }}
</div>

  </div>
  <script src="{{ asset('script.js') }}"></script>

@endsection