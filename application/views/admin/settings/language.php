<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Installed languages</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen" style="overflow:auto;">
                        <table class="table table-bordered table-striped table-condensed sortable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Directory</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($languages as $lang) {
                                echo '<tr>';
                                    echo '<td>' . $lang->id . '</td>';
                                    echo '<td>' . $lang->name . ' ' . ($lang->path == $settings['language'] ? '<span class="badge badge-primary">Default</span>' : '') . '</td>';
                                    echo '<td>' . $lang->path . '</td>';
                                    echo '<td><a href="settings/language/default/' . $lang->path . '"><li class="fa fa-check"></li> Set default</a> | <a href="settings/language/delete/' . $lang->id . '"><li class="fa fa-trash"></li> Remove</a></td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <p><i>Language directories are located in the directory <code>/application/language/</code>, new language directories need to be added there.</i></p>
                        <form method="POST">
                            <input type="hidden" name="save" value="1">
                            <div style="margin: 20px; width: 400px;">
                                <div style="">
                                    <input type="text" class="form-control input-sm" name="name" placeholder="Language name">
                                    <i>The name that will be shown in the language dropdown</i>
                                </div>
                                <br>
                                <div style="">
                                    <input type="text" class="form-control input-sm" name="path" placeholder="Directory name">
                                    <i>The directory name where the language files are in.</i>
                                </div>
                                <br>
                                <div style="">
                                    <input type="submit" class="btn btn-success btn-sm" value="Add language">
                                </div>
                            </div>
                        </form>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
    </section>
</section>