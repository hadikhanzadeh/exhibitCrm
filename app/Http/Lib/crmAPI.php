<?php

namespace App\Http\Lib;

use Illuminate\Support\Facades\Http;

class crmAPI
{
    protected string $token = 'nsafiiwqm8577@237dasd-3lsdklmas';
    protected string $url = 'https://exhibit.local/api/';

    /**
     * @param array $data
     * @return array
     */
    public function request(array $data = []): array
    {
        return Http::withoutVerifying()->withHeaders([
            'accept' => 'application/json',
            'token' => $this->token
        ])->asForm()->post($this->url, $data)->json();
    }
}
