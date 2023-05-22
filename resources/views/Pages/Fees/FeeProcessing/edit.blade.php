@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('trans_school.Exclude_fees')}}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('trans_school.Exclude_fees')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('trans_school.Exclude_fees')}}</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection

@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="post"  action="{{ route('fee_processing.update', 'test') }}" autocomplete="off">
                        @method('PUT')
                        @csrf


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.Amount')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control" value="{{$fee_process->amount}}" name="Debit" type="text" >
                                    <input  value="{{$fee_process->student->id}}" name="student_id" type="hidden" >
                                    <input  value="{{$fee_process->id}}" name="id" type="hidden" >
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.description')}} : </label>
                                    <input  class="form-control" name="description" value="{{$fee_process->description}}" type="text" >
                                </div>
                            </div>

                        <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('trans_school.Submit')}}</button>
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