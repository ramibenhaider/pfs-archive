@extends('layouts.main-layout')

@section('sidebar')
<div class="custom-sidebar">
    <div class="sidebar-header">
        <span class="header-text">👤 الأدمن</span>
    </div>

    <nav class="sidebar-nav" style="display: flex; flex-direction: column; justify-content: center;">
        <a href="{{ route('admin.permissions') }}" class="sidebar-link @yield('sidebar-permissions')">
            <span class="icon">🔐</span> 
            <span class="text">المستخدمين والصلاحيات</span>
        </a>

        <a href="{{ route('admin.fields') }}" class="sidebar-link @yield('sidebar-fields')">
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