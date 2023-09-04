<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
use App\Http\Lib\wbsUtility;
use App\Models\boothBuilding;
use App\Models\tourRequest;
use DB;
use Illuminate\Http\Request;
use Validator;

class BoothBuildingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $boothBuildings = boothBuilding::where('lang', '=', app()->getLocale())->where(function ($query) use ($request) {
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
        return view('dashboard.pages.boothBuildingRequest.list', ['items' => $boothBuildings, 'taxData' => $taxData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'user_id' => 'required|integer',
            'exhibition' => 'required|integer',
            'exhibition-title' => 'required|string',
            'country' => 'required|array',
            'city' => 'required|array',
            'genre' => 'required|array',
            'phone' => 'required|string',
            'email' => 'email',
            'responsible' => 'required|string',
            'ceo-name' => 'required|string',
            'website' => 'required|string',
            'size' => 'required|string',
            'dimensions' => 'required|string',
            'hall-name' => 'required|string',
            'corporate-color' => 'required|string',
            'showcase-product' => 'required|string',
            'equipment' => 'required|string',
            'products-number' => 'required|integer',
            'products-type' => 'required|string',
            'products-dimensions' => 'required|string',
            'answering-desks' => 'required|integer',
            'budget' => 'required|integer',
            'design-type' => 'required|string',
            'height' => 'required|string',
            'flower-arrangement' => 'required|bool',
            'another-city' => 'required|bool',
            'outside-iran' => 'required|bool',
            'need-reserve' => 'required|bool',
            'lang' => 'required|string',
        ]);

        if (!$validator->passes()) {
            return json_encode(['status' => 'error', 'message' => __('The information sent is not correct! Please check your information carefully.')]);
        }

        try {
            $boothBuilding = new boothBuilding;
            $trackingCode = wbsUtility::randomInt(10);
            $boothBuilding->user_id = (int)$request->get('user_id');
            $boothBuilding->company_name = $request->get('company');
            $boothBuilding->exhibition_id = $request->get('exhibition');
            $boothBuilding->exhibition_title = $request->get('exhibition-title');
            $boothBuilding->country = $request->get('country')[0];
            $boothBuilding->country_title = $request->get('country')[1];
            $boothBuilding->city = $request->get('city')[0];
            $boothBuilding->city_title = $request->get('city')[1];
            $boothBuilding->activity_area = $request->get('genre')[0];
            $boothBuilding->activity_area_title = $request->get('genre')[1];
            $boothBuilding->mobile_phone = $request->get('phone');
            $boothBuilding->website = $request->get('website');
            $boothBuilding->email = $request->get('email');
            $boothBuilding->manager_name = $request->get('ceo-name');
            $boothBuilding->responsible = $request->get('responsible');
            $boothBuilding->meterage_booth = $request->get('size');
            $boothBuilding->dimensions_booth = $request->get('dimensions');
            $boothBuilding->hall_name = $request->get('hall-name');
            $boothBuilding->corporate_color = $request->get('corporate-color');
            $boothBuilding->showcase_product = $request->get('showcase-product');
            $boothBuilding->equipment = $request->get('equipment');
            $boothBuilding->product_count = $request->get('products-number');
            $boothBuilding->product_type = $request->get('products-type');
            $boothBuilding->product_dimensions = $request->get('products-dimensions');
            $boothBuilding->answering_desks = $request->get('answering-desks');
            $boothBuilding->amount_budget = $request->get('budget');
            $boothBuilding->height_booth = $request->get('height');
            $boothBuilding->design_type = $request->get('design-type');
            $boothBuilding->design_type = $request->get('design-type');
            $boothBuilding->flower_arrangement = $request->get('flower-arrangement');
            $boothBuilding->another_city = $request->get('another-city');
            $boothBuilding->another_country = $request->get('outside-iran');
            $boothBuilding->need_reserve = $request->get('need-reserve');
            $boothBuilding->tracking_code = $trackingCode;
            $boothBuilding->lang = $request->get('lang');

            $boothBuilding->save();
            return json_encode(['status' => 'success', 'message' => __('Your request has been successfully registered. Your tracking code: ') . $trackingCode]);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return json_encode(['status' => 'error', 'message' => __('There is an error processing the sent information! Please raise with support.')]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $boothBuilding = boothBuilding::where('id', '=', $request->id)->first();
        if (!$boothBuilding) {
            return view('dashboard.error');
        }
        return view('dashboard.pages.tourRequest.view', ['item' => $boothBuilding]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(booth_building $booth_building)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, booth_building $booth_building)
    {
        //
    }

    public function groupIndex(Request $request)
    {
        $boothBuilding = boothBuilding::where(function ($query) use ($request) {
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

        if ($boothBuilding->isEmpty()) {
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
            $getExhibitionTitle = $boothBuilding[0]->exhibition_title;
        }
        return view('dashboard.pages.boothBuildingRequest.group-list', ['items' => $boothBuilding, 'title' => $getExhibitionTitle, 'taxData' => $taxData]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $item = boothBuilding::where('id', '=', $request->id)->first();
        $boothBuilding = new boothBuilding();
        if (!$item || !(bool)$boothBuilding->destroy($id)) {
            return redirect()->back()->withErrors(['msg' => __('Error! The desired information was not deleted. Please share with support.')]);
        }
        return redirect()->route('dashboard.boothGroupIndex', ['exhibit_id' => $item->exhibition_id])->with(['success' => __('The desired information was successfully deleted.')]);

    }
}
