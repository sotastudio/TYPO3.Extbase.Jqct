<?php
if (!class_exists('Tx_Extbase_Utility_ClassLoader')) {
  require(t3lib_extmgm::extPath('extbase') . 'Classes/Utility/ClassLoader.php');
}

$classLoader = new Tx_Extbase_Utility_ClassLoader();
spl_autoload_register(array($classLoader, 'loadClass'));
require_once(t3lib_extmgm::extPath('extbase') . 'Tests/BaseTestCase.php');


class Tx_Jqct_Controller_ContentToolsTest extends Tx_Extbase_BaseTestCase {
	
	/**
	 * @var Tx_Phpunit_Framework
	 */
	private $testingFramework;
	
	/**
	 * @var Tx_Jqct_Controller_ContentToolsController
	 */
	private $fixture;
	
	
	public function __construct() {
		t3lib_div::makeInstance('Tx_Extbase_Dispatcher');
	}
	
	
	public function setUp() {
		$this->testingFramework = new Tx_Phpunit_Framework('tx_jqct');
		$this->fixture = new Tx_Jqct_Controller_ContentToolsController();
	}
	
	
	public function tearDown() {
		$this->testingFramework->cleanUp();
		unset($this->fixture, $this->testingFramework);
	}
	
	
	/**
	 * @test
	 */
	public function anInstanceCanBeCreated() {
    return $this->assertEquals('Tx_Jqct_Controller_ContentToolsController', get_class($this->fixture));
	}
	
	
	/**
	 * @test
	 */
	public function anIndexActionIsAvailable() {
		return $this->assertTrue(method_exists($this->fixture,'indexAction'));
	}

	
	/**
	 * @test
	 */
	public function settingsAreAccessible() {
		return $this->assertTrue(is_array($this->fixture->getSettings));
	}
	
	
}
