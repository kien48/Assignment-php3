@extends('admin.layouts.master')

@section('css')

@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sửa bài viết</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.articles.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tiêu đề</label>
                                        <input type="text" class="form-control" id="basiInput" name="title" value="{{$model->title}}">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Ảnh</label>
                                        <input type="file" class="form-control" id="basiInput" name="image">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <label for="basiInput" class="form-label">Danh mục</label>
                                    <select class="form-select" name="catelogue_id">
                                        @foreach($dataCatelogues as $catelogue)
                                            <option value="{{$catelogue->id}}">{{$catelogue->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div class="d-flex justify-content-between">
                                        <label for="basiInput" class="form-label">Thẻ</label>
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#myModal">
                                            Thêm thẻ
                                        </button>
                                    </div>
                                    <select class="form-select" multiple name="tag_id[]">
                                        <option ng-repeat="tag in tags" value="@{{ tag.id }}">
                                            @{{ tag.name }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-xxl-12 col-md-12">
                                    <div>
                                        <label for="basiInput" class="form-label">Nội dung</label>
                                        <textarea name="content" id="noi_dung"></textarea>
                                    </div>
                                </div>

                                <div class="col-xxl-12 col-md-12">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
                                </div>
                            </div>
                        </form>
                        <!--end row-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Thêm thẻ nhanh</h4>
                    <button type="button" class="btn-close btn-dong" data-bs-dismiss="modal"></button>
                </div>

                <form action="">
                    <!-- Modal body -->
                    <div class="modal-body">
                        <input type="text" ng-model="name" class="form-control" name="name">
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" ng-click="addTag()" class="btn btn-primary">Thêm</button>
                </form>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
    </div>
@endsection


@section('js')
    <script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'noi_dung' );
    </script>
    <script>
        viewFunction = ($scope, $http)=>{
            $scope.name = ''
            $scope.tags = []
            $scope.getTags = ()=> {
                $http.get("{{route('admin.api.tag')}}")
                    .then(function(response) {
                        $scope.tags = response.data.data
                        console.log($scope.tags)
                    });
            }
            $scope.getTags()
            $scope.addTag = ()=> {
                $http.post("{{route('admin.tags.store')}}", {
                    name: $scope.name
                }).then(function(response) {
                    Swal.fire({
                        title: "Tốt!",
                        text: "Bạn vừa thêm thẻ thành công!",
                        icon: "success"
                    });
                    document.querySelector('.btn-dong').click()
                    $scope.getTags()
                    $scope.name = ''
                })
                    .catch(function (error) {
                        Swal.fire({
                            title: "Lỗi",
                            text: "Thẻ đã tồn tại",
                            icon: "error"
                        });
                        $scope.name = ''
                    });
            }

        }
    </script>
@endsection
