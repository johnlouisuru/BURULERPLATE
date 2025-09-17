<?php

//error_reporting(0);
/**
 * PHP Security & Sanitation + 404 Redirect Handler
 * Author: Buruler-PLate
 * Date: 2025-08-09
 *
 * Include this file at the top of all PHP scripts.
 * Handles:
 *  - Input sanitation
 *  - Secure DB queries
 *  - Safe 404 redirects
 */

// =========================
// BASIC SANITATION FUNCTIONS
// =========================

/**
 * Sanitize a string for HTML output
 */

if (session_status() === PHP_SESSION_NONE) {
    session_set_cookie_params([
        'lifetime' => 0, // until browser closes
        'path' => '/',
        'domain' => $_SERVER['HTTP_HOST'],
        'secure' => isset($_SERVER['HTTPS']), // only send cookie over HTTPS
        'httponly' => true, // JS can't access session cookie
        'samesite' => 'Strict' // or 'Lax'
    ]);
    session_start();
}

function clean_text($string) {
    return htmlspecialchars(trim($string), ENT_QUOTES, 'UTF-8');
}

/**
 * Validate integer
 */
function clean_int($number) {
    return filter_var($number, FILTER_VALIDATE_INT) !== false
        ? intval($number)
        : null;
}

/**
 * Validate email
 */
function clean_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false
        ? $email
        : null;
}

/**
 * Validate URL
 */
function clean_url($url) {
    return filter_var($url, FILTER_VALIDATE_URL) !== false
        ? $url
        : null;
}

/**
 * Whitelist check (only allow predefined values)
 */
function whitelist($value, $allowed_values) {
    return in_array($value, $allowed_values, true) ? $value : null;
}

/**
 * Sanitize file name
 */
function clean_filename($filename) {
    return preg_replace("/[^a-zA-Z0-9_\.-]/", "_", basename($filename));
}

// =========================
// DATABASE PROTECTION
// =========================

require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();         // throws error if .env is missing
// or
// $dotenv->safeLoad();  // skips if .env isn't found

// Optionally enforce required variables
$dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS'])->notEmpty();

$dsn = "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset={$_ENV['DB_CHARSET']}";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $_ENV['DB_USER'], '', $options);
    //echo"DB Connected!<br>";
} catch (PDOException $e) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Database connection failed', 'details' => $e->getMessage()]);
    exit;
}

/**
 * Run secure query
 */
function secure_query($db, $sql, $params) {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}

function authenticate_email($db, $sql, $email){
    //$sql = "SELECT * FROM admins WHERE email=:email";
     $stmt = $db->prepare($sql);
     $stmt->execute([":email" => $email]);
     return $stmt;
}

function secure_query_no_params($db, $sql) {
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt;
}

function secure_insert($db, $sql, $params) {
    $stmt = $db->prepare($sql);
    $stmt->execute($params);
    return $db->lastInsertId(); // return inserted ID
}

function get_last_port_of_call($db, $station_id){
     $sql = "SELECT station FROM cg_station WHERE id=:station_id";
     $stmt = $db->prepare($sql);
     $stmt->execute([":station_id" => $station_id]);
     $row = $stmt->fetch(PDO::FETCH_ASSOC);
     if($row){
        return $row['station'];
     }
     else {
        return 'Station Not Found';
     }
     
}

function get_type_of_vessel($db, $sql){
     $stmt = $db->prepare($sql);
     $stmt->execute();
     $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
     return $row;
     
}

//Getting Total Counts using query provided with 2 Parameters para sa $pdo at $query mismo
//Ang Return nito mismo ay yung Total
function get_total_count($db, $query){
    return secure_query_no_params($db, $query)->rowCount();
}
//=================================
// Usage on this secure_query
//========SELECT===================

//========INSERT===================
// $sql = "INSERT INTO users (username, email) VALUES (:username, :email)";
// $params = [
//     ":username" => "zoro",
//     ":email" => "zoro@onepiece.com"
// ];

// secure_query($pdo, $sql, $params);
//==================================



// =========================
// 404 REDIRECT HANDLER
// =========================

/**
 * Handle 404 Not Found with safe redirect
 */
function handle_404_redirect($redirect_to = '/') {
    // Send proper 404 HTTP status
    http_response_code(404);

    // Log the missing URL for review
    file_put_contents(
        __DIR__ . '/404_log.txt',
        date("Y-m-d H:i:s") . " - " . $_SERVER['REQUEST_URI'] . "\n",
        FILE_APPEND
    );

    // Redirect safely (whitelist check)
    $allowed_redirects = ['/', '/portal', '/blank'];
    if (in_array($redirect_to, $allowed_redirects, true)) {
        header("Location: $redirect_to", true, 302);
        exit();
    }

    // Fallback message if redirect not allowed
    echo "<h1>404 - Page Not Found</h1>";
    echo "<p>The page you are looking for does not exist.</p>";
    exit();
}
?>
