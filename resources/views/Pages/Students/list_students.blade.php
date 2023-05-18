@extends('layouts.master')
@section('css')
    @livewireStyles
@section('title')
    {{ trans('trans_school.list_of_students') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

        {{-- <div class="col-sm-6">
            <h4 class="mb-0"> {{ trans('trans_school.students') }}</h4>
        </div> --}}

        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0" style="font-size: initial">
                <li class="breadcrumb-item bro-text-add-parent"><a href="#" class="default-color">{{trans('trans_school.students')}}</a></li>
                <li class="toggle-show text-add-student breadcrumb-item" >{{trans('trans_school.add_student')}}</li>
                <li class="toggle-show text-edit-student breadcrumb-item" >{{trans('trans_school.edit_student')}}</li>
                <li class="toggle-show text-details-student breadcrumb-item" >{{trans('trans_school.student_information')}}</li>
            </ol>
        </div>

        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{ trans('trans_school.Home') }}</a></li>
                <li class="breadcrumb-item active">{{ trans('trans_school.students') }}</li>
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
            <div class="card-body" id="jjjjj">
                @livewire('students.class-students')
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')



@livewireScripts

{{-- <script>

    document.addEventListener('livewire:load', function () {
        var test =  document.getElementById('repeaterId');
        console.log(test.innerHTML);
    })
</script> --}}
<script>
    // function change_selected() {
    //     setInterval(function(){
    //         const selectElement = document.querySelector(".selected_select");
    //         const child1 = selectElement.children[0];
    //         child1.setAttribute('selected', 'selected');
    //     },700)
    // }
    
</script>

<script>

    // document.addEventListener('livewire:load', function () {
    //     console.log(this.innerHTML);
    // })
</script>

<script>
    function student_add(){
        $('.text-add-student').show(300);
        $('.text-add-student').animate({right: '90px'})
    }

    function student_edit(){
        $('.text-edit-student').show(300);
        $('.text-edit-student').animate({right: '90px'})
    }

    function student_details(){
        $('.text-details-student').show(300);
        $('.text-details-student').animate({right: '90px'})
    }

    function student_hide(){
        $('.text-add-student').animate({right: '25px'})
        $('.text-add-student').hide(500);

        $('.text-edit-student').animate({right: '25px'})
        $('.text-edit-student').hide(500);
        
        $('.text-details-student').animate({right: '25px'})
        $('.text-details-student').hide(500);
    }

</script>
@stack('all_scripts')


@endsection

