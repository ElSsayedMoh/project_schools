@extends('layouts.master')
@section('css')

@section('title')
    {{trans('trans_school.list_school_grade')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.School_Grade')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.School_Grade')}}</li>
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

                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('trans_school.add_Grade') }}
                </button>
                <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <i class="fa-regular fa-trash-can"></i>
                            <th>{{trans('trans_school.Name_Grade')}}</th>
                            <th>{{trans('trans_school.Notes')}}</th>
                            <th>{{trans('trans_school.Processes')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($grades as $grade)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$grade->name}}</td>
                                <td>{{$grade->notes}}</td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#edit"
                                        title=""><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete"
                                        title=""><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tfoot>

                    {{-- add model grade --}}
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                        {{ trans('Grades_trans.add_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{route('Grade.store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name" class="mr-sm-2">{{ trans('trans_school.Name_Grade_Ar') }}
                                                    :</label>
                                                <input id="Name" type="text" name="Name_ar" class="form-control" required>
                                            </div>
                                            <div class="col">
                                                <label for="Name_en" class="mr-sm-2">{{ trans('trans_school.Name_Grade_En') }}
                                                    :</label>
                                                <input type="text" class="form-control" name="Name_en" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">{{ trans('trans_school.Notes') }}
                                                :</label>
                                            <textarea class="form-control" name="Notes" id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>
                                        <br><br>
                                
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                            <button type="submit" class="btn btn-success">{{ trans('trans_school.Submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- edit_modal_Grade -->
                    <div class="modal fade" id="edit" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{trans('trans_school.Edit_Trans')}}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <!-- add_form -->
                                    <form action="" method="post">
                                        {{ method_field('patch') }}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{trans('trans_school.Name_Grade')}}
                                                    :</label>
                                                <input id="Name" type="text" name="Name"
                                                    class="form-control"
                                                    value=""
                                                    required>
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="">
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{trans('trans_school.Notes')}}
                                                    :</label>
                                                <input type="text" class="form-control"
                                                    value=""
                                                    name="Name_en" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                for="exampleFormControlTextarea1">hhhhhhhhh
                                                :</label>
                                            <textarea class="form-control" name="Notes"
                                                id="exampleFormControlTextarea1"
                                                rows="3"></textarea>
                                        </div>
                                        <br><br>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal"></button>
                                            <button type="submit"
                                                class="btn btn-success"></button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- delete_modal_Grade -->
                    <div class="modal fade" id="delete" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                       hhhhhhh
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal"></button>
                                            <button type="submit"
                                                class="btn btn-danger"></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>



                    
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
