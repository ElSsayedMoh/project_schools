@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.list_of_sections')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.list_of_sections')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.list_of_sections')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
            <div class="card-body">

            <div class="table-responsive">
                <table style="text-align: center" id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <i class="fa-regular fa-trash-can"></i>
                            <th>{{trans('trans_school.Name_Grade')}}</th>
                            <th>{{trans('trans_school.name_Section')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sections as $section)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$section->grades->name}}</td>
                                <td>{{$section->name_section}}</td>
                            </tr>
                    @endforeach
                </tbody>
                </table>
            </div>
        </div>
      </div>   
    </div>
</div> 
<!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
