@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name EN</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "name_en" value="{{$record->name_en }}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name AR</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "name_ar" value="{{$record->name_ar}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Sub Category</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$record->parentCategory->name_en ?? 'N/A'}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Type </label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$record->type ?? 'N/A'}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Icon </label>
        <img src="{{$record->icon}}">
    </div>
   
@endsection