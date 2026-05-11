

<?php $__env->startSection('title', 'مستندات الشركات'); ?>

<?php $__env->startPush('styles'); ?>
<style>
      body {
        margin: 0; padding: 0;
        font-family: "Cairo", sans-serif;
        background-color: #e8e8e8 !important;
    }
    .side-card-unique {
        border: 1px solid #3B524A !important;
        border-radius: 10px !important;
        overflow: hidden;
        background: #fff;
        width: 100%;
        box-sizing: border-box;
    }

    .side-card-header {
        background-color: #3B524A;
        color: white;
        padding: clamp(8px, 2.5vw, 10px) clamp(10px, 3vw, 15px);
        font-weight: bold;
        font-size: clamp(13px, 3.5vw, 15px);
    }

    .total-count-badge {
        background-color: #ffffff;
        color: #3B524A;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85rem;
    }

    .pfs-doc-container { direction: rtl; }
    
    .pfs-doc-wrapper:hover { background-color: #f9fafb; }
    
    .pfs-doc-title-link {
        color: #000 !important;
        font-weight: 700;
        font-size: clamp(12px, 3.5vw, 0.92rem);
    }

    .pfs-count-square {
        background-color: #f1f5f9;
        color: #64748b;
        width: 26px; height: 26px;
        display: flex; align-items: center; justify-content: center;
        border-radius: 5px; border: 1px solid #e2e8f0;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .view-all-link {
        color: #3B524A;
        font-weight: bold;
        text-decoration: none;
        font-size: clamp(12px, 3vw, 0.85rem);
    }
    .view-all-link:hover { text-decoration: underline; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid mb-4 mt-3 px-4" dir="rtl">
    <a href="<?php echo e(route('employee.index')); ?>" class="btn btn-secondary" style="background-color: #6c757d; border-color: #6c757d; color: white; border-radius: 10px; padding: 8px 25px; font-weight: bold; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <i class="fas fa-arrow-right"></i> رجوع
    </a>
</div>
<div class="row px-4" dir="rtl">
    <?php $__currentLoopData = $airlines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-12 col-md-6 mb-4">
        <div class="card side-card-unique h-100">
            <div class="side-card-header d-flex justify-content-between align-items-center">
                <span>مستندات <?php echo e($airline->airline_name); ?></span>
                <span class="total-count-badge"><?php echo e($airline->company_documents->count()); ?></span>
            </div>
            <div class="card-body p-0 d-flex flex-column">
                <ul class="list-group list-group-flush pfs-doc-container flex-grow-1">
                    <?php $__empty_1 = true; $__currentLoopData = $company_document_types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company_document_type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item p-0 pfs-doc-wrapper">
                            <a href="<?php echo e(route('company-docs.showTypeFiles', [encodeId($airline->id), encodeId($company_document_type->id)])); ?>" 
                                class="pfs-doc-title-link d-flex justify-content-between align-items-center p-3 text-decoration-none">
                                <span><i class="fas fa-file-alt me-2"></i> <?php echo e($company_document_type->name); ?></span>
                                <span class="pfs-count-square"><?php echo e($airline->company_documents->where('company_document_type_id', $company_document_type->id)->count()); ?></span>
                            </a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-center py-4 text-muted">لا توجد مستندات</li>
                    <?php endif; ?>
                </ul>
                    <div class="card-footer text-center bg-white border-0 mt-auto">
                        <a href="<?php echo e(route('company-docs.show', encodeId($airline->id))); ?>" class="view-all-link">مشاهدة الكل</a>
                    </div>
            </div>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/company-docs/index.blade.php ENDPATH**/ ?>