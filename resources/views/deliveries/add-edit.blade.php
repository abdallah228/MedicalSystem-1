@extends('layouts.app')
@section('content')
@php
$flag = 0;
if(isset($record))
$flag=1;
@endphp
@include('layouts.success')
@include('layouts.error')
<form method="post" class="w-75 mx-auto mt-5 pb-3"
    action="{{$flag ? url('admin/deliveries/'.$record->id) : route('deliveries.store')}}"
    enctype="multipart/form-data">
    {{csrf_field()}}
    @if($flag)
    @method('PUT')
    @endif
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name = "name" value="{{$flag ? $record->name : old('name')}}" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> phone</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter phone" name = "phone" value="{{$flag ? $record->phone : old('phone')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name = "address" value="{{$flag ? $record->address : old('address')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> lat</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter lat" name = "lat" value="{{$flag ? $record->lat : old('lat')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> long</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter long" name = "long" value="{{$flag ? $record->long : old('long')}}" required>
    </div>


    @if ($flag)
        <input type="hidden" value="{{$record->id}}" name="id">
    @endif
    <div class="form-group row mt-md-5">
        <div class="col-12 col-lg-10 ml-0 ml-lg-5">
            <button type="submit" class="btn btn-primary btn-block">{{$flag ? 'Update' : 'Add'}}</button>
        </div>
    </div>
</form>
@endsection
