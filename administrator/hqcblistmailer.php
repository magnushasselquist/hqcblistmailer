<?php
/**
 * @package     com_hqcblistmailer
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later.
 * @author      Magnus Hasselquist <magnus.hasselquist@gmail.com> - http://mintekniskasida.blogspot.se/
 */


// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_hqcblistmailer')) 
{
	$error = (JText::_('JERROR_ALERTNOAUTHOR'));
	JFactory::getApplication()->enqueueMessage($error, 'error');
}

// Include dependancies
jimport('joomla.application.component.controller');

$controller	= JControllerLegacy::getInstance('Hqcblistmailer');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
