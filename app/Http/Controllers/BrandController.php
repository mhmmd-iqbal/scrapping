<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::orderBy('name', 'ASC')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($item) {
                    return
                        '<button class="btn btn-primary mr-1" onclick="updateData(this)" data-id="' . $item->id . '" data-name="' . $item->name . '" >
                            <i class="fa fa-pencil-square-o"></i> UPDATE
                        </button>
                        <button class="btn btn-danger" onclick="deleteData(this)" data-id="' . $item->id . '">
                            <i class="fa fa-times"></i> DELETE
                        </button>';
                })
                ->rawColumns([
                    'action',
                ])
                ->make(true);
        }
        return view('pages.brands.index');
    }

    public function store(BrandRequest $request)
    {
        $validated = $request->validated();

        $checkBrands = Brand::where('name', strtoupper($validated['brand']))
            ->count();

        if ($checkBrands > 0) {
            return response()->json(
                [
                    'status'    => 'error',
                    'message'   => 'Brand Sudah Ada di Dalam Daftar'
                ]
            );
        }

        Brand::firstOrCreate([
            'name' => strtoupper($validated['brand'])
        ]);
        return response()->json([
            'status'    => 'success',
            'message'   => 'Success Menambah Data'
        ], 200);
    }

    public function update(BrandRequest $request, Brand $brand)
    {
        $validated = $request->validated();
        $checkBrands = Brand::where('name', '!=', $brand->name)
            ->where('name', strtoupper($validated['brand']))
            ->count();

        if ($checkBrands > 0) {
            return response()->json(
                [
                    'status'    => 'error',
                    'message'   => 'Brand Sudah Ada di Dalam Daftar'
                ]
            );
        }

        $brand->update([
            'name'  => strtoupper($validated['brand'])
        ]);
        return response()->json([
            'status'    => 'success',
            'message'   => 'Success Mengubah Data'
        ], 200);
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json([
            'status'    => 'success',
            'message'   => 'Success Menghapus Data'
        ], 200);
    }
}
