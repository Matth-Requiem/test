<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: http://localhost/projeto/login/login.php");
    exit();
}

$email = $_SESSION['email'];

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "nome_do_banco_de_dados";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Consulta SQL para buscar os dados do perfil do usuário
$sql = "SELECT * FROM usuarios WHERE email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Usuário encontrado, exibe os dados do perfil
    $row = $result->fetch_assoc();
    $nome = $row['nome'];
    $email = $row['email'];
    $foto = $row['foto'];

    // Fechar a conexão
    $conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="http://localhost/projeto/home/style.css">
    <link rel="stylesheet" href="styleperfil.css">
    <link rel="stylesheet" href="http://localhost/projeto/footer.css">
</head>
<body>
<nav>
    <ul>
      <li><a href="http://localhost/projeto/home/dashboard.php">Página Inicial</a></li>
      <li><a href="sobre.html">Sobre</a></li>
      <li><a href="http://localhost/projeto/perfil/perfil.php">perfil</a></li>
      <li><a href="http://localhost/projeto/cadastro/cadastro.html">Cadastro</a></li>
      <li><a href="http://localhost/projeto/login/login.php">Login</a></li>
    </ul>
  </nav>
<div class="perfilcontainer">

    <h2>Perfil do Usuário</h2>
    <p><strong>Foto de Perfil:</strong></p>
    <?php if (!empty($foto)) : ?>
        <img src="../cadastro/<?php echo $foto; ?>" alt="Foto de Perfil">

    <?php else: ?>
        <p>Nenhuma foto de perfil disponível.</p>
    <?php endif; ?>
    <p><strong>Nome:</strong> <?php echo $nome; ?></p>
    <p><strong>Email:</strong> <?php echo $email; ?></p>
    
    <form method="post" action="">
        <button type="submit" name="logout">Encerrar Sessão</button>
    </form>
    </div>
    <?php include '../footer.php'; ?>
</body>
</body>
</html>

<?php
} else {
    // Usuário não encontrado, redireciona para a página de login
    header("Location: http://localhost/projeto/login/login.php");
    exit();
}
?>
<?php

if (isset($_POST['logout'])) {
    // Encerrar sessão e redirecionar para a página de login
    session_unset();
    session_destroy();
    header("Location: http://localhost/projeto/login/login.php");
    exit();
}
?>