<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Contact form settings</h4>
                    <form class="form-horizontal style-form" method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Enable contact form</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="contact_enabled">
                                    <option value="true">Enabled</option>
                                    <option value="false">Disabled</option>
                                </select>
                            </div>
                        </div>
                        <script>$('select[name="contact_enabled"]').val("<?php echo $settings['contact_enabled'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Contact form receiver</label>
                            <div class="col-sm-10">
                                <input type="email" name="contact_email" class="form-control" value="<?php echo $settings['contact_email'] ?>">
                                <p><i>The email address where the messages will be send to</i></p>
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