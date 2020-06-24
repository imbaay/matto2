@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Nations</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('nations.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Add Nations
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="#">Discount phones</a> |</span>
                    <span class="mr-2"><a href="#">Trash phones</a></span>
                </div>
            </div>
        </div>

        @include('layouts.includes.flash-message')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nations list</h6>
            </div>
            <div class="card-body">
                @if($nations->count())
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Phones Count</th>
                                <th>Bio</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th>Action</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Phones Count</th>
                                <th>Bio</th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @foreach($nations as $nation)
                                <tr>
                                    <td>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminNationsController@destroy', $nation->id]]) !!}
                                        <div class="action d-flex flex-row">
                                            <a href="{{route('nations.edit', $nation->id)}}" class="btn-primary btn btn-sm mr-2"><i class="fas fa-edit"></i></a>

                                            <button type="submit" onclick="return confirm('Nation will delete permanently! Are you sure to delete??')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                        </div>
                                     {!! Form::close() !!}
                                    </td>
                                    <td><img src="{{$nation->image? $nation->image_url : $nation->default_img}}" height="50" alt=""></td>
                                    <td><a href="{{route('nations.edit', $nation->id)}}">{{$nation->name}}</a></td>
                                    <td>{{$nation->phones->count()}}</td>
                                    <td>{{str_limit($nation->bio, 100)}}<a href="#">read more</a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

    </div>
@endsection
