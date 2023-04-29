@if($student_page == 1)
    @include('livewire.Students.list_students')
@endif
@if($student_page == 2)
    @include('livewire.Students.add_students')
@endif
@if($student_page == 3)
    @include('livewire.Students.edit_students')
@endif
@if($student_page == 4)
    @include('livewire.Students.details_student')
@endif


{{-- <script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script> --}}
