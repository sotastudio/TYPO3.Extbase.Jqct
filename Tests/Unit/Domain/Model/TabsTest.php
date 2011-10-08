<?php
require_once(t3lib_extmgm::extPath('jqct') . 'Tests/BaseTestCase.php');

/**
 * Test Case for the Tabs Model
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Tests_Unit_Domain_Model_TabsTest extends Tx_Jqct_BaseTestCase
{

    public function setUp()
    {
        $this->testingFramework = new Tx_Phpunit_Framework('tx_jqct');
        $this->fixture = new Tx_Jqct_Domain_Model_Tabs();
    }

    /**
     * @test
     */
    public function anInstanceCanBeCreated()
    {
        return $this->assertEquals('Tx_Jqct_Domain_Model_Tabs', get_class($this->fixture));
    }

}