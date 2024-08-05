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
                                        <img
                                            src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
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
                                        <li class="list-inline-item"><a
                                                href="{{route('tag',['id'=>$tag->id,'slug'=>$tag->slug])}}">{{$tag->name}}</a>
                                        </li>
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

                        <div ng-repeat="comment in comments" class="media d-block d-sm-flex mb-4 pb-4" style="margin-left: @{{ comment.parent_id ? '20px' : '0' }}">
                            <div class="media-body">
                                <a href="#!" class="h5 d-inline-block mb-3"><i ng-show="{{$model->author_id}} == comment.user.id" class="ti ti-user text-warning">Tác giả: </i> @{{ comment.user.name }}</a>

                                <p>@{{ comment.content }}</p>

                                <span class="text-black-800 mr-3 font-weight-600">@{{ comment.created_at | date:'MMMM d, yyyy \a\t h:mm a' }}</span>

                                <!-- Nút để hiện/ẩn bình luận con -->
                                <a ng-show="comment.children.length > 0" class="text-primary font-weight-600" href="#!" ng-click="comment.showChildren = !comment.showChildren">
                                    @{{ comment.showChildren ? 'Ẩn câu trả lời (' + comment.children.length + ')' : 'Hiện câu trả lời (' + comment.children.length + ')' }}
                                </a>

                                <a class="text-primary font-weight-600 ml-3" href="#!" ng-click="comment.showReplyForm = !comment.showReplyForm">
                                    Trả lời
                                </a>

                                <div ng-show="comment.showReplyForm" class="mt-3">
                                    <textarea class="form-control shadow-none" ng-model="contents" placeholder="Trả lời ngay" rows="3" required></textarea>
                                    <button type="button" class="btn btn-primary mt-2" ng-click="addComment(comment.id, contents)">Gửi</button>
                                </div>

                                <!-- Hiển thị bình luận con nếu showChildren là true -->
                                <div ng-show="comment.showChildren">
                                    <div ng-repeat="child in comment.children" class="media d-block d-sm-flex mt-3" style="margin-left: 20px;">
                                        <img class="mr-3" src="{{asset('/themes/reader/')}}/images/post/arrow.png" alt="">
                                        <div class="media-body">
                                            <a href="#!" class="h4 d-inline-block mb-3"><i ng-show="{{$model->author_id}} == child.user.id" class="ti-user h3 text-warning">Tác giả: </i> @{{ child.user.name }}</a>
                                            <p>@{{ child.content }}</p>
                                            <span class="text-black-800 mr-3 font-weight-600">@{{ child.created_at | date:'MMMM d, yyyy \a\t h:mm a' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="mb-4">Để lại một câu trả lời</h3>
                        <form>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <textarea class="form-control shadow-none" ng-model="content" rows="7" required></textarea>
                                </div>
                            </div>
                            <button class="btn btn-primary" type="button" ng-click="addCommentAll()">Bình luận ngay</button>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </section>

@endsection

@section('js')
    <script>
        viewFunction = ($scope, $http) => {
            $scope.tangView = () => {
                $http.patch('{{route('views')}}', {
                    id: {{$model->id}}
                }).then(res => {
                    console.log('thêm thành công')
                })
            }
            let minThoiGianDoc = 60;
            let demNguoc = setInterval(() => {
                minThoiGianDoc--;
                if (minThoiGianDoc <= 0) {
                    clearInterval(demNguoc)
                    $scope.tangView()
                }
            }, 1000)

            $scope.comments = [];

            $scope.loadComments = () => {
                $http.get('{{route('api.apiComment', $model->id)}}')
                    .then(res => {
                        $scope.comments = res.data.comments
                        console.log($scope.comments)
                    })
            }
            $scope.loadComments()
            $scope.addComment = (id, contents) => {
                $http.post('{{ route('addComment') }}', {
                    content: contents,
                    parent_id: id,
                    article_id: {{ $model->id }}
                })
                    .then(res => {
                        $scope.loadComments()
                        $scope.contents = ''
                    })
                    .catch(error=> {
                        console.error('Error adding comment:', error);
                    });
            };

            $scope.addCommentAll = () => {
                $http.post('{{route('addComment')}}', {
                    content: $scope.content,
                    article_id: {{$model->id}}
                })
                    .then(res => {
                        $scope.loadComments()
                        $scope.content = ''
                    })
            }
        }
    </script>
@endsection
