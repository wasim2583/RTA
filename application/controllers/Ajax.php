<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library(['form_validation', 'email']);
		$this->load->model(['Ajax_model', 'Base_model']);
	}

	public function index() {
		$this->template->load('homepage', 'base/home', $this->data);
	}

	public function ajax_search_photos()
	{
		$filtered_photos = $this->Ajax_model->get_filtered_photos($_POST);
		if( ! empty($filtered_photos))
		{
			foreach($filtered_photos as $photo)
			{
				?>
		<div class="photo_wrap">
			<a href="<?php echo base_url().'uploads/files/'.$photo->file_name; ?>" data-lightbox="gallery" target="_blank">
			<img src="<?php echo base_url().'uploads/files/'.$photo->file_name; ?>" class="img-fluid">
				</a>
			<span><?php echo $photo->name; ?></span>
			<p><?php echo $photo->description; ?><br>
			Discription Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
		</div>
				<?php
			}
		}
	}

	public function ajax_search_videos()
	{
		$filtered_videos = $this->Ajax_model->get_filtered_videos($_POST);
		if( ! empty($filtered_videos))
		{
			foreach($filtered_videos as $video)
			{
				?>
			<div class="col-6">
				<div class="embed-responsive embed-responsive-16by9">
					<?php
					$url=$video->url;
					$ytarray=explode("/", $url);
					$ytendstring=end($ytarray);
					$ytendarray=explode("?v=", $ytendstring);
					$ytendstring=end($ytendarray);
					$ytendarray=explode("&", $ytendstring);
					$ytcode=$ytendarray[0];
					echo "<iframe class=\"embed-responsive-item\" width=\"100%\" src=\"http://www.youtube.com/embed/$ytcode\" frameborder=\"0\" allowfullscreen></iframe>";
					?>
				</div>
			</div>
				<?php 
			}
		}
	}
	
	public function ajax_render_location_filters()
	{
		if(isset($_POST['states']) && count($_POST['states']) >= 1)
		{
			$locations = $this->Ajax_model->get_locations_by_states($_POST['states']);
			if(!empty($locations))
			{
				$output='';
				foreach($locations as $location)
				{
					$output .= '<li class="list-group-item"><input class="form-check-input me-1" type="checkbox" name="locations[]" value="'.$location->id.'" aria-label="...">'.$location->location_name.'</li>';
				}
				echo $output;
				exit;				
			}
		}		
	}
}

/* End of file Ajax.php */
/* Location: ./application/controllers/Ajax.php */