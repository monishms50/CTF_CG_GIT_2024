<?php
// Database configuration
define('DB_SERVER', 'localhost');    // Typically 'localhost'
define('DB_USERNAME', 'root');       // Default MySQL username in XAMPP
define('DB_PASSWORD', '');           // Default password (empty by default in XAMPP)
define('DB_DATABASE', 'ctf_webapp'); // Ensure this matches your actual database name

// Function to get database connection
function getDB() {
    $dbConnection = null;
    try {
        // Create a new PDO connection
        $dbConnection = new PDO(
            "mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE,
            DB_USERNAME,
            DB_PASSWORD
        );
        // Set PDO attributes for error handling
        $dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Error handling if connection fails
        echo "Database connection error: " . $e->getMessage();
        exit(); // Exit script if unable to connect
    }
    return $dbConnection; // Return the DB connection
}
