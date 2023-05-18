@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.Add_new_fees')}}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('trans_school.Add_new_fees')}}
@stop
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

                    <form method="post" action="{{route('Fees.store')}}" autocomplete="off">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Name_Ar')}}</label>
                                <input type="text" value="{{ old('title_ar') }}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Name_En')}}</label>
                                <input type="text" value="{{ old('title_en') }}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Amount')}}</label>
                                <input type="number" value="{{ old('amount') }}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans('trans_school.School_Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="Grade_id">
                                    <option selected disabled>{{trans('trans_school.Choose')}}...</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('trans_school.classrooms')}}</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id">

                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('trans_school.academic_year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    <option selected disabled>{{trans('trans_school.Choose')}}...</option>
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('trans_school.Notes')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4"></textarea>
                        </div>
                        <br>

                        <button type="submit" class="btn btn-primary">{{trans('trans_school.Submit')}}</button>

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