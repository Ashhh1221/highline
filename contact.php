<?php
include 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = mysqli_real_escape_string($dbconnection, $_POST['fname']);
    $lname = mysqli_real_escape_string($dbconnection, $_POST['lname']);
    $email = mysqli_real_escape_string($dbconnection, $_POST['email']);
    $company = mysqli_real_escape_string($dbconnection, $_POST['company']);
    $phone = mysqli_real_escape_string($dbconnection, $_POST['phone']);
    $event_type = mysqli_real_escape_string($dbconnection, $_POST['event_type']);
    $country = mysqli_real_escape_string($dbconnection, $_POST['country']);
    $solution = mysqli_real_escape_string($dbconnection, $_POST['solution']);
    $attendees = intval($_POST['attendees']);
    $inquiry = mysqli_real_escape_string($dbconnection, $_POST['inquiry']);

    $sql = "INSERT INTO contact_submissions 
            (fname, lname, email, company, phone, event_type, country, solution, attendees, inquiry) 
            VALUES 
            ('$fname','$lname','$email','$company','$phone','$event_type','$country','$solution',$attendees,'$inquiry')";

    if (mysqli_query($dbconnection, $sql)) {
        $message = "✅ Thank you for contacting us! We'll get back to you soon.";
    } else {
        $message = "❌ Something went wrong: " . mysqli_error($dbconnection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
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
<section class="contact-section">
    <div class="contact-left">
        <img src="Logo/Social.png" alt="Contact Illustration">
        <div class="contact-text">
            <h1>Your Next Event <br> Starts Here!</h1>
            <p>No matter what your needs are, we’re here to help you run seamless, smarter events.</p>
        </div>
    </div>

    <div class="contact-right">
        <div class="contact-card">
            <h2>Contact Us</h2>
            <?php if ($message): ?>
                <p class="message"><?php echo $message; ?></p>
            <?php endif; ?>
            <form method="POST" action="">
                <div class="row">
                    <input type="text" name="fname" placeholder="First Name" required>
                    <input type="text" name="lname" placeholder="Last Name" required>
                </div>
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="company" placeholder="Company Name" required>
                <input type="text" name="phone" placeholder="Phone Number" required>
                <select name="event_type" required>
                    <option value="">What type of event?</option>
                    <option>Conference</option>
                    <option>Concert</option>
                    <option>Workshop</option>
                    <option>Other</option>
                </select>
                <input type="text" name="country" placeholder="Country" required>
                <select name="solution" required>
                    <option value="">What solution are you interested in?</option>
                    <option>Ticketing</option>
                    <option>Marketing</option>
                    <option>Registration</option>
                    <option>Other</option>
                </select>
                <input type="number" name="attendees" placeholder="Number of attendees" required>
                <textarea name="inquiry" rows="4" placeholder="Tell us more about your inquiry"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
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
