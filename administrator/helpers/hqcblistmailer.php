<?php
/**
 * @version     1.0.0
 * @package     com_hqcblistmailer
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Magnus Hasselquist <magnus.hasselquist@gmail.com> - http://mintekniskasida.blogspot.se/
 */

// No direct access
defined('_JEXEC') or die;

/**
 * Hqcblistmailer helper.
 */
class HqcblistmailerHelper
{
	/**
	 * Configure the Linkbar.
	 */
	public static function addSubmenu($vName = '')
	{
		JHtmlSidebar::addEntry(
			JText::_('COM_HQCBLISTMAILER_TITLE_EMAILTEMPLATES'),
			'index.php?option=com_hqcblistmailer&view=emailtemplates',
			$vName == 'emailtemplates'
		);
		JHtmlSidebar::addEntry(
			JText::_('COM_HQCBLISTMAILER_TITLE_EMAILSENDERS'),
			'index.php?option=com_hqcblistmailer&view=emailsenders',
			$vName == 'emailsenders'
		);

	}

	/**
	 * Gets a list of the actions that can be performed.
	 *
	 * @return	JObject
	 * @since	1.6
	 */
	public static function getActions()
	{
		$user	= JFactory::getUser();
		$result	= new JObject;

		$assetName = 'com_hqcblistmailer';

		$actions = array(
			'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
		);

		foreach ($actions as $action) {
			$result->set($action, $user->authorise($action, $assetName));
		}

		return $result;
	}
}
