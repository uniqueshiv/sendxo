<?php

require_once dirname(__FILE__) . '/../../autoloader.php';

if(!isset($_SESSION['droppy_premium'])) :
    echo '<p style="text-align: center; padding-top: 20px;">' . lang('premium_need_premium') . '</p>';
else:
    $clsUploads = new PremiumUploads();
    $clsDownloads = new PremiumDownloads();
    //echo "<pre>"; print_r($clsUploads);
    $premium_session_id = $_SESSION['droppy_premium'];
    
    $get_uploads = $clsUploads->getBySessionID($premium_session_id);
	
	//echo "<pre>"; print_r($get_uploads);

    if(!$get_uploads):
        echo '<p style="text-align: center; padding-top: 20px;">' . lang('premium_no_uploads') . '</p>';
    else:
        ?>
       <h2>Your uploads:</h2>

      

		<table class="table table-striped">
            <thead>
                                    
            <tr>
                <th>ID</th>
                <th><?php echo lang('total_size'); ?></th>
                <th><?php echo lang('destructed_on'); ?></th>
                <th><?php echo lang('premium_total_downloads'); ?></th>
                <th>View</th>
				<th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($get_uploads AS $row)
            {
                $uploadid = $row['upload_id'];

                $total_downloads = $clsDownloads->getTotalByUploadID($uploadid);
                //print_r($row);

                //Table data
                echo '<tr>';
                echo '<td>' . $uploadid . '</td>';
                echo '<td>' . round($row['size'] / 1048576, 2) . ' MB</td>';
                echo '<td>' . date("Y-m-d", $row['time_expire']) . '</td>';
                echo '<td>' . $total_downloads . '</td>';
                echo '<td><a href="' . $this->config->item('site_url') . $uploadid . '/'.$row['secret_code'].'">' . lang('open')  . '</a></td>';
				echo '<td><a href="' . $this->config->item('site_url') . 'upload/deletefile/'.$uploadid .'" onclick="return confirmdel();">Delete</a></td>';
                echo '</tr>';
            }
            ?>
            </tbody>
        </table>
        <?php
    endif;
endif;
?>
<script>
function confirmdel(){
	return confirm("Are you sure to delete?");
}
</script>