<?php

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012 Andy Hausmann <hi@andy-hausmann.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Helper Class which makes various tools and helper available
 *
 * @author Andy Hausmann <hi@andy-hausmann.de>
 * @package jqct
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 */
class Tx_Jqct_Utility_Div
{

	/**
	 * Returns the reference to a 'resource' in TypoScript.
	 *
	 * @param string $file File get a reference from - can contain EXT:ext_name
	 * @return mixed
	 */
	public function getFileResource($file)
	{
		return $GLOBALS['TSFE']->tmpl->getFileName($file);
	}

	/**
	 * Checks a passed CSS or JS file and renders it with the Page Content
	 *
	 * @deprecated
	 * @param  string  $file: Given filename incl. path
	 * @param  bool  $moveJSToFooter
	 * @return  void
	 */
	public function includeCssJsFile($file, $moveJsToFooter)
	{

		$mediaTypeSplit = strrchr($file, '.');
		$resolved = $this->getFileResource($file);

		if ($resolved) {
			($mediaTypeSplit == '.js')
					? (($moveJsToFooter)
					? $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($resolved)
					: $GLOBALS['TSFE']->getPageRenderer()->addJsFile($resolved))
					: $GLOBALS['TSFE']->getPageRenderer()->addCssFile($resolved);
		}
	}

	/**
	 * Checks and includes CSS and JS files
	 *
	 * @deprecated
	 * @return  void
	 */
	public function processCssJs($files, $moveJsToFooter = FALSE, $excludeJQuery = true)
	{
		$jQuery = 'jquery';
		if (is_array($files)) {
			foreach ($files as $name => $file) {
				if ($excludeJQuery && stristr($name, $jQuery)) continue;
				$this->includeCssJsFile($file, $moveJsToFooter);
			}
		} else {
			if ($excludeJQuery && stristr($name, $jQuery)) return;
			$this->includeCssJsFile($file, $moveJsToFooter);
		}
	}

	/**
	 * Check whether t3jquery is available and accessible
	 *
	 * @deprecated
	 * @return boolean Result of the T3 jQuery check
	 */
	public function checkForT3jquery()
	{
		// Check for T3 jQuery
		if (t3lib_extMgm::isLoaded('t3jquery')) {
			require_once(t3lib_extMgm::extPath('t3jquery') . 'class.tx_t3jquery.php');
		}
		// if T3 jQuery is loaded and the custom Library had been created
		if (T3JQUERY === true) {
			tx_t3jquery::addJqJS();
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/**
	 * Checks a passed CSS or JS file and adds it to the Frontend.
	 *
	 * @param string $file File reference
	 * @param string $addUnique Unique key to avoid multiple inclusions
	 * @param bool $moveToFooter Flag to include file into footer - doesn't work for CSS files
	 */
	public static function addCssJsFile($file, $addUnique = NULL, $moveToFooter = FALSE)
	{
		// Get file extension (after last occurance of a dot)
		$mediaTypeSplit = strrchr($file, '.');
		// Get file reference
		$resolved = self::getFileResource($file);

		if ($resolved) {
			// JavaScript processing
			if ($mediaTypeSplit == '.js') {
				if ($addUnique) {
					$code = '<script src="' . $resolved . '" type="text/javascript"></script>';
					($moveToFooter)
						? $GLOBALS['TSFE']->additionalFooterData[$addUnique] = $code
						: $GLOBALS['TSFE']->additionalHeaderData[$addUnique] = $code;

				} else {
					($moveToFooter)
						? $GLOBALS['TSFE']->getPageRenderer()->addJsFooterFile($resolved)
						: $GLOBALS['TSFE']->getPageRenderer()->addJsFile($resolved);
				}

			// Stylesheet processing
			} elseif ($mediaTypeSplit == '.css') {
				if ($addUnique) {
					$GLOBALS['TSFE']->additionalHeaderData[$addUnique] =
						'<link href="' . $resolved . '" rel="stylesheet" type="text/css" media="all" />';

				} else {
					$GLOBALS['TSFE']->getPageRenderer()->addCssFile($resolved);
				}
			}
		}
	}

	/**
	 * Adds/renders a Flash message.
	 *
	 * @param string $title The title
	 * @param string $message The message
	 * @param int $type Message level
	 * @return mixed
	 */
	public static function renderFlashMessage($title, $message, $type = t3lib_FlashMessage::WARNING) {
		$code  = ".typo3-message .message-header{padding: 10px 10px 0 30px;font-size:0.9em;}";
		$code .= ".typo3-message .message-body{padding: 10px;font-size:0.9em;}";

		$GLOBALS['TSFE']->getPageRenderer()->addCssFile(t3lib_extMgm::siteRelPath('t3skin') . 'stylesheets/visual/element_message.css');
		$GLOBALS['TSFE']->getPageRenderer()->addCssInlineBlock('flashmessage',$code);

		$flashMessage = t3lib_div::makeInstance('t3lib_FlashMessage', $message, $title, $type);
		return $flashMessage->render();
	}

}
