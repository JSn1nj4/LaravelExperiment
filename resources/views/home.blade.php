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
                        A personal profile and future web development portfolio
                    </p>
                </div>

                <div class="lg:w-2/5">

                </div>

            </div>
        </div>
    </section>

    {{-- <section>
        <div class="container mx-auto px-4 pt-6">
            <div class="block md:flex">

                <div class="hidden lg:flex lg:w-1/6">

                </div>

                <div class="lg:w-2/3 text-justify">
                    <div class="px-2">

                        <p class="my-4">
                            Lorem ipsum dolor sit amet, pri in dolor verear maiestatis, per omnis indoctum vituperata ad. Iusto prompta cu per, vero vocent vocibus pro ea. Ex dicat moderatius vis, no ius ludus noluisse, molestie consulatu cu eam. Veri tempor sea in, cu vis possim praesent cotidieque. Ex quas honestatis per. Per fastidii qualisque ne. Vis no diam aeterno definiebas, congue option suscipiantur cu pro.
                        </p>
                        <p class="my-4">
                            Nam dolor lucilius eu, ut per dictas sapientem vulputate, in feugiat evertitur concludaturque pri. Facilis ocurreret nam at. Te duo suscipit intellegat. Saperet minimum vulputate eos cu, error appareat patrioque et mel. Liber nobis honestatis no usu, nam sint prompta ei, ut sed rebum civibus voluptaria. Ei vide aliquando theophrastus eam, accumsan efficiendi nam at. Et sed vivendo persequeris, cu enim nulla oportere per, ad sea praesent dignissim dissentias.
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </section> --}}

    <section>
        <div class="container mx-auto px-4 pt-6">
            <div class="block md:flex">

                {{-- <div class="hidden lg:flex lg:w-1/6">

                </div> --}}

                <div class="md:w-1/3 pb-6 text-center">
                    <div class="px-2">

                        <p class="my-4">
                            <a href="https://laravel.com/" target="_blank">
                                <img src="https://s3.amazonaws.com/elliotderhay-com/vectors/Laravel-l-slant-no-padding.svg" title="Laravel - The PHP Framework For Web Artisans" alt="Laravel logo" width="144" height="100">
                            </a>
                        </p>

                        <p class="mb-4 text-xl">
                            Built on Laravel
                        </p>

                    </div>
                </div>

                <div class="md:w-1/3 pb-6 text-center">
                    <div class="px-2">

                        <p class="my-4">
                            <a href="https://tailwindcss.com/" target="_blank">
                                <img src="https://s3.amazonaws.com/elliotderhay-com/vectors/tailwindcss-no-shadow.svg" title="Tailwind CSS - A Utility-First CSS Framework for Rapid UI Development" alt="Tailwind CSS logo" width="100" height="100">
                            </a>
                        </p>

                        <p class="mb-4 text-xl">
                            Designed with Tailwind CSS
                        </p>

                    </div>
                </div>

                <div class="md:w-1/3 pb-6 text-center">
                    <div class="px-2">

                        <p class="my-4">
                            <a href="https://vuejs.org/" target="_blank">
                                <img src="https://s3.amazonaws.com/elliotderhay-com/vectors/vue-logo.svg" title="Tailwind CSS - A Utility-First CSS Framework for Rapid UI Development" alt="Tailwind CSS logo" width="116" height="100">
                            </a>
                        </p>

                        <p class="mb-4 text-xl">
                            Sprinkled with Vue.js
                        </p>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container mx-auto px-4 pt-6">
            <div class="block md:flex">

                <div class="block md:w-1/2 pb-8">
                    <h2 class="content-title pt-6 mt-4 md:pt-0 md:mt-0 text-center">Recent Tweets</h2>
                    <section id="twitter_timeline-home" class="block md:flex"></section>
                </div>

                <div class="block md:w-1/2 pb-8">
                    <h2 class="content-title pt-6 mt-4 md:pt-0 md:mt-0 text-center">GitHub Activity</h2>
                    <section id="github_activity_feed-home" class="block md:flex"></section>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('footer-extras')
    <script src="{{ mix('/js/home.js') }}" charset="utf-8"></script>
@endsection
