<?php
// Include the database configuration
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'ctf_webapp');

// Function to get database connection
function getDB() {
    $dbConnection = null;
    try {
        $dbConnection = new PDO(
            "mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE,
            DB_USERNAME,
            DB_PASSWORD
        );
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Database connection error: " . $e->getMessage();
        exit();
    }
    return $dbConnection;
}

// Fetch leaderboard data
$conn = getDB(); // Establish the database connection

$sql = "SELECT email, score, timestamp FROM user_scores ORDER BY score DESC, timestamp ASC"; 
$stmt = $conn->prepare($sql);
$stmt->execute();

$leaderboard = [];
if ($stmt->rowCount() > 0) {
    $rank = 1; // Initialize rank
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $leaderboard[] = [
            'rank' => $rank++,
            'email' => $row['email'],
            'score' => $row['score'],
            // No completion_time as it's no longer needed
        ];
    }
}

// No need to explicitly close the connection with PDO
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
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

        table {
            width: 70%;
    	border-collapse: collapse; /* Ensure borders collapse to avoid double borders */
    	margin: 20px auto;
    	background-color: #F2EED7;
    	border: 2px solid #4A4947; /* Outer border */
    	border-radius: 10px;
    	overflow: hidden;
        }

        th, td {
            	padding: 12px;
    		text-align: center;
    		border: 1px solid #4A4947; /* Inner border */
        }

        th {
            	background-color: #4A4947;
    		color: white;
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

	
	 
 
 



    </style>
</head>
<body>

<h1>Leaderboard</h1>

<!-- Leaderboard Table -->
<table>
    <tr>
        <th>Rank</th>
        <th>Email</th>
        <th>Score</th>
    </tr>
    <?php foreach ($leaderboard as $entry): ?>
        <tr>
            <td><?php echo $entry['rank']; ?></td>
            <td><?php echo $entry['email']; ?></td>
            <td><?php echo $entry['score']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<!-- Redirect Button -->
<form action="http://10.246.90.99:8080/ctf-webapp/pages/index.php" method="get">
    <button type="submit" class="redirect-button">Home Page</button>
</form>

<footer style="text-align: center; margin-top: 70px; font-size: 0.8em;">
    <p style="color: #555;">Challenge Created by <strong>Monish S & Amol Gelye</strong></p>
</footer>


</body>
</html>
