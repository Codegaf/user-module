<form id="create-user" method="post" action="{{ $action }}" novalidate>
    @csrf
    {{ isset($user) ? method_field('put') : '' }}
    <div class="row">
        <x-inputs.email col="col-12 col-lg-6" label="{{ __('forms.email') }}" name="email" required="required" id="email" value="{{ old('email', isset($user) ? $user->email : '') }}"/>
        <x-inputs.text col="col-12 col-lg-6" label="{{ __('forms.name') }}" name="name" id="name" value="{{ old('name', isset($user) ? $user->name : '') }}"/>
        <x-inputs.password col="col-12 col-lg-6" label="{{ __('forms.password') }}" name="password" id="password"/>
        <x-inputs.password col="col-12 col-lg-6" label="{{ __('forms.password-confirmation') }}" name="password_confirmation" id="password_confirmation"/>
    </div>
    <div class="row">
        <x-buttons.button col="col-12" label="{{ __('forms.save') }}" type="submit" color="primary" class="float-right"/>
    </div>
</form>
