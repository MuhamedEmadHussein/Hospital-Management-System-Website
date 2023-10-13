@extends('Dashboard.layouts.master')
@section('css')
    <!--Internal   Notify -->
    <link href="{{ URL::asset('dashboard/plugins/notify/css/notifIt.css') }}" rel="stylesheet" />
@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{ trans('Dashboard/sections_trans.categories') }}</h4><span
                    class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    {{ trans('Dashboard/sections_trans.all_categories') }}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    @include('Dashboard.messages_alert')
    <!-- row -->
    <div class="row row-sm">
        <!--div-->
        <div class="col-xl-12">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add">
                            {{ trans('Dashboard/sections_trans.add_sections') }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table key-buttons text-md-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p border-bottom-0">#</th>
                                    <th class="wd-15p border-bottom-0">
                                        {{ trans('Dashboard/sections_trans.name_sections') }}
                                    </th>
                                    <th class="wd-15p border-bottom-0">
                                        {{ trans('Dashboard/sections_trans.description') }}
                                    </th>
                                    <th class="wd-20p border-bottom-0">{{ trans('Dashboard/sections_trans.created_at') }}
                                    </th>
                                    <th class="wd-20p border-bottom-0">{{ trans('Dashboard/sections_trans.Processes') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 0;
                                @endphp

                                @foreach ($categories as $category)
                                    @php
                                        $i++;
                                    @endphp
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td><a
                                                href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a>
                                        </td>
                                        <td>{{ Str::limit($category->description, 50) }}</td>
                                        <td>{{ $category->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale"
                                                data-toggle="modal" href="#edit{{ $category->id }}"><i
                                                    class="las la-pen"></i></a>
                                            <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale"
                                                data-toggle="modal" href="#delete{{ $category->id }}"><i
                                                    class="las la-trash"></i></a>
                                        </td>
                                    </tr>
                                    @include('Dashboard.Categories.edit')
                                    @include('Dashboard.Categories.delete')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/div-->


    </div>
    <!-- row closed -->
    </div>
    @include('Dashboard.Categories.add')

    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Notify js -->
    <script src="{{ URL::asset('dashboard/plugins/notify/js/notifIt.js') }}"></script>
    <script src="{{ URL::asset('/plugins/notify/js/notifit-custom.js') }}"></script>
@endsection
