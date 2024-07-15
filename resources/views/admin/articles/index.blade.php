@extends('admin.layouts.master')



@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

@endsection

@section('content')
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Datatables</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                    <li class="breadcrumb-item active">Datatables</li>
                </ol>
            </div>

        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{session('success')}}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Danh sách bài viết</h5>
                </div>
                <div class="card-body">
                    <table id="example"
                           class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Danh mục</th>
                        <th>Ảnh</th>
                        <th>Lượt xem</th>
                        <th>Tác giả</th>
                        <th>Người duyệt</th>
                        <th>Trạng thái</th>
                        <th>Thời gian tạo</th>
                        <th>Thời gian cập nhật</th>
                        <th>Thao tác</th>
                        </thead>
                        <tbody>
                        @foreach($data as $item)
                            @php
                            if($item->editor){
                                $editor = $item->editor->name;
                            }else{
                                $editor = "Chưa có";
                            }
                            @endphp
                           <tr>
                               <td>{{$item->id}}</td>
                               <td>{{$item->title}}</td>
                               <td>{{$item->catelogue->name}}</td>
                               <td>
                                   <img src="{{\Storage::url($item->image)}}" alt="" height="100px" class="img-thumbnail">
                               </td>
                               <td>{{$item->views}}</td>
                               <td>{{$item->author->name}}</td>
                               <td>{{$editor}}</td>
                               <td>{{$item->status}}</td>
                               <td>{{$item->created_at}}</td>
                               <td>{{$item->updated_at}}</td>
                               <td>
                                   @if(session('admin')->role == "editor")
                                       <a href="{{route('admin.articles.show', $item->id)}}" class="btn btn-primary btn-sm">Duyệt qua</a>
                                   @elseif(session('admin')->role == "author")
                                       <a href="{{route('admin.articles.show', $item->id)}}" class="btn btn-primary btn-sm">Xem</a>
                                       <a href="{{route('admin.articles.edit', $item->id)}}" class="btn btn-warning btn-sm">Sửa</a>
                                       <a href="{{route('admin.articles.destroy', $item->id)}}" class="btn btn-danger btn-sm">Xóa</a>
                                   @endif
                               </td>
                           </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        new DataTable('#example', {
            order: [[0, 'desc']]
        });
    </script>
    <!-- App js -->
    <script src="{{asset('/themes/velzon/')}}/assets/js/app.js"></script>
@endsection
