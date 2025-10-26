<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Location - Tindahan ni Aling Dadai</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Global Styles */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom right, #e0f2df, #ffffff);
            color: #2e2e2e;
        }

        /* Header */
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
        }

        .header img.logo {
            width: 70px;
            height: auto;
            border-radius: 16px;
        }

        .header nav {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 2rem;
        }

        .header nav a {
            color: #fff;
            text-decoration: none;
            font-weight: bold;
            font-size: 1.05rem;
            padding: 0.5rem 1rem;
            border-radius: 24px;
        }

        .header nav a:hover {
            background: rgba(255,255,255,0.1);
            color: #ffe082;
        }

        /* Main Content */
        .main-content {
            margin-top: 100px;
            padding: 2rem;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
        }

        .location-title {
            text-align: center;
            font-size: 2.5rem;
            font-weight: bold;
            color: #4f6f52;
            margin-bottom: 2rem;
        }

       .location-images {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin: 2rem 0;
    flex-wrap: wrap;
}

.location-images img {
    width: 450px;
    height: 300px;
    object-fit: cover;
    border-radius: 20px;
    box-shadow: 0 4px 16px rgba(79, 111, 82, 0.2);
    transition: transform 0.3s ease;
}

.location-images img:hover {
    transform: scale(1.02);
}

        .location-info {
            background: rgba(255, 255, 255, 0.8);
            padding: 2rem;
            border-radius: 20px;
            margin-top: 2rem;
            box-shadow: 0 4px 24px rgba(90,109,60,0.1);
            font-size: 1.1rem;
            line-height: 1.8;
            text-align: justify;
        }

        /* Footer */
        .footer {
            background: #4f6f52;
            color: #fff;
            text-align: center;
            padding: 2rem 1rem;
            margin-top: 4rem;
            border-top-left-radius: 18px;
            border-top-right-radius: 18px;
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

        /* Floating Social Bar */
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
    <!-- Header -->
    <div class="header">
        <img src="https://cdn-icons-png.flaticon.com/128/4035/4035183.png" alt="Logo" class="logo" />
        <nav>
            <a href="/">Home</a>
            <a href="/menu">Menu</a>
            <a href="/about">About Us</a>
            <a href="/location">Location</a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <h1 class="location-title">TINDAHAN NI ALING DADAI</h1>
        <h2 style="text-align: center; color: #6b5e3c;">Our Location</h2>

  <div class="location-images">
    <img src="http://127.0.0.1:5500/map.png" alt="Map" class="map">
    <img src="https://archify-images-prod.s3.ap-southeast-1.amazonaws.com/files/professional/projects/s/gp4b8fmt5u.jpg" alt="Benedicto College" class="building">
</div>

        <div class="location-info">
            <p>The place is located inside Benedicto College, specifically near the Artists Hall, which makes it easy to find for students and visitors. It is situated along A.S. Fortuna Street in Mandaue City, Cebu, a well-known road that is accessible to many.</p>
            <p>The landmark to remember is that it's inside Benedicto College, so once you're there, you just need to head towards the Artists Hall. The business is open from Monday to Saturday, between 9:00 AM and 7:00 PM, making it convenient to visit during the day.</p>
        </div>
    </div>

    <!-- Footer -->
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

    <!-- Floating Social Bar -->
    <div class="floating-bar">
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/2504/2504727.png" alt="Gmail"></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/2111/2111463.png" alt="Instagram"></a>
        <a href="#"><img src="https://cdn-icons-png.flaticon.com/128/145/145802.png" alt="Facebook"></a>
    </div>

    <script>
        // Header scroll effect
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