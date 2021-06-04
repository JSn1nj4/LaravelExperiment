<header id="header" class="flex-initial">
	<div class="{{ $classes ??= '' }} m-auto">
		<nav class="flex items-center justify-between flex-wrap bg-gray-900 relative">

			@yield('header-content')

		</nav>
	</div>
</header>
