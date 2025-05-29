<?php

if (!function_exists('getImageUrl')) {
    /**
     * Zwraca poprawny URL do zdjęcia
     *
     * @param string $path
     * @return string
     */
    function getImageUrl($path) {
        if (filter_var($path, FILTER_VALIDATE_URL)) {
            return $path;
        }

        return asset('storage/' . $path);
    }
}
