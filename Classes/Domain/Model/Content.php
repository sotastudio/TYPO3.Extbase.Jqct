<?php
/**
 * Acts as a Repository for Content Elements
 * This Model/Repository is being referenced and used by Content Element Rendering-Classes
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 * @property mixed content
 * @todo Revise Content Model to provice access to data without violating the Uniform Access Principle (related to Fluid)
 * @todo Move Tab Merging and Header Override into the Content Element Model - currently it seems like the Plugin configuration is a bit buggy in there
 */
class Tx_Jqct_Domain_Model_Content extends Tx_Extbase_DomainObject_AbstractValueObject
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
	 * @var array
	 */
	protected $pluginConfiguration;

	/**
	 * @var string
	 */
	protected $records;
	
	/**
	 * @var array
	 */
	public $content;

	/**
	 * @param Tx_Extbase_Configuration_ConfigurationManager $conf
	 * @return void
	 */
	final public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $conf)
	{
		$this->configurationManager = $conf;
	}

	/**
	 * Kinda constructor
	 * Beeing executed right after __construct and has access to injected Objects
	 *
	 * @return mixed
	 */
	public function initializeObject()
	{
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->pluginConfiguration = $this->configurationManager->getConfiguration('Settings');
		$this->setRecords($this->getSetting('records'));

		if ($this->hasRecords()) {
			$this->persistElements()->processMergingAndOverride();
			return TRUE;
		} else {
			return NULL;
		}
	}

	/**
	 * Preserves the referenced Content Elements defined in the Flexform
	 *
	 * @todo Build query by an Extbase Query Factory
	 * @return Tx_Jqct_Domain_Model_Content Reference to this Object for chaining
	 */
	final protected function persistElements()
	{
		$records = $this->getRecords();

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			'uid,header', // SELECT
			'tt_content', // FROM
		  	'uid IN (' . $records . ') AND deleted = 0 AND hidden = 0 AND sys_language_uid = ' . $GLOBALS['TSFE']->sys_language_uid, //WHERE
		  	'FIND_IN_SET (uid, "' . $records . '")' // ORDER BY
		);

		while ($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$this->content[] = array('uid' => $row['uid'], 'header' => $row['header'], 'content' => $this->contentObject->RECORDS($this->getConfByUid($row['uid'])));
		}
		return $this;
	}

	/**
	 * Processes the given Element Merging and Header Override
	 *
	 * @return void
	 */
	public function processMergingAndOverride()
	{
		list($procElementMerging, $procHeaderOverride) = array($this->getSetting('elementMerging'), $this->getSetting('headerOverride'));

		if ($procElementMerging || $procHeaderOverride) {
			
			list($mergeArr, $overrideArr) = array(
				t3lib_div::trimExplode('|', $procElementMerging, TRUE), 
				t3lib_div::trimExplode("\n", $procHeaderOverride, TRUE)
			);
					
			// Process Merging
			if (count($mergeArr) > 1) {
				list($mergedElements, $mergeLength, $pos) = array(array(), 0, 0);
				
				foreach (array_keys($mergeArr) as $ak) {
					$mergeLength = intval($mergeArr[$ak]);
					
					$element = array_slice($this->content, $pos, $mergeLength); // Get given amount of Contents
					$mergedElements[] = (count($element) > 1) ? $this->getMergedElement($element) : $element[0]; // Persist
					$pos += $mergeLength;
				}
				
				$this->content = $mergedElements;
				unset($mergeArr, $ak, $mergedElements, $mergeLength, $pos, $element);
			}
			
			// Process Header Override
			if (count($overrideArr)) {
				$pos = 0;
				
				foreach (array_keys($overrideArr) as $ak) {
					$header = $overrideArr[$ak];
					$this->content[$pos]['header'] = $header;
					$pos++;
				}
				unset($overrideArr, $ak, $header, $pos);
			}
		}
	}

	/**
	 * Merges an array of given elements
	 * 
	 * @param array $els Array of the elements to merge
	 * @return array Merged elements
	 */
	protected function getMergedElement($els) {
		$mergedEl = array('uid' => '', 'header' => '', 'content' => '');
		foreach (array_keys($els) as $ak) {
			$el = &$els[$ak];
			
			$mergedEl['uid'] .= (reset($els) !== $el) ? ',' . $el['uid'] : $el['uid'];
			$mergedEl['header'] = $el['header'];
			$mergedEl['content'] .= $el['content'];
			
		}
		return $mergedEl;
	}

	/**
	 * Returns all Content Elements as-is
	 *
	 * @return array Complete Array of all Content Elements including their Uid
	 */
	final public function getAll()
	{
		return $this->content;
	}

	/**
	 * Returns the Header of a Content Element by its Uid
	 *
	 * @param string $uid Uid of the Content Element
	 * @return string Header of the Content Element
	 */
	final public function getHeaderByUid($uid)
	{
		$o = NULL;
		foreach (array_keys($this->content) as $ak) {
			$v = &$this->content[$ak];
			if ($v['uid'] == $uid)
				$o = $v['header'];
		}
		return $o;
	}

	/**
	 * Returns the Header of a Content Element by its array index
	 *
	 * @param string $index Uid of the Content Element
	 * @return string Header of the Content Element
	 */
	final public function getHeaderByIndex($index)
	{
		return $this->content[$index]['header'];
	}

	/**
	 * Returns all Headers of the Content Elements
	 *
	 * @return array Headers of the Content Elements
	 */
	final public function getHeaders()
	{
		$o = array();
		foreach (array_keys($this->content) as $ak) {
			$v = &$this->content[$ak];
			$o[] = &$v['header'];
		}
		return $o;
	}

	/**
	 * Returns the Content of a Content Element by its Uid
	 *
	 * @param string $uid Uid of the Content Element
	 * @return string Content of the Content Element
	 */
	final public function getContentByUid($uid)
	{
		$o = NULL;
		foreach (array_keys($this->content) as $ak) {
			$v = &$this->content[$ak];
			if ($v['uid'] == $uid)
				$o = $v['content'];
		}
		return $o;
	}

	/**
	 * Returns the Content of a Content Element by its array index
	 *
	 * @param string $index Uid of the Content Element
	 * @return string Content of the Content Element
	 */
	final public function getContentByIndex($index)
	{
		return $this->content[$index]['content'];
	}

	/**
	 * Returns all Contents of the Content Elements
	 *
	 * @return array Content of the Content Elements
	 */
	final public function getContents()
	{
		$o = array();
		foreach (array_keys($this->content) as $ak) {
			$v = &$this->content[$ak];
			$o[] = &$v['content'];
		}
		return $o;
	}

	/**
	 * Sets the list of Content Elements referenced in the Frontend Plugin
	 *
	 * @param string $records List of records
	 * @return Tx_Jqct_Domain_Model_Content Reference to this Object for chaining
	 */
	final protected function setRecords($records)
	{
		$this->records = $records;
		return $this;
	}

	/**
	 * Returns the list of Content Elements referenced in the Frontend Plugin
	 *
	 * @return string Pipe-separated Uid list of referenced Content Elements
	 */
	final protected function getRecords()
	{
		return $this->records;
	}

	/**
	 * Checks whether there is any Content Element
	 *
	 * @return boolean Well, this is self-explanatory
	 */
	final public function hasRecords()
	{
		return (strlen($this->records)) ? TRUE : FALSE;
	}

	/**
	 * Returns a Configuration Array for requesting Content Elements
	 *
	 * @param string $uid of the requested Content Element(s)
	 * @return array Configuration Array
	 */
	final protected function getConfByUid($uid)
	{
		return array('tables' => 'tt_content', 'source' => $uid, 'dontCheckPid' => 1,);
	}

	/**
	 * Return the desired Plugin configuration directive based on the given key
	 *
	 * @param string $key Key of the desired Plugin configuration directive
	 * @return mixed
	 */
	final protected function getSetting($key)
	{
		$val =& $this->pluginConfiguration[$key];
		return (!empty($val)) ? $val : NULL;
	}

}
