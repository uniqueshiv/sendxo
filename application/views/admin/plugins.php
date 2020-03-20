<section id="main-content">
    <section class="wrapper">
        <div class="row mt">
            <div class="col-lg-12">
                <div class="form-panel" style="overflow:hidden ;">
                    <h4 class="mb"><i class="fa fa-angle-right"></i> Installed plugins</h4>
                    <?php
                    if(count($plugins) == 0) :
                        ?>
                        <p>No plugins found</p>
                        <?php
                    else:
                        ?>
                        <table class="table table-bordered table-striped table-condensed sortable">
                            <thead>
                            <tr>
                                <th>Type</th>
                                <th>Name</th>
                                <th>Path</th>
                                <th>Status</th>
                                <th>Version</th>
                                <th>#</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($plugins AS $key => $plugin) {
                                echo '<tr>';
                                echo '<td>' . $key . '</td>';
                                echo '<td>' . $plugin['name'] . '</td>';
                                echo '<td><pre style="font-size: 11px; padding: 3px 10px;">application/plugins/' . $plugin['load'] . '/</pre></td>';
                                echo '<td>Installed</td>';
                                echo '<td>' . $plugin['version'] . '</td>';
                                echo '<td>--</td>';
                                echo '</tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                        <?php
                    endif;
                    ?>
                </div>
            </div><!-- col-lg-12-->
        </div><!-- /row -->
    </section>
</section>