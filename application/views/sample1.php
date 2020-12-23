<?php

    public function login()
    {
        if($this->session->userdata('partner_id'))
        {
            redirect(base_url().'user/Member/dashboard');
        }
        $this->data['title'] = 'Member Login';
        
        $this->form_validation->set_rules('loginId', 'Login ID','required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() === TRUE)
        {
            $loginId = $this->input->post('loginId');
            $password = $this->input->post('password');
            $partner = $this->User_model->get_partner_by_loginId($loginId);
            
            if($partner)
            {
                if(password_verify($password, $partner->password))
                {
                    $this->session->set_userdata('partner_id', $partner->id);
                    
                    redirect(base_url().'user/Member/dashboard');
                }
                else
                {
                    $this->session->set_flashdata('login_error', 'Wrong Password');
                    redirect(current_url());
                }
            }
            else
            {
                $this->session->set_flashdata('login_error', 'Invalid Credentials');
                redirect(current_url());
            }
        }
        else
        {
            $this->load->view('user/partner_login');
        }
    }

    public function profile()
    {
        $partner_id = $this->session->userdata('partner_id');
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);
        $this->load->view('user/partner', $this->data);
    }

    public function dashboard()
    {
        $partner_id = $this->session->userdata('partner_id');
        $this->data['partner'] = $this->User_model->get_partner_by_id($partner_id);
        $this->load->view('user/partner_header', $this->data);
        $this->load->view('user/partner_dashboard', $this->data);
        $this->load->view('user/partner_footer', $this->data);
    }

    public function logout()
    {
        $this->session->unset_userdata('partner_id');
        redirect(base_url().'Home/home');
    }