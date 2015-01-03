<?php

class Bootstrap2 extends Bootstrap
{
	public function tiny_mce_before_init( $init )
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
		);

		$styles = apply_filters( 'content_bootstrap_styles', $styles );
		$init['style_formats'] = json_encode( $styles );
		return $init;
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
}
