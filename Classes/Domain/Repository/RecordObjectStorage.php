<?php
/**
 * @todo Finish building uo a correct query to receive the content elements from the database
 */
class Tx_Jqct_Domain_Repository_RecordObjectStorage extends Tx_Extbase_Persistence_ObjectStorage {
	
	/**
	 * @var Tx_Extbase_Configuration_ConfigurationManager 
	 */
	protected $contentObject;
	
	/**
	 * @var Tx_Extbase_Persistence_QueryFactory
	 */
	protected $queryFactory;

	/**
	 * Stores an Array of Content Element Uids
	 *
	 * @var array
	 */
	protected $recordList;
	
	
	public function injectQueryFactory(Tx_Extbase_Persistence_QueryFactory $queryFactory) {
		$this->queryFactory = $queryFactory;
	}
	
	
	public function initializeObject() {
		$this->objectType = str_replace(
			array('_Repository_', 'Repository'),
			array('_Model_', ''), 
			$this->getRepositoryClassName()
		);
	}
	
	
	public function init($uidList) {
		$this->recordList = $this->getRecordList($uidList);
		
		$qObj = $this->queryFactory->create('Tx_Jqct_Domain_Repository_RecordObjectStorage');
		$erg = $qObj->withUid($uidList)->execute();
		t3lib_utility_Debug ::debug($erg);
		/*
		$test = $this->createQuery();
		$erg = $test->withUid($uid);
		*/
	}
	
	/**
	 * @param string $uidList
	 * @return array Records Array
	 */
	protected function getRecordList($uidList) {
		return Tx_Extbase_Utility_Arrays::trimExplode(',', $uidList, TRUE);
	}

	public function createQuery() {
		$query = $this->queryFactory->create($this->objectType);
		/*
		if ($this->defaultOrderings !== array()) {
			$query->setOrderings($this->defaultOrderings);
		}
		if ($this->defaultQuerySettings !== NULL) {
			$query->setQuerySettings(clone $this->defaultQuerySettings);
		}
		*/
		return $query;
	}
	
	protected function getRepositoryClassName() {
		return get_class($this);
	}
	
	/*
	protected function findRecords($uidList) {
		
	}
	
	protected function setRecords($obj) {
		
	}
	
	public function getHeader($uid = NULL) {
		
	}
	
	public function getContent($uid = NULL) {
		
	}
	*/
	
}
