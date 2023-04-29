<div class="row">
    <div class="col-md-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if (isset($catchError))
                    <div class="alert alert-danger" id="success-danger">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        {{ $catchError }}
                    </div>
                @endif

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('trans_school.personal_information')}}</h6><br>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.Name_Ar')}} : <span class="text-danger">*</span></label>
                                    <input  type="text" wire:model="name_ar"  class="form-control @error('name_ar') input-error @enderror">
                                    @error('name_ar')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.Name_En')}} : <span class="text-danger">*</span></label>
                                    <input  class="form-control @error('name_en') input-error @enderror " wire:model="name_en" type="text" >
                                    @error('name_en')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.Email')}} : </label>
                                    <input type="email"  wire:model="email" class="form-control  @error('email') input-error @enderror " autocomplete="nofill">
                                    @error('email')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{trans('trans_school.Password')}} :</label>
                                    <input  type="password" wire:model="password" class="form-control  @error('password') input-error @enderror" >
                                    @error('password')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="gender">{{trans('trans_school.gender')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2 @error('gender_id') input-error @enderror" wire:model="gender_id">
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                        @foreach($Genders as $Gender)
                                            <option  value="{{ $Gender->id }}">{{ $Gender->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('gender_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="nal_id">{{trans('trans_school.Nationality')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2 @error('nationalitie_id') input-error @enderror" wire:model="nationalitie_id">
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                        @foreach($nationals as $nal)
                                            <option  value="{{ $nal->id }}">{{ $nal->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('nationalitie_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="bg_id">{{trans('trans_school.Blood_Type')}} : </label>
                                    <select class="custom-select mr-sm-2 @error('blood_id') input-error @enderror" wire:model="blood_id">
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                        @foreach($bloods as $bg)
                                            <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group date">
                                    <label>{{trans('trans_school.Date_of_Birth')}}  :</label>

                                    <div class="row" style="">

                                        <div class="col-md-4 col-sm-6">
                                            <select wire:model="year" class="custom-select mr-sm-2 @error('year') input-error @enderror" >
                                                <option selected value="">{{trans('trans_school.Year')}}</option>
                                            @for($i = 2000 ; $i <= 2020 ; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            </select>
                                            @error('year')
                                                <div class="v-error">{{ $message }}</div> 
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <select wire:model="month" class="custom-select mr-sm-2 @error('month') input-error @enderror" >
                                                <option selected value="">{{trans('trans_school.Month')}}</option>
                                                @for($i = 1 ; $i <= 12 ; $i++)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>
                                            @error('month')
                                                <div class="v-error">{{ $message }}</div> 
                                            @enderror
                                        </div>

                                        <div class="col-md-4 col-sm-6">
                                            <select wire:model="day" class="custom-select mr-sm-2 @error('day') input-error @enderror" >
                                            <option selected value="">{{trans('trans_school.Day')}}</option>
                                            @for($i = 1 ; $i <= 31 ; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                            </select>
                                            @error('day')
                                                <div class="v-error">{{ $message }}</div> 
                                            @enderror
                                        </div>

                                    </div>

                                </div>
                            </div>

                        </div>

                    <h6 style="font-family: 'Cairo', sans-serif;color: blue">{{trans('trans_school.Student_information')}}</h6><br>
                    <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Grade_id">{{trans('trans_school.Grade')}} : <span class="text-danger">*</span></label>
                                    <select  wire:model="Grade_id" wire:change="getclasses" class="custom-select mr-sm-2 change_selected @error('Grade_id') input-error @enderror" >
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                        @foreach($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('Grade_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="Classroom_id">{{trans('trans_school.classrooms')}} : <span class="text-danger">*</span></label>
                                    <select wire:change="change_in_classes" class="custom-select mr-sm-2 selected_select @error('Classroom_id') input-error @enderror" wire:model="Classroom_id">
                                        @if(!empty($my_classes))
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                            @foreach($my_classes as $c)
                                                <option value="{{ $c->id }}">{{ $c->name_class }}</option>
                                            @endforeach
                                        @elseif(empty($my_classes) || $my_classes = '')
                                            <option selected >  {{trans('trans_school.Choose_ClassRoom_First')}}</option>
                                        @endif
                                    </select>
                                    @error('Classroom_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-2">
                                <div class="form-group">
                                    <label for="section_id">{{trans('trans_school.section')}} : </label>
                                    <select class="custom-select mr-sm-2 @error('section_id') input-error @enderror" wire:model="section_id">
                                        @if(!empty($sections))
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}">{{ $section->name_section }}</option>
                                            @endforeach
                                        @elseif(empty($sections) || $sections = '')
                                            <option selected="selected" > {{trans('trans_school.Choose_Grade_First')}}</option>
                                        @endif
                                    </select>
                                    @error('section_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="parent_id">{{trans('trans_school.parent')}} : <span class="text-danger">*</span></label>
                                    <select class="custom-select mr-sm-2 @error('parent_id') input-error @enderror" wire:model="parent_id">
                                        <option selected >{{trans('trans_school.Choose')}}...</option>
                                       @foreach($parents as $parent)
                                            <option value="{{ $parent->id }}">{{ $parent->name_father }}</option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="v-error">{{ $message }}</div> 
                                    @enderror
                                </div>
                            </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('trans_school.academic_year')}} : <span class="text-danger">*</span></label>
                                <select class="custom-select mr-sm-2 @error('academic_year') input-error @enderror" wire:model="academic_year">
                                    <option selected >{{trans('trans_school.Choose')}}...</option>
                                    <option>2023</option>
                                    <option>2022</option>
                                </select>
                                @error('academic_year')
                                    <div class="v-error">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div>
                        </div><br>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="academic_year">{{trans('trans_school.Attachments')}} : <span class="text-danger">*</span></label>
                                <input style="display:block" type="file" accept="image/*" wire:model='photos' multiple>
                                @error('photos')
                                    <div class="v-error">{{ $message }}</div> 
                                @enderror
                            </div>
                        </div><br>

                        <button onclick="student_hide()" class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="button" wire:click="listStudent" style="margin: auto 5px">
                            {{trans('trans_school.back_to_list_students')}}
                        </button>

                        <button wire:click="AddStudentInDatabase" class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="submit">{{trans('trans_school.Submit')}}</button>

            </div>
        </div>
    </div>
</div>

