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
					
					
					<div class="main termsbox" id="uploadDiv">
						<div class="progressImage"><i class="fas fa-globe fa-5x"></i></div>
						<div class="progressMessage" style="padding-top: 15px;">
							<p><?php echo $this->lang->line('accept_terms') ?></p>
						</div>

						<div style="text-align: center;">
							<p><a <?php echo ($mobile ? 'href="#" data-toggle="modal" data-target="#termsmodal"' : 'href="#termsmodal" data-toggle="modal" data-target="#termsmodal" id="open_terms"') ?>"><?php echo $this->lang->line('view_terms') ?></a></p>
						
						</div>
						<?php echo ($mobile ? '<br><br>' : '') ?>
						<div class="buttonSection" style="padding-top: 20px;">
							<a class="btn-yonzi" href="handler/acceptterms?url=<?php echo urlencode(current_url()) ?>"><i class="fa fa-check"></i> <?php echo $this->lang->line('accept') ?></a>
						</div>
						 <div class="modal fade" id="termsmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
						  <div class="modal-dialog" role="document">
							<div class="modal-content">
							  <div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle">Terms of service</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								  <span aria-hidden="true">&times;</span>
								</button>
							  </div>
							  <div class="modal-body">
								 <?php
									echo $settings['terms_text'];
									?>
							  </div>
							  <div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	
							  </div>
							</div>
						  </div>
						</div>
					</div>
					
				</div>
			</div>
			</div>