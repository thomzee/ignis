<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->data['menu'] = 'User';

        $this->data['view'] = 'users';
        $this->data['slug'] = 'users';
        $this->load->model('Users_model', 'users');

        $this->load->database();
    }

    public function index()
    {
        $this->template->views($this->data['view'] . '/index', $this->data, $this->data['view'] . '/scripts');
    }

    public function datatables()
    {
        if ($this->input->is_ajax_request()) {
            $datatables = $this->input->post();

            $dt = $this->users->datatables($datatables);
            $option['draw'] = $dt['draw'];
            $option['recordsTotal'] = $dt['rows_count'];
            $option['recordsFiltered'] = $dt['rows_count'];
            $option['data'] = array();

            $i = $dt['start'] + 1;
            foreach ($dt['list']->result() as $row) {
                $rows = array();

                foreach ($row as $key => $value) {
                    if ($key == 'active')
                        $rows[$key] = print_yes_no($value);
                    else
                        $rows[$key] = $value;
                }

                $action = null;
                $action .= $this->securitylib->check_access('detail', $this->data['slug']) ? '<a data-href="' . $this->data['slug'] . '/show/' . $row->id . '" class="btn btn-xs btn-success btn-modal-action" title="' . lang('detail') . '" data-title="' . sprintf(lang('form_detail'), $this->data['menu']) . '" data-icon="fa fa-search fa-fw" data-background="modal-primary">' . lang('icon_detail') . '</a> &nbsp;' : '';
                $action .= $this->securitylib->check_access('update', $this->data['slug']) ? '<a data-href="' . $this->data['slug'] . '/edit/' . $row->id . '" class="btn btn-xs btn-primary btn-modal-form" title="' . lang('edit') . '" data-title="' . sprintf(lang('form_edit'), $this->data['menu']) . '" data-icon="fa fa-edit fa-fw" data-background="modal-primary">' . lang('icon_edit') . '</a> &nbsp;' : '';
                $action .= $this->securitylib->check_access('delete', $this->data['slug']) ? '<a data-href="' . $this->data['slug'] . '/delete/' . $row->id . '" class="btn btn-xs btn-danger btn-modal-action" title="' . lang('delete') . '" data-title="' . sprintf(lang('form_delete'), $this->data['menu']) . '" data-icon="fa fa-trash-o fa-fw" data-background="modal-danger">' . lang('icon_delete') . '</a>' : '';
                $rows['action'] = $action;

                $rows['no'] = $i;
                $option['data'][] = $rows;
                $i++;
            }
            echo json_encode($option);
        }
    }

    public function create()
    {
        $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
    }

    public function store()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'password' => $this->bcrypt->hash($this->input->post('password')),
                'active' => 1,
                'created_at' => timestamp()
            );

            $this->users->save($data);
            $this->session->set_flashdata('success', lang('create_success'));

            $return = array('redirect' => base_url() . $this->data['slug'] . '/index');
            echo json_encode($return);
        }
    }

    public function edit($id)
    {
        $this->data['data'] = $this->users->find($id);
        $this->modal->views($this->data['view'] . '/edit', $type = "form", $this->data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('phone', 'Phone', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
        } else {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'updated_at' => timestamp()
            );
            $this->input->post('password') ? $data['password'] = $this->bcrypt->hash($this->input->post('password')) : '';

            $this->users->update($id, $data);
            $this->session->set_flashdata('success', lang('update_success'));

            $return = array('redirect' => base_url() . $this->data['slug'] . '/index');
            echo json_encode($return);
        }
    }

    public function show($id)
    {
        $this->data['data'] = $this->users->find($id);
        $this->modal->views($this->data['view'] . '/detail', $type = "action", $this->data);
    }

    public function delete($id)
    {
        $this->data['data'] = $this->users->find($id);
        $this->modal->views($this->data['view'] . '/delete', $type = "action", $this->data);
    }

    public function destroy($id)
    {
        $data = $this->users->find($id);
        $this->users->delete($data);
        $this->session->set_flashdata('success', lang('delete_success'));
        redirect($this->data['slug'] . '/index', 'refresh');
    }
}
