<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
use App\Http\Lib\wbsUtility;
use App\Models\tourRequest;
use App\Http\Requests\StoretourRequestRequest;
use App\Http\Requests\UpdatetourRequestRequest;
use Illuminate\Http\Request;
use Validator;

class TourRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tourRequests = tourRequest::where('lang', '=', app()->getLocale())->where(function ($query) use ($request) {
            $title = $request->has('title') ? $request->get('title') : null;
            $country = $request->has('country') ? $request->get('country') : null;
            $city = $request->has('city') ? $request->get('city') : null;
            $genre = $request->has('genre') ? $request->get('genre') : null;
            $fromDate = $request->has('from_date_en') ? $request->get('from_date_en') : null;
            $toDate = $request->has('to_date_en') ? $request->get('to_date_en') : null;
            $status = $request->has('status') ? $request->get('status') : null;

            if (isset($title)) {
                $query->where('exhibition_title', 'LIKE', '%' . $title . '%');
            }
            if (!empty($country)) {
                $query->where('country', '=', $country);
            }
            if (!empty($city)) {
                $query->whereIn('city', $city);
            }
            if (!empty($genre)) {
                $query->whereIn('activity_area', $genre);
            }

            if (!empty($fromDate)) {
                if (!empty($toDate)) {
                    $query->whereBetween('created_at', [$fromDate, $toDate]);
                } else {
                    $query->whereDate('created_at', '=', $fromDate);
                }
            }

            if (!empty($status)) {
                $query->where('status', 'like', $status);
            }

        })->paginate(2)->appends($request->all());

        $params = [];
        if ($request->has('country')) {
            $params['country'] = $request->get('country');
        }
        if ($request->has('city')) {
            $params['city'] = $request->get('city');
        }
        if ($request->has('genre')) {
            $params['genre'] = $request->get('genre');
        }
        $taxData = [];
        if (!empty($params)) {
            $crmAPI = new crmAPI();
            $reqData = [
                'data' => [
                    'action' => 'getTaxData',
                    'params' => $params
                ]
            ];
            $taxData = $crmAPI->request($reqData);
        }
        return view('dashboard.pages.tourRequest.list', ['items' => $tourRequests, 'taxData' => $taxData]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoretourRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $tourRequest = tourRequest::where('id', '=', $request->id)->get();
        if ($tourRequest->isEmpty()) {
            return view('dashboard.error');
        }
        return view('dashboard.pages.tourRequest.view', ['item' => $tourRequest[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'company_name' => 'required|string',
            'mobile' => 'required|string',
            'email' => 'email',
            'manager' => 'required|string',
            'participants' => 'required|integer',
            'status' => 'required|string',
            'id' => 'required|integer',
        ]);

        if (!$validator->passes()) {
            $request->session()->flash('error', 'خطایی در پردازش اطلاعات ارسالی وجود دارد! لطفا با پشتیبانی مطرح نمایید.');
            return redirect()->back();
        }
        $id = $request->get('id');
        $tourRequest = tourRequest::find($id);
        if (!$tourRequest) {
            $request->session()->flash('error', 'خطایی در پردازش اطلاعات ارسالی وجود دارد! لطفا با پشتیبانی مطرح نمایید.');
            return redirect()->back();
        }

        try {
            $tourRequest->company_name = $request->get('company_name');
            $tourRequest->mobile = $request->get('mobile');
            $tourRequest->participants = $request->get('participants');
            $tourRequest->email = $request->get('email');
            $tourRequest->manager = $request->get('manager');
            $tourRequest->status = $request->get('status');

            $tourRequest->save();
            $request->session()->flash('success', 'اطلاعات مورد نظر با موفقیت به روز رسانی گردید.');
            return redirect()->route("dashboard.viewTourRequest", $id);
        } catch (\Exception $e) {
            $request->session()->flash('danger', 'خطایی در پردازش اطلاعات ارسالی وجود دارد! لطفا با پشتیبانی مطرح نمایید.');
            return redirect()->route("dashboard.viewTourRequest");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $tourRequest = new tourRequest();
        if (!(bool)$tourRequest->destroy($id)) {
            return redirect()->back()->withErrors(['msg' => __('خطا! اطلاعات مورد نظر حذف نشد. لطفا با پشتسیبانی در میان بگذارید.')]);
        }
        return redirect()->route('dashboard.tourRequest')->with(['success' => __('اطلاعات مورد نظر با موفقیت حذف گردید.')]);
    }
}
