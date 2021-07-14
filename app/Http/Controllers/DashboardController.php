<?php

namespace App\Http\Controllers;

use App\Models\DataTraining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $trainings = DataTraining::where('title', 'like', "%{$request->input('search')}%")
                ->get();
            $data = [];
            foreach ($trainings as $i => $d) {
                $data[$i] = [
                    'id'    => $d->id,
                    'text'  => $d->title
                ];
            }
            return $data;
        }
        return view('pages.dashboard');
    }
}
