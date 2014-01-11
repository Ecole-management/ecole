<?php

$validation_errors = validation_errors();

if ($validation_errors) :
?>
<div class="alert alert-block alert-error fade in">
	<a class="close" data-dismiss="alert">&times;</a>
	<h4 class="alert-heading">Please fix the following errors:</h4>
	<?php echo $validation_errors; ?>
</div>
<?php
endif;

if (isset($student_session))
{
	$student_session = (array) $student_session;
}
$id = isset($student_session['id']) ? $student_session['id'] : '';

?>

<div class="admin-box">
	<h3>student_session</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
		<div class='controls'>
			<input id='student_id' type="hidden" name='student_id' value="<?php echo isset($student) ? $student->id : '' ?>" />
			<input type="text" disabled="disabled" value="<?php echo isset($student) ? $student->first_name." ".$student->middle_name." ".$student->last_name : ''?>">
		</div>
		<div class="control-group <?php echo form_error('session_id') ? 'error' : ''; ?>">
			<?php echo form_dropdown("session_id",$session,isset($student_session['session_id']) ? $student_session['session_id'] : '','Session'. lang('bf_form_label_required'))?>
		</div>
		<div class="control-group <?php echo form_error('section') ? 'error' : ''; ?>">
			<?php echo form_label('Section'. lang('bf_form_label_required'), 'section', array('class' => 'control-label') ); ?>
			<div class='controls'>
				<input id='section' type='text' name='section' maxlength="50" value="<?php echo set_value('section', isset($student_session['section']) ? $student_session['section'] : ''); ?>" />
			</div>
		</div>
		<div class="control-group <?php echo form_error('roll_no') ? 'error' : ''; ?>">
			<?php echo form_label('Roll no.'. lang('bf_form_label_required'), 'roll_no', array('class' => 'control-label') ); ?>
			<div class='controls'>
				<input id='roll_no' type='text' name='roll_no' maxlength="50" value="<?php echo set_value('roll_no', isset($student_session['roll_no']) ? $student_session['roll_no'] : ''); ?>" />
			</div>
		</div>
		<div class="control-group <?php echo form_error('board_roll_no') ? 'error' : ''; ?>">
			<?php echo form_label('Parents name'. lang('bf_form_label_required'), 'board_roll_no', array('class' => 'control-label') ); ?>
			<div class='controls'>
				<input id='board_roll_no' type='text' name='board_roll_no' maxlength="50" value="<?php echo set_value('board_roll_no', isset($student_session['board_roll_no']) ? $student_session['board_roll_no'] : ''); ?>" />
			</div>
		</div>
		
		<div class="control-group <?php echo form_error('optional_subject') ? 'error' : ''; ?>">
			<?php echo form_label('optional_subject name'. lang('bf_form_label_required'), 'optional_subject', array('class' => 'control-label') ); ?>
			<div class='controls'>
				<input id='optional_subject' type='text' name='optional_subject' maxlength="50" value="<?php echo set_value('optional_subject', isset($student_session['optional_subject']) ? $student_session['optional_subject'] : ''); ?>" />
			</div>
		</div>
		<div class="form-actions">
			<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('student_session_action_edit'); ?>"  />
			<?php echo lang('bf_or'); ?>
			<?php echo anchor('/student_session', lang('student_session_cancel'), 'class="btn btn-warning"'); ?>
			
			<?php if ($this->auth->has_permission('student_session.student_session.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('student_session_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('student_session_delete_record'); ?>
				</button>
			<?php endif; ?>
		</div>
    <?php echo form_close(); ?>
</div>