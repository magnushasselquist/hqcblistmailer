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

jimport('joomla.application.component.controllerform');

/**
 * Emailtemplate controller class.
 */
class HqcblistmailerControllerEmailtemplate extends JControllerForm
{

    function __construct() {
        $this->view_list = 'emailtemplates';
        parent::__construct();
    }

}