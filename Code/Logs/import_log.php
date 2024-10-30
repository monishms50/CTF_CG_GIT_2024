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

// Function to log user scores
function logUserScore($email, $ipAddress, $timestamp, $score) {
    $db = getDB();

    // Check if the email already exists
    $stmt = $db->prepare("SELECT score FROM user_scores WHERE email = ?");
    $stmt->execute([$email]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
        // Email exists, compare scores
        if ($score > $existing['score']) {
            // Update the record with new values
            $updateStmt = $db->prepare("UPDATE user_scores SET ip_address = ?, timestamp = ?, score = ? WHERE email = ?");
            $updateStmt->execute([$ipAddress, $timestamp, $score, $email]);
            echo "Score updated for $email!<br>";
        } else {
            echo "Incoming score is not higher than the existing score for $email. No update made.<br>";
        }
    } else {
        // Email does not exist, insert new record
        $insertStmt = $db->prepare("INSERT INTO user_scores (email, ip_address, timestamp, score) VALUES (?, ?, ?, ?)");
        $insertStmt->execute([$email, $ipAddress, $timestamp, $score]);
        echo "New record added for $email!<br>";
    }
}

// Path to your log file
$logFile = '../Logs/User_Score_log.txt';

// Read and process the log file
if (file_exists($logFile)) {
    $lines = file($logFile);
    
    foreach ($lines as $line) {
        // Use regex to extract the relevant data
        if (preg_match('/Email:\s*(.+?)\s*\|\s*IP Address:\s*(.+?)\s*\|\s*Timestamp:\s*(.+?)\s*\|\s*Score:\s*(\d+)/', $line, $matches)) {
            $email = trim($matches[1]);
            $ipAddress = trim($matches[2]);
            $timestamp = trim($matches[3]);
            $score = intval(trim($matches[4]));

            // Log the user score
            logUserScore($email, $ipAddress, $timestamp, $score);
        }
    }
} else {
    echo "Log file not found.";
}
?>
