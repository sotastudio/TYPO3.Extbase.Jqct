<?php
/**
 * An abstract constraint for simple content elements, like Tabs and Accordion
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
abstract class Tx_Jqct_Domain_Model_SimpleElementConstraint extends Tx_Extbase_DomainObject_AbstractValueObject {

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
	 * @var Tx_Jqct_Domain_Model_Content
	 */
	public $content;

	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManager $conf
	 * @return void
	 */
	final public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $conf) {
		$this->configurationManager = $conf;
	}

	/**
	 * @param Tx_Jqct_Domain_Model_Content %content
	 * @return void
	 */
	final public function injectContent(Tx_Jqct_Domain_Model_Content $content) {
		$this->content = $content;
	}

	
	/**
	 * Kinda constructor
	 * Beeing executed right after __construct and has access to injected Objects
	 */
	public function initializeObject() {
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings', 'jqct', 'pi1');
		$this->setUid($this->contentObject->data['uid']);
				
		//t3lib_utility_Debug::debug($this->generateUid('prefix', 'suffix'));
				
		//$GLOBALS['TYPO3_DB']->debugOutput = TRUE;
		//t3lib_utility_Debug::debug($this->content->countAll());
		//echo '---' . $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery . '---';
		//print_r($res);
	}

	/**
	 * Builds an unique id or unique label based on a given pre- and suffix
	 * 
	 * @param  string  $prefix: Prefix for building a label (e.g. for html elements)
	 * @param  string  $suffix: Suffix for building a label (e.g. for html elements)
	 * @return  mixed  The unique id (integer) or label (string) based on params
	 */
	function generateUid($prefix = '', $suffix = '', $divider = '-')
	{
		$uid = (( !empty($prefix) ) ? $prefix . $divider : '') 
					 . $this->getUid() .
					 (( !empty($suffix) ) ? $divider . $suffix : '');
		return $uid;
	}


	final protected function setUid($uid) {
		$this->uid = (int)$uid;
	}
	
}