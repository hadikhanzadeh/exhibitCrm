<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
use Illuminate\Http\Request;
use Validator;
use function Illuminate\Events\queueable;

class AjaxController extends Controller
{
    public function getCountries(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|string'
        ]);

        if (!$validator->passes()) {
            return json_encode(['status' => 'error', 'message' => 'اطلاعات ارسالی صحیح نمی باشد! لطفا یک بار صفحه را رفرش کرده و مجدد امتحان کنید.']);
        }

        $crmAPI = new crmAPI();
        $reqData = [
            'data' => [
                'action' => 'getCountriesByTitle',
                'params' => [
                    'title' => $request->get('q')
                ]
            ]
        ];
        return $crmAPI->request($reqData);
    }

    public function getCites(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|string'
        ]);

        if (!$validator->passes()) {
            return json_encode(['status' => 'error', 'message' => 'اطلاعات ارسالی صحیح نمی باشد! لطفا یک بار صفحه را رفرش کرده و مجدد امتحان کنید.']);
        }

        $crmAPI = new crmAPI();
        $reqData = [
            'data' => [
                'action' => 'getCitesByTitle',
                'params' => [
                    'title' => $request->get('q'),
                    'customParams' => $request->get('customParams')
                ]
            ]
        ];
        return $crmAPI->request($reqData);
    }

    public function getGenre(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'q' => 'required|string'
        ]);

        if (!$validator->passes()) {
            return json_encode(['status' => 'error', 'message' => 'اطلاعات ارسالی صحیح نمی باشد! لطفا یک بار صفحه را رفرش کرده و مجدد امتحان کنید.']);
        }

        $crmAPI = new crmAPI();
        $reqData = [
            'data' => [
                'action' => 'getGenreByTitle',
                'params' => [
                    'title' => $request->get('q')
                ]
            ]
        ];
        return $crmAPI->request($reqData);
    }
}
