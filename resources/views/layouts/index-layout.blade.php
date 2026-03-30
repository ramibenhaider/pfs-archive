<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href=@yield('styles')>
</head>

<body>

  <!-- منطقة اللوقو -->
  <div class="logo-area">
     <img src="{{ asset('logo.png') }}" alt="Company Logo">
  </div>
  @yield('content')
</body>
</html>
