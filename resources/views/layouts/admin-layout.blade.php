@extends('layouts.main-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('sidebar')
<div class="custom-sidebar">
    <div class="sidebar-header">
        <span class="header-text">👤 الأدمن</span>
    </div>

    <nav class="sidebar-nav" style="display: flex; flex-direction: column; justify-content: center;">
        <a href="{{ route('admin.permissions') }}" class="sidebar-link active">
            <span class="icon">🔐</span> 
            <span class="text">المستخدمين والصلاحيات</span>
        </a>

        <a href="{{ route('admin.fields') }}" class="sidebar-link">
            <span class="icon">📊</span> 
            <span class="text">البيانات المدخلة</span>
        </a>
    </nav>

    <div class="sidebar-footer">
        <a href="{{ route('admin.logout') }}" class="logout-link">
            <span class="icon">🚪</span> 
            <span class="text">تسجيل الخروج</span>
        </a>
    </div>
</div>
@endsection