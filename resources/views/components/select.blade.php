<div class="form-group row">
    <label for="{{$id??$name}}" class="col-md-4 col-form-label text-md-right">{{ __($label) }}</label>

    <div class="col-md-6">
        <select id="{{$id??$name}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}" required>
            @foreach($options as $option)
                <option value="{{$option['value']}}">{{$option['label']}}</option>
            @endforeach
        </select>

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>