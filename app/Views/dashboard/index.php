<?php include '../common/head.php';?>
    <h1>Welcome, <?php echo $identity['first_name']; ?>!</h1>
    <p>You are logged in as <?php echo $identity['email']; ?>.</p>
    <p><a href="/sign-out">Logout</a></p>
<?php include '../common/footer.php';?>

