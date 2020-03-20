<div class="row">
<div id="Homepage" class="tabcontent">
<div class="main mainform col-md-4" id="downloadDiv">

    <?php if(isset($data) && is_array($data)): ?>
        <?php if($data['status'] == 'ready'): ?>
            <div id="downloadForm">
                <?php
                if($data['password'] != 'EMPTY' && !empty($data['password'])) : ?>
                    <div style="text-align: center;">
                        <div id="downloadLogo"><i class="fas fa-lock fa-5x" style="padding-top: 35px;"></i></div>
                        <p id="statusDownload" style="padding-top: 30px;"><?php echo lang('fill_password'); ?>:</p>
                    </div>

                    <form id="downloadPassword" action="handler/download" method="post">
                        <div class="form-group">
                            <input type="hidden" name="action" id="action" value="download">
                            <input type="hidden" name="download_id" id="download_id" value="<?php echo $upload_id; ?>">
                            <input type="hidden" name="private_id" id="private_id" value="<?php echo $unique_id; ?>">
                            <input type="hidden" name="url" value="<?php echo urlencode(current_url()) ?>">
                            <input type="password" class="form-control input-sm" id="password" name="password" placeholder="<?php echo lang('password'); ?>" autocomplete="off" required>
                        </div>
                        <?php
                        if($data['destruct'] == 'YES') :
                            ?>
                            <input type="submit" class="btn-yonzi btn-block btn-sm" id="submitpass" value="<?php echo lang('download'); ?> & <?php echo lang('destruct'); ?>">
                            <?php
                        else :
                            ?>
                            <input type="submit" class="btn-yonzi btn-block btn-sm" id="submitpass" value="<?php echo lang('download'); ?>">
                            <?php
                        endif;
                        ?>
                    </form>
                <?php else: ?>
                    <form id="downloadItems" action="handler/download" method="post">
                        <input type="hidden" name="action" id="action" value="download">
                        <input type="hidden" name="download_id" id="download_id" value="<?php echo $upload_id; ?>">
                        <input type="hidden" name="private_id" id="private_id" value="<?php echo $unique_id; ?>">
                        <input type="hidden" name="file_name" id="file_name" value="<?php echo $unique_id; ?>">

                        <div style="text-align:center;"><i class="fas fa-cloud-download-alt fa-3x"></i></div>
                        <div style="padding-top: 5px;">
                            <table>
                                <tr>
                                    <td><b><?php echo lang('total_size'); ?>:</b></td>
                                    <td class="td_2"><?php echo (($data['size'] < 1048576)? round($data['size'] / 1024, 2) . ' KB' : round($data['size'] / 1048576, 2) . ' MB'); ?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo lang('total_files'); ?>:</b></td>
                                    <td class="td_2"><?php echo $data['count']; ?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo lang('destructed_on'); ?>:</b></td>
                                    <td class="td_2"><?php echo date("Y-m-d", $data['time_expire']); ?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo lang('download_id'); ?>:</b></td>
                                    <td class="td_2"><?php echo $upload_id; ?></td>
                                    
                                </tr>
                            </table>
                            <b><?php echo lang('files'); ?>:</b>
                            
                            <style>
                                .list-view ul{ margin:0; padding:0;}
                                .list-view ul li{ margin:0; padding:8px 0; list-style:none;}
                                 
                                 .edit-bt {    display: inline-block;    width: 30px;    height: 30px;    background: #fff;    color: #333;    border-radius: 50px;
                                                                text-align: center;    line-height: 30px;    border: #333 1px solid;    margin: 0 0 0 5px; transition:0.3s;}
                                .edit-bt:hover{ background: #333; color:#fff;   }                                                                
                                
                                
                                #RenameUpdate {    display: inline-block;    width: 30px;    height: 30px;    background: #fff;    color: green;    border-radius: 50px;
                                                                text-align: center;    line-height: 30px;    border:green 1px solid;    margin: 0 0 0 5px; transition:0.3s;}
                                #RenameUpdate:hover{ background: green; color:#fff;   }  
                                
                                
                                #close-bt {    display: inline-block;    width: 30px;    height: 30px;    background: #fff;    color: red;    border-radius: 50px;
                                                                text-align: center;    line-height: 30px;    border: red 1px solid;    margin: 0 0 0 5px; transition:0.3s;}
                                #close-bt:hover{ background:red; color:#fff;   }  
                               #updateFile {
    border: #cccaca 1px solid;
    padding: 5px 10px 0 15px;
    border-radius: 5px;
    height: 42px;
    margin: 0 0 10px 0;
}
                                                                
                                
                            </style>
                            
                            
                            <div style="font-size: 14px; overflow-x: hidden;" class="list-view">
                                <ul>
                                    <?php
                                    // print_r($files);
                                    // print_r($renameFiles);
                                    foreach($files as $file) {
                                        $filename = $file['file'];
                                        if($renameFiles[0]->upload_id == $file['upload_id']){
                                            echo '<li >' . $renameFiles[0]->file . '  <span class="edit-bt"><i class="fas fa-edit" id="RenameFile"></i></span></li>';
                                        }else{
                                            echo '<li>' . $file['file'] . '  <span class="edit-bt"><i class="fas fa-edit" id="RenameFile"></i></span></li>';
                                        }
                                    }
                                    ?>
                                    <div id="rename_error"></div>

                                    <input type="hidden" name="originalfile" value="<?php if(count($renameFiles)>0){ echo $renameFiles[0]->file; }else{ echo $filename; } ?>" id="originalfile">
                                    <input type="text" name ="updated_file" value="<?php if(count($renameFiles)>0){ echo $renameFiles[0]->file; }else{ echo $filename; } ?>" style='display:none;' id="updateFile">
                                    <span id="RenameUpdate" style="display:none;"><i class="fas fa-check" ></i></span>
                                    <span id="close-bt" style="display:none;">x</span>
                                    
                                </ul>
                               
                            </div>
                            <?php if(!empty($data['message'])) : ?>
                                <b><?php echo lang('message'); ?>:</b>
                                <div style="height: 50px; overflow: auto;">
                                    <?php echo $data['message']; ?>
                                </div>
                            <?php else: ?>
                                <div style="height: 70px; display: none;"></div>
                            <?php endif; ?>
        
                            
                            <br>
                        </div>
                        <?php echo ($mobile ? '<br><br>' : '') ?>
                        <div class="buttonSection">
                            <?php if($data['destruct'] == 'YES'): ?>
                                <input type="submit" class="btn-yonzi" id="submitdownload" value="<?php echo lang('download'); ?> & <?php echo lang('destruct'); ?>">
                            <?php else: ?>
                                <input type="submit" class="btn-yonzi" id="submitdownload" value="<?php echo lang('download'); ?>">
                            <?php endif; ?>
                        </div>
                    </form>

                    <!-- Script -->
  <script type='text/javascript'>
  $(document).ready(function(){

    var $inputs = $('#downloadItems :input');

    $('#RenameFile').click(function(){
        $('#updateFile').toggle();
        $("#RenameUpdate").toggle();
         $("#close-bt").toggle();
	})
	
	$('#close-bt').click(function(){
        $('#updateFile').hide();    
		$("#RenameUpdate").hide();
		$('#close-bt').hide();
	})
    var str = $( "form" ).serialize();

    $('#RenameUpdate').click(function(){
        var values = {};
        $inputs.each(function() {
            values[this.name] = $(this).val();
        });
        
        if($('#updateFile').val() === $('#originalfile').val()){
			 $('#rename_error').text("Please change the name of file")
			 setTimeout(() => {
                $('#rename_error').fadeOut();
             },1000)
        }
        if($("#updateFile").val() ===""){
			$('#rename_error').text("Please enter the name of file!")
			 setTimeout(() => {
                $('#rename_error').fadeOut();
             },1000)
        }

        $.ajax({
            url:'<?=base_url()?>index.php/handler/renameFile',
            method: 'post',
            data: { data: values },
            success: function(response){
				$('#updateFile').hide(); 
				$('#close-bt').hide();   
                $("#RenameUpdate").hide();
                $('#rename_error').text("File successfully renamed!");
                location.reload();
                setTimeout(() => {
                    $('#rename_error').fadeOut();
                },1000)
            }
        });

    });

 });
 </script>
                <?php endif; ?>
            </div>

            <div id="downloadSuccess">
                <div style="text-align:center; padding-top: 25px;"><i class="fas fa-check-circle fa-5x"></i></div>
                <div style="padding-top: 15px;">
                    <p><?php echo lang('download_started'); ?></p>
                </div>
                <div class="buttonSection">
                    <a class="btn-yonzi" href="<?php echo $settings['site_url']; ?>" disabled="disabled"><?php echo lang('ok'); ?></a>
                </div>
            </div>
        <?php elseif($data['status'] == 'processing'): ?>
            <div id="downloadError">
                <div class="progressImage"><i class="fas fa-clock fa-5x"></i></div>
                <div class="progressMessage">
                    <p><?php echo lang('upload_processing'); ?></p>
                </div>
                <div class="buttonSection">
                    <a class="btn-yonzi" href="<?php echo $settings['site_url']; ?>"><?php echo lang('ok'); ?></a>
                </div>
            </div>
        <?php else: ?>
            <div id="downloadError" style="width: 70%; margin-left: auto; margin-right: auto;">
                <div style="text-align:center;"><i class="fas fa-question-circle fa-5x"></i></div>
                <div style="padding-top: 15px; font-size: 14px;">
                    <p><?php echo lang('upload_not_found'); ?></p>
                </div>
                <div class="buttonSection">
                    <a class="btn-yonzi" href="<?php echo $settings['site_url']; ?>"><?php echo lang('ok'); ?></a>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div id="downloadError" style="width: 70%; margin-left: auto; margin-right: auto;">
            <div style="text-align:center;"><i class="fas fa-question-circle fa-5x"></i></div>
            <div style="padding-top: 15px; font-size: 14px;">
                <p><?php echo lang('upload_not_found'); ?></p>
            </div>
            <div class="buttonSection">
                <a class="btn-yonzi" href="<?php echo $settings['site_url']; ?>"><?php echo lang('ok'); ?></a>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php
if(isset($_GET['error'])) {
    echo '<script>$(document).ready(function() { General.errorMsg("'.lang($_GET['error']).'"); });</script>';
}
?>
<?php
if($settings['ad_2_enabled'] == 'true' && !isset($noad)):
    ?>
    <div id="ad_2_div" style="margin: 30px auto 0 35px;">
        <?php echo $settings['ad_2_code']; ?>
    </div>
<?php
endif;
?>
</div>
 </div>
            
