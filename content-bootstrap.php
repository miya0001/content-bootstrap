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
    add_filter('the_content', array(&$this, 'the_content'));
    add_shortcode('icon', array(&$this, 'icon_shortcode'));
}

public function icon_shortcode($p)
{
    return sprintf(
        '<i class="%s"></i>',
        esc_attr($p['class'])
    );
}

public function the_content($content)
{
    return '<div id="content-bootstrap-area">'.$content.'</div>';
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
            'wrapper' => true,
        ),
        array(
            'title' => 'Success',
            'block' => 'div',
            'classes' => 'alert alert-success',
            'wrapper' => true,
        ),
        array(
            'title' => 'Info',
            'block' => 'div',
            'classes' => 'alert alert-info',
            'wrapper' => true,
        ),
        array(
            'title' => 'Error',
            'block' => 'div',
            'classes' => 'alert alert-error',
            'wrapper' => true,
        ),
        array(
            'title' => 'Well',
            'block' => 'div',
            'classes' => 'well well-large',
            'wrapper' => true,
        ),
        array(
            'title' => 'Fluid Grid',
            'block' => 'div',
            'classes' => 'row-fluid',
            'wrapper' => true,
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

