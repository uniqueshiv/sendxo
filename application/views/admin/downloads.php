<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Downloads</h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen" style="overflow:auto;">
                        <?php
                        if($total == 0) :
                            ?>
                            <h4>No downloads have been found</h4>
                        <?php
                        else:
                        ?>
                        <table class="table table-bordered table-striped table-condensed sortable">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Download date</th>
                                <th>IP</th>
                                <th>Downloader</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($downloads as $row) {
                                echo '
                                        <tr>
                                            <td>' . $row['download_id'] . '</td>
                                            <td>' . date("F j, Y, g:i a", $row['time']) . '</td>
                                            <td>' . $row['ip'] . '</td>
                                            <td>' . $row['email'] . '</td>
                                        </tr>';
                            }
                            ?>
                            </tbody>
                        </table>
                            <?php
                            // Pagination script
                            $total_pages = round($total / 20);
                            $page_up = $page + 1;
                            $page_down = $page - 1;
                            ?>
                            <div style="float: right; padding-right: 10px;">
                                <?php if($page > 0): ?>
                                    <a href="<?php echo $settings['site_url'] . 'admin/downloads/page/' . $page_down; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Prev</a>
                                <?php
                                endif;
                                if($total_pages > ($page + 1)) :
                                    ?>
                                    <a href="<?php echo $settings['site_url'] . 'admin/downloads/page/' . $page_up; ?>" class="btn btn-success">Next <i class="fa fa-arrow-right"></i></a>
                                <?php endif; ?>
                            </div>
                        <?php
                        endif;
                        ?>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
    </section>
</section>