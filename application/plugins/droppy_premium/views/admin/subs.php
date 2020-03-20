<?php

$clsSubs = new PremiumSubs();

//Get subs from database
$get_subs = $clsSubs->getAll();
?>
<div class="content-panel">
    <section id="unseen" style="overflow:auto; font-size: 18px;">
        <?php
        //Check if there are any subs
        if(count($get_subs) == 0) :
        ?>
            <h4>No users have been found in the database</h4>
        <?php
        else:
            ?>
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>E-Mail</th>
                    <th>Sub-ID</th>
                    <th>First Name</th>
				  <th>Last Name</th>
                    <th>Payment type</th>
                    <th>Next payment</th>
                    <th>Paypal-ID</th>
                    <th>Status</th>
				  <th>Mailing address</th>
				  <th>City</th>
				  <th>Zip</th>
				  <th>Country</th>
				  <th>Plan</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                //Get table page
                $rows_per_page = 20;
                if(isset($_GET['table'])) {
                    $table_page = $_GET['table'];
                }
                else
                {
                    $table_page = 0;
                }
                $current_table = $table_page * $rows_per_page;

                //$get_subs_table = $mysqli->query("SELECT * FROM $table_pm_subs ORDER BY id DESC LIMIT $current_table, $rows_per_page");

                $get_subs_table = $clsSubs->getAll($current_table, $rows_per_page);

                // Echo table content
                foreach($get_subs_table AS $row) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['sub_id'] . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['lastname'] . '</td>';
                    echo '<td>' . $row['payment'] . '</td>';
                    echo '<td>' . (!empty($row['next_date']) ? date("Y-m-d", $row['next_date']) : '') . '</td>';
                    echo '<td>' . $row['paypal_id'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
					echo '<td>' . $row['mailingaddress'] . '</td>';
					echo '<td>' . $row['city'] . '</td>';
					echo '<td>' . $row['zip'] . '</td>';
					echo '<td>' . $row['country'] . '</td>';
					echo '<td>' . $row['plan'] . '</td>';
                    if($row['status'] == 'active') {
                        echo '<td><form method="POST" action="' . $this->config->item('site_url') . 'page/premium"><input type="hidden" name="action" value="cancel_subscription"><input type="hidden" name="id" value="' . $row['sub_id'] . '"><input type="hidden" name="return" value="' . current_url() . '?p=subs"><input type="submit" class="btn btn-danger btn-xs" value="Cancel"></form></td>';
                    }
                    elseif($row['status'] == 'suspended' || $row['status'] == 'suspended_reversal')
                    {
                        echo '<td><form method="POST" action="' . $this->config->item('site_url') . 'page/premium"><input type="hidden" name="action" value="activate_sub"><input type="hidden" name="id" value="' . $row['sub_id'] . '"><input type="hidden" name="return" value="' . current_url() . '?p=subs"><input type="submit" class="btn btn-danger btn-xs" value="Re-Activate"></form></td>';
                    }
                    else
                    {
                        echo '<td>No action available</td>';
                    }
                    echo '</tr>';
                }
                ?>
                </tbody>
            </table>
            <?php
            // Pagination script
            $count_rows = count($get_subs);
            $total_pages = round($count_rows / $rows_per_page);
            $page_up = $table_page + 1;
            $page_down = $table_page - 1;
            ?>
            <div style="float: right; padding-right: 10px;">
                <?php
                if($table_page > 0):
                    ?>
                    <a href="<?php echo current_url(); ?>?p=subs&table=<?php echo $page_down; ?>" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Prev</a>
                    <?php
                endif;
                if($total_pages > $table_page + 1) :
                    ?>
                    <a href="<?php echo current_url(); ?>?p=subs&table=<?php echo $page_up; ?>" class="btn btn-success">Next <i class="fa fa-arrow-right"></i></a>
                    <?php
                endif;
                ?>
            </div>
            <?php
        endif;
        ?>
    </section>
    <p stlye="margin-left: 5px;">Please note it can sometimes take 1+ minute before your reactivation/cancelation will apply, if this does not happen you will need to check your IPN settings.</p>
</div><!-- /content-panel -->