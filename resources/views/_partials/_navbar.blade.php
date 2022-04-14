<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-lg">
    <a href="{{ route('dashboard') }}" class="navbar-brand">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('patients.create') }}"><i class="fa-solid fa-user-plus"></i> Add</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-user-pen"></i> Edit</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-users-viewfinder"></i> Studio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}"><i class="fa-solid fa-magnifying-glass"></i> Search</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-gear"></i> Setting</a>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout_action') }}" method="post">
            @csrf
            <button type="submit" class="nav-link btn-logout"><i class="fa-solid fa-right-from-bracket"></i>Logout</button>
          </form>
          {{-- <a class="nav-link" aria-current="page" href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a> --}}
        </li>
      </ul>
    </div>
  </div>
</nav>