<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css"> 
    
    <style>
        /* تأكيد إعدادات البودي لتوسط العناصر */
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* ملء الشاشة عمودياً */
            margin: 0;
            padding: 20px;
            background-color: #e8e8e8 !important; /* نفس خلفية الـ CSS حقك */
        }

        /* الكتابة التي فوق الكرت */
        .page-main-title {
            font-size: 24px;
            font-weight: bold;
            color: #3B524A; /* اللون الأخضر الداكن من مشروعك */
            margin-bottom: 20px;
            text-align: center;
        }

        /* كرت تسجيل الدخول الرئيسي */
        .login-card-unique {
            background: #ffffff;
            width: 100%;
            max-width: 420px; /* عرض مناسب للكرت */
            padding: 35px;
            border-radius: 15px; /* انحناء عصري */
            box-shadow: 0 10px 25px rgba(0,0,0,0.06); /* ظل ناعم */
            border-top: 4px solid #3B524A; /* خط علوي بلون الهوية */
            transition: 0.3s;
        }

        /* منطقة اللوغو داخل الكرت */
        .card-logo-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .card-logo-area img {
            max-width: 160px; /* حجم مناسب للوغو داخل الكرت */
            height: auto;
        }

        /* تنسيق الروابط الفرعية (انتقل للأدمن) */
        .sub-link-wrapper {
            text-align: center;
            margin-top: -10px; /* لتقريبها من حقل الباسورد */
            margin-bottom: 25px;
        }

        .admin-link {
            font-size: 16px; /* حجم متوسط */
            color: #497033; /* لون فاتح قليلاً من نفس الدرجة */
            text-decoration: none;
            font-weight: 600;
            transition: 0.2s;
        }

        .admin-link:hover {
            color: #3B524A;
            text-decoration: underline;
        }

        /* تحسينات لحقول الإدخال لتلائم الكرت */
        .login-card-unique .form-group {
            margin-bottom: 20px;
        }

        .login-card-unique .custom-input {
            width: 100%; /* ملء العرض */
            box-sizing: border-box; /* لضمان عدم خروج الحقل عن الكرت */
        }

        /* تحسين زر تسجيل الدخول */
        .login-btn-full {
            width: 100%;
            padding: 14px !important;
            font-size: 17px !important;
            box-shadow: 0 4px 10px rgba(59, 82, 74, 0.2);
        }
    </style>
</head>
<body>

    <h1 class="page-main-title">@yield('loginForWho')</h1>

    <div class="login-card-unique">
        
        <div class="card-logo-area">
            <img src="logo.png">
        </div>

        <form @yield('action') method="POST">
            
            <div class="form-group">
                <label class="form-label-custom">اسم المستخدم</label>
                <input type="text" name="username" placeholder="أدخل اسم المستخدم" required class="form-control custom-input">
            </div>

            <div class="form-group">
                <label class="form-label-custom">كلمة المرور</label>
                <input type="password" name="password" placeholder="********" required class="form-control custom-input">
            </div>

            <div class="sub-link-wrapper">
                <a href="@yield('goTo')" class="admin-link">@yield('goTo-text')</a>
            </div>

            <div class="text-center">
                <button type="submit" class="save-btn login-btn-full">تسجيل الدخول</button>
            </div>
        </form>
        
    </div>
</body>
</html>