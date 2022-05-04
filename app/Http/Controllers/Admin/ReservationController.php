<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\ReservationListResource as ListResource;
use App\Models\Reservation  as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public $path = 'reservations';

    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $records = Model::latest()->paginate(2);
            return view($this->path.'.list', compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }



    /**
    * Change Statues Of Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function changeStatues($id,Request $request)
    {
        try {
            $record = Model::find($id);
            if ($record){
                if($request->active == 'approved')
                $record->active = 1;
                elseif($request->active == 'refused')
                $record->active = 2;
                else
                $record->active = 0;

                $record->save();
                return redirect('admin/'.$this->path)->with('success','Statues Changed Successfully');
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }
}
