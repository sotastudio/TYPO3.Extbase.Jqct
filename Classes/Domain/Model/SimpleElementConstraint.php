<?php
/**
 * An abstract constraint for simple content elements, like Tabs and Accordion
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
abstract class Tx_Jqct_Domain_Model_SimpleElementConstraint extends Tx_Extbase_DomainObject_AbstractValueObject
{

	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManager
	 */
	protected $configurationManager;

	/**
	 * @var tslib_cObj
	 */
	protected $contentObject;

	/**
	 * Stores the plugin configuration from Flexform
	 *
	 * @var array
	 */
	protected $pluginConfiguration;

	/**
	 * Content
	 *
	 * @var Tx_Jqct_Domain_Model_Resource_Content
	 */
	public $content;

	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManager $conf
	 * @return void
	 */
	public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $conf)
	{
		$this->configurationManager = $conf;
	}

	/**
	 * @param Tx_Jqct_Domain_Model_Content $content
	 * @return void
	 */
	public function injectContent(Tx_Jqct_Domain_Model_Resource_Content $content)
	{
		$this->content = $content;
	}

	/**
	 * Kinda constructor
	 * Beeing executed right after __construct and has access to injected Objects
	 *
	 * @return void
	 */
	public function initializeObject()
	{
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings');

		//t3lib_utility_Debug::debug($this->pluginConfiguration);

		//t3lib_utility_Debug::debug($this->generateUid('prefix', 'suffix'));
		//$GLOBALS['TYPO3_DB']->debugOutput = TRUE;
		//echo '---' . $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery . '---';
	}

	/**
	 * Returns the Configuration directive based on the given key
	 *
	 * @param string $key Key of the corresponding Configuration directive
	 * @return mixed
	 */
	protected function getSetting($key)
	{
		$val = $this->pluginConfiguration[$key];
		return (!empty($val)) ? $val : NULL;
	}

}