<div class="text-center">
    @if (Session()->has('Success'))
        <div class="alert alert-success">{!! Session()->get('Success') !!}</div>
    @elseif(Session()->has('Error'))
        <div class="alert alert-danger">{!! Session()->get('Error') !!}</div>
    @endif
</div>

