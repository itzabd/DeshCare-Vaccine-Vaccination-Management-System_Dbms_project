<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Nid_number']) && isset($_POST['Contact_no'])) {
        $Nid = $_POST['Nid_number'];
        $password = $_POST['Contact_no'];

        $con = new mysqli("localhost", "root", "123Mikasa123", "elderly_vax");

        if ($con->connect_error) {
            echo "<h2>Connection Error: " . $con->connect_error . "</h2>";
            die();
        } else {
            $stmt = $con->prepare("SELECT * FROM ElderlyTB WHERE Nid_number = ?");
            if ($stmt) {
                $stmt->bind_param("s", $Nid);
                $stmt->execute();
                $stmt_result = $stmt->get_result();

                if ($stmt_result->num_rows > 0) {
                    $data = $stmt_result->fetch_assoc();
                    if ($data['Contact_no'] === $password) {
                        $_SESSION['user'] = $data; // Store user data in session
                        header("Location: /Dbms_project_group_29/Sadman/medicalprofile.php");
                        exit();
                    } else {
                        echo "<h2>Invalid Nid_number or password</h2>";
                    }
                } else {
                    echo "<h2>Invalid Nid_number or password</h2>";
                }
                $stmt->close();
            } else {
                echo "<h2>Failed to prepare the SQL statement.</h2>";
            }
            $con->close();
        }
    } else {
        echo "<h2>Please enter both Nid_number and Contact_no.</h2>";
    }
} else {
    echo "<h2>Invalid request method.</h2>";
}
?>
<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Nid_number']) && isset($_POST['Contact_no'])) {
        $Nid = $_POST['Nid_number'];
        $password = $_POST['Contact_no'];

        $con = new mysqli("localhost", "root", "123Mikasa123", "elderly_vax");

        if ($con->connect_error) {
            echo "<h2>Connection Error: " . $con->connect_error . "</h2>";
            die();
        } else {
            $stmt = $con->prepare("SELECT * FROM ElderlyTB WHERE Nid_number = ?");
            if ($stmt) {
                $stmt->bind_param("s", $Nid);
                $stmt->execute();
                $stmt_result = $stmt->get_result();

                if ($stmt_result->num_rows > 0) {
                    $data = $stmt_result->fetch_assoc();
                    if ($data['Contact_no'] === $password) {
                        $_SESSION['user'] = $data; // Store user data in session
                        header("Location: /Dbms_project_group_29/Sadman/medicalprofile.html");
                        exit();
                    } else {
                        echo "<h2>Invalid Nid_number or password</h2>";
                    }
                } else {
                    echo "<h2>Invalid Nid_number or password</h2>";
                }
                $stmt->close();
            } else {
                echo "<h2>Failed to prepare the SQL statement.</h2>";
            }
            $con->close();
        }
    } else {
        echo "<h2>Please enter both Nid_number and Contact_no.</h2>";
    }
} else {
    echo "<h2>Invalid request method.</h2>";
}
?>
