<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller
{
    protected $access;
    protected $delimiter;

    public function __construct()
    {
        parent::__construct();
        $this->load->library('RoleLib');
        $this->data['menu'] = 'Group';

        $this->data['view'] = 'group';
        $this->data['slug'] = 'group';
        $this->load->model('Group_model', 'groups');
        $this->load->model('GroupMenu_model', 'group_menu');

        $this->config->load('access', TRUE);
        $this->access = $this->config->item('menu', 'access');
        $this->delimiter = $this->config->item('delimiter', 'access');

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

            $dt = $this->groups->datatables($datatables);
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
        $this->data['rolelib'] = $this->rolelib->role();
        $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
    }

    public function store()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'created_at' => timestamp()
            );

            $saved = $this->groups->saveId($data);

            foreach ($this->input->post('access') as $menu => $access) {
                $access = implode($this->delimiter, $access);
                $data = [
                    'group_id' => $saved,
                    'menu_id' => $menu,
                    'access' => $access
                ];
                $this->group_menu->save($data);
            }

            $this->session->set_flashdata('success', lang('create_success'));

            $return = array('redirect' => base_url() . $this->data['slug'] . '/index');
            echo json_encode($return);
        }
    }

    public function edit($id)
    {
        $this->data['data'] = $this->groups->find($id);
        $this->data['rolelib'] = $this->rolelib->role($id);
        $this->modal->views($this->data['view'] . '/edit', $type = "form", $this->data);
    }

    public function update($id)
    {
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->modal->views($this->data['view'] . '/create', $type = "form", $this->data);
        } else {
            $data = array(
                'name' => $this->input->post('name'),
                'description' => $this->input->post('description'),
                'updated_at' => timestamp()
            );
            $this->input->post('password') ? $data['password'] = $this->bcrypt->hash($this->input->post('password')) : '';

            $this->group_menu->deleteByGroup($id);

            foreach ($this->input->post('access') as $menu => $access) {
                $access = implode($this->delimiter, $access);
                $data = [
                    'group_id' => $id,
                    'menu_id' => $menu,
                    'access' => $access
                ];
                $this->group_menu->save($data);
            }

            $this->session->set_flashdata('success', lang('update_success'));
            $return = array('redirect' => base_url() . $this->data['slug'] . '/index');
            echo json_encode($return);
        }
    }

    public function show($id)
    {
        $this->data['data'] = $this->groups->find($id);
        $this->modal->views($this->data['view'] . '/detail', $type = "action", $this->data);
    }

    public function delete($id)
    {
        $this->data['data'] = $this->groups->find($id);
        $this->modal->views($this->data['view'] . '/delete', $type = "action", $this->data);
    }

    public function destroy($id)
    {
        $data = $this->groups->find($id);
        $this->group_menu->deleteByGroup($id);
        $this->groups->delete($data);
        $this->session->set_flashdata('success', lang('delete_success'));
        redirect($this->data['slug'] . '/index', 'refresh');
    }
}
