<div class="table-responsive">
    <button onclick="student_add()" wire:click="addStudent" class="btn btn-success btn-sm" >{{trans('trans_school.add_student')}}</button>
    <br><br>
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
            data-page-length="50"
            style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th id="name_student">{{trans('trans_school.name_student')}}</th>
            <th>{{trans('trans_school.Email')}}</th>
            <th>{{trans('trans_school.gender')}}</th>
            <th>{{trans('trans_school.Grade')}}</th>
            <th>{{trans('trans_school.classrooms')}}</th>
            <th>{{trans('trans_school.section')}}</th>
            <th>{{trans('trans_school.Processes')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $student)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{$student->name}}</td>
                <td>{{$student->email}}</td>
                <td>{{$student->genders->name}}</td>
                <td>{{$student->grades->name}}</td>
                <td>{{$student->class_rooms->name_class}}</td>
                <td>{{$student->sections->name_section}}</td>

                <td>
                    <div class="dropdown show">
                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{trans('trans_school.Processes')}}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <button  wire:click="showDetailsStudent({{$student->id}})" onclick="student_details()" class="btn btn-warning btn-sm dropdown-item"><i style="color: #ffc107" class="far fa-eye"></i>&nbsp; {{trans('trans_school.View_student_data')}}</button>
                            <button wire:click="editStudent({{$student->id}})" onclick="student_edit()"  class="btn btn-info btn-sm dropdown-item" role="button" aria-pressed="true"><i style="color: green" class="fa fa-edit"></i>&nbsp; {{trans('trans_school.Modify_student_data')}}</button>
                            <a href="{{route('Fees_Invoices.show',$student->id)}}" class="btn btn-sm dropdown-item" ><i style="color: #0000cc" class="fa fa-edit "></i>&nbsp;{{trans('trans_school.Add_fee_invoice')}}&nbsp;</a>
                            <a class="dropdown-item" href="{{route('receipt_students.show',$student->id)}}"><i style="color: #9dc8e2" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;{{trans('trans_school.Catch_Receipt')}}</a>
                            <a class="dropdown-item" href="{{route('fee_processing.show',$student->id)}}"><i style="color: #ffc107" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;{{trans('trans_school.Exclude_fees')}}</a>
                            <a class="dropdown-item" href="{{route('Payment_student.show',$student->id)}}"><i style="color: red" class="fas fa-money-bill-alt"></i>&nbsp; &nbsp;{{trans('trans_school.one_payment_student')}}</a>
                            <button type="button" class="btn btn-danger btn-sm dropdown-item" data-toggle="modal" data-target="#delete{{ $student->id }}"
                                title="{{ trans('trans_school.Delete') }}"><i style="color:red" class="fa fa-trash"></i>&nbsp; {{trans('trans_school.Delete_student_data')}}</button>
                        </div>

                    </div>
                </td>

                {{-- <td>
                    <div class="dropdown show">
                        <a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{trans('trans_school.Processes')}}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{route('Students.show',$student->id)}}"><i style="color: #ffc107" class="far fa-eye "></i>&nbsp;  عرض بيانات الطالب</a>
                            <a class="dropdown-item" href="{{route('Students.edit',$student->id)}}"><i style="color:green" class="fa fa-edit"></i>&nbsp;  تعديل بيانات الطالب</a>
                            <a class="dropdown-item" href="{{route('Fees_Invoices.show',$student->id)}}"><i style="color: #0000cc" class="fa fa-edit"></i>&nbsp;اضافة فاتورة رسوم&nbsp;</a>
                            <a class="dropdown-item" data-target="#Delete_Student{{ $student->id }}" data-toggle="modal" href="##Delete_Student{{ $student->id }}"><i style="color: red" class="fa fa-trash"></i>&nbsp;  حذف بيانات الطالب</a>
                        </div>
                    </div>
                </td> --}}
            </tr>

                <!-- delete_modal_student -->
                <div class="modal fade" id="delete{{$student->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                    id="exampleModalLabel">
                                    {{trans('trans_school.Delete')}}
                                </h5>
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <span class="float-left" style="font-size: initial;" >{{trans('trans_school.Are_you_sure_to_delete_the_process')}}</span><br><br>
                                    
                                    <input id="id" type="hidden" name="id" class="form-control"
                                        value="{{$student->id}}">
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{trans('trans_school.Close')}}</button>
                                        <button type="button" wire:click="delete({{ $student->id }})"
                                            class="btn btn-danger" data-dismiss="modal">{{trans('trans_school.Submit')}}</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

        @endforeach
        </tbody>
    </table>
</div>

