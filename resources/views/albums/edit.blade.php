@extends('layouts.app')
@section('content')
    <div class="template" style="display: flex;flex-direction: row-reverse">
        {{-- right side --}}

    <div class="app-content content " style="width: 70%;margin-right: 50px;">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>

                                <li class="breadcrumb-item active"> /تعديل ألبوم
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تعديل ألبوم</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('includes.alerts.success')
                                @include('includes.alerts.error')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{route('albums.update',$album->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                              @method('PUT')

                                            @csrf
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> البيانات الاساسية للألبوم </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group" style="margin-top: 20px;margin-bottom: 50px">
                                                            <label for="projectinput1"> اسم الألبوم
                                                            </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                                   value="{{$album->name}}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                        <div class="form-group" style="margin-top: 20px;margin-bottom: 50px">
                                                            <label for="projectinput1"> الصور الجديدة
                                                            </label>
                                                            <input type="file" id="images"
                                                            multiple
                                                                   class="form-control"
                                                                   value="{{old('images')}}"
                                                                   name="images[]"
                                                                   id="images">
                                                            @error("images")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>

                                                         {{-- div for edit old images --}}
                                                         <div class="imgEditPreview">
                                                            {{-- show images here --}}
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="form-actions" style="margin-top: 50px;margin-right: 120px">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>



</div>


@stop
@section('script')

<script>

$(function() {
    var multiImgPreview = function(input, imgPreviewPlaceholder) {
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {

                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);

                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    };

        //end  Multiple images preview with JavaScript
        // call this function for create modal

    $('#images').on('change', function() {
        // remove old images not to be shown


        $('div.imgEditPreview img').remove();
        multiImgPreview(this, 'div.imgEditPreview');
        // End call this function for create modal

    });
});
</script>

@stop
