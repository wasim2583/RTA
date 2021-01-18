<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller BaseController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Base extends CI_Controller
{
		
	public function __construct() {
		parent::__construct();
		$this->load->library(['form_validation', 'email']);
		
		$this->load->model(['Base_model', 'User_model']);		
		
		$this->data['state'] = $this->Base_model->get_state_by_id($this->session->userdata('state_id'));
	}
 


	public function index() {
		$this->template->load('homepage', 'base/home', $this->data);
	}

	public function aboutUs()
	{
		$this->load->view('base/aboutUs');
	}
	public function privacy_policy()
	{
		$this->load->view('base/privacy_policy');
	}
	public function terms_conditions()
	{
		$this->load->view('base/terms_conditions');
	}
/* Abhilash Code for RTA starts */
	public function verify_activation($mode,$user_type)
	{
		$this->data['mode'] = $mode;
		$this->data['user_type'] = $user_type;
		$user_id = $this->session->userdata('member_id');
		$this->form_validation->set_rules('verificationCode', 'Activation code', 'required|min_length[6]|numeric');
				   
       	if ($this->form_validation->run() === true)
       	{
		   	$code = $this->User_model->get_activation_code($user_id);
		   	if($code == $this->input->post('verificationCode'))
		   	{
				$user_data = ['activation_code'=>'','status'=>1];
				$this->User_model->update_user($user_data, $user_id);
				redirect('base/auto_login/'.$user_type);
		   	}
		   	else
		   	{
				$this->session->set_flashdata('activation_error', 'Incorrect activation code. Please try again.');
				redirect('base/verify_activation/'.$mode.'/'.$user_type);
		   	}
	   	} 
	   	else
	   	{
			$this->data['verificationCode'] = [
				'name' => 'verificationCode',
				'id' => 'verificationCode',
				'type' => 'text',
				'class' => 'form-control',
				'value' => $this->form_validation->set_value('verificationCode'),
			];

		$this->template->load('site','user/activation_code', $this->data);

	   	} 

	}

	public function auto_login($user_type)
	{
		$member_id = $this->session->userdata('member_id');
		$member_data['member_id'] = $member_id;
		$member_data['blood_group'] = 9;
		$this->User_model->insert_member($member_data);
		$this->session->set_flashdata('member_register_success','Member registration successful!');
		redirect(base_url().'user/Member/dashboard');
	}
/* Abhilash Code for RTA ends */

/* Abhilash code starts */
	public function ajax_get_states_by_country($country_id)
	{
		$states = $this->BaseModel->get_states_by_country($country_id);
		echo json_encode($states);
		exit;
	}
/* Abhilash code ends */
	public function ajax_get_locations_by_state($state_id){

		$locations = $this->Base_model->get_locations_by_state($state_id);
		echo json_encode($locations);
		exit;

	}
public function ajax_get_departments_by_category($category_id){

		$departments = $this->BaseModel->get_departments_by_category($category_id);
		echo json_encode($departments);
		exit;

	}

	public function add_company($data){

		$result= $this->db->insert('company', $data);
	 return $this->db->insert_id();
}

public function success($type){
	
			$this->data['user_type'] = $type;   
					$this->template->load('site','base/registration_success',$this->data);
		

	
}
public function error(){
			
					$this->template->load('site','errors/error');
	
}
public function access_denied(){
			
					$this->template->load('site','errors/access_denied');
	
}

public function ajax_search_jobs(){

	$jobs = $this->BaseModel->get_filtered_jobs($_POST);
	$user = $this->session->userdata('user');
	$jobseeker_jobs = $this->JobseekerModel->get_all_jobseeker_jobs($user->id);
	
		
		$formattedJobs = array();
		if(!empty($jobseeker_jobs)){
			foreach($jobseeker_jobs as $jjob){
				$formattedJobs[$jjob->id] = $jjob;
			}
			
		}
		
	
	if(!empty($jobs)){
		echo '<h3 class="head_margin">Matched</h3>';?>
		<div role="alert" class="alert alert-info alert-dismissible fade show" style="display: none;"></div>
<?php
	 foreach($jobs as $job){ 
		
?>  
	<div class="tt-posted-jobwrap" id="jobid-<?php echo $job->jid;?>">
		<h3><?php echo $job->job_title;?></h3>
		<span class="tt-posted-btm"><?php echo $job->category_name.' &nbsp;>>&nbsp; '.$job->department_name;?></span>
		<div class="tt-posted-j-exp"><i class="fa fa-briefcase" aria-hidden="true"></i> <?php echo $job->experience_id;?> Years</div>
		<div class="tt-posted-j-loca"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $job->location_name;?></div>
		<div class="tt-posted-j-loca"><i class="fa fa-graduation-cap" aria-hidden="true"></i> <?php echo $job->qualification_name;?></div>
		<div class="tt-posted-j-loca"><i class="fa fa-inr" aria-hidden="true"></i> <?php echo $this->config->item('salary_range')[$job->salary_id];?></div>
		<div class="tt-posted-j-loca"><i class="fa fa-users" aria-hidden="true"></i> <?php echo $job->no_of_openings;?></div>
		<div class="tt-posted-j-desc dispFull">
			<span>Job Description : </span><?php echo $job->job_description;?> 
		</div>
		<div class="tt-posted-btns-wrap" >
			<span>Posted On :  <?php echo date('l d M Y h:m A  ',strtotime($job->post_date));?>  </span>
			<div class="float-right" id="jobseeker_actions">
				<?php if(!empty($formattedJobs)){
				if(array_key_exists($job->jid,$formattedJobs)) {
				if($formattedJobs[$job->jid]->saved) { ?>

				<button type="button" id="<?php echo $job->jid.'-saved';?>" class="btn btn-secondary active">Saved</button>

				<?php }
				else{ ?>

				<button type="button" id="<?php echo $job->jid.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>

				<?php } ?>
				
				<?php if($formattedJobs[$job->jid]->applied) { ?>

				<button type="button"id="<?php echo $job->jid.'-applied';?>" class="btn btn-secondary active">Applied</button>

				<?php } else { ?>

				<button type="button"id="<?php echo $job->jid.'-applied';?>" class="btn btn-secondary btn-sm">Apply</button>

				<?php }
				}
				else{?>

				<button type="button" id="<?php echo $job->jid.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
				<button type="button"id="<?php echo $job->jid.'-applied';?>" class="btn btn-secondary btn-sm">Apply</button>

				<?php }
				}
				else{ ?>
													
				<button type="button" id="<?php echo $job->jid.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
				<button type="button"id="<?php echo $job->jid.'-applied';?>" class="btn btn-secondary btn-sm">Apply</button>
													
				<?php } ?>
																								
				<button class="btn btn-success btn-sm"  id="<?php echo $job->jid.'-viewed';?>"><a target="_blank" href="<?php echo $this->config->item('base_url');?>/jobseeker/job_details/<?php echo $job->jid;?>" >View</a></button>
			</div>
		</div>
	</div>
	<?php } }

	exit;
}

/* Abhilash Code Starts */
/*
	public function ajax_search_jobseekers()
	{
		$filtered_jobseekers = $this->BaseModel->get_filtered_jobseekers($_POST);
		$user = $this->session->userdata('user');
		$recruiter_jobseekers = $this->JobseekerModel->get_all_recruiter_jobseekers($user->id);
		$jobseekers = array();
		$formattedJobseekers = array();
		if( ! empty($recruiter_jobseekers))
		{
			foreach($recruiter_jobseekers as $rec_js)
			{
				$formattedJobseekers[$rec_js->user_id] = $rec_js;
			}
		}
		if( ! empty($filtered_jobseekers))
		{
			foreach($filtered_jobseekers as $filter_js)
			{
				$jobseekers[$filter_js->user_id] = $filter_js;
			}
		}

		if( ! empty($jobseekers))
		{
			?>
		<h3 class="head_margin">Matched</h3>
		<div role="alert" class="alert alert-info alert-dismissible fade show" style="display: none;"></div>
			<?php
			echo '<h3 class="head_margin">'.count($jobseekers).' Profiles found..</h3>';
			foreach($jobseekers as $jobseeker)
			{
				?>
		<div class="tt-posted-jobwrap" id="jobid-<?php echo $jobseeker->user_id;?>">
			<h3><?php echo $jobseeker->fullname; ?></h3>
			<div class="tt-posted-j-exp">
				<i class="fa fa-briefcase" aria-hidden="true"></i>
				<?php echo ! empty($jobseeker->experience) ? $this->config->item('experience_range')[$jobseeker->experience] : 'Fresher'; ?>
			</div>
			<div class="tt-posted-j-loca">
				<i class="fa fa-map-marker" aria-hidden="true"></i>
				<?php echo $jobseeker->location_name; ?>
			</div>
			<div class="tt-posted-j-loca">
				<i class="fa fa-graduation-cap" aria-hidden="true"></i>
				<?php echo $jobseeker->qualification_name; ?>
			</div>
			<div class="tt-posted-j-loca">
				<i class="fa fa-male" aria-hidden="true"></i>
				<?php echo $jobseeker->gender; ?>
			</div>
			<div class="tt-posted-j-loca">
				<i class="fa fa-user-circle-o" aria-hidden="true"></i>
				<?php echo !empty($jobseeker->dob) ? date_diff(date_create(date('d-M-Y',$jobseeker->dob)), date_create('today'))->y.' Years' : "N/A"; ?>
			</div>
			<div class="tt-posted-j-desc dispFull">
				<span>Skills : </span> <?php echo $jobseeker->skills; ?>
			</div>
			<div class="tt-posted-btns-wrap" >
				<span>Registered on :  <?php echo date('l d M Y h:m A  ',strtotime($jobseeker->created_on));?>  </span>
				<div class="float-right" id="business_user_actions">
					<?php
					if( ! empty($formattedJobseekers))
					{
						if(array_key_exists($jobseeker->user_id, $formattedJobseekers))
						{
							if($formattedJobseekers[$jobseeker->user_id]->saved)
							{
								?>
					<button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm active">Saved</button>
								<?php
							}
							else
							{
								?>
					<button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
								<?php
							}
							if($formattedJobseekers[$jobseeker->user_id]->replied)
							{
								?>
					<button type="button"id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm active">Replied</button>
								<?php
							}
							else
							{
								?>
					<button type="button"id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
								<?php
							}
							if($formattedJobseekers[$jobseeker->user_id]->downloaded)
							{
								?>
					<button type="button"id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm active">Downloaded</button>
								<?php
							}
							else
							{
								?>
					<button type="button"id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
								<?php
							}
						}
						else
						{
							?>
					<button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
					<button type="button"id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
					<button type="button"id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
							<?php
						}
					}
					else
					{
						?>
					<button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
					<button type="button"id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
					<button type="button"id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
						<?php
					}
					?>
					<button class="btn btn-success btn-sm" id="<?php echo $jobseeker->user_id.'-viewed';?>">View</button>
				</div>
			</div>
		</div>
				<?php
			}
		}
		exit;
	}

	public function ajax_set_jobseeker_action($jobseeker_id, $action)
	{
		if( ! empty($jobseeker_id) && ! empty($action))
		{
			$user = $this->session->userdata('user');
			// print_r($user);
			//check if there is already a record exist for this user and job combination
			if($this->JobseekerModel->get_recruiter_jobseeker($jobseeker_id, $user->id))
			{
				$this->JobseekerModel->update_recruiter_jobseeker_action($jobseeker_id, $action, $user->id);
			}
			else
			{
				$this->JobseekerModel->insert_recruiter_jobseeker_action($jobseeker_id, $action, $user->id);
			}
		}
	}

	public function ajax_get_jobseekers_by_action($action)
	{
		$jobseekers_by_action = $this->JobseekerModel->get_jobseekers_by_action($action);
		$jobseekers = [];
		if( ! empty($jobseekers_by_action))
		{
			foreach($jobseekers_by_action as $jobseeker)
			{
				$jobseekers[$jobseeker->user_id] = $jobseeker;
			}
		}
		$user = $this->session->userdata('user');
		// $jobseekers = $this->JobseekerModel->get_jobseekers_by_action($action);
		$recruiter_jobseekers = $this->JobseekerModel->get_all_recruiter_jobseekers($user->id);
		$recruiterJobseekers = array();
		if( ! empty($recruiter_jobseekers))
		{
			foreach($recruiter_jobseekers as $rec_js)
			{
				$recruiterJobseekers[$rec_js->user_id] = $rec_js;
			}
		}

		if( ! empty($jobseekers))
		{
			echo '<h3 class="head_margin">'.ucfirst($action).'</h3>';
			foreach($jobseekers as $jobseeker)
			{
				?>
				<div class="tt-posted-jobwrap">
                   <h3><?php echo $jobseeker->fullname; ?></h3>
                   <div class="tt-posted-j-exp">
                      <i class="fa fa-briefcase" aria-hidden="true"></i>
                      <?php echo ! empty($jobseeker->experience) ? $this->config->item('experience_range')[$jobseeker->experience] : 'Fresher'; ?>
                   </div>
                   <div class="tt-posted-j-loca">
                      <i class="fa fa-map-marker" aria-hidden="true"></i>
                      <?php echo $jobseeker->location_name; ?>
                   </div>
                   <div class="tt-posted-j-loca">
                      <i class="fa fa-graduation-cap" aria-hidden="true"></i>
                      <?php echo $jobseeker->qualification_name; ?>
                   </div>
                   <div class="tt-posted-j-loca">
                      <i class="fa fa-male" aria-hidden="true"></i>
                      <?php echo $jobseeker->gender; ?>
                   </div>
                   <div class="tt-posted-j-loca">
                      <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                      <?php echo ! empty($jobseeker->dob) ? date_diff(date_create(date('d-M-Y',$jobseeker->dob)), date_create('today'))->y.' Years' : "N/A"; ?>
                   </div>
                   <div class="tt-posted-j-desc dispFull">
                      <span>Skills : </span> <?php echo $jobseeker->skills; ?>
                   </div>
                   <div class="tt-posted-btns-wrap">
                      <span>Registered on :  <?php echo date('l d M Y h:m A  ',strtotime($jobseeker->created_on));?>  </span>
                      <div class="float-right" id="business_user_actions">
                         <?php
                         if( ! empty($recruiterJobseekers))
                         {
                            if(array_key_exists($jobseeker->user_id, $recruiterJobseekers))
                            {
                               if($recruiterJobseekers[$jobseeker->user_id]->saved)
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm active">Saved</button>
                                  <?php
                               }
                               else
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
                                  <?php
                               }
                               if($recruiterJobseekers[$jobseeker->user_id]->replied)
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm active">Replied</button>
                                  <?php
                               }
                               else
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
                                  <?php
                               }
                               if($recruiterJobseekers[$jobseeker->user_id]->downloaded)
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm active">Downloaded</button>
                                  <?php
                               }
                               else
                               {
                                  ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
                                  <?php
                               }
                            }
                            else
                            {
                               ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
                               <?php
                            }
                         }
                         else
                         {
                            ?>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-saved';?>" class="btn btn-secondary btn-sm">Save</button>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-replied';?>" class="btn btn-secondary btn-sm">Reply</button>
                         <button type="button" id="<?php echo $jobseeker->user_id.'-downloaded';?>" class="btn btn-secondary btn-sm">Download</button>
                            <?php
                         }
                         ?>
                         <button class="btn btn-success btn-sm" id="<?php echo $jobseeker->user_id.'-viewed';?>" href="<?php echo $this->config->item('base_url');?>/employer/jobseeker_details/<?php echo $jobseeker->user_id;?>">View</button>
                      </div>
                   </div>
                </div>
                <?php
			}
		}
	}

	public function ajax_search_contractors_team()
	{
		$category = $this->BaseModel->get_category_by_name('Contractor');
		$departments = $this->BaseModel->get_departments_by_category($category->id);
		$contractors_team = $this->BaseModel->get_filtered_recruiters_team($_POST, $category->id);
		$contractors = $this->BaseModel->get_filtered_recruiters($_POST, 'contractor');

		if( ! empty($contractors))
		{
			foreach($contractors as $contractor)
			{
				$contractor_locations[$contractor->loc_id] = $contractor;
			}
		}
		else
		{
			$contractor_locations = [];
		}

		if( ! empty($contractors_team))
		{
			foreach($contractors_team as $team)
			{
				$team_locations[$team->loc_id] = $team;
			}
		}
		else
		{
			$team_locations = [];
		}

		$recruiter_locations = array_merge($contractor_locations, $team_locations);

		if( ! empty($recruiter_locations))
		{
			foreach($recruiter_locations as $rec_location)
			{
				$locations[$rec_location->loc_id] = $rec_location;
			}
		}
		else
		{
			$locations = [];
		}

		$contractors_count = 0;
		if( ! empty($locations))
		{
			foreach($locations as $loc)
			{
				$contractors[$loc->loc_id] = $this->ContractorModel->get_contractors_by_location($loc->loc_id);
				$contractors_count += count(($contractors[$loc->loc_id]));
				foreach($departments as $dept)
				{
					$employees[$loc->loc_id][$dept->department_name] = $this->UserModel->get_employees_by_location($dept->id, $loc->loc_id);
				}
			}			
		}
		else
		{
			$employees = [];
			$contractors_count = 0;
		}
		$all_contractors = $contractors_count;
		?>
		<h3 class="paddTB15"><?php echo ! empty($all_contractors) ? $all_contractors : 0; ?> Contractors Found</h3>
		<!-- <img src="<?php echo $this->config->item('asset_url');?>/images/loading.gif" id="search_loader" style="display:none;"/> -->
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">S.No</th>
					<th scope="col">Location</th>
					<th scope="col">Contractors</th>
					<?php
					foreach($departments as $dept)
					{
						?>
					<th scope="col"><?php echo $dept->department_name; ?></th>
						<?php
					}
					?>
				</tr>
			</thead>
			<?php
			if( ! empty($locations))
			{
				$i = 1;
				?>
			<tbody>
				<?php
				foreach($locations as $loc)
				{
					?>
				<tr>
					<th scope="row"><?php echo $i; ?></th>
					<td><?php echo $loc->location_name; ?></td>
					<td><?php echo ! empty($contractors[$loc->loc_id]) ? count($contractors[$loc->loc_id]) : 0; ?></td>
					<?php
					foreach($departments as $dept)
					{
						?>
					<td><?php echo ! empty($employees[$loc->loc_id][$dept->department_name]) ? count($employees[$loc->loc_id][$dept->department_name]) : 0; ?></td>
						<?php
					}
					?>
				</tr>
					<?php
					$i++;
				}
				?>
			</tbody>
				<?php
			}
			?>
		</table>
		<?php
	}

	public function ajax_search_suppliers_team()
	{
		$category = $this->BaseModel->get_category_by_name('Supplier');
		$departments = $this->BaseModel->get_departments_by_category($category->id);
		$suppliers_team = $this->BaseModel->get_filtered_recruiters_team($_POST, $category->id);
		$suppliers = $this->BaseModel->get_filtered_recruiters($_POST, 'supplier');

		if( ! empty($suppliers))
		{
			foreach($suppliers as $supplier)
			{
				$supplier_locations[$supplier->loc_id] = $supplier;
			}
		}
		else
		{
			$supplier_locations = [];
		}

		if( ! empty($suppliers_team))
		{
			foreach($suppliers_team as $team)
			{
				$team_locations[$team->loc_id] = $team;
			}
		}
		else
		{
			$team_locations = [];
		}

		$recruiter_locations = array_merge($supplier_locations, $team_locations);

		if( ! empty($recruiter_locations))
		{
			foreach($recruiter_locations as $rec_location)
			{
				$locations[$rec_location->loc_id] = $rec_location;
			}
		}
		else
		{
			$locations = [];
		}

		$suppliers_count = 0;
		if( ! empty($locations))
		{
			foreach($locations as $loc)
			{
				$suppliers[$loc->loc_id] = $this->SupplierModel->get_suppliers_by_location($loc->loc_id);
				$suppliers_count += count(($suppliers[$loc->loc_id]));
				foreach($departments as $dept)
				{
					$employees[$loc->loc_id][$dept->department_name] = $this->UserModel->get_employees_by_location($dept->id, $loc->loc_id);
				}
			}			
		}
		else
		{
			$employees = [];
			$suppliers_count = 0;
		}
		$all_suppliers = $suppliers_count;
		?>
		<h3 class="paddTB15"><?php echo ! empty($all_suppliers) ? $all_suppliers : 0; ?> Suppliers Found</h3>
		<!-- <img src="<?php echo $this->config->item('asset_url');?>/images/loading.gif" id="search_loader" style="display:none;"/> -->
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">S.No</th>
					<th scope="col">Location</th>
					<th scope="col">Suppliers</th>
					<?php
					foreach($departments as $dept)
					{
						?>
					<th scope="col"><?php echo $dept->department_name; ?></th>
						<?php
					}
					?>
				</tr>
			</thead>
			<?php
			if( ! empty($locations))
			{
				$i = 1;
				?>
			<tbody>
				<?php
				foreach($locations as $loc)
				{
					?>
				<tr>
					<th scope="row"><?php echo $i; ?></th>
					<td><?php echo $loc->location_name; ?></td>
					<td><?php echo ! empty($suppliers[$loc->loc_id]) ? count($suppliers[$loc->loc_id]) : 0; ?></td>
					<?php
					foreach($departments as $dept)
					{
						?>
					<td><?php echo ! empty($employees[$loc->loc_id][$dept->department_name]) ? count($employees[$loc->loc_id][$dept->department_name]) : 0; ?></td>
						<?php
					}
					?>
				</tr>
					<?php
					$i++;
				}
				?>
			</tbody>
				<?php
			}
			?>
		</table>
		<?php
	}

	public function ajax_search_harvesters_team()
    {
        $category = $this->BaseModel->get_category_by_name('Harvester');
        $departments = $this->BaseModel->get_departments_by_category($category->id);
        $harvesters_team = $this->BaseModel->get_filtered_recruiters_team($_POST, $category->id);
        $harvesters = $this->BaseModel->get_filtered_recruiters($_POST, 'harvester');

        if( ! empty($harvesters))
        {
            foreach($harvesters as $harvester)
            {
                $harvester_locations[$harvester->loc_id] = $harvester;
            }
        }
        else
        {
            $harvester_locations = [];
        }

        if( ! empty($harvesters_team))
        {
            foreach($harvesters_team as $team)
            {
                $team_locations[$team->loc_id] = $team;
            }
        }
        else
        {
            $team_locations = [];
        }

        $recruiter_locations = array_merge($harvester_locations, $team_locations);

        if( ! empty($recruiter_locations))
        {
            foreach($recruiter_locations as $rec_location)
            {
                $locations[$rec_location->loc_id] = $rec_location;
            }
        }
        else
        {
            $locations = [];
        }

        $harvesters_count = 0;
        if( ! empty($locations))
        {
            foreach($locations as $loc)
            {
                $harvesters[$loc->loc_id] = $this->HarvesterModel->get_harvesters_by_location($loc->loc_id);
                $harvesters_count += count(($harvesters[$loc->loc_id]));
                foreach($departments as $dept)
                {
                    $employees[$loc->loc_id][$dept->department_name] = $this->UserModel->get_employees_by_location($dept->id, $loc->loc_id);
                }
            }           
        }
        else
        {
            $employees = [];
            $harvesters_count = 0;
        }
        $all_harvesters = $harvesters_count;
        ?>
        <h3 class="paddTB15"><?php echo ! empty($all_harvesters) ? $all_harvesters : 0; ?> Farm Owners Found</h3>
        <!-- <img src="<?php echo $this->config->item('asset_url');?>/images/loading.gif" id="search_loader" style="display:none;"/> -->
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Location</th>
                    <th scope="col">Farm Owners</th>
                    <?php
                    foreach($departments as $dept)
                    {
                        ?>
                    <th scope="col"><?php echo $dept->department_name; ?></th>
                        <?php
                    }
                    ?>
                </tr>
            </thead>
            <?php
            if( ! empty($locations))
            {
                $i = 1;
                ?>
            <tbody>
                <?php
                foreach($locations as $loc)
                {
                    ?>
                <tr>
                    <th scope="row"><?php echo $i; ?></th>
                    <td><?php echo $loc->location_name; ?></td>
                    <td><?php echo ! empty($harvesters[$loc->loc_id]) ? count($harvesters[$loc->loc_id]) : 0; ?></td>
                    <?php
                    foreach($departments as $dept)
                    {
                        ?>
                    <td><?php echo ! empty($employees[$loc->loc_id][$dept->department_name]) ? count($employees[$loc->loc_id][$dept->department_name]) : 0; ?></td>
                        <?php
                    }
                    ?>
                </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
                <?php
            }
            ?>
        </table>
        <?php
    }


	public function ajax_render_departments_filters(){

		if(isset($_POST['categories']) && count($_POST['categories']) >= 1){
			$departments = $this->BaseModel->get_departments_by_categories($_POST['categories']);
			if(!empty($departments)){
				$output='';
				foreach($departments as $department){
					$output.='<div class="tt-colapse-Inwrap"><input type="checkbox" name="departments[]" value="'.$department->id.'"><label>'.$department->department_name.'</label></div>';
				}
				echo $output;
				exit;
				
			}
		}
		
	}

*/
	public function contactus()
	{
		$this->form_validation->set_rules('role', 'Role', 'required');
		$this->form_validation->set_rules('fullname', 'Full Name', 'required|trim');
		$this->form_validation->set_rules('mobile', 'Mobile Number', 'required|trim|exact_length[10]');
		$this->form_validation->set_rules('email', 'Email ID', 'required|trim|valid_email');
		$this->form_validation->set_rules('message', 'Message', 'required|trim');
		if($this->form_validation->run() == TRUE)
		{
			$role = $this->input->post('role');
			$name = $this->input->post('fullname');
			$mobile = $this->input->post('mobile');
			$email = $this->input->post('email');
			$message = $this->input->post('message');

			$email_from = $email;
			$email_from_name = $name;
			$email_message = $message;
			$email_subject = 'SeafoodsJob Enquiry';
			$this->load->library('email');
			$this->email->from($email_from, $email_from_name);
			$this->email->to($this->config->item('email_enquiry'));
			//$ci->email->cc('another@another-example.com');
			//$ci->email->bcc('them@their-example.com');
			$this->email->subject($email_subject);
			$this->email->message($email_message);
		 
			if($this->email->send())
			{
				$this->session->set_tempdata('contact_success', 'Sent your message successfully!', 2);
			}
			else
			{
				$this->session->set_tempdata('contact_error', 'Error, Sorry there was an error sending your form.', 2);
			}
			redirect(base_url().'#contactsec');
		}
		else
		{
			$this->template->load('homepage', 'base/home', $this->data);
		}
	}
/* Abhilash code ends */
}

/* End of file BaseController.php */
/* Location: ./application/controllers/BaseController.php */