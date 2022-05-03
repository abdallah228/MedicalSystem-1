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
    action="{{$flag ? url('admin/categories/'.$record->id) : route('categories.store')}}"
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
        <label for="exampleFormControlSelect1"> ICON </label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name = "logo" value="{{$flag ? $record->icon : old('logo')}}" @if(!$flag)required @endif>
    </div>

    <div class="form-group">
    <label for="exampleFormControlSelect1"> Sub Category </label>
    <select class="form-control" name="parent_id">
        <option value="{{$flag ? $record->parent_id : ''}}">{{$flag ? $record->parentCategory->name_en ?? '' : ''}} </option>
        @foreach($categories as $category)
        @if($flag)
        @if($record->parent_id == $category->id)
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
    <label for="exampleFormControlSelect1"> Type </label>
    <select class="form-control" name="type">
        <option value="{{$flag ? $record->type : $types['regular']}}">{{$flag ? $record->type : ''}} </option>
        @foreach($types as $type)
        @if($flag)
        @if($record->type == $type)
        @else
        <option value="{{ $type }}">{{ $type  }}</option>
        @endif
        @else
        <option value="{{ $type }}">{{ $type  }}</option>
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
