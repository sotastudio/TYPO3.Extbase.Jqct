<?php
/**
 * 
 */
class Tx_Jqct_Utility_Div {
	
	/**
	 * Helper function to debug - for those whom too lazy to write to much code, as i am.
	 *
	 * @param	 mixed  $v: Var to debug.
	 * @return	void
	 */
	public function debug($v) {
		t3lib_utility_Debug::debug($v);
	}

	public function getClassName($obj) {
		return get_class($obj);
	}
	
	public function getClassMethods($obj) {
		return get_class_methods($obj);
	}
	
	static function getClassVars($obj) {
		return get_object_vars($obj);
	}

}
