<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('/themes/velzon/')}}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('/themes/velzon/')}}/assets/images/logo-dark.png" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('/themes/velzon/')}}/assets/images/logo-sm.png" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('/themes/velzon/')}}/assets/images/logo-light.png" alt="" height="17">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.home')}}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li> <!-- end Dashboard Menu -->

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-newspaper-line"></i> <span data-key="t-layouts">Bài viết</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarLayouts">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.articles.index')}}"  class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                            @if(session('admin')->role == 'author')
                                <li class="nav-item">
                                    <a href="{{route('admin.articles.create')}}" class="nav-link" data-key="t-detached">Tạo mới</a>
                                </li>
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                                @elseif(session('admin')->role == 'admin')
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarCatelogues" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class="ri-layout-3-line"></i> <span data-key="t-layouts">Danh mục</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarCatelogues">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.catelogues.index')}}"  class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                            @if(session('admin')->role == 'editor')
                                <li class="nav-item">
                                    <a href="{{route('admin.catelogues.create')}}" class="nav-link" data-key="t-detached">Tạo mới</a>
                                </li>
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                            @elseif(session('admin')->role == 'admin')
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarTag" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarLayouts">
                        <i class=" ri-hashtag"></i> <span data-key="t-layouts">Thẻ</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarTag">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.tags.index')}}"  class="nav-link" data-key="t-horizontal">Danh sách</a>
                            </li>
                            @if(session('admin')->role == 'editor')
                                <li class="nav-item">
                                    <a href="{{route('admin.tags.create')}}" class="nav-link" data-key="t-detached">Tạo mới</a>
                                </li>
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                            @elseif(session('admin')->role == 'admin')
                                <li class="nav-item">
                                    <a href="layouts-two-column.html" target="_blank" class="nav-link" data-key="t-two-column">Thống kê</a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </li> <!-- end Dashboard Menu -->
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarAuth" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarAuth">
                        <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Tài khoản</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAuth">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="#sidebarAdmin" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignIn" data-key="t-signin"> QUản trị viên
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAdmin">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.admins.index')}}" class="nav-link" data-key="t-basic"> Danh sách
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.admins.create')}}" class="nav-link" data-key="t-cover"> Thêm mới
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarEditor" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarSignUp" data-key="t-signup"> Biên tập
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarEditor">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.editors.index')}}" class="nav-link" data-key="t-basic"> Danh sách
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.editors.create')}}" class="nav-link" data-key="t-cover"> Thêm mới
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a href="#sidebarAuthor" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass" data-key="t-password-reset">
                                   Tác giả
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarAuthor">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.authors.index')}}" class="nav-link" data-key="t-basic">
                                                Danh sách </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{route('admin.users.authors.create')}}" class="nav-link" data-key="t-cover">
                                                Thêm mới </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a href="#sidebarMember" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarResetPass" data-key="t-password-reset">
                                    Thành viên
                                </a>
                                <div class="collapse menu-dropdown" id="sidebarMember">
                                    <ul class="nav nav-sm flex-column">
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-basic.html" class="nav-link" data-key="t-basic">
                                                Danh sách </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="auth-pass-reset-cover.html" class="nav-link" data-key="t-cover">
                                                Thêm mới </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
