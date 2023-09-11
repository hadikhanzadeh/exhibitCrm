<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
use App\Http\Lib\wbsUtility;
use App\Models\BoothReserve;
use DB;
use Illuminate\Http\Request;
use Validator;

class BoothReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boothReserves = BoothReserve::where('lang', '=', app()->getLocale())->where(function ($query) use ($request) {
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

        })
            ->orderBy('totalSize', 'desc')
            ->orderBy('created_at', 'desc')
            ->select('exhibition_id', 'country_title', 'city_title', 'exhibition_title', DB::raw('COUNT(id) as totalCount'), DB::raw('SUM(meterage_booth) as totalSize'))->take(5)->groupBy('exhibition_id')->get();
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
        return view('dashboard.pages.boothReserveRequest.list', ['items' => $boothReserves, 'taxData' => $taxData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.boothReserveRequest.new');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'user_id' => 'integer',
            'exhibition' => 'required|integer',
            'exhibition-title' => 'required|string',
            'country' => 'required|array',
            'city' => 'required|array',
            'genre' => 'required|array',
            'mobile_phone' => 'required|string',
            'email' => 'email',
            'responsible' => 'required|string',
            'ceo-name' => 'required|string',
            'meterage' => 'required|integer',
            'dimensions' => 'required|string',
            'need_building' => 'required|bool',
            'lang' => 'string'
        ]);

        if (!$validator->passes()) {
            if (!$request->routeIs('dashboard.saveBoothReserveRequest')) {
                return json_encode(['status' => 'error', 'message' => __('The information sent is not correct! Please check your information carefully.')]);
            }
            $request->session()->flash('error', __('There is an error processing the sent information! Please raise with support.'));
            return redirect()->route("dashboard.createBoothReserveRequest");
        }

        try {
            $boothReserve = new BoothReserve();
            $trackingCode = wbsUtility::randomInt(10);
            $boothReserve->user_id = (int)$request->get('user_id');
            $boothReserve->company_name = $request->get('company');
            $boothReserve->exhibition_id = $request->get('exhibition');
            $boothReserve->exhibition_title = $request->get('exhibition-title');
            $boothReserve->country = $request->get('country')[0];
            $boothReserve->country_title = $request->get('country')[1];
            $boothReserve->city = $request->get('city')[0];
            $boothReserve->city_title = $request->get('city')[1];
            $boothReserve->activity_area = $request->get('genre')[0];
            $boothReserve->activity_area_title = $request->get('genre')[1];
            $boothReserve->mobile_phone = $request->get('mobile_phone');
            $boothReserve->email = $request->get('email');
            $boothReserve->manager_name = $request->get('ceo-name');
            $boothReserve->responsible = $request->get('responsible');
            $boothReserve->meterage_booth = $request->get('meterage');
            $boothReserve->dimensions_booth = $request->get('dimensions');
            $boothReserve->need_building = $request->get('need_building');
            $boothReserve->tracking_code = $trackingCode;
            $boothReserve->lang = $request->get('lang') ?: app()->getLocale();
            if ($request->routeIs('dashboard.saveBoothReserveRequest')) {
                $boothReserve->creator_id = \Auth::id();
            }
            $boothReserve->save();
            if (!$request->routeIs('dashboard.saveBoothReserveRequest')) {
                return json_encode(['status' => 'success', 'message' => __('Your request has been successfully registered. Your tracking code: ') . $trackingCode]);
            }
            $request->session()->flash('success', __('Your request has been successfully registered. Your tracking code:') . $trackingCode);
            return redirect()->route("dashboard.viewBoothReserve", $boothReserve->id);
        } catch (\Exception $e) {
            if (!$request->routeIs('dashboard.saveBoothReserveRequest')) {
                return json_encode(['status' => 'error', 'message' => __('There is an error processing the sent information! Please raise with support.')]);
            }
            $request->session()->flash('error', __('There is an error processing the sent information! Please raise with support.'));
            return redirect()->route("dashboard.createBoothReserveRequest");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $boothReserve = BoothReserve::where('id', '=', $request->id)->first();
        if (!$boothReserve) {
            return view('dashboard.error');
        }
        return view('dashboard.pages.boothReserveRequest.view', ['item' => $boothReserve]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BoothReserve $boothReserve)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'mobile_phone' => 'required|string',
            'email' => 'email',
            'ceo-name' => 'required|string',
            'meterage' => 'required|integer',
            'dimensions' => 'required|string',
            'status' => 'required|string',
            'id' => 'required|integer',
        ]);

        if (!$validator->passes()) {
            $request->session()->flash('error', __('There is an error processing the sent information! Please raise with support.'));
            return redirect()->back();
        }
        $id = $request->get('id');
        $boothReserve = BoothReserve::find($id);
        if (!$boothReserve) {
            $request->session()->flash('error', __('There is an error processing the sent information! Please raise with support.'));
            return redirect()->back();
        }

        try {
            $boothReserve->company_name = $request->get('company');
            $boothReserve->mobile_phone = $request->get('mobile_phone');
            $boothReserve->meterage_booth = $request->get('meterage');
            $boothReserve->dimensions_booth = $request->get('dimensions');
            $boothReserve->email = $request->get('email');
            $boothReserve->manager_name = $request->get('ceo-name');
            $boothReserve->status = $request->get('status');
            $boothReserve->operator_id = \Auth::id();

            $boothReserve->save();
            $request->session()->flash('success', __('The desired information has been successfully updated.'));
            return redirect()->route("dashboard.viewBoothReserve", $id);
        } catch (\Exception $e) {
            $request->session()->flash('danger', __('There is an error processing the sent information! Please raise with support.'));
            return redirect()->route("dashboard.viewBoothReserve");
        }
    }

    public function groupIndex(Request $request)
    {
        $boothReserve = BoothReserve::where(function ($query) use ($request) {
            $query->where('lang', '=', app()->getLocale());
            $query->where('exhibition_id', '=', $request->exhibit_id);

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

        })->orderBy('meterage_booth', 'desc')->orderBy('created_at', 'desc')->paginate(2)->appends($request->all());

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

        if ($boothReserve->isEmpty()) {
            $crmAPI = new crmAPI();
            $reqData = [
                'data' => [
                    'action' => 'getExhibitionTitle',
                    'params' => [
                        'id' => $request->exhibit_id,
                    ]
                ]
            ];
            $getExhibitionTitle = $crmAPI->request($reqData);
            $getExhibitionTitle = $getExhibitionTitle[0];
        } else {
            $getExhibitionTitle = $boothReserve[0]->exhibition_title;
        }
        return view('dashboard.pages.boothReserveRequest.group-list', ['items' => $boothReserve, 'title' => $getExhibitionTitle, 'taxData' => $taxData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $item = BoothReserve::where('id', '=', $request->id)->first();
        $boothReserve = new BoothReserve();
        if (!$item || !(bool)$boothReserve->destroy($id)) {
            return redirect()->back()->withErrors(['msg' => __('Error! The desired information was not deleted. Please share with support.')]);
        }
        return redirect()->route('dashboard.reserveGroupIndex', ['exhibit_id' => $item->exhibition_id])->with(['success' => __('The desired information was successfully deleted.')]);

    }
}
