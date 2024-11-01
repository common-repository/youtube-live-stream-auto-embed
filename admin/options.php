
<?php

	if ( ! defined( 'ABSPATH' ) ) exit;
	
	if(!current_user_can('manage_options')) {
		die('Access Denied');
	} else {
	
		$yt_channel_name = "yt_channel";
		$yt_api_name = "yt_apikey";
		
		
		if(isset($_POST["submit"])){ 
		
			$yt_channel_show = sanitize_text_field($_POST[$yt_channel_name]);
			update_option($yt_channel_name, $yt_channel_show);
			
			$yt_apikey_show = sanitize_text_field($_POST[$yt_api_name]);
			update_option($yt_api_name, $yt_apikey_show);
			
			echo '<div id="message" class="updated fade"><p>Options Updates</p></div>';
		} else {
			$yt_channel_show = get_option($yt_channel_name);
			$yt_apikey_show = get_option($yt_api_name);
		}
	
?>
    
        <div class="wrap">
            <h2>YouTube Live Stream Auto Embed (Free Version)</h2>
            <div class="ytl-form-container">
            <form method="post" action="#">
                <p class="ytl-legend"><strong>Note:</strong> YouTube API Key Instructions <a href="https://www.sykemedia.net/wordpress/plugin-support/wp-plugin-installation-setup-guide/" target="_blank">Click Here.</a> Find your Channel ID via <a href="https://www.youtube.com/account_advanced" target="_blank">YouTube Account Overview</a>.</p>
                <fieldset>
                    <legend>YouTube Live Stream</legend>
                    <div>
                        <label for="<?php echo esc_attr($yt_api_name); ?>">Youtube API Key: <em>*</em></label>
                        <input type="text" name="<?php echo esc_attr($yt_api_name); ?>" value="<?php echo esc_attr($yt_apikey_show); ?>" size="50" placeholder="AIzaSyByOJICV_z68_oEYryuhAXalLstIvQ3sA" required="required" />
                    </div>
                    <div>
                        <label for="<?php echo esc_attr($yt_channel_name); ?>">Youtube Channel ID: <em>*</em></label>
                        <input type="text" name="<?php echo esc_attr($yt_channel_name); ?>" value="<?php echo esc_attr($yt_channel_show); ?>" size="50" placeholder="UCoMdktPbSTixAyNGwb-UYkQ" required="required" />
                    </div>
                    <input type="submit" value="Save" class="button" name="submit" style="width: 145px;" />
                </fieldset>	
                <br />
                <fieldset>
                    <legend>How to display the Youtube Live Player</legend>
                    <div class="controlset">
                        <p>Copy & Paste this shortcode to auto embed the YouTube Player anytime the selected channel begins streaming live: <strong>[youtube-live]</strong></p>
                    </div>
                </fieldset> 
                <br />
                <fieldset>
                    <legend><a href="https://www.sykemedia.net/wordpress/" target="_blank">NEW PRO VERSION</a></legend>
                        <div class="controlset">
                            <p>The new pro version of this plugin is packed full of features giving you complete control over the information you fetch and display from any <strong>single or multiple YouTube channels</strong>. Automatically embed <strong>live stream</strong>, if no live stream found embed <strong>upcoming event</strong>, completed, latest video. <strong>Show channel and video information including <u>clickable</u> like/dislike buttons. ‘Views’ and ‘Watching Now’ <u>counts update onscreen</u>.</strong></p>
                            <br />
                            <a href="https://www.sykemedia.net/wordpress/" target="_blank">View PRO Version Demo</a>
                            <br />
    <?php 
    echo '<a style="text-align:center;padding:15px 0px;display:block;" href="https://www.sykemedia.net/wordpress/" target="_blank"><img src="' . plugins_url( 'admin/img/go-live-demo.jpg', dirname(__FILE__) ) . '" ></a>';
    ?>
                            <br />
    <?php
    echo '<a style="text-align:center;padding:15px 0px;display:block;" href="https://www.sykemedia.net/wordpress/" target="_blank"><img src="' . plugins_url( 'admin/img/go-live-demo-2.jpg', dirname(__FILE__) ) . '" ></a>';
    ?>
                            <br />
                            <a href="https://www.sykemedia.net/wordpress/" target="_blank">View PRO Version Demo</a>
                        </div>
                </fieldset> 
            </form>
            </div>
            <p id="copyright">Created by SykeMedia. YouTube Live Stream Auto Embed. <a href="https://www.sykemedia.net/wordpress/" target="_blank">Plugin Support</a></p>
        </div>

<?php    
		}
