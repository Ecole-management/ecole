<ul class="nav nav-pills">
	<li <?php echo $this->uri->segment(2) == '' ? 'class="active"' : '' ?>>
		<a href="<?php echo site_url('/student_session') ?>" id="list"><?php echo lang('student_session_list'); ?></a>
	</li>
	<?php //if ($this->auth->has_permission('student_session.student_session.Create')) : ?>
	<li <?php echo $this->uri->segment(2) == 'create' ? 'class="active"' : '' ?> >
		<a href="<?php echo site_url('/student_session/create') ?>" id="create_new"><?php echo lang('student_session_new'); ?></a>
	</li>
	<?php //endif; ?>
</ul>