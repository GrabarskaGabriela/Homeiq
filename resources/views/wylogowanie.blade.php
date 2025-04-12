<?php
session_start();

// Usunięcie zapamiętanych danych logowania jeśli istnieją
if (isset($_COOKIE['user_id']) && isset($_COOKIE['remember_token'])) {
    // Usunięcie ciasteczek
    setcookie('user_id', '', time() - 3600, '/');
    setcookie('remember_token', '', time() - 3600, '/');

    // Opcjonalnie: usunięcie tokenu z bazy danych
    require_once 'config/database.php';
    try {
        $stmt = $pdo->prepare("UPDATE uzytkownicy SET remember_token = NULL WHERE id = ?");
        $stmt->execute([$_COOKIE['user_id']]);
    } catch (PDOException $e) {
        // Błędy można obsłużyć cicho, aby nie zakłócać procesu wylogowania
    }
}

// Wyczyszczenie wszystkich zmiennych sesji
$_SESSION = array();

// Zniszczenie pliku cookie sesji
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Zniszczenie sesji
session_destroy();

// Przekierowanie na stronę główną
header("Location: index.php");
exit();