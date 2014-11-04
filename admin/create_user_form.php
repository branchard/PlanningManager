<?php
define('ROOT_PATH', '../');
define('INCLUDES_PATH', '../includes/');
include INCLUDES_PATH . 'header.php'; ?>
	<h2 class="red">ADMIN</h2>
    <section id="login-form-section">
        <form id="main-login" method="post" action="create_user.php" class="login">
            <p>
                <label for="login">Username:</label>
                <input type="text" name="login" id="login" placeholder="Jean Mouloude">
            </p>

            <p>
                <label for="password">Password:</label>
                <input type="text" name="password" id="password" placeholder="MotDePasse">
            </p>

            <p class="login-submit">
                <button type="submit" class="login-button">Login</button>
            </p>
        </form>
    </section>
<?php include INCLUDES_PATH . 'footer.php'; ?>
