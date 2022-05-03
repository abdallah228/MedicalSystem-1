<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryCreateRequest  as CreateRequest;
use App\Http\Requests\Admin\DeliveryUpdateRequest  as UpdateRequest;
use App\Http\Resources\Admin\DeliveryListResource  as ListResource;
use App\Http\Resources\Admin\DeliverySingleResource  as SingleResource;
use App\Models\Delivery as Model;
use Illuminate\Support\Facades\Log;

class DeliveriesController extends Controller
{
    public $path = 'deliveries';

    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $data = Model::latest()->get();
            $records = ListResource::collection($data);
            return view($this->path.'.list', compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
    * Get Single Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function show($id)
    {
        try {
            $data = Model::find($id);
            if ($data){
            $record = new SingleResource($data);
                return view($this->path.'.show',compact(['record']));
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path.'.add-edit');
    }

    /**
    * Create a New Record
    * @param CreateRequest $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store(CreateRequest $request)
    {
        try {
            $record = Model::create($request->all());
            return redirect()->route('deliveries.index')->with('success','Created Successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
           $record = Model::find($id);
            if ($record){
                return view($this->path.'.add-edit',compact(['record']));
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
    * Update Record
    * @param UpdateRequest $request, $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->update($request->all());
                return redirect()->route('deliveries.index')->with('success','Updated Successfully');
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
    * Delete Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function destroy($id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->delete();
                return redirect()->back()->with('success','Deleted Successfully');
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }


    /**
    * List Trashed Records
    * @return \Illuminate\Http\JsonResponse
    */
    public function trashed()
    {
        try {
            $data = Model::onlyTrashed()->get();
            $records = ListResource::collection($data);
            return view($this->path.'.list'.'/trashed', compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

    /**
    * Restore Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function restore($id)
    {
        try {
            $record = Model::onlyTrashed()->find($id);
            if ($record){
                $record->restore();
                return redirect('/'.$this->path.'/trashed')->with('success','Restored Successfully');
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }


    /**
    * Change Statues Of Record
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function changeStatues($id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->active = !$record->active;
                $record->save();
                return redirect('/'.$this->path)->with('success','Statues Changed Successfully');
            }else {
                return redirect('/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.500');
        }
    }

}
