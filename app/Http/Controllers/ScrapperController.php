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
                ->addColumn('brand', function ($item) {
                    return  $item->brand == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                })
                ->addColumn('size', function ($item) {
                    return  $item->size == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                })
                ->addColumn('model', function ($item) {
                    return  $item->model == 1 ? '<i class="fa fa-check text-success"></i>' : '<i class="fa fa-times text-danger"></i>';
                })
                ->rawColumns([
                    'brand',
                    'size',
                    'model',
                ])
                ->make(true);
        }
        return view('pages.scrapes.index');
    }

    public function store(Request $request)
    {
        $value   = (int) $request->input('value');
        $keyword = $request->input('keyword');

        $loop  = $value / 100;

        $paginate  = 100;
        $iteration = 0;
        $start     = 100;
        DB::transaction(function () use ($keyword, $iteration, $loop, $start, $paginate) {
            DataTraining::truncate();

            while ($iteration < $loop) {
                $title = '';

                $brands = Brand::get();
                $titleArrays = '';
                $model = false;

                $brandId = null;

                $result = $this->scrape($keyword, $start, $paginate);

                foreach ($result['items'] as $item) {
                    $title = strtoupper($item['item_basic']['name']);
                    $titleArrays = explode(' ', $title);
                    $model = false;
                    $brandId = null;
                    foreach ($titleArrays as $titleArray) {
                        if (preg_match('/[A-Za-z]/', $titleArray) && preg_match('/[0-9]/', $titleArray)) {
                            $model = true;
                        }
                        foreach ($brands as $brand) {
                            if ($brand->name === $titleArray) {
                                $brandId = $brand->id;
                            }
                        }
                    }

                    DataTraining::create([
                        'title'     => $title,
                        'size'      => strpos($title, 'INC') !== false ? true : false,
                        'brand'     => $brandId == null ? false : true,
                        'model'     => $model,
                        'brand_id'  => $brandId
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


    public function show(DataTraining $crawling)
    {
        $brands = Brand::get();

        $titleArrays = explode(' ', $crawling->title);
        $data = [
            'size'  => null,
            'model' => null,
            'brand' => null
        ];
        foreach ($titleArrays as $i => $titleArray) {

            foreach ($brands as $brand) {
                if ($brand->name === $titleArray) {
                    $data['brand'] = $brand->name;
                }
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
            "item"  => $crawling,
            "data"  => $data
        ], 200);
    }

    public function checkOnTitle(Request $request)
    {
        $brands = Brand::get();

        $titleArrays = explode(' ', strtoupper($request->title));
        $data = [
            'size'  => null,
            'model' => null,
            'brand' => null
        ];
        foreach ($titleArrays as $i => $titleArray) {

            foreach ($brands as $brand) {
                if ($brand->name === $titleArray) {
                    $data['brand'] = $brand->name;
                }
            }

            if (strpos($titleArray, 'INC') !== false) {
                if (is_numeric($titleArrays[$i - 1])) {
                    $data['size'] = $titleArrays[$i - 1];
                }
                else{
                    $data['size'] = str_replace('INC', '', $titleArrays[$i]);
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
            "data"  => $data
        ], 200);
    }
}
