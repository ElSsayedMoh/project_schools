<div>
    {{-- <h1>{{ $parents }}</h1> --}}

    @if($parents_page == 1) 
        @include('livewire.parents-table')
    @endif
    @if($parents_page == 2)
        @include('livewire.add-parent')
    @endif

</div>