<?php
/**
 * 
 */
class Tx_Jqct_Domain_Model_Content extends Tx_Extbase_DomainObject_AbstractValueObject {
	
	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManager
	 */
	protected $configurationManager;
	
	/**
	 * @var tslib_cObj
	 */
	protected $contentObject;
	
	/**
	 * @var array
	 */
	protected $pluginConfiguration;
	
	/**
	 * @var string
	 */
	protected $records;
	

	public function __construct() {
		$this->configurationManager = t3lib_div::makeInstance('Tx_Extbase_Configuration_ConfigurationManager');
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings', 'jqct', 'pi1');
		
		$records = $this->pluginConfiguration['records'];
		if (strlen($records)) {
			$this->setRecords($this->pluginConfiguration['records'])->persistElements();
		} else {
			return NULL;
		}
		
		//t3lib_utility_Debug::debug(get_class_methods(get_class($this->contentObject)));
	}

	
	final protected function persistElements() {
		$records = $this->getRecords();
		$recordList = Tx_Extbase_Utility_Arrays::trimExplode(',', $records);
		echo get_class($this->contentObject);
		
    $res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
    	'uid,header',
    	'tt_content',
    	'uid IN (' . $records .') AND deleted = 0 AND hidden = 0 AND sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid
		);
		
		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$this->content[] = array(
				'uid' => $row['uid'],
				'header' => $row['header'],
				'content' => $this->contentObject->RECORDS($this->getConfByUid($row['uid']))
			);
		}
	}
	
	final protected function setRecords($records) {
		$this->records = $records;
		return $this;
	}
	
	final protected function getRecords() {
		return $this->records;
	}
	
	public function hasRecords() {
		
	}
	
	final protected function getConfByUid($uid) {
		return array(
			'tables' => 'tt_content',
			'source' => $uid,
			'dontCheckPid' => 1
		);
	}

	/**
	 * Returns this post as a formatted string
	 *
	 * @return string
	 */
	public function __toString() {
		return 'content als string';
	}

}
	