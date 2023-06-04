<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
{{-- <script>
    var plugin_path = 'js/';
</script> --}}
<script type="text/javascript"> var plugin_path='{{asset('assets/js')}}/';</script>
<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<script src="{{ URL::asset('assets/js/calendar.init.js') }}"></script>
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>

<script>
    $(document).ready(function(){
        $('select[name="Grade_id_new"]').change(function(){
            var Grade_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getClassroom")}}',
                dataType: "json",
                data: { 'id' : Grade_id },
                success:function(data) {
                    $('select[name="Classroom_id_new"]').empty();
                    $('select[name="Classroom_id_new"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="Classroom_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

        $('select[name="Classroom_id_new"]').change(function(){
            var Classroom_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getSection")}}',
                dataType: "json",
                data: { 'id' : Classroom_id },
                success:function(data) {
                    $('select[name="section_id_new"]').empty();
                    $('select[name="section_id_new"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="section_id_new"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

    })
</script>

<script>
    $(document).ready(function(){
        $('select[name="Grade_id"]').change(function(){
            var Grade_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getClassroom")}}',
                dataType: "json",
                data: { 'id' : Grade_id },
                success:function(data) {
                    $('select[name="Classroom_id"]').empty();
                    $('select[name="Classroom_id"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="Classroom_id"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

        $('select[name="Classroom_id"]').change(function(){
            var Classroom_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getSection")}}',
                dataType: "json",
                data: { 'id' : Classroom_id },
                success:function(data) {
                    $('select[name="section_id"]').empty();
                    $('select[name="section_id"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="section_id"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

    })


</script>

<script>
    $(document).ready(function(){
        $('select[name="Grade_id_teacher"]').change(function(){
            var Grade_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getClassroomTeacher")}}',
                dataType: "json",
                data: { 'id' : Grade_id },
                success:function(data) {
                    $('select[name="Classroom_id_teacher"]').empty();
                    $('select[name="Classroom_id_teacher"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="Classroom_id_teacher"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

        $('select[name="Classroom_id_teacher"]').change(function(){
            var Classroom_id = $(this).val();
            $.ajax({
                type:'Get',
                url:'{{route("getSectionTeacher")}}',
                dataType: "json",
                data: { 'id' : Classroom_id },
                success:function(data) {
                    $('select[name="section_id_teacher"]').empty();
                    $('select[name="section_id_teacher"]').append('<option selected disabled >{{trans('trans_school.Choose')}}...</option>');
                    $.each(data, function(key, value){
                        $('select[name="section_id_teacher"]').append('<option value="' + key + '">' + value + '</option>');
                    })
                }
        });
        })

    })


</script>

<script>
    // function btnDeleteContent(){
    // var deleteRow = document.getElementById("btnDeleteContent");

    // deleteRow.remove();
    // }


        // deleteRow.addE.addRoutes() = function (){
        //     // let a = 'a7a';
        //     // this.remove()
        //     console.log(this.a);
        //     console.log('ifgiyu')
        // }
        // document.addEventListener("click", function(){
        //     console.log('ughiu')
        // })
        
</script>
@stack('scripts')