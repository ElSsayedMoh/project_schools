@extends('layouts.master')
@section('css')
    @livewireStyles
@section('title')
    {{trans('trans_school.Parents')}}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">

            <div class="col-sm-6">
                <ol class="breadcrumb pt-0 pr-0" style="font-size: initial">
                    <li class="breadcrumb-item bro-text-add-parent"><a href="#" class="default-color">{{trans('trans_school.Parents')}}</a></li>
                    <li class="toggle-show text-add-parent breadcrumb-item" >{{trans('trans_school.add_parent')}}</li>
                    <li class="toggle-show text-edit-parent breadcrumb-item" >{{trans('trans_school.parent_edit')}}</li>
                </ol>
            </div>

        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('trans_school.Home')}}</a></li>
                <li class="breadcrumb-item active">{{trans('trans_school.Parents')}}</li>
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

                <div>
                @if (!empty($successMessage))
                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $successMessage }}
                    </div>
                @endif
                
                @if (isset($catchError))
                    <div class="alert alert-danger" id="success-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $catchError }}
                    </div>
                @endif
                
                <livewire:page-parents /> 
            </div>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
    @livewireScripts
    <script>
        function parent_add(){
            $('.text-add-parent').show(300);
            $('.text-add-parent').animate({right: '125px'})
        }

        function parent_edit(){
            $('.text-edit-parent').show(300);
            $('.text-edit-parent').animate({right: '125px'})
        }

        function parent_hide(){
            $('.text-add-parent').animate({right: '25px'})
            $('.text-add-parent').hide(500);
            $('.text-edit-parent').animate({right: '25px'})
            $('.text-edit-parent').hide(500);
        }
    </script>

@endsection
