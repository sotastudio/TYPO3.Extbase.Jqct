<?php
/**
 * Class that adds the wizard icon.
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class jqct_pi1_wizicon
{

	protected $extKey = '';
	protected $plugin = '';
	protected $pluginSignature = '';


	public function __construct()
	{
		$this->extKey = 'jqct';
		$this->plugin = 'pi1';
		$this->pluginSignature = strtolower($this->extKey . '_' . $this->plugin);
	}


	/**
	 * Processing the wizard items array
	 *
	 * @param	array	$wizardItems: The wizard items
	 * @return	Modified array with wizard items
	 */
	public function proc($wizardItems)
	{
		$locallang = $this->includeLocalLang();

		$wizardItems['plugins_tx_' . $this->extKey] = array(
			'icon' => t3lib_extMgm::extRelPath($this->extKey) . 'Resources/Public/Icons/' . $this->plugin . '_ce_wiz.gif',
			'title' => $GLOBALS['LANG']->getLLL($this->plugin . '_title', $locallang),
			'description' => $GLOBALS['LANG']->getLLL($this->plugin . '_plus_wiz_description', $locallang),
			'params' => '&defVals[tt_content][CType]=list&defVals[tt_content][list_type]=' . $this->pluginSignature
		);

		return $wizardItems;
	}


	/**
	 * Reads the Backend Localization file.
	 *
	 * @return array The array with language labels
	 */
	protected function includeLocalLang()
	{
		$llFile = t3lib_extMgm::extPath($this->extKey) . 'Resources/Private/Language/locallang_be.xml';

		$l10n = t3lib_div::makeInstance('language');
		$l10n->init($GLOBALS['LANG']->lang);
		$l10nArr = $l10n->includeLLFile($llFile, false);

		// Removed following lines, because this will only work with TYPO3 4.6+
		//$l10nParser = t3lib_div::makeInstance('t3lib_l10n_parser_Llxml');
		//return $l10nParser->getParsedData($llFile, $GLOBALS['LANG']->lang);

		return $l10nArr;
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jqct/Resources/Private/Php/class.jqct_wizicon.php']) {
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jqct/Resources/Private/Php/class.jqct_wizicon.php']);
}
?>