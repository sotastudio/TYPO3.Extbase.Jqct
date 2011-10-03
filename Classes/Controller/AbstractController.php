<?php
/**
 * Abstract base controller for the Jqct extension
 * 
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 * @todo Create Method to inject Stylesheets and Script info the Frontend Page: $this->response->addAdditionalHeaderData('<link rel="stylesheet" href="' . t3lib_extMgm::siteRelPath('extkey') . 'Resources/Public/Stylesheets/index.css" />');
 * @todo I should take a look at http://wiki.typo3.org/wiki/Fluid
 */
abstract class Tx_Jqct_Controller_AbstractController extends Tx_Extbase_MVC_Controller_ActionController {

	/**
	 * Stores the Div Repository with some helper functions
	 *
	 * @var Tx_Jqct_Utility_Div
	 */
	protected $div;

 	/**
	 * Dependency injection of the Div Repository
 	 *
	 * @param Tx_Jqct_Utility_Div $div
 	 * @return void
	 */
	public function injectDivRepository(Tx_Jqct_Utility_Div $div) {
		$this->div = $div;
	}
	
	/**
	 * Returns the reference to a 'resource' in TypoScript.
	 * 
	 * @todo Check whether there is a better solution for this
	 */
	protected function getFileResource($file) {
		return $GLOBALS['TSFE']->tmpl->getFileName($file);
	}
	
	/**
	 * Override getErrorFlashMessage to present
	 * nice flash error messages.
	 *
	 * @return string
	 */
	protected function getErrorFlashMessage() {
		$defaultFlashMessage = parent::getErrorFlashMessage();
		$locallangKey = sprintf('error.%s.%s', $this->request->getControllerName(), $this->actionMethodName);
		return $this->translate($locallangKey, $defaultFlashMessage);
	}

	/**
	 * Helper function to render localized flashmessages
	 *
	 * @param string $action
	 * @param integer $severity optional severity code. One of the t3lib_FlashMessage constants
	 * @return void
	 */
	protected function addFlashMessage($action, $severity = t3lib_FlashMessage::OK) {
		$messageLocallangKey = sprintf('flashmessage.%s.%s', $this->request->getControllerName(), $action);
		$localizedMessage = $this->translate($messageLocallangKey, '[' . $messageLocallangKey . ']');
		$titleLocallangKey = sprintf('%s.title', $messageLocallangKey);
		$localizedTitle = $this->translate($titleLocallangKey, '[' . $titleLocallangKey . ']');
		$this->flashMessageContainer->add($localizedMessage, $localizedTitle, $severity);
	}

	/**
	 * Helper function to use localized strings in Jqct controllers
	 *
	 * @param string $key locallang key
	 * @param string $default the default message to show if key was not found
	 * @return string
	 */
	protected function translate($key, $defaultMessage = '') {
		$message = Tx_Extbase_Utility_Localization::translate($key, 'Jqct');
		if ($message === NULL) {
			$message = $defaultMessage;
		}
		return $message;
	}

}