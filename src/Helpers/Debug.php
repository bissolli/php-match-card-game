<?php

if (! function_exists('dump')) {
    /**
     * Dump the passed variables.
     *
     * @param  mixed
     * @return void
     */
    function dump($data)
    {
        echo '<pre>' . var_export($data, true) . '</pre>';
    }
}

if (! function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd($data)
    {
        echo '<pre>' . var_export($data, true) . '</pre>';
        die(1);
    }
}
