<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="style.css"> 
    
<style>
    body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        margin: 0;
        padding: 20px;
        box-sizing: border-box;
        background-color: #e8e8e8 !important;
    }

    .page-main-title {
        font-size: clamp(18px, 5vw, 24px);
        font-weight: bold;
        color: #3B524A;
        margin-bottom: 20px;
        text-align: center;
    }

    .login-card-unique {
        background: #ffffff;
        width: 100%;
        max-width: 420px;
        padding: clamp(20px, 5vw, 35px);
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.06);
        border-top: 4px solid #3B524A;
        box-sizing: border-box;
    }

    .card-logo-area {
        text-align: center;
        margin-bottom: 30px;
    }

    .card-logo-area img {
        max-width: clamp(100px, 40vw, 160px);
        height: auto;
    }

    .sub-link-wrapper {
        text-align: center;
        margin-top: -10px;
        margin-bottom: 25px;
    }

    .admin-link {
        font-size: clamp(14px, 4vw, 16px);
        color: #497033;
        text-decoration: none;
        font-weight: 600;
        transition: 0.2s;
    }

    .admin-link:hover {
        color: #3B524A;
        text-decoration: underline;
    }

    .login-card-unique .form-group {
        margin-bottom: 22px;
    }

    .form-label-custom {
        font-weight: bold;
        color: #444;
        font-size: 14px;
        display: block;
        margin-bottom: 6px;
    }

    .custom-input {
        width: 100%;
        box-sizing: border-box;
        border: none !important;
        border-bottom: 2px solid #ccc !important;
        border-radius: 0 !important;
        padding: 10px 5px !important;
        font-size: clamp(14px, 4vw, 15px);
        background: transparent !important;
        outline: none !important;
        box-shadow: none !important;
        font-family: "Cairo", sans-serif;
        transition: border-color 0.3s ease;
    }

    .custom-input:focus {
        border-bottom-color: #3B524A !important;
        box-shadow: none !important;
    }

    .login-btn-full {
        width: 100%;
        padding: 14px !important;
        font-size: clamp(15px, 4vw, 17px) !important;
        background-color: #3B524A !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 10px !important;
        cursor: pointer;
        font-family: "Cairo", sans-serif;
        font-weight: bold;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .login-btn-full:hover {
        background-color: #497033 !important;
        transform: translateY(-2px);
    }

    .login-btn-full:active {
        transform: translateY(0);
    }

    .success-message,
    .warning-message {
        position: fixed;
        top: 20px;
        right: 50%;
        transform: translateX(50%);
        padding: 14px 18px;
        border-radius: 10px;
        font-size: clamp(14px, 4vw, 16px);
        font-weight: bold;
        transition: opacity 0.5s ease;
        width: calc(100% - 40px);
        max-width: 400px;
        text-align: center;
        z-index: 9999;
        box-sizing: border-box;
    }

    .success-message {
        background-color: #e8fff3;
        border: 2px solid #28a745;
        color: #155724;
    }

    .warning-message {
        background-color: #fcebd3;
        border: 2px solid #f5712f;
        color: #a37b3e;
    }

    @media (max-width: 480px) {
        body {
            padding: 16px;
            justify-content: flex-start;
            padding-top: 40px;
        }

        .login-card-unique {
            border-radius: 12px;
        }

        .login-btn-full {
            padding: 12px !important;
        }
    }

    @media (max-width: 360px) {
        body {
            padding: 12px;
            padding-top: 30px;
        }

        .card-logo-area {
            margin-bottom: 20px;
        }

        .login-card-unique .form-group {
            margin-bottom: 16px;
        }
    }
</style>
</head>
<body>
    <?php if(session('success')): ?>
      <div id="success-message" class="success-message">
          <?php echo e(session('success')); ?>

      </div>
    <?php elseif(session('warning')): ?>
      <div id="warning-message" class="warning-message">
          <?php echo e(session('warning')); ?>

      </div>
    <?php endif; ?>

    <h1 class="page-main-title"><?php echo $__env->yieldContent('loginForWho'); ?></h1>

    <div class="login-card-unique">
        
        <div class="card-logo-area">
            <img src="<?php echo e(asset('logo.png')); ?>">
        </div>

        <form action="<?php echo $__env->yieldContent('action'); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label class="form-label-custom">اسم المستخدم</label>
                <input type="text" name="username" placeholder="أدخل اسم المستخدم" required class="form-control custom-input">
            </div>

            <div class="form-group">
                <label class="form-label-custom">كلمة المرور</label>
                <input type="password" name="password" placeholder="********" required class="form-control custom-input">
            </div>

            <div class="sub-link-wrapper">
                <a href="<?php echo $__env->yieldContent('goTo'); ?>" class="admin-link"><?php echo $__env->yieldContent('goTo-text'); ?></a>
            </div>

            <div class="text-center">
                <button type="submit" class="login-btn-full">تسجيل الدخول</button>
            </div>
            <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <br>
                <span style="color: red;"><?php echo e($message); ?></span>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </form>
    </div>
<script src="<?php echo e(asset('script.js')); ?>"></script>
</body>
</html><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/login.blade.php ENDPATH**/ ?>