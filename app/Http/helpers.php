<?php

if (! function_exists('baseUrl')) {
    function baseUrl() {
        return 'localhost';
    }
}


if (! function_exists('adminUrl')) {
    function adminUrl() {
        return 'admin' . '.' . baseUrl();
    }
}
