@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    حصص اونلاين
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    حصص اونلاين
@stop
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
                                <a href="{{route('online_classes_teacher.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">اضافة حصة جديدة</a>
                                   <a href="{{route('offline_teacher.create')}}" class="btn btn-primary btn-sm" role="button"
                                   aria-pressed="true">اضافة حصة اوفلاين جديدة</a><br><br>
                                <div class="table-responsive">
                                    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr class="alert-success">
                                            <th>#</th>
                                            <th>المرحلة</th>
                                            <th>الصف</th>
                                            <th>القسم</th>
                                            <th>المعلم</th>
                                            <th>عنوان الحصة</th>
                                            <th>تاريخ البداية</th>
                                            <th>وقت الحصة</th>
                                            <th>رابط الحصة</th>
                                            <th>العمليات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($online_classes as $online_classe)
                                            <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$online_classe->grades->name}}</td>
                                            <td>{{ $online_classe->class_rooms->name_class }}</td>
                                            <td>{{$online_classe->sections->name_section}}</td>
                                                <td>{{$online_classe->created_by}}</td>
                                                <td>{{$online_classe->topic}}</td>
                                                <td>{{$online_classe->start_at}}</td>
                                                <td>{{$online_classe->duration}}</td>
                                                <td class="text-danger"><a href="{{$online_classe->join_url}}" target="_blank">انضم الان</a></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete_receipt{{$online_classe->meeting_id}}" ><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="Delete_receipt{{ $online_classe->meeting_id }}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <form action="{{route('online_classes_teacher.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_this_process')}}</span><br><br>
                                                            
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $online_classe->meeting_id }}">
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