@extends('layouts.app')
@section('content')
    <div class="form-group">
        <label for="exampleFormControlSelect1"> KEY</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name = "key" value="{{$record->key}}" >
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> VALUE</label>
        <input disabled type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"  name = "value" value="{{$record->value}}" >
    </div>


@endsection
