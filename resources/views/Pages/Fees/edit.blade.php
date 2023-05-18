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

                    <form method="post" action="{{route('Fees.update' , 'test')}}" autocomplete="off">
                        @method('PUT')
                        @csrf

                        <input type="hidden" name="id" value="{{$fee->id}}">
                        <div class="form-row">
                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Name_Ar')}}</label>
                                <input type="text" value="{{$fee->getTranslation('title' , 'ar' )}}" name="title_ar" class="form-control">
                            </div>

                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Name_En')}}</label>
                                <input type="text" value="{{$fee->getTranslation('title' , 'en' )}}" name="title_en" class="form-control">
                            </div>


                            <div class="form-group col">
                                <label for="inputEmail4">{{trans('trans_school.Amount')}}</label>
                                <input type="number" value="{{$fee->amount}}" name="amount" class="form-control">
                            </div>

                        </div>


                        <div class="form-row">

                            <div class="form-group col">
                                <label for="inputState">{{trans('trans_school.School_Grade')}}</label>
                                <select class="custom-select mr-sm-2" name="grade_id" >
                                    <option selected disabled>{{$fee->grades->name}}</option>
                                    @foreach($Grades as $Grade)
                                        <option value="{{ $Grade->id }}" {{$Grade->id == $fee->grade_id ? 'selected' : ""}}>{{ $Grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col">
                                <label for="inputZip">{{trans('trans_school.classrooms')}}</label>
                                <select class="custom-select mr-sm-2" name="Classroom_id" value="{{$fee->classroom_id}}" >
                                    <option value="{{$fee->classroom_id}}">{{$fee->classroom->name_class}}</option>
                                </select>
                            </div>
                            <div class="form-group col">
                                <label for="inputZip">{{trans('trans_school.academic_year')}}</label>
                                <select class="custom-select mr-sm-2" name="year">
                                    @php
                                        $current_year = date("Y")
                                    @endphp
                                    @for($year=$current_year; $year<=$current_year +1 ;$year++)
                                        <option value="{{ $year}}" {{$year == $fee->year ? 'selected' : ' '}}>{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputAddress">{{trans('trans_school.Notes')}}</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4">{{$fee->description}}</textarea>
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
    <script>
            $(document).ready(function(){
        $('select[name="grade_id"]').change(function(){
            var Grade_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getClassroom")}}',
                dataType: "json",
                data: { 'id' : Grade_id },
                success:function(data) {
                    $('select[name="Classroom_id"]').empty();
                    $.each(data, function(key, value){
                        $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })
    })
    </script>
@endsection