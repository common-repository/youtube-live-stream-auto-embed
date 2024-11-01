=== Youtube Live Stream Auto Embed===
Contributors: sykemedia
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=7SCTYGSQ3R3ME
Author: SykeMedia
Link: https://www.sykemedia.net/wordpress/
Tags: YouTube, Videoplayer, Auto Embed, YouTube Live stream, youtube live chat, google hangouts, hangouts, onair, Shortcode, live-streaming, live chat, API v3
Requires at least: 3.4
Tested up to: 4.9
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Provides a shortcode to automatically embed the live stream and live chat of a specified YouTube channel. Many more features in the PRO Version.

== Description ==

This Wordpress plugin provides a shortcode to automatically embed the live stream and live chat from any specified YouTube channel ID. If not live auto embed previously completed live stream. No need to update the embed code ever again.
CHANNEL/VIDEO INFO - LIVE CHAT OPTIONS - CLICKABLE LIKE/DISLIKE BUTTONS - Plus loads more features in the PRO Version.

**Main Features:**

* <strong>Automatically</strong> embeds a YouTube <strong>Live Stream</strong> from a Channel ID
* <strong>Automatically</strong> embeds the current live stream <strong>Live Chat</strong>
* When NOT streaming live <strong>automatically</strong> embeds the previously <strong>Completed Live Stream</strong>

**(NEW 2018) Pro Version:**

* Fully responsive layout (mobile friendly)
* Display <strong>LIVE Stream</strong> (<a href="https://www.sykemedia.net/wordpress/" target="_blank">View Demo</a>)
* If no live stream, display <strong>UPCOMING Live Stream</strong>
* If no live or upcoming, display previously completed stream OR latest video upload
* Display <strong>LIVE CHAT</strong>
* Live player/chat ‘width’ slider drag bar. 
* Button to move live chat beside/under the live player
* Custom play/pause/mute buttons
* Display video information, views, watching now, title, description
* Display video likes/dislikes
* Clickable like/dislike buttons (requires HTTPS)
* All live stream/video stats update dynamically on screen (views, watching now, likes)  
* Light/Dark YouTube theme including the live chat
* Display multiple channels per page
* Short code works in Widgets 
* Channel header displaying banner image, total video count, views, subscribers
* Channel video slider showing all or chosen amount of videos
* Options in the admin page to show/hide any section
* Plus lots more!


<strong>How it works...</strong> (<a href="https://www.sykemedia.net/wordpress/" target="_blank">View LIVE Demo</a>)

<strong>A.</strong> If you're currently live, automatically display the live video, if not live display most recently completed live stream. (Free Version)

<strong>B.</strong> If you're not currently live, display upcoming event, completed live stream or latest video upload. (<a href="https://www.sykemedia.net/wordpress/" target="_blank">View Pro Version</a>)

**Plugin Support**

We have made this plugin super simple to install and setup, however if you have any trouble or run into any problems <a href="https://www.sykemedia.net/wordpress/wp-plugin-contact-support/" target="_blank">get in touch</a> and we will spend the time to help you get the plugin up and running correctly.

<strong>Works using JavaScript and the latest YouTube API V3</strong>

== Installation ==

1. Upload the complete `youtube-live-stream-auto-embed` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to the plugins settings page located in in the settings tab of the Wordpress admin menu and setup your default settings
4. Paste the Youtube Live shortcode in a page or post [youtube-live]
5. ALL DONE!

**Make Any Shortcode Work in a Widget**

To make the shortcode work in a widget you need to add this line to your functions.php file

add_filter('widget_text', 'do_shortcode');

Your Functions file is located here...

http://www.yourwebsite.com/wp-content/themes/YOURTHEME/functions.php

**YouTube API Credentials**

Full detailed instructions with images can be found on the plugins admin settings page, making things nice and simple.

1. Go to the Google Developers Console <a href="https://console.developers.google.com/project" target="_blank">www.console.developers.google.com/project</a>
2. Select a project, or create a new one
3. In the sidebar on the left, expand APIs & auth. Next, click APIs. In the list of APIs, make sure the status is ON for the YouTube Data API v3 by creating a new Public API access key.

**YouTube Channel ID Code**

1. Find your YouTube Channel ID by visting <a href="https://www.youtube.com/account_advanced" target="_blank">www.youtube.com/account_advanced</a>

**Known Issues**

FIXED - The embeded player can take a few minutes to dedect a live stream before it auto embeds the live player, working on improving this in future updates. 

== Frequently Asked Questions ==

= Auto embed the live stream, how long does it take to detect that I am streaming live? =

The embeded player can take a few minutes to dedect a live stream before it auto embeds the live player, working on improving this in future updates.

= Can't get the plugin to work? =

A common error is usally due to an extra Space at the end of your API or Channel ID.

Also make sure you have filled in ALL the fields on the plugins settings page.

You can also test the live stream with the following details: Sky News Live 24/7

Test Youtube Channel ID: UCoMdktPbSTixAyNGwb-UYkQ

Test API Key: AIzaSyDtfQfxROiBBM1AydfRlOwypunxPwFgAB0 

== Screenshots ==

1. Auto embed youtube live stream with a shortcode
2. Youtube Live Stream Auto Embed settings page

== Changelog ==

= 1.0.5 =
* Created September 21, 2018

= 1.0.4 =
* Created September 05, 2018

= 1.0.3 =
* Created August 27, 2018

= 1.0.2 =
* Created August 11, 2015

= 1.0.1 =
* Created July 29, 2015

= 1.0.0 =
* Created June 29, 2015

== Upgrade Notice ==

= 1.0.5 =
Fith version release.

= 1.0.4 =
Fourth version release.

= 1.0.3 =
Third version release.

= 1.0.2 =
Second version release.

= 1.0.0 =
First version release.

== Credits ==
* [sykemedia](https://sykemedia.net/creative) - for plugin development
