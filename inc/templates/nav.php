<?php

if (!isset($_SESSION)) {
    session_start();
}

?>
<nav>
    <ul>
        <li><a href="index.php?task=report">All Students</a></li>
        <?php if (hasPrivilage()) : ?>
            <li><a href="index.php?task=add">Add New Student</a></li>
            <?php if (isAdmin()) : ?>
                <li><a href="index.php?task=seed">Seed</a></li>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (!$_SESSION['loggedin']) : ?>
            <li> <a class="login" href="login.php">Login</a></li>
        <?php else : ?>
            <li><a class="login" href="login.php?logout=true">logout (<?php echo $_SESSION['user'] . "-" . $_SESSION['role'] ?>)</a></li>
        <?php endif; ?>
    </ul>

</nav>
<!-- Change -->