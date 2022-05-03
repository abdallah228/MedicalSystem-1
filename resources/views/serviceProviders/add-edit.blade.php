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
    action="{{$flag ? url('admin/serviceProviders/'.$record->id) : route('serviceProviders.store')}}"
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

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Address</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter address" name = "address" value="{{$flag ? $record->address : old('address')}}" required>
    </div>


    <div class="form-group">
        <label for="exampleFormControlSelect1"> Logo </label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "img" value="{{$flag ? $record->logo : old('img')}}" @if(!$flag)required @endif>
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1"> Category </label>
    <select class="form-control" name="category_id">
        <option value="{{$flag ? $record->category_id : ''}}">{{$flag ? $record->category->name_en ?? '' : ''}} </option>
        @foreach($categories as $category)
        @if($flag)
        @if($record->category_id == $category->id)
        @else
        <option value="{{ $category->id }}">{{ $category["name_".app()->getLocale()]  }}</option>
        @endif
        @else
        <option value="{{ $category->id }}">{{ $category["name_".app()->getLocale()]  }}</option>
        @endif
        @endforeach
    </select>
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1"> Zone </label>
    <select class="form-control" name="zone_id">
        <option value="{{$flag ? $record->zone_id : ''}}">{{$flag ? $record->zone->name_en ?? '' : ''}} </option>
        @foreach($zones as $zone)
        @if($flag)
        @if($record->zone_id == $zone->id)
        @else
        <option value="{{ $zone->id }}">{{ $zone["name_".app()->getLocale()]  }}</option>
        @endif
        @else
        <option value="{{ $zone->id }}">{{ $zone["name_".app()->getLocale()]  }}</option>
        @endif
        @endforeach
    </select>
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
