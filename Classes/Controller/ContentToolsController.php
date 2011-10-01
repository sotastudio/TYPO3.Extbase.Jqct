<?php
/**
 * The ContentTools controller for the Jqct extension
 */
class Tx_Jqct_Controller_ContentToolsController extends Tx_Jqct_Controller_AbstractController {
	
	/**
	 * Kinda construct
	 * 
	 * @return void
	 */
	public function initializeAction() {
		
	}	
	
	/**
	 * Show action for this controller. Initiates the frontend rendering of the Plugin.
	 * 
	 * @todo Work out how to handle a missing rendering method
	 * @return void
	 */
	public function indexAction() {
			// Fetch choosen rendering method 
		if ( $renderChoosen = $this->settings['renderingMethod'] ) {
				// Try to get an object mathing the choosen rendering method
			try {
					// Build Model based on defined rendering
				$renderObjName = 'Tx_Jqct_Domain_Model_' . $renderChoosen;
				$renderObj = $this->objectManager->get($renderObjName);
			} catch (Exception $e){
				$this->addFlashMessage('renderingModel');
			}
			
			if (is_object($renderObj)) {
					// If everything went fine, just render the stuff
				$content = $renderObj->content->getAll(); 
				$tplObj = array(
					'content' => $content
				);
				$this->view->assignMultiple($tplObj);
			}
			
		} else {
				// Here could apper some kind of error if no rendering method has been choosen
				// But maybe the integrator or user doesn't want to have such a message in the frontend
			//$this->addFlashMessage('rendering');
		}
	}
	
	protected function getRenderingMethod() {
		return $this->settings['renderingMethod'];
		 
	}
	
	protected function setRenderingModel() {
		//$accordion = $this->objectManager->get('Tx_Jqct_Domain_Model_Accordion');
		//$tabs = $this->objectManager->get('Tx_Jqct_Domain_Model_Tabs');		
	}
	 	
}
