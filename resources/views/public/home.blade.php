@extends('layouts.master')

@section('content')
    <!-- Slider Area -->
    <section class="welcome-area">
        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="slider-img slider-bg-1"></div>
                    <div class="carousel-caption">
                        <h2>First slide level</h2>
                        <p class="d-none d-md-block">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sapiente, laborum earum.
                            Officiis molestiae ratione nobis, eveniet quidem veniam exercitationem laudantium.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="main-content">
        <div class="container">
            <div class="row">
                <!-- Sidebar Content -->
                @include('layouts.includes.side-bar')
                <!-- //Sidebar End -->
                <div class="col-md-8">
                    <div class="content-area">
                        <div class="card my-4">
                            <div class="card-header bg-dark">
                                <h4><a href="{{route('category', 'iphone')}}" class="text-white">iPhone</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(! $iphones->count())
                                       <div class="alert alert-warning">No phones availble</div>
                                    @else
                                        @foreach($iphones as $phone)
                                            <div class="col-lg-3 col-6">
                                                <div class="book-wrap">
                                                    <div class="book-image mb-2">
                                                        <a href="{{route('phone-details', $phone->id)}}"><img src="{{$phone->image_url}}" alt=""></a>
                                                        @if($phone->discount_rate)
                                                            <h6><span class="badge badge-warning discount-tag">Discount {{$phone->discount_rate}}%</span></h6>
                                                        @endif
                                                    </div>
                                                    <div class="book-title mb-2">
                                                        <a href="{{route('phone-details', $phone->id)}}">{{str_limit($phone->title, 30)}}</a>
                                                    </div>
                                                    <div class="book-author mb-2">
                                                        <small>Made in <a href="{{route('nation', $phone->nation->slug)}}">{{$phone->nation->name}}</a></small>
                                                    </div>
                                                    <div class="pbook-price mb-3">
                                                        @if($phone->discount_rate)
                                                            <span class="line-through mr-3">{{$phone->init_price}} VND</span>
                                                        @endif
                                                        <span class=""><strong>{{$phone->price}} VND</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="show-more pt-2 text-right">
                                    <a href="{{route('category', 'iphone')}}" class="text-secondary">See More <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card my-4">
                            <div class="card-header bg-dark">
                                <h4><a href="{{route('category', 'samsung')}}" class="text-white">Samsung</a></h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @if(! $samsungs->count())
                                        <div class="alert alert-warning">No phones availble</div>
                                    @else
                                        @foreach($samsungs as $phone)
                                            <div class="col-lg-3 col-6">
                                                <div class="book-wrap">
                                                    <div class="book-image mb-2">
                                                        <a href="{{route('phone-details', $phone->id)}}"><img src="{{$phone->image_url}}" alt=""></a>
                                                        @if($phone->discount_rate)
                                                            <h6><span class="badge badge-warning discount-tag">Discount {{$phone->discount_rate}}%</span></h6>
                                                        @endif
                                                    </div>
                                                    <div class="book-title mb-2">
                                                        <a href="{{route('phone-details', $phone->id)}}">{{str_limit($phone->title, 30)}}</a>
                                                    </div>
                                                    <div class="book-author mb-2">
                                                        <small>Made in <a href="{{route('nation', $phone->nation->slug)}}">{{$phone->nation->name}}</a></small>
                                                    </div>
                                                    <div class="pbook-price mb-3">
                                                        @if($phone->discount_rate)
                                                            <span class="line-through mr-3">{{$phone->init_price}} VND</span>
                                                        @endif
                                                        <span class=""><strong>{{$phone->price}} VND</strong></span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="show-more pt-2 text-right">
                                    <a href="{{route('category', 'samsung')}}" class="text-secondary">See More <i class="fas fa-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="discount-book mb-5" id="discount-books">
        <div class="container">
            <div class="card mb-10">
                <div class="card-header bg-dark text-white">
                    <h4><a href="{{route('discount-phones')}}" class="text-white">Discount's Phone</a></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if(! $discount_phones->count())
                            <div class="alert alert-warning">No phones available</div>
                        @else
                            @foreach($discount_phones as $phone)
                                <div class="col-lg-2 col-6">
                                    <div class="book-wrap">
                                        <div class="book-image mb-2">
                                            <a href="{{route('phone-details', $phone->id)}}"><img src="{{$phone->image_url}}" alt=""></a>
                                            @if($phone->discount_rate)
                                                <h6><span class="badge badge-warning discount-tag">Discount {{$phone->discount_rate}}%</span></h6>
                                            @endif
                                        </div>
                                        <div class="book-title mb-2">
                                            <a href="{{route('phone-details', $phone->id)}}">{{str_limit($phone->title, 30)}}</a>
                                        </div>
                                        <div class="book-author mb-2">
                                            <small>Made in <a href="{{route('nation', $phone->nation->slug)}}">{{$phone->nation->name}}</a></small>
                                        </div>
                                        <div class="pbook-price mb-3">
                                            @if($phone->discount_rate)
                                                <span class="line-through mr-3">{{$phone->init_price}} VND</span>
                                            @endif
                                            <span class=""><strong>{{$phone->price}} VND</strong></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="show-more pt-2 text-right">
                        <a href="{{route('discount-phones')}}" class="text-secondary">See More <i class="fas fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
