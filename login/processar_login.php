<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nome_do_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os dados do formulário
$email = $_POST['email'];
$senha = $_POST['senha'];

// Escapa caracteres especiais para evitar injeção de SQL
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);

// Consulta SQL para verificar o login
$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Login bem-sucedido
    session_start();
    $_SESSION['email'] = $email;
    header("Location: http://localhost/projeto/perfil/perfil.php");
    exit();
} else {
    // Login falhou
    echo "Login falhou. Verifique seu email e senha.";
}

// Fecha a conexão
$conn->close();
?>