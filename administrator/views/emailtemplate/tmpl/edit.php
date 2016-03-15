<?php
/**
 * @version     1.0.0
 * @package     com_hqcblistmailer
 * @copyright   Copyright (C) 2014. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 * @author      Magnus Hasselquist <magnus.hasselquist@gmail.com> - http://mintekniskasida.blogspot.se/
 */
// no direct access
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_hqcblistmailer/assets/css/hqcblistmailer.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function(){
        
    });
    
    Joomla.submitbutton = function(task)
    {
        if(task == 'emailtemplate.cancel'){
            Joomla.submitform(task, document.getElementById('emailtemplate-form'));
        }
        else{
            
            if (task != 'emailtemplate.cancel' && document.formvalidator.isValid(document.id('emailtemplate-form'))) {
                
                Joomla.submitform(task, document.getElementById('emailtemplate-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>

<form action="<?php echo JRoute::_('index.php?option=com_hqcblistmailer&layout=edit&id=' . (int) $this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="emailtemplate-form" class="form-validate">
    <div class="row-fluid">
        <div class="span10 form-horizontal">
            <fieldset class="adminform">

                			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('id'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('id'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('state'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('state'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailsender'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailsender'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailsendername'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailsendername'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailsubject'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailsubject'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailcblist'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailcblist'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailtofield'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailtofield'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailtonamefield'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailtonamefield'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailccfield1'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailccfield1'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailccfield2'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailccfield2'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailccfield3'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailccfield3'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailbody'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailbody'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('emailfieldsavailable'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('emailfieldsavailable'); ?></div>
			</div>
			<div class="control-group">
				<div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
				<div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
			</div>


            </fieldset>
        </div>

        

        <input type="hidden" name="task" value="" />
        <?php echo JHtml::_('form.token'); ?>

    </div>
</form>