<?php
session_start();

if (!isset($_SESSION['email'])) {
    // Se o usuário não estiver logado, redireciona para a página de login
    header("Location: http://localhost/projeto/login/login.php");
    exit();
}

$email = $_SESSION['email'];

// Pasta de destino para salvar as fotos de perfil
$pastaDestino = "../cadastro/uploads/";

// Verifica se o arquivo foi enviado corretamente
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $nomeArquivo = $_FILES['foto']['name'];
    $nomeTemporario = $_FILES['foto']['tmp_name'];

    // Gera um nome único para o arquivo usando o email do usuário e um timestamp
    $nomeUnico = md5($email . time()) . "." . pathinfo($nomeArquivo, PATHINFO_EXTENSION);

    // Move o arquivo temporário para a pasta de destino com o nome único
    $caminhoDestino = $pastaDestino . $nomeUnico;
    if (move_uploaded_file($nomeTemporario, $caminhoDestino)) {
        // Salva o caminho da foto no banco de dados do usuário
        // ...

        // Redireciona para a página de perfil com a foto atualizada
        header("Location: perfil.php");
        exit();
    } else {
        echo "Falha ao fazer o upload do arquivo.";
    }
} else {
    echo "Erro ao enviar o arquivo.";
}
?>