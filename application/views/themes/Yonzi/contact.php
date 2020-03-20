<div class="row">
	<div id="Contactus" class="tabcontent">
			<div style="padding-left: 10px; padding-right: 10px;">
				<?php echo lang('contact_intro'); ?>
				 <div id="contact_tab_body" class="settingsBodyContent contactpage" style="margin-top: 15px;">
                        <form class="contact-form">
                            <p style="padding-top: 15px;"><?php echo lang('email'); ?>(*):</p>
                            <div class="input-group">
                                <input type="email" class="form-control input-sm" name="contact_email" id="contact_email" placeholder="<?php echo lang('contact_email_description'); ?>">
                            </div>
                            <p style="padding-top: 15px;"><?php echo lang('subject'); ?>(*):</p>
                            <div class="input-group">
                                <input type="text" class="form-control input-sm" name="contact_subject" id="contact_subject" placeholder="<?php echo lang('contact_subject_description'); ?>">
                            </div>
                            <p style="padding-top: 15px;"><?php echo lang('message'); ?>(*):</p>
                            <div class="input-group">
                                <textarea class="form-control input-sm" name="contact_message" placeholder="<?php echo lang('contact_message_description'); ?>"></textarea>
                            </div>
                            <br>
						 <?php if(!empty($settings['recaptcha_key'])): ?>
                                <div class="g-recaptcha" data-sitekey="<?php echo $settings['recaptcha_key']; ?>"></div>
                            <?php endif; ?>
                            
                            <button class="btn-yonzi"><i class="fas fa-paper-plane"></i> <?php echo lang('send') ?></button>
                        </form>
                    </div>
			</div>
	</div>