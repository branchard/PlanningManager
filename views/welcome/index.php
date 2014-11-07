<div class="starter-template">
    <h2>Connection</h2>
    <?php if (isset($errors['login'])): ?>
        <div class="alert alert-danger">
            <p><span class="glyphicon glyphicon-remove"></span>
                <?php echo ' '.$errors['login']; ?>
            </p>
        </div>
    <?php endif; ?>
    <form action="<?php echo WEBROOT; ?>login" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputname">Indentifiant</label>
                    <input type="text" name="username" class="form-control" id="inputname"
                        <?php
                        if (isset($inputs['login']['username']))
                        {
                            echo ' value="' . $inputs['login']['username'] . '"';
                        }
                        ?>
                        >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputpswd">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="inputpswd">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-log-in"></span> Se connecter</button>
    </form>
    <h2>Inscription</h2>
    <?php if (isset($errors['signup'])): ?>
        <div class="alert alert-danger">
            <p><span class="glyphicon glyphicon-remove"></span>
                <?php echo ' '.$errors['signup']; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if (isset($success['signup'])): ?>
        <div class="alert alert-success">
            <p><span class="glyphicon glyphicon-ok"></span>
                <?php echo ' '.$success['signup']; ?>
            </p>
        </div>
    <?php endif; ?>
    <form action="<?php echo WEBROOT; ?>signup" method="post">
        <div class="form-group">
            <label for="inputnewname">Indentifiant</label>
            <input type="text" name="username" class="form-control" id="inputnewname"
                <?php
                if (isset($inputs['signup']['username']))
                {
                    echo ' value="' . $inputs['signup']['username'] . '"';
                }
                ?>
                >
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputnamee">Prenom</label>
                    <input type="text" name="name" class="form-control" id="inputnamee"
                        <?php
                        if (isset($inputs['signup']['name']))
                        {
                            echo ' value="' . $inputs['signup']['name'] . '"';
                        }
                        ?>
                        >
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="surname">Nom</label>
                    <input type="text" name="surname" class="form-control" id="surname"
                        <?php
                        if (isset($inputs['signup']['surname']))
                        {
                            echo ' value="' . $inputs['signup']['surname'] . '"';
                        }
                        ?>
                        >
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputpswd1">Mot de passe</label>
                    <input type="password" name="password1" class="form-control" id="inputpswd1">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="inputpswd2">Retaper mot de passe</label>
                    <input type="password" name="password2" class="form-control" id="inputpswd2">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> S'inscrire</button>
    </form>
    <?php //phpinfo(); ?>
</div>