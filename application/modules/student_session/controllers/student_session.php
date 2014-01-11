<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * student controller
 */
class student_session extends Authenticated_Controller
{

	//--------------------------------------------------------------------


	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('student_session_model', null, true);
		$this->lang->load('student_session');
		
		Template::set_block('sub_nav', 'student_session/_sub_nav');

		Assets::add_module_js('student_session', 'student_session.js');
	}

	//--------------------------------------------------------------------


	/**
	 * Displays a list of form data.
	 *
	 * @return void
	 */
	public function index()
	{

		// Deleting anything?
		if (isset($_POST['delete']))
		{
			$checked = $this->input->post('checked');

			if (is_array($checked) && count($checked))
			{
				$result = FALSE;
				foreach ($checked as $pid)
				{
					$result = $this->student_session_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('student_session_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('student_session_delete_failure') . $this->student_session_model->error, 'error');
				}
			}
		}

		$records = $this->student_session_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage student session');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a student object.
	 *
	 * @return void
	 */
	public function create($id = '')
	{
		//$this->auth->restrict('Student.student.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_student_session())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_session_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'student_session');

				Template::set_message(lang('student_session_create_success'), 'success');
				redirect('/student_session');
			}
			else
			{
				Template::set_message(lang('student_session_create_failure') . $this->student_session_model->error, 'error');
			}
		}
		Assets::add_module_js('student_session', 'student_session.js');

		$this->load->model('student/student_model');
		$student = $this->student_model->find($id);
		if(!empty($student)){
			
			//TODO: create get_session_arr() function in session_model that return id as value and session name as key 
			$this->load->model('session/session_model');
			$session = $this->session_model->get_session_arr();
			
			Template::set('session',$session);
			Template::set('student',$student);
			Template::set('toolbar_title', lang('student_session_create') . ' student session');
			Template::render();
		}
		else{
			Template::set_message(lang('student_session_invalid_student'), 'error');
			redirect('/student');
		}
	}

	//--------------------------------------------------------------------


	/**
	 * Allows editing of student data.
	 *
	 * @return void
	 */
	public function edit()
	{
		$id = $this->uri->segment(3);

		if (empty($id))
		{
			Template::set_message(lang('student_session_invalid_id'), 'error');
			redirect('/student_session');
		}

		if (isset($_POST['save']))
		{
			//$this->auth->restrict('Student.student.Edit');

			if ($this->save_student_session('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_session_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'student_session');

				Template::set_message(lang('student_session_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('student_session_edit_failure') . $this->student_session_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			//$this->auth->restrict('Student.student.Delete');

			if ($this->student_session_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_session_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'student_session');

				Template::set_message(lang('student_session_delete_success'), 'success');

				redirect('/student_session');
			}
			else
			{
				Template::set_message(lang('student_session_delete_failure') . $this->student_session_model->error, 'error');
			}
		}
		
		$student_session = $this->student_session_model->find($id);
		if(!empty($student_session)){
			$this->load->model('student/student_model');
			$student = $this->student_model->find($id);
			if(!empty($student)){
				
				//TODO: create get_session_arr() function in session_model that return id as value and session name as key 
				$this->load->model('session/session_model');
				$session = $this->session_model->get_session_arr();
				
				Template::set('session',$session);
				Template::set('student',$student);
				Template::set('toolbar_title', lang('student_session_edit') .' student session');
				Template::render();
			}
		}
		else{
			Template::set_message(lang('student_session_invalid_id'), 'error');
			redirect('/student_session');
		}
		
		
	}

	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------

	/**
	 * Summary
	 *
	 * @param String $type Either "insert" or "update"
	 * @param Int	 $id	The ID of the record to update, ignored on inserts
	 *
	 * @return Mixed    An INT id for successful inserts, TRUE for successful updates, else FALSE
	 */
	private function save_student_session($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['student_id']        	= $this->input->post('student_id');
		$data['session_id']        	= $this->input->post('session_id');
		$data['section']        	= $this->input->post('section');
		$data['roll_no']        	= $this->input->post('roll_no');
		$data['board_roll_no']      = $this->input->post('board_roll_no');
		$data['optional_subject']   = $this->input->post('optional_subject');

		if ($type == 'insert')
		{
			$id = $this->student_session_model->insert($data);

			if (is_numeric($id))
			{
				$return = $id;
			}
			else
			{
				$return = FALSE;
			}
		}
		elseif ($type == 'update')
		{
			$return = $this->student_session_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}