<?php

########################################################################
# Extension Manager/Repository config file for ext "jqct".
#
# Auto generated 29-10-2011 12:23
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
	'state' => 'stable',
	'version' => '1.0.1',
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
	'_md5_values_when_last_written' => 'a:35:{s:6:"README";s:4:"7b9e";s:12:"ext_icon.gif";s:4:"5f00";s:17:"ext_localconf.php";s:4:"3c30";s:14:"ext_tables.php";s:4:"d05c";s:12:"t3jquery.txt";s:4:"6ede";s:41:"Classes/Controller/AbstractController.php";s:4:"58c9";s:45:"Classes/Controller/ContentToolsController.php";s:4:"4a1c";s:34:"Classes/Domain/Model/Accordion.php";s:4:"e69b";s:32:"Classes/Domain/Model/Content.php";s:4:"e840";s:48:"Classes/Domain/Model/SimpleElementConstraint.php";s:4:"7659";s:29:"Classes/Domain/Model/Tabs.php";s:4:"56a6";s:30:"Classes/Hook/ItemsProcFunc.php";s:4:"ad06";s:23:"Classes/Utility/Div.php";s:4:"a426";s:32:"Classes/Utility/PageRenderer.php";s:4:"6abf";s:36:"Configuration/FlexForms/flexform.xml";s:4:"d791";s:38:"Configuration/TypoScript/constants.txt";s:4:"20a1";s:34:"Configuration/TypoScript/setup.txt";s:4:"da81";s:14:"doc/manual.sxw";s:4:"8d2d";s:40:"Resources/Private/Language/locallang.xml";s:4:"3e89";s:43:"Resources/Private/Language/locallang_be.xml";s:4:"ba57";s:53:"Resources/Private/Language/locallang_csh_flexform.xml";s:4:"ec17";s:44:"Resources/Private/Php/class.jqct_wizicon.php";s:4:"2625";s:55:"Resources/Private/Templates/ContentTools/accordion.html";s:4:"3df7";s:51:"Resources/Private/Templates/ContentTools/debug.html";s:4:"99ad";s:51:"Resources/Private/Templates/ContentTools/index.html";s:4:"0eec";s:50:"Resources/Private/Templates/ContentTools/tabs.html";s:4:"6418";s:37:"Resources/Public/Icons/pi1_ce_wiz.gif";s:4:"1d81";s:44:"Resources/Public/Scripts/jquery-1.6.4.min.js";s:4:"d6fa";s:55:"Resources/Public/Scripts/jquery-ui-1.8.16.custom.min.js";s:4:"df91";s:34:"Resources/Public/Styles/common.css";s:4:"beb6";s:22:"Tests/BaseTestCase.php";s:4:"865a";s:52:"Tests/Unit/Controller/ContentToolsControllerTest.php";s:4:"2aad";s:41:"Tests/Unit/Domain/Model/AccordionTest.php";s:4:"6b87";s:39:"Tests/Unit/Domain/Model/ContentTest.php";s:4:"79fd";s:36:"Tests/Unit/Domain/Model/TabsTest.php";s:4:"f788";}',
	'suggests' => array(
	),
	'conflicts' => '',
);

?>