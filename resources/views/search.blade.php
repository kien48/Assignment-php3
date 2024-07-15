@extends('layouts.master')
@section('title','Tìm kiếm')
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 mb-4">
                    <h1 class="h2 mb-4">Kết quả tìm kiếm cho
                        <mark>{{$query}}</mark>
                    </h1>
                </div>
                <div class="col-lg-10">
                    @foreach($articles as $item)
                        <article class="card mb-4">
                            <div class="row card-body">
                                <div class="col-md-4 mb-4 mb-md-0">
                                    <div class="post-slider slider-sm">
                                        <img src="{{\Storage::url($item->image)}}" class="card-img" alt="post-thumb" style="height:200px; object-fit: cover;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3 class="h4 mb-3"><a class="post-title" href="{{route('detail', $item->slug)}}">{{$item->title}}</a></h3>
                                    <ul class="card-meta list-inline">
                                        <li class="list-inline-item">
                                            <a href="{{route('author.detail', $item->author->id)}}" class="card-meta-author">
                                                @if(!$item->author->avatar)
                                                    <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                                                @else
                                                    <img src="{{\Storage::url($item->author->avatar)}}">
                                                @endif
                                                <span>{{$item->author->name}}</span>
                                            </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-timer"></i>{{$item->views}} lượt xem
                                        </li>
                                        <li class="list-inline-item">
                                            <i class="ti-calendar"></i>{{$item->created_at->format('d-m-Y')}}
                                        </li>
                                        <li class="list-inline-item">
                                            <ul class="card-meta-tag list-inline">
                                                @foreach($item->tags as $tag)
                                                    <li class="list-inline-item"><a href="{{route('tag', ['id' => $tag->id, 'slug' => $tag->slug])}}">{{$tag->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <p>{!!  \Str::limit($item->content, 100, '...') !!}</p>
                                    <a href="{{route('detail', $item->slug)}}" class="btn btn-outline-primary">Đọc thêm</a>
                                </div>
                            </div>
                        </article>

                    @endforeach

                </div>
            </div>
        </div>
    </section>

@endsection
