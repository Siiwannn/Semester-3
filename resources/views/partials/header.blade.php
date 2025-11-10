<link rel="icon" href="{{ asset('assets/image/upam.png') }}" sizes="32x32" type="image/png">
<link rel="icon" href="{{ asset('assets/image/upam.png') }}" sizes="192x192" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('assets/image/upam.png') }}">
<header>
  <nav class="navbar">
    {{-- LOGO --}}
    <div class="logo">
      <a href="/">
        <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" />
      </a>
    </div>

    {{-- MENU --}}
    <ul id="nav-links">
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/contact">Contact</a></li>

      {{-- DROPDOWN MAHASISWA --}}
      <li class="dropdown">
        <button class="dropdown-toggle">
          Mahasiswa <span class="arrow"></span>
        </button>
        <ul class="dropdown-menu">
          <li><a href="/mahasiswa">Lihat Mahasiswa</a></li>
          @auth
            <li><a href="/admin/mahasiswa">CRUD Mahasiswa</a></li>
          @endauth
        </ul>
      </li>

      <li><a href="/fakultas">Fakultas</a></li>

      {{-- USER --}}
      @auth
        <li class="dropdown">
          <button class="dropdown-toggle user-name">
            <i class="bi bi-person-circle"></i>
            {{ Auth::user()->name }} <span class="arrow"></span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
              </form>
            </li>
          </ul>
        </li>
      @else
        <li><a href="{{ route('login') }}">Login</a></li>
      @endauth
    </ul>
  </nav>
</header>

{{-- SCRIPT --}}
<script>
  document.addEventListener("DOMContentLoaded", () => {
    const dropdowns = document.querySelectorAll(".dropdown");

    dropdowns.forEach((dropdown) => {
      const toggle = dropdown.querySelector(".dropdown-toggle");
      const menu = dropdown.querySelector(".dropdown-menu");

      toggle.addEventListener("click", (e) => {
        e.stopPropagation();
        menu.classList.toggle("show");

        // Tutup dropdown lain
        dropdowns.forEach((other) => {
          if (other !== dropdown) other.querySelector(".dropdown-menu").classList.remove("show");
        });
      });
    });

    // Klik di luar -> tutup semua
    document.addEventListener("click", () => {
      document.querySelectorAll(".dropdown-menu").forEach((menu) => menu.classList.remove("show"));
    });
  });
</script>