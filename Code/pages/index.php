<?php
require_once '../includes/auth.php';

// Check if the user is already logged in
if (isLoggedIn()) {
    $role = getUserRole();
    // Redirect based on role
    if ($role === 'admin') {
        header("Location: admin_dashboard.php");
    } else {
        header("Location: dashboard.php");
    }
    exit();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (authenticateUser($username, $password)) {
        // Redirect based on role
        if (getUserRole() === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit();
    } else {
        $error = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        /*------------------------------------------------------- Delete the Password commented below -------------------------------------------------------------*/
        /* Basic Styling */
/* Basic Styling */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #FAF7F0;
    margin: 0;
    padding: 6px;
    display: flex;
    flex-direction: column;
}

/* Header Styling */
header {
    background-color: #F2EED7;
    color: white;
    width: 94%;
    height: 85vh; /* Full height */
    display: flex;
    flex-direction: column;
    justify-content: center; /* Center content vertically */
    align-items: center; /* Center content horizontally */
    padding: 35px; /* Uniform padding */
    border-radius: 30px; /* Rounded corners */
    text-align: center;
    box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.60);
    margin: 0 auto; /* Centers the header */
}



header .logo-section img {
    border-radius: 50px;
    width: 6in; /* Image width */
    height: 3in; /* Image height */
}

/* Header Text */
header .header-text h1 {
    margin: 0px 0;
    font-size: 3em;
    font-weight: bold;
    background-image: linear-gradient(#000, #4A4947);
    -webkit-background-clip: text;
    color: transparent; /* Gradient effect */
}

header .header-text p {
    margin: 10px 0;
    font-size: 1.2em;
    line-height: 1.6;
    background-image: linear-gradient(#000, #4A4947);
    -webkit-background-clip: text;
    color: transparent; /* Gradient effect */
}

/* Roadmap Section */
.roadmap-section {
    margin: 40px auto; /* Center with spacing */
    padding: 40px;
    border-radius: 30px;
    background-color: #F2EED7;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.3); /* Light shadow */
    max-width: 1400px; /* Optional max-width */
}

.roadmap-section h2 {
    font-size: 2.0em;
    margin-bottom: 15px;
    color: #000; /* Color for headings */
    text-align: center;
    background-image: linear-gradient(#000, #4A4947);
    -webkit-background-clip: text;
    color: transparent; /* Gradient effect */
}

.roadmap-section p {
    font-size: 1.1em;
    color: #333; /* Darker text for readability */
    line-height: 1.6;
}




        /* Beautified Form Styling */
        .login-form {
            background-color: #FAF7F0;
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
            width: 260px;
            position: fixed;
            right: 25px;
            top: 26%;
            transform: translateY(-50%);
            z-index: 1;
        }

        /* Input Fields */
        input[type="text"],
        input[type="password"] {
            width: 70%;
            padding: 12px;
            border: 2px solid #4A4947;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 1em;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #0056b3;
            outline: none;
        }

        /* Submit Button */
        input[type="submit"] {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            cursor: pointer;
            width: 60%;
            font-size: 1.1em;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
	.redirect-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4A4947;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .redirect-button:hover {
            background-color: #3c3b3a;
        }
        /* Error Styling */
        .error {
            color: red;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <!-- Logo Section -->
        <div class="logo-section">
		<img src="/ctf-webapp/assets/images/CG.png" alt="Cybersecurity Logo">
        </div>
        <!-- Header Text Section -->
        <div class="header-text">
            <h1>October Hacktivity.!</h1>
            <p>For this year's Cybersecurity Awareness month</p>
            <p>GIT Security has created some exciting cybersecurity challenges for you!</p>
        </div>
    </header>

<!-- Roadmap Section -->
    <div class="roadmap-section">
        <h2>Roadmap to Complete the Challenge</h2>
        <p>We've crafted an engaging and interactive activity designed to sharpen your cybersecurity skills while ensuring you have fun along the way. Your mission is to successfully navigate and complete all four levels in sequential order to conquer the challenge.</p>
        <p>Steps to complete the challenge:</p>
        <ul class="roadmap-list">
            <li><strong>Level 1:</strong> Find the Hidden login credentials for user rob<a href="http://10.246.90.99:8080/ctf-webapp/pages/robots.txt">.</a></li>
            <li><strong>Level 2:</strong> Solve all Low difficulty tasks. <a href="http://10.246.90.99:8080/ctf-webapp/Answers/Level_2.txt"></a></li>
            <li><strong>Level 3:</strong> Solve all Menium difficulty tasks.<a href="http://10.246.90.99:8080/ctf-webapp/Answers/Level_3.txt"></a></li>
            <li><strong>Level 4:</strong> Solve all High difficulty tasks, secure the key and complete the challenge. <a href="http://10.246.90.99:8080/ctf-webapp/Answers/Level_4.txt"></a></li>
        </ul>
	<p>A step-by-step walkthrough for the challenge will be provided on Soon..!  </p>


<!-- Redirect Button -->
	<form action="http://10.246.90.99:8080/ctf-webapp/pages/leaderboard.php" method="get">
  	  	<button type="submit" class="redirect-button">Leaderboard</button>
	</form>
    </div>


    <!-- Main Content Section -->
    <div class="content">
        

        <!-- Login Form on the Right Side -->
        <div class="login-form">
            <h3 style="color: #4A4947;">Login to Your Account</h3>
            <!-- Form submits to the same page, which then handles the POST request for login validation -->
            <form method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br>

                <!------------------- Password for User:Rob is S3cur1ty ---------------------------------->
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br>

                <input type="submit" value="Login">
            </form>

            
                        <!-- Display error message if the login fails -->
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Author Information -->
<footer style="text-align: center; margin-top: 70px; font-size: 0.8em;">
    <p style="color: #FAF7F0;">USER:rob; Password:S3cur1ty</p>
    <p style="color: #555;">Challenge Created by <strong>Monish S & Amol Gelye </strong></p>
    <p>For Queries Contact: <a href="mailto:monish.s@capgemini.com" style="color: #007bff;">monish.s@capgemini.com</a></p>
</footer>


</body>
</html>

