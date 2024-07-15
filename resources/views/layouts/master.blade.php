<!DOCTYPE html>
<html lang="en-us"><head>
    <meta charset="utf-8">
    <title>@yield('title') | Reader</title>

    <!-- mobile responsive meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="This is meta description">
    <meta name="author" content="Themefisher">
    <meta name="generator" content="Hugo 0.74.3" />
    <!-- theme meta -->
    <meta name="theme-name" content="reader" />
    <!-- plugins -->
    <meta property="og:title" content="Reader | Hugo Personal Blog Template" />
    <meta property="og:description" content="This is meta description" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="" />
    <meta property="og:updated_time" content="2020-03-15T15:40:24+06:00" />
    @include('layouts.partials.css')
</head>
<body>
<!-- navigation -->
<header class="navigation fixed-top">
    @include('layouts.partials.head')
</header>
<!-- /navigation -->

@yield('content')

<footer class="footer">
    @include('layouts.partials.footer')
</footer>
<!-- The Modal -->
<div class="modal" id="myModalDangKy">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đăng ký</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="name">Tên tài khoản:</label>
                        <input type="text" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Nhập lại mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Đăng ký</button>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal" id="myModalDangNhap">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đăng nhập</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd">
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Nhớ tôi
                        </label>
                    </div>
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<!-- JS Plugins -->
@include('layouts.partials.js')

</body>
</html>
