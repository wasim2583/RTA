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
        $this->db->select('
            user.*,
            role.role_name,
            loc.location_name, loc.state_id,
            state.state_name
            ');
        $this->db->from('irsc_users user');
        $this->db->join('irsc_user_roles role', 'role.id = user.role');
        $this->db->join('locations loc', 'loc.id = user.location');
        $this->db->join('states state', 'state.id = location.state_id');
        $this->db->where('id', $id);
        $result = $this->db->get('irsc_users');
        return $result->row_object();
    }

    public function get_user_by_loginId($loginId, $role)
    {
        if(is_numeric($loginId))
        {
            $this->db->where('mobile', $loginId);
        }
        else
        {
            $this->db->where('email', $loginId);
        }       
        $this->db->where('role', $role);
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
            user.*,
            member.aadhaar, member.address, member.gender, member.dob, member.emergency_contact, member.blood_group, member.profile_pic,
            group.blood_group_name,
            loc.location_name,
            state.state_name
            ');
        $this->db->from('irsc_users user');
        $this->db->join('irsc_members member', 'member.member_id = user.id');
        $this->db->join('blood_groups group', 'group.id = member.blood_group');
        $this->db->join('locations loc', 'loc.id = user.location');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->where('user.id', $id);
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
        
        $result = $this->db->get('irsc_users');
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
            user.*,
            partner.address, partner.profile_pic,
            org.organization_type,
            loc.location_name, loc.state_id,
            state.state_name
            ');
        $this->db->from('irsc_users user');
        $this->db->join('irsc_partners partner', 'partner.partner_id = user.id', 'left');
        $this->db->join('organizations org', 'org.id = user.organization_type');
        $this->db->join('locations loc', 'loc.id = user.location');
        $this->db->join('states state', 'state.id = loc.state_id');
        $this->db->where('user.id', $id);
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
        
        $result = $this->db->get('irsc_users');
        if($result->num_rows() == 1)
            return $result->row_object();
        else
            return false;
    }

    public function update_member($member, $member_id)
    {
        $this->db->where('member_id', $member_id);
        $this->db->update('irsc_members', $member);
        if($this->db->affected_rows() == 1)
            return true;
        else
            return false;
    }
}