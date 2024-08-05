<?php 

$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root';
$password = '74396Gr8!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM feedbacks ORDER BY data_envio DESC");
    $stmt->execute();
    $feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($feedbacks as $feedback) {
        echo "<div>";
        echo "<p><strong>Categoria:</strong> " . htmlspecialchars($feedback['categoria']) . "</p>";
        echo "<p><strong>Feddback:</strong> " . nl2br(htmlspecialchars($feedback['feedback'])) . "</p>";
        echo "<p><small><strong>Data:</strong> " . $feedback['data_envio'] . "</small></p>";
        echo "<hr>";
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;