@extends('layouts.page')

@section('content')
    <div class="container mx-auto px-4 pt-6">
        <section class="block">

            <div class="w-full max-w-md mx-auto pb-6 text-center">
                <div class="px-2">
                    <h1 class="content-title pt-6 mt-4 md:pt-0 md:mt-0">
                        Projects
                    </h1>
                    <p class="mb-4">
                        Below are projects that I've either built myself or contributed directly to. Some will also have links to demos.
                    </p>
                </div>
            </div>

        </section>

        <section class="block w-full md:flex">

            <div class="w-full pb-8 px-2 pt-6 mt-4 md:pt-0 md:mt-0">
                <section id="main-projects-list-wrapper"></section>
            </div>

        </section>
    </div>
@endsection

@section('footer-extras')
    <script src="{{ mix('/js/MainProjectsList.js') }}" charset="utf-8"></script>
@endsection
