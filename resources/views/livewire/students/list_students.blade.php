<div class="table-responsive">
    <button onclick="student_add()" wire:click="addStudent" class="btn btn-success btn-sm" >{{trans('trans_school.add_student')}}</button>
    <br><br>
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0"
            data-page-length="50"
            style="text-align: center">
        <thead>
        <tr>
            <th>#</th>
            <th>{{trans('trans_school.name_student')}}</th>
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
                    <button wire:click="editStudent({{$student->id}})" onclick="student_edit()"  class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></button>
                    
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $student->id }}"
                         title="{{ trans('trans_school.Delete') }}"><i class="fa fa-trash"></i></button>

                    <a href="#" class="btn btn-warning btn-sm" role="button" aria-pressed="true"><i class="far fa-eye"></i></a>
                </td>
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
