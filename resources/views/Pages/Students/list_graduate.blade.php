@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.List_of_graduates')}}
@stop
@endsection
{{-- @section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{trans('trans_school.List_of_graduates')}} <i class="fas fa-user-graduate"></i>
@stop
<!-- breadcrumb -->
@endsection --}}
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.List_of_graduates')}}</h4>
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
                                            <th>{{trans('trans_school.name_student')}}</th>
                                            <th>{{trans('trans_school.Email')}}</th>
                                            <th>{{trans('trans_school.gender')}}</th>
                                            <th>{{trans('trans_school.Grade')}}</th>
                                            <th>{{trans('trans_school.classrooms')}}</th>
                                            <th>{{trans('trans_school.section')}}</th>
                                            <th>{{trans('trans_school.Processes')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($students as $student)
                                            <tr>
                                            <td>{{ $loop->index+1 }}</td>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->email}}</td>
                                            <td>{{$student->genders->name}}</td>
                                            <td>{{$student->grades->name}}</td>
                                            <td>{{$student->class_rooms->name_class}}</td>
                                            <td>{{$student->sections->name_section}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#Return_Student{{ $student->id }}" title="{{ trans('Grades_trans.Delete') }}">ارجاع الطالب</button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_Student{{ $student->id }}" title="{{ trans('Grades_trans.Delete') }}">حذف الطالب</button>

                                                </td>
                                            </tr>
                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Return_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">ارجاع طالب</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('StudentsGraduate.update','test')}}" method="post" autocomplete="off">
                                                                @method('PUT')
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$student->id}}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('trans_school.Are_you_sure_about_this_process')}}</h5>
                                                                <input type="text" readonly value="{{$student->name}}" class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('trans_school.Submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Deleted inFormation Student -->
                                            <div class="modal fade" id="Delete_Student{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">ارجاع طالب</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{route('StudentsGraduate.destroy','test')}}" method="post" autocomplete="off">
                                                                @method('DELETE')
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{$student->id}}">

                                                                <h5 style="font-family: 'Cairo', sans-serif;">{{trans('trans_school.Are_you_sure_about_this_process')}}</h5>
                                                                <input type="text" readonly value="{{$student->name}}" class="form-control">

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                                                    <button  class="btn btn-danger">{{trans('trans_school.Submit')}}</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


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