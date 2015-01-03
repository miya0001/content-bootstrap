<?php
/*
Plugin Name: Content Bootstrap
Author: Takayuki Miyauchi
Plugin URI: https://github.com/miya0001/content-bootstrap
Description: Apply twitter bootstrap css under the content area only.
Author: Takayuki Miyauchi
Version: 0.9.0
Author URI: https://github.com/miya0001/
Domain Path: /languages
Text Domain: content-bootstrap
*/

$content_bootstrap = new Content_Bootstrap();
$content_bootstrap->register();

register_activation_hook( __FILE__, array( $content_bootstrap, 'activation' ) );

class Content_Bootstrap
{
	private $ver;

	public function register()
	{
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function activation()
	{
		if ( ! get_option( 'content_bootstrap_version' ) ) {
			update_option( 'content_bootstrap_version', 'bootstrap3' );
		}
	}

	public function init()
	{
		$plugin_info = get_file_data( __FILE__, array(
			'version' => 'Version',
			'text_domain' => 'Text Domain',
			'domain_path' => 'Domain Path',
		) );

		$this->ver = $plugin_info['version'];

		if ( ! get_option( 'content_bootstrap_version' ) ) {
			update_option( 'content_bootstrap_version', 'bootstrap2' );
		}

		require_once( dirname( __FILE__ ) . '/includes/bootstrap.php' );

		$bootstrap_version = self::get_bootstrap_version();

		if ( 'bootstrap3' === $bootstrap_version ) {
			require_once( dirname( __FILE__ ) . '/bootstrap/bootstrap3.php' );
			$bootstrap3 = new Bootstrap3( $this->ver, plugins_url( '', __FILE__ ) );
			$bootstrap3->register();
		} elseif ( 'bootstrap2' === $bootstrap_version ) {
			require_once( dirname( __FILE__ ) . '/bootstrap/bootstrap2.php' );
			$bootstrap2 = new Bootstrap2( $this->ver, plugins_url( '', __FILE__ ) );
			$bootstrap2->register();
		}
	}

	public static function get_bootstrap_version()
	{
		$bootstrap_version = get_option( 'content_bootstrap_version', 'bootstrap2' );
		return apply_filters( 'content_bootstrap_version', $bootstrap_version );
	}
}
