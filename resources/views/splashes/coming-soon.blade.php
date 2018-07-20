@extends('layouts.splash', ['bodyClasses' => 'backlight'])

@section('content')
    <div class="container mx-auto px-4 pt-6">
        <div class="max-w-lg mx-auto">
            <div style="display: flex; flex-direction: column; justify-content: center; max-height: 100vh; height: 500px;">

                <h1 class="mb-4 text-center text-5xl font-normal text-glow-white">
                    Coming Soon
                </h1>

                <p class="mb-4 text-center text-2xl">
                    This site is in the works.
                </p>

                <p class="mb-4">
                    @include('partials.socials', [
                        'classes' => 'text-3xl text-center',
                        'linkClasses' => 'text-white hover:text-sea-green'
                    ])
                </p>

            </div>
        </div>
    </div>
@endsection
