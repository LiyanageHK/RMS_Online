@extends('layouts.appclient')

<style>
    :root {
            --primary-red: #E7592B;
            --dark-red: #E7592B;
            --light-red: #ff6b6b;
            --dark-bg: #1a1a1a;
            --light-bg: #f9f9f9;
            --text-dark: #333;
            --text-light: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            background-color: var(--light-bg);
            line-height: 1.6;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header Styles */
        header {
            background-color: var(--text-light);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: fixed;
            width: 100%;
            z-index: 1000;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            background-color:black;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo h1 {
            font-size: 28px;
            color: var(--primary-red);
            margin-left: 10px;
        }

        .logo span {
            display: block;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
            letter-spacing: 2px;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: var(--primary-red);
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80') no-repeat center center/cover;
            height: 100vh;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--text-light);
            padding-top: 80px;
        }


        .hero-content {
            max-width: 800px;
            margin: 0 auto;
        }

        .hero h2 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            background-color: var(--primary-red);
            color: var(--text-light);
            padding: 12px 30px;
            border-radius: 30px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: var(--dark-red);
        }


    /* Footer Styles */
footer {
    background-color: var(--dark-bg);
    color: var(--text-light);
    padding: 60px 0 20px;
}

.footer-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 40px;
    margin-bottom: 40px;
}

.footer-logo {
    margin-bottom: 20px;
}

.footer-logo h2 {
    font-size: 28px;
    color: var(--text-light);
    margin-bottom: 5px;
}

.footer-logo span {
    display: block;
    font-size: 14px;
    letter-spacing: 2px;
}

.footer-about p {
    margin-bottom: 20px;
}

.footer-links h3 {
    font-size: 20px;
    margin-bottom: 20px;
    color: var(--text-light);
}

.footer-links ul {
    list-style: none;
}

.footer-links ul li {
    margin-bottom: 10px;
}

.footer-links ul li a {
    color: #ccc;
    text-decoration: none;
    transition: color 0.3s;
}

.footer-links ul li a:hover {
    color: var(--light-red);
}

.copyright {
    text-align: center;
    padding-top: 20px;
    border-top: 1px solid rgba(255,255,255,0.1);
    color: #999;
    font-size: 14px;
}

/* Mobile Menu */
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 24px;
            color: var(--primary-red);
            cursor: pointer;
        }

        /* Responsive Styles */
        @media (max-width: 768px) {
            .header-container {
                padding: 15px;
            }

            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 80px);
                background-color: var(--text-light);
                transition: left 0.3s;
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
                padding: 20px;
            }

            nav ul li {
                margin: 15px 0;
            }

            .mobile-menu-btn {
                display: block;
            }

            .hero h2 {
                font-size: 36px;
            }

            .hero p {
                font-size: 16px;
            }
        }

</style>

@section('title', 'Contact Us')

@section('content')

{{-- Hero Section --}}
<section style="position: relative; padding: 160px 20px 120px; text-align: center; background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.7)), url('{{ asset('images/contact.jpg') }}') center/cover no-repeat;">
    <div style="position: relative; z-index: 2;">
        <h1 style="font-size: 64px; font-weight: 800; color: #E7592B; letter-spacing: 2px; text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);">Contact Us</h1>
        <p style="font-size: 22px; color: #f5f5f5; margin-top: 10px;">We'd love to hear from you. Let’s talk!</p>
    </div>
</section>

{{-- Contact Form --}}
<section style="background-color: #fff; padding: 80px 20px;">
    <div class="container" style="max-width: 1000px; margin: 0 auto;">
        <h2 style="text-align: center; font-size: 42px; font-weight: 700; color: #E7592B; margin-bottom: 50px;">Get In Touch</h2>

        <form action="{{ route('client.contact.submit') }}" method="POST" style="background-color: #fdfdfd; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-width: 700px; margin: auto;">
            @csrf
            <div style="margin-bottom: 25px;">
                <input type="text" name="name" placeholder="Your Name" required
                       style="width: 100%; padding: 16px; font-size: 18px; border: 1px solid #ccc; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 25px;">
                <input type="email" name="email" placeholder="Your Email" required
                       style="width: 100%; padding: 16px; font-size: 18px; border: 1px solid #ccc; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 25px;">
                <textarea name="message" rows="6" placeholder="Your Message" required
                          style="width: 100%; padding: 16px; font-size: 18px; border: 1px solid #ccc; border-radius: 8px;"></textarea>
            </div>
            <div style="text-align: center;">
                <button type="submit"
                        style="background-color: #E7592B; color: white; padding: 14px 40px; font-size: 20px; font-weight: 600; border: none; border-radius: 40px; cursor: pointer; transition: background-color 0.3s;">
                    Send Message
                </button>
            </div>
        </form>
    </div>
</section>

{{-- Contact Info + Map --}}
<section style="background-color: #f7f7f7; padding: 80px 20px;">
    <div class="container" style="display: flex; flex-wrap: wrap; gap: 50px; justify-content: center; align-items: flex-start; max-width: 1100px; margin: auto;">
        <div style="flex: 1; min-width: 300px;">
            <h3 style="color: #E7592B; font-size: 36px; font-weight: 700; margin-bottom: 30px;">Contact Information</h3>
            <p style="font-size: 18px; color: #333; margin-bottom: 20px;"><strong>📍 Address:</strong> 123 Pizzeria Street, Pizza Town</p>
            <p style="font-size: 18px; color: #333; margin-bottom: 20px;"><strong>📞 Phone:</strong> +94 123 456 789</p>
            <p style="font-size: 18px; color: #333;"><strong>✉️ Email:</strong> contact@flamecrust.com</p>
        </div>
        <div style="flex: 1; min-width: 300px; border-radius: 12px; overflow: hidden; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);">
            <img loading="lazy" src="{{ asset('images/map-location.png') }}" alt="Location Map" style="width: 100%; display: block; transition: transform 0.3s;">
        </div>
    </div>
</section>

{{-- Feedback Section --}}
<section style="background-color: #ffffff; padding: 80px 20px;">
    <div class="container" style="max-width: 1000px; margin: auto; text-align: center;">
        <h2 style="font-size: 42px; color: #E7592B; font-weight: 700; margin-bottom: 20px;">Your Feedback Matters</h2>
        <p style="font-size: 18px; color: #555; margin-bottom: 40px;">Help us improve! Let us know your thoughts, suggestions, or compliments.</p>

        <form action="{{ route('client.feedback.submit') }}" method="POST" style="background-color: #fdfdfd; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); max-width: 700px; margin: auto;">
            @csrf
            <div style="margin-bottom: 25px;">
                <input type="text" name="name" placeholder="Your Name" required
                       style="width: 100%; padding: 16px; font-size: 18px; border: 1px solid #ccc; border-radius: 8px;">
            </div>
            <div style="margin-bottom: 25px;">
                <textarea name="feedback" rows="6" placeholder="Your Feedback" required
                          style="width: 100%; padding: 16px; font-size: 18px; border: 1px solid #ccc; border-radius: 8px;"></textarea>
            </div>
            <button type="submit"
                    style="background-color: #E7592B; color: white; padding: 14px 40px; font-size: 20px; font-weight: 600; border: none; border-radius: 40px; cursor: pointer; transition: background-color 0.3s;">
                Submit Feedback
            </button>
        </form>
    </div>
</section>

{{-- CTA Section --}}
<section style="background-color: #E7592B; color: white; padding: 80px 20px; text-align: center;">
    <div class="container">
        <h2 style="font-size: 42px; font-weight: 700; margin-bottom: 20px;">Still Have Questions?</h2>
        <p style="font-size: 18px; font-weight: 300; margin-bottom: 40px;">Reach out — we’re happy to assist you with anything!</p>
        <a href="{{ route('contact') }}" style="padding: 14px 40px; background-color: black; color: white; font-size: 18px; font-weight: 600; border-radius: 40px; text-decoration: none; transition: background-color 0.3s;">
            Contact Us Now
        </a>
    </div>
</section>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Image hover zoom
    document.querySelectorAll('section img').forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.03)';
        });
        img.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });

    // SweetAlert success popup for contact form submission
    @if(session('contact_success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: "{{ session('contact_success') }}",
            confirmButtonColor: '#E7592B'
        });
    @endif

    // SweetAlert success popup for feedback form submission
    @if(session('feedback_success'))
        Swal.fire({
            icon: 'success',
            title: 'Thank You!',
            text: "{{ session('feedback_success') }}",
            confirmButtonColor: '#E7592B'
        });
    @endif
</script>
@endsection

