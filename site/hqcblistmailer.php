<?php
/**
 * @version    CVS: 1.0.6
 * @package    Com_Hqcblistmailer
 * @author     Magnus Hasselquist <magnus.hasselquist@gmail.com>
 * @copyright  Copyright (C) 2016. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Hqcblistmailer', JPATH_COMPONENT);
JLoader::register('HqcblistmailerController', JPATH_COMPONENT . '/controller.php');


// Execute the task.
$controller = JControllerLegacy::getInstance('Hqcblistmailer');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
