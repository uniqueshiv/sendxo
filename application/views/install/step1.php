<?php $total_checks = 0; ?>
<div id="tab-content">
    <div class="tab-pane" id="home">
        <div style="padding-top: 60px;">
            <?php
            if(!$database) {
                ?>
                <h3 class="head text-center">No database credentials !</h3>
                <p class="narrow text-center">
                    Please enter your database credentials in the <code>application/config/database.php</code> file
                    <br><br>
                    <a href="" class="btn btn-success btn-outline-rounded green">I have added my credentials</a>
                </p>
                <?php
            }
            else
            {
            ?>
            <h3 class="head text-center">Droppy installation</h3>

            <p class="narrow text-center">
                Thank you for purchasing Droppy, before you can use Droppy you'll need to follow some small steps.
            </p>

            <hr>
            <p class="narrow text-center"><strong style="font-size: 20px;">Requirements:</strong><br>
                <?php if(function_exists('mysqli_connect')) { echo '<i class="fa fa-check"></i>'; $total_checks++; } else { echo '<i class="fa fa-times"></i>'; } ?> MySqli installed <br>
                <?php if(function_exists('curl_version')) { echo '<i class="fa fa-check"></i>'; $total_checks++; } else { echo '<i class="fa fa-times"></i>'; } ?> PHP Curl installed <br>
                <?php if(file_exists(FCPATH . '/.htaccess')) { echo '<i class="fa fa-check"></i>'; $total_checks++; } else { echo '<i class="fa fa-times"></i>'; } ?> .htaccess file found <br>
            </p>

            <p class="text-center">
                <?php
                if($total_checks == 3) :
                    ?>
                    <a href="<?php echo $_SESSION['base_url'] ?>/install/step2" class="btn btn-success btn-outline-rounded green"> Start the installation</a>
                    <?php
                else:
                    ?>
                    <a href="<?php echo $_SESSION['base_url'] ?>/install/step2" onclick="return confirm('Are you sure you want to proceed even though the requirements are not correct ?');" class="btn btn-danger btn-outline-rounded red"> Start install without all the correct requirements</a>
                    <?php
                endif;
                ?>
            </p>

            <?php } ?>
        </div>
    </div>
</div>