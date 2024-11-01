=== Simple Page Transition ===
Contributors: Julien Zerbib
Tags: transition, loader, accessibility
Requires at least: 3.5
Tested up to: 3.8.1
Stable tag: 1.4.1
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Add Simple Transition between pages (between unload and load)

== Description ==

Add Simple Transition between pages (between unload and load).

Avoid to see page loading.

Features:

*   New Features : you can now change background opacity and set duration in and out of the transition.
*   You can choose your own loader image, setup the background color and position and the duration of the transition.
*   French and English language support.
*   Multisite compatibility.
*   Accessibility OK (no more white screen when javascript is disabled)

Visit [JuZED.fr](http://www.juzed.fr/en/plugins/simple-page-transition/) for example (just navigate to see transition)

== Installation ==

1. Upload `simple-page-transition.zip` to the `/wp-content/plugins/` directory
2. Unzip archive
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Go to the Settings Page to update settings at least once per upgrade (that creates css files used on front)
5. Be sure to setup the ignored selectors (targeting download links).
6. Empty cache to see modifications on front (at least once per settings modification) 

== Frequently Asked Questions ==
= I just changed my settings and there is no modification on front, is it normal? =
Yes, you have to empty your caches to see any modification of the settings.

== Screenshots ==

1. The Settings Page.
2. Fadeout transition.

== Changelog ==

= 1.4.1 =
* Stable version.
* Admin bug correction.

= 1.4 =
* Previous Stable version.
* More features. 
* Smallest css3 version.

= 1.3 =
* Add a noscript markup
* Modifying the way Custom CSS is stored. 
* Loader markup is now added with "wp_footer" action instead of javascript, so there is no "cut" in transition.

= 1.2 =
* Ingored CSS selectors Added. Avoid Loader to show after click on download links.

= 1.1.2 =
* Hide loader after downloading document.

= 1.1.1 =
* Bug fixes on multisites.

= 1.1 =
* Multisite compatibility.

= 1.0 =
* First version.
