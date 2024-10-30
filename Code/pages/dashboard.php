<?php
require_once '../includes/auth.php';

// Check if the user is logged in and is Rob (user)
if (!isLoggedIn() || getUserRole() !== 'user') {
    header("Location: ../pages/index.php");
    exit();
}

//ANALYTICS

// Initialize session variables if not already set
if (!isset($_SESSION['start_time'])) {
    $_SESSION['start_time'] = time(); // Store the start time
}

// Initialize user score if not already set
if (!isset($_SESSION['user_score'])) {
    $_SESSION['user_score'] = 0;// Initialize score
	
}


// Initialize tasks array with placeholders for status and keys
$scores = [
    'task0' => 5,
    'task1' => 0,
    'task2' => 0,
    'task3' => 0,
    'task4' => 0,
    'task5' => 0,
    'task6' => 0,
    'task7' => 0,
    'task8' => 0  
];


$tasks = [
    
    [
        'task' => 'Successful login as User Rob',
        'status' => 'Completed',
        'key' => 'C',
        'hint' => '',
        'completed' => true,
        'completionCode' => 'N/A',
        'link' => '', // No link needed for this task
	'points' => 5// Example points for this task
    ],

    [
        'task' => 'Task 1 - Finding Version',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'Error messages could be interesting sometimes.',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task1.php', // Task 1 link
	'points' => 0 // Example points for this task
    ],

    [
        'task' => 'Task 2 - Security Header',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'This security header controls access to features like the camera and microphone. What grants or denies these permissions?',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task2.php', // Task 2 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 3 - Stored in a jar',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'Cookies aren\'t healthy but now they\'re unsafe too',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task3.php', // Task 3 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 4 - Cryptography',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'Seek the guardian of your data exchange in the Developer Tools, where whispers of protocols and ciphers await discovery.',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task4.php', // Task 4 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 5 - Shared Resource',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'In the shadows of Network Shared resources, a simple file may hold the key. Seek and you shall find.',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task5.php', // Task 5 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 6 - Certificate Hash',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'The address is of high importance',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task6.php', // Task 6 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 7 - Grab a file',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'Check if you can transfer files Mr.Anonymous',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task7.php', // Task 7 link
	'points' => 0 // Example points for this task
    ],
    [
        'task' => 'Task 8  Insecure Validation',
        'status' => 'Incomplete',
        'key' => 'N/A',
        'hint' => 'Sometimes, what is hidden in the code can reveal more than you expect.',
        'completed' => false,
        'completionCode' => 'N/A',
        'link' => 'task8.php', // Task 8 link
	'points' => 0 // Example points for this task
    ]
];

// Check if each task is completed and update the tasks array accordingly
if (isset($_SESSION['task1_completed'])) {
    $tasks[1]['status'] = 'Completed';
    $tasks[1]['completed'] = true;
    $tasks[1]['key'] = '2I';  // Task 1 ke
    $tasks[1]['completionCode'] = $_SESSION['task1_completed'];
    $tasks[1]['points'] = 1; 
     $scores['task1'] = $tasks[1]['points']; // Update score correctly
    
}



if (isset($_SESSION['task2_completed'])) {
    $tasks[2]['status'] = 'Completed';
    $tasks[2]['completed'] = true;
    $tasks[2]['key'] = '734';  // Task 2 key
    $tasks[2]['completionCode'] = $_SESSION['task2_completed'];
    $tasks[2]['points'] = 1;
    $scores['task2'] = $tasks[2]['points']; // Update score correctly

	
}

if (isset($_SESSION['task3_completed'])) {
    $tasks[3]['status'] = 'Completed';
    $tasks[3]['completed'] = true;
    $tasks[3]['key'] = 'HS6';  // Task 3 key
    $tasks[3]['completionCode'] = $_SESSION['task3_completed'];
    $tasks[3]['points'] = 2;
     $scores['task3'] = $tasks[3]['points']; // Update score correctly

}

if (isset($_SESSION['task4_completed'])) {
    $tasks[4]['status'] = 'Completed';
    $tasks[4]['completed'] = true;
    $tasks[4]['key'] = '3BS';  // Task 4 key
    $tasks[4]['completionCode'] = $_SESSION['task4_completed'];
	$tasks[4]['points'] = 2;
	$scores['task4'] = $tasks[4]['points']; // Update score correctly
}

if (isset($_SESSION['task5_completed'])) {
    $tasks[5]['status'] = 'Completed';
    $tasks[5]['completed'] = true;
    $tasks[5]['key'] = '73';  // Task 5 key
    $tasks[5]['completionCode'] = $_SESSION['task5_completed'];
	$tasks[5]['points'] = 2;
	$scores['task5'] = $tasks[5]['points']; // Update score correctly
}

if (isset($_SESSION['task6_completed'])) {
    $tasks[6]['status'] = 'Completed';
    $tasks[6]['completed'] = true;
    $tasks[6]['key'] = 'Sj';  // Task 6 key
    $tasks[6]['completionCode'] = $_SESSION['task6_completed'];
	$tasks[6]['points'] = 2;
	$scores['task6'] = $tasks[6]['points']; // Update score correctly
}

if (isset($_SESSION['task7_completed'])) {
    $tasks[7]['status'] = 'Completed';
    $tasks[7]['completed'] = true;
    $tasks[7]['key'] = '83';  // Task 7 key
    $tasks[7]['completionCode'] = $_SESSION['task7_completed'];
	$tasks[7]['points'] = 5;
	$scores['task7'] = $tasks[7]['points']; // Update score correctly
}

if (isset($_SESSION['task8_completed'])) {
    $tasks[8]['status'] = 'Completed';
    $tasks[8]['completed'] = true;
    $tasks[8]['key'] = 'S';  // Task 8 key
    $tasks[8]['completionCode'] = $_SESSION['task8_completed'];
	$tasks[8]['points'] = 5;
	$scores['task8'] = $tasks[8]['points']; // Update score correctly
}

// At the end, check for completion and display the total score
$totalScore = $scores['task0']  + $scores['task1'] + $scores['task2'] + $scores['task3'] + $scores['task4'] + $scores['task5'] + $scores['task6'] + $scores['task7'] + $scores['task8'];
 //$_SESSION['user_score'];

// Initialize an empty string for the combined keys
$combinedKeys = '';
$allTasksCompleted = true; // Flag to check if all tasks are completed

// Loop through the tasks to build the combined keys string
foreach ($tasks as $task) {
    if ($task['completed']) {
        $combinedKeys .= $task['key'];
    } else {
        $allTasksCompleted = false; // If any task is incomplete, set the flag to false
    }
}

// Only show the combined keys output if all tasks are completed
$combinedKeysOutput = $allTasksCompleted ? $combinedKeys : 'N/A';

//Get User Ip
$userIp = $_SERVER['REMOTE_ADDR'];

//Logging User Data

$emailSuccessMessage = '';
$emailErrorMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = $_POST['email'] ?? '';

   // Validate the email to ensure it's a valid Capgemini email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) && strpos($email, '@capgemini.com') !== false) {
       // Log email, IP address, timestamp, and current score to a file
        $ipAddress = $_SERVER['REMOTE_ADDR'];
        $timestamp = date('Y-m-d H:i:s');
        $currentScore = $totalScore;
	
	// Calculate session duration
    		$sessionDuration = time() - $_SESSION['start_time']; // Duration in seconds
	
	// Log session duration along with user data
    		$minutes = floor($sessionDuration / 60);
    		$seconds = $sessionDuration % 60;
    		$logData = "Email: $email | IP Address: $userIp | Timestamp: $timestamp | Score: $currentScore | Duration: {$minutes}m {$seconds}s\n";
    
    	// Append Analytics data to the analytics_log.txt log file
    		$logFilePath = '../Logs/analytics_log.txt'; // Adjust this path as needed
    		file_put_contents($logFilePath, $logData, FILE_APPEND);


       // Append Score data to the User_Score_log.txt log file
        $logData = "Email: $email | IP Address: $ipAddress | Timestamp: $timestamp | Score: $currentScore\n";
        $logFilePath = '../Logs/User_Score_log.txt'; // Correct file path based on your directory structure
        file_put_contents($logFilePath, $logData, FILE_APPEND);

        // Success message
        $emailSuccessMessage = 'Your Scores have been successfully logged!';
        
	

    } else {
        // Error message for invalid email
        $emailErrorMessage = 'Invalid email address. Please enter a valid email in the format: yourname@capgemini.com';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rob's Dashboard</title>
<style>
    body {
            font-family: 'Roboto', sans-serif;
    	    background-color: #FAF7F0;
    	    margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
	h1 {
            color: #4A4947;
        }

    .container {
        width: 100%; /* Added */
        text-align: center; /* Added */
    }

    .task-table {
        width: 90%;
        border-collapse: collapse;
        margin: 20px auto; /* Changed to auto */
        background-color: #F2EED7;
        border-radius: 10px;
        overflow: hidden;
	border: 1px solid #ccc;
	
    }


    .task-table th, .task-table td {
        padding: 12px;
        text-align: center;
        border-bottom: 1px solid #4A4947;
    }

    .task-table th {
        background-color: #4A4947;
        color: white;
    }

    .task-table .completed {
        background-color: #28a745;
        color: white;
    }

    .task-table .incomplete {
        background-color: #f8d7da;
        color: #721c24;
    }

    .task-table .key {
        color: #007bff;
        font-weight: bold;
    }

    .task-table .task-link {
        color: #007bff;
        text-decoration: none;
    }

    .logout-btn {
        display: block;
        width: 300px;
        margin: 20px auto;
        padding: 10px;
        text-align: center;
        background-color: #dc3545;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        text-transform: uppercase;
    }

    .logout-btn:hover {
        background-color: #c82333;
    }

    .hint-button {
        cursor: pointer;
        background-color: #007bff;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .hint-text {

        display: none;
        margin-top: 5px;
        font-size: 14px;
        color: #666;
    }





/* Pop-up Styles */
#logoutPopup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1000;
    justify-content: center;
    align-items: center;
}

#logoutPopup > div {
    background: white;
    margin: 15% auto;
    padding: 20px;
    width: 300px;
    border-radius: 8px;
    text-align: center;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease, opacity 0.3s ease;
}

#logoutPopup h2 {
    margin-bottom: 15px;
}

#logoutPopup input[type="email"],
#logoutPopup input[type="submit"] {
    width: 90%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-shadow: inset 0 2px 5px rgba(0, 0, 0, 0.1);
    transition: border-color 0.2s ease;
}

#logoutPopup input[type="email"]:focus {
    border-color: #007bff;
    outline: none;
}

#logoutPopup input[type="submit"] {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

#logoutPopup input[type="submit"]:hover {
    background-color: #0056b3;
}

#logoutPopup button {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

#logoutPopup button:hover {
    background-color: #c82333;
}









</style>

</head>
<body>

    <div class="container">
        <h1>Dashboard</h1>
<!-- Display User Score -->
<p style="font-weight: bold;">Your Score: <?php echo $totalScore; ?></p>


<p style="text-align: center; font-size: 0.9em;">
    Combine all the keys and use that final phrase to login to the Admin account. 
    <?php if ($allTasksCompleted): ?>
         The <strong style="color: green;">Admin</strong> password is: <strong style="color: green;"><?php echo $combinedKeysOutput; ?></strong>
    <?php else: ?>
        All tasks must be completed to generate the Superkey.
    <?php endif; ?>
</p>
        

        <!-- Task Table -->
        <table class="task-table">
            <thead>
                <tr>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Points</th>
		    <th>Key</th>
                    <th>Hint</th>
                </tr>
            </thead>
            <tbody>
                 <?php foreach ($tasks as $index => $task): ?>
    <tr>
        <td>
            <span style="color: <?php
                if ($index == 7 || $index == 8) {
                    echo 'red'; 		// Red 
                } elseif ($index == 3 || $index == 4 || $index == 5 || $index == 6) {
                    echo 'orange'; 		// Orange 
                } elseif ($index == 1 || $index == 2) {
                    echo '#5cb85c'; 		// Mild green 
                }
            ?>; font-weight: bold; font-size: 0.8em;">
                <?php
                    if ($index == 7 || $index == 8) {
                        echo 'Hard'; 		// H 
                    } elseif ($index == 3 || $index == 4 || $index ==5  || $index == 6) {
                        echo 'Medium  '; 		// M 
                    } elseif ($index == 1 || $index == 2) {
                        echo 'Easy  '; 		// L 
                    }
                ?>
            </span>
            <a href="<?php echo $task['link']; ?>"  class="task-link">
                <?php echo $task['task']; ?>
            </a>
        </td>
        <td class="<?php echo $task['completed'] ? 'completed' : 'incomplete'; ?>">
            <?php echo $task['status']; ?>

        </td>

	 <td><?php echo $task['points']; ?></td> <!-- Points Column Data -->
                  

        <td class="key">
            <?php echo $task['completed'] ? $task['key'] : 'N/A'; ?>
        </td>
        <td>
            <button class="hint-button" onmousedown="showHint(this)" onmouseup="hideHint(this)" ontouchstart="showHint(this)" ontouchend="hideHint(this)">
                Show Hint
            </button>
            <div class="hint-text">
               <?php echo addslashes($task['hint']); ?>
       
            </div>
        </td>
    </tr>
    <?php endforeach; ?>
            </tbody>
        </table>

    </div>


<!-- Logout Pop-up JS-->
<script>
function openLogoutPopup() 
	{
    	document.getElementById('logoutPopup').style.display = 'block';
	}

function closeLogoutPopup() 
	{
    	document.getElementById('logoutPopup').style.display = 'none';
	}

        function showAlert1() {
            alert("The Email has been logged successfully");
        }
 
</script>




    <script>
         // Function to show hint on mouse down (click and hold)
        function showHint(button) {
            const hintText = button.nextElementSibling;
            hintText.style.display = 'inline';
        }

        // Function to hide hint on mouse up (release)
        function hideHint(button) {
            const hintText = button.nextElementSibling;
            hintText.style.display = 'none';
        }
    </script>



<!-- Logout button -->
	<a href="#" class="logout-btn" onclick="openLogoutPopup()">Submit Your Score & Logout</a>

<!-- Logout Pop-up -->
<div id="logoutPopup">
    <div>
        <h2>Enter Your CG Email</h2>
        <form method="POST" id="emailForm" onsubmit="return handleFormSubmit(event);">
            <input type="email" name="email" placeholder="Your email (e.g. yourname@capgemini.com)" required>
            <button style="background-color: green; text-align: center;" type="submit">Submit</button>
        </form>

        <button onclick="closeLogoutPopup()">Cancel</button>

        <!-- Success Message Display -->
        <?php if (!empty($emailSuccessMessage)): ?>
            <div id="successMessage" onload="showAlert()" style="color: green; text-align: center; margin: 20px;">
        		The Email has been logged successfully
    		</div>
	    </script>
            <script>
                setTimeout(function() {
                    window.location.href = '../pages/logout.php'; // Redirect after 1 seconds
                }, 500);
            </script>
        <?php endif; ?>

        <?php if (!empty($emailErrorMessage)): ?>
            <script>
                alert("The Email Is wrong. It must be a capgemini email");
            </script>
        <?php endif; ?>

    </div>
</div>




 <!-- Author Information -->
<footer style="text-align: center; margin-top: 70px; font-size: 0.8em;">
    <p style="color: #555;">Challenge Created by <strong>Monish S & Amol Gelye </strong></p>
    <p>For Queries Contact: <a href="mailto:monish.s@capgemini.com" style="color: #007bff;">monish.s@capgemini.com</a></p>
</footer>

</body>
</html>
