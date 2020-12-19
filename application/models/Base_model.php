<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Base_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->state_id = $this->session->userdata('state_id');
    }

    public function get_locations_by_state($state_id)
    {
        $this->db->select('id, location_name');
        $this->db->from('locations');
        $this->db->where('state_id', $state_id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_states()
    {
        $this->db->select('id, state_name');
        $this->db->from('states');
        $this->db->where_in('id', array(2, 35));
        $result = $this->db->get();
        return $result->result();
    }

    public function get_state_by_id($id)
    {
        $this->db->select('id, state_name');
        $this->db->from('states');
        $this->db->where('id', $id);
        $result = $this->db->get();
        return $result->row_object();
    }

    public function get_slides_by_state($id)
    {
        $this->db->select('*');
        $this->db->from('da_slider_tbl');
        $this->db->where('state_id', $id);
        $result = $this->db->get();
        return $result->result();
    }

    public function get_sliders_by_admin($id)
    {
        $this->db->select('*');
        $this->db->from('da_slider_tbl');
        $this->db->where('added_by', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function get_users($id)
    {
        $this->db->select('
            user.user_id, user.name, user.mobile, user.disignation, user.location, user.role, user.loc, user.user_status, user.registered_on,
            loc.location_name, loc.state_id,
            state.state_name,
            role.role_name
            ');
        $this->db->from('da_users_tbl user');
        $this->db->join('locations loc', 'loc.id = user.loc');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->join('roles role', 'role.id = user.role');
        $this->db->where('user.state', $id);
        $result = $this->db->get();
        return $result->result_array();
    }

    public function search_users($str)
    {
        $this->db->select('*');
        $this->db->from('da_users_tbl user');
        $this->db->join('roles r', 'r.id = user.role');
        $this->db->join('locations loc', 'loc.id = user.loc');
        $this->db->like('user.name',$str,'both');
        $this->db->or_like('disignation',$str,'both');
        $this->db->or_like('location', $str,'both');
        $this->db->or_like('r.role_name', $str,'both');
        $this->db->where('user.state', $this->state_id);
        return  $this->db->get()->result_array();
    }

    public function get_roles()
    {
        $this->db->select('id, role_name');
        $this->db->from('roles');
        $this->db->order_by('id', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_user_role_by_id($id)
    {
        $this->db->select('id, role_name');
        $this->db->from('roles');
        $this->db->where('id', $id);
        $result = $this->db->get();
        return $result->row_object();
    }

    public function get_organization_types()
    {
        $this->db->select('id, organization_type');
        $this->db->from('organizations');
        $this->db->order_by('id', 'ASC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_all_photos()
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->order_by('uploaded_on', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_photos_by_state()
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('state', $this->state_id);
        $this->db->order_by('uploaded_on', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_all_videos()
    {
        $this->db->select('*');
        $this->db->from('da_videos_tbl');
        $this->db->order_by('date', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }

    public function get_videos_by_state()
    {
        $this->db->select('*');
        $this->db->from('da_videos_tbl');
        $this->db->where('state', $this->state_id);
        $this->db->order_by('date', 'DESC');
        $result = $this->db->get();
        return $result->result();
    }
}