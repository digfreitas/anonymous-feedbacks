<?php 
session_start();

$delay = 120;

$_SESSION['last_submit_time'] = time();

$host = 'localhost';
$dbname = 'feedback_db';
$username = 'root';
$password = '74396Gr8!';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $feedback = $_POST['feedback'];
    $categoria = $_POST['categoria'];

    $stmt = $conn->prepare("INSERT INTO feedbacks (feedback, categoria) VALUES (:feedback, :categoria)");
    $stmt->bindParam(':feedback', $feedback);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->execute();

    echo '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sucesso</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
                background-color: #f0f0f0;
                font-family: Arial, sans-serif;
            }
            .message {
                text-align: center;
                padding: 20px;
                border: 2px solid #4CAF50;
                border-radius: 10px;
                background-color: #ffffff;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            }
            .message h1 {
                font-size: 2em;
                color: #4CAF50;
                margin: 0;
            }
            .message p {
                font-size: 1.2em;
                color: #333;
            }
        </style>
        <script>
            // Redirecionar após 3 segundos
            setTimeout(function() {
                window.location.href = "index.php";
            }, 3000);
        </script>
    </head>
    <body>
        <div class="message">
            <h1>Obrigado!</h1>
            <p>Feedback enviado com sucesso!</p>
        </div>
    </body>
    </html>
    ';
    
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;