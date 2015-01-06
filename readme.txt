=== Content Bootstrap ===
Contributors: miyauchi
Tags: widget
Requires at least: 3.8
Tested up to: 4.1
Stable tag: 1.0.0

Apply twitter bootstrap css under the content area only.

== Description ==

Apply twitter bootstrap css under the content area only.

[This plugin maintained on GitHub.](https://github.com/miya0001/content-bootstrap)

= Some features =

* Apply twitter bootstrap css to the content.
* Add style button to Visula Editor.
* Allow you to use bootstrap css with almost all themes.
* You can select bootstrap2 ore bootstrap 3.

= How to use Bootstrap3 =

`
define( 'content_bootstrap_enable_version_3', true );
`

or

`
add_filter( 'content_bootstrap_enable_version_3', '__return_true' );
`

= Translators =

* Japanese(ja) - [Takayuki Miyauchi](http://firegoby.jp/)

= Contributors =

* [Takayuki Miyauchi](http://firegoby.jp/)

== Installation ==

* A plug-in installation screen is displayed on the WordPress admin panel.
* It installs it in `wp-content/plugins`.
* The plug-in is made effective.

== Screenshots ==

1. Styles selector on the visual editor
2. Alerts
3. Well Box
4. Fluid grid system
5. Labels and Badges

== Changelog ==

= 0.8.0 =

* Fix couldn't attach editor-style.css.

= 0.5.0 =
* wp-more and wp-nextpage class args renamed.

= 0.4.0 =
* Twitter Bootstrap updated to 2.3.2

= 0.3.0 =
* Icons added.
* responsive design supported

= 0.1.0 =
* The first release.
