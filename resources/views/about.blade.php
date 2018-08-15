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
                        I am a web developer primarily with experience in building WordPress websites. I have learned HTML and CSS along with JavaScript and PHP.
                    </p>

                    <p class="mb-4">
                        Regarding JavaScript frameworks, I have primarily used jQuery, though I did dive into MeteorJS for a while for a personal project -- and it was quite fun to learn and use. I have also learned a bit of React and Vue, though I'm definitely leaning towards Vue.
                    </p>

                    <p class="mb-4">
                        For PHP, I have primarily not used a framework (outside of WordPress), though I have been learning Laravel recently; in fact, this website is built using Laravel, and will continue to make use of it for different learning experiments.
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
    <script src="/js/twitter.js" charset="utf-8"></script>
@endsection
