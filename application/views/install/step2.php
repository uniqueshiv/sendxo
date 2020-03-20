<?php
if(isset($error) && !empty($error)) {
    echo '<div class="alert alert-danger" role="alert" style="width: 80%; margin-right: auto; margin-left: auto;">' . $error . '</div>';
}
?>
<div id="tab-content">
    <div class="tab-pane" id="home">
        <h3 style="text-align: center;">Droppy validate purchase</h3>
        <form method="POST">
            <div class="narrow text-center" style="margin-left: auto; margin-right: auto; width: 70%; padding-top: 20px;">
                <input type="hidden" name="action" value="p_code">
                <div class="input-group" style="padding-top: 10px;">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input type="text" class="form-control" name="code" placeholder="Purchase code" required="required">
                </div>
                <p><i>Don't know where to find your purchase code ? Please give a look to this article: <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">here</a></i></p>
            </div>
            <p class="text-center">
                <input type="submit" class="btn btn-success btn-outline-rounded green" value="Submit">
            </p>
        </form>
    </div>
</div>