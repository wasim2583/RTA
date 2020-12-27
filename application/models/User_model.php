<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->state_id = $this->session->userdata('app_state');
    }

    public function insert_user($data)
    {
        $result = $this->db->insert('irsc_users', $data);
        return $this->db->insert_id();
    }

    public function get_user_by_id($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->get('irsc_users');
        return $result->row_object();
    }

    public function get_user_by_loginId($loginId)
    {
        if(is_numeric($loginId))
        {
            $this->db->where('mobile', $loginId);
        }
        else
        {
            $this->db->where('email', $loginId);
        }       
        
        $result = $this->db->get('irsc_users');
        if($result->num_rows() == 1)
            return $result->row_object();
        else
            return false;
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
        $this->db->from('irsc_users member');
        $this->db->join('locations loc', 'loc.id = member.location');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->where('member.id', $id);
        $result = $this->db->get();
        return $result->row_object();
    }

    public function get_member_by_loginId($loginId)
    {
        if(is_numeric($loginId))
        {
            $this->db->where('mobile', $loginId);
        }
        else
        {
            $this->db->where('email', $loginId);
        }       
        
        $result = $this->db->get('irsc_members');
        if($result->num_rows() == 1)
            return $result->row_object();
        else
            return false;
    }

    public function insert_partner($data)
    {
        $result = $this->db->insert('irsc_partners', $data);
        return $this->db->insert_id();
    }

    public function get_partner_by_id($id)
    {
        $this->db->select('
            partner.*,
            org.organization_type,
            loc.location_name, loc.state_id,
            state.state_name
            ');
        $this->db->from('irsc_partners partner');
        $this->db->join('organizations org', 'org.id = partner.organization_type');
        $this->db->join('locations loc', 'loc.id = partner.location');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->where('partner.id', $id);
        $result = $this->db->get();
        return $result->row_object();
    }

    public function get_partner_by_loginId($loginId)
    {
        if(is_numeric($loginId))
        {
            $this->db->where('mobile', $loginId);
        }
        else
        {
            $this->db->where('email', $loginId);
        }       
        
        $result = $this->db->get('irsc_partners');
        if($result->num_rows() == 1)
            return $result->row_object();
        else
            return false;
    }
}