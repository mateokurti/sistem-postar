<!DOCTYPE html>
<html>
<head>
    <title>Sign In</title>
</head>
<body>
    <h1>Sign In</h1>

    <?php if (isset($_SESSION['flash']['error'])): ?>
            <div style="color: red;">
                <?= $_SESSION['flash']['error']; ?>
            </div>
    <?php endif; ?>

    <form method="post" action="/sign-in">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
