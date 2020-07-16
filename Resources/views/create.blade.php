@extends('layouts.contentLayoutMaster')

@section('title', __('pages.create-user'))

@section('vendor-style')

@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/plugins/forms/validation/form-validation.css')) }}">
@endsection

@section('content')
    @include('includes.notifications')
    <section class="users-edit">
        <div class="card">
            <div class="card-content">
                <div class="card-body">
                    <form id="create-user" method="post" action="{{ route('user.store') }}" novalidate>
                        @csrf
                        <div class="row">
                            <x-inputs.email col="col-12 col-lg-6" label="{{ __('forms.email') }}" name="email" required="required" id="email" value="{{ old('email') }}"/>
                            <x-inputs.text col="col-12 col-lg-6" label="{{ __('forms.name') }}" name="name" id="name" value="{{ old('name') }}"/>
                            <x-inputs.password col="col-12 col-lg-6" label="{{ __('forms.password') }}" name="password" id="password"/>
                            <x-inputs.password col="col-12 col-lg-6" label="{{ __('forms.password-confirmation') }}" name="password_confirmation" id="password_confirmation"/>
                        </div>
                        <div class="row">
                            <x-buttons.button col="col-12" label="{{ __('forms.save') }}" type="submit" color="primary" class="float-right"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('vendor-script')
    <!-- vendor files -->

    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    @if (app()->getLocale() !== 'en')
        <script src="{{ asset(mix('js/scripts/forms/validation/messages_'.app()->getLocale().'.js')) }}"></script>
    @endif

    <script src="{{ asset(mix('js/scripts/forms/validation/validator-config-methods.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/validation/validator-render-errors.js')) }}"></script>
@endsection
@section('page-script')
    <!-- Page js files -->
    <script>

        let validation = JSON.parse('{!! json_encode(config('user.front.validation.rules')) !!}');
        let messages = JSON.parse('{!! json_encode(config('user.front.validation.messages')) !!}')

        messages.password.pwcheck = '{{ __('validation.pwcheck', ['numcharacter' => 8]) }}'

        $('#create-user').validate({
            lang: '{{app()->getLocale()}}',
            rules: validation,
            messages: messages
        });

    </script>
@endsection


