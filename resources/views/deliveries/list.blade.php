@extends('layouts.app')
@section('content')

                    <div class="row">
                        <div class="col-5 m-1">
                            <a href="{{route('deliveries.create')}}" class="btn btn-success mb-4 mt-2"><i class = "fa fa-plus"></i> Add New </a>
                        </div>
                        <div class="col-6">
                            <!-- Actual search box -->
                            <div class="form-group has-search">
                                    <span class="fa fa-search form-control-feedback"></span>
                                    <input type="text" id="tableSearch" class="form-control" placeholder="Search">
                            </div>
                        </div>
                        @include('layouts.success')
                        @include('layouts.error')
                    @if($records->count() == 0)
                        <div class="col-12">
                            <p class="alert alert-warning text-dark"> No Data Available</p>
                        </div>
                    @else
                    <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                        <th scope="col"># </th>
                        <th scope="col">Name</th>
                        <th scope="col">address</th>
                        <th scope="col">phone</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                        @foreach($records as $record)
                        <td>{{$record->id}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->address}}</td>
                        <td>{{$record->phone}}</td>



                        <td>
                        <div class="row">
                            <div class="col-10 col-md-3">
                                <!-- Delete Button -->
                                <form method="post" action="{{route('deliveries.destroy',$record->id)}}"
                                    enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    @method('delete')
                                    <input type="hidden" value="{{$record->id}}" name="id">
                                    <button type="submit" class="btn btn-danger mt-1"><i class="far fa-trash-alt"></i></button>
                                </form>
                            </div>
                            <div class="col-10 col-md-3">
                                <!-- Edit Button -->
                                <form method="post"
                                    action= "{{route('deliveries.edit',$record->id)}}"
                                    enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @method('get')
                                        <input type="hidden" value="{{$record->id}}" name="id">
                                        <button type="submit" class="btn btn-secondary mt-1"><i class="far fa-edit"></i></button>
                                </form>
                            </div>

                        </div>
                        </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </div>
                @endif
@endsection
