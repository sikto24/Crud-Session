<?php
if (!isset($_SESSION)) {
    session_start();
}
$error = false;
$fp = fopen('data/users.txt', 'r');

$username = filter_input(INPUT_POST, 'username', FILTER_DEFAULT);
$password = filter_input(INPUT_POST, 'password', FILTER_DEFAULT);
if ($username && $password) {
    $_SESSION['loggedin'] = false;
    $_SESSION['user'] = false;
    while ($user = fgetcsv($fp)) {
        if ($user[0] == $username && $user[1] == md5($password) && !empty($user[2])) {

            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $username;
            $_SESSION['role'] = $user[2];
            header('location:index.php');
        }
        if (!$_SESSION['loggedin']) {
            $error = true;
        }
    }
}

if (isset($_GET['logout'])) {
    $_SESSION['loggedin'] = false;
    $_SESSION['user'] = false;
    header('location: index.php');
    session_destroy();
}

// session_destroy();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- CSS Reset -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <!-- Milligram CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <?php
    if (true == $error) {
        echo " <blockquote>UserName and PassWord Didnot matced.</blockquote>";
    }
    ?>

    <section class="login-area-wrapper">
        <div class="container">
            <form method="post">
                <fieldset>
                    <label for="username">Name</label>
                    <input type="text" name="username" placeholder="UserName" id="nameField">
                    <label for="password">PassWord</label>
                    <input type="password" name="password" placeholder="password" id="password">
                    <input class="button-primary" type="submit" value="Send">
                </fieldset>
            </form>
        </div>
    </section>

</body>

</html>