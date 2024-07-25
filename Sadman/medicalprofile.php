<?php
session_start();

// Redirect to login if session is not set
if (!isset($_SESSION['user'])) {
    header("Location:  /Dbms_project_group_29/Abdullah/login.php");
    exit();
}

// Retrieve user data from session
$user = $_SESSION['user'];

// Database connection details
$servername = "localhost";
$username = "root";
$password = "123Mikasa123";
$dbname = "elderly_vax";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve NID number from session user data
$nidNumber = $user['Nid_number'];

// Prepare SQL query to fetch medical history for the logged-in user
$sql = "SELECT Disease_Name, Prescribed_Medication, Diagnosis_Date, Diagnosis_time, Doctor_Remark, NidNumber, OperatorID 
        FROM MEDICAL_HISTORY_DIAGNOSED_DISEASE_TB 
        WHERE NidNumber = '$nidNumber'";

$result = $conn->query($sql);

// Initialize $rows as an empty array
$rows = [];

// Check if there are results
if ($result && $result->num_rows > 0) {
    // Fetch all rows as associative array
    $rows = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $rows = []; // Set $rows as empty array if no results
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeshCare</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="footer.css">
    <script>
        function openModal(diseaseId) {
            document.getElementById(diseaseId).classList.remove('hidden');
        }
        function closeModal(diseaseId) {
            document.getElementById(diseaseId).classList.add('hidden');
        }
    </script>
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

        .modal-bg {
            background-color: rgba(75, 85, 99, 0.5); /* Slightly darker for better visibility */
            z-index: 50; /* Ensures modal appears above other content */
        }

        .modal-content {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 30rem;
            margin: 0 auto;
            z-index: 50; /* Ensures modal content appears above other content */
        }

        .modal-button {
            background-color: #1f2937; /* Dark background */
            color: #ffffff; /* White text */
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            cursor: pointer;
            border: none;
            display: inline-block;
        }

        .modal-button:hover {
            background-color: #374151; /* Slightly lighter on hover */
        }
    </style>
</head>
<body class="bg-gray-100 h-screen">
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
                <a href="medicalprofile.html" class="selected text-white bg-gray-700 px-3 py-2 rounded">Medical Profile</a>
                <a href="../Abdullah/checkupStatus.html" class="text-gray-300 hover:text-white px-3 py-2 rounded">Appointment Status</a>
            </div>
            <!-- User Icon -->
            <div class="flex items-center">
                <div class="w-8 h-8 bg-gray-600 rounded-full flex items-center justify-center text-white">
                    <a href="profile.php" class="selected text-white bg-gray-700 px-3 py-2 rounded-full">Profile</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Medical Profile Section -->
    <section id="medical-profile" class="container mx-auto mt-6">
        <h2 class="text-2xl font-bold mb-4">Medical Profile</h2>
        <div class="space-y-6">
            <!-- Check if $rows is not empty before looping -->
            <?php if (!empty($rows)): ?>
                <?php foreach ($rows as $row): ?>
                    <div class="bg-white p-6 rounded-lg shadow-md cursor-pointer" onclick="openModal('<?php echo 'disease' . $row['OperatorID']; ?>')">
                        <h3 class="text-2xl font-semibold mb-2"><?php echo $row['Disease_Name']; ?></h3>
                        <p class="text-gray-600 mb-1"><strong>Diagnosed Date & Time:</strong> <?php echo $row['Diagnosis_Date'] . ', ' . $row['Diagnosis_time']; ?></p>
                    </div>
                    <!-- Disease Modal -->
                    <div id="<?php echo 'disease' . $row['OperatorID']; ?>" class="fixed inset-0 modal-bg flex items-center justify-center hidden">
                        <div class="modal-content">
                            <h3 class="text-2xl font-semibold mb-4"><?php echo $row['Disease_Name']; ?></h3>
                            <p class="text-gray-600 mb-4"><strong>Prescribed Medication:</strong> <?php echo $row['Prescribed_Medication']; ?></p>
                            <p class="text-gray-600 mb-4"><strong>Diagnosed Date & Time:</strong> <?php echo $row['Diagnosis_Date'] . ', ' . $row['Diagnosis_time']; ?></p>
                            <p class="text-gray-600 mb-4"><strong>Doctor's Remark:</strong> <?php echo $row['Doctor_Remark']; ?></p>
                            <button class="mt-4 bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700 modal-button" onclick="closeModal('<?php echo 'disease' . $row['OperatorID']; ?>')">Close</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-gray-600">No medical records found.</p>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
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
