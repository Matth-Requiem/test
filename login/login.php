
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/projeto/home/style.css">
    <link rel="stylesheet" href="http://localhost/projeto/cadastro/styleC.css">
    <link rel="stylesheet" href="http://localhost/projeto/footer.css">

     <title>Página de Login</title>

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
      <div class="efeito-vidro">
    <h2>Login</h2>
    <div class="formulario">
    <form action="processar_login.php" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br><br>

        <input type="submit" value="Entrar">
    </form>
</div>
</div>
  <?php include '../footer.php'; ?>
</body>
</html>