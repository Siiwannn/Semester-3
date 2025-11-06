<header>
    <nav class="navbar">
      <div class="logo">
        <a href="/">
          <img src="{{ asset('assets/image/logo.png') }}" alt="Logo" style="height: 35px; vertical-align: middle;">
        </a>
      </div>
      <ul id="nav-links">
        <li><a href="/">Home</a></li>
        <li><a href="/about">About</a></li>
        <li><a href="/contact">Contact</a></li>
  
        <!-- Dropdown Mahasiswa -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle">Mahasiswa <span class="arrow"></span></a>
          <ul class="dropdown-menu">
            <li><a href="/mahasiswa">Lihat Mahasiswa</a></li>
            <li><a href="/admin/mahasiswa">CRUD Mahasiswa</a></li>
          </ul>
        </li>
  
        <li><a href="/fakultas">Fakultas</a></li>
      </ul>
    </nav>
  </header>

<script>
    const toggle = document.getElementById('menu-toggle');
    const navLinks = document.getElementById('nav-links');

    toggle.addEventListener('click', () => {
        toggle.classList.toggle('open');
        navLinks.classList.toggle('active');
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
      const dropdown = document.querySelector('.dropdown');
      const toggle = dropdown.querySelector('.dropdown-toggle');
  
      toggle.addEventListener('click', (e) => {
        e.preventDefault();
        dropdown.classList.toggle('open');
      });
  
      // Tutup dropdown saat klik di luar
      document.addEventListener('click', (e) => {
        if (!dropdown.contains(e.target)) {
          dropdown.classList.remove('open');
        }
      });
    });
  </script>