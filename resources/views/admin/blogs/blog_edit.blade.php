@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
        margin-right: 2px;
        color: #b70000;
        font-weight: 700px;
    }
</style>

<div class="page-content">
<div class="container-fluid">                
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Edit Blog Page</h4><br><br>
                    <form method="post" action="{{ route('update.blog') }}" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $allblogs->id }}" >
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category Name</label>
                            <div class="col-sm-10">
                                <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                    <option selected="">Open this select menu</option>
                                    @foreach($blogcategories as $cat)
                                    <option value="{{ $cat->id }}" {{ $cat->id == $allblogs->blog_category_id ? 'selected' : '' }}  >{{ $cat->blog_category }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_title" value="{{ $allblogs->blog_title }}" type="text" id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Tags</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_tags" value="{{ $allblogs->blog_tags }}" type="text" data-role="tagsinput">
                                
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Slug</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_slug" value="{{ $allblogs->blog_slug }}" type="text" id="example-text-input">
                                
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Subtitle</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_subtitle" value="{{ $allblogs->blog_subtitle }}" type="text" id="example-text-input">
                                
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Blog Description</label>
                            <div class="col-sm-10">
                                <textarea id="elm1" name="blog_description">{{ $allblogs->blog_description }}</textarea>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Blog Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="blog_image" type="file" placeholder="bootstrap@example.com" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="example-email-input" class="col-sm-2 col-form-label"></label>
                        <img class="rounded avatar-lg" id="showImage" src="{{ asset($allblogs->blog_image) }}" alt="Card image cap">
                        </div>

                        
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Data">
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div>
</div>

<script type="text/javascript">

    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection