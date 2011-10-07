<?php
/**
 * Acts as a Repository for Content Elements
 * This Model/Repository is being referenced and used by Content Element Rendering-Classes
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 * @property mixed content
 * @todo Create setter to override Content Element Headers
 * @todo Revise Content Model to provice access to data without violating the Uniform Access Principle (related to Fluid)
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
	
	
	public function initializeObject() {
			// Gets the Configuration Manager - It's a
		$this->configurationManager = t3lib_div::makeInstance('Tx_Extbase_Configuration_ConfigurationManager');
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings', 'jqct', 'pi1');

		$records =& $this->pluginConfiguration['records'];
		if (strlen($records)) {
			$this->setRecords($records)->persistElements();
		} else {
			return NULL;
		}
		
		//t3lib_utility_Debug::debug($this->request);
	}

	
	/**
	 * Preserves the referenced Content Elements defined in the Flexform
	 * 
	 * @todo Build query by an Extbase Query Factory
	 * @return void
	 */
	protected function persistElements() {
		$records = $this->getRecords();
		//$recordList = Tx_Extbase_Utility_Arrays::trimExplode(',', $records);
		
		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'uid,header',
			'tt_content',
			'uid IN (' . $records .') AND deleted = 0 AND hidden = 0 AND sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid,
            'FIND_IN_SET (uid, "' . $records .'")'
		);

		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$this->content[] = array(
				'uid' => $row['uid'],
				'header' => $row['header'],
				'content' => $this->contentObject->RECORDS($this->getConfByUid($row['uid']))
			);
		}
	}
	
	/**
	 * Returns all Content Elements as-is
	 * 
	 * @return array Complete Array of all Content Elements including their Uid
	 */
	final public function getAll() {
		return $this->content;
	}
	
	/**
	 * Returns the Header of a Content Element by its Uid
	 * 
	 * @param string $uid Uid of the Content Element
	 * @return string Header of the Content Element
	 */
	final public function getHeaderByUid($uid) {
		foreach(array_keys($this->content) as $ak) {
			$v =& $this->content[$ak];
			if ($v['uid'] == $uid) return $v['header'];
		}
	}
	
	/**
	 * Returns the Header of a Content Element by its array index
	 * 
	 * @param string $uid Uid of the Content Element
	 * @return string Header of the Content Element
	 */
	final public function getHeaderByIndex($index) {
		return $this->content[$index]['header'];
	}
	
	/**
	 * Returns all Headers of the Content Elements
	 * 
	 * @return array Headers of the Content Elements
	 */
	final public function getHeaders() {
		$o = array();
		foreach(array_keys($this->content) as $ak) {
			$v =& $this->content[$ak];
			$o[] =& $v['header'];
		}
		return $o;
	}
	
	/**
	 * Returns the Content of a Content Element by its Uid
	 * 
	 * @param string $uid Uid of the Content Element
	 * @return string Content of the Content Element
	 */
	final public function getContentByUid($uid) {
		foreach(array_keys($this->content) as $ak) {
			$v =& $this->content[$ak];
			if ($v['uid'] == $uid) return $v['content'];
		}
	}
	
	/**
	 * Returns the Content of a Content Element by its array index
	 * 
	 * @param string $uid Uid of the Content Element
	 * @return string Content of the Content Element
	 */	
	final public function getContentByIndex($index) {
		return $this->content[$index]['content'];
	}
	
	/**
	 * Returns all Contents of the Content Elements
	 * 
	 * @return array Content of the Content Elements
	 */
	final public function getContents() {
		$o = array();
		foreach(array_keys($this->content) as $ak) {
			$v =& $this->content[$ak];
			$o[] =& $v['content'];
		}
		return $o;
	}
	
	/**
	 * Sets the list of Content Elements referenced in the Frontend Plugin
	 * 
	 * @return Tx_Jqct_Domain_Model_Content Reference to this Object for chaining
	 */
	final protected function setRecords($records) {
		$this->records = $records;
		return $this;
	}
	
	/**
	 * Returns the list of Content Elements referenced in the Frontend Plugin
	 * 
	 * @return string Pipe-separated Uid list of referenced Content Elements 
	 */
	final protected function getRecords() {
		return $this->records;
	}
	
	/**
	 * Checks whether there is any Content Element
	 * 
	 * @return boolean Well, this is self-explanatory
	 */
	final public function hasRecords() {
		return (strlen($this->records)) ? TRUE : FALSE;
	}
	
	/**
	 * Returns a Configuration Array for requesting Content Elements
	 * 
	 * @param string Uid(s) of the requested Content Element(s)
	 * @return array Configuration Array
	 */
	final protected function getConfByUid($uid) {
		return array(
			'tables' => 'tt_content',
			'source' => $uid,
			'dontCheckPid' => 1
		);
	}

	/**
	 * Returns object as a formatted string
	 *
	 * @todo Work this thing out... this method is not really needed at all
	 * @return string
	 */
	public function __toString() {
		return 'content as a string';
	}

}
	