<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إدارة المستخدمين والصلاحيات</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* الإعدادات العامة */
body {
    margin: 0;
    padding: 0;
    font-family: "Cairo", sans-serif;
    background-color: #e8e8e8 !important;
    display: flex;
}

/* القائمة الجانبية الثابتة */
.sidebar {
    width: 260px;
    height: 100vh;
    background-color: #3B524A; /* لونك المعتمد */
    position: fixed;
    right: 0;
    top: 0;
    color: white;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    box-shadow: -2px 0 10px rgba(0,0,0,0.1);
}

.sidebar-header {
    padding: 30px 20px;
    text-align: center;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.admin-avatar {
    font-size: 40px;
    margin-bottom: 10px;
}

.admin-name {
    font-weight: bold;
    font-size: 18px;
    display: block;
}

/* روابط التنقل */
.sidebar-nav {
    flex: 1; /* تأخذ باقي المساحة وتدفع الفوتر للأسفل */
    padding-top: 20px;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 25px;
    color: rgba(255,255,255,0.8);
    text-decoration: none;
    transition: 0.3s;
    font-weight: 600;
}

.sidebar-link:hover {
    background-color: #497033;
    color: white;
}

.sidebar-link.active {
    background-color: #e8e8e8; /* نفس لون خلفية الـ body */
    color: #3B524A;
    border-radius: 30px 0 0 30px; /* انحناء جهة المحتوى */
    margin-right: 0;
}

/* زر تسجيل الخروج */
.sidebar-footer {
    padding: 20px 0;
    border-top: 1px solid rgba(255,255,255,0.1);
}

.logout-link {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 15px 25px;
    color: #ffbaba; /* لون أحمر فاتح هادئ */
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
}

.logout-link:hover {
    background-color: #D20E00; /* لون الحذف عندك */
    color: white;
}

/* المحتوى الرئيسي */
.main-content {
    flex: 1;
    margin-right: 260px; /* نفس عرض القائمة */
    padding: 30px;
    min-height: 100vh;
}

/* تنسيق الكروت والجداول (من كودك الأصلي) */
.container-createEmployee {
    max-width: 1000px;
    margin: 0 auto;
}

.section-title {
    color: #3B524A;
    margin-bottom: 25px;
    font-size: 24px;
    border-right: 5px solid #3B524A;
    padding-right: 15px;
}

.note-section-card {
    background: #fff;
    border-radius: 15px;
    padding: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border-top: 4px solid #3B524A;
}

.d-flex-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.section-header {
    color: #3B524A;
    font-weight: bold;
    margin: 0;
}

/* الأزرار والشارات */
.btn-main {
    background-color: #3B524A !important;
    color: white !important;
    border-radius: 8px !important;
    padding: 8px 20px !important;
    border: none !important;
    cursor: pointer;
    font-family: "Cairo";
}

.custom-table {
    width: 100%;
    border-collapse: collapse;
}

.custom-table th {
    background-color: #3B524A;
    color: white;
    padding: 12px;
}

.custom-table td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #eee;
}

.badge {
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    color: white;
}

.badge-active { background-color: #28a745; }
.badge-inactive { background-color: #D20E00; }

.btn-edit-sm { background-color: #ffc107; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }
.btn-delete-sm { background-color: #D20E00; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; }

/* Responsive */
@media (max-width: 768px) {
    .sidebar { width: 70px; }
    .sidebar .text, .sidebar-header .admin-name { display: none; }
    .main-content { margin-right: 70px; }
    .sidebar-link, .logout-link { justify-content: center; padding: 15px 0; }
}
    </style>
</head>
<body>

    <div class="sidebar">
        <div class="sidebar-header">
            <div class="admin-avatar">👤</div>
            <span class="admin-name">الأدمن</span>
        </div>

        <nav class="sidebar-nav">
            <a href="#" class="sidebar-link">
                <span class="icon">📊</span> 
                <span class="text">البيانات المدخلة</span>
            </a>
            <a href="#" class="sidebar-link active">
                <span class="icon">🔐</span> 
                <span class="text">المستخدمين والصلاحيات</span>
            </a>
        </nav>

        <div class="sidebar-footer">
            <a href="#" class="logout-link">
                <span class="icon">🚪</span> 
                <span class="text">تسجيل الخروج</span>
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="container-createEmployee">
            <h2 class="section-title">إدارة المستخدمين والصلاحيات</h2>

            <div class="note-section-card">
                <div class="d-flex-header">
                    <h5 class="section-header">قائمة المستخدمين في النظام</h5>
                    <button class="btn-main">+ إضافة مستخدم</button>
                </div>

                <div class="table-responsive">
                    <table class="custom-table">
                        <thead>
                            <tr>
                                <th>اسم المستخدم</th>
                                <th>الصلاحية</th>
                                <th>الحالة</th>
                                <th>الإجراءات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>أحمد محمد علي</td>
                                <td>مدير نظام (Admin)</td>
                                <td><span class="badge badge-active">نشط</span></td>
                                <td>
                                    <button class="btn-edit-sm">تعديل</button>
                                    <button class="btn-delete-sm">حذف</button>
                                </td>
                            </tr>
                            <tr>
                                <td>سارة إبراهيم</td>
                                <td>مدخل بيانات</td>
                                <td><span class="badge badge-inactive">غير نشط</span></td>
                                <td>
                                    <button class="btn-edit-sm">تعديل</button>
                                    <button class="btn-delete-sm">حذف</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>
</html><?php /**PATH C:\xampp\htdocs\archive-nags\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>