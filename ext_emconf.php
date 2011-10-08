<?php

########################################################################
# Extension Manager/Repository config file for ext "jqct".
#
# Auto generated 08-10-2011 23:03
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
	'_md5_values_when_last_written' => 'a:35:{s:6:"README";s:4:"7b9e";s:12:"ext_icon.gif";s:4:"5f00";s:17:"ext_localconf.php";s:4:"40ee";s:14:"ext_tables.php";s:4:"de2b";s:12:"t3jquery.txt";s:4:"6ede";s:41:"Classes/Controller/AbstractController.php";s:4:"e2da";s:45:"Classes/Controller/ContentToolsController.php";s:4:"0602";s:34:"Classes/Domain/Model/Accordion.php";s:4:"e69b";s:32:"Classes/Domain/Model/Content.php";s:4:"3393";s:48:"Classes/Domain/Model/SimpleElementConstraint.php";s:4:"f031";s:29:"Classes/Domain/Model/Tabs.php";s:4:"56a6";s:30:"Classes/Hook/ItemsProcFunc.php";s:4:"9e43";s:23:"Classes/Utility/Div.php";s:4:"87cf";s:32:"Classes/Utility/PageRenderer.php";s:4:"419d";s:36:"Configuration/FlexForms/flexform.xml";s:4:"5e7d";s:38:"Configuration/TypoScript/constants.txt";s:4:"20a1";s:34:"Configuration/TypoScript/setup.txt";s:4:"da81";s:14:"doc/manual.sxw";s:4:"8d2d";s:40:"Resources/Private/Language/locallang.xml";s:4:"3e89";s:43:"Resources/Private/Language/locallang_be.xml";s:4:"6d80";s:53:"Resources/Private/Language/locallang_csh_flexform.xml";s:4:"ec17";s:44:"Resources/Private/Php/class.jqct_wizicon.php";s:4:"7afd";s:55:"Resources/Private/Templates/ContentTools/accordion.html";s:4:"ad0c";s:51:"Resources/Private/Templates/ContentTools/debug.html";s:4:"ebe5";s:51:"Resources/Private/Templates/ContentTools/index.html";s:4:"0eec";s:50:"Resources/Private/Templates/ContentTools/tabs.html";s:4:"792b";s:37:"Resources/Public/Icons/pi1_ce_wiz.gif";s:4:"1d81";s:44:"Resources/Public/Scripts/jquery-1.6.4.min.js";s:4:"6986";s:55:"Resources/Public/Scripts/jquery-ui-1.8.16.custom.min.js";s:4:"7cf2";s:34:"Resources/Public/Styles/common.css";s:4:"90b2";s:22:"Tests/BaseTestCase.php";s:4:"768a";s:52:"Tests/Unit/Controller/ContentToolsControllerTest.php";s:4:"fa88";s:41:"Tests/Unit/Domain/Model/AccordionTest.php";s:4:"ea57";s:39:"Tests/Unit/Domain/Model/ContentTest.php";s:4:"dacd";s:36:"Tests/Unit/Domain/Model/TabsTest.php";s:4:"db3b";}',
	'suggests' => array(
	),
	'conflicts' => '',
);

?>