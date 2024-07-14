
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-white">
        <a class="navbar-brand order-1" href="index.html">
            <img class="img-fluid" width="100px" src="{{asset('/')}}/themes/reader/images/logo.png"
                 alt="Reader | Hugo Personal Blog Template">
        </a>
        <div class="collapse navbar-collapse text-center order-lg-2 order-3" id="navigation">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Trang chủ</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false">
                        Danh mục <i class="ti-angle-down ml-1"></i>
                    </a>
                    <div class="dropdown-menu">

                        <a class="dropdown-item" href="about-me.html">Văn hóa ẩm thực</a>
                        <a class="dropdown-item" href="about-us.html">Món ngon</a>
                        <a class="dropdown-item" href="about-us.html">Đồ uống</a>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Tác giả</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="shop.html">Liên hệ</a>
                </li>
            </ul>
        </div>

        <div class="order-2 order-lg-3 d-flex align-items-center">
            <select class="m-2 border-0 bg-transparent" id="select-language">
                <option id="en" value="" selected>Vi</option>
            </select>

            <!-- search -->
            <form class="search-bar">
                <input id="search-query" name="s" type="search" placeholder="Bạn muốn tìm gì">
            </form>

            <button class="navbar-toggler border-0 order-1" type="button" data-toggle="collapse" data-target="#navigation">
                <i class="ti-menu"></i>
            </button>
        </div>

    </nav>
</div>
