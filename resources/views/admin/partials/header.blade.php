@extends('layouts.header')

@section('header-content')
	<div class="flex items-center flex-shrink-0 text-white">
		<a href="{{ route('admin.dashboard') }}" class="text-white p-2">
			<img src="https://www.gravatar.com/avatar/8754c5b823c1f0b00e989447a0345a33" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay" class="inline border-solid border-2 border-white rounded-full align-middle">
			<span class="text-xl sm:text-3xl tracking-tighter py-px2 pl-2 align-middle">
				Dashboard
			</span>
		</a>
	</div>

	<div class="w-full block absolute lg:relative flex-grow lg:flex lg:items-center lg:w-auto text-center lg:text-right text-xl mobile-menu">
		<div class="text-md lg:flex-grow">

			@foreach ($menuItems as $key => $item)
				<a href="{{ route($item->name, [], false) }}"
				class="block lg:inline-block px-4 py-6 uppercase">
					@if(isset($item->icon))
						<i class="{{$item->icon}}"></i>
					@endif
					{{ $item->label }}
				</a>
			@endforeach

		</div>
	</div>
@endsection
