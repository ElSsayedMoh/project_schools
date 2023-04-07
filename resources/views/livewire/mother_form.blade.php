
{{-- @if($currentStep !== 1)
    <div style="display: none" class="row setup-content" id="step-1">
        @endif --}}
        <div class="col-xs-12 needs-validation">
            <div class="col-md-12">

                <div class="form-row">
                    <div class="col">
                        <label for="title">{{trans('trans_school.Name_Ar')}}</label>
                        <input type="text" wire:model="Name_Mother"  @error('Name_Mother') class="form-control input-error"  @enderror class="form-control" >
                        @error('Name_Mother')
                            <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('trans_school.Name_En')}}</label>
                        <input type="text" wire:model="Name_Mother_en"  @error('Name_Mother_en') class="form-control input-error"  @enderror  class="form-control">
                        @error('Name_Mother_en')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-md-3">
                        <label for="title">{{trans('trans_school.Job_Ar')}}</label>
                        <input type="text" wire:model="Job_Mother"  @error('Job_Mother') class="form-control input-error"  @enderror class="form-control">
                        @error('Job_Mother')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label for="title">{{trans('trans_school.Job_En')}}</label>
                        <input type="text" wire:model="Job_Mother_en"  @error('Job_Mother_en') class="form-control input-error"  @enderror class="form-control">
                        @error('Job_Mother_en')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('trans_school.National_Number')}}</label>
                        <input type="text" wire:model="National_ID_Mother"  @error('National_ID_Mother') class="form-control input-error"  @enderror class="form-control">
                        @error('National_ID_Mother')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="title">{{trans('trans_school.Passport_ID')}}</label>
                        <input type="text" wire:model="Passport_ID_Mother"  @error('Passport_ID_Mother') class="form-control input-error"  @enderror class="form-control"> 
                        @error('Passport_ID_Mother')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col">
                        <label for="title">{{trans('trans_school.Phone')}}</label>
                        <input type="text" wire:model="Phone_Mother"  @error('Phone_Mother') class="form-control input-error"  @enderror class="form-control" >
                        @error('Phone_Mother')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputCity">{{trans('trans_school.Nationality')}}</label>
                        <select @error('Nationality_Mother_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Nationality_Mother_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Nationalities as $National)
                                <option value="{{$National->id}}">{{$National->name}}</option>
                            @endforeach
                        </select>
                        @error('Nationality_Mother_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputState">{{trans('trans_school.Blood_Type')}}</label>
                        <select @error('Blood_Type_Mother_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Blood_Type_Mother_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Type_Bloods as $Type_Blood)
                                <option value="{{$Type_Blood->id}}">{{$Type_Blood->name}}</option>
                            @endforeach
                        </select>
                        @error('Blood_Type_Mother_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col">
                        <label for="inputZip">{{trans('trans_school.Religion')}}</label>
                        <select @error('Religion_Mother_id') class="custom-select input-error my-1 mr-sm-2"  @enderror class="custom-select my-1 mr-sm-2" wire:model="Religion_Mother_id">
                            <option selected>{{trans('trans_school.Choose')}}...</option>
                            @foreach($Religions as $Religion)
                                <option value="{{$Religion->id}}">{{$Religion->name}}</option>
                            @endforeach
                        </select>
                        @error('Religion_Mother_id')
                        <div class="v-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">{{trans('trans_school.Address')}}</label>
                    <textarea @error('Religion_Mother_id') class="form-control input-error"  @enderror class="form-control" wire:model="Address_Mother" id="exampleFormControlTextarea1" rows="4"></textarea>
                    @error('Address_Mother')
                    <div class="v-error">{{ $message }}</div>
                    @enderror
                </div>
                
                <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="button" wire:click="back(1)" style="margin: auto 5px">
                    {{trans('trans_school.Back')}}
                </button>



                @if($updateMode)
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="secondStepSubmit_update">{{trans('trans_school.Next')}}</button>
                @else
                    <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" type="button"
                        wire:click="secondStepSubmit">{{trans('trans_school.Next')}}</button>
                @endif

            </div>
        {{-- </div> --}}
