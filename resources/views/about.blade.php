@extends('layouts.page')

@section('content')
    <div class="container mx-auto px-4 pt-6">
        <section class="block md:flex">

            <div class="block lg:flex lg:w-1/6 pb-8">
                <div class="px-2">

                    <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow md:hidden">

                </div>
            </div>

            <div class="md:w-1/2 lg:w-1/3 pb-6">
                <div class="px-2">

                    <h1 class="content-title pt-6 mt-4 md:pt-0 md:mt-0 text-center md:text-left">
                        About Me
                    </h1>

                    <p class="mb-4">
                        I am a web developer primarily with experience in building WordPress websites. I use CSS, PHP and JS when working on these projects.
                    </p>

                    <p class="mb-4">
                        My PHP experience is mostly a mix of vanilla PHP and WordPress's framework. Aside from that, I've taken up learning Laravel and have made it the foundation for my personal web project.
                    </p>

                    <p class="mb-4">
                        My JavaScript experience is mostly a mix of vanilla JS and jQuery. Next in line is Meteor JS with Blaze (Meteor's default front-end framework). I used Meteor for several months worth of work on another project, and it was quite fun to work with. After Meteor, I began learning React and Vue, though I'm leaning more towards Vue at the moment.
                    </p>

                </div>
            </div>

            <div class="hidden md:flex md:w-1/2 lg:w-1/3 pb-8">
                <div class="px-2">

                    <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow">

                </div>
            </div>

        </section>

        <section class="block md:flex">
            <div class="w-full pb-6">
                <h2 class="content-title pt-6 mt-4 md:pt-0 md:mt-0 text-center">Latest Tweet</h2>
                <div id="newest-tweet"></div>
            </div>
        </section>
    </div>
@endsection

@section('footer-extras')
    <script src="{{ mix('/js/NewestTweetWidget.js') }}" charset="utf-8"></script>
@endsection
