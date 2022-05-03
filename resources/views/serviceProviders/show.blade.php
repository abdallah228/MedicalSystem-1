@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name EN</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter EN Name" name = "name_en" value="{{$record->name_en}}" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name AR</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter AR Name" name = "name_ar" value="{{$record->name_ar}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Address</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name = "address" value="{{$record->address}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Logo </label>
        <img src={{ $record->logo }} height="200px" width="200px" aria-describedby="emailHelp" name = "logo">
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Category </label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$record->category->name_en}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Zone </label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  value="{{$record->zone->name_en}}" required>
    </div>

  
@endsection
