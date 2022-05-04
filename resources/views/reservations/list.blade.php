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
                        <th scope="col">TotalPrice</th>
                        <th scope="col">User Name</th>
                        <th scope="col">User phone</th>
                        <th scope="col">Service</th>
                        <th scope="col">Zone</th>
                        <th scope="col">ReservationDate</th>
                        <th scope="col">ReservationTime</th>
                        <th scope="col">Address</th>



                        <th scope="col">status</th>
                        <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        <tr>
                        @foreach($records as $record)
                        <td>{{$record->id}}</td>
                        <td>{{$record->total_price}}</td>
                        <td>{{$record->user->name}}</td>
                        <td>{{$record->user->phone}}</td>
                        <td>{{$record->service['name_'.app()->getLocale()]}}</td>
                        <td>{{$record->zone['name_'.app()->getLocale()]}}</td>
                        <td>{{$record->reservation_date}}</td>
                        <td>{{$record->reservation_time}}</td>
                        <td>{{$record->address}}</td>
                        <td>
                            @if($record->active == 0)
                            {!! "<button class='btn-warning btn-sm'> pending</button>"  !!}
                            @elseif ($record->active == 1)
                            {!! "<button class='btn-success btn-sm'> Approved</button>"  !!}
                            @else
                            {!! "<button class='btn-danger btn-sm'> Refused</button>"  !!}
                            @endif
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-10 col-md-3">
                                    <!-- changeStatu -->
                                    <form method="post" action="{{route('reservations.changeStatues',$record->id)}}"
                                        enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        @method('put')
                                        {{-- <input type="hidden" value="{{$record->id}}" name="id"> --}}
                                        <div class = "btn-group">
                                            @if($record->active == 0)

                                                <button class='btn btn-success btn-sm border-1 border-success' name="active" value="approved"> Approved</button>
                                                <button class='btn btn-danger btn-sm border-1 border-danger' name="active" value="refused"> Refused</button>

                                            @elseif ($record->active == 1)

                                                <button class='btn btn-danger btn-sm border-1 border-danger' name="active" value="refused"> Refused</button>
                                                <button class='btn btn-warning btn-sm border-1 border-warning ' name="active" value="pending"> Pending</button>

                                            @elseif($record->active == 2)

                                                <button class='btn btn-success btn-sm border-1 border-success' name="active" value="approved"> Approved</button>
                                                <button class='btn btn-warning btn-sm border-1 border-warning ' name="active" value="pending"> Pending</button>

                                            @endif

                                        </div>



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
