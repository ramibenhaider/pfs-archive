

<?php $__env->startSection('auth'); ?>
        <?php if(auth()->guard()->check()): ?>
          <div class="user-card-abs">
              <span class="username"><?php echo e(Str::limit(auth()->user()->username, 20)); ?></span>
              <span class="full-name"><?php echo e(Str::limit(auth()->user()->name, 25)); ?></span>
              
              <form action="<?php echo e(route('user.logout')); ?>" method="POST" style="margin: 0;">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="logout-btn-custom">تسجيل الخروج</button>
              </form>
          </div>
        <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/layouts/user-layout.blade.php ENDPATH**/ ?>