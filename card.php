<?php 

include 'db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="card.css">
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
    <section class="hero">
        <div class="hero-image">
            <img src="Card/card 1.jpg" alt="">
        </div>
        <div class="content">
            <h1>Upgrade your Experience</h1>
            <p>
             Amazing experiences with our membership cards!  
             Get free movies, drinks, early entry, and exclusive merchandise. <br> 
             Choose your level: 
             <span class="level star">Star</span>, 
             <span class="level planet">Planet</span>, or 
             <span class="level galaxy">Galaxy</span>.
            </p>
            <button class="btn">Get Your Card Now!</button>
        </div> 
    </section>
    <section class="deatils">
        <div class="deatils-header">
            <a href="#" class="tab-link active" data-tab="star">Star</a>
            <a href="#" class="tab-link" data-tab="planet">Planet</a>
            <a href="#" class="tab-link" data-tab="galaxy">Galaxy</a>
        </div>

        <div class="deatils-content">
            <div class="tab-content active" id="star">
                <div class="card-photo">
                    <img src="Card/Star.jpg" alt="">
                </div>
                <div class="card-info">
                    <h2>Star Membership</h2>
                    <p>
                        - Vaild 3 months <br>     
                        - 1 months free to watch all movies <br>
                        - 1 free drink per visit <br>
                        - 350 baht for a person 
                    </p>
                    <button class="join-btn">Join Now</button>
                </div>
                <div class="terms-conditions">
                 <h3>Terms & Conditions</h3>
                 <ul>
                     <li>Membership is personal and non-transferable.</li>
                     <li>Free movie access applies only to standard screenings.</li>
                     <li>Drinks are limited to one per visit and cannot be exchanged for cash.</li>
                     <li>Seat selection is subject to availability.</li>
                     <li>Early entry privileges are valid during operational hours only.</li>
                     <li>Membership fees are non-refundable.</li>
                 </ul>
                </div>
            </div>
            <div class="tab-content" id="planet">
                <div class="card-photo">
                    <img src="Card/Planet.jpg" alt="">
                </div>
                <div class="card-info">
                    <h2>Planet Membership</h2>
                    <p>
                        - Vaild 6 months <br>
                        - 3 months free to watch all movies <br>
                        - 1 free drink per visit <br>
                        - Choose seats before others <br>
                        - Early entry to the place <br>
                        - 750 baht for a person 
                    </p>
                    <button class="join-btn">Join Now</button>
                </div>
                <div class="terms-conditions">
                 <h3>Terms & Conditions</h3>
                 <ul>
                     <li>Membership is personal and non-transferable.</li>
                     <li>Free movie access applies only to standard screenings.</li>
                     <li>Drinks are limited to one per visit and cannot be exchanged for cash.</li>
                     <li>Seat selection is subject to availability.</li>
                     <li>Early entry privileges are valid during operational hours only.</li>
                     <li>Membership fees are non-refundable.</li>
                 </ul>
                </div>
            </div>
            <div class="tab-content" id="galaxy">
                <div class="card-photo">
                    <img src="Card/Galaxy.jpg" alt="">
                </div>
                <div class="card-info">
                    <h2>Galaxy Membership</h2>
                    <p>
                        - Vaild 1 year <br>
                        - 1 months free to watch all movies <br>
                        - 1 free drink per visit <br>
                        - Choose seats before others <br>
                        - Early entry to the place <br>
                        - Get a free random merchandise <br>
                        - 1050 baht for a person 
                    </p>
                    <button class="join-btn">Join Now</button>
                </div>
                <div class="terms-conditions">
                 <h3>Terms & Conditions</h3>
                 <ul>
                     <li>Membership is personal and non-transferable.</li>
                     <li>Free movie access applies only to standard screenings.</li>
                     <li>Drinks are limited to one per visit and cannot be exchanged for cash.</li>
                     <li>Seat selection is subject to availability.</li>
                     <li>Early entry privileges are valid during operational hours only.</li>
                     <li>Membership fees are non-refundable.</li>
                 </ul>
                </div>
            </div>
        </div>
    </section>
    <section class="usage">
        <div class="usage-photo">
            <img src="Card/Star.jpg" alt="Usage 1" class="active">
            <img src="Card/Planet.jpg" alt="Usage 2">
            <img src="Card/Galaxy.jpg" alt="Usage 3">
        </div>
        <div class="usage-info">
            <h2>Our membership can be started from the <span class="c-type">Star</span> level</h2>
            <p>
                Our card can be used as a credit card to pay the ticket and food in the cinema.
                You can add the money in the card and use it to pay but the currency in 
                the card is <span class="money">Astro Credit</span> which is equal to 1 Astro Credit = 1 Baht.
                You can top up the money in the card at the counter in the cinema or online.
                You can also check your balance and transaction history at <a href="#" class="card-link">My account</a>. <br>
                If you want the physical card you can get at the counter and pickup location <br>
                at <span class="location">BangPhill</span>, <span class="location">FuturePark</span>, and <span class="location">CentralWorld</span> and by the delivery service.
                Notes that <span class="notes">The card can be used in other events that hosted by Highline Flim.</span>
            </p>
        </div>
    </section>
    <section class="buy-card">
        <h2>Buy Your Membership Card</h2>
        <form action="buy_card.php" method="POST" class="buy-card-form">
            <div class="form-group">
                <label for="name">Full name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" id="phone" name="phone" required>
            </div>
            <div class="form-group">
                <label for="card_type">Select Card</label>
                <select name="card_type" id="card_type">
                    <option value="">--Choose Card --</option>
                    <option value="Star">Star Membership</option>
                    <option value="Planet">Planet Membership</option>
                    <option value="Galaxy">Galaxy Membership</option>
                </select>
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" id="quantity" name="quantity" value="1" min="1" required>

            </div>
            <button type="submit" class="buy-btn">Buy Now</button>
        </form>
    </section>
    <script src="card.js"></script>
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