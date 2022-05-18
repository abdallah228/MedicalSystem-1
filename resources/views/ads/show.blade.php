@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Title EN</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter EN Name" name = "name_en" value="{{$record->title_en}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Title AR</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter AR Name" name = "name_ar" value="{{$record->title_ar}}" >
    </div>


    <div class="form-group">
        <label for="exampleFormControlSelect1"> Image </label>
        <img src="{{$record->image}}" height="200px" width="200px" >
    </div>

@endsection
