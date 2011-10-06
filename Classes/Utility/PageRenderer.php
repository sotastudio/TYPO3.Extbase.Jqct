<?php
/**
 * Helper Class to hook into the page rendering process
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 */
class Tx_Jqct_Utility_PageRenderer {

    protected $moveJsToFooter;
    protected $files;

    /**
     * Stores the Div Repository with some helper functions
     *
     * @var Tx_Jqct_Utility_Div
     */
    protected $div;

    public function __construct() {
        $this->div = t3lib_div::makeInstance('Tx_Jqct_Utility_Div');
    }

    public function setFiles($files) {
        $this->files = $files;
        return $this;
    }

    public function setOptions($options) {
        
    }

	/**
	 * Checks a passed CSS or JS file and renders it with the Page Content
	 *
	 * @todo Make it more flexible so it can handle an array
	 * @param  string  $file: Given filename incl. path
	 * @param  bool  $moveJSToFooter
	 * @return  void
	 */
	public function includeCssJsFile($file, $moveJsToFooter) {

		$mediaTypeSplit = strrchr($file, '.');
		$resolved = $this->getFileResource($file);

		if($resolved) {
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
	public function processCssJs($files, $moveJsToFooter = FALSE) {
        if ( is_array($files) ) {

        } else {

        }
	}

}