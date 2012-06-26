<?php
/**
 * The ContentTools controller for the Jqct extension
 *
 * @author Andy Hausmann <andy.hausmann@gmx.de>
 * @package TYPO3
 * @subpackage tx_jqct
 * @todo Work out how to handle a missing rendering method
 * @todo Cleaning up the code, e.g. outsourcing the initialization of the Rendering Method
 */
class Tx_Jqct_Controller_ContentToolsController extends Tx_Jqct_Controller_AbstractController
{

	/**
	 * @var tslib_cObj
	 */
	protected $contentObject;

	/**
	 * @var string
	 */
	protected $renderingMethod;

	/**
	 * @var string
	 */
	protected $renderingModelName;

	/**
	 * Holds an Instance of the correspondig Rendering Model
	 * Depends on the Rendering Method
	 *
	 * @var object
	 */
	protected $renderingModel;

	/**
	 * Kinda constructor
	 * Beeing executed right after __construct and has access to injected Objects
	 *
	 * @return void
	 */
	public function initializeAction()
	{
		$this->contentObject = $this->configurationManager->getContentObject();
		$this->setRenderingModelName('Tx_Jqct_Domain_Model_' . ucfirst($this->getRenderingMethod()));
	}

	/**
	 * Show action for this controller. Initiates the frontend rendering of the Plugin.
	 *
	 * @return void
	 */
	public function indexAction()
	{
		if ($this->initRenderModel()) {
			// This calls are checking the TS Setup for a differing template reference to override the Extbase default
			if ($tpl = $this->getTemplate($this->getRenderingMethod())) {
				$this->overrideView($tpl);
			}

			$tplObj = array(
				'data' => $this->contentObject->data,
				'content' => $this->renderingModel->content->getAll(),
			);
			$this->view->assignMultiple($tplObj);
		} else {
			// Here could apper some kind of error if no rendering method has been choosen
			// But maybe the integrator or user doesn't want to have such a message in the frontend
			//$this->addFlashMessage('rendering');
		}
	}

	/**
	 * Changes the default Extbase View to one which is defined by the TS Setup
	 *
	 * @param string $fileRef Reference to a differing template file
	 * @return void
	 */
	protected function overrideView($fileRef)
	{
		$this->view->setTemplatePathAndFilename($fileRef);
	}

	/**
	 * Checks whether a differing template file has been specified via TS Setup
	 *
	 * @param string $rendering The Rendering Method
	 * @return mixed Template reference or a negative result
	 */
	protected function getTemplate($rendering)
	{
		$tpl = $this->settings['templates'][strtolower($rendering)];
		if (strlen($tpl)) {
			return $this->div->getFileResource($tpl);
		} else {
			$this->addFlashMessage('templateNotDeclared');
			return FALSE;
		}
	}

	/**
	 * Initializes the Rendering Model
	 *
	 * @return boolean Result report
	 */
	protected function initRenderModel()
	{
		try {
			// Build Model based on defined rendering
			$this->renderingModel = $this->objectManager->get($this->getRenderingModelName());
		} catch (Exception $e) {
			$this->addFlashMessage('renderingModel');
			$this->addFlashMessage($e);
		}
		return (is_object($this->renderingModel)) ? TRUE : FALSE;
	}

	/**
	 * Returns the Rendering Method passed by the Flexform
	 *
	 * @return string The Rendering Method
	 */
	protected function getRenderingMethod()
	{
		return $this->settings['renderingMethod'];
	}

	/**
	 * Sets the Rendering Model's name
	 *
	 * @param string $name The Rendering Model's name
	 * @return void
	 */
	protected function setRenderingModelName($name)
	{
		$this->renderingModelName =& $name;
	}

	/**
	 * Returns the Renderin Model's name
	 *
	 * @return string The Rendering Model's name
	 */
	protected function getRenderingModelName()
	{
		return $this->renderingModelName;
	}

}
