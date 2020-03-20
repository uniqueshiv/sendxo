<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Terms &amp; About</h4>
                    <form class="form-horizontal style-form" method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">User needs to accept terms</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="accept_terms">
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                        </div>
                        <script>$('select[name="accept_terms"]').val("<?php echo $settings['accept_terms'] ?>");</script>

                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Terms</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="terms_text" style="width: 100%; height: 300px;"><?php echo $settings['terms_text']; ?></textarea>
                                <p><i>You can use HTML to style the text</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">About</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="about_text" style="width: 100%; height: 300px;"><?php echo $settings['about_text']; ?></textarea>
                                <p><i>You can use HTML to style the text</i></p>
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