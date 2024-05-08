<?php

if (!function_exists('random')) {
    function random()
    {
        return date('YmdHis') . '_' . rand(11111111111, 99999999999);
    }
}