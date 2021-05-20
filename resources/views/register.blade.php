</div>

<div class="input-group mb-3">
    <input type="text" name="username"
    	class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" r
    	equired placeholder="{{ trans('global.login_username') }}"
    	value="{{ old('username', null) }}">
    @if($errors->has('username'))
        <div class="invalid-feedback">
            {{ $errors->first('username') }}
        </div>
    @endif
</div>

<div class="input-group mb-3">
