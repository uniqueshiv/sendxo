<form enctype="multipart/form-data" id="upload-form" class="uploadForm">
<div class="row">
<div id="Homepage" class="tabcontent">
<div class="col-md-8" style="margin-bottom: 20px;">
				 <article class="maininfo">
					<header>
						<h1><?php echo lang('intro_head'); ?></h1>
					</header>
					<p><?php echo lang('intro_text'); ?></p>
					<a href="page/premium" class="buttona"><?php echo lang('go_premium'); ?></a>
				 </article>
				</div>
				
				<div class="col-md-4 mainform">
					<div class="main" id="uploadDiv">
					
									<h2><?php echo lang('form_title'); ?></h2>
									<hr>
									<div id="errorDiv"></div>
									<div class="FormContent">
						
							<div class="upload_section" id="upload_section">
								<div id="upload-form-list"></div>
								<div class="row" style="padding-left: 20px; padding-right: 20px;">
									<div class="addfil">
									<label class="btn-addfiles">
										<input type="file" name="files[]" multiple="multiple">
										<?php echo lang('select_files'); ?><br /><span id="total_upload_size"><?php echo (($settings['max_size'] < 1024) ?  $settings['max_size'] . ' MB' : round($settings['max_size'] / 1024, 2) . ' GB'); ?> <?php echo lang('max'); ?></span>
										</label>
										</div>
									<div class="addfol">
									<label class="btn-addfolder">
										<input type="file" name="files[]" webkitdirectory directory>
										<?php echo lang('select_folder'); ?><br /><span id="total_upload_size"><?php echo (($settings['max_size'] < 1024) ?  $settings['max_size'] . ' MB' : round($settings['max_size'] / 1024, 2) . ' GB'); ?> <?php echo lang('max'); ?></span>
										</label>
									</div>
								</div>
								
							</div>
							<hr>
							<div style="padding-left: 20px; padding-right: 20px;">
							<?php
                if(empty($settings['default_email_to'])) :
                    ?>
                    <div class="EmailToSection" id="EmailToSection">
                        <div class="form-group" id="receivers" class="receivers" style="display: none;">
                            <div id="receiverHiddenList"></div>
                            <div id="receiverList" class="receiverList" style="display: none;"></div>
                        </div>
						
						
						<div style="margin-bottom: 15px;">
                        <input type="email" class="form-control input-sm" id="emailTo" name="email_to[]" placeholder="<?php echo lang('enter_email'); ?>" required="required" style="float: left; width: 90%; border-top-right-radius: 0; border-bottom-right-radius: 0;">
						<div class="addmoremailico" style="float: right;"><a onclick="Form.addReceiver()" class="" id="addReceiver"><img style="" src="assets/themes/<?php echo $settings['theme'] ?>/img/addemails.png"></a></div>
                              <div style="clear: both;"></div>
							  </div> 
							  
					 
				   </div>
                    <?php
                else:
                    ?>
                    <div class="EmailToSection" id="EmailToSection">
                        <input type="email" class="form-control input-sm" id="emailTo" name="email_to[]" value="<?php echo $settings['default_email_to']; ?>" required="required" readonly>
                    </div>
                    <?php
                endif;
                ?>
							
							<div class="EmailFromSection" id="EmailFromSection">
							<div class="form-group">
								<?php
								if(isset($_SESSION['droppy_user'])) :
									?>
									<input type="email" class="form-control input-sm" id="emailFrom" name="email_from" value="<?php echo $_SESSION['droppy_user']; ?>" required="required" readonly>
									<?php
								elseif(isset($_SESSION['droppy_premium'])):
									?>
									<input type="email" class="form-control input-sm" id="emailFrom" name="email_from" value="<?php echo $_SESSION['droppy_premium_email']; ?>" required="required" readonly>
									<?php
								else:
									?>
									<input type="email" class="form-control input-sm" id="emailFrom" name="email_from" placeholder="<?php echo lang('enter_own_email'); ?>" required="required">
									<?php
								endif;
								?>
							</div>
						</div>
							
						<div class="MessageSection">
							<div class="form-group">
								<textarea class="form-control input-sm" style="resize: none; height: 75px;" name="message" id="message" placeholder="<?php echo lang('message_receiver'); ?>" maxlength="1000"></textarea>
							</div>
						</div>
						
							<div id="settings">
									<div class="settingsBody">
                    <div id="upload_settings_tab_body" class="settingsBodyContent">
                        <p><h3><?php echo lang('share_type'); ?>: <i class="fa fa-question-circle" data-toggle="tooltip" title="<?php echo lang('share_type_text'); ?>"></i></h3></p>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default btn-sm <?php if($settings['default_sharetype'] == 'mail') { echo 'active'; } ?>">
                                <input type="radio" name="options" id="option1" onchange="Form.pickShareOption('email')" <?php if($settings['default_sharetype'] == 'mail') { echo 'checked=""'; } ?> > <?php echo lang('email') ?>
                            </label>
                            <label class="btn btn-default btn-sm <?php if($settings['default_sharetype'] == 'link') { echo 'active'; } ?>">
                                <input type="radio" name="options" id="option2" onchange="Form.pickShareOption('link')" <?php if($settings['default_sharetype'] == 'link') { echo 'checked=""'; } ?> > <?php echo lang('link') ?>
                            </label>
                            <input type="hidden" name="share" id="share" value="mail">
                        </div><hr>
						
						
                         <p><h3><?php echo lang('destruct_file'); ?>: <i class="fa fa-question-circle" data-toggle="tooltip" title="<?php echo lang('destruct_text') ?>"></i></h3></p>
                        <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default btn-sm <?php echo ($settings['default_destruct'] == 'no' ? 'active' : ''); ?>">
                                <input type="radio" name="options" id="option3" onchange="Form.pickDestructOption('no')" <?php echo ($settings['default_destruct'] == 'no' ? 'checked=""' : ''); ?>><?php echo lang('no') ?>
                            </label>
                            <label class="btn btn-default btn-sm <?php echo ($settings['default_destruct'] == 'yes' ? 'active' : ''); ?>">
                                <input type="radio" name="options" id="option4" onchange="Form.pickDestructOption('yes')" <?php echo ($settings['default_destruct'] != 'yes' ? 'checked=""' : ''); ?>><?php echo lang('yes') ?>
                            </label>
                            <input type="hidden" name="destruct" id="destruct" value="<?php echo $settings['default_destruct'] ?>">
                        </div><hr>
						
						
						<?php
                        if($settings['password_enabled'] == 'true') :
                            ?>
                            <p><h3><?php echo lang('protect_with_pass'); ?>: <i class="fa fa-question-circle" data-toggle="tooltip" title="<?php echo lang('password_text'); ?>"></i></h3></p>
                           <div class="input-group">
                                <input type="password" class="form-control input-sm" name="password" id="password" placeholder="<?php echo lang('password'); ?>">
                            </div>
                            <i style="font-size: 11px;">(<?php echo lang('leave_empty_password'); ?>)</i>
							 <?php
                        else:
                            ?>
                            <p style="padding-top: 15px;"><b><?php echo lang('protect_with_pass'); ?>: <i class="fa fa-question-circle" data-toggle="tooltip" title="<?php echo lang('password_text'); ?>"></i></b></p>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="password" id="password" placeholder="<?php echo lang('not_available_pass'); ?>" readonly>
                            </div>
                            <i style="font-size: 12px;">(<?php echo lang('leave_empty_password'); ?>)</i>
                            <?php
                        endif;
						?>
                                                </div>
                    
								</div>
							</div>
							<div class="buttonSection row" style="padding-top: 20px; padding-bottom: 20px;">
								<div class="sharef">
									<button type="button" class="btn-yonzi btn-sharefiles" id="submit_upload"><?php echo lang('share_files'); ?></button>
								</div>
								<div class="optionbtn">
									<button type="button" class="btn-yonzi btn-options" id="opensettings"><?php echo lang('upload_settings'); ?></button>
								</div>
								<div style="clear: both;"></div>
								</form>
							</div>
						</div>
					</div>
					
				</div>
				
<div class="main" id="uploadingDiv" style="display: none; text-align: center; padding-top: 30px; padding-bottom: 30px; color: #333;">
    <div id="uploadProcess" class="progressround">
        <input type="text" value="" class="progressCircle" id="progresscircle">
        <div id="progressMb" style="padding-top: 10px; text-align: center; font-size: 13px;"></div>
        <a class="btn-yonzi" id="cancelUpload" style="width: 200px; margin-top: 10px;"><?php echo lang('cancel') ?></a>
    </div>
    <div id="uploadSuccess" class="progresssuccess" style="display: none; padding-top: 40px;">
        <img src="assets/themes/<?php echo $settings['theme'] ?>/img/loader.gif" alt="Upload success" width="180" height="180">
        <h2 style="text-align: center;"><?php echo lang('success'); ?></h2>
        <div id="linkMessage" style="display: none; font-size: 14px;">
            <p><?php echo lang('success_link'); ?></p>
            <div id="downloadLink"></div>
        </div>
        <div id="emailMessage" style="display: none; font-size: 14px; margin-left: 15px;">
            <p><?php echo lang('success_email'); ?></p>
        </div>
        <div class="buttonSection" style="bottom: -55px;">
            <div id="copyButton"></div>
            <div id="okButton" style="display: none;">
                <a href="<?php echo $settings['site_url']; ?>" class="btn-yonzi"><?php echo lang('ok'); ?></a>
            </div>
        </div>
    </div>
</div>
				</div>
			</div>
			</div>
