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


        <li>
            <a href="{{route('chlidren.index')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">الأبناء</span></a>
        </li>

        <li>
            <a href="{{route('children.attendances')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">تقرير الحضور و الغياب</span></a>
        </li>

        <li>
            <a href="{{route('children.fees')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">تقرير المالية</span></a>
        </li>

        <li>
            <a href="{{route('profile_parent.show')}}"><i class="fas fa-id-card-alt"></i><span
                    class="right-nav-text">{{trans('trans_school.profile')}}</span></a>
        </li>


    </ul>
</div>
