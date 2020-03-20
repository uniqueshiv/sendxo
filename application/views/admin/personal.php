<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Your admin account</h4>
                    <form class="form-horizontal style-form" method="POST">
                        <input type="hidden" name="id" value="<?php echo $account['id'] ?>">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Login email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" placeholder="Admin email" value="<?php echo $account['email'] ?>" required="required">
                                <p><i>Admin login email</i></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Login password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" placeholder="Password" required="required">
                                <p><i>Admin login password (Leave empty to keep the same)</i></p>
                            </div>
                        </div>
                        <div style="float: right; padding-right: 5px;">
                            <button type="submit" class="btn btn-success" ><i class="fa fa-floppy-o"></i> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</section>