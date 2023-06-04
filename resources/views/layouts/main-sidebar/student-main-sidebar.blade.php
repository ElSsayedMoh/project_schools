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

        <!-- Quizzes-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#Quizzes-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('trans_school.Quizzes')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="Quizzes-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="{{route('Quizze.index')}}">{{trans('trans_school.list_of_quizzes')}}</a></li>
            </ul>
        </li>

        <!-- profile-->
        <li>
            <a href="javascript:void(0);" data-toggle="collapse" data-target="#profile-menu">
                <div class="pull-left"><i class="fas fa-school"></i><span
                        class="right-nav-text">{{trans('trans_school.profile')}}</span></div>
                <div class="pull-right"><i class="ti-plus"></i></div>
                <div class="clearfix"></div>
            </a>
            <ul id="profile-menu" class="collapse" data-parent="#sidebarnav">
                <li><a href="">{{trans('trans_school.profile')}}</a></li>
            </ul>
        </li>


    </ul>
</div>
