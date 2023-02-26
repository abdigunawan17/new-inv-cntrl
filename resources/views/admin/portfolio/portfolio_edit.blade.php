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

                    <h4 class="card-title">Edit Portfolio Page</h4><br><br>
                    <form method="post" action="{{ route('update.portfolio') }}" enctype="multipart/form-data" >
                        @csrf

                        <input type="hidden" name="id" value="{{ $get_portfolio_data->id }}" >
                        

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Name</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="portfolio_name" value="{{ $get_portfolio_data->portfolio_name }}" type="text" id="example-text-input">
                                @error('portfolio_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="portfolio_title" value="{{ $get_portfolio_data->portfolio_title }}" type="text" id="example-text-input">
                                @error('portfolio_title')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Description</label>
                            <div class="col-sm-10">
                                <textarea id="elm1" name="portfolio_description">{{ $get_portfolio_data->portfolio_description }}</textarea>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Portfolio Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="portfolio_image" type="file" placeholder="bootstrap@example.com" id="image">
                            </div>
                        </div>
                        <div class="row mb-3">
                        <label for="example-email-input" class="col-sm-2 col-form-label"></label>
                        <img class="rounded avatar-lg" id="showImage" src="{{ asset($get_portfolio_data->portfolio_image) }}" alt="Card image cap">
                        </div>

                        
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Portfolio Data">
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