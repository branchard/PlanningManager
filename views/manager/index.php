<div class="starter-template">
    <div class="row" id="connectinfo">
        <div class="col-md-8">
            <p>Bonjour <?php echo $name ?> <?php echo $surname ?> (<?php echo $pseudo ?>)</p>
        </div>
        <div class="col-md-4 text-right">
            <form method="link" action="<?php echo WEBROOT . 'logout'; ?>">
                <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-log-out"></span>
                    Déconnection
                </button>
            </form>
        </div>
    </div>
    <?php if(isset($success['login'])): ?>
        <div class="alert alert-success">
            <p><span class="glyphicon glyphicon-ok"></span>
                <?php echo ' ' . $success['login']; ?>
            </p>
        </div>
    <?php endif; ?>

    <script type="text/javascript" src="<?php echo WEBROOT . 'scripts/bootstrap-datepicker.js'; ?>"></script>
    <script type="text/javascript" src="<?php echo WEBROOT . 'scripts/locales/bootstrap-datepicker.fr.js'; ?>"></script>
    <h2>Selectioner une journée</h2>

    <form action="<?php echo WEBROOT; ?>manager" method="get">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="inputdate">Selectionner journée</label>

                    <div id="sandbox-container">
                        <div class="input-group date">
                            <input type="text" name="date" class="form-control" id="inputdate"
                                   placeholder="Choisie une date ..."><span
                                class="input-group-addon"><i
                                    class="glyphicon glyphicon-th"></i></span>
                        </div>
                    </div>
                    <script type="text/javascript">// TODO
                        $('#sandbox-container .input-group.date').datepicker({
                            format: "yyyy-mm-dd",
                            language: "fr",
                            autoclose: true,
                            todayBtn: "linked",
                            todayHighlight: true,
                            orientation: "top left"

                        });
                    </script>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-calendar"></span> Afficher
            journée
        </button>
    </form>
    <?php if(isset($dateerror)): ?>
        <div class="alert alert-danger">
            <p><span class="glyphicon glyphicon-remove"></span>
                <?php echo ' ' . $dateerror; ?>
            </p>
        </div>
    <?php endif; ?>
    <?php if(isset($day)): ?>
        <h2 id="activity-list">Liste des activités du <?php echo $date; ?></h2>
        <table class="table table-bordered table-hover">
            <thead>
            <tr>
                <th><span class="glyphicon glyphicon-time"></span> Heure</th>
                <th><span class="glyphicon glyphicon-th-list"></span> Activité</th>
            </tr>
            </thead>
            <tbody>
            <?php
            //print_r($day);
            foreach($day as $k => $v)
            {
                echo "<tr><td>$k h - " . (intval($k) + 1) . " h</td><td>$v</td></tr>";
            }
            ?>
            </tbody>
        </table>
        <h2>Modifier une activité</h2>
        <form action="<?php echo WEBROOT; ?>manager?date=<?php echo $date; ?>#activity-list" method="post">
            <div class="form-group">
                <label for="hour_modification">Heure</label>
                <select data-placeholder="Choisie une heure ..." name="hour_modification" size="1"
                        id="hour_modification" class="form-control chosen-select">
                    <option></option>
                    <?php
                    foreach($day as $k => $v)
                    {
                        echo "<option value=\"$k\">$k h - " . (intval($k) + 1) . " h</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="activity_modification">Activité</label>
                <select data-placeholder="Choisie une activité ..." name="activity_modification" size="1"
                        id="activity_modification" class="form-control chosen-select">
                    <option></option>
                    <?php
                    foreach($activities as $k => $v)
                    {
                        echo "<option value=\"$k\">$v</option>";
                    }
                    ?>
                </select></div>
            <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-pencil"></span> Modifier
                activité
            </button>
        </form>
    <?php endif; ?>
</div>