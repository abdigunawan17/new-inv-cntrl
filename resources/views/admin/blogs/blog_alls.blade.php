@extends('admin.admin_master')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box dm-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Blog Category All</h4>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Blog Category All Data</h4>

                            
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>S1</th>
                                        <th>Blog Category</th>
                                        <th>Blog Title</th>
                                        <th>Blog Subtitle</th>
                                        <th>Blog Slug</th>
                                        <th>Blog Tags</th>
                                        <th>Blog Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php($i = 1)
                                    @foreach($allblogs as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $item['category']['blog_category'] }}</td>
                                        <td>{{ $item->blog_title }}</td>
                                        <td>{{ $item->blog_subtitle }}</td>
                                        <td>{{ $item->blog_slug }}</td>
                                        <td>{{ $item->blog_tags }}</td>
                                        <td>
                                            <img src="{{ asset($item->blog_image) }}" style="width: 60px; height: 50px;" />
                                        </td>
                                        <td>
                                            <a href="{{ route('edit.blog', $item->id) }}" class="btn btn-info sm" title="Edit data"><i class="fas fa-edit"></i></a>
                                            <a href="{{ route('delete.blog', $item->id) }}" class="btn btn-danger sm" title="Delete data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection