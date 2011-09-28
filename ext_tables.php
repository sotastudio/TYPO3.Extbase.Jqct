<?php
if (!defined ('TYPO3_MODE')) die ('Access denied.');

/**
 * @todo Add CSH - Context Sensitive Help
 */

	// Build extension name vars - used for plugin registration, flexforms and similar
$extensionName = t3lib_div::underscoredToUpperCamelCase($_EXTKEY);
$pluginSignature = strtolower($extensionName) . '_pi1';

	// Adding CSH for Backend Flexforms
t3lib_extMgm::addLLrefForTCAdescr(
	'tt_content.pi_flexform.' . $pluginSignature . '.list', 
	'EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_csh_flexform.xml'
);

 
	// Frontend Plugin
Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY, 
	'Pi1', 
	'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xml:pi1_title'
);

	// Clean up the Flexform fields in the backend a bit
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist'][$pluginSignature] = 'layout,select_key,pages,recursive,splash_layout';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';

	// Add curstom Flexform fields
t3lib_extMgm::addPiFlexFormValue($pluginSignature, 'FILE:EXT:' . $_EXTKEY . '/Configuration/FlexForms/flexform.xml');

	// Add Static TypoScript
t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'jQuery Content Tools');


if (TYPO3_MODE === 'BE')	{
		// Add Plugin to CE Wizard
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses'][$pluginSignature . '_wizicon'] =
		t3lib_extMgm::extPath($_EXTKEY) . 'Resources/Private/Php/class.' . $_EXTKEY . '_wizicon.php';

}