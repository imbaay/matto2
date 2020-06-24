<div class="col-md-4">
    <div class="sidebar-items">
        <div class="card my-4">
            <div class="card-header bg-dark text-white">
                <h4>Phones Ctaegories</h4>
            </div>
            <div class="card-body">
                <ul class="ctg-list">
                    @foreach($categories as $category)
                    <li class="ctg-item">
                        <a href="{{route('category', $category->slug)}}" class="ctg-link d-block">{{$category->name}}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="card my-3">
            <div class="card-header bg-dark text-white">
                <h4>Recent Phones</h4>
            </div>
            <div class="card-body">
                @foreach($recent_phones as $phone)
                <div class="recent-book-list">
                    <a href="{{route('phone-details', $phone->id)}}" class="d-flex flex-row mb-3">
                        <div class="book-img mr-2"><img src="{{$phone->image_url}}" alt="" width="80"></div>
                        <div class="book-text">
                            <p>{{$phone->title}}</p>
                            <small><i class="fas fa-clock"></i> {{$phone->created_at->diffForHumans()}}</small>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
