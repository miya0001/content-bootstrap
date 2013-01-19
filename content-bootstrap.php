<?php
/*
Plugin Name: Content Bootstrap
Author: Takayuki Miyauchi
Plugin URI: http://wpist.me/wp/content-bootstrap/
Description: Apply twitter bootstrap css only under .entry-content only.
Author: Takayuki Miyauchi
Version: 0.0.1
Author URI: http://wpist.me/
Domain Path: /languages
Text Domain: content-bootstrap
*/

new ContentBootstrap();

class ContentBootstrap {

function __construct()
{
    add_action('plugins_loaded', array(&$this, 'plugins_loaded'));
}

public function plugins_loaded()
{
    add_action('wp_enqueue_scripts', array(&$this, 'wp_enqueue_scripts'));
    add_filter('mce_css', array(&$this, 'mce_css'));
    add_filter('tiny_mce_before_init', array(&$this, 'tiny_mce_before_init'), 9999);
    add_filter('mce_buttons_2', array(&$this, 'mce_buttons_2'));
}

public function mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

public function tiny_mce_before_init($init)
{
    $styles = array(
        array(
            'title' => 'Label',
            'inline' => 'span',
            'classes' => 'label',
        ),
        array(
            'title' => 'Badge',
            'inline' => 'span',
            'classes' => 'badge',
        ),
        array(
            'title' => 'Alert',
            'block' => 'div',
            'classes' => 'alert alert-block',
        ),
        array(
            'title' => 'Success',
            'block' => 'div',
            'classes' => 'alert alert-success',
        ),
        array(
            'title' => 'Info',
            'block' => 'div',
            'classes' => 'alert alert-info',
        ),
        array(
            'title' => 'Error',
            'block' => 'div',
            'classes' => 'alert alert-error',
        ),
        array(
            'title' => 'Well Large',
            'block' => 'div',
            'classes' => 'well well-large',
        ),
        array(
            'title' => 'Well Small',
            'block' => 'div',
            'classes' => 'well well-small',
        ),
    );
    $init['style_formats'] = json_encode($styles);
    return $init;
}

public function mce_css($css)
{
    $ver = filemtime(dirname(__FILE__).'/css/editor-style.css');
    $css .= ', '.plugins_url('css/editor-style.css?ver='.$ver, __FILE__);
    return $css;
}

public function wp_enqueue_scripts()
{
    wp_enqueue_style(
        'content-bootstrap',
        plugins_url('css/content-bootstrap.css', __FILE__),
        array(),
        filemtime(dirname(__FILE__).'/css/content-bootstrap.css')
    );
}

}

