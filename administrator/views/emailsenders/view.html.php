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

jimport('joomla.application.component.view');

/**
 * View class for a list of Hqcblistmailer.
 */
class HqcblistmailerViewEmailsenders extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		
		

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		HqcblistmailerHelper::addSubmenu('emailsenders');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/hqcblistmailer.php';

		$state	= $this->get('State');
		$canDo	= HqcblistmailerHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_HQCBLISTMAILER_TITLE_EMAILSENDERS'), 'emailsenders.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/XXX_INTERNAL_NAME_FORCE_FORM_LOWERCASE_XXX';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('emailsender.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('emailsender.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('emailsenders.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('emailsenders.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'emailsenders.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('emailsenders.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('emailsenders.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'emailsenders.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('emailsenders.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_hqcblistmailer');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_hqcblistmailer&view=emailsenders');
        
        $this->extra_sidebar = '';
        //
        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.checked_out' => JText::_('COM_HQCBLISTMAILER_EMAILTEMPLATES_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_HQCBLISTMAILER_EMAILTEMPLATES_CHECKED_OUT_TIME'),
		'a.emailsubject' => JText::_('COM_HQCBLISTMAILER_EMAILTEMPLATES_EMAILSUBJECT'),
		'a.emailcblist' => JText::_('COM_HQCBLISTMAILER_EMAILTEMPLATES_EMAILCBLIST'),
		'a.created_by' => JText::_('COM_HQCBLISTMAILER_EMAILTEMPLATES_CREATED_BY'),
		);
	}

    
}
