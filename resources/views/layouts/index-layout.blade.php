<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    
    <style>
        /* حاوية الهيدر كاملة */
        .header-wrapper {
            position: relative; /* ضروري عشان نثبت الكرت بالنسبة لها */
            width: 100%;
            padding: 30px 0 0 0;
            display: flex;
            justify-content: center; /* يخلي اللوقو في النص بالضبط */
            align-items: center;
        }

        /* اللوقو - حافظنا على نفس كودك */
        .logo-area {
            text-align: center;
            width: 100%;
        }

        .logo-area img {
            max-width: 800px;
            height: auto;
        }

        /* كرت المستخدم - مثبت في أقصى اليسار */
        .user-card-abs {
            position: absolute;
            left: 40px; /* المسافة من جهة اليسار */
            top: 50%;
            transform: translateY(-50%); /* للتوسط عمودياً مع اللوقو */
            background: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            border-right: 5px solid #3B524A;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 180px;
            z-index: 10;
        }

        .user-card-abs .username {
            display: block;
            font-size: 13px;
            color: #888;
            font-weight: bold;
        }

        .user-card-abs .full-name {
            display: block;
            font-size: 16px;
            color: #3B524A;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .logout-btn-custom {
            background-color: #D20E00;
            color: white !important;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .logout-btn-custom:hover {
            background-color: #a00a00;
        }

        /* التعامل مع الشاشات الصغيرة عشان الكرت ما يغطي على اللوقو */
        @media (max-width: 1100px) {
            .header-wrapper {
                flex-direction: column;
                padding-top: 20px;
            }
            .user-card-abs {
                position: static;
                transform: none;
                margin-top: 15px;
                width: fit-content;
                order: 2;
            }
            .logo-area { order: 1; }
            .logo-area img { max-width: 90%; }
        }
    </style>
    @stack('styles')
</head>

<body>

    <div class="header-wrapper">
        <div class="logo-area">
            <img src="{{ asset('logo.png') }}" alt="Company Logo">
        </div>
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
    </div>

    @if (session('success'))
      <div id="success-message" class="success-message">
          {{ session('success') }}
      </div>
    @elseif (session('warning'))
      <div id="warning-message" class="warning-message">
          {{ session('warning') }}
      </div>
    @endif

    @yield('content')
    
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    @stack('scripts')
</body>
</html>