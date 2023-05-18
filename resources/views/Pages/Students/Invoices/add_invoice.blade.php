@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.Add_New_Invoice')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Add_New_Invoice')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.List_of_graduates')}}</li>
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

                        <form class=" row mb-30" action="{{ route('Fees_Invoices.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="repeater">
                                    <div data-repeater-list="List_Fees">
                                        <div data-repeater-item>
                                            <div class="row">

                                                <div class="col">
                                                    <label for="Name" class="mr-sm-2">{{trans('trans_school.name_student')}}</label>
                                                        <input type="text" class="form-control" placeholder="{{$student->name}}" readonly required>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{trans('trans_school.Fee_type')}}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="fee_id" required>
                                                            <option value="">-- {{trans('trans_school.Choose')}} --</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{trans('trans_school.Amount')}}</label>
                                                    <div class="box">
                                                        <select class="fancyselect" name="amount" required>
                                                            <option value="">-- {{trans('trans_school.Choose')}} --</option>
                                                            @foreach($fees as $fee)
                                                                <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="description" class="mr-sm-2">{{trans('trans_school.description')}}</label>
                                                    <div class="box">
                                                        <input type="text" class="form-control" name="description" required>
                                                    </div>
                                                </div>

                                                <div class="col">
                                                    <label for="Name_en" class="mr-sm-2">{{ trans('trans_school.Processes') }}:</label>
                                                    <input class="btn btn-danger btn-block" data-repeater-delete type="button" value="{{ trans('trans_school.Delete') }}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mt-20">
                                        <div class="col-12">
                                            <input class="button" data-repeater-create type="button" value="{{ trans('trans_school.Add_Row') }}"/>
                                        </div>
                                    </div><br>
                                    <input type="hidden" name="Grade_id" value="{{$student->grade_id}}">
                                    <input type="hidden" name="Classroom_id" value="{{$student->classroom_id}}">
                                    <input type="hidden" value="{{$student->id}}" name="student_id">

                                    <button type="submit" class="btn btn-primary">{{ trans('trans_school.Submit') }}</button>
                                </div>
                            </div>
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