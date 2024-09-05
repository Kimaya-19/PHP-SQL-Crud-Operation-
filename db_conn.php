<?php
/**
 * Database connection script.
 * 
 * This script establishes a connection to the MySQL database using mysqli.
 * 
 * @file      db_connect.php
 * @version   1.0
 * @date      2024-09-05
 * 
 * @note
 * Ensure you update the following variables with your actual database credentials:
 * - $servername
 * - $username
 * - $password
 * - $dbname
 * 
 * @usage
 * Include this file in your PHP scripts to establish a database connection.
 * 
 * Example:
 * ```
 * include 'db_connect.php';
 * ```
 */

// Database credentials
$servername = "localhost";
$username = "root"; // Update with your MySQL username
$password = ""; // Update with your MySQL password
$dbname = "DBName"; // Update with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
