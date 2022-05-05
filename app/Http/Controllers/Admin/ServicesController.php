<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ServiceCreateRequest  as CreateRequest;
use App\Http\Requests\Admin\ServiceUpdateRequest  as UpdateRequest;
use App\Models\Service as Model;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public $path = 'services';


    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $records = Model::with('serviceProvider')->latest()->paginate(PAGINATION_COUNT);
            return view($this->path.'.list',compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
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
            $record = Model::with('serviceProvider')->find($id);
            if ($record){
                return view($this->path.'.show',compact(['record']));
            }else {
                 return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $serviceProviders = ServiceProvider::whereActive(true)->get();
        return view($this->path.'.add-edit',compact(['serviceProviders']));
    }

    /**
    * Create a New Record
    * @param CreateRequest $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store(CreateRequest $request)
    {
        try {
            if($request->hasFile('img')){
                $request['image'] = uploadImage($request->file('img'),$this->path);
            }
            Model::create($request->except('img'));
            return redirect('admin/'.$this->path)->with('success','Created Successfully');
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
           $record = Model::with('serviceProvider')->find($request->id);
            if ($record){
                $serviceProviders = ServiceProvider::whereActive(true)->get();
                return view($this->path.'.add-edit',compact(['record','serviceProviders']));
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
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
                deleteImage($record->getRawOriginal('image'),$this->path);
                if($request->hasFile('img')){
                    $request['image'] = uploadImage($request->file('img'),$this->path);
                }
                $record->update($request->except('img'));
                return redirect('admin/'.$this->path)->with('success','Updated Successfully');
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
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
                deleteImage($record->getRawOriginal('image'),$this->path);
                $record->delete();
                return redirect('admin/'.$this->path)->with('success','Deleted Successfully');
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }


    /**
    * List Trashed Records
    * @return \Illuminate\Http\JsonResponse
    */
    public function trashed()
    {
        try {
            $records = Model::onlyTrashed()->get();
            return view($this->path.'.list'.'/trashed', compact('records'));
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
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
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
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
    public function changeStatues($id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->active = !$record->active;
                $record->save();
                return redirect('admin/'.$this->path)->with('success','Statues Changed Successfully');
            }else {
                return redirect('admin/'.$this->path)->with('error','Not Found');
            }
        } catch (\Throwable $th) {
            Log::error($th);
            return view('layouts.wrong');
        }
    }
}
