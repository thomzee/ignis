<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuLib
{
    protected $_ci;

    public function __construct()
    {
        $this->_ci = &get_instance();
        $this->_ci->load->model('Menu_model', 'menu');
    }

    public function arrayTree(array $array, $parent = null)
    {
        $tree = [];
        foreach ($array as $value) {
            $value = (array)$value;
            if ($value['parent_id'] == $parent) {
                $children = $this->arrayTree($array, $value['id']);
                if ($children) {
                    $value['children'] = $children;
                }
                $tree[] = $value;
            }
        }
        return $tree;
    }

    public function arrayTreeIds(array $array, $parent = null)
    {
        $ids = [];
        foreach ($array as $value) {
            $value = (array)$value;
            if ($value['parent_id'] == $parent) {
                $children = $this->arrayTreeIds($array, $value['id']);
                if ($children) {
                    $ids[$value['id']] = $children;
                } else {
                    $ids[$value['id']] = $value['id'];
                }
            }
        }
        return $ids;
    }

    public function arrayTreeSearch(array $haystack, $needle)
    {
        foreach ($haystack as $key => $value) {
            if (is_array($value)) {
                $return = $this->arrayTreeSearch($value, $needle);
                if (is_array($return)) {
                    return [$key => $return];
                }
            } else {
                if ($value == $needle) {
                    return [$key => $needle];
                }
            }
        }
        return false;
    }

    public function arrayTreeKeys(array $array)
    {
        $keys = [];
        foreach ($array as $key => $value) {
            $keys[] = $key;
            if (is_array($array[$key])) {
                $keys = array_merge($keys, $this->arrayTreeKeys($array[$key]));
            }
        }
        return $keys;
    }

    public function sidebar($slug)
    {
        $menu = $this->_ci->menu->getBySlug($slug);
        $tree = $this->_ci->menu->getSidebar();
        $tree = $this->arrayTree($tree);
        $tree = $this->treeSidebar($tree, $menu);
        return $tree;
    }

    public function treeSidebarIds($menu)
    {
        $tree = $this->_ci->menu->getTree();
        $tree = $this->arrayTreeIds($tree);
        $tree = is_array($this->arrayTreeSearch($tree, $menu)) ? $this->arrayTreeSearch($tree, $menu) : [];
        $tree = $this->arrayTreeKeys($tree);
        return $tree;
    }

    public function treeSidebar(array $array, $menu, &$html = null)
    {
        foreach ($array as $value) {
            $children = false;

            if (isset($value['children']) && sizeof($value['children']) > 0) {
                $children = true;
            }

            if ($children) {
                $html .= '<li class="treeview' . (in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '') . '">';
            } else {
                if ($value['slug'] != null && $value['controller'] != null && $value['model'] != null) {
//                    $index = config('access.menu.'.$value['slug'].'.index');
//                    if (check_access($index, $value['slug'])) {
                    $html .= '<li' . (in_array($value['id'], $this->treeSidebarIds($menu)) ? ' class="active"' : '') . '>';
//                    } else {
//                        $html .= '<li class="hidden'.(in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '').'">';
//                    }
                } else {
                    $html .= '<li class="hidden' . (in_array($value['id'], $this->treeSidebarIds($menu)) ? ' active' : '') . '">';
                }
            }

            if ($value['slug'] != null) {
                $html .= '<a href="' . base_url() . '/' . $value['slug'] . '">';
            } else {
                $html .= '<a href="javascript:void(0)">';
            }

            if ($value['icon'] != null) {
                $html .= print_icon($value['icon']);
            }

            $html .= '<span>' . $value['name'] . '</span>';

            if ($children) {
                $html .= '<span class="pull-right-container">';
                $html .= '<i class="fa fa-angle-left pull-right"></i>';
                $html .= '</span>';
            }

            $html .= '</a>';

            if ($children) {
                $html .= '<ul class="treeview-menu">';
                $this->treeSidebar($value['children'], $menu, $html);
                $html .= '</ul>';
            }

            $html .= '</li>';
        }

        return $html;
    }
}