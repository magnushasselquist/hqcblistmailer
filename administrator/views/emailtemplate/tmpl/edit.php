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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet(JUri::root() . 'media/com_hqcblistmailer/css/form.css');
?>
<script type="text/javascript">
	js = jQuery.noConflict();
	js(document).ready(function () {
		
	js('input:hidden.emailcblist').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailcblisthidden')){
			js('#jform_emailcblist option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailcblist").trigger("liszt:updated");
	js('input:hidden.emailtofield').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailtofieldhidden')){
			js('#jform_emailtofield option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailtofield").trigger("liszt:updated");
	js('input:hidden.emailtonamefield').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailtonamefieldhidden')){
			js('#jform_emailtonamefield option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailtonamefield").trigger("liszt:updated");
	js('input:hidden.emailccfield1').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailccfield1hidden')){
			js('#jform_emailccfield1 option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailccfield1").trigger("liszt:updated");
	js('input:hidden.emailccfield2').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailccfield2hidden')){
			js('#jform_emailccfield2 option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailccfield2").trigger("liszt:updated");
	js('input:hidden.emailccfield3').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailccfield3hidden')){
			js('#jform_emailccfield3 option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailccfield3").trigger("liszt:updated");
	js('input:hidden.emailfieldsavailable').each(function(){
		var name = js(this).attr('name');
		if(name.indexOf('emailfieldsavailablehidden')){
			js('#jform_emailfieldsavailable option[value="'+js(this).val()+'"]').attr('selected',true);
		}
	});
	js("#jform_emailfieldsavailable").trigger("liszt:updated");
	});

	Joomla.submitbutton = function (task) {
		if (task == 'emailtemplate.cancel') {
			Joomla.submitform(task, document.getElementById('emailtemplate-form'));
		}
		else {
			
			if (task != 'emailtemplate.cancel' && document.formvalidator.isValid(document.id('emailtemplate-form'))) {
				
				Joomla.submitform(task, document.getElementById('emailtemplate-form'));
			}
			else {
				alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
			}
		}
	}
</script>

<form
	action="<?php echo JRoute::_('index.php?option=com_hqcblistmailer&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="emailtemplate-form" class="form-validate">

	<div class="form-horizontal">
		<?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>

		<?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_HQCBLISTMAILER_TITLE_EMAILTEMPLATE', true)); ?>
		<div class="row-fluid">
			<div class="span10 form-horizontal">
				<fieldset class="adminform">

									<?php echo $this->form->renderField('id'); ?>
				<?php echo $this->form->renderField('state'); ?>
				<?php echo $this->form->renderField('emailsender'); ?>
				<?php echo $this->form->renderField('emailsendername'); ?>
				<?php echo $this->form->renderField('emailsubject'); ?>
				<?php echo $this->form->renderField('emailcblist'); ?>

			<?php
				foreach((array)$this->item->emailcblist as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailcblist" name="jform[emailcblisthidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailtofield'); ?>

			<?php
				foreach((array)$this->item->emailtofield as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailtofield" name="jform[emailtofieldhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailtonamefield'); ?>

			<?php
				foreach((array)$this->item->emailtonamefield as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailtonamefield" name="jform[emailtonamefieldhidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailccfield1'); ?>

			<?php
				foreach((array)$this->item->emailccfield1 as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailccfield1" name="jform[emailccfield1hidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailccfield2'); ?>

			<?php
				foreach((array)$this->item->emailccfield2 as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailccfield2" name="jform[emailccfield2hidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailccfield3'); ?>

			<?php
				foreach((array)$this->item->emailccfield3 as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailccfield3" name="jform[emailccfield3hidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('emailbody'); ?>
				<?php echo $this->form->renderField('emailfieldsavailable'); ?>

			<?php
				foreach((array)$this->item->emailfieldsavailable as $value): 
					if(!is_array($value)):
						echo '<input type="hidden" class="emailfieldsavailable" name="jform[emailfieldsavailablehidden]['.$value.']" value="'.$value.'" />';
					endif;
				endforeach;
			?>				<?php echo $this->form->renderField('created_by'); ?>


					<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
					<?php endif; ?>
				</fieldset>
			</div>
		</div>
		<?php echo JHtml::_('bootstrap.endTab'); ?>

		

		<?php echo JHtml::_('bootstrap.endTabSet'); ?>

		<input type="hidden" name="task" value=""/>
		<?php echo JHtml::_('form.token'); ?>

	</div>
</form>
