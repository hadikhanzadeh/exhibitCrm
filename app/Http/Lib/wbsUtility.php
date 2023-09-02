<?php

namespace App\Http\Lib;

class wbsUtility
{
    public static function getStatus(string $status): string
    {
        return match ($status) {
            'awaiting' => '<span class="wbs-status isBtn awaiting">' . __('Awaiting') . '</span>',
            'complete' => '<span class="wbs-status isBtn complete">' . __('Completed') . '</span>',
            default => '<span class="wbs-status isBtn pending">' . __('Pending') . '</span>',
        };
    }

    public static function randomInt(int $length): string
    {
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= mt_rand(0, 9);
        }
        return $result;
    }
}
