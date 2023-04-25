@extends('layouts.master')
@section('css')

@section('title')
    {{trans('trans_school.Teachers')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Teachers')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.Teachers')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">

                <div class="col-xl-12 mb-30">     
                    <div class="card card-statistics h-100"> 
                        <div class="card-body">
            
                            <a href="{{route('Teachers.create')}}" class="button x-small" > {{ trans('trans_school.add_teacher') }} </a>
                            <br><br>
            
                        <div class="table-responsive">
                            <table id="datatable" class="table text-center table-striped table-bordered p-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <i class="fa-regular fa-trash-can"></i>
                                        <th>{{trans('trans_school.name_teacher')}}</th>
                                        <th>{{trans('trans_school.gender')}}</th>
                                        <th>{{trans('trans_school.joining_date')}}</th>
                                        <th>{{trans('trans_school.specialization')}}</th>
                                        <th>{{trans('trans_school.Processes')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{$teacher->name}}</td>
                                            <td>{{$teacher->genders->name}}</td>
                                            <td>{{$teacher->joining_date}}</td>
                                            <td>{{$teacher->specializations->name }}</td>
                                            <td>
                                                <a href="{{route('Teachers.edit', $teacher->id)}}" type="button" class="btn btn-info btn-sm"
                                                    title="{{trans('trans_school.Edit')}}"><i class="fa fa-edit"></i></a>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                    data-target="#delete_Teacher{{$teacher->id}}"
                                                    title="{{trans('trans_school.Delete')}}"><i
                                                        class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        
                                        {{-- modal delete --}}
                                        <div class="modal fade" id="delete_Teacher{{$teacher->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{route('Teachers.destroy','test')}}" method="post">
                                                    {{method_field('delete')}}
                                                    {{csrf_field()}}
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('trans_school.Delete_Teacher') }}</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p> {{ trans('trans_school.Are_you_sure_to_delete_the_process') }}</p>
                                                        <input type="hidden" name="id"  value="{{$teacher->id}}">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                                            <button type="submit"
                                                                    class="btn btn-danger">{{ trans('trans_school.Submit') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
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

@endsection
