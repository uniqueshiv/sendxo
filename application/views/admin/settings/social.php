<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Social settings</h4>
                    <form class="form-horizontal style-form" method="post">
                        <input type="hidden" name="save" value="1">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Facebook</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="facebook" placeholder="Facebook url" value="<?php echo $social['facebook']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Twitter</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="twitter" placeholder="Twitter plus url" value="<?php echo $social['twitter']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Google plus</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="google" placeholder="Google plus url" value="<?php echo $social['google']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Instagram</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="instagram" placeholder="Instagram url" value="<?php echo $social['instagram']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">GitHub</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="github" placeholder="GitHub url" value="<?php echo $social['github']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Tumblr</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tumblr" placeholder="Tumblr url" value="<?php echo $social['tumblr']; ?>">
                                <p><i>Leave empty to disable it</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Pinterest</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="pinterest" placeholder="Pinterest url" value="<?php echo $social['pinterest']; ?>">
                                <p><i>Leave empty to disable it</i></p>
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