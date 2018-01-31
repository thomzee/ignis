<?php
/**
 * Created by PhpStorm.
 * User: thomzee
 * Date: 31/01/18
 * Time: 01.31
 */
class TreeLib
{
    public function arrayTree(array $array, $parent = null)
    {
        $tree = [];
        foreach ($array as $value) {
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
        foreach($array as $key => $value) {
            $keys[] = $key;
            if (is_array($array[$key])) {
                $keys = array_merge($keys, $this->arrayTreeKeys($array[$key]));
            }
        }
        return $keys;
    }
}
