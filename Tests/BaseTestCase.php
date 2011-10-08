<?php
/**
 * Makes the Autoloader available
 */
if (!class_exists('Tx_Extbase_Utility_ClassLoader')) {
    require(t3lib_extmgm::extPath('extbase') . 'Classes/Utility/ClassLoader.php');
}

$classLoader = new Tx_Extbase_Utility_ClassLoader();
spl_autoload_register(array($classLoader, 'loadClass'));
require_once(t3lib_extmgm::extPath('extbase') . 'Tests/BaseTestCase.php');

/**
 * Base Class for the Test Cases
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
abstract class Tx_Jqct_BaseTestCase extends Tx_Extbase_BaseTestCase
{

    /**
     * @var Tx_Phpunit_Framework
     */
    protected $testingFramework;

    /**
     * @var Tx_Jqct_Controller_ContentToolsController
     */
    protected $fixture;


    public function __construct()
    {
        t3lib_div::makeInstance('Tx_Extbase_Dispatcher');
    }

    public function tearDown()
    {
        $this->testingFramework->cleanUp();
        unset($this->fixture, $this->testingFramework);
    }

}