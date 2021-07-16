<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\DataTraining;
use Illuminate\Http\Request;

class AlgorithmController extends Controller
{
    public function index()
    {
        $countData  = DataTraining::count();
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
            ->get();
        $brandsSize     = Brand::withCount(['dataTrainings' => function ($q) {
            $q->where('size', true);
        }])
            ->get();
        $brandsModel     = Brand::withCount(['dataTrainings' => function ($q) {
            $q->where('model', true);
        }])
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

        // return response()->json([
        // $classBrand,
        // $classModel,
        // $classSize,
        // $brandsBrand,
        // $brandsSize,
        // $brandsModel,
        // $sumBrandsBrand,
        // $sumBrandsSize,
        // $sumBrandsModel
        // ], 200);
        return view('pages.algorithm.index', compact(
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
        ));
    }
}
