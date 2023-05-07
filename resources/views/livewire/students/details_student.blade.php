<div class="row">
    <div class="col-md-12 mb-30">
        {{-- <div class="card card-statistics h-100"> --}}
            <div class="card-body">

                @if (isset($catchError))
                    <div class="alert alert-danger" id="success-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $catchError }}
                    </div>
                @endif

                    <div class="tab nav-border">
                        <ul class="nav nav-tabs" role="tablist">
                            <button class="nav-link btn <?= $page_student_information == 1 ? 'btn-success' : '' ?>  mx-2" wire:click='page_information' >
                                {{trans('trans_school.student_information')}}</button>

                            <button class="nav-link btn <?= $page_student_information == 2 ? 'btn-success' : '' ?>" wire:click='page_image' >
                                {{trans('trans_school.Attachments')}}</button>
                        </ul>

                        <div class="tab-content">

                            @if($page_student_information == 1)
                                <table class="table table-striped table-hover table_details" style="text-align:center">
                                    <tbody>
                                    <tr>
                                        <th scope="row">{{trans('trans_school.name_student')}}</th>
                                        <td>{{ $Student->name }}</td>
                                        <th scope="row">{{trans('trans_school.Email')}}</th>
                                        <td>{{$Student->email}}</td>
                                        <th scope="row">{{trans('trans_school.gender')}}</th>
                                        <td>{{$Student->genders->name}}</td>
                                        <th scope="row">{{trans('trans_school.Nationality')}}</th>
                                        <td>{{$Student->nationality->name}}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('trans_school.Grade')}}</th>
                                        <td>{{ $Student->grades->name }}</td>
                                        <th scope="row">{{trans('trans_school.classrooms')}}</th>
                                        <td>{{$Student->class_rooms->name_class}}</td>
                                        <th scope="row">{{trans('trans_school.section')}}</th>
                                        <td>{{$Student->sections->name_section}}</td>
                                        <th scope="row">{{trans('trans_school.Date_of_Birth')}}</th>
                                        <td>{{ $Student->date_birth }}</td>
                                    </tr>

                                    <tr>
                                        <th scope="row">{{trans('trans_school.parent')}}</th>
                                        <td>{{ $Student->parents->name_father}}</td>
                                        <th scope="row">{{trans('trans_school.academic_year')}}</th>
                                        <td>{{ $Student->academic_year }}</td>
                                        <th scope="row"></th>
                                        <td></td>
                                        <th scope="row"></th>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>
                            @endif

                            @if($page_student_information == 2)
                                    <div class="card card-statistics">
                                        <form wire:submit.prevent="AddImage({{$Student->id}})">
                                            <div class="card-body"><br>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label
                                                                for="academic_year">{{trans('trans_school.Attachments')}}
                                                                : <span class="text-danger">*</span></label>
                                                            <input type="file" accept="image/*" wire:model="photos" multiple>
                                                            @if($messageImage != '')
                                                                <div class="v-error">{{$messageImage}}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <button class="button button-border x-small" type="submit" >
                                                        {{trans('trans_school.Submit')}}
                                                    </button>
                                            </div>
                                        </form>
                                        <br>

                                        <table class="table center-aligned-table mb-0 table table-hover"
                                            style="text-align:center">
                                            <thead>
                                            <tr class="table-secondary">
                                                <th scope="col">#</th>
                                                <th scope="col">{{trans('trans_school.file_name')}}</th>
                                                <th scope="col">{{trans('trans_school.created_at')}}</th>
                                                <th scope="col">{{trans('trans_school.Processes')}}</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($Student->images as $attachment)
                                                <tr style='text-align:center;vertical-align:middle'>
                                                        <td>{{$loop->iteration}}</td>
                                                        <td>{{$attachment->file_name}}</td>
                                                        <td>{{$attachment->created_at->diffForHumans()}}</td>
                                                        <td colspan="2">
                                                            <button class="btn btn-outline-info btn-sm" wire:click='download_attachment({{$attachment->id}})'
                                                            href="{{url('Download_attachment')}}/{{ $attachment->imageable->name }}/{{$attachment->file_name}}"
                                                            role="button"><i class="fas fa-download"></i>&nbsp; {{trans('trans_school.Download')}}</button>

                                                            <button type="button" wire:click='deleteAttachment({{$attachment->id}})' class="btn btn-outline-danger btn-sm"
                                                                    title="{{ trans('Grades_trans.Delete') }}">{{trans('trans_school.Delete')}}
                                                            </button>

                                                        </td>
                                                </tr>
                                                @endforeach
                                
                                                {{-- @include('pages.Students.Delete_img') --}}
                                            </tbody>
                                        </table>
                                    </div>
                            @endif
                            <br><br>
                            <button onclick="student_hide()" class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="button" wire:click="listStudent" style="margin: auto 5px">
                                {{trans('trans_school.back_to_list_students')}}
                            </button>
            {{-- </div> --}}
        </div>
    </div>
</div>

