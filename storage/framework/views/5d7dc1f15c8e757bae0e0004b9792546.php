<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body>

  <!-- منطقة اللوقو -->
    <div class="logo-area">
      <img src="<?php echo e(asset('logo.png')); ?>" alt="Company Logo">
    </div>
    <?php if(session('success')): ?>
      <div id="success-message" class="success-message">
          <?php echo e(session('success')); ?>

      </div>
    <?php elseif(session('warning')): ?>
      <div id="warning-message" class="warning-message">
          <?php echo e(session('warning')); ?>

      </div>
    <?php endif; ?>
  <?php echo $__env->yieldContent('content'); ?>
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
  <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/layouts/index-layout.blade.php ENDPATH**/ ?>