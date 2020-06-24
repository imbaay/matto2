@extends('layouts.admin-master')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Phones</h1>
        <div class="my-2 px-1">
            <div class="row">
                <div class="col-6">
                    <div>
                        <a href="{{route('phones.create')}}" class="btn-primary btn-sm">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Add Phone
                        </a>
                    </div>
                </div>
                <div class="col-6 text-right">
                    <span class="mr-2"><a href="{{route('phones.index')}}">All phones</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.discountPhones')}}">Discount phones</a> |</span>
                    <span class="mr-2"><a href="{{route('admin.trash-phones')}}">Trash phones</a></span>
                </div>
            </div>
        </div>

        @if(isset($discount_phones))
            <div class="alert alert-primary"><strong>{{$discount_phones}}</strong></div>
        @endif
        @include('layouts.includes.flash-message')
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All phones list</h6>
            </div>
            <div class="card-body">
                @if($phones->count())
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Nation</th>
                            <th>Regular Price</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>Action</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Nation</th>
                            <th>Regular Price</th>
                            <th>Discount</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                        </tfoot>
                        <tbody>
                        @foreach($phones as $phone)
                        <tr>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminPhonesController@destroy', $phone->id]]) !!}
                                <div class="action d-flex flex-row">
                                    <a href="{{route('phones.edit', $phone->id)}}" class="btn-primary btn btn-sm mr-2"><i class="fas fa-edit"></i></a>

                                    <button type="submit" onclick="return confirm('Phone will move to trash! Are you sure to delete??')" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                                </div>
                                {!! Form::close() !!}
                            </td>
                            <td><img src="{{$phone->image_url}}" width="60" height="70" alt=""></td>
                            <td><a href="{{route('phones.edit', $phone->id)}}">{{$phone->title}}</a></td>
                            <td>{{$phone->category->name}}</td>
                            <td>{{$phone->nation->name}}</td>
                            <td>{{$phone->init_price}}</td>
                            <td>{{$phone->discount_rate}}%</td>
                            <td>{{$phone->price}}</td>
                            <td>{{$phone->quantity}}</td>
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
