<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * student controller
 */
class student extends Authenticated_Controller
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

		//$this->auth->restrict('Student.student.View');
		$this->load->model('student_model', null, true);
		$this->lang->load('student');
		
		Template::set_block('sub_nav', 'student/_sub_nav');

		Assets::add_module_js('student', 'student.js');
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
					$result = $this->student_model->delete($pid);
				}

				if ($result)
				{
					Template::set_message(count($checked) .' '. lang('student_delete_success'), 'success');
				}
				else
				{
					Template::set_message(lang('student_delete_failure') . $this->student_model->error, 'error');
				}
			}
		}

		$records = $this->student_model->find_all();

		Template::set('records', $records);
		Template::set('toolbar_title', 'Manage student');
		Template::render();
	}

	//--------------------------------------------------------------------


	/**
	 * Creates a student object.
	 *
	 * @return void
	 */
	public function create()
	{
		//$this->auth->restrict('Student.student.Create');

		if (isset($_POST['save']))
		{
			if ($insert_id = $this->save_student())
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_act_create_record') .': '. $insert_id .' : '. $this->input->ip_address(), 'student');

				Template::set_message(lang('student_create_success'), 'success');
				
				redirect('/student_session/create/'.$insert_id);
				//redirect('/student');
			}
			else
			{
				Template::set_message(lang('student_create_failure') . $this->student_model->error, 'error');
			}
		}
		Assets::add_module_js('student', 'student.js');

		Template::set('toolbar_title', lang('student_create') . ' student');
		Template::render();
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
			Template::set_message(lang('student_invalid_id'), 'error');
			redirect('/student');
		}

		if (isset($_POST['save']))
		{
			//$this->auth->restrict('Student.student.Edit');

			if ($this->save_student('update', $id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_act_edit_record') .': '. $id .' : '. $this->input->ip_address(), 'student');

				Template::set_message(lang('student_edit_success'), 'success');
			}
			else
			{
				Template::set_message(lang('student_edit_failure') . $this->student_model->error, 'error');
			}
		}
		else if (isset($_POST['delete']))
		{
			//$this->auth->restrict('Student.student.Delete');

			if ($this->student_model->delete($id))
			{
				// Log the activity
				log_activity($this->current_user->id, lang('student_act_delete_record') .': '. $id .' : '. $this->input->ip_address(), 'student');

				Template::set_message(lang('student_delete_success'), 'success');

				redirect('/student');
			}
			else
			{
				Template::set_message(lang('student_delete_failure') . $this->student_model->error, 'error');
			}
		}
		Template::set('student', $this->student_model->find($id));
		Template::set('toolbar_title', lang('student_edit') .' student');
		Template::render();
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
	private function save_student($type='insert', $id=0)
	{
		if ($type == 'update')
		{
			$_POST['id'] = $id;
		}

		// make sure we only pass in the fields we want
		
		$data = array();
		$data['first_name']        	= $this->input->post('first_name');
		$data['middle_name']        = $this->input->post('middle_name');
		$data['last_name']        	= $this->input->post('last_name');
		$data['age']        		= $this->input->post('age');
		$data['dob']        		= $this->input->post('dob');
		$data['gender']        		= $this->input->post('gender');
		$data['father_name']        = $this->input->post('father_name');
		$data['mother_name']        = $this->input->post('mother_name');
		$data['guardian']       	= $this->input->post('guardian');
		$data['address']        	= $this->input->post('address');
		$data['city']        		= $this->input->post('city');
		$data['state']        		= $this->input->post('state');
		$data['phone']        		= $this->input->post('phone');
		$data['mobile']        		= $this->input->post('mobile');
		$data['previous_school']    = $this->input->post('previous_school');
		$data['avatar']        		= $this->input->post('avatar');
		
		
		if ($type == 'insert')
		{
			$data['enrollment_no']	= $this->input->post('enrollment_no');
			$data['active'] 		= 1;
			
			$id = $this->student_model->insert($data);

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
			$return = $this->student_model->update($id, $data);
		}

		return $return;
	}

	//--------------------------------------------------------------------


}