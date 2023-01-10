<?php
session_start();
session_destroy();
session_start();

require_once("templates/header.php");
require_once("dao/usuarioDao.php");
require_once("models/message.php");
require_once("dao/eventoDao.php");

$usuarioDao = new userDAO($conn, $BASE_URL);

if (isset($_POST["login"])) {
    echo $_POST['login'];
    echo $_POST['username'];
    echo $_POST['password'];

    if (empty($_POST['username']) || empty($_POST['password'])) {
        $message = '<label>Todos campos são obrigatórios</label>';
    } else {
        $query = "SELECT * FROM tb_user WHERE usuario_user = :username AND senha_user = :password";
        $usuarioDao = $conn->prepare($query);
        $usuarioDao->execute(
            array(
                'username'     =>     $_POST["username"],
                'password'     =>     $_POST["password"]
            )

        );
        echo "<br>";
        print_r($count = $usuarioDao->rowCount());
        if ($count > 0) {
            $_SESSION["username"] = $_POST["username"];
            header("location:cad_evento.php");
        } else {

            $message = '<label>Wrong Data</label>';
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Webslesson Tutorial | PHP Login Script using PDO</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>

<body>
    <br />
    <div class="container" style="width:500px;">
        <?php
        print_r($_SESSION);
        if (isset($message)) {
            echo '<label class="text-danger">' . $message . '</label>';
        }
        ?>
        <h3 align="">PHP Login Script using PDO</h3><br />
        <form method="post">
            <label>Username</label>
            <input type="text" name="username" class="form-control" />
            <br />
            <label>Password</label>
            <input type="password" name="password" class="form-control" />
            <br />
            <input type="submit" name="login" class="btn btn-info" value="Login" />
        </form>
    </div>
    <br />
</body>

</html>