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

<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#step-1" type="button"
               class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
            <p>{{ trans('trans_school.father_information') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-2" type="button"
               class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
            <p>{{ trans('trans_school.mother_information') }}</p>
        </div>
        <div class="stepwizard-step">
            <a href="#step-3" type="button"
               class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
               disabled="disabled">3</a>
            <p>{{ trans('trans_school.confirm_information') }}</p>
        </div>
    </div>
</div>


@if($currentStep == 1)
    @include('livewire.father_form')
@endif
@if($currentStep == 2)
    @include('livewire.mother_form')
@endif

@if($currentStep == 3)
{{-- <div class="col-xs-12">
    <div class="col-md-12">
        <h3 style="font-family: 'Cairo', sans-serif;">{{trans('trans_school.are_you_soure_to_save_the_data')}}</h3><br>
        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="back(2)" style="margin: auto 5px">{{ trans('trans_school.Back') }}</button>

        <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                type="button">{{ trans('trans_school.Finish') }}</button>
    </div>
</div> --}}
<div class="col-xs-12">
    <div class="col-md-12"><br>
        <label style="color: red">{{trans('trans_school.Attachments')}}</label>
        <div class="form-group">
            <input type="file" wire:model="photos" accept="image/*" multiple>
        </div>
        <br>

        <input type="hidden" wire:model="parent_id">

        <button class="btn btn-primary btn-sm nextBtn btn-lg pull-right" type="button"
                wire:click="back(2)" style="margin: auto 5px">{{ trans('trans_school.Back') }}</button>

        @if($updateMode)
            <button class="btn btn-success btn-sm nextBtn btn-lg pull-right" wire:click="submitForm_edit"
                    type="button">{{trans('trans_school.Finish')}}
            </button>
        @else
            <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                    type="button">{{ trans('trans_school.Finish') }}</button>
        @endif

    </div>
</div>
@endif


<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>

<script>
    setTimeout(function() {
        $('.alert-success').fadeOut('slow');
    }, 4000);
</script>