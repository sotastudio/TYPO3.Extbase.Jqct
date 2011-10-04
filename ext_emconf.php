<?php

########################################################################
# Extension Manager/Repository config file for ext "jqct".
#
# Auto generated 04-10-2011 18:15
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
	'state' => 'beta',
	'version' => '0.9.0',
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
	'_md5_values_when_last_written' => 'a:34:{s:6:"README";s:4:"aa17";s:12:"ext_icon.gif";s:4:"5f00";s:17:"ext_localconf.php";s:4:"b0b1";s:14:"ext_tables.php";s:4:"2e6e";s:12:"t3jquery.txt";s:4:"6ede";s:41:"Classes/Controller/AbstractController.php";s:4:"21e2";s:45:"Classes/Controller/ContentToolsController.php";s:4:"3538";s:34:"Classes/Domain/Model/Accordion.php";s:4:"1c8a";s:32:"Classes/Domain/Model/Content.php";s:4:"a1cf";s:48:"Classes/Domain/Model/SimpleElementConstraint.php";s:4:"29df";s:29:"Classes/Domain/Model/Tabs.php";s:4:"0355";s:30:"Classes/Hook/ItemsProcFunc.php";s:4:"1531";s:23:"Classes/Utility/Div.php";s:4:"2514";s:36:"Configuration/FlexForms/flexform.xml";s:4:"fa8e";s:38:"Configuration/TypoScript/constants.txt";s:4:"20a1";s:34:"Configuration/TypoScript/setup.txt";s:4:"6967";s:14:"doc/manual.sxw";s:4:"8d2d";s:40:"Resources/Private/Language/locallang.xml";s:4:"c530";s:43:"Resources/Private/Language/locallang_be.xml";s:4:"6d80";s:53:"Resources/Private/Language/locallang_csh_flexform.xml";s:4:"ec17";s:44:"Resources/Private/Php/class.jqct_wizicon.php";s:4:"103e";s:55:"Resources/Private/Templates/ContentTools/accordion.html";s:4:"4821";s:51:"Resources/Private/Templates/ContentTools/debug.html";s:4:"9a17";s:51:"Resources/Private/Templates/ContentTools/index.html";s:4:"af8a";s:50:"Resources/Private/Templates/ContentTools/tabs.html";s:4:"c54a";s:37:"Resources/Public/Icons/pi1_ce_wiz.gif";s:4:"1d81";s:44:"Resources/Public/Scripts/jquery-1.6.4.min.js";s:4:"ea75";s:55:"Resources/Public/Scripts/jquery-ui-1.8.16.custom.min.js";s:4:"5ed2";s:34:"Resources/Public/Styles/common.css";s:4:"432a";s:22:"Tests/BaseTestCase.php";s:4:"ca3e";s:52:"Tests/Unit/Controller/ContentToolsControllerTest.php";s:4:"9831";s:41:"Tests/Unit/Domain/Model/AccordionTest.php";s:4:"a66c";s:39:"Tests/Unit/Domain/Model/ContentTest.php";s:4:"485f";s:36:"Tests/Unit/Domain/Model/TabsTest.php";s:4:"f185";}',
	'suggests' => array(
	),
	'conflicts' => '',
);

?>