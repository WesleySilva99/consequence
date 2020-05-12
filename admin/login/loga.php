<?php


include($_SERVER['DOCUMENT_ROOT'] . '/util/conexao.php');

try {
    $email = $_POST['email'];
    $senha = $_POST['pass'];

    $sql = "select * from usuario where email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(1, $email);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($resultado) == 0) {
        session_destroy();
        session_start();
        $msg = "Login ou senhas Incorreto(s)!";
        $_SESSION['msg'] = $msg;
        header("Location: /login");
    }

    foreach ($resultado as $linha) {

        if (password_verify($senha, $linha["senha"])) {
            session_destroy();
            session_start();

            $_SESSION["email"] = $linha["email"];
            $_SESSION["nome"] = $linha["nome"];
            $_SESSION["id"] = $linha["id"];
            $_SESSION["admin"] = $linha["admin"];


            header("Location: " . '/index.php');
        } else {
            session_destroy();
            session_start();
            $msg = "Login ou senhas Incorreto(s)!";
            $_SESSION['msg'] = $msg;
            header("Location: /login");
        }
    }
} catch (Exception $e) {
    session_destroy();
    session_start();
    $msg = "Ocorreu algum erro no servidor, entre em contato com o adminstrador!";
    $_SESSION['msg'] = $msg;
    header("Location: /login");
}

?>