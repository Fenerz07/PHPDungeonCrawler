<?php
echo "database démarré";
require_once __DIR__ . '/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Vérifiez que les variables d'environnement sont bien chargées
var_dump($_ENV);

try {
    $pdo = new PDO(
        'mysql:host=' . $_ENV['DB_HOST'] . ';dbname=' . $_ENV['DB_DATABASE'],
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données.";
} catch (PDOException $e) {
    // Affichez les erreurs de connexion à la base de données
    var_dump($e->getMessage());
    die("Erreur de connexion : " . $e->getMessage());
}
?>