

<?php $__env->startSection('title'); ?>
  الصفحة الرئيسية
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('styles.css')); ?>">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

  <div class="container">

    <!-- صف البحث -->
    <div class="search-row">

      <!-- زر الملاحظات -->
      <div class="btn-wrapper">
        <a href="<?php echo e(route('library.index')); ?>" class="main-btn">
          <svg class="icon" width="22" height="22" viewBox="0 0 24 24" fill="#ffffff">
            <path d="M10 4l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4h8z"/>
          </svg>
        </a>
        <div class="tooltip">المكتبة</div>
      </div>
 
      <!-- مربع البحث -->
      <form action="<?php echo e(url('search')); ?>" method="GET" class="search-form">
        <input type="search" name="search" placeholder="البحث عن موظف (الاسم - رقم الهوية - الرقم الوظيفي)"/>
        <button type="submit" value="Search" class="search-submit">ابحث</button>
      </form>

      <!-- زر إضافة موظف -->
      <div class="btn-wrapper">
        <a href="<?php echo e(route('employee.create')); ?>" class="main-btn">
          <span class="icon" style="font-size:26px;">+</span>
        </a>
        <div class="tooltip">إضافة موظف</div>
      </div>

    </div>

<div class="employee-list">

    <?php $__currentLoopData = $employee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $emp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="employee-row">

            <div class="emp-info">
                <span class="emp-name"><?php echo e($emp->name); ?></span>
                <span class="emp-id">رقم الهوية: <?php echo e($emp->id_number ?? 'لم يتم التحديد'); ?></span>
                <span class="emp-job">الرقم الوظيفي: <?php echo e($emp->job_number ?? 'لم يتم التحديد'); ?></span>
            </div>

            <div class="emp-status">
              <?php if($emp->is_active == 1): ?> 
                  <span class="badge badge-active">موظف</span>
              <?php else: ?>
                  <span class="badge badge-inactive">غير موظف</span>
              <?php endif; ?>
            </div>

            <div class="emp-action">
              <a href="<?php echo e(route('employee.show', $emp->id)); ?>" class="view-btn-row">عرض بيانات الموظف</a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>

<div class="pagination-wrapper">
  <?php echo e($employee->links()); ?>

</div>

  </div>
  <script src="<?php echo e(asset('script.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.index-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/index.blade.php ENDPATH**/ ?>