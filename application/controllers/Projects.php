<?php

class Projects extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Project_model');
    }
    public function index()
    {
        
        
        //pagination
        $this->load->library('pagination');
        
        //config
        $config['base_url'] = 'http://localhost/project/projects/index';
        $config['total_rows'] = $this->Project_model->countProject();
        $config['per_page'] = 5;

        //styling
        $config['full_tag_open'] = '<nav><ul class="pagination">';
        $config['full_tag_close'] = '</ul></nav>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_link'] = '&raquo';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');
        
        //initialize
        $this->pagination->initialize($config);
        
        
        $data['start'] = $this->uri->segment(3);
        $data['tb_m_project'] = $this->Project_model->getAllProject($config['per_page'],$data['start']);
        
        $data['clients'] = $this->Project_model->getClient();
        $data['status'] = $this->Project_model->getStatus();
        
        if ($this->input->post('keyword')) {
            $data['tb_m_project'] = $this->Project_model->search();
        }
        if ($this->input->post('delete')) {
            $data['tb_m_project'] = $this->Project_model->delete();
        }
        $this->load->view('layouts/header');
        $this->load->view('layouts/sidebar');
        $this->load->view('projects/index', $data);
        $this->load->view('layouts/footer');
    }

    public function create()
    {
        // $data['judul'] = 'Tambah Data warga';

        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
        $this->form_validation->set_rules('project_start', 'Project Srart', 'required');
        $this->form_validation->set_rules('project_end', 'Project End', 'required');
        
        $data['clients'] = $this->Project_model->getClient();
        $data['status'] = ['OPEN', 'DOING', 'DONE'];

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar');
            $this->load->view('projects/create',$data);
            $this->load->view('layouts/footer');
        } else {
            $this->Project_model->create();
            $this->session->set_flashdata('flash', 'Ditambahkan');
            redirect('projects');
        }
    }

    public function update($project_id)
    {
        $this->form_validation->set_rules('project_name', 'Project Name', 'required');
        $this->form_validation->set_rules('project_start', 'Project Srart', 'required');
        $this->form_validation->set_rules('project_end', 'Project End', 'required');
        $this->form_validation->set_rules('project_id', 'Project Name', 'required');
        $this->form_validation->set_rules('project_status', 'Project status', 'required');
        
        $data['clients'] = $this->Project_model->getClient();
        $data['status'] = $data['status'] = ['OPEN', 'DOING', 'DONE'];
        $data['project'] = $this->Project_model->getProjectById($project_id);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layouts/header');
            $this->load->view('layouts/sidebar');
            $this->load->view('projects/update',$data);
            $this->load->view('layouts/footer');
        } else {
            $this->Project_model->update();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('projects');
        }
    }

    public function delete()
    {
        foreach($_POST['project_id'] as $project_id) {
            $this->Project_model->delete($project_id);
        }
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('projects');
    }
}