
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" type="image/png" href="{{asset('themes/admin/dist/img/AdminLTELogo.png')}}" >
  <title>Admin</title>
  @include('Admin.partials.stylesheet')
</head>
<body>
    @yield('main')
    @include('Admin.partials.scripts')
    @yield('jsAdmin')
</body>
</html>
