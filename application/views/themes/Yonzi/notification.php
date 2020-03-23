<div class="row">			
	<div class="col-md-8">
		<div id="notifictaions" class="tabcontent">
            <?php
            // 	 echo $settings['about_text'];

             ?>
    <div class="container mt-5">
        <div class="title row">
          <h3>All Notifications</h3>
        </div>
    </div>
    <?php if(count($allnotifications)>0){
        foreach($allnotifications as $noti){
            $class = array("alert-success","alert-warning","alert-danger","alert-primary","alert-info");
            $random_keys=array_rand($class,3);

            ?>
        <div class="alert <?php echo $class[$random_keys[0]]; ?>">
            <div class="container">
                <div class="alert-icon">
                    <i class="material-icons">info_outline</i>
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true"><i class="material-icons">clear</i></span>
                </button>

                <?php echo $noti->title;?>
            </div>
        </div>
            <?php
        }
    } ?>
   
		</div>		
	</div>
	