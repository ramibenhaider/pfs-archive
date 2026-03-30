@extends('layouts.index-layout')

@section('title')
  الصفحة الرئيسية
@endsection

@section('styles')
  "styles.css"
@endsection

@section('content')
  
  @if (session('success'))
    <div id="success-message" class="success-message">
        {{ session('success') }}
    </div>
  @endif

  <div class="container">

    <!-- صف البحث -->
    <div class="search-row">

      <!-- زر الملاحظات -->
      <div class="btn-wrapper">
        <a href="{{ route('notes.index') }}" class="main-btn">
          <svg class="icon" width="22" height="22" viewBox="0 0 24 24" fill="#ffffff">
            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 
            7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34a1.003 
            1.003 0 00-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.83z"/>
          </svg>
        </a>
        <div class="tooltip">مذكرة الملاحظات</div>
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

            <a href="#" class="view-btn-row">عرض بيانات الموظف</a>

        </div>
    @endforeach

</div>

  </div>
  <script src="{{ asset('script.js') }}"></script>

@endsection