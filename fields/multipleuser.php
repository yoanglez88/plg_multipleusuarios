<?php
/**
 * File       multipleuser.php
 * Created    12/13/17 1:41 PM
 * Author     Matt Thomas
 * Email      matt.thomas@searshc.com
 * Copyright  Copyright (C) 2017 Sears Holdings. All Rights Reserved.
 */

defined( '_JEXEC' ) or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Form\FormHelper;

FormHelper::loadFieldClass('list');

class JFormFieldMultipleuser extends \JFormFieldList
{
	public $type = 'Multipleuser';

	protected function getOptions()
	{
		$options = array();

		$db = Factory::getDbo();

		#Seleccionar contactos habilitados segun categoria y el usuario vinculado habilitado:
		#SELECT `c`.`alias` FROM `rart_contact_details` as `c` INNER JOIN `rart_users` as `u` ON (`c`.`user_id` = `u`.`id` and `u`.`block`=0) WHERE `c`.`catid` IN (select `cat`.`id` from `rart_categories` as `cat` WHERE `cat`.`alias`="periodistas") and `c`.`published`=1
		
		$tipo = "periodistas";
		$subQuery = $db->getQuery(true);
		$subQuery->select($db->quoteName('cat.id'))
				->from($db->quoteName('#__categories', 'cat'))
				->where($db->quoteName('cat.alias').' = "' . $tipo . '"');  
					
		$query = $db->getQuery(true);
		$query->select($db->quoteName('c.id', 'value'))
				->select($db->quoteName('c.name', 'text'))
				->from($db->quoteName('#__contact_details', 'c'))
				->join('INNER', $db->quoteName('#__users', 'u') . ' 
					ON ('.$db->quoteName('c.user_id').'='.$db->quoteName('u.id').' 
					AND '.$db->quoteName('u.block').'=0)')	
				->where($db->quoteName('c.catid').' IN ('. $subQuery. ') 
					AND '.$db->quoteName('c.published').'=1')
				->order('c.name', 'ASC');
		$db->setQuery($query);

		try {
			$authors = $db->loadObjectList();
		} catch (\DatabaseExceptionExecuting $e) {
			$authors = array();
		}

		$options = array_merge($options, $authors);

		// Merge any additional options in the XML definition.
		$options = array_merge(parent::getOptions(), $options);

		return $options;
	}

	public function setup(\SimpleXMLElement $element, $value, $group = null)
	{
		$return = parent::setup($element, $value, $group);

		if ($return) {
			$this->option = isset($this->element['option']) ? $this->element['option'] : '';
		}

		return $return;
	}
}