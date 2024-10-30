<?php
require_once '../includes/auth.php';

// Check if the user is logged in and is Admin
if (!isLoggedIn() || getUserRole() !== 'admin') {
    header("Location: ../pages/index.php");
    exit();
}

// Check if email is submitted and is valid
$successMessage = '';
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';

    // Validate the email to ensure it's a valid Capgemini email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@capgemini.com') !== false) {
        // Success message
        $successMessage = 'Congratulations! You have successfully completed the challenge.';

        // Log email, IP address, and timestamp to a file
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $timestamp = date('Y-m-d H:i:s');

        // Append the data to a log file in the correct location
        $logData = "Email: $email | IP Address: $ipAddress | Timestamp: $timestamp\n";
        $logFilePath = '../Logs/User_Score_log.txt'; // Correct file path based on your directory structure
        file_put_contents($logFilePath, $logData, FILE_APPEND);
    } else {
        // Error message for invalid email
        $errorMessage = 'Invalid email address. Please enter a valid email in the format: yourname@capgemini.com';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #FAF7F0;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: backgroundChange 0.5s infinite alternate;
        }

       @keyframes backgroundChange 
		{
            0% { background-color: #FEF9F2; } 
            100% { background-color: #FFE3E3; } 
		}
        .container {
            text-align: center;
            background-color:  #F2EED7;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            max-width: 1200px;
        }

        h1 {
            font-size: 2rem;
            color: #4A4947;
        }

        .message {
            font-size: 1.2rem;
            color: #28a745;
            margin: 20px 0;
        }

        .email-form input[type="email"] {
            padding: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 80%;
            margin: 10px 0;
        }

        .email-form input[type="submit"] {
            padding: 15px 30px;
            background-color: #4A4947;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .email-form input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .congratulations {
            font-size: 2rem;
            font-weight: bold;
            color: #28a745;
            margin: 20px 0;
           
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin: 20px 0;
        }

        
	.logout-btn {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #B17457;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            text-transform: uppercase;
	    animation: beep 1s infinite alternate;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
	
	
       

    </style>
</head>
<body>

    <div class="container">
        <h1 class="congratulations">Admin Dashboard</h1>

        <!-- Check if the email submission was successful -->
        <?php if ($successMessage): ?>
            <p class="congratulations"><?php echo $successMessage; ?></p>
	    <!--<iframe src="../pages/leaderboard.php" title="Embedded Content" style="width: 5in; height: 5in; overflow: hidden;" scrolling="no"></iframe>-->
	     <iframe src="../pages/leaderboard.php" title="Embedded Content" style="width: 5in; height: 6in; overflow: hidden; pointer-events: none;" scrolling="no"></iframe>


        <?php elseif (!empty($errorMessage)): ?>
            <p class="error-message"><?php echo $errorMessage; ?></p>
        <?php else: ?>
            <p class="message">Please enter your official email ID to complete the challenge:</p>
            
            <!-- Email input form -->
            <form method="POST" class="email-form">
                <input type="email" name="email" placeholder="Your email (e.g. yourname@capgemini.com)" required><br>
                <input type="submit" value="Submit">
            </form>
        <?php endif; ?>

        <!-- Logout button -->
        <a href="../pages/logout.php" class="logout-btn">Logout</a>
	
    </div>

</body>
</html>
