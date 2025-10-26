<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tindahan ni Aling Dadai</title>

  <!-- ✅ Added Google Font for Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>
/* 🌿 Global Styles */
body {
  margin: 0;
  font-family: 'Poppins', sans-serif; /* ✅ Added Poppins font */
  background: linear-gradient(to bottom right, #e0f2df, #ffffff);
  color: #2e2e2e;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  scroll-behavior: smooth;
}

/* ✅ Light typography polish for clarity */
.header nav a,
.carousel-title,
.food-name,
.food-desc,
.subtitle,
.footer,
.location-section h2,
.location-section p {
  font-family: 'Poppins', sans-serif;
  letter-spacing: 0.3px;
}

.food-name {
  font-weight: 600;
}

.food-desc {
  font-weight: 400;
}

.food-card .btn {
  font-weight: 600;
}

a {
  text-decoration: none;
  color: inherit;
}

* {
  transition: all 0.3s ease;
}

/* 🌿 Header */
.header {
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 1000;
  background: rgba(79, 111, 82, 0.85);
  color: #fff;
  padding: 1rem 2rem;
  display: flex;
  align-items: center;
  justify-content: space-between;
  backdrop-filter: blur(8px);
  transition: all 0.3s ease;
}

.header img.logo {
  width: 70px;
  height: auto;
  border-radius: 16px;
  box-shadow: 0 2px 8px rgba(90,109,60,0.1);
}

/* Center nav */
.header nav {
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
  gap: 2rem;
}

.header nav a {
  color: #fff;
  font-weight: bold;
  font-size: 1.05rem;
  padding: 0.5rem 1rem;
  border-radius: 24px;
}

.header nav a:hover {
  background: rgba(255,255,255,0.1);
  color: #ffe082;
}

/* 🌿 Hero Carousel */
.hero-carousel {
  position: relative;
  width: 100%;
  height: 100vh;
  overflow: hidden;
}

.carousel-slide {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-size: cover;
  background-position: center;
  opacity: 0;
  transition: opacity 1s ease;
}

.carousel-slide.active {
  opacity: 1;
  animation: zoomIn 10s ease-in-out infinite alternate;
}

@keyframes zoomIn {
  from { transform: scale(1); }
  to { transform: scale(1.05); }
}

.carousel-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.35);
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  flex-direction: column;
  color: #fff;
  padding: 0 1rem;
  animation: fadeIn 1.5s ease-out;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px); }
  to { opacity: 1; transform: translateY(0); }
}

.carousel-title {
  font-size: 3rem;
  font-weight: bold;
  margin-bottom: 1rem;
  letter-spacing: 2px;
  text-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

.carousel-btn {
  background: linear-gradient(135deg, #4f6f52, #739e73);
  color: #fff;
  padding: 0.8rem 2rem;
  font-size: 1.2rem;
  border: none;
  border-radius: 30px;
  margin-top: 1rem;
  cursor: pointer;
   display: inline-block;
  text-decoration: none;
}

.carousel-btn:hover {
  background: #3e5741;
  transform: scale(1.05);
  color: #fff; /* Ensures text stays white on hover */
}


/* Carousel arrows */
.carousel-control {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0,0,0,0.45);
  color: #fff;
  border: none;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: background 0.3s;
  z-index: 2;
}

.carousel-control:hover {
  background: rgba(0,0,0,0.6);
}

#prevBtn { left: 30px; }
#nextBtn { right: 30px; }

/* 🌿 Main Content */
.main-content {
  max-width: 1000px;
  margin: 4rem auto;
  padding: 2.5rem;
  background: rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(10px);
  border-radius: 24px;
  box-shadow: 0 4px 24px rgba(90,109,60,0.1);
}

.title {
  text-align: center;
  font-size: 2.3rem;
  font-weight: bold;
  color: #4f6f52;
  margin-bottom: 1.2rem;
}

.subtitle {
  text-align: center;
  font-size: 1.2rem;
  font-weight: 600;
  color: #6b5e3c;
  margin-bottom: 2rem;
}

/* 🌿 Horizontal Food Cards */
.food-section {
  display: flex;
  flex-direction: column;
  gap: 2rem;
  margin-bottom: 2rem;
}

.food-card {
  display: flex;
  align-items: center;
  gap: 2rem;
  background: rgba(255, 255, 255, 0.4);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(255, 255, 255, 0.5);
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 4px 16px rgba(79, 111, 82, 0.15);
  transition: opacity 0.6s ease, transform 0.6s ease;
  transform: translateY(30px);
  opacity: 0;
}

.food-card.show {
  opacity: 1;
  transform: translateY(0);
}

.food-card:hover {
  transform: translateY(-5px) scale(1.02);
  box-shadow: 0 8px 28px rgba(79, 111, 82, 0.25);
}

.food-card img {
  width: 280px;
  height: 200px;
  object-fit: cover;
  border-radius: 16px;
  flex-shrink: 0;
}

.food-info {
  flex: 1;
  text-align: left;
}

.food-name {
  font-size: 1.6rem;
  color: #4f6f52;
  margin-bottom: 0.5rem;
}

.food-desc {
  font-size: 1.05rem;
  color: #333;
  margin-bottom: 1rem;
  line-height: 1.4;
}

.food-card .btn {
  background: linear-gradient(135deg, #4f6f52, #739e73);
  color: #fff;
  border: none;
  border-radius: 30px;
  padding: 0.9rem 2rem;
  font-size: 1.15rem;
  font-weight: 600;
  letter-spacing: 0.5px;
  cursor: pointer;
  box-shadow: 0 4px 12px rgba(79, 111, 82, 0.3);
  transition: transform 0.2s ease, box-shadow 0.3s ease;
}

.food-card .btn:hover {
  transform: scale(1.08);
  box-shadow: 0 6px 16px rgba(79, 111, 82, 0.4);
}

/* Responsive */
@media (max-width: 768px) {
  .food-card {
    flex-direction: column;
    text-align: center;
  }

  .food-card img {
    width: 100%;
    height: 220px;
  }

  .food-info {
    text-align: center;
  }
}

  /* 🌿 Category Titles */
.food-category {
  font-size: 2rem;
  font-weight: 700;
  color: #4f6f52;
  text-align: center;
  margin: 3rem 0 1rem 0;
  letter-spacing: 1px;
  text-transform: uppercase;
  background: linear-gradient(135deg, #4f6f52, #739e73);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}


/* 🌿 Visit Us Section */
.location-section {
  position: relative;
  background-image: url('https://www.bdtask.com/blog/assets/plugins/ckfinder/core/connector/php/uploads/images/theme%20for%20restaurant.jpg');
  background-size: cover;
  background-attachment: fixed;
  background-position: center;
  height: 65vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
}

.location-section .overlay {
  background: rgba(0, 0, 0, 0.45);
  padding: 4rem 3rem;
  border-radius: 24px;
  text-align: center;
  max-width: 700px;
}

.location-section h2 {
  font-size: 2.5rem;
  margin-bottom: 1rem;
  letter-spacing: 1px;
}

.location-section p {
  font-size: 1.2rem;
  margin-bottom: 1.5rem;
}

/* 🌿 Footer */
.footer {
  background: #4f6f52;
  color: #fff;
  text-align: center;
  padding: 2rem 1rem;
  border-top-left-radius: 18px;
  border-top-right-radius: 18px;
  box-shadow: 0 -2px 12px rgba(90,109,60,0.08);
}

.footer-content {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 3rem;
  max-width: 800px;
  margin: 0 auto 1rem;
}

.footer-logo {
  width: 60px;
  border-radius: 16px;
  vertical-align: middle;
  margin-right: 0.5rem;
}

/* 🌿 Floating Social Bar */
.floating-bar {
  position: fixed;
  bottom: 30px;
  right: 30px;
  display: flex;
  flex-direction: column;
  gap: 10px;
  z-index: 1000;
}

.floating-bar img {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.floating-bar img:hover {
  transform: scale(1.1);
}
  </style>
</head>
<body>
<!-- 🌿 Header -->
<div class="header">
  <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="logo" />
<nav>
    <a href="{{ route('home') }}">Home</a>
    <a href="{{ route('menu') }}">Menu</a>
    <a href="{{ route('about') }}">About Us</a>
    <a href="{{ route('location') }}">Location</a>
</nav>
</div>

<!-- 🌿 Hero Carousel -->
<div class="hero-carousel">
  <div class="carousel-slide active" style="background-image:url('https://bcdsplace.wordpress.com/wp-content/uploads/2022/09/20220906_125517.jpg');"></div>
  <div class="carousel-slide" style="background-image:url('https://perthisok.com/_next/image/?url=https%3A%2F%2Fcms.perthisok.com%2Fwp-content%2Fuploads%2F2023%2F07%2Fperth-best-filipino-restaurants-kabayans-buffet.jpg&w=3840&q=75');"></div>
  <div class="carousel-slide" style="background-image:url('https://gttp.images.tshiftcdn.com/320719/x/0/20-best-filipino-restaurants-in-metro-manila-philippines-must-try-local-dishes-4.jpg');"></div>

  <div class="carousel-overlay">
    <h1 class="carousel-title" id="carouselCaption">Discover Authentic Filipino Cuisine</h1>
    <a href="{{ route('menu') }}"><button class="carousel-btn">Explore Menu</button></a>
  </div>

  <button id="prevBtn" class="carousel-control">&#10094;</button>
  <button id="nextBtn" class="carousel-control">&#10095;</button>
</div>

<!-- 🌿 Main Content -->
<div class="main-content">
  <div class="title">TINDAHAN NI ALING DADAI.</div>
  <div class="subtitle">EXPERIENCE THE FOODS IN THE PHILIPPINES</div>

  <div class="food-section">

    <!-- 🌿 MAIN COURSE -->
    <h2 class="food-category">MAIN COURSE</h2>
    <div class="food-card">
      <img src="https://www.seriouseats.com/thmb/orl1xkPajYxzsOZwkooPtdYvM-M=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/20210508-lechon-kawali-melissa-hom-2-inchChunks-seriouseats-1d53c12cee234305b921362e2106bf29.jpg" alt="Lechon Kawali"/>
      <div class="food-info">
        <div class="food-name">Lechon Kawali</div>
        <div class="food-desc">Crispy fried pork belly — the Filipino favorite main dish served with rice.</div>
        <button class="btn">View More</button>
      </div>
    </div>

    <!-- 🌿 APPETIZER -->
    <h2 class="food-category">APPETIZER</h2>
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu4t2W4f5WY6_zMta8qBigAi1yp_seR3ZxZA&s" alt="Lumpiang Shanghai"/>
      <div class="food-info">
        <div class="food-name">Lumpiang Shanghai</div>
        <div class="food-desc">Crispy spring rolls filled with savory meat — the perfect appetizer.</div>
        <button class="btn">View More</button>
      </div>
    </div>

    <!-- 🌿 DESSERT -->
    <h2 class="food-category">DESSERT</h2>
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbv-a0A3Uv6Ii6l8HLVa3VIIWtTlndI3ahHA&s" alt="Halo Halo"/>
      <div class="food-info">
        <div class="food-name">Halo Halo</div>
        <div class="food-desc">Sweet and colorful layers of shaved ice dessert loved across the Philippines.</div>
        <button class="btn">View More</button>
      </div>
    </div>

    <!-- 🌿 DRINKS -->
    <h2 class="food-category">DRINKS</h2>
    <div class="food-card">
      <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSfVonWbzV1qel1fNjnQ-nkENEhnLRPfyQiw&s" alt="Calamansi Juice"/>
      <div class="food-info">
        <div class="food-name">Calamansi Juice</div>
        <div class="food-desc">Refreshing local citrus drink to complete your Filipino meal.</div>
        <button class="btn">View More</button>
      </div>
    </div>

  </div>
</div>


<!-- 🌿 Visit Us Section -->
<!-- 🌿 Visit Us Section -->
<section class="location-section" id="location">
  <div class="overlay">
    <h2>Location</h2>
    <p>Located in the heart of Cebu — experience Filipino dining at its finest.</p>
    <a href="{{ route('location') }}" class="carousel-btn">Get Directions</a>
  </div>
</section>

<!-- 🌿 Footer -->
<div class="footer">
  <div class="footer-content">
    <div>
      <strong>GETTING HERE</strong><br />
      Contact us:<br />
      tindahan@ni.aling.dadai<br />
      tindahanialingdadai@gmail.com<br />
      www.tindahanialingdadai.com<br />
      <span style="font-size:0.95em;">0912-345-6789</span>
    </div>
    <div>
      <strong>OFFER</strong><br />
      Experience the foods in the Philippines
    </div>
  </div>
  <div>
    <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="footer-logo"/>
    &copy; 2025 Tindahan ni Aling Dadai. All rights reserved.
  </div>
</div>

<!-- 🌿 Floating Social Bar -->
<div class="floating-bar">
  <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/2504/2504727.png" alt="Gmail"></a>
  <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/2111/2111463.png" alt="Instagram"></a>
  <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/145/145802.png" alt="Facebook"></a>
</div>

<script>
/* 🌿 Carousel */
const slides = document.querySelectorAll('.carousel-slide');
const captions = [
  "Discover Authentic Filipino Cuisine",
  "Taste the Tradition",
  "Freshly Made with Love"
];
const captionEl = document.getElementById('carouselCaption');
let index = 0;

function showSlide(n) {
  slides.forEach((slide, i) => {
    slide.classList.remove('active');
    if (i === n) slide.classList.add('active');
  });
  captionEl.textContent = captions[n];
  index = n;
}

document.getElementById('prevBtn').addEventListener('click', () => {
  index = (index - 1 + slides.length) % slides.length;
  showSlide(index);
});

document.getElementById('nextBtn').addEventListener('click', () => {
  index = (index + 1) % slides.length;
  showSlide(index);
});

setInterval(() => {
  index = (index + 1) % slides.length;
  showSlide(index);
}, 7000);

/* 🌿 Animate cards on scroll */
const cards = document.querySelectorAll('.food-card');
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    }
  });
}, { threshold: 0.2 });
cards.forEach(card => observer.observe(card));

/* 🌿 Header scroll effect */
window.addEventListener('scroll', () => {
  const header = document.querySelector('.header');
  if (window.scrollY > 60) {
    header.style.background = 'rgba(79, 111, 82, 0.95)';
    header.style.boxShadow = '0 2px 12px rgba(0,0,0,0.1)';
  } else {
    header.style.background = 'rgba(79, 111, 82, 0.85)';
    header.style.boxShadow = 'none';
  }
});
</script>
</body>
</html>
