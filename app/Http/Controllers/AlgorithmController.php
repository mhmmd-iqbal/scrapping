<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\DataTraining;
use App\Traits\CalculationTrait;
use Illuminate\Http\Request;
use DataTables;

class AlgorithmController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            switch ($request->params) {
                case 'model':
                default:
                    $data = DataTraining::ofModel(true);
                    break;
                case 'brand':
                    $data = DataTraining::ofBrand(true);
                    break;
                case 'size':
                    $data = DataTraining::ofSize(true);
                    break;
            }
            $data = $data->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
        $countData  = DataTraining::count();

        $accurationTest = CalculationTrait::accurationTest();
        // return response()->json($accurationTest);

        $countBrand = DataTraining::where('brand', true)
            ->count();
        $countSize  = DataTraining::where('size', true)
            ->count();
        $countModel = DataTraining::where('model', true)
            ->count();


        $classBrand = $countBrand / $countData;
        $classSize  = $countSize / $countData;
        $classModel = $countModel / $countData;

        $brandsBrand     = Brand::withCount(['dataTrainings' => function ($q) {
            $q->where('brand', true);
        }])
            ->whereHas('dataTrainings')
            ->get();
        $brandsSize     = Brand::withCount(['dataTrainings' => function ($q) {
            $q->where('size', true);
        }])
            ->whereHas('dataTrainings')
            ->get();
        $brandsModel     = Brand::withCount(['dataTrainings' => function ($q) {
            $q->where('model', true);
        }])
            ->whereHas('dataTrainings')
            ->get();

        $sumBrandsBrand = 1;
        $sumBrandsSize  = 1;
        $sumBrandsModel = 1;

        foreach ($brandsBrand as $data) {
            (object) $data['variable_class'] = $data->data_trainings_count / $countBrand;
            $sumBrandsBrand *= $data['variable_class'];
        }
        foreach ($brandsSize as $data) {
            (object) $data['variable_class'] = $data->data_trainings_count / $countSize;
            $sumBrandsSize *= $data['variable_class'];
        }
        foreach ($brandsModel as $data) {
            (object) $data['variable_class'] = $data->data_trainings_count / $countModel;
            $sumBrandsModel *= $data['variable_class'];
        }

        return view('pages.algorithm.index', compact(
            'countData',
            'countBrand',
            'countModel',
            'countSize',
            'classBrand',
            'classModel',
            'classSize',
            'brandsBrand',
            'brandsSize',
            'brandsModel',
            'sumBrandsBrand',
            'sumBrandsSize',
            'sumBrandsModel',
            'accurationTest',
        ));
    }
}
