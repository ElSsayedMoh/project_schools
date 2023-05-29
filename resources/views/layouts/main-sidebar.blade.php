<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg" style="overflow: scroll">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                <a href="{{ url('/dashboard') }}">
                    <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('trans_school.Home')}}</span>
                    </div>
                    <div class="clearfix"></div>
                </a>
</li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('trans_school.school_management_project')}} </li>

                    <!-- Grades-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Grades-menu">
                            <div class="pull-left"><i class="fas fa-school"></i><span
                                    class="right-nav-text">{{trans('trans_school.School_Grade')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Grades-menu" class="collapse" data-parent="#sidebarnav">
                            <li><a href="{{route('Grade.index')}}">{{trans('trans_school.list_school_grade')}}</a></li>

                        </ul>
                    </li>
                    <!-- classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#classes-menu">
                            <div class="pull-left"><i class="fa fa-building"></i><span
                                    class="right-nav-text">{{trans('trans_school.classes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="classes-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('ClassRooms.index')}}">{{trans('trans_school.list_of_classes')}}</a> </li>
                        </ul>
                    </li>


                    <!-- sections-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#sections-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard"></i></i><span
                                    class="right-nav-text">{{trans('trans_school.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="sections-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Sections.index')}}">{{trans('trans_school.list_of_sections')}} </a> </li>
                        </ul>
                    </li>


                    <!-- students-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#students-menu">
                            <div class="pull-left"><i class="fas fa-user-graduate"></i></i></i><span
                                    class="right-nav-text">{{trans('trans_school.students')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="students-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('Students')}}">{{trans('trans_school.list_of_students')}} </a> </li>
                            <li> <a href="{{route('StudentsPromotion.index')}}">{{trans('trans_school.Students_Promotion')}} </a> </li>
                            <li> <a href="{{route('StudentsPromotion.create')}}">{{trans('trans_school.Students_Promotion_Management')}} </a> </li>
                        

                            <li>
                                <a href="javascript:void(0);" data-toggle="collapse" data-target="#Students_upgrade">{{trans('trans_school.graduating_students')}}<div class="pull-right"><i class="ti-plus"></i></div><div class="clearfix"></div></a>
                                <ul id="Students_upgrade" class="collapse">
                                    <li> <a href="{{route('StudentsGraduate.create')}}">{{trans('trans_school.Add_a_new_graduation')}}</a></li>
                                    <li> <a href="{{route('StudentsGraduate.index')}}">{{trans('trans_school.List_of_graduates')}}</a> </li>
                                </ul>
                            </li>

                    </ul>

                    </li>



                    <!-- Teachers-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Teachers-menu">
                            <div class="pull-left"><i class="fas fa-chalkboard-teacher"></i></i><span
                                    class="right-nav-text">{{trans('trans_school.Teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Teachers-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Teachers.index')}}">{{trans('trans_school.list_of_teachers')}} </a> </li>
                            {{-- <li> <a href="calendar-list.html">List Calendar</a> </li> --}}
                        </ul>
                    </li>


                    <!-- Parents-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Parents-menu">
                            <div class="pull-left"><i class="fas fa-user-tie"></i><span
                                    class="right-nav-text">{{trans('trans_school.Parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Parents-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{url('Parents')}}">{{trans('trans_school.list_of_parents')}}</a> </li>
                        </ul>
                    </li>

                    <!-- Accounts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Accounts-menu">
                            <div class="pull-left"><i class="fas fa-money-bill-wave-alt"></i><span
                                    class="right-nav-text">{{trans('trans_school.Accounts')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Accounts-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Fees.index')}}">{{trans('trans_school.study_fees')}}</a> </li>
                            <li> <a href="{{route('Fees_Invoices.index')}}">{{trans('trans_school.School_Invoices')}}</a> </li>
                            <li> <a href="{{route('receipt_students.index')}}">{{trans('trans_school.receipt')}}</a> </li>
                            <li> <a href="{{route('fee_processing.index')}}">{{trans('trans_school.Exclude_fees')}}</a> </li>
                            <li> <a href="{{route('Payment_student.index')}}">{{trans('trans_school.Payment_student')}}</a> </li>
                        </ul>
                    </li>

                    <!-- Attendance-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Attendance-icon">
                            <div class="pull-left"><i class="fas fa-calendar-alt"></i><span class="right-nav-text">{{trans('trans_school.Attendance')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Attendance-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Attendance.index')}}">{{trans('trans_school.list_of_students')}}</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                        </ul>
                    </li>

                    
                    <!-- Subjects-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Subjects-icon">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('trans_school.Subjects')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Subjects-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Subjects.index')}}">{{trans('trans_school.list_of_subjects')}}</a> </li>
                        </ul>
                    </li>

                    <!-- Quizzes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Exams-icon">
                            <div class="pull-left"><i class="fas fa-book-open"></i><span class="right-nav-text">{{trans('trans_school.Quizzes')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Exams-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Quizze.index')}}">@lang('trans_school.list_of_quizzes')</a> </li>
                        </ul>
                    </li>


                    <!-- library-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#library-icon">
                            <div class="pull-left"><i class="fas fa-book"></i><span class="right-nav-text">{{trans('trans_school.library')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="library-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('Library.index')}}">قائمة الكتب</a> </li>
                        </ul>
                    </li>


                    <!-- Online classes-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Onlineclasses-icon">
                            <div class="pull-left"><i class="fas fa-video"></i><span class="right-nav-text">{{trans('trans_school.Onlineclasses')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Onlineclasses-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="{{route('online_classes.index')}}">@lang('trans_school.Direct_contact_with_Zoom')</a> </li>
                            <li> <a href="themify-icons.html">@lang('trans_school.Indirect_contact_with_Zoom')</a> </li>
                        </ul>
                    </li>


                    <!-- Settings-->
                    <li>
                        <a href="{{route('settings.index')}}"><i class="fas fa-cogs"></i><span class="right-nav-text">{{trans('trans_school.Settings')}} </span></a>
                    </li>


                    <!-- Users-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Users-icon">
                            <div class="pull-left"><i class="fas fa-users"></i><span class="right-nav-text">{{trans('trans_school.Users')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Users-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href="fontawesome-icon.html">font Awesome</a> </li>
                            <li> <a href="themify-icons.html">Themify icons</a> </li>
                            <li> <a href="weather-icon.html">Weather icons</a> </li>
                        </ul>
                    </li>

                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================