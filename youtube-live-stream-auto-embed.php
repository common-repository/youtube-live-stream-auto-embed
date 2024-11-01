<?php
/*
Plugin Name: Youtube Live Stream Auto Embed
Plugin URI: https://www.sykemedia.net/wordpress/
Description: <strong>FREE VERSION</strong> - Automatically embed ANY Youtube live stream and live chat, if not live auto embed previously completed live stream. No need to update the embed code ever again. <em>YouTube Data API v3</em>. LIVE CHAT OPTIONS - <u>CLICKABLE</u> LIKE/DISLIKE BUTTONS - Plus many more features in the PRO Version.
Author: SykeMedia (View PRO Version)
Version: 1.0.5
Author URI: https://www.sykemedia.net/wordpress/
Text Domain: youtube-live-stream-auto-embed
License: GPLv2 or later

Copyright 2018 SykeMedia
*/

	defined( 'ABSPATH' ) or die( 'Plugin file cannot be accessed directly.' );
	
	if ( ! defined( 'ABSPATH' ) ) exit;
	
	if (!class_exists('Youtube_Live_Auto_Embed')) {

    class Youtube_Live_Auto_Embed {}

/*-----------------------------------------------------------------------------------*/
/* Youtube Live Plugin CSS */
/*-----------------------------------------------------------------------------------*/

	add_action( 'wp_enqueue_scripts', 'yt_live_stylesheet' );

    	function yt_live_stylesheet() {
        	wp_enqueue_style( 'youtube-live', plugins_url('assets/css/youtube-live-style.css', __FILE__) );
    }

	add_action( 'admin_enqueue_scripts', 'yt_admin_stylesheet' );

    	function yt_admin_stylesheet() {
        	wp_enqueue_style( 'youtube-live', plugins_url('admin/css/admin-options.css', __FILE__) );
    }

/*-----------------------------------------------------------------------------------*/
/* Create Youtube Player Admin Menu */
/*-----------------------------------------------------------------------------------*/

	add_action( 'admin_menu', 'youtube_live_menu' );
 
		function youtube_live_menu() {
			
    		add_options_page( 'Youtube Live Plugin Options', 'YouTube Live', 'manage_options', 'youtube-live', 'youtube_live_plugin_options' );
	}
 
	function youtube_live_plugin_options() {
	
		if ( !current_user_can( 'manage_options' ) )  {
			wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
		}
		include __DIR__."/admin/options.php";
	} 

/*-----------------------------------------------------------------------------------*/
/* Youtube Live Player Shortcode */
/*-----------------------------------------------------------------------------------*/

	function yt_live_shortcode(){
	
		ob_start();
	
	if ( ! defined( 'ABSPATH' ) ) exit;

	$yt_channel_name = "yt_channel";
	$yt_api_name = "yt_apikey";
 
	if(isset($_POST["get"])){ 

    	$yt_channel_show = sanitize_text_field($_POST[$yt_channel_name]);
    	$yt_apikey_show = sanitize_text_field($_POST[$yt_api_name]);    
}
	else{
		
    	$yt_channel_show = get_option($yt_channel_name);
		$yt_apikey_show = get_option($yt_api_name);
}

?>
	<div id="yt-live-box">
		<div class="yt-video-container">
			<div id="player-yt"></div>
        </div>
    </div>   
        
<script>

	var YtChannelId = '<?php echo esc_attr($yt_channel_show); ?>';
    var Yt_API_KEY = '<?php echo esc_attr($yt_apikey_show); ?>';
	var CurUrl = window.location.host.replace(/https?:\/\//i, "");
    var videoId;
	
	var CurStatus = 'none';
    
      function init() {
        gapi.client.setApiKey(Yt_API_KEY);
        gapi.client.load('youtube', 'v3').then(makeRequest);
      }
      
      function makeRequest() {
        var request = gapi.client.youtube.search.list({
            part: 'snippet',
            channelId: YtChannelId,
			playerVars: { 'autoplay': 1, 'controls': 1,'autohide':1, },
            maxResults: 1,
            type: 'video',
            eventType: 'live'
            
        });
        
        request.then(function(response) {
          processResult(response);
        }, function(reason) {
          console.log('Error: ' + reason.result.error.message);
        });
        
      }
      
      function processResult(result){
        
        //console.log(result);
        
        var json = JSON.parse(result.body);
        if(json.pageInfo.totalResults == 0){
			
			if(CurStatus == 'none'){
				makeCompRequest();
			}
		
		} else {
			videoId = json.items[0].id.videoId;
			if(CurStatus == 'completed'){
				document.getElementById('yt-live-box').innerHTML('<div class="yt-video-container"><div id="player-yt"></div></div>');
			}
			CurStatus = 'live';
			createIframe();
			createLiveChat();   
        }
        
      }
	  
      function makeCompRequest() {
        var requestComp = gapi.client.youtube.search.list({
            part: 'snippet',
            channelId: YtChannelId,
			playerVars: { 'autoplay': 1, 'controls': 1,'autohide':1, },
            maxResults: 1,
            type: 'video',
			order: 'date',
            eventType: 'completed'
            
        });
        
        requestComp.then(function(responseComp) {
          processCompResult(responseComp);
        }, function(reasonComp) {
          
        });
        
      }
	  
      function processCompResult(resultComp){
        
        //console.log(resultComp);
        
        var jsonComp = JSON.parse(resultComp.body);
        if(jsonComp.pageInfo.totalResults == 0){
		
			console.log('Sorry, no live or completed streams found for YouTube channel ID: '+ YtChannelId);
		
		} else {
			videoId = jsonComp.items[0].id.videoId;
			CurStatus = 'completed';
			createIframe();
			setTimeout(CheckLiveStatus, 10000);
			 
        }
        
      }
	  
      function createLiveChat() {

		var ChatBox = document.createElement('div');				
		ChatBox.setAttribute('id', 'yt-chat-box');
		ChatBox.setAttribute('class', 'yt-chat-container');
		document.getElementById('yt-live-box').appendChild(ChatBox);
		  
		// LIVE CHAT IFRAME
		var VidChat = document.createElement('iframe');				
		VidChat.setAttribute('id', 'yt-chat-iframe');
		VidChat.setAttribute('class', 'yt-live-chat-iframe');
		VidChat.setAttribute('src', 'https://www.youtube.com/live_chat?v=' + videoId + '&embed_domain=' + CurUrl + '&app=desktop');
		VidChat.setAttribute('width', '640');
		VidChat.setAttribute('height', '360');
		VidChat.setAttribute('scrolling', 'no');
		VidChat.setAttribute('seamless', 'seamless');
		VidChat.setAttribute('frameborder', '0');
		document.getElementById('yt-chat-box').appendChild(VidChat);
		  
      }
	  
      function createIframe(){
      
      var tag = document.createElement('script');
      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
      }
      
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player-yt', {
          videoId: videoId,
          events: {
            'onReady': onPlayerReady,
          }
        });
      }
  
      function onPlayerReady(event) {
        event.target.playVideo();
      }
	  
      function CheckLiveStatus() {

		if(CurStatus == 'completed'){
			
			
			makeRequest();
			setTimeout(CheckLiveStatus, 10000);
		}
		
      }	  

  </script>
  
  <script src="https://apis.google.com/js/client.js?onload=init"></script>
<?php  
	
		return ob_get_clean();
	}
	add_shortcode('youtube-live', 'yt_live_shortcode');

	}