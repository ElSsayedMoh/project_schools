@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.list_of_subjects')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.list_of_subjects')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.list_of_subjects')}}</li>
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
                                <a href="{{route('Subjects.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{trans('trans_school.Add_a_new_article')}}</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم المادة</th>
                                            <th>المرحلة الدراسية</th>
                                            <th>الصف الدراسي</th>
                                            <th>اسم المعلم</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grades->name}}</td>
                                            <td>{{$subject->class_rooms->name_class}}</td>
                                            <td>{{$subject->teacher->name}}</td>
                                                <td>
                                                    <a href="{{route('Subjects.edit',$subject->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}" title="حذف"><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                        </tr>
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete_subject{{ $subject->id }}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                            id="exampleModalLabel">
                                                            {{trans('trans_school.Delete')}}
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{route('Subjects.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_this_process')}}</span><br><br>
                                                            
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $subject->id }}">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                                                <button class="btn btn-danger" >{{trans('trans_school.Submit')}}</button>
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