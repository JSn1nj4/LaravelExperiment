@extends('layouts.page')

@section('content')

    <section class="banner-section home-banner -mt-4">
        <div class="container mx-auto px-4 py-6">
            <div class="block md:flex banner-content-wrapper">


                <div class="lg:w-3/5 text-center banner-content">
                    <h1 class="banner-title pb-4">
                        ElliotDerhay.com
                    </h1>
                    <p class="banner-paragraph leading-tight">
                        A small website for a personal profile and web development portfolio
                    </p>
                </div>

                <div class="lg:w-2/5">

                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container mx-auto px-4 pt-6">
            <div class="block md:flex">

                <div class="hidden lg:flex lg:w-1/6">

                </div>

                <div class="md:w-1/2 lg:w-1/3 pb-6 text-center">
                    <div class="px-2">

                        <p class="my-4">
                            <a href="https://laravel.com/">
                                <img src="https://s3.amazonaws.com/elliotderhay-com/vectors/Laravel-l-slant-no-padding.svg" title="Laravel - The PHP Framework For Web Artisans" alt="Laravel logo" height="100">
                            </a>
                        </p>

                        <p class="mb-4 text-xl">
                            Backend built on Laravel PHP
                        </p>

                    </div>
                </div>

                <div class="md:w-1/2 lg:w-1/3 pb-6 text-center">
                    <div class="px-2">

                        <p class="my-4">
                            <a href="https://tailwindcss.com/">
                                <img src="https://s3.amazonaws.com/elliotderhay-com/vectors/tailwindcss-no-shadow.svg" title="Tailwind CSS - A Utility-First CSS Framework for Rapid UI Development" alt="Tailwind CSS logo" height="100">
                            </a>
                        </p>

                        <p class="mb-4 text-xl">
                            UI designed with Tailwind CSS
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
