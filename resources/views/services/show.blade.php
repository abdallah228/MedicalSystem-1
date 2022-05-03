@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name EN</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter EN Name" name = "name_en" value="{{$record->name_en}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name AR</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter AR Name" name = "name_ar" value="{{$record->name_ar}}" >
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Description En</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description_en" name = "description_en" value="{{$record->description_en}}" >
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Description Ar</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description_ar" name = "description_ar" value="{{$record->description_ar}}" >
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Price</label>
        <input disabled type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" name = "price" value="{{$record->price}}" >
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Image </label>
        <img src="{{$record->image}}" height="200px" width="200px" >
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Service Provider </label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter service_provider_id" name = "service_provider_id" value="{{$record->serviceProvider->name_en}}" >
    </div>
@endsection
