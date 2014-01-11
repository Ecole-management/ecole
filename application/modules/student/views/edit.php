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

if (isset($student))
{
	$student = (array) $student;
}
$id = isset($student['id']) ? $student['id'] : '';

?>

<div class="admin-box">
	<h3>Student</h3>
	<?php echo form_open($this->uri->uri_string(), 'class="form-horizontal"'); ?>
			<div class="control-group <?php echo form_error('enrollment_no') ? 'error' : ''; ?>">
				<?php echo form_label('Enrollment No.', 'enrollment_no', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='enrollment_no' disabled="disabled" type='text' value="<?php echo $student['enrollment_no'] ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('first_name') ? 'error' : ''; ?>">
				<?php echo form_label('Name'. lang('bf_form_label_required'), 'first_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='first_name' type='text' placeholder="First name" name='first_name' maxlength="50" value="<?php echo set_value('first_name', isset($student['first_name']) ? $student['first_name'] : ''); ?>" />
					<input id='middle_name' type='text' placeholder="Middle name" name='middle_name' maxlength="50" value="<?php echo set_value('last_name', isset($student['middle_name']) ? $student['middle_name'] : ''); ?>" />
					<input id='last_name' type='text' placeholder="Last name" name='last_name' maxlength="50" value="<?php echo set_value('last_name', isset($student['last_name']) ? $student['last_name'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('dob') ? 'error' : ''; ?>">
				<?php echo form_label('DOB'. lang('bf_form_label_required'), 'dob', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='dob' type='date' name='dob' value="<?php echo set_value('dob', isset($student['dob']) ? $student['dob'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('gender') ? 'error' : ''; ?>">
				<?php echo form_label('Gender', 'gender', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<label class="radio inline"><input type="radio" name='gender' value="m" checked="checked" />Male</label>
					<label class="radio inline"><input type="radio" name='gender' value="f" />Female</label>
				</div>
			</div>
			
			<div class="control-group <?php echo form_error('father_name') ? 'error' : ''; ?>">
				<?php echo form_label('Parents name'. lang('bf_form_label_required'), 'father_name', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='father_name' type='text' placeholder="Father name" name='father_name' maxlength="50" value="<?php echo set_value('father_name', isset($student['father_name']) ? $student['father_name'] : ''); ?>" />
					<input id='mother_name' type='text' placeholder="Mother name" name='mother_name' maxlength="50" value="<?php echo set_value('mother_name', isset($student['mother_name']) ? $student['mother_name'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('guardian') ? 'error' : ''; ?>">
				<?php echo form_label('Guardian name'. lang('bf_form_label_required'), 'guardian', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='guardian' type='text' name='guardian' maxlength="50" value="<?php echo set_value('guardian', isset($student['guardian']) ? $student['guardian'] : ''); ?>" />
				</div>
			</div>
		
			<div class="control-group <?php echo form_error('address') ? 'error' : ''; ?>">
				<?php echo form_label('Address'. lang('bf_form_label_required'), 'address', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<textarea rows="" cols="" id='address' name='address'><?php echo set_value('address', isset($student['address']) ? $student['address'] : ''); ?></textarea>
				</div>
			</div>
			<div class="control-group <?php echo form_error('city') ? 'error' : ''; ?>">
				<?php echo form_label('Place', 'city', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='city' type='text' placeholder="City" name='city' maxlength="50" value="<?php echo set_value('city', isset($student['city']) ? $student['city'] : ''); ?>" />
					<input id='state' type='text' placeholder="State" name='state' maxlength="50" value="<?php echo set_value('state', isset($student['state']) ? $student['state'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('phone') ? 'error' : ''; ?>">
				<?php echo form_label('Contact No.'. lang('bf_form_label_required'), 'phone', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='phone' type='text' placeholder="Phone" name='phone' maxlength="15" value="<?php echo set_value('phone', isset($student['phone']) ? $student['phone'] : ''); ?>" />
					<input id='mobile' type='text' placeholder="Mobile" name='mobile' maxlength="15" value="<?php echo set_value('mobile', isset($student['mobile']) ? $student['mobile'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('prevoius_school') ? 'error' : ''; ?>">
				<?php echo form_label('Prevoius school', 'prevoius_school', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='prevoius_school' type='text' name='prevoius_school' maxlength="100" value="<?php echo set_value('prevoius_school', isset($student['prevoius_school']) ? $student['prevoius_school'] : ''); ?>" />
				</div>
			</div>
			<div class="control-group <?php echo form_error('avatar') ? 'error' : ''; ?>">
				<?php echo form_label('Avatar'. lang('bf_form_label_required'), 'avatar', array('class' => 'control-label') ); ?>
				<div class='controls'>
					<input id='avatar' type="file" name='avatar'/>
				</div>
			</div>
			<div class="form-actions">
				<input type="submit" name="save" class="btn btn-primary" value="<?php echo lang('student_action_edit'); ?>"  />
				<?php echo lang('bf_or'); ?>
				<?php echo anchor('/student', lang('student_cancel'), 'class="btn btn-warning"'); ?>
				
			<?php if ($this->auth->has_permission('Student.student.Delete')) : ?>
				or
				<button type="submit" name="delete" class="btn btn-danger" id="delete-me" onclick="return confirm('<?php e(js_escape(lang('student_delete_confirm'))); ?>'); ">
					<span class="icon-trash icon-white"></span>&nbsp;<?php echo lang('student_delete_record'); ?>
				</button>
			<?php endif; ?>
			</div>
		</fieldset>
    <?php echo form_close(); ?>
</div>