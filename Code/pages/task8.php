<?php
session_start(); // Start the session

// Check if the session indicates the task is completed
$taskCompleted = isset($_SESSION['task8_completed']) && $_SESSION['task8_completed'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $data = json_decode(file_get_contents('php://input'), true);

    // Check if the taskCompleted flag is set
    if (isset($data['taskCompleted'])) {
        // Mark task as completed by storing a session variable
        $_SESSION['task8_completed'] = true;
        http_response_code(200); // Success
        echo json_encode(['message' => 'Task marked as completed.']);
        exit();
    } else {
        http_response_code(400); // Bad request
        echo json_encode(['message' => 'Invalid request.']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 8 - Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
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
            color:  #4A4947;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .error {
            color: #dc3545;
            margin-bottom: 20px;
            font-size: 1.1em;
        }

        input[type="text"],
        input[type="password"] {
            width: 75%; /* Set width to match the input fields */
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #007bff;
            border-radius: 8px;
            font-size: 1.1em;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #0056b3;
            outline: none;
        }

        button {
            background-color:  #4A4947;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            width: 30%; /* Full width button */
            max-width: 200px; /* Limit the button size */
            margin: 0 auto; /* Center the button */
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

        <?php if ($taskCompleted): ?>
            .success {
                color: #28a745;
                margin-top: 20px;
                font-size: 1.1em;
            }
        <?php endif; ?>
    </style>
    <script>
        function validateLogin(event) {
            event.preventDefault(); // Prevent form submission

            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            // Hardcoded credentials for validation
            const correctUsername = 'dummyuser';
            const correctPassword = 'Akw34nc@2Dn';

            // Check if the credentials are correct
            if (username === correctUsername && password === correctPassword) {
                // Send AJAX request to set session and mark task as completed
                fetch('task8.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({ taskCompleted: true })
                })
                .then(response => {
                    if (response.ok) {
                        // Redirect to the dashboard
                        window.location.href = "dashboard.php";
                    } else {
                        document.getElementById('error').textContent = "Error marking task as completed.";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('error').textContent = "An error occurred. Please try again.";
                });
            } else {
                // Show error message
                document.getElementById('error').textContent = "Incorrect username or password. Try again!";
            }
        }
    </script>
</head>
<body>

    <div class="container">
        <h1>Login to complete this task</h1>

        <!-- Show error if the credentials are incorrect -->
        <p id="error" class="error"></p>
<p>This login form handles the validitation in an insecure way.</p>
        <form id="loginForm" method="POST" onsubmit="validateLogin(event)">
            <input type="text" id="username" name="username" placeholder="Username" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <?php if ($taskCompleted): ?>
            <p class="success">Task completed!</p>
        <?php endif; ?>

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
