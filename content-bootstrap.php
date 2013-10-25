<?php
/*
Plugin Name: Content Bootstrap
Author: Takayuki Miyauchi
Plugin URI: http://wpist.me/
Description: Apply twitter bootstrap css under the content area only.
Author: Takayuki Miyauchi
Version: 0.6.0
Author URI: http://wpist.me/
Domain Path: /languages
Text Domain: content-bootstrap
*/

new ContentBootstrap();

class ContentBootstrap {

const bootstrap_version = '2.3.2-3';

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

    add_shortcode('label', array(&$this, 'shortcode_label'));
    add_shortcode('badge', array(&$this, 'shortcode_badge'));
    add_shortcode('icon', array(&$this, 'shortcode_icon'));
}

public function shortcode_icon($p)
{
    $class = array();

    if (isset($p[0]) && ($icon = preg_replace('/^icon-/', '', $p[0]))) {
        $class[] = esc_attr('icon-'.$icon);
    }

    if (isset($p[1]) && ('white' === preg_replace('/^icon-/', '', $p[1]))) {
        $class[] = 'icon-white';
    }

    return sprintf(
        '<i class="%s"></i>',
        join(' ', $class)
    );
}

public function shortcode_label($p, $content)
{
    $class = array('label');
    if (isset($p['name']) && preg_match('/^[a-z]+$/', $p['name'])) {
        $class[] = 'label-'.esc_attr($p['name']);
    }

    return sprintf(
        '<span class="%s">%s</span>',
        join(' ', $class),
        do_shortcode($content)
    );
}

public function shortcode_badge($p, $content)
{
    $class = array('badge');
    if (isset($p['name']) && preg_match('/^[a-z]+$/', $p['name'])) {
        $class[] = 'badge-'.esc_attr($p['name']);
    }

    return sprintf(
        '<span class="%s">%s</span>',
        join(' ', $class),
        do_shortcode($content)
    );
}

public function the_content($content)
{
    return '<div class="content-bootstrap-area">'.$content.'</div>';
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
            'title' => 'Well Small',
            'block' => 'div',
            'classes' => 'well well-small',
            'wrapper' => true,
        ),
        array(
            'title' => 'Fluid Grid',
            'block' => 'div',
            'classes' => 'row-fluid',
            'wrapper' => true,
        ),
    );
    $styles = apply_filters('content_bootstrap_styles', $styles);
    $init['style_formats'] = json_encode($styles);
    return $init;
}

public function mce_css($css)
{
    $ver = filemtime(dirname(__FILE__).'/css/editor-style.css');
    $css = plugins_url(
        'css/editor-style.css?ver='.self::bootstrap_version,
        __FILE__
    );
    return ','.$css;
}

public function wp_enqueue_scripts()
{
    wp_enqueue_style(
        'content-bootstrap',
        plugins_url('css/content-bootstrap.css', __FILE__),
        array(),
        self::bootstrap_version
    );
}

}

