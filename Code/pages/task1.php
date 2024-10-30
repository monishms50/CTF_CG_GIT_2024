<?php
require_once '../includes/auth.php';

// Check if the user is logged in
if (!isLoggedIn() || getUserRole() !== 'user') {
    header("Location: ../pages/index.php");
    exit();
}

// Initialize task variables
$taskCompleted = false;
$completionKey = 'cap'; // Task 1 key
$completionCode = rand(1000000, 9999999); // Generate a random completion code

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the input values
    $apacheVersion = $_POST['apache_version'] ?? '';
    $opensslVersion = $_POST['openssl_version'] ?? '';
    $phpVersion = $_POST['php_version'] ?? '';

    // Define the correct versions
    $correctApacheVersion = '2.4.58';
    $correctOpenSSLVersion = '3.1.3';
    $correctPhpVersion = '8.2.12';

    // Check if all values are correct
    if ($apacheVersion === $correctApacheVersion && $opensslVersion === $correctOpenSSLVersion && $phpVersion === $correctPhpVersion) {
        // If all three are correct, mark task as completed
        $_SESSION['task1_completed'] = $completionCode;
        $taskCompleted = true;

        // Redirect back to dashboard after completion
        header("Location: dashboard.php");
        exit();
    } else {
        // If any value is incorrect, show an error message and don't mark the task as completed
        $error = "One or more versions are incorrect. Please try again!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1 - Find the versions</title>
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
        <h1>Task 1: Provide the correct versions</h1>

        <!-- Show error if the values are incorrect -->
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST">
            <label for="apache_version">Apache Version:</label>
            <input type="text" name="apache_version" id="apache_version" placeholder="*.*.**" required>

            <label for="openssl_version">OpenSSL Version:</label>
            <input type="text" name="openssl_version" id="openssl_version" placeholder="*.*.*" required>

            <label for="php_version">PHP Version:</label>
            <input type="text" name="php_version" id="php_version" placeholder="*.*.**" required>

            <button type="submit">Submit</button>
        </form>

        <a href="dashboard.php" class="logout-btn">Back to Dashboard</a>

<!-- Author Information -->
<div> 
<footer style="text-align: center; margin-top: 70px; font-size: 0.8em;">
    <p style="color: #555;">Challenge Created by <strong>Monish S & Amol Gelye </strong></p>
    <p>For Queries Contact: <a href="mailto:monish.s@capgemini.com" style="color: #007bff;">monish.s@capgemini.com</a></p>
</div>
</footer>
    </div>
 



</body>
</html>
