@extends('layouts.master')
@section('css')
    <style>
        .hidden_button{
            position: relative;
            overflow: hidden;
        }
        .hidden_button button{
            position: absolute;
            left: -30px;
        }
        .proccess-classes .parent-group {
            display: inline-table;
        }

    </style>
@section('title')
    {{trans('trans_school.Class_Rooms')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0"> {{trans('trans_school.Class_Rooms')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.Class_Rooms')}}</li>
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
                <div class="table-responsive" >

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="proccess-classes">
                        <button id="width-btn" type="button" class="button x-small mx-4" data-toggle="modal" data-target="#exampleModal">
                            {{ trans('trans_school.add_class') }}
                        </button>

                            <div class="parent-group">
                                <ul class="nav navbar-nav ml-auto">
                                    <li class="nav-item dropdown">
                                        <a style="padding: 8px 14px;" class="btn  dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('trans_school.Search_by_stage_name')}}
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                            <button id="allGrade_search" class="dropdown-item get_grade" name="grade_id_search" rel="alternate" data-confirm="{{ trans('trans_school.all_grades') }}">
                                                {{ trans('trans_school.all_grades') }} </button>
                                            @foreach ($Grades as $Grade)
                                            <button class="dropdown-item get_grade" name="grade_id_search" rel="alternate" value="{{ $Grade->id }}">
                                                {{ $Grade->name }} </button>
                                            @endforeach

                                        </div>
                                    </li>
                                </ul>
                            </div>
                </div>
                    
                    <br><br>

                    <table  style="text-align: center" id="datatable" class="table table-striped table-bordered p-0">
                    <thead>
                        <tr>
                            <th class="hidden_button">
                                <input class="check_all" type="checkbox" id="checkAll">
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete_all"
                                        title="{{ trans('trans_school.Delete') }}"><i
                                        class="fa fa-trash"></i></button>
                            </th>
                            <th>#</th>
                            <th>{{trans('trans_school.Class_name')}}</th>
                            <th>{{trans('trans_school.Name_Grade')}}</th>
                            <th>{{trans('trans_school.Processes')}}</th>
                        </tr>
                    </thead>

                    <tbody  id="tbody_checkbox">

                        @if(isset($search_grade))
                            <?php $ClassRoomss = $search_grade ?>
                        @elseif(isset($ClassRooms))
                            <?php $ClassRoomss = $ClassRooms; ?>
                        @endif

                        @foreach ($ClassRoomss as $ClassRoom)
                            <tr>
                                <td>
                                    <input class=" checkChild check check_all" type="checkbox" value="{{$ClassRoom->id}}" id="flexCheckDefault">
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ClassRoom->name_class }}</td>
                                <td class="value_gradee">{{ $ClassRoom->Grades->name }}</td>
                                {{-- <td class="value_grade_id_table" style="display:none;">{{$ClassRoom->grade_id}}</td> --}}
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#Edit{{$ClassRoom->id}}" title="{{trans('trans_school.Edit')}}"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#delete{{$ClassRoom->id}}"
                                        title="{{ trans('trans_school.Delete') }}"><i
                                            class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                                <!-- Edit_modal_class -->
                            <div class="modal fade" id="Edit{{$ClassRoom->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                {{ trans('trans_school.add_class') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form class=" row mb-30" action="{{route('ClassRooms.update', 'test')}}" method="POST">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="card-body">
                                                    <div class="repeater">
                                                            <div data-repeater-item>
                                                                <div class="row">

                                                                    <div class="col">
                                                                        <label for="Name"
                                                                            class="mr-sm-2">{{ trans('trans_school.Name_class_ar') }}
                                                                            :</label>
                                                                        <input class="form-control" type="text" value="{{$ClassRoom->getTranslation('name_class', 'ar')}}" name="name_ar" />
                                                                    </div>


                                                                    <div class="col">
                                                                        <label for="Name"
                                                                            class="mr-sm-2">{{ trans('trans_school.Name_class_en') }} 
                                                                            :</label>
                                                                        <input class="form-control" type="text" value="{{$ClassRoom->getTranslation('name_class', 'en')}}" name="name_en" />
                                                                    </div>

                                                                    <input type="hidden" name="id" value="{{$ClassRoom->id}}">


                                                                    <div class="col">
                                                                        <label for="Name_en"
                                                                            class="mr-sm-2">{{ trans('trans_school.Name_Grade') }}
                                                                            :</label>

                                                                        <div class="box">
                                                                            <select class="fancyselect" name="Grade_id">
                                                                                <option value="{{$ClassRoom->grade_id}}" selected>{{$ClassRoom->Grades->name}}  </option>
                                                                                @foreach ($Grades as $Grade)
                                                                                    <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <br><br>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                                            <button type="submit"
                                                                class="btn btn-success">{{ trans('trans_school.Submit') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <!-- delete_modal_class -->
                            <div class="modal fade" id="delete{{$ClassRoom->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{trans('trans_school.delete_class')}}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{route('ClassRooms.destroy' , 'test')}}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <span >{{trans('trans_school.Are_you_sure_to_delete_the_process')}}</span>
                                                
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{$ClassRoom->id}}">
        
                                                {{-- @if(App::isLocale('ar')) --}}
                                                    <input type="text" class="form-control mt-3" value="{{$ClassRoom->name_class}}" readonly>
                                                {{-- @else
                                                    <input type="text" class="form-control mt-3"
                                                    value="{{$ClassRoom->getTranslation('name_class', 'en')}}">
                                                @endif --}}
        
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                                    <button type="submit"
                                                        class="btn btn-danger">{{trans('trans_school.Submit')}}</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- delete_all_modal_class -->
                        <div class="modal fade" id="delete_all" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                            id="exampleModalLabel">
                                            {{trans('trans_school.delete_all_classes')}}
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal"
                                            aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route('delete_all')}}" method="POST">
                                            @csrf
                                            <br><span >{{trans('trans_school.Are_you_sure_to_delete_the_process')}}</span><br><br>
                                            
                                            <input id="id_all_classes" type="hidden" name="id" class="form-control">

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                                <button type="submit"
                                                    class="btn btn-danger">{{trans('trans_school.Submit')}}</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                    
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add_modal_class -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                        {{ trans('trans_school.add_class') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form class=" row mb-30" action="{{route('ClassRooms.store')}}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="repeater">
                                <div data-repeater-list="List_Classes">
                                    <div data-repeater-item>
                                        <div class="row">

                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('trans_school.Name_class_ar') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_ar" />
                                            </div>


                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('trans_school.Name_class_en') }}
                                                    :</label>
                                                <input class="form-control" type="text" name="name_en" />
                                            </div>


                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('trans_school.Name_Grade') }}
                                                    :</label>

                                                <div class="box">
                                                    <select class="fancyselect" name="Grade_id">
                                                        @foreach ($Grades as $Grade)
                                                            <option value="{{ $Grade->id }}">{{ $Grade->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('trans_school.Processes') }}
                                                    :</label>
                                                <input class="btn btn-danger btn-block" data-repeater-delete
                                                    type="button" value="{{ trans('trans_school.Delete') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-20">
                                    <div class="col-12">
                                        <input class="button" data-repeater-create type="button" value="{{ trans('trans_school.add_row') }}"/>
                                    </div>

                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ trans('trans_school.Close') }}</button>
                                    <button type="submit"
                                        class="btn btn-success">{{ trans('trans_school.Submit') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{-- end modal add --}}
</div>
<!-- row closed -->
@endsection
@section('js')

    <script>
        
        $("#checkAll").click(function () {
            $(".check").prop('checked', $(this).prop('checked'));
            if($('.check').is(':checked')) {
                $(".hidden_button button").animate({left: '10%'});
            }else {
                $(".hidden_button button").animate({left: '-30px'});
            }
        });

        $('.check').click(function () {
            if($('.check').is(':checked')) {
                $(".hidden_button button").animate({left: '10%'});
            }else {
                $(".hidden_button button").animate({left: '-30px'});
                $('#checkAll').prop('checked',false);
            }
        });

        $('.check_all').click(function () {
            var selected = new Array();
            $("#tbody_checkbox input[type = checkbox]:checked").each(function () {
                selected.push(this.value);
                $('#id_all_classes').val(selected);
            });
        });
    </script>


    <script>
        $('.get_grade').click(function (e) {
            var grade = $.trim($(this).text());
            var allGrades = $('#allGrade_search').attr('data-confirm');
            if ($(this).attr('data-confirm') == allGrades ) {
                    $("#tbody_checkbox tr").show();
            } else {
                $("#tbody_checkbox tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(grade) > -1)
                });
            }
            });
    </script>
    
@endsection

