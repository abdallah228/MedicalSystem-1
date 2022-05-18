@extends('layouts.app')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@php
$flag = 0;
if(isset($record))
$flag=1;
@endphp
@include('layouts.success')
@include('layouts.error')
<form method="post" class="w-75 mx-auto mt-5 pb-3"
    action="{{$flag ? url('admin/ads/'.$record->id) : route('ads.store')}}"
    enctype="multipart/form-data">
    {{csrf_field()}}
    @if($flag)
    @method('PUT')
    @endif
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Title En</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter EN Title" name = "title_en" value="{{$flag ? $record->title_en : old('title_en')}}" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlSelect1"> Title Ar</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Ar Title" name = "title_ar" value="{{$flag ? $record->title_ar : old('title_ar')}}" required>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1"> Image </label>
        <input type="file" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name ="img" value="{{$flag ? $record->image : old('image')}}" @if(!$flag)required @endif >
    </div>
    {{-- <div class="col-6">
        <img id="showImage" class="rounded-circle" src="{{ !empty($record->image) ? asset('uploads/admin_images/'.auth('admin')->user()->profile_photo_path):asset('uploads/admin_images/custome.png')  }}" alt="User Avatar"
        height="100px" width="100px"
        >
      </div> --}}


    @if ($flag)
        <input type="hidden" value="{{$record->id}}" name="id">
    @endif
    <div class="form-group row mt-md-5">
        <div class="col-12 col-lg-10 ml-0 ml-lg-5">
            <button type="submit" class="btn btn-primary btn-block">{{$flag ? 'Update' : 'Add'}}</button>
        </div>
    </div>
</form>


{{-- jquery code to show image in realtime --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src',e.target.result);
            }
           var v =  reader.readAsDataURL(e.target.files['0']);
           console.log(v);
        });
    });
</script>

@endsection
