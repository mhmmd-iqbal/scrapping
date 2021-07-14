<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\DataTraining;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;

class ScrapperController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DataTraining::get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('brand', function ($item) {
                    return  $item->brand == 1 ? true : false;
                })
                ->editColumn('size', function ($item) {
                    return  $item->size == 1 ? true : false;
                })
                ->editColumn('model', function ($item) {
                    return  $item->model == 1 ? true : false;
                })
                ->make(true);
        }
        return view('pages.scrapes.index');
    }

    public function store(Request $request)
    {
        $value   = (int) $request->input('value');
        $keyword = $request->input('keyword');

        $loop  = $value / 100;
        $data  = [];

        $paginate  = 100;
        $iteration = 0;
        $start     = 100;
        DB::transaction(function () use ($keyword, $iteration, $loop, $start, $paginate) {
            DataTraining::truncate();

            while ($iteration < $loop) {
                $title = '';

                $brands = Brand::get();
                $brandsArray = [];
                $titleArrays = '';
                $model = false;

                foreach ($brands as $key => $brand) {
                    $brandsArray[$key] = $brand->name;
                }


                $result = $this->scrape($keyword, $start, $paginate);
                foreach ($result['items'] as $item) {
                    $title = strtoupper($item['item_basic']['name']);
                    $titleArrays = explode(' ', $title);
                    $model = false;
                    foreach ($titleArrays as $key => $titleArray) {
                        if (preg_match('/[A-Za-z]/', $titleArray) && preg_match('/[0-9]/', $titleArray)) {
                            $model = true;
                        }
                    }

                    DataTraining::create([
                        'title' => $title,
                        'size'  => strpos($title, 'INC') !== false ? true : false,
                        'brand' => preg_match('(' . implode('|', $brandsArray) . ')', $title) ? true : false,
                        'model' => $model
                    ]);
                }


                $start += 100;
                $iteration++;
            }
        });

        return response()->json([
            'status'    => 'success',
        ], 200);
    }

    public function scrape($keyword = 'televisi', $paginate = 100, $limit = 100)
    {
        $url = 'https://shopee.co.id/api/v4/search/search_items?by=relevancy&keyword=' . $keyword . '&limit=' . $limit . '&newest=' . $paginate . '&order=desc&page_type=search&scenario=PAGE_GLOBAL_SEARCH&version=2';
        try {
            $http       = new Client();
            $response   = $http->get($url);

            return json_decode($response->getBody(), true);
        } catch (GuzzleException $ex) {
            report($ex); // error is safely record
        }
    }


    public function show(DataTraining $scrap)
    {
        $brands = Brand::get();
        $brandsArray = [];
        foreach ($brands as $key => $brand) {
            $brandsArray[$key] = $brand->name;
        }

        $titleArrays = explode(' ', $scrap->title);
        $data = [
            'size'  => null,
            'model' => null,
            'brand' => null
        ];
        foreach ($titleArrays as $i => $titleArray) {

            if (in_array($titleArray, $brandsArray)) {
                $data['brand'] = $titleArray;
            }

            if (strpos($titleArray, 'INC') !== false) {
                if (is_numeric($titleArrays[$i - 1])) {
                    $data['size'] = $titleArrays[$i - 1];
                }
            }
        }

        foreach ($titleArrays as $i => $titleArray) {
            if (preg_match('/[A-Za-z]/', $titleArray) && preg_match('/[0-9]/', $titleArray)) {
                $data['model'] = $titleArray;
                break;
            }
        }

        return response()->json([
            "item"  => $scrap,
            "data"  => $data
        ], 200);
    }
}
