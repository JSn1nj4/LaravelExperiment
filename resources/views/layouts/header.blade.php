<header class="mb-4">
    <nav class="flex items-center justify-between flex-wrap bg-black">

        @if (count($menuItems = ['home','projects','updates']) > 0)

            <div class="flex items-center flex-no-shrink text-white">
                <a href="/" class="text-white no-underline px-5 py-5">
                    <span class="text-3xl tracking-tight py-px2">
                        My Project
                    </span>
                </a>
            </div>

            <div class="block lg:hidden mr-5">
                <button class="flex items-center px-3 py-2 border rounded text-sea-green border-sea-green hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>

            <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto text-center lg:text-right text-xl">
                <div class="text-md lg:flex-grow">

                    @foreach ($menuItems as $key => $value)
                        <a href="{{ route($value) }}" class="block lg:inline-block px-4 py-6 text-sea-green hover:text-white trans-color no-underline uppercase">
                            {{ $value }}
                        </a>
                    @endforeach

                </div>
            </div>

        @endif

    </nav>
</header>
