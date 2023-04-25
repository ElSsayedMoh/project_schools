@extends('layouts.master')
@section('css')
    @toastr_css
    <style>
    

    </style>
@section('title')
    {{trans('trans_school.list_of_sections')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.sections')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.sections')}}</li>
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
                    <a class="button x-small" href="#" data-toggle="modal" data-target="#exampleModal">
                        {{ trans('trans_school.add_section') }}</a>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card card-statistics h-100">
                    <div class="card-body">
                        <div class="accordion gray plus-icon round">

                            @foreach ($Grades as $Grade)

                                <div class="acd-group">
                                    <a href="#" class="acd-heading">{{$Grade->name}}</a>
                                    <div class="acd-des">

                                        <div class="row">
                                            <div class="col-xl-12 mb-30">
                                                <div class="card card-statistics h-100">
                                                    <div class="card-body">
                                                        <div class="d-block d-md-flex justify-content-between">
                                                            <div class="d-block">
                                                            </div>
                                                        </div>
                                                        <div class="table-responsive mt-15">
                                                            <table class="table center-aligned-table mb-0 text-center">
                                                                <thead>
                                                                <tr class="text-dark">
                                                                    <th>#</th>
                                                                    <th>{{ trans('trans_school.name_Section') }}
                                                                    </th>
                                                                    <th>{{ trans('trans_school.Class_name') }}</th>
                                                                    <th>{{ trans('trans_school.Status') }}</th>
                                                                    <th>{{ trans('trans_school.Processes') }}</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i = 0; ?>
                                                                @foreach ($Grade->Sections as $list_Sections)
                                                                    <tr>
                                                                        <?php $i++; ?>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{$list_Sections->name_section}}</td>
                                                                        <td>{{$list_Sections->Class_Room->name_class}}</td>
                                                                        <td>
                                                                            @if ($list_Sections->status === 1)
                                                                                <label class="badge badge-success">{{ trans('trans_school.Status_Section_AC') }}</label>
                                                                            @else
                                                                                <label class="badge badge-danger">{{ trans('trans_school.Status_Section_No') }}</label>
                                                                            @endif
                                                                            
                                                                        </td>
                                                                        <td>

                                                                            <a href="#"
                                                                               class="btn btn-outline-info btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#edit{{ $list_Sections->id }}">{{ trans('trans_school.Edit') }}</a>
                                                                            <a href="#"
                                                                               class="btn btn-outline-danger btn-sm"
                                                                               data-toggle="modal"
                                                                               data-target="#delete{{ $list_Sections->id }}">{{ trans('trans_school.Delete') }}</a>
                                                                        </td>
                                                                    </tr>

                                                                    <!--تعديل قسم جديد -->
                                                                    <div class="modal fade" id="edit{{ $list_Sections->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        style="font-family: 'Cairo', sans-serif;"
                                                                                        id="exampleModalLabel">
                                                                                        {{ trans('trans_school.edit_section') }}
                                                                                    </h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                    <span
                                                                                        aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">

                                                                                    <form action="{{ route('Sections.update', 'test') }}" method="POST">
                                                                                        {{ method_field('patch') }}
                                                                                        {{ csrf_field() }}
                                                                                        <div class="row">
                                                                                            <div class="col">
                                                                                                <input type="text" name="name_section_ar" class="form-control" 
                                                                                                        value="{{ $list_Sections->getTranslation('name_section', 'ar') }}">
                                                                                            </div>

                                                                                            <div class="col">
                                                                                                <input type="text" name="name_section_en" class="form-control" 
                                                                                                        value="{{ $list_Sections->getTranslation('name_section', 'en') }}">
                                                                                                <input id="id" type="hidden" name="id" class="form-control" value="{{ $list_Sections->id }}">
                                                                                            </div>

                                                                                        </div>
                                                                                        <br>


                                                                                        <div class="col">
                                                                                            <label for="inputName" class="control-label">{{ trans('trans_school.Name_Grade') }}</label>
                                                                                            <select name="Grade_id" class="custom-select" onclick="console.log($(this).val())">
                                                                                                <!--placeholder-->
                                                                                                <option value="{{ $Grade->id }}"> {{ $Grade->name }} </option>
                                                                                                    @foreach ($list_grade as $list_Grade)
                                                                                                        <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }} </option>
                                                                                                    @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col">
                                                                                            <label for="inputName" class="control-label">{{ trans('trans_school.Class_name') }}</label>
                                                                                            <select name="class_id"  class="custom-select">
                                                                                                <option value="{{ $list_Sections->Class_Room->id }}"> {{ $list_Sections->Class_Room->name_class }} </option>
                                                                                            </select>
                                                                                        </div>
                                                                                        <br>

                                                                                        <div class="col parent-teacher">
                                                                                            <label for="inputName" class="control-label text-center ">{{ trans('trans_school.name_teacher') }}</label>
                                                                                            <select name="teacher_id[]"  class="custom-select text-center teacher-list " multiple>

                                                                                                @foreach($list_Sections->teachers as $teacher)
                                                                                                    <option selected value="{{ $teacher->id}}">{{$teacher->name}}</option>
                                                                                                @endforeach

                                                                                                @foreach($teachers as $teacher)
                                                                                                    <option value="{{ $teacher->id}}">{{$teacher->name}}</option>
                                                                                                @endforeach
                                                
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="col">
                                                                                            <div class="form-check">
                                                                                                @if ($list_Sections->status === 1)
                                                                                                    <input type="checkbox" checked class="form-check-input" name="status" id="exampleCheck1">
                                                                                                @else
                                                                                                    <input type="checkbox" class="form-check-input" name="status" id="exampleCheck1">
                                                                                                @endif
                                                                                                    <label class="form-check-label" for="exampleCheck1">{{ trans('trans_school.Status') }}</label>
                                                                                            </div><br>
                                                                                        </div>

                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                                                                            <button type="submit" class="btn btn-danger">{{ trans('trans_school.Submit') }}</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                      <!-- delete_modal_Grade -->
                                                                            <div class="modal fade"
                                                                                id="delete{{ $list_Sections->id }}"
                                                                                tabindex="-1" role="dialog"
                                                                                aria-labelledby="exampleModalLabel"
                                                                                aria-hidden="true">
                                                                                <div class="modal-dialog" role="document">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h5 style="font-family: 'Cairo', sans-serif;"
                                                                                                class="modal-title"
                                                                                                id="exampleModalLabel">
                                                                                                {{ trans('trans_school.delete_Section') }}
                                                                                            </h5>
                                                                                            <button type="button" class="close"
                                                                                                    data-dismiss="modal"
                                                                                                    aria-label="Close">
                                                                                            <span
                                                                                                aria-hidden="true">&times;</span>
                                                                                            </button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form
                                                                                                action="{{ route('Sections.destroy', 'test') }}"
                                                                                                method="post">
                                                                                                {{ method_field('Delete') }}
                                                                                                @csrf
                                                                                                {{ trans('trans_school.Are_you_sure_to_delete_the_process') }} <br>
                                                                                                <input id="id" type="hidden"
                                                                                                        name="id"
                                                                                                        class="form-control"
                                                                                                        value="{{ $list_Sections->id }}">
                                                                                                <div class="modal-footer">
                                                                                                    <button type="button"
                                                                                                            class="btn btn-secondary"
                                                                                                            data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                                                                                    <button type="submit"
                                                                                                            class="btn btn-danger">{{ trans('trans_school.Submit') }}</button>
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
                                    </div>

                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Add New Section -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" style="font-family: 'Cairo', sans-serif;"
                                        id="exampleModalLabel">
                                        {{ trans('trans_school.add_section') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <form action="{{ route('Sections.store') }}" method="POST">
                                        {{ csrf_field() }}
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" name="name_section_ar" class="form-control"
                                                        placeholder="{{ trans('trans_school.Section_name_ar') }}">
                                            </div>

                                            <div class="col">
                                                <input type="text" name="name_section_en" class="form-control"
                                                        placeholder="{{ trans('trans_school.Section_name_en') }}">
                                            </div>

                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                    class="control-label">{{ trans('trans_school.Name_Grade') }}</label>
                                            <select name="Grade_id" class="custom-select">
                                                <!--placeholder-->
                                                <option value="" selected disabled > -- {{ trans('trans_school.Select_Grade') }} -- </option>
                                                @foreach ($list_grade as $list_Grade)
                                                    <option value="{{ $list_Grade->id }}"> {{ $list_Grade->name }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <br>

                                        <div class="col">
                                            <label for="inputName"
                                                    class="control-label">{{ trans('trans_school.Class_name') }}</label>
                                            <select name="class_id" class="custom-select">

                                            </select>
                                        </div><br>

                                        <div class="col parent-teacher">
                                            <label for="inputName" class="control-label text-center ">{{ trans('trans_school.name_teacher') }}</label>
                                            <select name="teacher_id[]"  class="custom-select text-center teacher-list " multiple>
                                                @foreach($teachers as $teacher)
                                                    <option value="{{ $teacher->id}}">{{$teacher->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>


                                </div>
                                <div class="modal-footer" style=" justify-content: space-around">
                                    <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                    <button type="submit"
                                            class="btn btn-primary">{{ trans('trans_school.Submit') }}</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Add New Section -->

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
    $(document).ready(function () {
        $('select[name="Grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        // console.log(data);
                        $.each(data, function (key, value) {
                            $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                            // console.log(data.key)
                        });
                    },
                    // statusCode: {
                    //     500: function(data) {
                    //     console.log(data.responseText);
                    //     }
                    // }
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>
@endsection
