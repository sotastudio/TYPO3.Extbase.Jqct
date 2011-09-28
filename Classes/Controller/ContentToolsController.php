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
	 * @return void
	 */
	public function indexAction() {
		//$recordObject = $this->objectManager->get('Tx_Jqct_Domain_Repository_RecordObjectStorage');
		$accordion = $this->objectManager->get('Tx_Jqct_Domain_Model_Accordion');
		//$this->div->debug( $this->confMan );
		//$this->div->debug( Tx_Extbase_Configuration_FrontendConfigurationManager::getPluginConfiguration() );
		$this->view->assign('settings', $this->settings);
	}
	
	protected function getRenderingMethod() {
		return $this->settings['renderingMethod'];
		 
	}
	
	protected function setRenderingModel() {
		//$accordion = $this->objectManager->get('Tx_Jqct_Domain_Model_Accordion');
		//$tabs = $this->objectManager->get('Tx_Jqct_Domain_Model_Tabs');		
	}
	 	
}
