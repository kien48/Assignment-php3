@extends('admin.layouts.master')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm thẻ</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="" >
                            @csrf
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="basiInput" name="name" ng-model="name">
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <button type="button" class="btn btn-success" ng-click="addTag()">Tạo mới</button>
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
@endsection
@section('js')

    <script>
        viewFunction = ($scope, $http)=>{
            $scope.name = ''
            $scope.addTag = ()=> {
                $http.post("{{route('admin.tags.store')}}", {
                    name: $scope.name
                }).then(function(response) {
                    Swal.fire({
                        title: "Tốt!",
                        text: "Bạn vừa thêm thẻ thành công!",
                        icon: "success"
                    });
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
