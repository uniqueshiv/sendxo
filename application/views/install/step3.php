<?php
if(isset($error) && $error == 'connection') {
    echo '<div class="alert alert-danger" role="alert" style="margin-right: auto; margin-left: auto; width: 70%; text-align: center;">Droppy was unable to connect to the database please try again !</div>';
}
?>
<div id="tab-content">
    <div class="tab-pane" id="home">
        <div style="padding-top: 60px;">
            <h3 style="text-align: center;">Droppy database</h3>
            <br>
            <p class="narrow text-center" style="color: red;">ERROR !</p>
            <p class="narrow text-center">Droppy was unable to connect to your database, please check your database settings in <code>application/config/database.php</code>.</p>
        </div>
    </div>
</div>
<!--<form method="POST">
    <div class="narrow text-center" style="margin-left: auto; margin-right: auto; width: 70%; padding-top: 20px;">
        <input type="hidden" name="action" value="dbsettings">
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-database"></i></div>
            <input type="text" class="form-control" name="host" placeholder="Database host" required="required">
        </div>
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-database"></i></div>
            <input type="text" class="form-control" name="user" placeholder="Database username" required="required">
        </div>
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-database"></i></div>
            <input type="password" class="form-control" name="pass" placeholder="Database password" required="required">
        </div>
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-database"></i></div>
            <input type="text" class="form-control" name="name" placeholder="Database name" required="required">
        </div>

    </div>
    <p class="text-center">
        <input type="submit" class="btn btn-success btn-outline-rounded green" value="Submit">
    </p>
</form>-->