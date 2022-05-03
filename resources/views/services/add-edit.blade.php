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
    action="{{$flag ? url('admin/services/'.$record->id) : route('services.store')}}"
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
        <label for="exampleFormControlSelect1"> Description En</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description_en" name = "description_en" value="{{$flag ? $record->description_en : old('description_en')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Description Ar</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter description_ar" name = "description_ar" value="{{$flag ? $record->description_ar : old('description_ar')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Price</label>
        <input type="number" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter price" name = "price" value="{{$flag ? $record->price : old('price')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Image </label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="img" value="{{$flag ? $record->image : old('image')}}" @if(!$flag)required @endif >
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1"> Service Provider </label>
    <select class="form-control" name="service_provider_id">
        <option value="{{$flag ? $record->service_provider_id : ''}}">{{$flag ? $record->serviceProvider->name_en ?? '' : ''}} </option>
        @foreach($serviceProviders as $serviceProvider)
        @if($flag)
        @if($record->service_provider_id == $serviceProvider->id)
        @else
        <option value="{{ $serviceProvider->id }}">{{ $serviceProvider["name_".app()->getLocale()]  }}</option>
        @endif
        @else
        <option value="{{ $serviceProvider->id }}">{{ $serviceProvider["name_".app()->getLocale()]  }}</option>
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
