@extends('layouts.login')

@section('loginForWho', "تسجيل دخول المستخدمين")

@section('action', route('doLogin'))

@section('goTo', route('admin.login'))

@section('goTo-text')
انتقل للأدمن
<br><br>
<a href="{{ route('user.register') }}">إنشاء حساب جديد</a>
@endsection