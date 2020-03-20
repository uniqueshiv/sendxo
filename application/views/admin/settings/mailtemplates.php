<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <div style="float: left;">
                        <h4 class="mb"><i class="fa fa-angle-right"></i> E-Mail Templates</h4>
                    </div>
                    <?php
                    if(isset($_GET['lang'])) :
                    ?>
                        <div style="float: right;">
                            <select id="langSelector" onchange="langSelector()">
                                <option selected="true" disabled="disabled">-- Select language --</option>
                                <?php
                                foreach($languages as $row)
                                {
                                    echo '<option value="' . strtolower($row->path) . '">' . $row->name . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <form class="form-horizontal style-form" method="post" style="margin-top: 80px;">
                            <input type="hidden" name="save" value="1">
                            <input type="hidden" name="lang" value="<?php echo $_GET['lang']; ?>">
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">E-Mail - Receivers</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="receiver_subject" placeholder="Receiver email subject" value="<?php echo $templates->getByTypeAndLanguage('receiver_subject', $_GET['lang'])['msg']; ?>"><br>
                                    <textarea name="receiver" class="form-control" style="width: 100%; height: 200px;"><?php echo $templates->getByTypeAndLanguage('receiver', $_GET['lang'])['msg'] ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">E-Mail - Sender</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="sender_subject" placeholder="Sender email subject" value="<?php echo $templates->getByTypeAndLanguage('sender_subject', $_GET['lang'])['msg']; ?>"><br>
                                    <textarea name="sender" class="form-control" style="width: 100%; height: 200px;"><?php echo $templates->getByTypeAndLanguage('sender', $_GET['lang'])['msg']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">E-Mail - Destroyed</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="destroyed_subject" placeholder="Receiver email subject" value="<?php echo $templates->getByTypeAndLanguage('destroyed_subject', $_GET['lang'])['msg']; ?>"><br>
                                    <textarea name="destroyed" class="form-control" style="width: 100%; height: 200px;"><?php echo $templates->getByTypeAndLanguage('destroyed', $_GET['lang'])['msg']; ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2 control-label">E-Mail - Downloaded</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="downloaded_subject" placeholder="Downloaded email subject" value="<?php echo $templates->getByTypeAndLanguage('downloaded_subject', $_GET['lang'])['msg']; ?>"><br>
                                    <textarea name="downloaded" class="form-control" style="width: 100%; height: 200px;"><?php echo $templates->getByTypeAndLanguage('downloaded', $_GET['lang'])['msg']; ?></textarea>
                                </div>
                            </div>
                            <div style="float: right; padding-right: 5px;">
                                <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
                            </div>
                        </form>
                    <?php

                    else:
                    ?>
                        <div class="form-group" style="margin-top: 80px;">
                            <select id="langSelector" onchange="langSelector()" class="form-control">
                                <option selected="true" disabled="disabled">-- Select language --</option>
                                <?php
                                foreach($languages as $row)
                                {
                                    echo '<option value="' . strtolower($row->path) . '">' . $row->name . '</option>';
                                }
                                ?>
                            </select>
                            <p><i>Go to this page <a href="<?php echo $settings['site_url'] ?>admin/settings/language"><span class="label label-info">here</span></a> if you would like to add more language options.</i></p>
                        </div>
                    <?php
                    endif;
                    ?>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>
<script>
    function langSelector()
    {
        var selectedLang = document.getElementById('langSelector').value;
        window.location.href = "<?php echo $settings['site_url'] ?>admin/settings/mailtemplates?lang="+selectedLang;
    }
</script>