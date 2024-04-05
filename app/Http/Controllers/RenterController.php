<?php

//teljes megoldás

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renter;

class RenterController extends Controller
{
    public function getRenters()
    {
        $renters = Renter::with('renting')->get();
        return response()->json(["data" => $renters]);
    }

    public function getRenter($id)
    {
        $renter = Renter::with('renting')->find($id);
        return response()->json(["data" => $renter]);
    }

    public function getRenterId($name)
    {
        $renter = Renter::where('name', $name)->first();
        $id = $renter->id;
        return $id;
    }
}
