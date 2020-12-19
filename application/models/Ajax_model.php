<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ajax_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->state_id = $this->session->userdata('app_state');
    }

    public function get_locations_by_states($statesArray)
    {
        $this->db->select('id,location_name');
        $this->db->from('locations');
        $this->db->where('locations.status=1');
        if(isset($statesArray))
            $this->db->where_in('locations.state_id', $statesArray);
        else
            $this->db->where('locations.state_id', $this->state_id);
        $this->db->order_by('locations.location_name');
        
        $result = $this->db->get()->result_object();
        
        return $result;
    }

    public function get_filtered_videos($filtersArray)
    {
        $this->db->select('
            videos.*,
            loc.location_name, loc.state_id,
            state.state_name,
            ');
        $this->db->from('da_videos_tbl videos');        
        $this->db->join('states state', 'videos.state = state.id','left');
        $this->db->join('locations loc', 'videos.location = loc.id','left');
        
        if(isset($filtersArray['states'])){
            $this->db->where_in('videos.state',$filtersArray['states']);
        }
        else{
            $this->db->where('videos.state', $this->state_id);
        }
        if(isset($filtersArray['locations'])){
            $this->db->where_in('videos.location',$filtersArray['locations']);
        }
        /*
        if(isset($filtersArray['from_date'])){
            $this->db->where('videos.date' >= $filtersArray['from_date']);
        }
        */
        $this->db->order_by('videos.date','ASC');        
        $result = $this->db->get()->result();
        
        return $result;
    }

    public function get_filtered_photos($filtersArray)
    {
        $this->db->select('
            photos.*,
            loc.location_name, loc.state_id,
            state.state_name,
            ');
        $this->db->from('files photos');
        $this->db->join('states state', 'photos.state = state.id','left');
        $this->db->join('locations loc', 'photos.location = loc.id','left');
        
        if(isset($filtersArray['states']))
        {
            $this->db->where_in('photos.state',$filtersArray['states']);
        }
        // else
        // {
        //     $this->db->where('photos.state',$this->state_id);
        // }
        if(isset($filtersArray['locations']))
        {
            $this->db->where_in('photos.location',$filtersArray['locations']);
        }
        $this->db->order_by('photos.uploaded_on','ASC');        
        $result = $this->db->get()->result();
        
        return $result;
    }
}