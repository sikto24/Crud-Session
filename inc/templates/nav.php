<?php

if (!isset($_SESSION)) {
    session_start();
} else {
    session_destroy();
    session_start();
}

?>
<nav>
    <ul>
        <li><a href="index.php?task=report">All Students</a></li>
        <li><a href="index.php?task=add">Add New Student</a></li>
        <li><a href="index.php?task=seed">Seed</a></li>
    </ul>
    <div class="login">
        <?php if (!$_SESSION['loggedin']) : ?>
            <a href="login.php">Login</a>
        <?php else : ?>
            <a href="login.php?logout=true">logout (<?php echo $_SESSION['user'] ?>)</a>
        <?php endif; ?>
    </div>
</nav>
<!-- Change -->