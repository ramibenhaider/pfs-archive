

<?php $__env->startPush('styles'); ?>
<style>
body {
  margin: 0;
  padding: 0;
  font-family: "Cairo", sans-serif;
  background-color: #e8e8e8 !important;
}

/* اللوقو */
.logo-area {
  width: 100%;
  padding: 5px 0 0 0;
  text-align: center;
}

.logo-area img {
  max-width: 800px;
  height: auto;
}
.container-createEmployee {
    max-width: 1000px;
    margin: 20px auto;
    padding: 20px;
}

.btn-back-note {
    background-color: #6c757d !important;
    color: #ffffff !important;
    text-decoration: none !important;
    padding: 10px 30px !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
}

.btn-back-note:hover {
    background-color: #5a6268 !important;
    color: #ffffff !important;
}

.edit-note-container {
    max-width: 700px;
    margin: 40px auto;
    background: #fff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.08);
}

.edit-note-header {
    border-bottom: 2px solid #f0f0f0;
    margin-bottom: 25px;
    padding-bottom: 15px;
}

.edit-note-header h1 {
    font-size: 24px;
    color: #3B524A;
    margin: 0;
    font-weight: bold;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
    align-items: start;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 6px;
    font-weight: bold;
    color: #333;
}

.form-group input,
.form-group select {
    padding: 12px;
    border-radius: 8px;
    border: 1px solid #bbb;
    font-size: 15px;
    font-family: "Cairo", sans-serif;
}

.form-label-custom {
    font-weight: bold;
    color: #444;
    margin-bottom: 8px;
    display: block;
    font-size: 16px;
}

.custom-input {
    border-radius: 10px !important;
    padding: 12px 15px !important;
    border: 1px solid #ddd !important;
    transition: all 0.3s ease;
}

.custom-input:focus {
    border-color: #3B524A !important;
    box-shadow: 0 0 0 0.2rem rgba(126, 2, 2, 0.1) !important;
}

.custom-textarea {
    min-height: 150px;
    resize: none;
    overflow: hidden;
    line-height: 1.6;
}

.auto-resize {
    resize: none;
    overflow: hidden;
}

.edit-actions {
    margin-top: 30px;
    display: flex;
    gap: 15px;
    justify-content: center;
}

.btn-save-note {
    background-color: #3B524A !important;
    color: #ffffff !important;
    border: none !important;
    padding: 10px 30px !important;
    border-radius: 10px !important;
    font-weight: bold !important;
    transition: 0.3s !important;
    display: inline-block;
}

.btn-save-note:hover {
    background-color: #497033 !important;
    transform: translateY(-2px);
}

.btn-delete-small { color: #497033; }

.btn-delete-sm {
    background-color: #D20E00 !important;
    border: none !important;
    border-radius: 6px !important;
    padding: 5px 12px !important;
    font-size: 14px !important;
    color: white !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-createEmployee">
    <div class="mb-3">
        <a href="<?php echo e(route('employee.edit', encodeId($employee->id))); ?>" class="btn-back-note" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
            <span>&larr;</span> رجوع
        </a>
    </div>

    <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="edit-note-container" style="margin-bottom: 30px;">
        <div class="edit-note-header">
            <h1>تعديل بيانات المستند</h1>
        </div>

        <form action="<?php echo e(route('documents.update', $document->id)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="form-grid">
                <div class="form-group">
                    <label>اسم الموظف</label>
                    <input type="text" value="<?php echo e($document->employee->name); ?>" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group">
                    <label>نوع المستند</label>
                    <input type="text" value="<?php echo e($document->document_type->type); ?>" disabled style="background-color: #f0f0f0;">
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label>اسم الملف</label>
                    <input type="text" value="<?php echo e($document->original_name); ?>" disabled class="custom-input" readonly>
                </div>

                <div class="form-group" style="grid-column: span 2;">
                    <label class="form-label-custom">التعليق</label>
                    <textarea name="comment" class="form-control custom-input custom-textarea auto-resize" placeholder="أدخل ملاحظاتك هنا..."><?php echo e($document->comment); ?></textarea>
                </div>
            </div>
            <div class="edit-actions">
                <button type="submit" class="btn-save-note">حفظ التعديلات</button>
                <?php if($currentUser->hasPermission('previewDocuments')): ?>
                    <?php
                        $signedUrl = URL::temporarySignedRoute('documents.preview', now()->addMinutes(60), ['path' => $document->file_path]);
                    ?>
                    <button type="button" onclick="viewDocument('<?php echo e($signedUrl); ?>', '<?php echo e($document->original_name); ?>')" class="btn btn-primary">
                        <i class="fa fa-eye"></i> معاينة المستند
                    </button>
                <?php else: ?>
                    <button type="button" class="btn-delete-sm" disabled><i class="fa fa-eye"></i>غير مصرح لك بمعاينة المستندات</button>                
                <?php endif; ?>
        </form>
        <?php if($currentUser->hasPermission('deleteDocuments')): ?>
                <form action="<?php echo e(route('documents.destroy', $document->id)); ?>" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذا المستند نهائياً؟');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;">
                        حذف المستند
                    </button>
                </form>
            </div>
        <?php else: ?>       
                <button type="button" class="btn-delete-sm" style="padding: 10px 30px !important; height: 100%; cursor: pointer;" disabled>
                    غير مصرح لك بحذف المستندات
                </button>
            </div>
        <?php endif; ?>
    </div>
    <hr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.user-layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\pfs-archive\resources\views/user/document/show.blade.php ENDPATH**/ ?>