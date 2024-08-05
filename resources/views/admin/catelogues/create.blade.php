@extends('admin.layouts.master')

@section('css')

@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Thêm mới danh mục</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.catelogues.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row gy-4">
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Tên</label>
                                        <input type="text" class="form-control" id="basiInput" name="name">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-md-6">
                                    <div>
                                        <label for="basiInput" class="form-label">Ảnh</label>
                                        <input type="file" class="form-control" id="basiInput" name="image">
                                    </div>
                                </div>
                                <div class="col-xxl-12 col-md-12">
                                    <button type="submit" class="btn btn-success">Tạo mới</button>
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
