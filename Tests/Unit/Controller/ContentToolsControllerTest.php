<?php
require_once(t3lib_extmgm::extPath('jqct') . 'Tests/BaseTestCase.php');

/**
 * Test Case for the Main Controller
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Controller_ContentToolsTest extends Tx_Extbase_BaseTestCase
{

	public function setUp()
	{
		$this->testingFramework = new Tx_Phpunit_Framework('tx_jqct');
		$this->fixture = new Tx_Jqct_Controller_ContentToolsController();
	}

	/**
	 * @test
	 */
	public function anInstanceCanBeCreated()
	{
		return $this->assertEquals('Tx_Jqct_Controller_ContentToolsController', get_class($this->fixture));
	}

	/**
	 * @test
	 */
	public function anIndexActionIsAvailable()
	{
		return $this->assertTrue(method_exists($this->fixture, 'indexAction'));
	}
}
