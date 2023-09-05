<?php

namespace App\Http\Controllers;

use App\Http\Lib\crmAPI;
use App\Models\BoothReserve;
use Illuminate\Http\Request;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, BoothReserve $boothReserve)
    {

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
