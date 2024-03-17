<?php

declare(strict_types=1);
if (!function_exists('formatPrice')) {
    /**
     * @param int  $price
     * @param bool $toBee
     * @param bool $sum
     * @param int  $decimals
     * @return string
     */
    function formatPrice(int|float $price, bool $toBee = false, bool $sum = false, int $decimals = 0): string
    {
        if ($toBee) {
            $price /= 100;
        }

        $pricePrint = number_format($price, $decimals, '.', ' ');

        return $sum ? $pricePrint.' '.trans('all.currency') : $pricePrint;
    }
}
if (!function_exists('formatSize')) {
    /**
     * @param int $bytes
     * @return string
     */
    function formatSize(int $bytes): string
    {
        if ($bytes < 1000 * 1024) {
            return number_format($bytes / 1024, 2).' KB';
        }

        if ($bytes < 1000 * 1048576) {
            return number_format($bytes / 1048576, 2).' MB';
        }

        if ($bytes < 1000 * 1073741824) {
            return number_format($bytes / 1073741824, 2).' GB';
        }

        return number_format($bytes / 1099511627776, 2).' TB';
    }
}
