@extends('layouts.master')
@section('title',$model->title)
@section('content')
    <section class="section">
        <div class="container">
            <div class="row justify-content-center">
                <div class=" col-lg-9   mb-5 mb-lg-0">
                    <article>
                        <div class="post-slider mb-4">
                            <img src="{{\Storage::url($model->image)}}" class="card-img" alt="post-thumb">
                        </div>

                        <h1 class="h2">{{$model->title}} </h1>
                        <ul class="card-meta my-3 list-inline">
                            <li class="list-inline-item">
                                <a href="{{route('author.detail', $model->author->id)}}" class="card-meta-author">
                                    @if(!$model->author->avatar)
                                        <img src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                                    @else
                                        <img src="{{\Storage::url($model->author->avatar)}}">
                                    @endif
                                    <span>{{$model->author->name}}</span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-timer"></i>{{$model->views}} lượt xem
                            </li>
                            <li class="list-inline-item">
                                <i class="ti-calendar"></i>{{$model->created_at->format('d-m-Y')}}
                            </li>
                            <li class="list-inline-item">
                                <ul class="card-meta-tag list-inline">
                                    @foreach($model->tags as $tag)
                                        <li class="list-inline-item"><a href="{{route('tag',['id'=>$tag->id,'slug'=>$tag->slug])}}">{{$tag->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                        <div class="content">
                            {!! $model->content !!}
                        </div>
                    </article>

                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="mb-5 border-top mt-4 pt-5">
                        <h3 class="mb-4">Bình luận</h3>
                        <div class="media d-block d-sm-flex mb-4 pb-4">
                            <a class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                <img src="images/post/user-01.jpg" class="mr-3 rounded-circle" alt="">
                            </a>
                            <div class="media-body">
                                <a href="#!" class="h4 d-inline-block mb-3">Alexender Grahambel</a>

                                <p>Ngày mai nên rảnh rỗi, không có thai. Không cần phải lo lắng về sô cô la trước đây.
                                    Ngày mai hận thù thuần khiết, tiền đình trong vulputate, tempus viverra turpis.
                                    Bây giờ trộn nước sốt và nếu không thì sẽ vulputate friingilla. Cho đến khi bài tập về nhà của lacinia kích hoạt trong cổ họng.</p>

                                <span class="text-black-800 mr-3 font-weight-600">April 18, 2020 at 6.25 pm</span>
                                <a class="text-primary font-weight-600" href="#!">Phản hồi</a>
                            </div>
                        </div>
                        <div class="media d-block d-sm-flex">
                            <div class="d-inline-block mr-2 mb-3 mb-md-0" href="#">
                                <img class="mr-3" src="{{asset('/themes/reader')}}/images/post/arrow.png" alt="">
                                <a href="#!"><img src="images/post/user-02.jpg" class="mr-3 rounded-circle" alt=""></a>
                            </div>
                            <div class="media-body">
                                <a href="#!" class="h4 d-inline-block mb-3">Nadia Sultana Tisa</a>

                                <p>Ngày mai nên rảnh rỗi, không có thai. Không cần phải lo lắng về sô cô la trước đây.
                                    Ngày mai hận thù thuần khiết, tiền đình trong vulputate, tempus viverra turpis.
                                    Bây giờ trộn nước sốt và nếu không thì sẽ vulputate friingilla. Cho đến khi bài tập về nhà của lacinia kích hoạt trong cổ họng.</p>

                                <span class="text-black-800 mr-3 font-weight-600">April 18, 2020 at 6.25 pm</span>
                                <a class="text-primary font-weight-600" href="#!">Phản hồi</a>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4">Để lại phản hồi</h3>
                        <form method="POST">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control shadow-none" name="comment" rows="7" required></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Gửi bình luận</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        viewFunction = ($scope, $http)=>{
            $scope.tangView = ()=>{
                $http.patch('{{route('views')}}',{
                    id : {{$model->id}}
                }).then(res=>{
                    console.log('thêm thành công')
                })
            }
            let minThoiGianDoc = 60;
            let demNguoc = setInterval(()=>{
                minThoiGianDoc--;
                if(minThoiGianDoc <= 0){
                    clearInterval(demNguoc)
                    $scope.tangView()
                }
            },1000)
        }
    </script>
@endsection
