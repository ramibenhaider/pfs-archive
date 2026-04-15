@extends('layouts.user-layout')

@section('title', 'الصفحة غير مفعلة')

@push('styles')
<style>
    .pending-approval-alert {
        display: flex;
        align-items: center;
        background-color: #fff3cd; /* لون خلفية تنبيهي */
        border-right: 5px solid #ffc107; /* حافة برتقالية جهة اليمين */
        color: #856404;
        padding: 20px;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        font-family: 'Cairo', sans-serif; /* أو أي خط عربي تستخدمه */
    }

    .alert-icon {
        margin-left: 15px;
        display: flex;
        align-items: center;
    }

    .alert-icon svg {
        width: 35px;
        height: 35px;
        stroke: #ffc107;
    }

    .alert-content {
        flex: 1;
    }

    .alert-title {
        margin: 0 0 5px 0;
        font-size: 18px;
        font-weight: bold;
    }

    .alert-message {
        margin: 0;
        font-size: 14px;
        opacity: 0.9;
    }
</style>
@endpush

@section('content')
@if(auth()->user()->is_active)
<script>window.location.href = '{{ route('employee.index') }}'</script>
@endif
<div class="pending-approval-alert">
    <div class="alert-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
    </div>
    <div class="alert-content">
        <h4 class="alert-title">حسابك قيد المراجعة</h4>
        <p class="alert-message">عذراً، لا يمكنك القيام بأي إجراء حالياً. يرجى الانتظار حتى يتم تفعيل حسابك من قبل الإدارة.</p>
    </div>
</div>
@endsection