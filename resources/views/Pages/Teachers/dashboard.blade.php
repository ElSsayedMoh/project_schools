<!DOCTYPE html>
<html lang="en">
@section('title')
{{trans('trans_school.Dashboard')}}
@stop
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Webmin - Bootstrap 4 & Angular 5 Admin Dashboard Template" />
    <meta name="author" content="potenzaglobalsolutions.com" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    @include('layouts.head')
    @livewireStyles
</head>

<body style="font-family: 'Cairo', sans-serif">

    <div class="wrapper" style="font-family: 'Cairo', sans-serif">

        <!--=================================
 preloader -->

 <div id="pre-loader">
     <img src="{{ URL::asset('assets/images/pre-loader/loader-01.svg') }}" alt="">
 </div>

        <!--=================================
 preloader -->

        @include('layouts.main-header')

        @include('layouts.main-sidebar')
        {{-- <x-main-sidebar></x-main-sidebar> --}}

        <!--=================================
 Main content -->
        <!-- main-content -->
        <div class="content-wrapper">
            <div class="page-title" >
                <div class="row">
                    <div class="col-sm-4">
                        <h4 class="mb-0" style="font-family: 'Cairo', sans-serif">&nbsp; @lang('trans_school.welcome') @lang('trans_school.mr') / {{auth()->user()->name}}</h4><br>
                    </div>
                </div>
            </div>
            <!-- widgets -->
            <div class="row" >
                <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-success">
                                        <i class="fas fa-user-graduate highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">@lang('trans_school.count_students')</p>
                                    <h4>{{$count_students}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('students_of_teacher')}}" target="_blank"><span class="text-danger">@lang('trans_school.view_data')</span></a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="clearfix">
                                <div class="float-left">
                                    <span class="text-primary">
                                        <i class="fas fa-chalkboard highlight-icon" aria-hidden="true"></i>
                                    </span>
                                </div>
                                <div class="float-right text-right">
                                    <p class="card-text text-dark">@lang('trans_school.Count_Sections')</p>
                                    <h4>{{$count_sections}}</h4>
                                </div>
                            </div>
                            <p class="text-muted pt-3 mb-0 mt-2 border-top">
                                <i class="fas fa-binoculars mr-1" aria-hidden="true"></i><a href="{{route('sections_of_teacher')}}" target="_blank"><span class="text-danger">@lang('trans_school.view_data')</span></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Orders Status widgets-->


            <div class="row">

                <div  style="height: 400px;" class="col-xl-12 mb-30">
                    <div class="card card-statistics h-100">
                        <div class="card-body">
                            <div class="tab nav-border" style="position: relative;">
                                <div class="d-block d-md-flex justify-content-between">
                                    <div class="d-block w-100">
                                        <h5 style="font-family: 'Cairo', sans-serif" class="card-title">@lang('trans_school.last_process_on_system')</h5>
                                    </div>
                                    <div class="d-block d-md-flex nav-tabs-custom">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item">
                                                <a class="nav-link active show" id="students-tab" data-toggle="tab"
                                                   href="#students" role="tab" aria-controls="students"
                                                   aria-selected="true"> @lang('trans_school.students')</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="teachers-tab" data-toggle="tab" href="#teachers"
                                                   role="tab" aria-controls="teachers" aria-selected="false">@lang('trans_school.Teachers')
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="parents-tab" data-toggle="tab" href="#parents"
                                                   role="tab" aria-controls="parents" aria-selected="false">@lang('trans_school.Parents')
                                                </a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="fee_invoices-tab" data-toggle="tab" href="#fee_invoices"
                                                   role="tab" aria-controls="fee_invoices" aria-selected="false">@lang('trans_school.the_invoices')
                                                </a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTabContent">

                                    {{--students Table--}}
                                    <div class="tab-pane fade active show" id="students" role="tabpanel" aria-labelledby="students-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th>@lang('trans_school.name_student')</th>
                                                    <th>@lang('trans_school.Email')</th>
                                                    <th>@lang('trans_school.gender')</th>
                                                    <th>@lang('trans_school.Grade')</th>
                                                    <th>@lang('trans_school.classrooms')</th>
                                                    <th>@lang('trans_school.section')</th>
                                                    <th>@lang('trans_school.created_at')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse(\App\Models\Students::latest()->take(5)->get() as $student)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$student->name}}</td>
                                                        <td>{{$student->email}}</td>
                                                        <td>{{$student->genders->name}}</td>
                                                        <td>{{$student->grades->name}}</td>
                                                        <td>{{$student->class_rooms->name_class}}</td>
                                                        <td>{{$student->sections->name_section}}</td>
                                                        <td class="text-success">{{$student->created_at}}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">@lang('trans_school.There_is_no_data')</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--teachers Table--}}
                                    <div class="tab-pane fade" id="teachers" role="tabpanel" aria-labelledby="teachers-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th>@lang('trans_school.name_teacher')</th>
                                                    <th>@lang('trans_school.gender')</th>
                                                    <th>@lang('trans_school.joining_date')</th>
                                                    <th>@lang('trans_school.specialization')</th>
                                                    <th>@lang('trans_school.created_at')</th>
                                                </tr>
                                                </thead>

                                                @forelse(\App\Models\Teachers::latest()->take(5)->get() as $teacher)
                                                    <tbody>
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$teacher->name}}</td>
                                                        <td>{{$teacher->genders->name}}</td>
                                                        <td>{{$teacher->joining_date}}</td>
                                                        <td>{{$teacher->specializations->name}}</td>
                                                        <td class="text-success">{{$teacher->created_at}}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">@lang('trans_school.There_is_no_data')</td>
                                                    </tr>
                                                    </tbody>
                                                @endforelse
                                            </table>
                                        </div>
                                    </div>

                                    {{--parents Table--}}
                                    <div class="tab-pane fade" id="parents" role="tabpanel" aria-labelledby="parents-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th>@lang('trans_school.name_parent')</th>
                                                    <th>@lang('trans_school.Email')</th>
                                                    <th>@lang('trans_school.National_Number')</th>
                                                    <th>@lang('trans_school.Phone')</th>
                                                    <th>@lang('trans_school.created_at')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse(\App\Models\Parents::latest()->take(5)->get() as $parent)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$parent->name_father}}</td>
                                                        <td>{{$parent->email}}</td>
                                                        <td>{{$parent->national_id_father}}</td>
                                                        <td>{{$parent->phone_father}}</td>
                                                        <td class="text-success">{{$parent->created_at}}</td>
                                                        @empty
                                                            <td class="alert-danger" colspan="8">@lang('trans_school.There_is_no_data')</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    {{--sections Table--}}
                                    <div class="tab-pane fade" id="fee_invoices" role="tabpanel" aria-labelledby="fee_invoices-tab">
                                        <div class="table-responsive mt-15">
                                            <table style="text-align: center" class="table center-aligned-table table-hover mb-0">
                                                <thead>
                                                <tr  class="table-info text-danger">
                                                    <th>#</th>
                                                    <th>@lang('trans_school.invoice_date')</th>
                                                    <th>@lang('trans_school.name_student')</th>
                                                    <th>@lang('trans_school.Grade')</th>
                                                    <th>@lang('trans_school.classrooms')</th>
                                                    <th>@lang('trans_school.section')</th>
                                                    <th>@lang('trans_school.Fee_type')</th>
                                                    <th>@lang('trans_school.Amount')</th>
                                                    <th>@lang('trans_school.created_at')</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @forelse(\App\Models\feeInvoice::latest()->take(10)->get() as $section)
                                                    <tr>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$section->invoice_date}}</td>
                                                        <td>{{$section->student->name}}</td>
                                                        <td>{{$section->grade->name}}</td>
                                                        <td>{{$section->classroom->name_class}}</td>
                                                        <td>{{$section->student->sections->name_section}}</td>
                                                        <td>{{$section->fees->title}}</td>
                                                        <td>{{$section->amount}}</td>
                                                        <td class="text-success">{{$section->created_at}}</td>
                                                    </tr>
                                                @empty
                                                    <tr>
                                                        <td class="alert-danger" colspan="9">@lang('trans_school.There_is_no_data')</td>
                                                    </tr>
                                                @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!--=================================
 wrapper -->

            <!--=================================
 footer -->

            @include('layouts.footer')
        </div><!-- main content wrapper end-->
    </div>
    </div>
    </div>

    <!--=================================
 footer -->

    @include('layouts.footer-scripts')
    @livewireScripts
    @stack('scripts')

</body>

</html>