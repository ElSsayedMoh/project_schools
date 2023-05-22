@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
{{trans('trans_school.study_fees_processing')}}
@stop
@endsection

@section('page-header')
    <!-- breadcrumb -->
    <div class="page-title">
        <div class="row">
            <div class="col-sm-6">
                <h4 class="mb-0"> {{trans('trans_school.study_fees_processing')}}</h4>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                    <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                    <li class="breadcrumb-item active">{{trans('trans_school.study_fees_processing')}}</li>
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
                                        <th>{{trans('trans_school.Processes')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($ProcessingFees as $ProcessingFee)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{$ProcessingFee->student->name}}</td>
                                        <td>{{ number_format($ProcessingFee->amount, 2) }}</td>
                                        <td>{{$ProcessingFee->description}}</td>
                                            <td>
                                                <a href="{{route('fee_processing.edit',$ProcessingFee->id)}}" class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{$ProcessingFee->id}}" ><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete{{ $ProcessingFee->id }}" tabindex="-1" role="dialog"aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                        <form action="{{route('fee_processing.destroy','test')}}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_about_this_process')}}</span><br><br>
                                                            
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $ProcessingFee->id }}">
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