@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.Students_Promotion')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('trans_school.Students_Promotion')}}
@stop
<!-- breadcrumb -->
@endsection
@section('content')

<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Students_Promotion')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.Students_Promotion')}}</li>
            </ol>
        </div>
    </div>
</div>
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if (Session::has('error_promotions'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{Session::get('error_promotions')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                        <h6 style="color: red;font-family: Cairo">{{trans('trans_school.old_school_stage')}} </h6><br>

                    <form method="post" action="{{route('StudentsPromotion.store')}}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('trans_school.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id" required>
                                    <option selected disabled>{{trans('trans_school.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('trans_school.classrooms')}} : <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" required>

                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="section_id">{{trans('trans_school.section')}} : </label>
                                <select class="custom-select mr-sm-2" name="section_id" required>

                                </select>
                            </div>
                        </div>
                        <br><h6 style="color: red;font-family: Cairo">{{trans('trans_school.new_school_stage')}}</h6><br>

                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputState">{{trans('trans_school.Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id_new" >
                                    <option selected disabled>{{trans('trans_school.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{$Grade->id}}">{{$Grade->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="Classroom_id">{{trans('trans_school.classrooms')}}: <span
                                        class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2" name="Classroom_id_new" >

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="section_id">:{{trans('trans_school.section')}} </label>
                                <select class="custom-select mr-sm-2" name="section_id_new" >

                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">تاكيد</button>
                    </form>

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
