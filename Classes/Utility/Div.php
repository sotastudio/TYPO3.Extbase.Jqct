<?php
/**
 * Helper Class which makes various tools and helper available
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Utility_Div
{

	/**
	 * Helper function to debug - for those whom too lazy to write to much code, as i am.
	 *
	 * @param	 mixed  $v: Var to debug.
	 * @return	void
	 */
	public function debug($v)
	{
		t3lib_utility_Debug::debug($v);
	}

	public function getClassName($obj)
	{
		return get_class($obj);
	}

	public function getClassMethods($obj)
	{
		return get_class_methods($obj);
	}

	public function getClassVars($obj)
	{
		return get_object_vars($obj);
	}

	/**
	 * Returns the reference to a 'resource' in TypoScript.
	 *
	 * @todo Check whether there is a better solution for this
	 */
	public function getFileResource($file)
	{
		return $GLOBALS['TSFE']->tmpl->getFileName($file);
	}

	/**
	 * Checks a passed CSS or JS file and renders it with the Page Content
	 *
	 * @todo Make it more flexible so it can handle an array
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
	 * @todo Work out
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
}
