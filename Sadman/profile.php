<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeshCare</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="footer.css">
    <style>
        nav {
            background-color: #ea580c;
        }

        .selected {
            background-color: #fb923c;
        }

        nav a:hover {
            background-color: #fb923c;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navigation Bar -->
    <nav class="bg-orange-600 p-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo / Site Name -->
            <div class="text-white text-lg font-bold">
                DeshCare Vaccine
            </div>
            <!-- Navigation Links -->
            <div class="flex space-x-4">
                <a href="homepage.html" class="text-gray-300 hover:text-white px-3 py-2 rounded">Vaccines</a>
                <a href="history.html" class="text-gray-300 hover:text-white px-3 py-2 rounded">History</a>
                <a href="medicalprofile.html" class="text-gray-300 hover:text-white px-3 py-2 rounded">Medical Profile</a>
                <a href="../Abdullah/checkupStatus.html" class="text-gray-300 hover:text-white px-3 py-2 rounded ">Appointment Status</a>
            </div>
            <!-- User Icon -->
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white">
                    <a href="homepage.html" class="selected text-white bg-gray-700 px-3 py-2 rounded-full">Profile</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Profile Section -->
    <section id="profile" class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">User Profile</h2>
        <div class="bg-white p-6 rounded-lg shadow-md">
            <?php
            session_start();
            if (isset($_SESSION['user'])) {
                $user = $_SESSION['user'];
                // Combine First_name and Last_name for Full Name
                $full_name = $user['First_name'] . ' ' . $user['Last_name'];
                // Use Country instead of Email
                $country = $user['Country'];
                // Combine address components
                $address = $user['House_no'] . ', ' . $user['Road'] . ', ' . $user['Thana_name'] . ', ' . $user['Zip'] . ', ' . $user['City'];
            ?>
            <p class="text-gray-600 mb-1"><strong>Full Name:</strong> <?php echo $full_name; ?></p>
            <p class="text-gray-600 mb-1"><strong>Address:</strong> <?php echo $address; ?></p>
            <p class="text-gray-600 mb-1"><strong>Gender:</strong> <?php echo $user['Gender']; ?></p>
            <p class="text-gray-600 mb-1"><strong>Country:</strong> <?php echo $country; ?></p>
            <p class="text-gray-600 mb-1"><strong>Phone Number:</strong> <?php echo $user['Contact_no']; ?></p>
            <p class="text-gray-600 mb-1"><strong>Date of Birth:</strong> <?php echo $user['Date_of_Birth']; ?></p>
            <?php
            } else {
                echo "<p>User data not found.</p>";
            }
            ?>
        </div>
    </section>

    <footer class="footer bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Contact Information</h5>
                    <address>
                        123 Main Street, City<br>
                        Email: info@deshcarevaccine.com<br>
                        Phone: +1234567890
                    </address>
                </div>
                <div class="col-md-2">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Vaccine Information</a></li>
                        <li><a href="#">Appointment Booking</a></li>
                        <li><a href="#">Campaigns</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Privacy & Terms</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h5>Connect with Us</h5>
                    <ul class="list-inline">
                        <li class="list-inline-item"><a href="#"><img src="Images/facebook.png" alt="Facebook" class="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="Images/twitter.png" alt="Twitter" class="social-icon"></a></li>
                        <li class="list-inline-item"><a href="#"><img src="Images/instagram.png" alt="Instagram" class="social-icon"></a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Newsletter Signup</h5>
                    <form class="form-inline">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Enter your email">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2024 DeshCare Vaccine. All rights reserved.</p>
                    <p>ISO 9001:2015 Certified</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
