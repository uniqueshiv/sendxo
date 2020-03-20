<section id="main-content">
    <section class="wrapper">
        <div class="row">
            <div class="col-lg-11 main-chart">
                <div class="row mtbox">
                    <div class="col-md-2 col-sm-2 col-md-offset-2 box0">
                        <div class="box1">
                            <i class="fa fa-cloud-upload fa-5x"></i>
                            <h3><?php echo $stats['total_uploads']; ?></h3>
                        </div>
                        <p>A total of <?php echo $stats['total_uploads']; ?> uploads have been processed </p>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <i class="fa fa-cloud fa-5x"></i>
                            <h3><?php echo $stats['total_uploads_active']; ?></h3>
                        </div>
                        <p><?php echo $stats['total_uploads_active']; ?> active files are ready for download.</p>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <i class="fa fa-cloud-download fa-5x"></i>
                            <h3><?php echo $stats['total_downloads']; ?></h3>
                        </div>
                        <p><?php echo $stats['total_downloads']; ?> downloads have been made.</p>
                    </div>
                    <div class="col-md-2 col-sm-2 box0">
                        <div class="box1">
                            <i class="fa fa-trash fa-5x"></i>
                            <h3><?php echo $stats['total_uploads_destroyed']; ?></h3>
                        </div>
                        <p><?php echo $stats['total_uploads_destroyed']; ?> items have been destroyed</p>
                    </div>
                </div>
                <div class="row mt">
                    <div class="col-md-4 col-sm-4 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>MOST DOWNLOADED</h5>
                            </div>
                            <div class="centered" style="padding-top: 20px;">
                                <?php
                                    echo '<p><i style="font-weight: bold;">ID:</i> <a href="' . $settings['site_url'] . $stats['most_downloaded']['download_id'] . '">' . $stats['most_downloaded']['download_id'] . '</a></p>';
                                    echo '<p><i style="font-weight: bold;">Downloads:</i>' . $stats['most_downloaded']['total'] . '</p>';
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb">
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>DISK STATICS</h5>
                            </div>
                            <div style="text-align: center; padding-top: 20px;">
                                <i class="fa fa-server fa-5x" style="font-size: 70px;"></i>
                                <?php
                                if($stats['total_size'] < 1024):
                                    ?>
                                    <h2><?php echo $stats['total_size']; ?> MB used</h2>
                                <?php
                                elseif($stats['total_size'] > 1024):
                                    ?>
                                    <h2><?php echo round($stats['total_size'] / 1000, 2); ?> GB used</h2>
                                <?php
                                endif;
                                ?>
                            </div>
                        </div><!-- /white panel -->
                    </div><!-- /col-md-4 -->

                    <div class="col-md-4 mb">
                        <!-- WHITE PANEL - TOP USER -->
                        <div class="white-panel pn">
                            <div class="white-header">
                                <h5>LATEST UPLOAD</h5>
                            </div>
                            <div style="padding-top: 20px; text-align: left;">
                                <p><i style="font-weight: bold;">ID:</i> <a href="<?php echo $settings['site_url'] . $stats['last_upload']['upload_id']; ?>"><?php echo $stats['last_upload']['upload_id']; ?></a></p>
                                <p><i style="font-weight: bold;">Time:</i> <?php echo date("F j, Y, g:i a", $stats['last_upload']['time']); ?></p>
                                <p><i style="font-weight: bold;">Size:</i> <?php echo round($stats['last_upload']['size'] / 1048576, 2); ?> MB</p>
                                <p><i style="font-weight: bold;">Password:</i> <?php if($stats['last_upload']['password'] == 'EMPTY') { echo 'No'; } else { echo 'Yes'; } ?></p>
                                <p><i style="font-weight: bold;">Deleted:</i> <?php if($stats['last_upload']['status'] == 'destroyed') { echo 'Yes'; } else { echo 'No'; } ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>