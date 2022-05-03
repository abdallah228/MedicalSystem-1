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
@endsection