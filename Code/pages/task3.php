<?php
require_once '../includes/auth.php';

// Check if the user is logged in and is Rob (user)
if (!isLoggedIn() || getUserRole() !== 'user') {
    header("Location: ../pages/index.php");
    exit();
}

// Initialize task variables
$taskCompleted = false;
$flagCookieName = 'flag';
$completionKey = rand(1000000, 9999999); // Generate a random completion code

// Set the flag cookie if it is not already set
if (!isset($_COOKIE[$flagCookieName])) {
    // Set the flag cookie (flag_cookie_task_23432)
    setcookie($flagCookieName, 'flag_cookie_task_23432', time() + 36000, "/"); // Cookie expires in 10 hour
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $answer = $_POST['answer'] ?? '';

    // Check if the answer is correct by comparing with the flag cookie
    if (strtolower($answer) === strtolower($_COOKIE[$flagCookieName])) {
        // Mark task as completed by storing the completion code in session
        $_SESSION['task3_completed'] = $completionKey;
        $taskCompleted = true;

        // Redirect back to dashboard after completion
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Incorrect answer. Try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 3 - Guess the Name</title>
    <style>
       body {
            font-family: 'Roboto', sans-serif;
            background-color: #FAF7F0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 800px;
            width: 100%;
            padding: 30px;
            background-color: #F2EED7;
            border-radius: 12px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.6);
            text-align: center;
        }

        h1 {
            color: #4A4947;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            color: #dc3545;
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        form {
            margin-top: 20px;
        }

        label {
            font-size: 1.1em;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"] {
            width: 75%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #007bff;
            border-radius: 8px;
            font-size: 1.1em;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #0056b3;
            outline: none;
        }

        button {
            background-color: #4A4947;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            width: 30%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .logout-btn {
            display: block;
            width: 180px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #dc3545;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1em;
            text-transform: uppercase;
            transition: background-color 0.3s;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        .hint {
            margin-top: 10px;
            font-size: 1.1em;
            color: #28a745;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Task 3: Find the hidden Flag</h1>

        <!-- Show error if the answer is incorrect -->
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" >
            <label for="answer">Clue: Session is persisted using a token which is stored in a jar)</label>
            <input type="text" name="answer" id="answer" placeholder="flag_*o***e_task_*****" required>
            <button type="submit">Submit</button>
        </form>

        <!-- Redirect back to the dashboard button -->
        <a href="dashboard.php" class="logout-btn">Back to Dashboard</a>
    
 	<!-- Author Information -->
		<footer style="text-align: center; margin-top: 70px; font-size: 0.8em;">
    			<p style="color: #555;">Challenge Created by <strong>Monish S & Amol Gelye </strong></p>
    			<p>For Queries Contact: <a href="mailto:monish.s@capgemini.com" style="color: #007bff;">monish.s@capgemini.com</a></p>
		</footer>
    </div>
</body>
</html>
