<?php
session_start();

// Verifica se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica se um arquivo de foto foi enviado
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoNome = $_FILES['foto']['name'];
        $fotoTmp = $_FILES['foto']['tmp_name'];

        // Diretório de destino para salvar as fotos de perfil
        $diretorioDestino = "http://localhost/projeto/cadastro/uploads/";

        // Gera um nome único para o arquivo usando o email do usuário e um timestamp
        $nomeUnico = md5($email . time()) . "." . pathinfo($fotoNome, PATHINFO_EXTENSION);

        // Move o arquivo temporário para o diretório de destino com o nome único
        $caminhoDestino = "uploads/" . $nomeUnico;
        if (move_uploaded_file($fotoTmp, $caminhoDestino)) {
            // Arquivo de foto movido com sucesso, continue com o processo de cadastro

            // Conexão com o banco de dados
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "nome_do_banco_de_dados";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Falha na conexão: " . $conn->connect_error);
            }

            // Verifica se o email já está cadastrado
            $sqlVerificaEmail = "SELECT email FROM usuarios WHERE email = '$email'";
            $resultVerificaEmail = $conn->query($sqlVerificaEmail);

            if ($resultVerificaEmail->num_rows > 0) {
                // O email já está cadastrado, exibe um pop-up com a mensagem de aviso e redireciona de volta para a tela de cadastro
                echo '<script>alert("Usuário já cadastrado."); window.location.href = "http://localhost/projeto/cadastro/cadastro.html";</script>';
            } else {
                // Insere os dados do usuário no banco de dados
                $sql = "INSERT INTO usuarios (nome, email, senha, foto) VALUES ('$nome', '$email', '$senha', '$caminhoDestino')";

                if ($conn->query($sql) === TRUE) {
                    // Cadastro realizado com sucesso
                    echo '<script>alert("Cadastro realizado com sucesso!"); window.location.href = "http://localhost/projeto/login/login.php";</script>';
                    exit();
                } else {
                    // Erro ao cadastrar usuário
                    echo "Erro ao cadastrar usuário: " . $conn->error;
                }
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
        } else {
            // Erro ao mover o arquivo de foto
            echo "Erro ao fazer o upload do arquivo.";
        }
    } else {
        // Nenhum arquivo de foto foi enviado
        echo "Erro ao enviar o arquivo de foto.";
    }
} else {
    // Redireciona para a página de cadastro se o formulário não foi enviado
    header("Location: http://localhost/projeto/cadastro/cadastro.html");
    exit();
}
?>