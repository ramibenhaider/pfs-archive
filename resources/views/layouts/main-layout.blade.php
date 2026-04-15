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
        /* تنسيقات الـ Sidebar */
        .custom-sidebar {
            width: 260px;
            height: 100vh;
            background-color: #3B524A;
            position: fixed;
            right: 0;
            top: 0;
            color: white;
            display: flex;
            flex-direction: column;
            z-index: 1000;
            box-shadow: -2px 0 10px rgba(0,0,0,0.1);
            font-family: "Cairo", sans-serif;
        }

        .sidebar-header {
            padding: 30px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-weight: bold;
            font-size: 18px;
        }

        .sidebar-nav {
            flex: 1;
            padding-top: 20px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: 0.3s;
            font-weight: 600;
        }

        .sidebar-link:hover {
            background-color: #497033;
            color: white;
        }

        /* حالة العنصر المختار حالياً */
        .sidebar-link.active {
            background-color: #e8e8e8; /* يندمج مع خلفية الصفحة */
            color: #3B524A;
            border-radius: 30px 0 0 30px;
            margin-right: 0;
        }

        /* تذييل القائمة وزر الخروج */
        .sidebar-footer {
            padding: 20px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px 25px;
            color: #ffbaba;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }

        .logout-link:hover {
            background-color: #D20E00;
            color: white;
        }

        /* التجاوب مع الجوال */
        @media (max-width: 768px) {
            .custom-sidebar { width: 70px; }
            .custom-sidebar .text, .custom-sidebar .header-text { display: none; }
            .sidebar-link, .logout-link { justify-content: center; padding: 15px 0; }
        }
    </style>
    @stack('styles')
</head>

<body>

    @if (session('success'))
      <div id="success-message" class="success-message">
          {{ session('success') }}
      </div>
    @elseif (session('warning'))
      <div id="warning-message" class="warning-message">
          {{ session('warning') }}
      </div>
    @endif

    <div class="header-wrapper">
        <div class="logo-area">
            <img src="{{ asset('logo.png') }}" alt="Company Logo">
        </div>
    @yield('auth')
    </div>
    @yield('sidebar')
    @yield('content')
    
    <script src="{{ asset('script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    @stack('scripts')
</body>
</html>