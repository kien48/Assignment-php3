<aside class="col-lg-4 sidebar-home">
    <!-- Search -->
    <!-- about me -->
    <div class="widget widget-about">
        <h4 class="widget-title">Xin chào, Tôi là {{$userAdmin->name}}!</h4>
        <img class="img-fluid" src="https://gcs.tripi.vn/public-tripi/tripi-feed/img/474094mGh/avatar-anime-nam-co-don-dep_085121210.jpg" alt="Themefisher">
        <p>{{$userAdmin->sayings}}</p>
        <a href="{{route('about')}}" class="btn btn-primary mb-2">Thông tin về tôi</a>
    </div>

    <!-- authors -->
    <div class="widget widget-author">
        <h4 class="widget-title">Tác giả</h4>
        @foreach($dataUserAuthor as $item)
            <div class="media align-items-center">
                <div class="mr-3">
                    @if(!$item->avatar)
                        <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                    @else
                        <img class="widget-author-image" src="{{\Storage::url($item->avatar)}}">
                    @endif
                </div>
                <div class="media-body">
                    <h5 class="mb-1"><a class="post-title" href="{{route('author.detail', $item->id)}}">{{$item->name}}</a></h5>
                    <span>{{$item->job}}</span>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Search -->

    <!-- categories -->
    <div class="widget widget-categories">
        <h4 class="widget-title"><span>Danh mục</span></h4>
        <ul class="list-unstyled widget-list">
            @foreach($dataCatelogues as $item)
                <li><a href="{{route('catelogue',$item->slug)}}" class="d-flex">{{$item->name}} <small class="ml-auto">({{$item->total}})</small></a></li>
            @endforeach
        </ul>
    </div><!-- tags -->
    <div class="widget">
        <h4 class="widget-title"><span>Tags</span></h4>
        <ul class="list-inline widget-list-inline widget-card">
            @foreach($dataTags as $tag)
                <li class="list-inline-item"><a href="{{route('tag', ['id' => $tag->id, 'slug' => $tag->slug])}}">{{$tag->name}}</a></li>
            @endforeach
        </ul>
    </div><!-- recent post -->
    <!-- Social -->
</aside>
