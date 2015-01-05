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
}
