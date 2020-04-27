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

  <section class="pt-4">
    <div class="container mx-auto px-4 pt-6">
      <section class="block md:flex">

        <div class="block lg:flex lg:w-1/6">
          <div class="px-2">

            <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow md:hidden">

          </div>
        </div>

        <div class="md:w-1/2 lg:w-1/3">
          <div class="px-2">

            <h1 class="content-title text-4xl pt-6 mt-4 md:mt-0 md:pt-0 text-center md:text-left">
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

        <div class="hidden md:flex md:w-1/2 lg:w-1/3">
          <div class="px-2">

            <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow">

          </div>
        </div>

      </section>
    </div>
  </section>

  <section>
    <div class="container mx-auto px-4">
      <div class="block md:flex">

        <div class="block md:w-1/2">
          <h2 class="content-title text-2xl pt-6 mt-4 text-center">Recent Tweets</h2>
          <section id="twitter_timeline-home">
            {{-- SSR Twitter timeline --}}
            @include('partials.twitter-timeline', ['count' => 2])
          </section>
        </div>

        <div class="block md:w-1/2">
          <h2 class="content-title text-2xl pt-6 mt-4 text-center">GitHub Activity</h2>
          <section id="github_activity_feed-home">
            {{-- SSR GitHub activity feed --}}
            @include('partials.github-activity-feed', ['count' => 3])
          </section>
        </div>

      </div>
    </div>
  </section>

  @include('partials.made-with')

@endsection

@section('footer-extras')
  <script src="{{ mix('/js/home.js') }}" charset="utf-8"></script>
@endsection
