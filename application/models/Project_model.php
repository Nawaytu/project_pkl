<?php

class Project_model extends CI_model
{

    public function getAllProject($limit, $start)
    {
        $this->db->select('*');
        $this->db->from('tb_m_project');
        $this->db->join('tb_m_client', 'tb_m_client.client_id = tb_m_project.client_id');
        $query = $this->db->limit($limit,$start)->get();
        return $query->result_array();
    }

    public function getClient()
    {
        $this->db->select('*');
        $this->db->distinct();
        $query = $this->db->get('tb_m_client');
        return $query->result_array();
    }
    public function getStatus()
    {
        $this->db->select('project_status');
        $this->db->distinct();
        $query = $this->db->get('tb_m_project');
        return $query->result_array();
    }

    public function search()
    {
        $keyword = $this->input->post('keyword', true);
        // $client = $this->input->post('client', true);
        // $status = $this->input->post('status', true);
        $this->db->like('project_name', $keyword);
        $this->db->or_like('client_name', $keyword);
        $this->db->or_like('project_status', $keyword);
        $this->db->select('*');
        $this->db->from('tb_m_project');
        $this->db->join('tb_m_client', 'tb_m_client.client_id = tb_m_project.client_id');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function create()
    {
        $data = array(
            'project_name' => $this->input->post('project_name', true),
            'client_id' => $this->input->post('client_id', true),
            'project_start' => $this->input->post('project_start', true),
            'project_end' => $this->input->post('project_end', true),
            'project_status' => $this->input->post('project_status', true)
        );

        $this->db->insert('tb_m_project', $data);
    }

    public function delete($project_id) {
        $this->db->where('project_id', $project_id);
        $this->db->delete('tb_m_project');
    }

    public function getProjectById($project_id) {
        $this->db->select('*');
        $this->db->join('tb_m_client', 'tb_m_client.client_id = tb_m_project.client_id');
        $query = $this->db->get_where('tb_m_project', ['project_id' => $project_id])->row_array();
        return $query;
    }
    public function update() {
        $data = array(
            'project_name' => $this->input->post('project_name', true),
            'client_id' => $this->input->post('client_id', true),
            'project_start' => $this->input->post('project_start', true),
            'project_end' => $this->input->post('project_end', true),
            'project_status' => $this->input->post('project_status', true)
        );

        $this->db->where('project_id', $this->input->post('project_id'));
        $this->db->update('tb_m_project', $data);
    }

    public function countProject() {
        return $this->db->get('tb_m_project')->num_rows();
    }

}
?>