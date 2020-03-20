<h3 style="text-align: center;">Create admin user</h3>
<form method="POST">
    <div class="narrow text-center" style="margin-left: auto; margin-right: auto; width: 70%; padding-top: 20px;">
        <input type="hidden" name="action" value="createuser">
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <input type="email" class="form-control" name="email" placeholder="Admin e-mail" required="required">
        </div>
        <div class="input-group" style="padding-top: 10px;">
            <div class="input-group-addon"><i class="fa fa-lock"></i></div>
            <input type="password" class="form-control" name="password" placeholder="Admin password" required="required">
        </div>
    </div>
    <p class="text-center">
        <input type="submit" class="btn btn-success btn-outline-rounded green" value="Create user">
    </p>
</form>