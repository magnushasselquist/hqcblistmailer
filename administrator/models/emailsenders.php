<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Hqcblistmailer
 * @author     Magnus Hasselquist <magnus.hasselquist@gmail.com>
 * @copyright  Copyright (C) 2014. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Hqcblistmailer records.
 *
 * @since  1.6
 */
class HqcblistmailerModelEmailsenders extends JModelList
{
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// Initialise variables.
		$app = JFactory::getApplication('administrator');

		// Load the filter state.
		$search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
		$this->setState('filter.search', $search);

		$published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
		$this->setState('filter.state', $published);

		// Load the parameters.
		$params = JComponentHelper::getParams('com_hqcblistmailer');
		$this->setState('params', $params);

		// List state information.
		parent::populateState('a.emailsubject', 'asc');
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return   string A store id.
	 *
	 * @since    1.6
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		return parent::getStoreId($id);
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return   JDatabaseQuery
	 *
	 * @since    1.6
	 */
	protected function getListQuery()
	{
		$db	= $this->getDbo();
		$query	= $db->getQuery(true);

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();

		foreach ($items as $oneItem) {

			if (isset($oneItem->emailcblist)) {
				$values = explode(',', $oneItem->emailcblist);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT listid, title FROM #__comprofiler_lists HAVING listid LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->title;
						}
					}
				}

			$oneItem->emailcblist = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailcblist;

			}

			if (isset($oneItem->emailtofield)) {
				$values = explode(',', $oneItem->emailtofield);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT '' AS value, '' AS name UNION ALL SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailtofield = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailtofield;

			}

			if (isset($oneItem->emailtonamefield)) {
				$values = explode(',', $oneItem->emailtonamefield);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT '' AS value, '' AS name UNION ALL SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailtonamefield = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailtonamefield;

			}

			if (isset($oneItem->emailccfield1)) {
				$values = explode(',', $oneItem->emailccfield1);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT '' AS value, '' AS name UNION ALL SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailccfield1 = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailccfield1;

			}

			if (isset($oneItem->emailccfield2)) {
				$values = explode(',', $oneItem->emailccfield2);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT '' AS value, '' AS name UNION ALL SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailccfield2 = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailccfield2;

			}

			if (isset($oneItem->emailccfield3)) {
				$values = explode(',', $oneItem->emailccfield3);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT '' AS value, '' AS name UNION ALL SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailccfield3 = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailccfield3;

			}

			if (isset($oneItem->emailfieldsavailable)) {
				$values = explode(',', $oneItem->emailfieldsavailable);

				$textValue = array();
				foreach ($values as $value){
					if(!empty($value)){
						$db = JFactory::getDbo();
						$query = "SELECT name AS value, name AS name from #__comprofiler_fields HAVING value LIKE '" . $value . "'";
						$db->setQuery($query);
						$results = $db->loadObject();
						if ($results) {
							$textValue[] = $results->name;
						}
					}
				}

			$oneItem->emailfieldsavailable = !empty($textValue) ? implode(', ', $textValue) : $oneItem->emailfieldsavailable;

			}
		}
		return $items;
	}
}
