<?php include includes/header.php ?>
	<section id="login-form-section">
            <form id="main-login" method="post" action="login.php" class="login">
                <p>
                    <label for="login">Username:</label>
                    <input type="text" name="login" id="login" placeholder="Jean Mouloude"><!-- Faudrait que le place holder disparraisse au clic -->
                </p>

                    <p>
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="MotDePasse">
                    </p>

                    <p class="login-submit">
                        <button type="submit" class="login-button">Login</button>
                    </p>
            </form>
        </section>
<?php include includes/footer.php ?>
