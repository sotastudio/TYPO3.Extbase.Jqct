<?php
/**
 * The ContentTools controller for the Jqct extension
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 * @todo Work out how to handle a missing rendering method
 * @todo Cleaning up the code, e.g. outsoorcing the initialization of the Rendering Method
 */
class Tx_Jqct_Controller_ContentToolsController extends Tx_Jqct_Controller_AbstractController {

	/**
	 * @var tslib_cObj
	 */
	protected $contentObject;

	
	/**
	 * Kinda construct
	 * 
	 * @return void
	 */
	public function initializeAction() {
		$this->contentObject = $this->configurationManager->getContentObject();
	}	
	
	/**
	 * Show action for this controller. Initiates the frontend rendering of the Plugin.
	 * 
	 * @return void
	 */
	public function indexAction() {
			// Fetch choosen rendering method 
		if ( $renderChoosen = $this->getRenderingMethod() ) {
				// Try to get an object mathing the choosen rendering method
			try {
					// Build Model based on defined rendering
				$renderObjName = 'Tx_Jqct_Domain_Model_' . ucfirst($renderChoosen);
				$renderObj = $this->objectManager->get($renderObjName);
			} catch (Exception $e){
				$this->addFlashMessage('renderingModel');
			}
			
			if (is_object($renderObj)) {
					// Set another Template, if neccesary (based on TS Setup)
				if ($tpl = $this->settings['templates'][strtolower($renderChoosen)]) {
					$this->view->setTemplatePathAndFilename( $this->getFileResource($tpl) );
				}
					// If everything went fine, just render the stuff
				$tplObj = array(
                    'object' => &$renderObj,
					'content' => $renderObj->content->getAll()
				);
				$this->view->assignMultiple($tplObj);
			}
			
		} else {
				// Here could apper some kind of error if no rendering method has been choosen
				// But maybe the integrator or user doesn't want to have such a message in the frontend
			//$this->addFlashMessage('rendering');
		}
	}
	
	/**
	 * Returns Rendering Method defined via Flexform or TS Setup
	 * 
	 * @return string Rendering Method
	 */
	protected function getRenderingMethod() {
		return $this->settings['renderingMethod'];
	}
	
	protected function getRenderingModel() {}
	
	protected function setRenderingModel() {}
	
	protected function setTemplate() {}
	 	
}
