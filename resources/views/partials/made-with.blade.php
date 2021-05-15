<section>
	<div class="container mx-auto px-4">
		<div class="block text-center">
			<h2 class="content-title text-2xl pt-6 mt-4 text-center">Made With</h2>

			@foreach ([
				[
					'link' => 'https://laravel.com/',
					'icon_src' => 'https://s3.amazonaws.com/elliotderhay-com/vectors/Laravel-l-slant-no-padding.svg',
					'icon_title' => 'Laravel - The PHP Framework For Web Artisans',
					'icon_alt' => 'Laravel logo',
					'icon_width' => '123',
					'icon_height' => '85',
					'name' => 'Laravel',
				],
				[
					'link' => 'https://tailwindcss.com/',
					'icon_src' => 'https://s3.amazonaws.com/elliotderhay-com/vectors/tailwindcss-no-shadow.svg',
					'icon_title' => 'Tailwind CSS - A Utility-First CSS Framework for Rapidly Building Custom Designs',
					'icon_alt' => 'Tailwind CSS logo',
					'icon_width' => '85',
					'icon_height' => '85',
					'name' => 'Tailwind CSS',
				],
				[
					'link' => 'https://vuejs.org/',
					'icon_src' => 'https://s3.amazonaws.com/elliotderhay-com/vectors/vue-logo.svg',
					'icon_title' => 'Vue.js - The Progressive JavaScript Framework',
					'icon_alt' => 'Vue.js logo',
					'icon_width' => '98',
					'icon_height' => '85',
					'name' => 'Vue.js',
				],
			] as $item)
				<div class="text-center sm:inline-block">
					<div class="px-2">

						<p class="my-6">
							<a href="{{ $item['link'] }}" target="_blank">
								<img class="inline" src="{{ $item['icon_src'] }}" title="{{ $item['icon_title'] }}" alt="{{ $item['icon_alt'] }}" width="{{ $item['icon_width'] }}" height="{{ $item['icon_height'] }}">
							</a>
						</p>

						<p class="mb-4 text-xl">
							{{ $item['name'] }}
						</p>

					</div>
				</div>
			@endforeach

		</div>
	</div>
</section>
