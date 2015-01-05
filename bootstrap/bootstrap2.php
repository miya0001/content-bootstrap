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
}
