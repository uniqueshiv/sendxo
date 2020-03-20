<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Advertisement</h4>
                    <form class="form-horizontal style-form" method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Advertisement in menu enabled</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ad_1_enabled">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </div>
                        </div>
                        <script>$('select[name="ad_1_enabled"]').val("<?php echo $settings['ad_1_enabled'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Advertisement in menu code</label>
                            <div class="col-sm-10">
                                <textarea name="ad_1_code" class="form-control" style="width: 100%; height: 300px;"><?php echo $settings['ad_1_code']; ?></textarea>
                                <p><i>Advertisement code. If you're using adsense do not forget to include the javascript tags</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Advertisement on upload/download enabled</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="ad_2_enabled">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>
                            </div>
                        </div>
                        <script>$('select[name="ad_2_enabled"]').val("<?php echo $settings['ad_2_enabled'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Advertisement on upload/download code</label>
                            <div class="col-sm-10">
                                <textarea name="ad_2_code" class="form-control" style="width: 100%; height: 300px;"><?php echo $settings['ad_2_code']; ?></textarea>
                                <p><i>Advertisement code. If you're using adsense do not forget to include the javascript tags</i></p>
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