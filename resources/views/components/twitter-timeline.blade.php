<div class="max-w-sm m-auto mb-4" style="min-height: {{ $loaderSize }};">
	@component('partials.timeline', ['showLine' => ($count >= 2)])
    @each('partials.twitter-card', $tweets, 'tweet')
  @endcomponent
</div>
