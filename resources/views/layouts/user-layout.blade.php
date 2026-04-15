@extends('layouts.main-layout')

@push('styles')
<link rel="stylesheet" href="{{ asset('styles.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
@endpush

@section('auth')
        @auth
          <div class="user-card-abs">
              <span class="username">{{ Str::limit(auth()->user()->username, 20) }}</span>
              <span class="full-name">{{ Str::limit(auth()->user()->name, 25) }}</span>
              
              <form action="{{ route('user.logout') }}" method="POST" style="margin: 0;">
                  @csrf
                  <button type="submit" class="logout-btn-custom">تسجيل الخروج</button>
              </form>
          </div>
        @endauth
@endsection