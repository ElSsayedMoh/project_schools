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
@if($student_page == 5)
    @include('livewire.Students.add-invoice')
@endif

@push('all_scripts')
<script wire:poll>
    var i = 1;
    var name_student = document.getElementById('name_student_h');

    function repeatDiv(){
    console.log(name_student);

        i++;
        console.log(i);
        var content = `
        <div id="repeaterContent">
            <div  class="row">

                <div class="col">
                    <label for="Name" class="mr-sm-2">اسم الطالب</label>
                    <div class="box">
                        <input readonly style="padding:10px" type="text" class="form-control" placeholder="`+'السيد'+`" >
                    </div>
                </div>

                <div class="col">
                    <label for="Name_en" class="mr-sm-2">نوع الرسوم</label>
                    <div class="box">
                        <select wire:model="fee_id.`+i+ `" class="custom-select mr-sm-2" >
                            <option value="">-- اختار من القائمة --</option>
                            @if(isset($fees))
                            @foreach($fees as $fee)
                                <option value="{{ $fee->id }}">{{ $fee->title }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>

                </div>

                <div class="col">
                    <label for="Name_en" class="mr-sm-2">المبلغ</label>
                    <div class="box">
                        <select wire:model="amount.`+i+ `" class="custom-select mr-sm-2" >
                            <option value="">-- اختار من القائمة --</option>
                            @if(isset($fees))

                            @foreach($fees as $fee)
                                <option value="{{ $fee->amount }}">{{ $fee->amount }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>

                <div class="col">
                    <label for="description" class="mr-sm-2">البيان</label>
                    <div class="box">
                        <input wire:model="description.`+i+ `" style="padding:10px" type="text" class="form-control" >
                    </div>
                </div>

                <div class="col">
                    <label for="Name_en" class="mr-sm-2">{{ trans('trans_school.Processes') }}:</label>
                    <div class="box">
                        <button style="width: 40%; padding:7px" type="button" wire:click='delete_in_count' onclick="this.parentElement.parentElement.parentElement.parentElement.remove()" class="deleteCon p-2 btn btn-danger" >{{ trans('trans_school.Delete') }}</button>
                    </div>
                </div>
            </div>
            <br><br>
        </div>
            `;
            $("#repeaterId").append(content);
    }
</script>

@endpush
