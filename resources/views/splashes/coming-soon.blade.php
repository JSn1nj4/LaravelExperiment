@extends('layouts.splash')

@section('content')
    <div class="max-w-lg mx-auto">
        
        <div style="display: inline-block; height: 100%; verbatim">

            <h1 class="mb-4 text-center text-5xl font-normal">
                ElliotDerhay(<span class="text-sea-green text-4xl leading-none py-3" style="vertical-align: middle;">/{{ Request::path() }}</span>)
            </h1>

            <p class="mb-4 text-center text-2xl">
                This site is still in the works. Thanks for your interest! We'll have something ready soon.
            </p>

        </div>
    </div>
@endsection
