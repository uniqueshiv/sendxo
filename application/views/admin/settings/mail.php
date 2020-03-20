<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden ;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> E-Mail Settings</h4>
                    <form class="form-horizontal style-form" method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email from (Name)</label>
                            <div class="col-sm-10">
                                <input type="text" name="email_from_name" class="form-control" value="<?php echo $settings['email_from_name']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email from (E-Mail)</label>
                            <div class="col-sm-10">
                                <input type="email" name="email_from_email" class="form-control" value="<?php echo $settings['email_from_email']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Email Server</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="email_server" id="email_server" onchange="emailServer()">
                                    <option value="<?php echo $settings['email_server']; ?>" selected style="display:none;"><?php echo $settings['email_server']; ?></option>
                                    <option value="LOCAL">Local</option>
                                    <option value="SMTP">SMTP</option>
                                </select>
                            </div>
                        </div>
                        <div id="smtpSection" <?php if($settings['email_server'] == 'LOCAL') { echo 'style="display: none;"'; } ?>>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Host</label>
                                <div class="col-sm-10">
                                    <input type="text" name="smtp_host" class="form-control" value="<?php echo $settings['smtp_host']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Auth</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="smtp_auth">
                                        <option value="true">On</option>
                                        <option value="false">Off</option>
                                    </select>
                                </div>
                            </div>
                            <script>$('select[name="smtp_auth"]').val("<?php echo $settings['smtp_auth'] ?>");</script>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Port</label>
                                <div class="col-sm-10">
                                    <input type="text" name="smtp_port" class="form-control" value="<?php echo $settings['smtp_port']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Secure</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="smtp_secure">
                                        <option value="tls">TLS</option>
                                        <option value="ssl">SSL</option>
                                        <option value="none">NONE</option>
                                    </select>
                                </div>
                            </div>
                            <script>$('select[name="smtp_secure"]').val("<?php echo $settings['smtp_secure'] ?>");</script>

                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Username</label>
                                <div class="col-sm-10">
                                    <input type="text" name="smtp_username" class="form-control" value="<?php echo $settings['smtp_username']; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">SMTP Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="smtp_password" class="form-control" placeholder="SMTP Password (Leave empty if you do not want to change it)">
                                </div>
                            </div>
                        </div>
                        <div id="localSection" <?php if($settings['email_server'] == 'SMTP') { echo 'style="display: none;"'; } ?>>
                            <div class="form-group">
                                <h4 style="text-align: center;">You have selected "Local server" there are no more options when Local server has been selected</h4>
                            </div>
                        </div>
                        <div style="float: right; padding-right: 5px;">
                            <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>

<script>
    function emailServer() {
        var X = document.getElementById("email_server").value;
        if(X == 'LOCAL') {
            document.getElementById('smtpSection').style.display = "none";
            document.getElementById('localSection').style.display = "block";
        }
        if(X == 'SMTP') {
            document.getElementById('smtpSection').style.display = "block";
            document.getElementById('localSection').style.display = "none";
        }
    }
</script>