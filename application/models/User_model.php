<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->state_id = $this->session->userdata('app_state');
    }

    public function insert_member($data)
    {
        $result = $this->db->insert('irsc_members', $data);
        return $this->db->insert_id();
    }

    public function get_member_by_id($id)
    {
        $this->db->select('
            member.*,
            loc.location_name, loc.state_id,
            state.state_name
            ');
        $this->db->from('irsc_members member');
        $this->db->join('locations loc', 'loc.id = member.location');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->where('member.id', $id);
        $result = $this->db->get();
        return $result->row_object();
    }

    public function insert_partner($data)
    {
        $result = $this->db->insert('irsc_partners', $data);
        return $this->db->insert_id();
    }

    public function get_partner_by_id($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('irsc_partners');
        return $result->row_object();
    }
}