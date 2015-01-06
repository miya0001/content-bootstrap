<?php

class Content_Bootstrap_Test extends WP_UnitTestCase {

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function wp_enqueue_scripts_bootstrap2()
	{
		do_action( 'wp' );
		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_style_is( 'content-bootstrap' ) );

		$this->expectOutputRegex( '/bootstrap2/' );
		wp_print_styles();

		$this->assertSame( '<i class="icon-glass"></i>', do_shortcode( '[icon glass]' ) );
	}

	/**
	 * @test
	 * @runInSeparateProcess
	 * @preserveGlobalState disabled
	 */
	public function wp_enqueue_scripts_bootstrap3()
	{
		do_action( 'wp' );
		define( 'CONTENT_BOOTSTRAP_ENABLE_VERSION_3', true );

		do_action( 'wp_enqueue_scripts' );
		$this->assertTrue( wp_style_is( 'content-bootstrap' ) );

		$this->expectOutputRegex( '/bootstrap3/' );
		wp_print_styles();

		$this->assertSame( '<span class="glyphicon glyphicon-glass" aria-hidden="true"></span>', do_shortcode( '[icon glass]' ) );
	}
}
