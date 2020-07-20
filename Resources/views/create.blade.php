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
                    @include('user::form-create-edit', ['action' => route('user.store')])
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

        let validation = JSON.parse('{!! json_encode(config('user.front.validation.create.rules')) !!}');
        let messages = JSON.parse('{!! json_encode(config('user.front.validation.create.messages')) !!}')

        messages.password.pwcheck = '{{ __('validation.pwcheck', ['numcharacter' => 8]) }}'

        $('#create-user').validate({
            lang: '{{app()->getLocale()}}',
            rules: validation,
            messages: messages
        });

    </script>
@endsection


