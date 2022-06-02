@if(session()->has('error'))
    @component('components.alert',['type' => 'danger', 'message' => session()->get('error')])
    @endcomponent
@endif

@if(session()->has('success'))
    @component('components.alert',[
    'type' => 'success',
    'message' => session()->get('success'),
    'item' => session()->get('item')
    ])
    @endcomponent
@endif

@if($errors->any())
    <div class="form-group">
        @foreach($errors->all() as $error)
            @component('components.alert',['type' => 'danger', 'message' => $error])
            @endcomponent
        @endforeach
    </div>
@endif
