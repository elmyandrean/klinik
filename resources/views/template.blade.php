<!DOCTYPE html>
<html lang="en">
@include('_partials._header')
<body class="d-flex flex-column" style="min-height: 100vh">
  @include('_partials._navbar')
  <main class="flex-shring-0 mb-4">
    @yield('content')
  </main>

  @include('_partials._footer')

  @include('_partials._scripts')
</body>
</html>