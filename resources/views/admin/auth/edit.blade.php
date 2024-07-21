@extends('admin.layouts.master')

@section('content')
    <div class="position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg profile-setting-img">
        </div>
    </div>

    <div class="row">
        <div class="col-xxl-3">
            <div class="card mt-n5">
                <div class="card-body p-4">
                    <div class="text-center">
                        <form action="{{route('admin.profile.update',session('admin')->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                        <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                            @if(!session('admin')->avatar)
                                <img  class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                            @else
                                <img  class="rounded-circle avatar-xl img-thumbnail user-profile-image" src="{{\Storage::url(session('admin')->avatar)}}">
                            @endif
                            <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                <input id="profile-img-file-input" type="file" name="avatar" class="profile-img-file-input">
                                <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                    <span class="avatar-title rounded-circle bg-light text-body">
                                                        <i class="ri-camera-fill"></i>
                                                    </span>
                                </label>
                            </div>
                        </div>
                        <h5 class="fs-16 mb-1">{{session('admin')->name}}</h5>
                        <p class="text-muted mb-0">{{session('admin')->job}}</p>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-5">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Hoàn thành hồ sơ của bạn</h5>
                        </div>
                    </div>
                    <div class="progress animated-progress custom-progress progress-label">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{$percent}}%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                            <div class="label">{{number_format($percent,2)}}%</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--end col-->
        <div class="col-xxl-9">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i> Thông tin cá nhân
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i> Đổi mật khẩu
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">Họ và tên</label>
                                            <input type="text" class="form-control" name="name" placeholder="Enter your firstname" value="{{session('admin')->name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">Địa chỉ email</label>
                                            <input type="email" class="form-control" name="email" placeholder="Enter your email" value="{{session('admin')->email}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="JoiningdatInput" class="form-label">Công việc</label>
                                            <input type="text" class="form-control" name="job" data-provider="flatpickr" value="{{session('admin')->job}}"/>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3 pb-2">
                                            <label for="exampleFormControlTextarea" class="form-label">Câu nói</label>
                                            <textarea name="sayings" class="form-control" id="exampleFormControlTextarea" placeholder="Enter your description" rows="3" >{{session('admin')->sayings}}
                                            </textarea>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                            <button type="reset" class="btn btn-soft-success">Nhập lại</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="javascript:void(0);">
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">Mật khẩu cũ*</label>
                                            <input type="password" class="form-control" id="oldpasswordInput" placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">Mật khẩu mới*</label>
                                            <input type="password" class="form-control" id="newpasswordInput" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">Nhập lại mật khẩu*</label>
                                            <input type="password" class="form-control" id="confirmpasswordInput" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                                <a href="javascript:void(0);" class="link-primary text-decoration-underline">Quên mật khẩu ?</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Đổi mật khẩu</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
