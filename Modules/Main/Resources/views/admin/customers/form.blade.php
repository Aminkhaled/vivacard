
<div class="card-body">
	@include('main::layouts.includes.messages')
  <div class="row">
    <div class="col-lg-9">

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="customers_name">{{ __('main::lang.customers_name') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('customers_name') ? 'is-invalid' : '' }}" id="customers_name" type="text" name="customers_name" placeholder="{{ __('main::lang.customers_name') }}"
           value="{{ old('customers_name', isset($customer) ? $customer->customers_name : '') }}">
          @if ($errors->first('customers_name'))
            <div class="invalid-feedback">{{ $errors->first('customers_name') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="customers_phone">{{ __('main::lang.customers_phone') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('customers_phone') ? 'is-invalid' : '' }}" id="customers_phone" type="text" name="customers_phone" placeholder="{{ __('main::lang.customers_phone') }}"
           value="{{ old('customers_phone', isset($customer) ? $customer->customers_phone : '') }}">
          @if ($errors->first('customers_phone'))
            <div class="invalid-feedback">{{ $errors->first('customers_phone') }}</div>
          @endif
        </div>
      </div>

      {{-- <div class="form-group row  ">
        <label class="col-md-3 col-form-label" for="customers_birthdate">{{ __('main::lang.customers_birthdate') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('customers_birthdate') ? 'is-invalid' : '' }}" id="customers_birthdate" type="date" name="customers_birthdate" placeholder="{{ __('main::lang.customers_birthdate') }}"
           value="{{ old('customers_birthdate', isset($customer) ? $customer->customers_birthdate : '') }}">
          @if ($errors->first('customers_birthdate'))
            <div class="invalid-feedback">{{ $errors->first('customers_birthdate') }}</div>
          @endif
        </div>
      </div> --}}

      {{-- <div class="form-group row">
        <label class="col-md-3 col-form-label">{{ __('main::lang.gender') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9 col-form-label">
          @php
            $gender = old('customers_gender', isset($customer) ? $customer->customers_gender : 'male');
          @endphp
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="male" type="radio" value="1" name="customers_gender" {{ $gender == 'male'? 'checked' : '' }}>
            <label class="form-check-label" for="male">{{ __('main::lang.male') }}</label>
          </div>
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="female" type="radio" value="female" name="customers_gender" {{ $gender == 'female' ? 'checked' : '' }}>
            <label class="form-check-label" for="female">{{ __('main::lang.female') }}</label>
          </div>
          @if ($errors->first('customers_gender'))
            <div class="invalid-feedback">{{ $errors->first('customers_gender') }}</div>
          @endif
        </div>
      </div> --}}

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="customers_email">{{ __('main::lang.email') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('customers_email') ? 'is-invalid' : '' }}" id="customers_email" type="email" name="customers_email" placeholder="{{ __('main::lang.email') }}"
           value="{{ old('customers_email', isset($customer) ? $customer->customers_email : '') }}">
          @if ($errors->first('customers_email'))
            <div class="invalid-feedback">{{ $errors->first('customers_email') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="password">{{ __('main::lang.password') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('password') ? 'is-invalid' : '' }}" id="password" type="password" name="password" placeholder="{{ __('main::lang.password') }}">
          @if ($errors->first('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
          @endif
        </div>
      </div>

      <div class="form-group row">
        <label class="col-md-3 col-form-label" for="password_confirmation">{{ __('main::lang.confirmPassword') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9">
          <input class="form-control {{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" id="password_confirmation" type="password"
           name="password_confirmation" placeholder="{{ __('main::lang.confirmPassword') }}">
          @if ($errors->first('password_confirmation'))
            <div class="invalid-feedback">{{ $errors->first('password_confirmation') }}</div>
          @endif
        </div>
      </div>


      <div class="form-group row">
        <label class="col-md-3 col-form-label">{{ __('main::lang.status') }}<span class="text-danger"> *</span></label>
        <div class="col-md-9 col-form-label">
          @php
            $status = old('customers_status', isset($customer) ? $customer->customers_status : 1);
          @endphp
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="active" type="radio" value="1" name="customers_status" {{ $status == 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="active">{{ __('main::lang.active') }}</label>
          </div>
          <div class="form-check form-check-inline mr-1">
            <input class="form-check-input" id="stopped" type="radio" value="0" name="customers_status" {{ $status == 0 ? 'checked' : '' }}>
            <label class="form-check-label" for="stopped">{{ __('main::lang.stopped') }}</label>
          </div>
          @if ($errors->first('customers_status'))
            <div class="invalid-feedback">{{ $errors->first('customers_status') }}</div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
