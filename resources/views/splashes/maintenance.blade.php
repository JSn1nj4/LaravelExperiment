@extends('layouts.splash', ['bodyClasses' => 'construction'])

@section('content')
    <div class="max-w-lg mx-auto">
        <div style="display: flex; flex-direction: column; justify-content: center; max-height: 100vh; height: 500px;">

            <h1 class="mb-4 text-center text-5xl font-normal text-glow-white">
                Maintenance Mode
            </h1>

            <p class="mb-4 text-center text-2xl">
                This site is under repair. Please check back later.
            </p>

            <p class="mb-4">
                @include('partials.socials', [
                    'classes' => 'text-3xl text-center',
                    'linkClasses' => 'text-white hover:text-yellow'
                ])
            </p>

        </div>
    </div>
@endsection
