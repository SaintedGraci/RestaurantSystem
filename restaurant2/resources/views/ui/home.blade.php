<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tindahan ni Aling Dadai</title>
  <style>
body {
  margin: 0;
  font-family: 'Georgia', serif;
  background-color: #e0f2df;
  color: #2e2e2e;
  /* Add smooth font rendering */
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}

.header {
  background: #4f6f52;
  color: #fff;
  padding: 1.5rem 0 1rem 0;
  display: flex;
  align-items: center;
  justify-content: flex-start;
  box-shadow: 0 2px 12px rgba(90,109,60,0.08); /* Soft shadow */
  border-bottom-left-radius: 18px;
  border-bottom-right-radius: 18px;
}

.header img.logo {
  width: 80px;
  height: auto;
  margin-left: 2rem;
  margin-right: 1rem;
  border-radius: 16px; /* Rounded logo */
  box-shadow: 0 2px 8px rgba(90,109,60,0.10);
}

.header nav {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 2rem;
}

nav a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 1.1rem;
  letter-spacing: 1px;
  padding: 0.5rem 1.2rem;
  border-radius: 24px;
  transition: background 0.2s, color 0.2s;
}

nav a:hover {
  background: rgba(255,255,255,0.08);
  color: #ffe082;
}

.main-content {
  max-width: 900px;
  margin: 2.5rem auto;
  border-radius: 24px;
  box-shadow: 0 4px 24px rgba(90,109,60,0.10);
  padding: 2.5rem 2.5rem;
  background: #fff;
  animation: fadeIn 1s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(30px);}
  to { opacity: 1; transform: translateY(0);}
}

.title {
  text-align: center;
  font-size: 2.3rem;
  font-weight: bold;
  letter-spacing: 2px;
  margin-bottom: 1.2rem;
  color: #4f6f52;
}

.subtitle {
  text-align: center;
  font-size: 1.2rem;
  font-weight: 600;
  margin-bottom: 1.5rem;
  color: #6b5e3c;
}

.food-images {
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
  margin-bottom: 2rem;
  gap: 0;
  width: 100%;
}
.carousel-wrapper {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 420px;
  margin: 0 auto;
}

.food-images img#carouselImg {
  width: 400px;
  height: 225px;
  object-fit: cover;
  border-radius: 18px;
  border: 3px solid #4f6f52;
  background: #fff;
  box-shadow: 0 4px 18px rgba(90,109,60,0.15);
  transition: opacity 0.5s, transform 0.5s;
  opacity: 1;
  display: block;
}

.food-images img#carouselImg.fade-out {
  opacity: 0;
  transform: scale(0.98);
}

.food-images img#carouselImg.fade-in {
  opacity: 1;
  transform: scale(1);
}

.carousel-btn {
  background: #222;
  border: none;
  color: #fff;
  width: 48px;
  height: 48px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  z-index: 2;
  cursor: pointer;
  transition: background 0.2s, box-shadow 0.2s;
  box-shadow: 0 2px 6px rgba(0,0,0,0.12);
  padding: 0;
}

#prevBtn {
  left: -60px;
}

#nextBtn {
  right: -60px;
}

.carousel-btn:disabled {
  opacity: 0.5;
  cursor: not-allowed;
}

 .arrow-icon {
  width: 28px;
  height: 28px;
  display: block;
}

.carousel-btn:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.18);
}

.section-title {
  font-size: 1.3rem;
  font-weight: bold;
  color: #4f6f52;
  margin-top: 1rem;
  margin-bottom: 0.5rem;
}

.food-section {
  display: flex;
  gap: 2rem;
  margin-bottom: 2rem;
}

.food-card {
  flex: 1;
  background: #f4f9f4;
  border-radius: 18px;
  padding: 1.5rem;
  box-shadow: 0 2px 12px rgba(90,109,60,0.10);
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 2px solid #aac8a7;
  transition: box-shadow 0.2s, transform 0.2s;
}

.food-card:hover {
  box-shadow: 0 8px 24px rgba(90,109,60,0.18);
  transform: translateY(-4px) scale(1.03);
}

.food-card img {
  width: 90px;
  height: 60px;
  object-fit: cover;
  border-radius: 12px;
  margin-bottom: 0.5rem;
  border: 1px solid #b2a46d;
  box-shadow: 0 2px 8px rgba(90,109,60,0.10);
}

.food-card .food-name {
  font-weight: bold;
  margin-bottom: 0.3rem;
  font-size: 1.08rem;
}

.food-card .food-desc {
  font-size: 0.97rem;
  margin-bottom: 0.7rem;
  text-align: center;
  color: #2e2e2e;
}

.food-card .btn {
  background: #4f6f52;
  color: #fff;
  border: none;
  border-radius: 24px;
  padding: 0.4rem 1.2rem;
  font-size: 1rem;
  cursor: pointer;
  margin-bottom: 0.2rem;
  transition: background 0.2s, transform 0.2s;
  box-shadow: 0 2px 6px rgba(90,109,60,0.10);
}

.food-card .btn:hover {
  background: #3e5741;
  transform: scale(1.07);
}

.footer {
  background: #4f6f52;
  color: #fff;
  text-align: center;
  padding: 1.2rem 0 0.7rem 0;
  margin-top: 2rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  box-shadow: 0 -2px 12px rgba(90,109,60,0.08);
  border-top-left-radius: 18px;
  border-top-right-radius: 18px;
}

.footer .footer-content {
  max-width: 800px;
  margin: 0 auto;
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  font-size: 0.98rem;
  width: 100%;
  gap: 3rem;
  text-align: left;
}

.footer .footer-content div {
  margin: 0.5rem 0;
}

.footer .footer-logo {
  width: 60px;
  vertical-align: middle;
  margin-right: 0.5rem;
  display: inline-block;
  border-radius: 16px;
  box-shadow: 0 2px 8px rgba(90,109,60,0.10);
}

.footer-attribution {
  margin-left: 2rem;
  font-size: 0.9em;
  color: #fff;
}

@media (max-width: 900px) {
  .main-content {
    padding: 1rem 0.5rem;
  }
  .food-section {
    gap: 1rem;
  }
}

@media (max-width: 700px) {
  .footer .footer-content {
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: 1rem;
  }
  .food-section {
    flex-direction: column;
    gap: 1rem;
  }
  .food-images {
    flex-direction: column;
  }
  .main-content {
    padding: 1rem 0.5rem;
  }
}
  </style>
</head>
<body>
  <div class="header">
    <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="logo" />
    <nav>
      <a href="#">Home</a>
      <a href="#">Menu</a>
      <a href="#">About us</a>
      <a href="#">Location</a>
    </nav>
  </div>

  <div class="main-content">
    <div class="title">TINDAHAN NI ALING DADAI.</div>

    <!-- Carousel Start -->
   <div class="food-images">
  <div class="carousel-wrapper">
    <button id="prevBtn" class="carousel-btn" aria-label="Previous">
      <svg class="arrow-icon" viewBox="0 0 50 50">
        <circle cx="25" cy="25" r="25" fill="none"/>
        <polyline points="30,15 20,25 30,35" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
    <img id="carouselImg" src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80" alt="Food Photo" />
    <button id="nextBtn" class="carousel-btn" aria-label="Next">
      <svg class="arrow-icon" viewBox="0 0 50 50">
        <circle cx="25" cy="25" r="25" fill="none"/>
        <polyline points="20,15 30,25 20,35" fill="none" stroke="#fff" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
      </svg>
    </button>
  </div>
</div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
  const images = [
    "https://bcdsplace.wordpress.com/wp-content/uploads/2022/09/20220906_125517.jpg",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTGVT-1-q9opGMJHjcrBCOD12ZmPPTPMmI46fyRINoqTmIGMIeB--Qo7jjJuQUpkNpRQx8&usqp=CAU",
    "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS6BElxbyj28qTfycF4XM3RWaDZvMeKxogMZQ&s"
  ];
  let current = 0;
  const img = document.getElementById('carouselImg');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  function updateImg(nextIndex) {
    img.classList.add('fade-out');
    setTimeout(() => {
      img.src = images[nextIndex];
      img.classList.remove('fade-out');
      img.classList.add('fade-in');
      setTimeout(() => img.classList.remove('fade-in'), 500);
    }, 500);
    prevBtn.style.display = nextIndex === 0 ? 'none' : 'flex';
    nextBtn.style.display = nextIndex === images.length - 1 ? 'none' : 'flex';
    current = nextIndex;
  }

  prevBtn.onclick = function () {
    if (current > 0) {
      updateImg(current - 1);
    }
  };
  nextBtn.onclick = function () {
    if (current < images.length - 1) {
      updateImg(current + 1);
    }
  };
  updateImg(0);
});
</script>
    <!-- Carousel End -->

    <div class="subtitle">EXPERIENCE THE FOODS IN THE PHILIPPINES</div>

    <div class="food-section">
      <div class="food-card">
        <div class="section-title">Main Course</div>
        <img src="https://www.seriouseats.com/thmb/orl1xkPajYxzsOZwkooPtdYvM-M=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/20210508-lechon-kawali-melissa-hom-2-inchChunks-seriouseats-1d53c12cee234305b921362e2106bf29.jpg" alt="Lechon Kawali"/>
        <div class="food-name">Lechon Kawali</div>
        <div class="food-desc">The main course in Filipino food is the central part of the meal, usually served with rice. It is often made with meat, seafood, or vegetables and prepared in a way that highlights rich flavors, savory seasonings, and a comforting homemade taste.</div>
        <button class="btn">View More</button>
      </div>
      <div class="food-card">
        <div class="section-title">Appetizer</div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu4t2W4f5WY6_zMta8qBigAi1yp_seR3ZxZA&s" alt="Lumpiang Shanghai"/>
        <div class="food-name">Lumpiang Shanghai</div>
        <div class="food-desc">An appetizer in Filipino food is a small dish served before the main meal to stimulate the appetite. It is usually light and flavorful, often made with bite-sized portions of meat, seafood, or vegetables.</div>
        <button class="btn">View More</button>
      </div>
    </div>

    <div class="food-section">
      <div class="food-card">
        <div class="section-title">Desserts</div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSbv-a0A3Uv6Ii6l8HLVa3VIIWtTlndI3ahHA&s" alt="Halo Halo"/>
        <div class="food-name">Halo Halo</div>
        <div class="food-desc">Desserts in Filipino food are sweet dishes served after a meal to give a delightful finishing touch. Made with ingredients like fruits, milk, and tropical flavors, Filipino desserts are meant to satisfy the sweet tooth.</div>
        <button class="btn">View More</button>
      </div>
      <div class="food-card">
        <div class="section-title">Drinks</div>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTSfVonWbzV1qel1fNjnQ-nkENEhnLRPfyQiw&s" alt="Calamansi Juice"/>
        <div class="food-name">Calamansi Juice</div>
        <div class="food-desc">Drinks in Filipino food are beverages served to refresh and complete the meal. Enjoy with family and friends, adding to the overall dining experience.</div>
        <button class="btn">View More</button>
      </div>
    </div>
  </div>

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
    <div style="margin-top:0.7rem;">
      <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="footer-logo"/>
      &copy; 2025 Tindahan ni Aling Dadai. All rights reserved.
    </div>
  </div>
</body>
</html>
