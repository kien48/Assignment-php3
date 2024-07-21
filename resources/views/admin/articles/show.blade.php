@extends('admin.layouts.master')

@section('content')
    <!-- Start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Basic Elements</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Basic Elements</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- End page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Duyệt bài viết</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{ route('admin.articles.browse', $model->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row gy-4">
                                <div class="col-12">
                                    <div class="card mb-4">
                                        <div class="card-body">
                                            <div class="mb-3 d-flex ">
                                                <label for="title" class="form-label">Tiêu đề: </label>
                                                <p class="ms-2">{{ $model->title }}</p>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="mb-3 d-flex">
                                                    <label for="author" class="form-label">Tác giả: </label>
                                                    <p class="ms-2">{{ $model->author->name }}</p>
                                                </div>
                                                <div class="mb-3 d-flex">
                                                    <label for="created_at" class="form-label">Ngày đăng: </label>
                                                    <p class="ms-2">{{ $model->created_at->format('d/m/Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-3 d-flex">
                                                <label for="catelogue" class="form-label">Danh mục: </label>
                                                <p class="ms-2">{{ $model->catelogue->name }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <label for="content" class="form-label">Nội dung: </label>
                                                <div>{!! $model->content !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="image" class="form-label">Hình ảnh: </label>
                                        <img src="{{ \Storage::url($model->image) }}" alt="Hình ảnh" width="100px">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mb-3">
                                        <label for="tags" class="form-label">Thẻ: </label>
                                        @foreach($model->tags as $tag)
                                            <span class="badge bg-primary ms-2">{{ $tag->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @if(session('admin')->role == 'editor')
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Trạng thái: </label>
                                            <select class="form-select" name="status">
                                                <option disabled value="pending" {{ $model->status == 'pending' ? 'selected' : '' }}>Đợi duyệt</option>
                                                <option value="published" {{ $model->status == 'published' ? 'selected' : '' }}>Đã duyệt</option>
                                                <option value="hidden" {{ $model->status == 'hidden' ? 'selected' : '' }}>Ẩn</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <div class="form-check form-switch form-switch-danger">
                                                <input name="author_id" type="hidden" class="form-check-input" value="{{$model->author_id}}">
                                                <input name="title" type="hidden" class="form-check-input" value="{{$model->title}}">
                                                <input name="is_editor" class="form-check-input" value="1" type="checkbox" role="switch" id="SwitchCheck5" @if($model->is_editor) checked @endif>
                                                <label class="form-check-label" for="SwitchCheck5">Biên tập chọn</label>
                                            </div>
                                            <div class="form-check form-switch form-switch-warning">
                                                <input name="is_trending" class="form-check-input" value="1" type="checkbox" role="switch" id="SwitchCheck5" @if($model->is_trending) checked @endif>
                                                <label class="form-check-label" for="SwitchCheck5">Bài viết trending</label>
                                            </div>
                                        </div>

                                    </div>
                                @endif
                                <div class="col-12">
                                    <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Quay lại</a>

                                    @if(session('admin')->role == 'editor')
                                        <button type="submit" class="btn btn-warning">Duyệt</button>
                                    @endif
                                </div>
                            </div>
                        </form>
                        <!-- End row -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
@endsection
