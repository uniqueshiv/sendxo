<section id="main-content">
    <section class="wrapper">
        <h3><i class="fa fa-angle-right"></i> Users <div style="float: right;"><a href="<?php echo base_url() . 'admin/users/add' ?>" class="btn btn-success"><li class="fa fa-plus-o"></li> Add user</a></div></h3>
        <div class="row mt">
            <div class="col-lg-12">
                <div class="content-panel">
                    <section id="unseen" style="overflow:auto; font-size: 18px;">
                        <?php if($total == 0) : ?>
                            <h4>No users have been found in the database</h4>
                        <?php else: ?>
                            <table class="table table-bordered table-striped table-condensed">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>E-Mail</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($users AS $row) {
                                    echo '<tr>';
                                    echo '<td>' . $row['id'] . '</td>';
                                    echo '<td>' . $row['email'] . '</td>';
                                    echo '<td><a href="' . $settings['site_url'] . 'admin/users/page/' . $page . '/delete/' . $row['id'] . '">Delete</a> | <a href="' . $settings['site_url'] . 'admin/users/edit/' . $row['id'] . '">Edit</a></td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                            <?php
                            $total_pages = round($total / 20);
                            $page_up = $page + 1;
                            $page_down = $page - 1;
                            ?>
                            <div style="float: right; padding-right: 10px;">
                                <?php if($page > 0): ?>
                                    <a href="<?php echo $settings['site_url'] . 'admin/users/page/' . $page_down; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Prev</a>
                                <?php
                                endif;
                                if($total_pages > $page + 1) :
                                ?>
                                    <a href="<?php echo $settings['site_url'] . 'admin/users/page/' . $page_up; ?>" class="btn btn-success">Next <i class="fa fa-arrow-right"></i></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </section>
                </div><!-- /content-panel -->
            </div><!-- /col-lg-4 -->
        </div><!-- /row -->
    </section><! --/wrapper -->
</section>