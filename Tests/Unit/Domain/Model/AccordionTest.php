<?php
require_once(t3lib_extmgm::extPath('jqct') . 'Tests/BaseTestCase.php');

/**
 * Test Case for the Accordion Model
 *
 * @author Andy Hausmann <andy@sota-studio.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Tests_Unit_Domain_Model_AccordionTest extends Tx_Jqct_BaseTestCase
{

	public function setUp()
	{
		$this->testingFramework = new Tx_Phpunit_Framework('tx_jqct');
		$this->fixture = new Tx_Jqct_Domain_Model_Accordion();
	}

	/**
	 * @test
	 */
	public function anInstanceCanBeCreated()
	{
		return $this->assertEquals('Tx_Jqct_Domain_Model_Accordion', get_class($this->fixture));
	}

}