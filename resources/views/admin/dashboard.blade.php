@extends('admin.layouts.master')

@section('content')
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">Xin chào, {{session('admin')->name}}!</h4>
                                <p class="text-muted mb-0">Chúc bạn có 1 ngày tốt đẹp.</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng bài viết đã duyệt</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$countArticlesPublic}}">0</span> bài viết </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="mdi mdi-newspaper-check text-success"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng bài viết chưa duyệt</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$countArticlesPending}}">0</span> bài viết </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                            <i class="mdi mdi-newspaper-plus text-warning"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Tổng bài viết bị ẩn</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="{{$countArticlesHidden}}">0</span> bài viết </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-danger-subtle rounded fs-3">
                                                            <i class="mdi mdi-newspaper-remove text-danger"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div> <!-- end row-->

    </div>

@endsection
