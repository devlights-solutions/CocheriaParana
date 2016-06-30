<?php
/**
 * display a json loaded window with a repeatble set of sub fields
 */

defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');

/**
 * Form Field class for the Joomla Framework.
 *
 * @package		Joomla.Framework
 * @subpackage	Form
 * @since		1.6
 */
class JFormFieldFabrikModalrepeat extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var		string
	 * @since	1.6
	 */
	protected $type = 'FabrikModalrepeat';

	/**
	 * Method to get the field input markup.
	 *
	 * @return	string	The field input markup.
	 * @since	1.6
	 */
	
	protected function getInput()
	{
		// Initialize variables.
		$document = JFactory::getDocument();
		$options = array();

		$subForm = new JForm($this->name, array('control'=>'jform'));

		$xml = $this->element->children()->asFormattedXML();

		$subForm->load($xml);

		/**
		 * f3 hack
		 */

		$view = JRequest::getCmd('view', 'list');
		switch ($view) {
			case 'item':
				$view = 'list';
				$id = (int)$this->form->getValue('request.listid');
				break;
			case 'module':
				$view = 'list';
				$id = (int)$this->form->getValue('params.list_id');
				break;
			default:
				$id = JRequest::getInt('id');
				break;
		}
		$feModel = JModel::getInstance($view, 'FabrikFEModel');
		$feModel->setId($id);
		$subForm->model = $feModel;
		/*
		 * end
		 */
		$children = $this->element->children();
		$subForm->setFields($children);

		$str = array();
		$modalid = $this->id.'_modal';
		$str[] = '<div id="'.$modalid.'" style="display:none">';
		$str[] = '<table class="adminlist">';
		$str[] = '<thead><tr class="row0">';
		$names = array();
		foreach ($subForm->getFieldset($this->element->getAttribute('name').'_modal') as $field) {
			$names[] = $field->element->getAttribute('name');
			$str[] = '<th>'.$field->getLabel($field->name).'</th>';
		};
		$str[] = '<th></th>';
		$str[] = '</tr></thead>';

		$str[] = '<tbody><tr>';
		foreach ($subForm->getFieldset($this->element->getAttribute('name').'_modal') as $field) {
			$str[] = '<td>'.$field->getInput().'</td>';
		};
		$app = JFactory::getApplication();
		$path = 'templates/'.$app->getTemplate().'/images/menu/';
		$str[] = '<td><div style="width:35px"><a href="#" class="add"><img src="'.$path.'/icon-16-new.png" alt="'.JText::_('ADD').'" /></a>';
		$str[] = '<a href="#" class="remove"><img src="'.$path.'/icon-16-delete.png" alt="'.JText::_('REMOVE').'" /></div></a>';
		$str[] = '</td>';
		$str[] = '</tr></tbody>';
		$str[] = '</table>';
		$str[] = '</div>';
		$form = implode("\n", $str);
		static $modalrepeat;
		if (!isset($modalrepeat)) {
			$modalrepeat = array();
		}
		if (!array_key_exists($modalid, $modalrepeat)) {
			$modalrepeat[$modalid] = array();
		}
		if (!isset($this->form->repeatCounter)) {
			$this->form->repeatCounter = 0;
		}
		if (!array_key_exists($this->form->repeatCounter, $modalrepeat[$modalid])) {
			//if loaded as js template then we don't want to repeat this again. (fabrik)
			$names = json_encode($names);
			$pane = str_replace('jform_params_', '', $modalid).'-options';
			$modalrepeat[$modalid][$this->form->repeatCounter] = true;
			$script = str_replace("-", "", $modalid)." = new FabrikModalRepeat('$modalid', $names, '$this->id');";
			JHTML::script('administrator/components/com_fabrik/models/fields/fabrikmodalrepeat.js', true);
			$document->addScriptDeclaration("window.addEvent('domready', function() {
			".$script."
			if (typeOf($('$pane')) !== 'null') { 
			  $('$pane').getParent().hide();
			}
			});");
			//wont work when rendering in admin module page
			//FabrikHelperHTML::script('administrator/components/com_fabrik/models/fields/fabrikmodalrepeat.js', $script);
		}
		$close = "function(c){".$modalid.".onClose(c);}";

		$str[] = '<div class="button2-left">';
		$str[] = '	<div class="blank">';
		$str[] = "<a id=\"".$modalid."_button\" />".JText::_('JLIB_FORM_BUTTON_SELECT').'</a>';
		$html[] = '	</div>';
		$html[] = '</div>';
		if (is_array($this->value)) {
			$this->value = array_shift($this->value);
		}
		$value = htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8');
		$str[] = "<input type=\"hidden\" name=\"$this->name\" id=\"$this->id\" value=\"$value\" />";

		// hack hide additional panes generated by nested field set
		
		return implode("\n", $str);
	}
}