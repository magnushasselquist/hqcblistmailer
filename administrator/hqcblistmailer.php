<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Hqcblistmailer
 * @author     Magnus Hasselquist <magnus.hasselquist@gmail.com>
 * @copyright  Copyright (C) 2014. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_hqcblistmailer'))
{
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Hqcblistmailer', JPATH_COMPONENT_ADMINISTRATOR);

$controller = JControllerLegacy::getInstance('Hqcblistmailer');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
