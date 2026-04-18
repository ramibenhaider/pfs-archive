

<?php $__env->startSection('title', 'الصفحة الرئيسية'); ?>

<?php $__env->startPush('styles'); ?>
<style>
  body {
    margin: 0;
    padding: 0;
    font-family: "Cairo", sans-serif;
    background-color: #e8e8e8 !important;
  }

  .container {
    max-width: 900px;
    margin: 40px auto 0 auto;
    padding: clamp(12px, 4vw, 20px);
    box-sizing: border-box;
  }

  .search-row {
    display: grid;
    grid-template-columns: 60px 1fr 60px;
    align-items: center;
    gap: 6px;
    margin-bottom: 25px;
  }

  .search-form {
    display: flex;
    gap: 0;
    width: 100%;
    direction: rtl;
  }

  .search-form input {
    flex: 1;
    height: 50px;
    padding: 0 15px;
    border: 1px solid #ccc;
    border-radius: 0 10px 10px 0 !important;
    font-size: clamp(14px, 4vw, 16px);
    background-color: #fff;
    text-align: center;
    outline: none;
    -webkit-appearance: none;
    min-width: 0;
    box-sizing: border-box;
  }

  .search-submit {
    height: 50px;
    padding: 0 clamp(12px, 4vw, 25px);
    background-color: #3B524A !important;
    color: #fff !important;
    border: 1px solid #3B524A;
    border-radius: 10px 0 0 10px !important;
    font-size: clamp(13px, 3.5vw, 16px);
    font-weight: bold;
    cursor: pointer;
    white-space: nowrap;
    transition: 0.25s;
    font-family: "Cairo", sans-serif;
  }

  .search-submit:hover {
    background-color: #497033 !important;
  }

  .btn-wrapper {
    position: relative;
    display: flex;
    justify-content: center;
    gap: 8px;
  }

  .main-btn {
    width: 48px;
    height: 48px;
    border-radius: 14px;
    border: none;
    background-color: #3B524A;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
    text-decoration: none;
    flex-shrink: 0;
  }

  .main-btn:hover {
    transform: translateY(-3px) scale(1.05);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.35);
  }

  .disabled-btn {
    opacity: 0.4;
    cursor: not-allowed;
    filter: grayscale(1);
  }

  .tooltip {
    position: absolute;
    display: flex;
    flex-direction: row;
    white-space: nowrap;
    width: max-content;
    bottom: 120%;
    left: 50%;
    transform: translateX(-50%) translateY(10px);
    background-color: #3B524A;
    color: #fff;
    padding: 7px 12px;
    border-radius: 8px;
    font-size: 13px;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.25s ease, transform 0.25s ease;
    z-index: 10;
  }

  .btn-wrapper:hover .tooltip {
    opacity: 1;
    transform: translateX(-50%) translateY(0);
  }

  .employee-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 25px;
  }

  .employee-row {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 12px;
    padding: clamp(12px, 3vw, 16px) clamp(14px, 4vw, 20px);
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transition: 0.25s;
    gap: 10px;
    flex-wrap: wrap;
    box-sizing: border-box;
  }

  .employee-row:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
  }

  .emp-info, .emp-status, .emp-action {
    flex: 1;
    display: flex;
    min-width: 0;
  }

  .emp-info {
    flex-direction: column;
    align-items: flex-start;
    min-width: 140px;
  }

  .emp-status {
    justify-content: center;
    min-width: 110px;
  }

  .emp-action {
    justify-content: flex-end;
    min-width: 80px;
  }

  .emp-name {
    font-size: clamp(15px, 4vw, 18px);
    font-weight: bold;
    color: #3B524A;
  }

  .emp-id, .emp-job {
    font-size: clamp(13px, 3.5vw, 15px);
    color: #444;
  }

  .badge {
    padding: 6px 16px;
    border-radius: 50px;
    font-size: clamp(12px, 3vw, 0.85rem);
    font-weight: 600;
    color: white;
    display: inline-block;
    min-width: 90px;
    text-align: center;
  }

  .badge-active {
    background-color: #28a745;
    box-shadow: 0 2px 4px rgba(40, 167, 69, 0.2);
  }

  .badge-inactive {
    background-color: #d30e00;
    box-shadow: 0 2px 4px rgba(220, 53, 69, 0.2);
  }

  .view-btn-row {
    padding: 10px clamp(10px, 3vw, 16px);
    background-color: #3B524A;
    color: #fff;
    border-radius: 10px;
    text-decoration: none;
    transition: 0.25s;
    white-space: nowrap;
    font-size: clamp(13px, 3.5vw, 15px);
  }

  .view-btn-row:hover {
    background-color: #497033;
    transform: translateY(-3px);
  }

  .pagination-wrapper {
    margin-top: 20px;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 4px;
  }

  .pagination-wrapper .page-item:first-child .page-link {
    border-radius: 0 0.375rem 0.375rem 0 !important;
  }

  .pagination-wrapper .page-item:last-child .page-link {
    border-radius: 0.375rem 0 0 0.375rem !important;
  }

  @media (max-width: 600px) {
    .search-row {
      grid-template-columns: 48px 1fr 48px;
      gap: 4px;
    }

    .main-btn {
      width: 42px;
      height: 42px;
    }

    .employee-row {
      flex-direction: column;
      align-items: flex-start;
    }

    .emp-info, .emp-status, .emp-action {
      width: 100%;
      flex: unset;
    }

    .emp-status {
      justify-content: flex-start;
    }

    .emp-action {
      justify-content: flex-start;
    }

    .view-btn-row {
      width: 100%;
      text-align: center;
      display: block;
    }
  }

  @media (max-width: 360px) {
    .search-row {
      grid-template-columns: 42px 1fr 42px;
    }

    .container {
      margin-top: 20px;
    }
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

  <div class="container">

    <div class="search-row">

      <div class="btn-wrapper">
        <a href="<?php echo e(route('note.index', encodeId($currentUser->id))); ?>" class="main-btn">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="#ffffff">
            <path d="M10 4l2 2h8a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V4h8z"/>
          </svg>
        </a>
        <div class="tooltip">دار الوثائق</div>
      </div>
 
      <form action="<?php echo e(route('employee.search')); ?>" method="GET" class="search-form">
        <input type="search" name="search" placeholder="البحث عن موظف (الاسم - رقم الهوية - الرقم الوظيفي)"/>
        <button type="submit" class="search-submit">ابحث</button>
      </form>

      <?php if($currentUser->hasPermission('createEmployees')): ?>
          <div class="btn-wrapper">
              <a href="<?php echo e(route('employee.create')); ?>" class="main-btn">
                  <span style="font-size:26px;">+</span>
              </a>
              <div class="tooltip">إضافة موظف</div>
          </div>
      <?php else: ?>
          <div class="btn-wrapper">
              <span class="main-btn disabled-btn">
                  <span style="font-size:26px;">+</span>
              </span>
              <div class="tooltip">لست مصرحاً بالإضافة</div>
          </div>
      <?php endif; ?>

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
                <a href="<?php echo e(route('employee.edit', encodeId($emp->id))); ?>" class="view-btn-row">عرض بيانات الموظف</a>
              </div>
          </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="pagination-wrapper">
      <?php echo e($employee->links()); ?>

    </div>

  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/index.blade.php ENDPATH**/ ?>