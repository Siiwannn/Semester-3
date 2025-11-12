
<!-- Favicon -->
<link rel="icon" href="{{ asset('assets/image/upam.png') }}" sizes="32x32" type="image/png">
<link rel="icon" href="{{ asset('assets/image/upam.png') }}" sizes="192x192" type="image/png">
<link rel="apple-touch-icon" href="{{ asset('assets/image/upam.png') }}">

<!-- Header -->
<header>
  <nav class="navbar">
    <!-- Left Section -->
    <div class="nav-left">
      <!-- Hamburger Menu (Mobile) -->
      <button class="hamburger" id="hamburger" aria-label="Toggle menu">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <!-- Logo -->
      <div class="logo">
        <a href="/">
          <img src="{{ asset('assets/image/logo.png') }}" alt="Logo UPAM">
        </a>
      </div>

      <!-- Navigation Links -->
      <ul id="nav-links">
        <li>
          <a href="/" class="{{ Request::is('/') ? 'active' : '' }}">Home</a>
        </li>
        <li>
          <a href="/about" class="{{ Request::is('about') ? 'active' : '' }}">About</a>
        </li>
        <li>
          <a href="/contact" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a>
        </li>

        <!-- Dropdown: Mahasiswa -->
        <li class="dropdown">
          <button class="dropdown-toggle" aria-expanded="false">
            Mahasiswa
            <!--<i class="bi bi-chevron-down"></i> -->
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="/mahasiswa">Lihat Mahasiswa</a>
            </li>
            @auth
            <li>
              <a href="/admin/mahasiswa">CRUD Mahasiswa</a>
            </li>
            @endauth
          </ul>
        </li>

        <li>
          <a href="/fakultas" class="{{ Request::is('fakultas') ? 'active' : '' }}">Fakultas</a>
        </li>
      </ul>
    </div>

    <!-- Right Section: User/Login -->
    <div class="nav-right">
      @auth
        <!-- User Dropdown -->
        <div class="dropdown user-dropdown">
          <button class="dropdown-toggle user-name" aria-expanded="false">
            <i class="bi bi-person-circle"></i>
            <span>{{ Auth::user()->name }}</span>
          </button>
          <ul class="dropdown-menu">
            <li>
              <a href="/profile">
                <i class="bi bi-person"></i> Profile
              </a>
            </li>
            <li>
              <a href="/settings">
                <i class="bi bi-gear"></i> Settings
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <form action="/logout" method="POST" id="logout-form">
                @csrf
                <button type="submit" class="logout-btn">
                  <i class="bi bi-box-arrow-right"></i> Logout
                </button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <!-- Login Button -->
        <a href="{{ route('login') }}" class="login-btn">
          <i class="bi bi-box-arrow-in-right"></i> Login
        </a>
      @endauth
    </div>
  </nav>
</header>

<!-- JavaScript -->
<script>
document.addEventListener("DOMContentLoaded", function() {
  
  // ====================================
  // DROPDOWN FUNCTIONALITY
  // ====================================
  
  const dropdowns = document.querySelectorAll(".dropdown");
  
  dropdowns.forEach(dropdown => {
    const toggle = dropdown.querySelector(".dropdown-toggle");
    const menu = dropdown.querySelector(".dropdown-menu");
    
    if (!toggle || !menu) return;
    
    // Toggle dropdown on click
    toggle.addEventListener("click", function(e) {
      e.preventDefault();
      e.stopPropagation();
      
      const isOpen = menu.classList.contains("show");
      
      // Close all other dropdowns
      closeAllDropdowns();
      
      // Toggle current dropdown
      if (!isOpen) {
        menu.classList.add("show");
        toggle.setAttribute("aria-expanded", "true");
      }
    });
  });
  
  // Close all dropdowns
  function closeAllDropdowns() {
    document.querySelectorAll(".dropdown-menu").forEach(menu => {
      menu.classList.remove("show");
    });
    
    document.querySelectorAll(".dropdown-toggle").forEach(toggle => {
      toggle.setAttribute("aria-expanded", "false");
    });
  }
  
  // Close dropdowns when clicking outside
  document.addEventListener("click", function(e) {
    if (!e.target.closest(".dropdown")) {
      closeAllDropdowns();
    }
  });
  
  // Close dropdowns on ESC key
  document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") {
      closeAllDropdowns();
    }
  });
  
  
  // ====================================
  // HAMBURGER MENU (MOBILE)
  // ====================================
  
  const hamburger = document.getElementById("hamburger");
  const navLinks = document.getElementById("nav-links");
  
  if (hamburger && navLinks) {
    
    // Toggle mobile menu
    hamburger.addEventListener("click", function(e) {
      e.stopPropagation();
      navLinks.classList.toggle("show");
      hamburger.classList.toggle("active");
      
      // Toggle aria-label
      const isOpen = navLinks.classList.contains("show");
      hamburger.setAttribute("aria-label", isOpen ? "Close menu" : "Open menu");
      
      // Prevent body scroll when menu is open
      document.body.style.overflow = isOpen ? "hidden" : "";
    });
    
    // Close mobile menu when clicking outside
    document.addEventListener("click", function(e) {
      if (!e.target.closest(".nav-left") && navLinks.classList.contains("show")) {
        navLinks.classList.remove("show");
        hamburger.classList.remove("active");
        document.body.style.overflow = "";
      }
    });
    
    // Close mobile menu on window resize
    window.addEventListener("resize", function() {
      if (window.innerWidth > 768 && navLinks.classList.contains("show")) {
        navLinks.classList.remove("show");
        hamburger.classList.remove("active");
        document.body.style.overflow = "";
      }
    });
  }
  
});
</script>
