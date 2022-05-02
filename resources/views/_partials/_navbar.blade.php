<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <div class="container-lg">
    <a href="{{ route('dashboard') }}" class="navbar-brand">
    <img src="{{ url('images/logo.gif') }}" alt="Logo" height="50">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"  data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('dashboard') }}"><i class="fa-solid fa-home"></i> Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('patients/*') ? 'active' : '' }}" aria-current="page" href="{{ route('patients.create') }}"><i class="fa-solid fa-user-plus"></i> Add</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" aria-current="page" href="#" id="settingDropdown" role="button" data-bs-toggle="dropdown"><i class="fa-solid fa-gear"></i> Setting</a>
          <ul class="dropdown-menu" aria-labelledby="settingDropdown">
            <li><a href="{{ route('actions.index') }}" class="dropdown-item">Action / Treatment Management</a></li>
            <li><a href="#" class="dropdown-item">Diagnosis Management</a></li>
          </ul>
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