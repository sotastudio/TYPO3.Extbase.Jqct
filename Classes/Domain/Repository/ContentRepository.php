<?php
/**
 * 
 */
class Tx_Jqct_Domain_Repository_ContentRepository extends Tx_Extbase_Persistence_Repository
{

	protected $defaultOrderings = array('date' => Tx_Extbase_Persistence_QueryInterface::ORDER_DESCENDING);

	public function initializeObject()
	{
    $querySettings = $this->objectManager->create('Tx_Extbase_Persistence_Typo3QuerySettings');
    $querySettings->setRespectStoragePage(FALSE);
    $this->setDefaultQuerySettings($querySettings);
		/*
		//t3lib_utility_Debug::debug($this->findAll());
		$test = $this->createQuery();
		//echo $test->countAll();
		*/
	}
	
	public function findByUid ($uid) {
		$GLOBALS['TYPO3_DB']->debugOutput = TRUE;
		$query = $this->createQuery();
		$query->matching(
			$query->equals('uid', $uid)
		);
		//$query->execute();
		echo '---' . $GLOBALS['TYPO3_DB']->debug_lastBuiltQuery . '---';
		//t3lib_div::devLog('--- SQL-Query: '.$GLOBALS['TYPO3_DB']->debug_lastBuiltQuery.' ---', 'jqct');
		//Hier mal ins devlog schreiben
	}
	
}
