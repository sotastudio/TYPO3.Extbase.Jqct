<?php
/**
 * An abstract constraint for simple content elements, like Tabs and Accordion
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
	protected $content;

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
	 * Beeing executed right after __construct has access to injected Objects
	 */
	public function initializeObject() {
		$this->setUid($this->contentObject->data['uid']);
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings', 'jqct', 'pi1');
		
		//t3lib_utility_Debug::debug($this->content);
		
		//$this->recordObjectStorage->init($records);
		
		//$GLOBALS['TYPO3_DB']->debugOutput = TRUE;
		//t3lib_utility_Debug::debug($this->content->countAll());
		//echo '---' . $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery . '---';
		//print_r($res);
	}

	final protected function setUid($uid) {
		$this->uid = (int)$uid;
	}

}