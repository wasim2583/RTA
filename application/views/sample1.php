<?php

    public function member_insurance()
    {
        if( ! $this->session->userdata('member_id'))
        {
            redirect(base_url().'user/Member/login');
        }
        $member_id = $this->session->userdata('member_id');
        $this->data['title'] = 'Member - Insurance';
        $this->data['member'] = $this->User_model->get_member_by_id($member_id);

        $this->load->view('user/member_header', $this->data);
        $this->load->view('user/member_insurance', $this->data);
        $this->load->view('user/member_footer', $this->data);
    }

    public function update_insurance()
    {
        if( ! $this->session->userdata('member_id'))
        {
            redirect(base_url().'user/Member/login');
        }
        $member_id = $this->session->userdata('member_id');
        $this->data['title'] = 'Member - Insurance';
        $this->data['member'] = $this->User_model->get_member_by_id($member_id);

        $this->form_validation->set_rules('policy_no', 'Policy Number', 'required');
        $this->form_validation->set_rules('insurance_exp_date', 'Policy Valid Upto', 'required');
        // 
        if($this->input->post('submit') && ($this->form_validation->run() == true))
        {
            
            $member['policy_no'] = $this->input->post('policy_no');
            $member['insurance_exp_date'] = $this->input->post('insurance_exp_date');
            $config['upload_path'] = './rta_assets/member/insurance/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|docx|doc|pdf';
            $config['max_size'] = 4096;
            $this->load->library('upload', $config);
            if($this->upload->do_upload('insurance_doc'))
            {
                $fdata = $this->upload->data();                
                $member['insurance_doc'] = $fdata['file_name'];
            }
            else
            {
                $member['insurance_doc'] = $this->data['member']->insurance_doc;
                $this->upload->display_errors();
            }

            $member_update_result = $this->User_model->update_member($member, $member_id);
            // $user_update_result = $this->User_model->update_user($user, $member_id);
            if($member_update_result)
            {
                $this->session->set_flashdata('member_update_success', 'Insurance updated..');
                redirect(base_url().'user/Member/member_insurance');
            }
            else
            {
                $this->session->set_flashdata('member_update_error', 'Insurance details NOT updated..');
                redirect(base_url().'user/Member/member_insurance');
            }
        }
        else
        {
            $this->load->view('user/member_header', $this->data);
            $this->load->view('user/member_insurance_edit', $this->data);
            $this->load->view('user/member_footer', $this->data);
        }
    }