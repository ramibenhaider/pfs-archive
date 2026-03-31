// ======== Modal ========
document.querySelectorAll(".open-modal").forEach(btn => {
    btn.addEventListener("click", () => {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "block";
    });
});

const closeBtn = document.querySelector(".close");
if (closeBtn) {
    closeBtn.onclick = function () {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "none";
    };
}

const saveBtn = document.querySelector(".modal-save");
if (saveBtn) {
    saveBtn.onclick = function () {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "none";
    };
}

const deleteBtn = document.querySelector(".modal-delete");
if (deleteBtn) {
    deleteBtn.onclick = function () {
        const preview = document.querySelector(".file-preview");
        if (preview) preview.innerHTML = "";
        alert("تم حذف الملف");
    };
}

// ======== رسالة النجاح ========
document.addEventListener("DOMContentLoaded", function () {
    const msg = document.getElementById("success-message");
    if (msg) {
        setTimeout(() => {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = "0";
            setTimeout(() => msg.remove(), 500);
        }, 3000);
    }
});

// ======== رفع الملفات ========
const fileInput   = document.getElementById('fileInput');
const hiddenFiles = document.getElementById('hiddenFiles');
const fileList    = document.getElementById('fileList');

let allFiles = new DataTransfer();

// عند اختيار ملفات جديدة
if (fileInput) {
    fileInput.addEventListener('change', function () {

        Array.from(this.files).forEach(file => {
            const exists = Array.from(allFiles.files)
                .some(f => f.name === file.name && f.size === file.size);

            if (!exists) {
                allFiles.items.add(file);
            }
        });

        hiddenFiles.files = allFiles.files;
        updateList();
        this.value = '';
    });
}

// تحديث عرض الملفات + التعليقات + زر الحذف
function updateList() {

    // 1) حفظ التعليقات القديمة
    const oldComments = Array.from(
        document.querySelectorAll('input[name="comments[]"]')
    ).map(input => input.value);

    fileList.innerHTML = '';

    // 2) إعادة رسم القائمة
    Array.from(allFiles.files).forEach((file, index) => {

        const row = document.createElement('div');
        row.style.display = "flex";
        row.style.alignItems = "center";
        row.style.gap = "10px";
        row.style.marginBottom = "8px";

        row.innerHTML = `
            <span style="min-width:150px">${file.name}</span>

            <input type="text" name="comments[]" 
                   placeholder="تعليق..." 
                   style="flex:1; padding:4px">

            <button type="button" onclick="removeFile(${index})">
                حذف
            </button>
        `;

        fileList.appendChild(row);
    });

    // 3) إعادة التعليقات القديمة في أماكنها
    const newCommentInputs = document.querySelectorAll('input[name="comments[]"]');

    newCommentInputs.forEach((input, i) => {
        if (oldComments[i] !== undefined) {
            input.value = oldComments[i];
        }
    });
}

// حذف ملف من القائمة
function removeFile(index) {
    const newFiles = new DataTransfer();

    Array.from(allFiles.files).forEach((file, i) => {
        if (i !== index) newFiles.items.add(file);
    });

    allFiles = newFiles;
    hiddenFiles.files = allFiles.files;
    updateList();
}

// ======== TomSelect ========
if (document.getElementById('employee_id')) {
    new TomSelect('#employee_id', {
        placeholder: 'ابحث عن موظف...',
    });
}

if (document.getElementById('employee_id_note')) {
    new TomSelect('#employee_id_note', {
        placeholder: 'ابحث عن موظف...',
    });
}