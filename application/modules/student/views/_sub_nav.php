<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url('/student') ?>" id="list"><?php echo lang('student_list'); ?></a>
	</li>
	<?php //if ($this->auth->has_permission('Student.student.Create')) : ?>
	<li <?php echo $this->uri->segment(2) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url('/student/create') ?>" id="create_new"><?php echo lang('student_new'); ?></a>
	</li>
	<?php //endif; ?>
</ul>