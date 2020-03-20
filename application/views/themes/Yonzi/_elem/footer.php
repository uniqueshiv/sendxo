			</div>
		</div>
	</section>
	<div class="container">
	<?php
if($settings['ad_2_enabled'] == 'true' && !isset($noad)):
    ?>
    <div id="ad_2_div" style="margin: 30px auto 30px 0;">
        <?php echo $settings['ad_2_code']; ?>
    </div>
<?php
endif;
?>
	</div>
	
	<footer>
		<div class="container">
		<?php echo date('Y'); ?><?php echo lang('foot_copyright'); ?>
		</div>
	</footer>
	
	<script src="assets/themes/<?php echo $settings['theme'] ?>/js/vegas.min.js"></script>
	  <script src="//cdn.jsdelivr.net/jquery.sidr/2.2.1/jquery.sidr.min.js"></script>
	<script> 
	$(document).ready(function(){
	  $("#opensettings").click(function(){
		$("#settings").slideToggle("slow");
	  });
	});
	</script>
<script src="assets/themes/<?php echo $settings['theme'] ?>/js/jquery-ui.min.js"></script>
<script src="assets/js/jquery.knob.min.js"></script>

<script src="assets/js/jquery.fileupload.js"></script>
<?php if(!empty($settings['recaptcha_key'])): ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
<?php endif; ?>

<script>
    var mobileVersion = "no";
    var maxSize = <?php echo $settings['max_size']; ?>;
    var maxFiles = <?php echo $settings['max_files']; ?>;
    var maxSizeBytes = maxSize * 1024 * 1024;
    var maxChunkSize = <?php echo $settings['max_chunk_size']; ?>;
    var disallowedFiles = "<?php echo $settings['blocked_types']; ?>";
    var process_activate = false;
    var siteUrl = "<?php echo $settings['site_url']; ?>";

        $(document).ready(function() {
        var backgrounds = [
            <?php
            foreach($backgrounds AS $background) {
                $ext = pathinfo($background->src, PATHINFO_EXTENSION);
                echo '{ '.($ext == 'mp4' ? 'video: { src: "' . $background->src . '", mute: true, loop: false },' : 'src: "'.$background->src.'",') . ' clickurl: "'.$background->url.'", '.(!empty($background->duration) && $background->duration > 0 ? 'delay: '.($background->duration * 1000) : 'delay: '.($settings['bg_timer'] * 1000)) . '},';
            }
            ?>
        ];

        
        backgrounds.shuffle();

        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });

        $(".background").vegas({
            slides: backgrounds
        });
    });
</script>

<script src="assets/themes/<?php echo $settings['theme'] ?>/js/droppy.js?v=<?php echo $settings['version']; ?>"></script>

<script>Form.pickShareOption('<?php echo $settings['default_sharetype'] ?>');</script>
<?php
if(isset($_GET['goto']))
    echo '<script>Pager.openSettings();Pager.openInlinePage("'.$_GET['goto'].'");</script>';
?>

<?php echo $settings['analytics']; ?>

<!-- Droppy V<?php echo $settings['version'] ?> -->

<script>
$(document).ready(function () {
        var url = window.location;
        $('ul.nav a[href="' + url + '"]').parent().addClass('active');
        $('ul.nav a').filter(function () {
            return this.href == url;
        }).parent().addClass('active').parent().parent().addClass('active');
    });
</script>
</body>
</html>