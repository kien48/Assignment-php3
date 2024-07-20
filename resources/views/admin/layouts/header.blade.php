<div class="layout-width">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box horizontal-logo">
                <a href="index.html" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{asset('/themes/velzon/')}}/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                    <span class="logo-lg">
                            <img src="{{asset('/themes/velzon/')}}/assets/images/logo-dark.png" alt="" height="17">
                        </span>
                </a>

                <a href="index.html" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{asset('/themes/velzon/')}}/assets/images/logo-sm.png" alt="" height="22">
                        </span>
                    <span class="logo-lg">
                            <img src="{{asset('/themes/velzon/')}}/assets/images/logo-light.png" alt="" height="17">
                        </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
            </button>

            <!-- App Search-->
        </div>

        <div class="d-flex align-items-center">

            <div class="dropdown d-md-none topbar-head-dropdown header-item">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bx bx-search fs-22"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-search-dropdown">
                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


            <div class="ms-1 header-item d-none d-sm-flex">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                    <i class='bx bx-fullscreen fs-22'></i>
                </button>
            </div>

            <div class="ms-1 header-item d-none d-sm-flex">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                    <i class='bx bx-moon fs-22'></i>
                </button>
            </div>

            <div class="dropdown topbar-head-dropdown ms-1 header-item" id="notificationDropdown">
                <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" id="page-header-notifications-dropdown" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                    <i class='bx bx-bell fs-22'></i>
                    <span class="position-absolute topbar-badge fs-10 translate-middle badge rounded-pill bg-danger">@{{demTin}}<span class="visually-hidden">unread messages</span></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0" aria-labelledby="page-header-notifications-dropdown">

                    <div class="dropdown-head bg-primary bg-pattern rounded-top">
                        <div class="p-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 fs-16 fw-semibold text-white"> Thông Báo </h6>
                                </div>
                                <div class="col-auto dropdown-tabs">
                                    <span class="badge bg-light-subtle text-body fs-13"> @{{demTin}} tin mới</span>
                                </div>
                            </div>
                        </div>

                        <div class="px-2 pt-2">
                            <ul class="nav nav-tabs dropdown-tabs nav-tabs-custom" data-dropdown-tabs="true" id="notificationItemsTab" role="tablist">
                                <li class="nav-item waves-effect waves-light">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#all-noti-tab" role="tab" aria-selected="true">
                                        Tất cả (@{{demTin}})
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>

                    <div class="tab-content position-relative" id="notificationItemsTabContent">
                        <div class="tab-pane fade show active py-2 ps-2" id="all-noti-tab" role="tabpanel">
                            <div data-simplebar style="max-height: 300px;" class="pe-2">

                                <div class="text-reset notification-item d-block dropdown-item position-relative" ng-repeat="tin in danhSachTin">
                                    <div class="d-flex">
                                        <div class="avatar-xs me-3 flex-shrink-0">
                                                <span class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                    <i class='bx bx-message-square-dots'></i>
                                                </span>
                                        </div>
                                        <div class="flex-grow-1">
                                                <h6 class="mt-0 mb-2 fs-13 lh-base">
                                                    @{{tin.content}}
                                                </h6>
                                            <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                                                <span><i class="mdi mdi-clock-outline"></i>
                                                        @{{ tin.created_at | date:'HH:mm:ss, dd MMMM yyyy' }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="px-2 fs-15">
                                            <div class="form-check notification-check">
                                                <button type="button" class="btn btn-danger btn-sm" ng-click="daXem(tin.id)" style="width: 100px">Đánh dấu đã đọc</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown ms-sm-3 header-item topbar-user">
                <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                             @if(!session('admins')->avatar)
                                <img class="rounded-circle header-profile-user"  src="https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg">
                            @else
                                <img class="rounded-circle header-profile-user"  src="{{\Storage::url(session('admins')->avatar)}}">
                            @endif
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{session('admins')->name}}</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">{{session('admins')->role}}</span>
                            </span>
                        </span>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <h6 class="dropdown-header">Chào mừng {{session('admins')->name}}!</h6>
                    <a class="dropdown-item" href="{{route('admins.profile')}}"><i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span class="align-middle">Thông tin cá nhân</span></a>
                    <a class="dropdown-item" href="{{route('admins.logout')}}"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Đăng xuất</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
