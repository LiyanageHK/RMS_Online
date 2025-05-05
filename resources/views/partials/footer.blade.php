<footer>
    <div class="container" style="max-width: 100%;">
        <div class="footer-container" style="gap: 156px;">
            <div class="footer-about" style="padding-left: -50px;">
                <div style="text-align: center;" >
                    <img src="{{ asset('uploads/logo/logo2.png') }}" alt="Flame & Crust Pizzeria Logo" class="logo" style="width: 100px; height: auto;padding-left: 0px;margin-left: 100px;">
                </div>
                <div class="footer-logo">
                   
                    <h2 style="color:#E7592B">FLAME & CRUST PIZZERIA</h2>
                </div>
                <p>Deliciously delivered! We’re a delivery-only pizzeria powered by smart tech to bring you fresh flavors, fast service, and seamless online ordering.</p>
            </div>
            <div class="footer-links" style="margin-top: 100px;padding-left: 90px;">
                <h3 style="color: #E7592B">Quick Links</h3>
                <ul>
                    <li><a href="{{ route('welcome') }}" >Home</a></li>
                    <li><a href="{{ route('menu') }}">Menu</a></li>
                    <li><a href="{{ route('about') }}">About Us</a></li>
                    <li><a href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>
            <div class="footer-links"style="margin-top: 100px;">
                <h3 style="color: #E7592B">Contact Us</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> No. 17, Oven Lane, Colombo 07, Sri Lanka</li>
                    <li><i class="fas fa-phone"></i>011-2845965</li>
                    <li><i class="fas fa-envelope"></i> info@flameandcrustpizzeria.com</li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>&copy; {{ date('Y') }} Flame & Crust Pizzeria . All Rights Reserved.</p>
        </div>
    </div>
</footer>