@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <x-input name="first_name" label="First Name" :required="true"/>
                        <x-input name="last_name" label="Last Name" :required="true"/>
                        <x-input name="email" label="Email" :required="true"/>
                        <x-input name="password" type="password" label="Password" :required="true"/>
                        <x-input name="password_confirmation"  type="password" label="Confirm Password" :required="true"/>
                        <x-input name="date_of_birth" type="date"  label="Date Of Birth" :required="true"/>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
                            <div class="col-md-6">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="m">
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="f">
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="other" value="o">
                                    <label class="form-check-label" for="other">Other</label>
                                </div>
                            </div>
                        </div>

                        <x-input name="annual_income" label="Annual Income" :required="true"/>
                        <x-select name="occupation" label="Occupation" :options="[['value'=>'private_job','label'=>'Private job'],['value'=>'government_job','label'=>'Government Job'],['value'=>'business','label'=>'Business']]" :required="true"/>

                        <x-select name="family_type" label="Family Type" :options="[['value'=>'join_family','label'=>'Joint Family'],['value'=>'nuclear_family','label'=>'Nuclear Family']]" :required="true"/>
                        
                        <x-select name="manglik" label="Manglik" :options="[['value'=>'yes','label'=>'Yes'],['value'=>'no','label'=>'No']]" :required="true"/>
                       
                        <hr class="solide"/>
                        <div class="form-group row">
                            <label for="price_range" class="col-md-4 col-form-label text-md-right">{{ __('Price Range') }}</label>
                            <div class="col-md-6">
                                <p>
                                    <input type="text" id="amount" name="expected_income" readonly style="border:0; color:#0f0901; font-weight:bold;">
                                </p>                           
                                <div id="slider-range"></div>
                            </div>
                            @error('expected_income')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <x-select name="preference_occupation" label="Preference Occupation" :options="[['value'=>'private_job','label'=>'Private job'],['value'=>'government_job','label'=>'Government Job'],['value'=>'business','label'=>'Business']]" :required="true"/>

                        <x-select name="preference_family_type" label="Preference Family Type" :options="[['value'=>'join_family','label'=>'Joint Family'],['value'=>'nuclear_family','label'=>'Nuclear Family']]" :required="true"/>

                        <x-select name="preference_manglik" label="Preference Manglik" :options="[['value'=>'yes','label'=>'Yes'],['value'=>'no','label'=>'No'],['value'=>'both','label'=>'Both']]" :required="true"/>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $( function() {
      $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 5000000,
        values: [ 75, 300 ],
        slide: function( event, ui ) {
          $( "#amount" ).val( + ui.values[ 0 ] + "-" + ui.values[ 1 ] );
        }
      });
      $( "#amount" ).val( $( "#slider-range" ).slider( "values", 0 ) +
        " - " + $( "#slider-range" ).slider( "values", 1 ) );
    } );
</script>
@endsection
