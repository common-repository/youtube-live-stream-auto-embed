<?php

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
  