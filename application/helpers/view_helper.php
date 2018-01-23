<?php

if ( ! function_exists('breadcrumbs'))
{
    function breadcrumbs($breadcrumbs)
    {
        $breadcrumbs = explode("/", $breadcrumbs);
        echo '<i class="fa fa-compass"></i> ';
        foreach($breadcrumbs as $key => $value){
            if (!array_key_exists($key+1, $breadcrumbs)){
                $active = 'active';
                echo '<li class="'.$active.'">'.$value.'</li>';
            }else{
                echo '<li>'.anchor($value, $value).'</li>';
            }
        }
    }
}

if (! function_exists('print_icon')) {
    function print_icon($icon)
    {
        if (strpos($icon, 'fa ') !== false) {
            return '<i class="' . $icon . '"></i>';
        } elseif (strpos($icon, 'fa-') !== false) {
            return '<i class="fa ' . $icon . '"></i>';
        }
    }
}