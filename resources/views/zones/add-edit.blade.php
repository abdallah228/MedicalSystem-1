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
    action="{{$flag ? url('admin/zones/'.$record->id) : route('zones.store')}}"
    enctype="multipart/form-data">
    {{csrf_field()}}
    @if($flag)
    @method('PUT')
    @endif
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name EN</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter EN Name" name = "name_en" value="{{$flag ? $record->name_en : old('name_en')}}" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Name AR</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter AR Name" name = "name_ar" value="{{$flag ? $record->name_ar : old('name_ar')}}" required>
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
