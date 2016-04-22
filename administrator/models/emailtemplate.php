<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Hqcblistmailer
 * @author     Magnus Hasselquist <magnus.hasselquist@gmail.com>
 * @copyright  Copyright (C) 2014. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');

/**
 * Hqcblistmailer model.
 *
 * @since  1.6
 */
class HqcblistmailerModelEmailtemplate extends JModelAdmin
{
	/**
	 * @var      string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_HQCBLISTMAILER';

	/**
	 * @var   	string  	Alias to manage history control
	 * @since   3.2
	 */
	public $typeAlias = 'com_hqcblistmailer.emailtemplate';

	/**
	 * @var null  Item data
	 * @since  1.6
	 */
	protected $item = null;

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 *
	 * @since    1.6
	 */
	public function getTable($type = 'Emailtemplate', $prefix = 'HqcblistmailerTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

	/**
	 * Method to get the record form.
	 *
	 * @param   array    $data      An optional array of data for the form to interogate.
	 * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
	 *
	 * @return  JForm  A JForm object on success, false on failure
	 *
	 * @since    1.6
	 */
	public function getForm($data = array(), $loadData = true)
	{
		// Initialise variables.
		$app = JFactory::getApplication();

		// Get the form.
		$form = $this->loadForm(
			'com_hqcblistmailer.emailtemplate', 'emailtemplate',
			array('control' => 'jform',
				'load_data' => $loadData
			)
		);

		if (empty($form))
		{
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return   mixed  The data for the form.
	 *
	 * @since    1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_hqcblistmailer.edit.emailtemplate.data', array());

		if (empty($data))
		{
			if ($this->item === null)
			{
				$this->item = $this->getItem();
			}

			$data = $this->item;

			// Support for multiple or not foreign key field: emailcblist
			$array = array();
			foreach((array)$data->emailcblist as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailcblist = implode(',',$array);

			// Support for multiple or not foreign key field: emailtofield
			$array = array();
			foreach((array)$data->emailtofield as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailtofield = implode(',',$array);

			// Support for multiple or not foreign key field: emailtonamefield
			$array = array();
			foreach((array)$data->emailtonamefield as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailtonamefield = implode(',',$array);

			// Support for multiple or not foreign key field: emailccfield1
			$array = array();
			foreach((array)$data->emailccfield1 as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailccfield1 = implode(',',$array);

			// Support for multiple or not foreign key field: emailccfield2
			$array = array();
			foreach((array)$data->emailccfield2 as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailccfield2 = implode(',',$array);

			// Support for multiple or not foreign key field: emailccfield3
			$array = array();
			foreach((array)$data->emailccfield3 as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailccfield3 = implode(',',$array);

			// Support for multiple or not foreign key field: emailfieldsavailable
			$array = array();
			foreach((array)$data->emailfieldsavailable as $value): 
				if(!is_array($value)):
					$array[] = $value;
				endif;
			endforeach;
			$data->emailfieldsavailable = implode(',',$array);
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk))
		{
			// Do any procesing on fields here if needed
		}

		return $item;
	}

	/**
	 * Method to duplicate an Emailtemplate
	 *
	 * @param   array  &$pks  An array of primary key IDs.
	 *
	 * @return  boolean  True if successful.
	 *
	 * @throws  Exception
	 */
	public function duplicate(&$pks)
	{
		$user = JFactory::getUser();

		// Access checks.
		if (!$user->authorise('core.create', 'com_hqcblistmailer'))
		{
			throw new Exception(JText::_('JERROR_CORE_CREATE_NOT_PERMITTED'));
		}

		$dispatcher = JEventDispatcher::getInstance();
		$context    = $this->option . '.' . $this->name;

		// Include the plugins for the save events.
		JPluginHelper::importPlugin($this->events_map['save']);

		$table = $this->getTable();

		foreach ($pks as $pk)
		{
			if ($table->load($pk, true))
			{
				// Reset the id to create a new record.
				$table->id = 0;

				if (!$table->check())
				{
					throw new Exception($table->getError());
				}
				

				// Trigger the before save event.
				$result = $dispatcher->trigger($this->event_before_save, array($context, &$table, true));

				if (in_array(false, $result, true) || !$table->store())
				{
					throw new Exception($table->getError());
				}

				// Trigger the after save event.
				$dispatcher->trigger($this->event_after_save, array($context, &$table, true));
			}
			else
			{
				throw new Exception($table->getError());
			}
		}

		// Clean cache
		$this->cleanCache();

		return true;
	}

	/**
	 * Prepare and sanitise the table prior to saving.
	 *
	 * @param   JTable  $table  Table Object
	 *
	 * @return void
	 *
	 * @since    1.6
	 */
	protected function prepareTable($table)
	{
		jimport('joomla.filter.output');

		if (empty($table->id))
		{
			// Set ordering to the last item if not set
			if (@$table->ordering === '')
			{
				$db = JFactory::getDbo();
				$db->setQuery('SELECT MAX(ordering) FROM #__hqcblistmailer_emails');
				$max             = $db->loadResult();
				$table->ordering = $max + 1;
			}
		}
	}
}
