<?php

/**
 * @version    CVS: 1.0.6
 * @package    Com_Hqcblistmailer
 * @author     Magnus Hasselquist <magnus.hasselquist@gmail.com>
 * @copyright  Copyright (C) 2016. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;
/**
 * emailtemplate Table class
 *
 * @since  1.6
 */
class HqcblistmailerTableemailtemplate extends JTable
{
	
	/**
	 * Constructor
	 *
	 * @param   JDatabase  &$db  A database connector object
	 */
	public function __construct(&$db)
	{
		JObserverMapper::addObserverClassToClass('JTableObserverContenthistory', 'HqcblistmailerTableemailtemplate', array('typeAlias' => 'com_hqcblistmailer.emailtemplate'));
		parent::__construct('#__hqcblistmailer_emails', 'id', $db);
	}

	/**
	 * Overloaded bind function to pre-process the params.
	 *
	 * @param   array  $array   Named array
	 * @param   mixed  $ignore  Optional array or list of parameters to ignore
	 *
	 * @return  null|string  null is operation was satisfactory, otherwise returns an error
	 *
	 * @see     JTable:bind
	 * @since   1.5
	 */
	public function bind($array, $ignore = '')
	{
		$input = JFactory::getApplication()->input;
		$task = $input->getString('task', '');

		// Support for multiple SQL field: emailcblist
			if(isset($array['emailcblist']))
			{
				if(is_array($array['emailcblist'])){
					$array['emailcblist'] = implode(',',$array['emailcblist']);
				}
				else if(strrpos($array['emailcblist'], ',') != false){
					$array['emailcblist'] = explode(',',$array['emailcblist']);
				}
				else if(empty($array['emailcblist'])) {
					$array['emailcblist'] = '';
				}
			}

		// Support for multiple SQL field: emailtofield
			if(isset($array['emailtofield']))
			{
				if(is_array($array['emailtofield'])){
					$array['emailtofield'] = implode(',',$array['emailtofield']);
				}
				else if(strrpos($array['emailtofield'], ',') != false){
					$array['emailtofield'] = explode(',',$array['emailtofield']);
				}
				else if(empty($array['emailtofield'])) {
					$array['emailtofield'] = '';
				}
			}

		// Support for multiple SQL field: emailtonamefield
			if(isset($array['emailtonamefield']))
			{
				if(is_array($array['emailtonamefield'])){
					$array['emailtonamefield'] = implode(',',$array['emailtonamefield']);
				}
				else if(strrpos($array['emailtonamefield'], ',') != false){
					$array['emailtonamefield'] = explode(',',$array['emailtonamefield']);
				}
				else if(empty($array['emailtonamefield'])) {
					$array['emailtonamefield'] = '';
				}
			}

		// Support for multiple SQL field: emailccfield1
			if(isset($array['emailccfield1']))
			{
				if(is_array($array['emailccfield1'])){
					$array['emailccfield1'] = implode(',',$array['emailccfield1']);
				}
				else if(strrpos($array['emailccfield1'], ',') != false){
					$array['emailccfield1'] = explode(',',$array['emailccfield1']);
				}
				else if(empty($array['emailccfield1'])) {
					$array['emailccfield1'] = '';
				}
			}

		// Support for multiple SQL field: emailccfield2
			if(isset($array['emailccfield2']))
			{
				if(is_array($array['emailccfield2'])){
					$array['emailccfield2'] = implode(',',$array['emailccfield2']);
				}
				else if(strrpos($array['emailccfield2'], ',') != false){
					$array['emailccfield2'] = explode(',',$array['emailccfield2']);
				}
				else if(empty($array['emailccfield2'])) {
					$array['emailccfield2'] = '';
				}
			}

		// Support for multiple SQL field: emailccfield3
			if(isset($array['emailccfield3']))
			{
				if(is_array($array['emailccfield3'])){
					$array['emailccfield3'] = implode(',',$array['emailccfield3']);
				}
				else if(strrpos($array['emailccfield3'], ',') != false){
					$array['emailccfield3'] = explode(',',$array['emailccfield3']);
				}
				else if(empty($array['emailccfield3'])) {
					$array['emailccfield3'] = '';
				}
			}

		// Support for multiple SQL field: emailfieldsavailable
			if(isset($array['emailfieldsavailable']))
			{
				if(is_array($array['emailfieldsavailable'])){
					$array['emailfieldsavailable'] = implode(',',$array['emailfieldsavailable']);
				}
				else if(strrpos($array['emailfieldsavailable'], ',') != false){
					$array['emailfieldsavailable'] = explode(',',$array['emailfieldsavailable']);
				}
				else if(empty($array['emailfieldsavailable'])) {
					$array['emailfieldsavailable'] = '';
				}
			}

		if ($array['id'] == 0)
		{
			$array['created_by'] = JFactory::getUser()->id;
		}

		if (isset($array['params']) && is_array($array['params']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['params']);
			$array['params'] = (string) $registry;
		}

		if (isset($array['metadata']) && is_array($array['metadata']))
		{
			$registry = new JRegistry;
			$registry->loadArray($array['metadata']);
			$array['metadata'] = (string) $registry;
		}

		if (!JFactory::getUser()->authorise('core.admin', 'com_hqcblistmailer.emailtemplate.' . $array['id']))
		{
			$actions         = JAccess::getActionsFromFile(
				JPATH_ADMINISTRATOR . '/components/com_hqcblistmailer/access.xml',
				"/access/section[@name='emailtemplate']/"
			);
			$default_actions = JAccess::getAssetRules('com_hqcblistmailer.emailtemplate.' . $array['id'])->getData();
			$array_jaccess   = array();

			foreach ($actions as $action)
			{
				$array_jaccess[$action->name] = $default_actions[$action->name];
			}

			$array['rules'] = $this->JAccessRulestoArray($array_jaccess);
		}

		// Bind the rules for ACL where supported.
		if (isset($array['rules']) && is_array($array['rules']))
		{
			$this->setRules($array['rules']);
		}

		return parent::bind($array, $ignore);
	}

	/**
	 * This function convert an array of JAccessRule objects into an rules array.
	 *
	 * @param   array  $jaccessrules  An array of JAccessRule objects.
	 *
	 * @return  array
	 */
	private function JAccessRulestoArray($jaccessrules)
	{
		$rules = array();

		foreach ($jaccessrules as $action => $jaccess)
		{
			$actions = array();

			foreach ($jaccess->getData() as $group => $allow)
			{
				$actions[$group] = ((bool) $allow);
			}

			$rules[$action] = $actions;
		}

		return $rules;
	}

	/**
	 * Overloaded check function
	 *
	 * @return bool
	 */
	public function check()
	{
		// If there is an ordering column and this is a new row then get the next ordering value
		if (property_exists($this, 'ordering') && $this->id == 0)
		{
			$this->ordering = self::getNextOrder();
		}
		
		

		return parent::check();
	}

	/**
	 * Method to set the publishing state for a row or list of rows in the database
	 * table.  The method respects checked out rows by other users and will attempt
	 * to checkin rows that it can after adjustments are made.
	 *
	 * @param   mixed    $pks     An optional array of primary key values to update.  If not
	 *                            set the instance property value is used.
	 * @param   integer  $state   The publishing state. eg. [0 = unpublished, 1 = published]
	 * @param   integer  $userId  The user id of the user performing the operation.
	 *
	 * @return   boolean  True on success.
	 *
	 * @since    1.0.4
	 *
	 * @throws Exception
	 */
	public function publish($pks = null, $state = 1, $userId = 0)
	{
		// Initialise variables.
		$k = $this->_tbl_key;

		// Sanitize input.
		ArrayHelper::toInteger($pks);
		$userId = (int) $userId;
		$state  = (int) $state;

		// If there are no primary keys set check to see if the instance key is set.
		if (empty($pks))
		{
			if ($this->$k)
			{
				$pks = array($this->$k);
			}
			// Nothing to set publishing state on, return false.
			else
			{
				throw new Exception(500, JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
			}
		}

		// Build the WHERE clause for the primary keys.
		$where = $k . '=' . implode(' OR ' . $k . '=', $pks);

		// Determine if there is checkin support for the table.
		if (!property_exists($this, 'checked_out') || !property_exists($this, 'checked_out_time'))
		{
			$checkin = '';
		}
		else
		{
			$checkin = ' AND (checked_out = 0 OR checked_out = ' . (int) $userId . ')';
		}

		// Update the publishing state for rows with the given primary keys.
		$this->_db->setQuery(
			'UPDATE `' . $this->_tbl . '`' .
			' SET `state` = ' . (int) $state .
			' WHERE (' . $where . ')' .
			$checkin
		);
		$this->_db->execute();

		// If checkin is supported and all rows were adjusted, check them in.
		if ($checkin && (count($pks) == $this->_db->getAffectedRows()))
		{
			// Checkin each row.
			foreach ($pks as $pk)
			{
				$this->checkin($pk);
			}
		}

		// If the JTable instance value is in the list of primary keys that were set, set the instance.
		if (in_array($this->$k, $pks))
		{
			$this->state = $state;
		}

		return true;
	}

	/**
	 * Define a namespaced asset name for inclusion in the #__assets table
	 *
	 * @return string The asset name
	 *
	 * @see JTable::_getAssetName
	 */
	protected function _getAssetName()
	{
		$k = $this->_tbl_key;

		return 'com_hqcblistmailer.emailtemplate.' . (int) $this->$k;
	}

	/**
	 * Returns the parent asset's id. If you have a tree structure, retrieve the parent's id using the external key field
	 *
	 * @param   JTable   $table  Table name
	 * @param   integer  $id     Id
	 *
	 * @see JTable::_getAssetParentId
	 *
	 * @return mixed The id on success, false on failure.
	 */
	protected function _getAssetParentId(JTable $table = null, $id = null)
	{
		// We will retrieve the parent-asset from the Asset-table
		$assetParent = JTable::getInstance('Asset');

		// Default: if no asset-parent can be found we take the global asset
		$assetParentId = $assetParent->getRootId();

		// The item has the component as asset-parent
		$assetParent->loadByName('com_hqcblistmailer');

		// Return the found asset-parent-id
		if ($assetParent->id)
		{
			$assetParentId = $assetParent->id;
		}

		return $assetParentId;
	}

	/**
	 * Delete a record by id
	 *
	 * @param   mixed  $pk  Primary key value to delete. Optional
	 *
	 * @return bool
	 */
	public function delete($pk = null)
	{
		$this->load($pk);
		$result = parent::delete($pk);
		
		return $result;
	}
}
