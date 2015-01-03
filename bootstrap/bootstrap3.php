<?php

class Bootstrap3 extends Bootstrap
{
	public function tiny_mce_before_init( $init )
	{
		$styles = array(
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
				'title' => 'Warning',
				'block' => 'div',
				'classes' => 'alert alert-warning',
				'wrapper' => true,
			),
			array(
				'title' => 'Danger',
				'block' => 'div',
				'classes' => 'alert alert-danger',
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
			$class[] = esc_attr( 'glyphicon-'.$icon );
		}

		if ( isset( $p[1] ) && ('white' === preg_replace( '/^icon-/', '', $p[1] ) ) ) {
			$class[] = 'icon-white';
		}

		return sprintf(
			'<span class="glyphicon %s" aria-hidden="true"></span>',
			join( ' ', $class )
		);
	}

	public function shortcode_label( $p, $content )
	{
		$labels = array(
			'default',
			'primary',
			'success',
			'info',
			'warning',
			'danger',
		);

		$class = array( 'label' );
		if ( isset( $p['name'] ) && in_array( $p['name'], $labels ) ) {
			$class[] = 'label-' . $p['name'];
		} else {
			$class[] = 'label-default';
		}

		return sprintf(
			'<span class="%s">%s</span>',
			join( ' ', $class ),
			do_shortcode( $content )
		);
	}

	public function shortcode_badge( $p, $content )
	{
		return sprintf(
			'<span class="badge">%s</span>',
			do_shortcode( $content )
		);
	}
}
