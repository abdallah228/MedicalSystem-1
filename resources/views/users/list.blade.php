@extends('layouts.app')
@section('content')

                    <div class="row">
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
                        <th scope="col">Phone</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                        @foreach($records as $record)
                        <td>{{$record->id}}</td>
                        <td>{{$record->name}}</td>
                        <td>{{$record->phone}}</td>
                        <td>{!! $record->active == 1 ? "<button class='btn-success btn-sm'> Active</button>" : "<button class='btn-danger btn-sm'> DeActive</button>" !!}</td>
                        <td>
                            <div class="row">
                                <div class="col-10 col-md-3">
                                    <!-- Delete Button -->
                                    <form method="post" action="{{route('users.changeStatues',$record->id)}}"
                                        enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @method('put')
                                        <input type="hidden" value="{{$record->id}}" name="id">
                                        @if($record->active == true)
                                            <button type="submit" class="btn btn-danger mt-1"><i class="fa fa-times"></i></button>
                                        @else
                                            <button type="submit" class="btn btn-success mt-1"><i class="far fa-check"></i></button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                </div>
            {!! $records -> links() !!}

                @endif
@endsection
