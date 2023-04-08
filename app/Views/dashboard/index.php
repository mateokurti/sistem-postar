<?php include __DIR__ . '/../common/head.php'; ?>
    <h1>Welcome, <?php echo $identity['first_name']; ?>!</h1>
    <p>You are logged in as <?php echo $identity['email']; ?>.</p>
    <p><a href="/auth/logout">Logout</a></p>
<?php include __DIR__ . '/../common/footer.php'; ?>