@extends('layouts.client')

@section('title', 'Contact Us')

@section('content')

{{-- Hero Section --}}
<section style="position: relative; padding: 140px 20px; text-align: center; background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(0,0,0,0.7)), url('{{ asset('images/contact-bg.jpg') }}') center/cover no-repeat;">
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
            <img src="{{ asset('images/map-location.png') }}" alt="Location Map" style="width: 100%; display: block; transition: transform 0.3s;">
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
        <a href="{{ route('client.contact') }}" style="padding: 14px 40px; background-color: black; color: white; font-size: 18px; font-weight: 600; border-radius: 40px; text-decoration: none; transition: background-color 0.3s;">
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

