<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden ;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Installed themes</h4>

                    <table class="table table-bordered table-striped table-condensed sortable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Path</th>
                            <th>Status</th>
                            <th>Actions</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach($themes AS $theme) {
                            echo '
                            <tr>
                                <td>' . $theme['name'] . '</td>
                                <td>' . $theme['path'] . '</td>
                                <td>' . (($theme['status'] == 'ready') ? '<span class="label label-info">In use</span>' : '<span class="label label-default">Not set</span>') . '</td>
                                <td>' . (($theme['status'] == 'ready') ? '<a href="' . base_url() . 'admin/themes/suspend/' . $theme['id'] . '"><i class="fa fa-toggle-off"></i> Suspend</a>' : '<a href="' . base_url() . 'admin/themes/activate/' . $theme['id'] . '"><i class="fa fa-toggle-on"></i> Activate</a>') . '</td>
                                <td><a href="' . base_url() . 'admin/themes/delete/' . $theme['id'] . '"><i class="fa fa-trash-o"></i> Remove</a></td>
                            </tr>
                            ';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-panel" style="overflow:hidden ;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Install a new theme</h4>
                    <form class="form-horizontal style-form" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <div>
                                <label class="col-sm-2 col-sm-2 control-label">Theme name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="name" required="required" placeholder="The name of the theme">
                                </div>
                            </div>
                            <div style="margin-top: 50px;">
                                <label class="col-sm-2 col-sm-2 control-label">Theme directory name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="path" required="required" placeholder="The directory name of the theme">
                                    <p><em>(directory that is located in the "application/views/themes/" directory) E.g. for application/views/themes/default/ you enter <b>default</b></em></p>
                                </div>

                            </div>
                        </div>
                        <div style="float: right; padding-right: 5px;">
                            <button type="submit" class="btn btn-success" ><i class="fa fa-bolt"></i> Add theme</button>
                        </div>
                    </form>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>