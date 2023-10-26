@extends('Dashboard.layouts.master')
@section('title')
    الكشوفات
@stop
@section('css')
    <!-- Internal Gallery css -->
    <link href="{{ URL::asset('Dashboard/plugins/gallery/gallery.css') }}" rel="stylesheet">

@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">صور التحاليل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ $lab->Patient->name }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <div class="form-group">
        <label for="exampleFormControlTextarea1">ملاحظات دكتور المحتبر</label>
        <textarea readonly class="form-control" id="exampleFormControlTextarea1" rows="3">{{ $lab->description_employee }}</textarea>
    </div>

    <!-- Gallery -->
    <div class="demo-gallery">
        <ul id="lightgallery" class="list-unstyled row row-sm pr-0">

            @foreach ($labs as $lab)
                @foreach ($lab->images as $image)
                    <li class="col-sm-6 col-lg-4"
                        data-responsive="{{ URL::asset('Dashboard/img/labs/' . $image->filename) }}"
                        data-src="{{ URL::asset('Dashboard/img/labs/' . $image->filename) }}">
                        <a href="">
                            <img height="180px" class="img-responsive"
                                src="{{ URL::asset('Dashboard/img/labs/' . $image->filename) }}" alt="Thumb-1">
                        </a>
                    </li>
                @endforeach
            @endforeach
        </ul>
        <!-- /Gallery -->

    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->

@endsection
@section('js')
    <!-- Internal Gallery js -->
    <script src="{{ URL::asset('Dashboard/plugins/gallery/lightgallery-all.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/plugins/gallery/jquery.mousewheel.min.js') }}"></script>
    <script src="{{ URL::asset('Dashboard/js/gallery.js') }}"></script>

@endsection
