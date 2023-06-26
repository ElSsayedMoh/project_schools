@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('trans_school.Payment_student')}}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('trans_school.Payment_student')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('trans_school.Payment_student')}}</li>
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
                <div class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                       data-page-length="50"
                                       style="text-align: center">
                                    <thead>
                                    <tr class="alert-success">
                                        <th>#</th>
                                        <th>{{trans('trans_school.Name')}}</th>
                                        <th>{{trans('trans_school.Amount')}}</th>
                                        <th>{{trans('trans_school.description')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($receipt_students as $receipt_stn)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$receipt_stn->student->name}}</td>
                                        <td>{{ number_format($receipt_stn->Debit, 2) }}</td>
                                        <td>{{$receipt_stn->description}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
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