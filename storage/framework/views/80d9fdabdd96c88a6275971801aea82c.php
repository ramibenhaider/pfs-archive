

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<style>
.auth-profile-card {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
    padding: 10px 16px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    border-top: 3px solid #3B524A;
    max-width: 220px;
    box-sizing: border-box;
}

.auth-profile-username {
    font-size: 13px;
    color: #888;
    font-family: "Cairo", sans-serif;
    text-align: right;
    width: 100%;
}

.auth-profile-fullname {
    font-size: 15px;
    font-weight: bold;
    color: #3B524A;
    font-family: "Cairo", sans-serif;
    text-align: right;
    width: 100%;
}

.auth-logout-btn {
    margin-top: 6px;
    width: 100%;
    padding: 6px 14px;
    font-size: 13px;
    background-color: #D20E00;
    color: #fff;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    font-family: "Cairo", sans-serif;
    font-weight: bold;
    transition: background-color 0.2s ease, transform 0.2s ease;
}

.auth-logout-btn:hover {
    background-color: #a80b00;
    transform: translateY(-1px);
}

.auth-logout-btn:active {
    transform: translateY(0);
}

@media (max-width: 480px) {
    .auth-profile-card {
        max-width: 100%;
        width: 100%;
        align-items: center;
        border-radius: 10px;
    }

    .auth-profile-fullname {
        font-size: 14px;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('auth'); ?>
    <?php if(auth()->guard()->check()): ?>
      <div class="auth-profile-card">
          <span class="auth-profile-username"><?php echo e(Str::limit(auth()->user()->username, 20)); ?></span>
          <span class="auth-profile-fullname"><?php echo e(Str::limit(auth()->user()->name, 25)); ?></span>
          
          <form action="<?php echo e(route('user.logout')); ?>" method="POST" style="margin: 0; width: 100%;">
              <?php echo csrf_field(); ?>
              <button type="submit" class="auth-logout-btn">تسجيل الخروج</button>
          </form>
      </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/layouts/user-layout.blade.php ENDPATH**/ ?>