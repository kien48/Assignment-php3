
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="{{route('home')}}">
            <img class="img-fluid" width="100px" src="{{asset('/')}}/themes/reader/images/logo.png"
                 alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('home')}}">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        Danh mục <i class="ti-angle-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu">
                        @foreach($dataCatelogues as $item)
                            <a class="dropdown-item" href="{{route('catelogue',$item->slug)}}">{{$item->name}}</a>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('authors')}}">Tác giả</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('contact')}}">Liên hệ</a>
                </li>
            </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">
{{--            <select class="m-2 border-0 bg-transparent" id="select-language">--}}
{{--                <option id="en" value="" selected><i class="ti-user"></i> Đăng ký</option>--}}
{{--                <option id="en" value="" selected><i class="ti-user"></i> Đăng nhập</option>--}}
{{--            </select>--}}

            <!-- search -->
            <form class="search-bar" action="{{route('articles.search')}}" method="get">
                <input id="search-query" name="query" type="search" placeholder="Bạn muốn tìm gì">
            </form>
            <button type="button" class="btn btn-outline-primary btn-custom-sm" data-toggle="modal" data-target="#myModalDangKy">
                <i class="ti-user"></i> Đăng ký
            </button>
            <button type="button" class="btn btn-outline-danger btn-custom-sm" data-toggle="modal" data-target="#myModalDangNhap">
                <i class="ti-user"></i> Đăng nhập
            </button>
        </div>

    </nav>
</div>
