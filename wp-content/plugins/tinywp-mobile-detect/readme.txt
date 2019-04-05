=== Mobile Detect ===
Contributors: pothi
Donate link: https://paypal.me/pothi
Tags: mobile, tablet, ipad
Requires at least: 3.0
Tested up to: 5.1
Stable tag: 1.0.1
License: GPLv3
Requires PHP: 5.3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Fine-tunes `wp_is_mobile()` function by excluding tablets, such as iPad, from being detected as mobile! Uses MobileDetect PHP Library from mobiledetect.net!

== Description ==

Mobile detect plugin uses the open source [MobileDetect PHP library](http://mobiledetect.net/) to fine-tune the built-in WordPress function `wp_is_mobile()` in such a way that tablets are excluded from being detected as mobile!

About Mobile Detect PHP Library:

* Mobile Detect is a lightweight PHP class for detecting mobile devices (including tablets). It uses the User-Agent string combined with specific HTTP headers to detect the mobile environment.
* PHP Mobile Detect is an open-source script released under [MIT License](https://github.com/serbanghita/Mobile-Detect/blob/master/LICENSE.txt).
* Mobile Detect PHP Developer: [Șerban Ghiță](http://twitter.com/serbanghita), [Nick Ilyin](https://github.com/nicktacular).
* Original author: [Victor Stanciu](http://twitter.com/victorstanciu).
* Icon (and banner) created by: [Dragoș Gavrilă](https://twitter.com/grafician).

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/mobile-detect` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Sit back and relax!

== Frequently Asked Questions ==

= Where can I change the settings? =

This plugin doesn't come with any settings screen on purpose. Settings screen may be included in the future, depending on the feedback from the users!

= Is this plugin actively maintained? =

Yes, this plugin is actively maintained to make sure that the core [Mobile Detect PHP library](http://mobiledetect.net/) is updated as and when there is an update in it. Otherwise, this plugin is in maintenance-only mode. No new features are planned in the near future.

== Screenshots ==

== Upgrade Notice ==
none

== Changelog ==

Changelog for upstream Mobile Detect library can be found at [https://github.com/serbanghita/Mobile-Detect/releases](https://github.com/serbanghita/Mobile-Detect/releases).

= 1.0.1 =
+ Update core upstream Mobile Detect library from version 2.8.27 to 2.8.33

= 1.0.0 =
* First commit
