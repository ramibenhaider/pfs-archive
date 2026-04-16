<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>

    <style>
        /* ─── Reset & Base ─── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            padding: 0;
            font-family: "Cairo", sans-serif;
            background-color: #f4f6f4;
        }

        /* ─── Sidebar ─── */
        .custom-sidebar {
            width: 250px;
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
            transition: width 0.3s ease, transform 0.3s ease;
        }

        .sidebar-header {
            padding: 28px 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            font-weight: bold;
            font-size: 17px;
        }

        .sidebar-nav { flex: 1; padding-top: 16px; overflow-y: auto; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 22px;
            color: rgba(255,255,255,0.82);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.25s, color 0.25s;
        }

        .sidebar-link:hover {
            background-color: #497033;
            color: white;
        }

        .sidebar-link.active {
            background-color: #e8e8e8;
            color: #3B524A;
            border-radius: 30px 0 0 30px;
        }

        .sidebar-footer {
            padding: 16px 0;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        .logout-link {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 22px;
            color: #ffbaba;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            transition: background 0.25s, color 0.25s;
        }

        .logout-link:hover {
            background-color: #D20E00;
            color: white;
        }

        /* ─── Sidebar Toggle Button (mobile only) ─── */
        .sidebar-toggle {
            display: none;
            position: fixed;
            top: 14px;
            right: 14px;
            z-index: 1100;
            background: #3B524A;
            color: white;
            border: none;
            border-radius: 8px;
            width: 40px;
            height: 40px;
            font-size: 20px;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 999;
        }

        .sidebar-overlay.show { display: block; }

        /* ─── Header ─── */
        .header-wrapper {
            margin-right: 250px;
            padding: 24px 30px 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            transition: margin-right 0.3s ease;
        }

        .logo-area { flex: 1; text-align: center; }

        .logo-area img {
            max-width: 600px;
            width: 100%;
            height: auto;
        }

        /* ─── User Card ─── */
        .user-card {
            background: #fff;
            padding: 12px 18px;
            border-radius: 12px;
            border-right: 5px solid #3B524A;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            min-width: 170px;
            flex-shrink: 0;
        }

        .user-card .username {
            display: block;
            font-size: 12px;
            color: #888;
            font-weight: bold;
        }

        .user-card .full-name {
            display: block;
            font-size: 15px;
            color: #3B524A;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .logout-btn-custom {
            background-color: #D20E00;
            color: white;
            border: none;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        .logout-btn-custom:hover { background-color: #a00a00; }

        /* ─── Flash Messages ─── */
        .success-message,
        .warning-message {
            position: fixed;
            top: 16px;
            left: 50%;
            transform: translateX(-50%);
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 14px;
            z-index: 9999;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: fadeOut 4s forwards;
        }

        .success-message { background: #28a745; color: white; }
        .warning-message { background: #ffc107; color: #333; }

        @keyframes fadeOut {
            0%   { opacity: 1; }
            75%  { opacity: 1; }
            100% { opacity: 0; pointer-events: none; }
        }

        /* ─── Tablet (769px – 1100px) ─── */
        @media (max-width: 1100px) {
            .custom-sidebar { width: 70px; }

            .sidebar-header .header-text,
            .sidebar-link .text,
            .logout-link .text { display: none; }

            .sidebar-link,
            .logout-link { justify-content: center; padding: 14px 0; }

            .sidebar-link.active { border-radius: 0; }

            .header-wrapper { margin-right: 70px; }
        }

        /* ─── Mobile (≤768px) ─── */
        @media (max-width: 768px) {
            .custom-sidebar {
                width: 240px;
                transform: translateX(100%); /* مخفي خارج الشاشة */
            }

            .custom-sidebar.open { transform: translateX(0); }

            /* أعد إظهار النصوص في الوضع المفتوح */
            .sidebar-header .header-text,
            .sidebar-link .text,
            .logout-link .text { display: inline; }

            .sidebar-link,
            .logout-link { justify-content: flex-start; padding: 14px 22px; }

            .sidebar-link.active { border-radius: 30px 0 0 30px; }

            .sidebar-toggle { display: flex; }

            .header-wrapper {
                margin-right: 0;
                margin-top: 60px; /* مسافة لزر الهامبرغر */
                padding: 16px;
                flex-direction: column;
                align-items: center;
            }

            .logo-area img { max-width: 90%; }

            .user-card {
                width: 100%;
                max-width: 320px;
                text-align: center;
                border-right: none;
                border-top: 4px solid #3B524A;
                border-radius: 12px;
            }
        }
    </style>

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

    <?php if(session('success')): ?>
        <div id="success-message" class="success-message"><?php echo e(session('success')); ?></div>
    <?php elseif(session('warning')): ?>
        <div id="warning-message" class="warning-message"><?php echo e(session('warning')); ?></div>
    <?php endif; ?>

    
    <button class="sidebar-toggle" id="sidebarToggle" aria-label="فتح القائمة">☰</button>

    
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    
    <?php echo $__env->yieldContent('sidebar'); ?>

    
    <div class="header-wrapper">
        <div class="logo-area">
            <img src="<?php echo e(asset('logo.png')); ?>" alt="Company Logo">
        </div>
        <?php echo $__env->yieldContent('auth'); ?>
    </div>

    
    <?php echo $__env->yieldContent('content'); ?>

    <script>
        const toggle   = document.getElementById('sidebarToggle');
        const overlay  = document.getElementById('sidebarOverlay');
        const sidebar  = document.querySelector('.custom-sidebar');

        function openSidebar() {
            sidebar?.classList.add('open');
            overlay.classList.add('show');
        }

        function closeSidebar() {
            sidebar?.classList.remove('open');
            overlay.classList.remove('show');
        }

        toggle?.addEventListener('click', () => {
            sidebar?.classList.contains('open') ? closeSidebar() : openSidebar();
        });

        overlay.addEventListener('click', closeSidebar);

        // إخفاء رسائل النجاح / التحذير تلقائياً
        setTimeout(() => {
            document.getElementById('success-message')?.remove();
            document.getElementById('warning-message')?.remove();
        }, 4000);
    </script>

    <script src="<?php echo e(asset('script.js')); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/main-layout.blade.php ENDPATH**/ ?>