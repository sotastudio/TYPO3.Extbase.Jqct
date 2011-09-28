<?php

########################################################################
# Extension Manager/Repository config file for ext "jqct".
#
# Auto generated 19-09-2011 09:09
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'jQuery Content Tools',
	'description' => 'jQuery Content Tools (e.g. Tabs and Accordion) based on jQuery UI.',
	'category' => 'fe',
	'author' => 'Andy Hausmann',
	'author_email' => 'andy.hausmann@gmx.de',
	'author_company' => '',
	'dependencies' => 'extbase,fluid',
	'clearcacheonload' => 1,
	'state' => 'alpha',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'typo3' => '4.4-4.6',
			'extbase' => '1.0.0-0.0.0',
			'fluid' => '1.0.0-0.0.0',
		),
		'suggests' => array(
			't3jquery' => '',
		),
		'conflicts' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:14:{s:12:"ext_icon.gif";s:4:"5f00";s:17:"ext_localconf.php";s:4:"b0b1";s:14:"ext_tables.php";s:4:"c75e";s:45:"Classes/Controller/ContentToolsController.php";s:4:"eb9c";s:36:"Configuration/FlexForms/flexform.xml";s:4:"6db0";s:38:"Configuration/Typoscript/constants.txt";s:4:"20a1";s:34:"Configuration/Typoscript/setup.txt";s:4:"832f";s:14:"doc/manual.sxw";s:4:"8d2d";s:40:"Resources/Private/Language/locallang.xml";s:4:"4836";s:43:"Resources/Private/Language/locallang_be.xml";s:4:"6d80";s:53:"Resources/Private/Language/locallang_csh_flexform.xml";s:4:"ec17";s:44:"Resources/Private/Php/class.jqct_wizicon.php";s:4:"517e";s:51:"Resources/Private/Templates/ContentTools/index.html";s:4:"e95e";s:37:"Resources/Public/Icons/pi1_ce_wiz.gif";s:4:"1d81";}',
);

?>