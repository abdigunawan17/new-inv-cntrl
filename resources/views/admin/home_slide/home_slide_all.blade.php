@extends('admin.admin_master')                
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
<div class="container-fluid">                
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Home Slide Page</h4>
                    <form method="post" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $homeslide->id }}">
                        
                        <div class="row mb-3">
                            <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="title" value="{{ $homeslide->title }}" type="text" placeholder="Artisanal kale" id="example-text-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-search-input" class="col-sm-2 col-form-label">Short title</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="short_title" value="{{ $homeslide->short_title }}" type="text" placeholder="How do I shoot web" id="example-search-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Video URL</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="video_url" value="{{ $homeslide->video_url }}" type="text" placeholder="bootstrap@example.com" id="example-email-input">
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row mb-3">
                            <label for="example-email-input" class="col-sm-2 col-form-label">Slider Image</label>
                            <div class="col-sm-10">
                                <input class="form-control" name="home_slide" type="file" placeholder="bootstrap@example.com" id="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                        <label for="example-email-input" class="col-sm-2 col-form-label"></label>
                        <img class="rounded avatar-lg" id="showImage" src="{{ ( !empty( $homeslide->home_slide)) ? url($homeslide->home_slide) : url('upload/no_image.png') }}" alt="Card image cap">
                        </div>
                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
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