<?php
/**
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Hook_ItemsProcFunc {

	/**
	 * Modifies the selectbox of available actions
	 *
	 * @param array &$config
	 * @param t3lib_TCEforms $parentObject
	 * @return void
	 */
	public function user_switchableControllerActions(array &$config, t3lib_TCEforms $parentObject) {
			// remove the detail action from the listAction
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['jqct']['switchableControllerActions']['listActionOnly'])) {
			$config['items'][0][1] = 'Show;';
		}

			// add additional actions
		if (isset($GLOBALS['TYPO3_CONF_VARS']['EXT']['jqct']['switchableControllerActions']['newItems'])
				&& is_array($GLOBALS['TYPO3_CONF_VARS']['EXT']['jqct']['switchableControllerActions']['newItems'])) {
			foreach ($GLOBALS['TYPO3_CONF_VARS']['EXT']['jqct']['switchableControllerActions']['newItems'] as $key => $label) {
				array_push($config['items'], array($GLOBALS['LANG']->sL($label), $key, ''));
			}
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jqct/Classes/Hook/ItemsProcFunc.php']) {
	require_once ($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jqct/Classes/Hook/ItemsProcFunc.php']);
}