<?php

if ( ! function_exists('wew'))
{
    function wew($data, $die=false)
    {
        echo '<pre>'; print_r($data); echo '</pre>'; if($die) die;
    }
}

if ( ! function_exists('toSlug')) {
    function toSlug($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
        // trim
        $text = trim($text, '-');
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // lowercase
        $text = strtolower($text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}

if (! function_exists('print_yes_no')) {
    function print_yes_no($number, $yes = 1, $no = 0)
    {
        if ($number == $yes) {
            return '<span class="label label-success">'.lang('yes').'</span>';
        } elseif ($number == $no) {
            return '<span class="label label-danger">'.lang('no').'</span>';
        }
    }
}

if (! function_exists('numrows')) {
    function numrows($data, $index = 1, $name = 'no')
    {
        if (is_object($data)) {
            foreach ($data as $key => $value) {
                $value->{$name} = $index;
                $index++;
            }
        } else
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    $data[$key]->$name = $index;
                    $index++;
                }
            }
        return $data;
    }
}

if (! function_exists('timestamp')) {
    function timestamp()
    {
        return date('Y-m-d H:i:s');
    }
}