@extends('layouts.main-layout')

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