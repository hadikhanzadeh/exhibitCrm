<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Lib\wbsUtility;
use App\Models\tourRequest;
use Illuminate\Http\Request;
use Validator;

class TourRequestController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'exhibition' => 'required|integer',
            'exhibition-title' => 'required|string',
            'country' => 'required|array',
            'city' => 'required|array',
            'genre' => 'required|array',
            'phone' => 'required|string',
            'email' => 'email',
            'ceo-name' => 'required|string',
            'responsible' => 'required|string',
            'participants' => 'required|integer'
        ]);

        if (!$validator->passes()) {
            return json_encode(['status' => 'error', 'message' => 'اطلاعات ارسالی صحیح نمی باشد! لطفا اطلاعات خود به دقت بررسی نمایید.']);
        }


        try {
            $tourRequest = new tourRequest;
            $trackingCode = wbsUtility::randomInt(10);
            $tourRequest->user_id = 54545; //TODO: Set Wordpress LoggedIn User ID
            $tourRequest->company_name = $request->get('company');
            $tourRequest->exhibition_id = $request->get('exhibition');
            $tourRequest->exhibition_title = $request->get('exhibition-title');
            $tourRequest->country = $request->get('country')[0];
            $tourRequest->country_title = $request->get('country')[1];
            $tourRequest->city = $request->get('city')[0];
            $tourRequest->city_title = $request->get('city')[1];
            $tourRequest->activity_area = $request->get('genre')[0];
            $tourRequest->activity_area_title = $request->get('genre')[1];
            $tourRequest->mobile = $request->get('phone');
            $tourRequest->participants = $request->get('participants');
            $tourRequest->email = $request->get('email');
            $tourRequest->manager = $request->get('ceo-name');
            $tourRequest->tracking_code = $trackingCode;
            $tourRequest->lang = $request->get('lang');

            $tourRequest->save();
            return json_encode(['status' => 'success', 'message' => 'درخواست شما با موفقیت ثبت گردید. کد پیگیری شما : ' . $trackingCode]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return json_encode(['status' => 'error', 'message' => 'خطایی در پردازش اطلاعات ارسالی وجود دارد! لطفا با پشتیبانی مطرح نمایید.']);
        }
    }
}
