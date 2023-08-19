<?php

namespace App\Http\Lib;

class wbsUtility
{
    public static function getStatus(string $status): string
    {
        return match ($status) {
            'pending' => '<span class="wbs-status pending">در انتظار بررسی</span>',
            'awaiting' => '<span class="wbs-status awaiting">در حال رسیدگی</span>',
            'complete' => '<span class="wbs-status complete">تکمیل شده</span>',
            default => '<span class="wbs-status pending">در انتظار بررسی</span>',
        };
    }
}
