@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{trans('trans_school.study_fees')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.study_fees')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.study_fees')}}</li>
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

                <a href="{{route('Fees.create')}}" type="button" class="btn btn-success">{{ trans('trans_school.Add_fees') }}</a>
                <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0 text-center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <i class="fa-regular fa-trash-can"></i>
                            <th class="alert-success">{{trans('trans_school.Name')}}</th>
                            <th class="alert-success">{{trans('trans_school.Amount')}}</th>
                            <th class="alert-success">{{trans('trans_school.Grade')}}</th>
                            <th class="alert-success">{{trans('trans_school.classrooms')}}</th>
                            <th class="alert-success">{{trans('trans_school.academic_year')}}</th>
                            <th class="alert-success">{{trans('trans_school.Notes')}}</th>
                            <th class="alert-success">{{trans('trans_school.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$fee->title}}</td>
                                <td>{{$fee->amount}}</td>
                                <td>{{$fee->grades->name}}</td>
                                <td>{{$fee->classroom->name_class}}</td>
                                <td>{{$fee->year}}</td>
                                <td>{{$fee->description}}</td>

                                <td>
                                    <a href="{{route('Fees.edit',$fee->id)}}"  class="btn btn-info btn-sm text-white" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                    
                                    <a type="button" class="btn btn-danger text-white btn-sm" data-toggle="modal" data-target="#delete{{$fee->id}}"
                                        title="{{ trans('trans_school.Delete') }}"><i class="fa fa-trash"></i></a>
                
                                    <a class="btn btn-warning btn-sm text-white" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>
                                </td>

                            </tr>

                                {{-- modal delete --}}
                            <div class="modal fade" id="delete{{ $fee->id }}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            <form action="{{route('Fees.destroy','test')}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_this_process')}}</span><br><br>
                                                
                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $fee->id }}">
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
