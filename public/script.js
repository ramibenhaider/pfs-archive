// فتح النوافذ
document.querySelectorAll(".open-modal").forEach(btn => {
    btn.addEventListener("click", () => {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "block";
    });
});

// إغلاق النافذة
const closeBtn = document.querySelector(".close");
if (closeBtn) {
    closeBtn.onclick = function () {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "none";
    };
}

// إضافة ملف
const fileInput = document.querySelector(".add-file-btn input");
if (fileInput) {
    fileInput.addEventListener("change", function () {
        let file = this.files[0];
        if (!file) return;

        let preview = document.querySelector(".file-preview");
        if (preview) {
            preview.innerHTML = `
                <p>📄 ${file.name}</p>
                <textarea placeholder="اكتب تعليقاً حول الملف..." style="width:100%; margin-top:10px;"></textarea>
            `;
        }
    });
}

// زر الحفظ داخل النافذة
const saveBtn = document.querySelector(".modal-save");
if (saveBtn) {
    saveBtn.onclick = function () {
        const modal = document.getElementById("modal-template");
        if (modal) modal.style.display = "none";
    };
}

// زر الحذف داخل النافذة
const deleteBtn = document.querySelector(".modal-delete");
if (deleteBtn) {
    deleteBtn.onclick = function () {
        const preview = document.querySelector(".file-preview");
        if (preview) preview.innerHTML = "";
        alert("تم حذف الملف");
    };
}

// إخفاء رسالة النجاح
document.addEventListener("DOMContentLoaded", function () {
    const msg = document.getElementById("success-message");

    if (msg) {
        setTimeout(() => {
            msg.style.transition = "opacity 0.5s ease";
            msg.style.opacity = "0";

            setTimeout(() => {
                msg.remove();
            }, 500);
        }, 3000);
    }
});
