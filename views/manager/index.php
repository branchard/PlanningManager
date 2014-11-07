<div class="starter-template">
    <div class="row" id="connectinfo">
        <div class="col-md-8">
            <p>Bonjour <?php echo $name ?> <?php echo $surname ?> (<?php echo $pseudo ?>)</p>
        </div>
        <div class="col-md-4 text-right">
            <form method="link" action="<?php echo WEBROOT . 'logout'; ?>"><button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-log-out"></span> Déconnection</button></form>
        </div>
    </div>
    <?php if (isset($success['login'])): ?>
        <div class="alert alert-success">
            <p><span class="glyphicon glyphicon-ok"></span>
                <?php echo ' '.$success['login']; ?>
            </p>
        </div>
    <?php endif; ?>
    <form action="<?php echo WEBROOT; ?>manager" method="get">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputdate">Selectionner journée</label>
                    <input type="date" max="2015-12-31" min="2014-01-01" name="date" class="form-control" id="inputdate">
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-calendar"></span> Afficher journée</button>
    </form>
    <?php if(isset($dateerror)): ?>
        <div class="alert alert-danger">
            <p><span class="glyphicon glyphicon-remove"></span>
                <?php echo ' '.$dateerror; ?>
            </p>
        </div>
    <?php endif; ?>
</div>