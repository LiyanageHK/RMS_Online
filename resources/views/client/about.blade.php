@extends('layouts.client')

@section('title', 'About Us')

@section('content')

{{-- Hero Section --}}
<section style="position: relative; padding: 120px 20px; color: white; text-align: center; background: url('{{ asset('images/bg-texture.jpg') }}') center/cover no-repeat;">
    <div style="position: absolute; inset: 0; background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
    
    <div style="position: relative; z-index: 2;">
        <h1 style="font-size: 58px; font-weight: 800; color: #E7592B; letter-spacing: 2px;">About Us</h1>
        <p style="font-size: 22px; font-weight: 300; margin-top: 10px; line-height: 1.6;">Where crust meets passion, and flavor fires up your day.</p>
    </div>
</section>

{{-- Our Story --}}
<section style="background-color: #fff; padding: 100px 20px;">
    <div class="container" style="display: flex; justify-content: space-between; gap: 40px; align-items: center;">
        <div style="flex: 1; min-width: 300px; position: relative;" class="story-image fadeInElement">
            <img src="{{ asset('images/Pizza.jpg') }}" alt="Our Story" style="width: 100%; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15); transition: transform 0.3s ease;">
            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-weight: 600; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Our Journey, Your Flavor</div>
        </div>
        <div style="flex: 1; min-width: 300px;">
            <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 30px;">Our Story</h2>
            <p style="font-size: 18px; color: #444; line-height: 1.8; font-weight: 300;">Flame & Crust Pizzeria was born from a love of authentic, oven-fired pizzas. From humble beginnings to a community favorite, we’ve always believed in serving honest food, made fresh, and delivered fast. Our story is one of passion, growth, and flavor.</p>
        </div>
    </div>
</section>

{{-- Our Mission --}}
<section style="background-color: #f9f9f9; padding: 100px 20px;">
    <div class="container" style="display: flex; justify-content: space-between; gap: 40px; align-items: center;">
        <div style="flex: 1; min-width: 300px;">
            <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 30px;">Our Mission</h2>
            <p style="font-size: 18px; color: #444; line-height: 1.8; font-weight: 300;">Our mission is to redefine pizza delivery with fast, fresh, and flavorful pies. We blend tradition with technology to ensure every order is crafted with care and delivered with excellence. Fast, fresh, and full of flavor — that’s what we promise!</p>
        </div>
        <div style="flex: 1; min-width: 300px; position: relative;" class="mission-image fadeInElement">
            <img src="{{ asset('images/mission.webp') }}" alt="Our Mission" style="width: 100%; border-radius: 20px; box-shadow: 0 12px 32px rgba(0, 0, 0, 0.15);">
            <div style="position: absolute; bottom: 20px; left: 20px; color: white; font-weight: 600; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);">Pizza with Purpose</div>
        </div>
    </div>
</section>

{{-- Our Values --}}
<section style="background-color: #fff; padding: 100px 20px;">
    <div class="container" style="max-width: 900px; margin: 0 auto; text-align: center;">
        <h2 style="color: #E7592B; font-size: 40px; font-weight: 700; margin-bottom: 40px;">Our Core Values</h2>
        <ul style="font-size: 20px; color: #444; line-height: 2.4; text-align: left; padding-left: 30px;">
            <li style="margin-bottom: 20px;"><strong> Quality</strong> – We use only the freshest, highest-quality ingredients, ensuring every slice is a masterpiece.</li>
            <li style="margin-bottom: 20px;"><strong> Customer Satisfaction</strong> – Your happiness is our priority, every slice, every time. We aim to exceed your expectations.</li>
            <li style="margin-bottom: 20px;"><strong> Innovation</strong> – We’re constantly exploring bold new flavors and smarter ways to deliver your pizza faster.</li>
            <li style="margin-bottom: 20px;"><strong> Integrity</strong> – We do business the right way, with honesty and heart. Trust is key to our recipe.</li>
        </ul>
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

{{-- Scroll Animation Scripts --}}
<script>
    const fadeInElements = document.querySelectorAll('.fadeInElement');

    const fadeInOnScroll = (element) => {
        const rect = element.getBoundingClientRect();
        if (rect.top < window.innerHeight && rect.bottom >= 0) {
            element.classList.add('fadeIn');
        }
    };

    window.addEventListener('scroll', () => {
        fadeInElements.forEach(element => fadeInOnScroll(element));
    });

    // Adding hover effect on images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('mouseenter', () => {
            img.style.transform = 'scale(1.05)';
            img.style.transition = 'transform 0.3s ease';
        });
        img.addEventListener('mouseleave', () => {
            img.style.transform = 'scale(1)';
        });
    });
</script>

<style>
    .fadeInElement {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.5s ease, transform 0.5s ease;
    }

    .fadeIn {
        opacity: 1;
        transform: translateY(0);
    }

    img {
        opacity: 1;
    }
</style>

@endsection
