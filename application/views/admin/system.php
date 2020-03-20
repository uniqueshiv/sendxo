<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-server"></i> System</h4>
                    <li class="list-group-item"><span class="pull-right"><?php echo $settings['version']; ?></span>Current version</li>
                    <li class="list-group-item"><span class="pull-right"><?php if(!isset($latest_version->version) || $latest_version->version == '') { echo '<span class="label label-danger">Unable to connect to Proxibolt API</span>'; } else { echo $latest_version->version; } ?></span>Latest version</li>
                    <li class="list-group-item"><span class="pull-right"><?php echo phpversion(); ?></span>PHP Version</li>
                    <li class="list-group-item"><span class="pull-right"><?php echo $settings['site_url']; ?></span>Website URL</li>
                    <li class="list-group-item"><span class="pull-right"><?php echo $_SERVER['SERVER_ADDR']; ?></span>Server IP</li>
                    <li class="list-group-item"><span class="pull-right"><?php if(function_exists('curl_version') != '') { echo 'Enabled'; } else { echo 'Disabled (Need to install)'; } ?></span>CURL</li>
                </div>
                <script>
                    function updateClick() {
                        document.getElementById('updateDiv').style.display = "none";
                        document.getElementById('updatingDiv').style.display = "block";
                    }
                </script>
                <div class="form-panel" style="overflow:hidden;" id="updateDiv">
                    <h4 class="mb"><i class="fa fa-server"></i> Auto-Update</h4>
                    <?php
                    if(function_exists('curl_version') != '') :
                        if(isset($latest_version->version) && ($settings['version'] == $latest_version->version || $settings['version'] > $latest_version->version)):
                            ?>
                            <p><b>Awesome !</b> You are using the latest version available.</p>
                            <p>Signup <span class="label label-info"><a href="https://newsletter.proxibolt.com" target="_blank" style="color: #FFF;">here</a></span> and get notified when there is a new update available.
                        <?php
                        else:
                        ?>
                            <form method="POST">
                                <input type="hidden" name="action" value="update">
                                <?php
                                if(isset($error) && !empty($error)) {
                                    echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
                                }
                                if(isset($pb_message) && $pb_message->show == 1) {
                                    echo $pb_message->msg;
                                }
                                ?>
                                <p style="padding-left: 15px;">Your version of Droppy is outdated and needs to be updated, please enter your purchase code below and Droppy will do the rest for you.</p><br>
                                <div class="form-group">
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="purchase_code" placeholder="Your purchase code" value="<?php echo $settings['purchase_code']; ?>" required>
                                        <p><i>Don't know where to find your purchase code ? Please give a look to this article: <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">here</a></i></p>
                                    </div>
                                </div>
                                <div style="float: right; padding-right: 5px;">
                                    <button type="submit" class="btn btn-success" onclick="updateClick();"><i class="fa fa-wrench"></i> Update</button>
                                </div>
                            </form>
                        <?php
                        endif;
                    endif;
                    ?>
                </div>
                <?php if(isset($latest_version->version) && ($settings['version'] != $latest_version->version || $settings['version'] < $latest_version->version)): ?>
                <div class="form-panel" style="overflow:hidden;" id="manualUpdate">
                    <h4 class="mb"><i class="fa fa-server"></i> Manual update</h4>
                    <form method="POST">
                        <input type="hidden" name="action" value="manual_update">
                        <p>You can manually download the latest version to your desktop with the form below, this can be used if your system is unable to update automatically.</p><br>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="purchase_code" placeholder="Your purchase code" value="<?php echo $settings['purchase_code']; ?>" required>
                                <p><i>Don't know where to find your purchase code ? Please give a look to this article: <a href="https://help.market.envato.com/hc/en-us/articles/202822600-Where-Can-I-Find-my-Purchase-Code-">here</a></i></p>
                            </div>
                        </div>
                        <div style="float: right; margin-top:-13px;">
                            <button type="submit" class="btn btn-success"><i class="fa fa-download"></i> Download</button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
                <div class="form-panel" style="overflow:hidden; display: none;" id="updatingDiv">
                    <div style="padding-top: 25px;">
                        <p style="text-align:center;"><i class="fa fa-spinner fa-pulse fa-3x"></i><br><br>
                            Updating your system, please be patient.</p>
                    </div>
                </div>
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-server"></i> Last 5 updates</h4>
                    <table class="table table-bordered table-striped table-condensed sortable">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Version</th>
                            <th>Date installed</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($updates AS $row) {
                            echo '<tr>';
                            echo '<td>' . $row['id'] . '</td>';
                            echo '<td>' . $row['version'] . '</td>';
                            echo '<td>' . $row['date'] . '</td>';
                            echo '</tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>