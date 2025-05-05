
<style>
      header {
      width: 100vw;
      background: #000;
      margin-left: calc(50% - 50vw);
      margin-right: calc(50% - 50vw);
  }
  .header-container {
      max-width: 100%; /* or your preferred max width */
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 15px 40px;
  }
</style>
<header class="header-container">
    <div class="container header-container">
        <div class="logo">
            <img src="{{ asset('uploads/logo/logo2.png') }}" alt="Flame & Crust Pizzeria Logo" class="logo" style="width: 100px; height: auto;">
            <h1>FLAME & CRUST PIZZERIA</h1>
       
        </div>
        <button class="mobile-menu-btn" id="mobileMenuBtn">
            <i class="fas fa-bars"></i>
        </button>
        <nav id="mainNav">
            <ul>
                <li><a href="{{ route('welcome') }}" @if(Request::routeIs('welcome')) class="active" @endif>HOME</a></li>
                <li><a href="{{ route('menu') }}" @if(Request::routeIs('menu')) class="active" @endif>MENU</a></li>
                <li><a href="{{ route('about') }}" @if(Request::routeIs('about')) class="active" @endif>ABOUT US</a></li>
                <li><a href="{{ route('contact') }}" @if(Request::routeIs('contact')) class="active" @endif>CONTACT US</a></li>
               
                    <li><a href="{{ route('login') }}">LOGIN</a></li>
                
            </ul>
        </nav>
    </div>
</header>

<script>
    // Mobile Menu Toggle
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mainNav = document.getElementById('mainNav');

    mobileMenuBtn.addEventListener('click', () => {
        mainNav.classList.toggle('active');
    });

    // Close menu when clicking on a link
    const navLinks = document.querySelectorAll('nav ul li a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            mainNav.classList.remove('active');
        });
    });
</script>