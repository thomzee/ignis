<?php
/**
 * Created by PhpStorm.
 * User: thomzee
 * Date: 31/01/18
 * Time: 01.22
 */

class RoleLib
{
    protected $_ci;
    protected $access;
    protected $delimiter;

    function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->model('Menu_model', 'menu');
        $this->_ci->load->model('group_menu/GroupMenu_model', 'group_menu');
        $this->_ci->load->library('TreeLib');

        $this->_ci->config->load('access', TRUE);
        $this->access = $this->_ci->config->item('menu', 'access');
        $this->delimiter = $this->_ci->config->item('delimiter', 'access');
    }

    public function role($role = null, $info = false)
    {
        $tree = $this->_ci->menu->roleLib();
        $tree = $this->_ci->treelib->arrayTree($tree);

        $html  = '<ul class="list-group">';
        $html .= $this->treeRole($tree, $role, $info);
        $html .= '</ul>';

        return $html;
    }

    public function treeRole(array $array, $role = null, $info = false, &$html = null)
    {
        foreach ($array as $value) {
            $children = false;

            if (isset($value['children']) && sizeof($value['children']) > 0) {
                $children = true;
            }

            $html .= '<li class="list-group-item">';

            if ($value['icon'] != null) {
                $html .= print_icon($value['icon']);
            }

            $html .= '&nbsp;'.$value['name'];

            if (! $children && $value['slug']!=null && $value['controller']!=null && $value['model']!=null) {
                $access = $this->access[$value['slug']]['action'];
                $index = $this->access[$value['slug']]['index'];
                if ($role != null) {
                    $haveAccess = [];
                    foreach (
                        $this->_ci->group_menu->roleLib($role, $value['id'])
                        as $rolemenu
                    ) {
                        $haveAccess = explode($this->delimiter, $rolemenu->access);
                    }
                    if ($info) {
                        $html .= '<ul class="action">';
                        foreach ($access as $action) {
                            if (in_array($action, $haveAccess)) {
                                $html .= '<li class="text-success">';
                                $html .= '<i class="fa fa-check fa-fw"></i>';
                                if ($action==$index) {
                                    $html .= '&nbsp;<strong>'.ucwords($action).'</strong>';
                                } else {
                                    $html .= '&nbsp;'.ucwords($action);
                                }
                                $html .= '</li>';
                            } else {
                                $html .= '<li class="text-danger">';
                                $html .= '<i class="fa fa-times fa-fw"></i>';
                                if ($action==$index) {
                                    $html .= '&nbsp;<strong>'.ucwords($action).'</strong>';
                                } else {
                                    $html .= '&nbsp;'.ucwords($action);
                                }
                                $html .= '</li>';
                            }
                        }
                        $html .= '</ul>';
                    } else {
                        $html .= '<ul class="action">';
                        foreach ($access as $action) {
                            $html .= '<li>';
                            $html .= '<div class="checkbox">';
                            $html .= '<label>';
                            if ($action==$index) {
                                $html .= '<input type="checkbox" name="access['.$value['id'].'][]" value="'.$action.'"'.(in_array($action, $haveAccess) ? ' checked' : '').' class="primary">';
                                $html .= '&nbsp;<strong>'.ucwords($action).'</strong>';
                            } else {
                                $html .= '<input type="checkbox" name="access['.$value['id'].'][]" value="'.$action.'"'.(in_array($action, $haveAccess) ? ' checked' : '').'>';
                                $html .= '&nbsp;'.ucwords($action);
                            }
                            $html .= '</label>';
                            $html .= '</div>';
                            $html .= '</li>';
                        }
                        $html .= '</ul>';
                    }
                } else {
                    $html .= '<ul class="action">';
                    foreach ($access as $action) {
                        $html .= '<li>';
                        $html .= '<div class="checkbox">';
                        $html .= '<label>';
                        if ($action==$index) {
                            $html .= '<input type="checkbox" name="access['.$value['id'].'][]" value="'.$action.'" checked class="primary">';
                            $html .= '&nbsp;<strong>'.ucwords($action).'</strong>';
                        } else {
                            $html .= '<input type="checkbox" name="access['.$value['id'].'][]" value="'.$action.'" checked>';
                            $html .= '&nbsp;'.ucwords($action);
                        }
                        $html .= '</label>';
                        $html .= '</div>';
                        $html .= '</li>';
                    }
                    $html .= '</ul>';
                }
            }

            if ($children && $value['slug']==null && $value['controller']==null && $value['model']==null && ! $info) {
                $html .= '<div class="checkbox check_all_content">';
                $html .= '<label>';
                $html .= '<input type="checkbox" class="check_all">&nbsp;'.lang('check_all');
                $html .= '</label>';
                $html .= '</div>';
            }

            $html .= '</li>';

            if ($children) {
                $html .= '<li class="list-group-item children">';
                $html .= '<ul class="list-group">';
                $this->treeRole($value['children'], $role, $info, $html);
                $html .= '</ul>';
                $html .= '</li>';
            }
        }

        return $html;
    }
}