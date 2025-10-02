<?php
include 'db.php'; // includes $dbconnection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));

    if (empty($fname) || empty($lname) || empty($email) || empty($phone)) {
        echo "<script>alert('❌ All fields are required.'); window.history.back();</script>";
        exit;
    }

    $stmt = $dbconnection->prepare("INSERT INTO drink_registration (fname, lname, email, phone) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fname, $lname, $email, $phone);

    if ($stmt->execute()) {
        echo "<script>alert('✅ Registration successful!'); window.location.href='home.php';</script>";
    } else {
        echo "<script>alert('❌ Error saving to database.'); window.history.back();</script>";
    }

    $stmt->close();
}

$dbconnection->close();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Poppins:wght@400;500;600;700&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Sail&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="header"  id="mainHeader">
        <div class="logo">
            <h1>HighLine</h1>
        </div>
        <div class="nav">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="ticket.php">Ticket</a></li>
                <li><a href="schedule.php">Schedule</a></li>
                <li><a href="card.php">Member</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
        <div class="search">
            <input type="text" placeholder="Search...">
            <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </div>
    <div class="hero">
        <video autoplay muted loop playsinline>
         <source src="Cover/Ep1.mp4" type="video/mp4">
         Your browser does not support the video tag.
       </video>
       <h1>HIGHTLINE FLIM</h1>
      <h1>Experience Cinema Like Never Before</h1>
       <p>Rooftop screenings. Real connections. Stunning views.</p>
      <div class="cta-buttons">
            <a href="ticket.php">Book a Seat</a>
            <a href="#aiming">Explore More</a>
        </div>
    </div>
    <section class="upcoming-movies">
        <h1>Upcoming movies</h1>
        <div class="movie-scroll-container">
            <div class="movie-card">
                <img src="Movie/Movie 1.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">13 July 2025</p>
                    <h4 class="movie-title">500 DAYS OF SUMMER</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 2.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">16 July 2025</p>
                    <h4 class="movie-title">LA LA LAND</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 3.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">21 July 2025</p>
                    <h4 class="movie-title">THE NOTEBOOK</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 5.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">26 July 2025</p>
                    <h4 class="movie-title">FALLEN ANGELS</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 4.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">31 July 2025</p>
                    <h4 class="movie-title">OUR BELOVED SUMMER</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 6.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">13 July 2025</p>
                    <h4 class="movie-title">A BRIGHTER SUMMER DAY</h4>
                </div>
            </div>
            <div class="movie-card">
                <img src="Movie/Movie 7.jpg" alt="">
                <div class="movie-info">
                    <p class="movie-date">13 July 2025</p>
                    <h4 class="movie-title">BEFORE SUNSET</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="highlight-event">
        <div class="event-meta">
            <a href="#" class="tag">Film</a>
            <p class="date-range">13 - 16 July 2025</p>
        </div>
        <h1 class="event-tile">Higheline Rooftop Film</h1>
        <p class="event-description">
            Join us for an unforgettable cinematic journey under the stars. The Highline Film Rooftop Series brings together five
            breathtaking films ranging from heartfelt dramas to thrilling adventures — all shown outdoors in an urban, open-air
            setting.
        </p>

        <p class="event-description">
            From JULY 13 - 16, 2025, gather with friends atop the skyline of your city, where film, atmosphere, and community come
            together. Don't miss this chance to experience storytelling in a completely fresh way.

        </p>

        <p class="event-description">
            Seats are limited — <a href="ticket.php" class="ticket-link">book your tickets</a> before they’re gone!
        </p>

        <p class="event-date">Sunday, JULY 13 , 2025</p>
    </section>
    <section class="poster">
        <h1>Filming On The Aire</h1>
        <p>You can enjoy with us four days monthly. Our team are made you enjoy with the amazing movies.</p>
        <img src="Cover/Poster 1.png" alt="">
        <p>Come Out And Chill With Us With Your Special Days.</p>
    </section>  
    <section class="free-drink-section">
        <div class="container">
            <div class="drink-intro">
                <h2>Enjoy a Rooftop Drink with Your Movie</h2>
                <p>Register now to receive a complimentary drink when you join us at Highline Film rooftop screenings. A perfect pairing with cinema under the stars!</p>
            </div>
            <form class="drink-form" action="home.php" method="POST">
                <h3>Register for Your Free Rooftop Drink</h3>
                <p class="form-subtext">(Please screenshot this screen and show it at the event)</p>

                <div class="form-grid">
                    <div class="form-group">
                        <label for="fname">First Name*</label>
                        <input type="text" id="fname" name="fname" requied />
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name*</label>
                        <input type="text" id="lname" name="lname" requied />
                    </div>
                    <div class="form-group">
                        <label for="email">Email*</label>
                        <input type="email" id="email" name="email" requied />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number*</label>
                        <input type="tel" id="phone" name="phone" requied />
                    </div>
                </div>
                <button type="sumbit" class="confirm-btn">Confrim</button>
                <p class="privacy-text">We use this information only to confirm your registration. Read our <a href="#">Privacy Policy</a>.</p>
            </form>
        </div>
    </section>
    <section class="venue-map">
        <div class="container">
            <h2 class="map-heading">Visit Our Rooftop Venue</h2>
            <p class="map-subtext">Join us at our exclusive open-air rooftop cinema — a place where the city skyline meets the magic of film. Here's how to find us:</p>
            <div class="map-frame">
                <img src="Cover/map.jpg" alt="Rooftop Location" class="map-image">
            </div>
        </div>
    </section>
    <script src="home.js"></script>
    <footer class="highline-footer">
        <div class="footer-links">
            <a href="#">FAQ</a>
            <a href="ticket.php">Tickets</a>
            <a href="schedule.php">Events</a>
            <a href="contact.php">Contact</a>
            <a href="#">Terms & Privacy</a>
        </div>

        <div class="social-icon">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-tiktok"></i></a>
        </div>

        <div class="footer-credit">
            <p>Site by Highline Studio</p>
            <p>© 2025 Highline Film. All rights reserved.</p>
            <p><a href="#">Legal Notice</a></p>
        </div>

        <div class="payment-icon">
             <img src="Logo/visa.png" alt="Visa">
             <img src="Logo/paypal.png" alt="PayPal">
             <img src="Logo/master.png" alt="Mastercard">
             <img src="Logo/scan.png" alt="Bank">
             <img src="Logo/credit-card.png" alt="Membercard">
        </div>
    </footer>

</body>
</html>