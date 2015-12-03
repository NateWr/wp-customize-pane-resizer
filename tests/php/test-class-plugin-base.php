<?php
/**
 * Tests for Plugin_Base.
 *
 * @package CustomizePaneResizer
 */

namespace CustomizePaneResizer;

/**
 * Tests for Plugin_Base.
 *
 * @package CustomizePaneResizer
 */
class Test_Plugin_Base extends \WP_UnitTestCase {

	/**
	 * Plugin instance.
	 *
	 * @var Plugin
	 */
	public $plugin;

	/**
	 * Setup.
	 *
	 * @inheritdoc
	 */
	public function setUp() {
		parent::setUp();
		$this->plugin = get_plugin_instance();
	}

	/**
	 * Test locate_plugin.
	 *
	 * @see Plugin_Base::locate_plugin()
	 */
	public function test_locate_plugin() {
		$location = $this->plugin->locate_plugin();
		$this->assertEquals( 'customize-pane-resizer', $location['dir_basename'] );
		$this->assertContains( 'plugins/customize-pane-resizer', $location['dir_path'] );
		$this->assertContains( 'plugins/customize-pane-resizer', $location['dir_url'] );
	}

	/**
	 * Tests for trigger_warning().
	 *
	 * @see Plugin_Base::trigger_warning()
	 */
	public function test_trigger_warning() {
		$obj = $this;
		set_error_handler( function ( $errno, $errstr ) use ( $obj ) {
			$obj->assertEquals( 'CustomizePaneResizer\Plugin: Param is 0!', $errstr );
			$obj->assertEquals( \E_USER_WARNING, $errno );
		} );
		$this->plugin->trigger_warning( 'Param is 0!', \E_USER_WARNING );
		restore_error_handler();
	}

	/**
	 * Test is_wpcom_vip_prod().
	 *
	 * @see Plugin_Base::is_wpcom_vip_prod()
	 */
	public function test_is_wpcom_vip_prod() {
		$this->assertFalse( $this->plugin->is_wpcom_vip_prod() );
	}

	/**
	 * Test is_wpcom_vip_prod_true().
	 *
	 * @see Plugin_Base::is_wpcom_vip_prod()
	 */
	public function test_is_wpcom_vip_prod_true() {
		define( 'WPCOM_IS_VIP_ENV', true );
		$this->assertTrue( $this->plugin->is_wpcom_vip_prod() );
	}
}
