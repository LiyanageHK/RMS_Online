<style>
    footer {
        background-color: var(--dark-bg);
        color: var(--text-light);
        padding: 60px 0 30px;
        font-family: 'Segoe UI', sans-serif;
    }

    .footer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-start;
        align-items: flex-start;
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 10px 0 10px;
    }

    .footer-about {
        flex: 1.6;
        min-width: 280px;
        padding-right: 30px;
        margin-bottom: 20px;
        margin-left: -50px;
    }

    .footer-about img {
    width: 100px; 
    margin-bottom: 8px; 
    margin-top: -50px;  
}

    .footer-about h2 {
        font-size: 20px;
        font-weight: bold;
        color: var(--primary-orange);
        margin: 0 0 12px;
    }

    .footer-about p {
        font-size: 14.5px;
        line-height: 1.7;
        text-align: justify;
        margin: 0;
        max-width: 80%;
    }

    .footer-section {
        flex: 1;
        min-width: 220px;
        margin-left: -50px;
    }

    .footer-section h3 {
        color: var(--primary-orange);
        font-size: 16px;
        margin-bottom: 14px;
    }

    .footer-section ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-section ul li {
        font-size: 14px;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .footer-section ul li a {
        color: var(--text-light);
        text-decoration: none;
        transition: color 0.3s;
    }

    .footer-section ul li a:hover {
        color: var(--primary-orange);
    }

    .footer-section ul li i {
        color: var(--primary-orange);
        margin-right: 10px;
        min-width: 18px;
        text-align: center;
    }

    .copyright {
        text-align: center;
        margin-top: 50px;
        font-size: 14px;
        color: #aaa;
    }

    @media (max-width: 768px) {
        .footer-container {
            flex-direction: column;
            gap: 30px;
        }

        .footer-about,
        .footer-section {
            width: 100%;
        }

        .footer-section ul li {
            align-items: flex-start;
        }
    }
</style>

<footer>
    <div class="footer-container">
        <!-- About -->
        <div class="footer-about">
            <img src="{{ asset('images/Logo.png') }}" alt="Flame & Crust Pizzeria Logo">
            <h2>FLAME & CRUST PIZZERIA</h2>
            <p>
                Deliciously delivered! We're a delivery-only pizzeria powered by smart tech
                to bring you fresh flavors, fast service, and seamless online ordering.
            </p>
        </div>

        <!-- Quick Links -->
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ route('client.home') }}">Home</a></li>
                <li><a href="{{ route('client.menu') }}">Menu</a></li>
                <li><a href="{{ route('client.about') }}">About Us</a></li>
                <li><a href="{{ route('client.contact') }}">Contact Us</a></li>
            </ul>
        </div>

        <!-- Contact Info -->
        <div class="footer-section">
            <h3>Contact Us</h3>
            <ul>
                <li><i class="fas fa-map-marker-alt"></i>No. 17, Oven Lane, Colombo 07, Sri Lanka</li>
                <li><i class="fas fa-phone"></i>011-2845965</li>
                <li><i class="fas fa-envelope"></i>info@flameandcrustpizzeria.com</li>
            </ul>
        </div>
    </div>

    <div class="copyright">
        <p>&copy; {{ date('Y') }} Flame & Crust Pizzeria. All Rights Reserved.</p>
    </div>
</footer>
