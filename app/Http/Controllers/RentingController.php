<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Renting;

class RentingController extends Controller
{
    public function getRentings()
    {
        $rentings = Renting::all();
        return response()->json(["data" => $rentings], 200);
    }

    public function addRenting(Request $request)
    {
        $input = $request->all();
        $renting = new Renting;
        $renting->writer = $input['writer'];
        $renting->type = $input['type'];
        $renting->title = $input['title'];
        $renting->renter_id = (new RenterController)->getRenterId($input['name']); //teljes megoldás
        // $renting->renter_id = $input['renter_id']; (egyszerűbb megoldás)

        $renting->save();
        return response()->json(["message" => "Sikeres adat rögzítés"]);
    }

    public function getRenting($id)
    {
        $renting = Renting::find($id);
        return response()->json(["renting" => $renting]);
    }

    public function updateRenting(Request $request, $id)
    {
        $input = $request->all();
        $renting = Renting::find($id);
        $renting->writer = $input['writer'];
        $renting->type = $input['type'];
        $renting->title = $input['title'];
        $renting->renter_id = (new RenterController)->getRenterId($input['name']);
        $renting->save();
        return response()->json(["message" => "Sikeres adat frissítés", "data" => $renting]);
    }

    public function deleteRenting($id)
    {
        $renting = Renting::find($id);
        $renting->delete();
        return response()->json(["message" => "Sikeres adat törlés"]);
    }
}
