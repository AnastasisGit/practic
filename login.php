

<?php
    session_start();
    include('config.php');
    if (isset($_POST['login'])) {
        $name = $_POST['username'];
        $parol = $_POST['password'];
        $query = $connection->prepare("SELECT * FROM users WHERE username=:username");
        $query->bindParam("username", $name, PDO::PARAM_STR);
        $query->execute();
        $resultat = $query->fetch(PDO::FETCH_ASSOC);
        if (!$resultat) {
            echo '<p class="error">Username password combination is wrong!</p>';
        } else {
            if (password_verify($parol, $resultat['password'])) {
                $_SESSION['user_id'] = $resultat['id'];
                echo '<p class="success">Congratulations, you are logged in!</p>';
                header('Location: indexTwo.html');
            } else {
                echo '<p class="error">Username password combination is wrong!</p>';
            }
        }
    }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<form method="post" action="" name="signin-form">
  <div class="form-element">
    <label>Username</label>
    <input type="text" name="username" pattern="[a-zA-Z0-9]+" required />
  </div>
  <div class="form-element">
    <label>Password</label>
    <input type="password" name="password" required />
  </div>
  <button type="submit" name="login" value="login">Log In</button>
</form>
</body>
</html>

