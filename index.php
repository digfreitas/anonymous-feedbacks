<?php 
session_start();

$delay = 120;

if(isset($_SESSION['last_submit_time'])) {
    $time_since_last_submit = time() - $_SESSION['last_submit_time'];
    if ($time_since_last_submit < $delay) {
        $remaining_time = $delay - $time_since_last_submit;
        echo '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Aguarde</title>
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
                    border: 2px solid #ff9800;
                    border-radius: 10px;
                    background-color: #ffffff;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                    max-width: 500px;
                    margin: 0 auto;
                }
                .message h1 {
                    font-size: 2em;
                    color: #ff9800;
                    margin: 0;
                }
                .message p {
                    font-size: 1.2em;
                    color: #333;
                }
            </style>
        </head>
        <body>
            <div class="message">
                <h1>Aguarde!</h1>
                <p>Você precisa esperar ' . $remaining_time . ' segundos antes de enviar outro feedback.</p>
            </div>
        </body>
        </html>
        ';
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Anônimo</title>
</head>
<style>
    body {
        background-color: whitesmoke;
        margin-left: 15%;
        margin-right: 15%;
        margin-top: 6%;
        padding: 10%;
        border: 2px dashed black;
        text-align: center;
        font-family: 'Courier New', Courier, monospace;
        font-size: 19px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
    }
    select {
        width: 160px;
        height: 23px;
        margin-top: 15px;
        font-family: 'Courier New', Courier, monospace;
        border: 1.5px solid black;
    }
    textarea {
        margin-top: 15px;
        border: 1.5px solid black;
    }
    input {
        background-color: white;
        color: black;
        font-size: 16px;
        font-weight: bold;
        width: 85px;
        height: 25px;
        border-radius: 5px;
    }
    input:hover {
        cursor: pointer;
        background-color: #575757;
    }
</style>
<body>
    <form action="processar_feedback.php" method="post">
        <label for="feedback">Deixe seu feedback:</label><br>
        <textarea name="feedback" id="feedback" rows="4" cols="50" required></textarea><br>
        <label for="categoria">Categoria:</label><br>
        <select name="categoria" id="categoria">
            <option value="Sugestão">Sugestão</option>
            <option value="Crítica">Crítica</option>
            <option value="Elogio">Elogio</option>
            <option value="Outro">Outro</option>
        </select><br><br>
        <input type="submit" value="Enviar"> 
    </form>
</body>
</html>