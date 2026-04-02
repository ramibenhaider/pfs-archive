<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    @stack('styles')
</head>

<body>

  <!-- منطقة اللوقو -->
  <div class="logo-area">
     <img src="{{ asset('logo.png') }}" alt="Company Logo">
  </div>
    @if (session('success'))
    <div id="success-message" class="success-message">
        {{ session('success') }}
    </div>
  @endif
  @yield('content')
  <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
  @stack('scripts')
</body>
</html>
