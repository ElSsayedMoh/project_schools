@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.Students_Promotion_Management')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Students_Promotion_Management')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.list_pormotion')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <div class="col-xl-12 mb-30">     
        <div class="card card-statistics h-100"> 
            <div class="card-body">

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#retraction_all">
                    {{ trans('trans_school.undo_all') }}
                </button>
                <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <i class="fa-regular fa-trash-can"></i>
                            <th class="alert-info">{{trans('trans_school.name_student')}}</th>
                            <th class="alert-danger">{{trans('trans_school.previous_grade')}}</th>
                            <th class="alert-danger">{{trans('trans_school.previous_classroom')}}</th>
                            <th class="alert-danger">{{trans('trans_school.previous_section')}}</th>
                            <th class="alert-success">{{trans('trans_school.Present_grade')}}</th>
                            <th class="alert-success">{{trans('trans_school.Present_classroom')}}</th>
                            <th class="alert-success">{{trans('trans_school.Present_section')}}</th>
                            <th>{{trans('trans_school.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pormotions as $pormotion)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$pormotion->student->name}}</td>
                                <td>{{$pormotion->previous_grade->name}}</td>
                                <td>{{$pormotion->previous_classroom->name_class}}</td>
                                <td>{{$pormotion->previous_section->name_section}}</td>
                                <td>{{$pormotion->present_grade->name}}</td>
                                <td>{{$pormotion->present_classroom->name_class}}</td>
                                <td>{{$pormotion->present_section->name_section}}</td>

                                <td style="display: flex;justify-content: space-evenly;">
                                    <button type="button" class="btn btn-outline-danger " data-toggle="modal" 
                                        data-target="#return_student{{ $pormotion->id }}">{{ trans('trans_school.student_return') }}</button>
                
                                    <button class="btn btn-outline-success" role="button" aria-pressed="true">{{ trans('trans_school.Student_graduated') }}</button>
                                </td>

                            </tr>

                                <!-- retraction_modal-->
                                <div class="modal fade" id="return_student{{ $pormotion->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{trans('trans_school.student_return')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('StudentsPromotion.destroy','test')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_the_retraction_process')}}</span><br><br>
                                                
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $pormotion->id }}">
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
                </tbody>
                </table>
            </div>

            <!-- retraction_all_modal-->
            <div class="modal fade" id="retraction_all" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                id="exampleModalLabel">
                                {{trans('trans_school.undo_all')}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('StudentsPromotion.destroy','test')}}" method="post">
                                @csrf
                                @method('DELETE')
                                <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_the_retraction_process')}}</span><br><br>
                                
                                <input id="id" type="hidden" name="page_id" class="form-control" value="1">
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
