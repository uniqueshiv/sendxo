<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Backgrounds</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen" style="overflow:auto;">
                        <table class="table table-bordered table-striped table-condensed sortable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Source</th>
                                    <th>Url</th>
                                    <th>Duration</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($backgrounds as $bg) {
                                    echo '<tr>';
                                    echo '<td>' . $bg->id . '</td>';
                                    echo '<td>' . $bg->src . '</td>';
                                    echo '<td>' . $bg->url . '</td>';
                                    echo '<td>' . $bg->duration . '</td>';
                                    echo '<td><a href="backgrounds/delete/' . $bg->id . '">Delete</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
        <div class="row mt">
            <div class="form-panel" style="overflow:hidden ;">
                <h4 class="mb"><i class="fa fa-angle-right"></i> Add new background</h4>
                <form class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="add" value="1">
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Select image / video(mp4) *</label>
                        <div class="col-sm-10">
                            <input type="file" name="file" required="required" accept="image/*,video/mp4">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Background URL</label>
                        <div class="col-sm-10">
                            <input type="text" name="url" placeholder="Background URL to redirect to (not required)" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 col-sm-2 control-label">Background duration</label>
                        <div class="col-sm-10">
                            <input type="number" name="duration" placeholder="The duration in seconds of this background" class="form-control">
                            <i>This will specify how long the background stays until it switches to the other one, leave empty or set to 0 to use the default background time.</i><br>
                            <i>If you're uploading a video then you'll need to specify the length of the video, you can't leave it empty.</i><br>
                            <i>Specify the duration in seconds.</i>
                        </div>
                    </div>
                    <div style="float: right; padding-right: 5px;">
                        <button type="submit" class="btn btn-success" ><i class="fa fa-plus"></i> Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section><!--/wrapper -->
</section>