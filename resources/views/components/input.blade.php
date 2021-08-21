<div class="form-group row">
    <label for="{{$id??$name}}" class="col-md-4 col-form-label text-md-right">{{ __($label) }}</label>

    <div class="col-md-6">
        <input id="{{$id??$name}}" type="{{$type??'text'}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="{{ old($name) }}" @if($required??false) required @endif autofocus>

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>