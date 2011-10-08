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
     * @param    array    $wizardItems: The wizard items
     * @return    Modified array with wizard items
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
     * Reads the [extDir]/locallang.xml and returns the $LOCAL_LANG array found in that file.
     *
     * @return    The array with language labels
     */
    protected function includeLocalLang()
    {
        $llFile = t3lib_extMgm::extPath($this->extKey) . 'Resources/Private/Language/locallang_be.xml';

        return t3lib_div::readLLXMLfile($llFile, $GLOBALS['LANG']->lang);
    }

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/news/Resources/Private/Php/class.jqct_wizicon.php']) {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/jqct/Resources/Private/Php/class.jqct_wizicon.php']);
}
?>