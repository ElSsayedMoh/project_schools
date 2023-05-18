@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.Modify_an_invoice')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Modify_an_invoice')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.Modify_an_invoice')}}</li>
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

                    <form action="{{route('Fees_Invoices.update','test')}}" method="post" autocomplete="off">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.name_student')}}</label>
                                <input type="text" value="{{$fee_invoices->student->name}}" readonly name="title_ar" class="form-control">
                                <input type="hidden" value="{{$fee_invoices->id}}" name="id" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Amount')}}</label>
                                <input type="number" value="{{$fee_invoices->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputZip">{{trans('trans_school.Fee_type')}}</label>
                                <select class="custom-select mr-sm-2" name="fee_id">
                                    @foreach($fees as $fee)
                                        <option value="{{$fee->id}}" {{$fee->id == $fee_invoices->fee_id ? 'selected':"" }}>{{$fee->title}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('trans_school.description')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee_invoices->description}}</textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{ trans('trans_school.Submit') }}</button>

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