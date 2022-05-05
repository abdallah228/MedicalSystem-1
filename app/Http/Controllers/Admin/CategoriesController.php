<?php

namespace App\Http\Controllers\Admin;

use App\Enums\enum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryCreateRequest  as CreateRequest;
use App\Http\Requests\Admin\CategoryCreateRequest  as UpdateRequest;
use App\Models\Category  as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoriesController extends Controller
{
    public $path = 'categories';

    /**
    * Get All Records
    * @return \Illuminate\Http\JsonResponse
    */

    public function index()
    {
        try {
            $records = Model::with('parentCategory')->latest()->paginate(PAGINATION_COUNT);
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
            $record = Model::with('parentCategory')->find($id);
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
        $categories = Model::whereActive(true)->get();
        $types = enum::CategoryType;
        return view($this->path.'.add-edit',compact(['categories','types']));
    }

    /**
    * Create a New Record
    * @param CreateRequest $request
    * @return \Illuminate\Http\JsonResponse
    */

    public function store(CreateRequest $request)
    {
        try {
            if($request->hasFile('logo')){
                $request['icon'] = uploadImage($request->file('logo'),$this->path);
            }
            Model::create($request->except('logo'));
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
           $record = Model::with('parentCategory')->find($request->id);
            if ($record){
                $categories = Model::whereActive(true)->get();
                $types = enum::CategoryType;
                return view($this->path.'.add-edit',compact(['record','categories','types']));
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
                deleteImage($record->getRawOriginal('icon'),$this->path);
                if($request->hasFile('logo')){
                    $request['icon'] = uploadImage($request->file('logo'),$this->path);
                }
                $record->update($request->except('logo'));
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
                deleteImage($record->getRawOriginal('icon'),$this->path);
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

    /**
    * Change Statues Of Need Delivery Flag
    * @param $id
    * @return \Illuminate\Http\JsonResponse
    */
    public function needDelivery($id)
    {
        try {
            $record = Model::find($id);
            if ($record){
                $record->need_delivery = !$record->need_delivery;
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
