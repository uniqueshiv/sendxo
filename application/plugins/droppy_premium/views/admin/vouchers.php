<?php
$clsVoucher = new PremiumVoucher();

$_SESSION['goback'] = current_url() . '?p=vouchers';

//Get subs from database
$get_vouchers = $clsVoucher->getAll();
?>
<div class="modal fade" id="addVoucher" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="<?php echo $this->config->item('site_url') ?>page/premium">
                <input type="hidden" name="action" value="add_voucher">
                <input type="hidden" name="goback" value="<?php echo current_url(); ?>?p=vouchers">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="addVoucherLabel">Add voucher</h4>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <p>Voucher code</p>
                        <input type="text" class="form-control" name="code" placeholder="Voucher code" required="required">
                    </div>
                    <br>
                    <div class="input-group">
                        <p>Voucher discount</p>
                        <input type="number" class="form-control" name="discount" placeholder="The voucher discount">
                    </div>
                    <br>
                    <p><b>Or</b> Voucher discount in percentage</p>
                    <div class="input-group input-group">
                        <span class="input-group-addon" id="sizing-addon1">%</span>
                        <input type="number" name="discount_percentage" min="0" max="100" class="form-control" placeholder="Voucher discount in percentage" aria-describedby="sizing-addon1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Create voucher</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="content-panel">
    <section id="unseen" style="overflow:auto; font-size: 18px;">
        <a href="#" data-toggle="modal" data-target="#addVoucher" class="btn btn-default" style="float:right;">Add voucher</a>
        <?php
        //Check if there are any subs
        if(count($get_vouchers) == 0 || !$get_vouchers) :
            ?>
            <h4>No vouchers have been found in the database</h4>
            <?php
        else:
            ?>
            <table class="table table-bordered table-striped table-condensed">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Code</th>
                        <th>Discount type</th>
                        <th>Discount</th>
                        <th>#</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Echo table content
                    foreach ($get_vouchers AS $row) {
                        echo '<tr>';
                        echo '<td>' . $row['id'] . '</td>';
                        echo '<td>' . $row['code'] . '</td>';
                        echo '<td>' . $row['discount_type'] . '</td>';
                        if($row['discount_type'] == 'value') {
                            echo '<td>&dollar; ' . $row['discount_value'] . '</td>';
                        }
                        elseif($row['discount_type'] == 'percentage') {
                            echo '<td>' . $row['discount_percentage'] . '&percnt;</td>';
                        }
                        echo '<td><a href="'.$this->config->item('site_url').'page/premium?action=delete_voucher&id=' . $row['id'] . '">Delete</a></td>';
                    }
                    ?>
                </tbody>
            </table>
        <?php
        endif;
        ?>
    </section>
</div><!-- /content-panel -->