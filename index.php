<?php
require 'db.php'; // Datenbankverbindung
//require 'functions.php'; // Hilfsfunktionen (falls benötigt)

// Route bestimmen
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Startseite: Bücher anzeigen
if ($path === '/') {
    $stmt = $pdo->query("SELECT * FROM books ORDER BY review_date DESC");
    $books = $stmt->fetchAll();

    // View laden
    include 'views/home.php';
}

// Route: Neues Buch hinzufügen
elseif ($path === '/add' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $coverNew = $_POST['coverNew'];
    $titleNew = $_POST['titleNew'];
    $reviewNew = $_POST['reviewNew'];
    $authorNew = $_POST['authorNew'];
    $dateNew = date('Y-m-d'); // Aktuelles Datum

    $stmt = $pdo->prepare("INSERT INTO books (url_book_cover, book_title, review_text, review_date, review_author) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$coverNew, $titleNew, $reviewNew, $dateNew, $authorNew]);

    header('Location: /');
    exit;
}

// Route: Buch löschen
elseif (preg_match('/\/delete\/(\d+)/', $path, $matches)) {
    $bookId = $matches[1];

    $stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");
    $stmt->execute([$bookId]);

    header('Location: /');
    exit;
}

// Route: Buch bearbeiten
elseif (preg_match('/\/edit\/(\d+)/', $path, $matches) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $bookId = $matches[1];
    $reviewText = $_POST['reviewText'];

    $stmt = $pdo->prepare("UPDATE books SET review_text = ? WHERE id = ?");
    $stmt->execute([$reviewText, $bookId]);

    echo "Review updated successfully";
    exit;
}

// Route: Alphabetisch sortieren
elseif ($path === '/sort/alpha') {
    $stmt = $pdo->query("SELECT * FROM books ORDER BY book_title ASC");
    $books = $stmt->fetchAll();

    include 'views/home.php';
}

// Route: Nach Datum sortieren (neueste zuerst)
elseif ($path === '/sort/latest') {
    $stmt = $pdo->query("SELECT * FROM books ORDER BY review_date DESC");
    $books = $stmt->fetchAll();

    include 'views/home.php';
}

// Route: Nach Datum sortieren (älteste zuerst)
elseif ($path === '/sort/oldest') {
    $stmt = $pdo->query("SELECT * FROM books ORDER BY review_date ASC");
    $books = $stmt->fetchAll();

    include 'views/home.php';
}

// Fehlerseite
else {
    http_response_code(404);
    echo "Seite nicht gefunden";
}
?>