@extends($layout)

@section('content')
    <x-global::pageheader :icon="'fa fa-puzzle-piece'">
        <h1>{{ __('example.settings.page_header') }}</h1>
    </x-global::pageheader>

    <div class="maincontent leantime-plugin-examle">
        <div class="maincontentinner">
            <label>{{ __('example.settings.random_text.label') }}</label>
            <pre>{{ $randomText }}</pre>
        </div>
    </div>
@endsection
