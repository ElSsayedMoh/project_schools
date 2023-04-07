
{{-- @if($currentStep !== 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif --}}
        <div class="col-xs-12 needs-validation">
            <div class="col-md-12">
                <br>
                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('trans_school.Email')}}</label>
                        <input  type="email" wire:model="Email" @error('Email') class="form-control input-error"  @enderror  class="form-control">
                        @error('Email')
                            <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('trans_school.Password')}}</label>
                        <input type="password" wire:model="Password"  @error('Password') class="form-control input-error"  @enderror class="form-control" >
                        @error('Password')
                            <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('trans_school.Name_Ar')}}</label>
                        <input type="text" wire:model="Name_Father"  @error('Name_Father') class="form-control input-error"  @enderror class="form-control" >
                        @error('Name_Father')
                            <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('trans_school.Name_En')}}</label>
                        <input type="text" wire:model="Name_Father_en"  @error('Name_Father_en') class="form-control input-error"  @enderror  class="form-control">
                        @error('Name_Father_en')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('trans_school.Job_Ar')}}</label>
                        <input type="text" wire:model="Job_Father"  @error('Job_Father') class="form-control input-error"  @enderror class="form-control">
                        @error('Job_Father')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('trans_school.Job_En')}}</label>
                        <input type="text" wire:model="Job_Father_en"  @error('Job_Father_en') class="form-control input-error"  @enderror class="form-control">
                        @error('Job_Father_en')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('trans_school.National_Number')}}</label>
                        <input type="text" wire:model="National_ID_Father"  @error('National_ID_Father') class="form-control input-error"  @enderror class="form-control">
                        @error('National_ID_Father')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('trans_school.Passport_ID')}}</label>
                        <input type="text" wire:model="Passport_ID_Father"  @error('Passport_ID_Father') class="form-control input-error"  @enderror class="form-control"> 
                        @error('Passport_ID_Father')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('trans_school.Phone')}}</label>
                        <input type="text" wire:model="Phone_Father"  @error('Phone_Father') class="form-control input-error"  @enderror class="form-control" >
                        @error('Phone_Father')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('trans_school.Nationality')}}</label>
                        <select @error('Nationality_Father_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Nationality_Father_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Father_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('trans_school.Blood_Type')}}</label>
                        <select @error('Blood_Type_Father_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Father_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Father_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('trans_school.Religion')}}</label>
                        <select @error('Religion_Father_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Religion_Father_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Father_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('trans_school.Address')}}</label>
                    <textarea @error('Religion_Father_id') class="form-control input-error"  @enderror class="form-control" wire:model="Address_Father" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('Address_Father')
                    <div class="v-error">{{ $message }}</div>
                    @enderror
                </div>

                <button onclick="parent_hide()" class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back_to_list_parents" style="margin: auto 5px">
                    {{trans('trans_school.back_to_list_parents')}}
                </button>

                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit_update"
                            type="button">{{trans('trans_school.Next')}}
                    </button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="firstStepSubmit"
                        type="button">{{trans('trans_school.Next')}}
                    </button>
                @endif

            </div>
        {{-- </div> --}}

        <script>

        </script>
