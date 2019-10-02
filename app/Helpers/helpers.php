<?php

if (!function_exists('on_page')) {
    /**
     * Check's whether request url/route matches passed link
     *
     * @param $path
     * @param string $type
     * @return null
     */
    function on_page($path, $type = "name")
    {
        switch ($type) {
            case "url":
                $result = ($path == request()->is($path));
                break;

            default:
                $result = ($path == request()->route()->getName());
        }

        return $result;
    }
}

if (!function_exists('return_if')) {
    /**
     * Appends passed value if condition is true
     *
     * @param $condition
     * @param $value
     * @return null
     */
    function return_if($condition, $value)
    {
        if ($condition) {
            return $value;
        }
    }
}

if (!function_exists('page_title')) {
    /**
     * Returns page title from passed values
     *
     * @param $title
     * @param $separator
     * @return null
     */
    function page_title($title, $separator = '-')
    {
        return "{$title} {$separator} ";
    }
}
