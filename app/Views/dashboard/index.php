<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $identity['first_name']; ?>!</h1>
    <p>You are logged in as <?php echo $identity['email']; ?>.</p>
    <p><a href="/sign-out">Logout</a></p>
</body>
</html>