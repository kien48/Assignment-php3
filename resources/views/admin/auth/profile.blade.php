@extends('admin.layouts.master')


@section('content')

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{asset('/themes/velzon/')}}/assets/images/profile-bg.jpg" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    @if(!session('admin')->avatar)
                        <img class="img-thumbnail rounded-circle"  src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                    @else
                        <img class="img-thumbnail rounded-circle"  src="{{\Storage::url(session('admin')->avatar)}}">
                    @endif
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{session('admin')->name}}</h3>
                    <p class="text-white text-opacity-75">{{session('admin')->role}}</p>
                    <div class="hstack text-white-50 gap-1">
                        <div>
                            <i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{session('admin')->job}}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">24.3K</h4>
                            <p class="fs-14 mb-0">Followers</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-4">
                        <div class="p-2">
                            <h4 class="text-white mb-1">1.3K</h4>
                            <p class="fs-14 mb-0">Following</p>
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->

        </div>
        <!--end row-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="d-flex profile-wrapper">
                    <!-- Nav tabs -->
                    <ul class="nav nav-pills animation-nav profile-nav gap-2 gap-lg-3 flex-grow-1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" data-bs-toggle="tab" href="#overview-tab" role="tab">
                                <i class="ri-airplay-fill d-inline-block d-md-none"></i> <span class="d-none d-md-inline-block">Tổng quan</span>
                            </a>
                        </li>
                    </ul>
                    <div class="flex-shrink-0">
                        <a href="{{route('admin.profile.edit')}}" class="btn btn-success"><i class="ri-edit-box-line align-bottom"></i> Chỉnh sửa hồ sơ</a>
                    </div>
                </div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Hoàn thành hồ sơ của bạn</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar bg-danger" role="progressbar" style="width: {{$percent}}%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">
                                                <div class="label">{{number_format($percent,2)}}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Thông tin</h5>
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                <tr>
                                                    <th class="ps-0" scope="row">Họ và tên :</th>
                                                    <td class="text-muted">{{session('admin')->name}}</td>
                                                </tr>
                                                <tr>
                                                    <th class="ps-0" scope="row">E-mail :</th>
                                                    <td class="text-muted">{{session('admin')->email}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                                <!--end card-->
                                <!--end card-->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Câu nói</h5>
                                        <p>{{session('admin')->sayings}}</p>
                                        <!--end row-->
                                    </div>
                                    <!--end card-body-->
                                </div><!-- end card -->

                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
