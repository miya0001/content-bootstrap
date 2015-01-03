<?php

abstract class Bootstrap
{
	private $plugin_version;
	private $bootstrap_version;
	private $plugins_url;

	function __construct( $plugin_version, $plugins_url )
	{
		$this->plugin_version = $plugin_version;
		$this->plugins_url = untrailingslashit( $plugins_url );
	}

	function register()
	{
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		add_filter( 'admin_head', array( $this, 'admin_head') );
		add_filter( 'tiny_mce_before_init', array( $this, 'tiny_mce_before_init' ), 9999 );
		add_filter( 'mce_buttons_2', array( $this, 'mce_buttons_2' ) );
		add_filter( 'the_content', array( $this, 'the_content' ) );

		add_shortcode( 'label', array( $this, 'shortcode_label' ) );
		add_shortcode( 'badge', array( $this, 'shortcode_badge' ) );
		add_shortcode( 'icon', array( $this, 'shortcode_icon' ) );
	}

	public function shortcode_icon( $p )
	{
		$class = array();

		if ( isset( $p[0] ) && ( $icon = preg_replace( '/^icon-/', '', $p[0] ) ) ) {
			$class[] = esc_attr( 'icon-'.$icon );
		}

		if ( isset( $p[1] ) && ('white' === preg_replace( '/^icon-/', '', $p[1] ) ) ) {
			$class[] = 'icon-white';
		}

		return sprintf(
			'<i class="%s"></i>',
			join( ' ', $class )
	   );
	}

	public function shortcode_label( $p, $content )
	{
		$class = array( 'label' );
		if ( isset( $p['name'] ) && preg_match( '/^[a-z]+$/', $p['name'] ) ) {
			$class[] = 'label-'.esc_attr( $p['name'] );
		}

		return sprintf(
			'<span class="%s">%s</span>',
			join( ' ', $class ),
			do_shortcode( $content )
	   );
	}

	public function shortcode_badge( $p, $content )
	{
		$class = array( 'badge' );
		if ( isset( $p['name'] ) && preg_match( '/^[a-z]+$/', $p['name'] ) ) {
			$class[] = 'badge-'.esc_attr( $p['name'] );
		}

		return sprintf(
			'<span class="%s">%s</span>',
			join( ' ', $class ),
			do_shortcode( $content )
	   );
	}

	public function the_content( $content )
	{
		$wrap = apply_filters( 'content_bootstrap_wrap', true );
		if ( $wrap ) {
			return '<div class="content-bootstrap-area">'.$content.'</div>';
		} else {
			return $content;
		}

	}

	public function mce_buttons_2( $buttons )
	{
		array_unshift( $buttons, 'styleselect' );
		return $buttons;
	}

	abstract public function tiny_mce_before_init( $init );

	public function admin_head()
	{
		$editor_style = $this->get_bootstrap_dir() . '/css/editor-style.css?ver=' . $this->plugin_version;
		add_editor_style( $editor_style );
	}

	public function wp_enqueue_scripts()
	{
		wp_enqueue_style(
			'content-bootstrap',
			$this->get_bootstrap_dir() . '/css/content-bootstrap.css',
			array(),
			$this->plugin_version
	   );
	}

	protected function get_bootstrap_dir()
	{
		$dir = apply_filters(
			'content_bootstrap_dir',
			$this->plugins_url . '/bootstrap/' . Content_Bootstrap::get_bootstrap_version()
		);

		return untrailingslashit( $dir );
	}
}
