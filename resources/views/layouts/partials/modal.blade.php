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
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Tên tài khoản:</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pwd">Nhập lại mật khẩu:</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Đăng ký</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
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
                <button type="button" class="close dong" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('login')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            Nhớ tôi
                        </label>
                    </div>
                    <a href="" onclick="document.querySelector('.dong').click()" data-toggle="modal" data-target="#myModalQuenMatKhau">Quên mật khẩu</a>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Đăng nhập</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal" id="myModalQuenMatKhau">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Quên mật khẩu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<div class="modal" id="myModalDoiMatKhau">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Đổi mật khẩu</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth()->user() ? Auth()->user()->email : ''}}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>

</div>
<div class="modal" id="myModalThongTin">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Thông tin tài khoản</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <form action="{{route('update.info')}}" method="POST">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label for="name">Tên tài khoản:</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{Auth::user() ? Auth::user()->name : ''}}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{Auth::user() ? Auth::user()->email : ''}}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Gửi</button>
                </form>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
            </div>

        </div>
    </div>
</div>
