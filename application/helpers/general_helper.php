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