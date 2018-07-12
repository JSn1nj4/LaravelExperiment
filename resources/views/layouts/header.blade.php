@php
    $headerClasses          = 'flex items-center justify-between flex-wrap';
    $logoWrapperClasses     = 'flex items-center flex-no-shrink';
    $logoClasses            = '';
    $logoTextClasses        = 'text-xl sm:';
    $fullHeader             = true;

    if(count($menuItems) < 1) {
        $headerClasses      = 'text-center';
        $logoWrapperClasses = '';
        $logoClasses        = 'inline-block';
        $logoTextClasses    = '';
        $fullHeader         = false;
    }
@endphp

<header class="mb-4">
    <nav class="{{ $headerClasses }} bg-black">

        <div class="{{ $logoWrapperClasses }} text-white">
            <a href="/" class="{{ $logoClasses }} text-white no-underline p-2">
                <img src="https://www.gravatar.com/avatar/8754c5b823c1f0b00e989447a0345a33" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay" class="border-solid border-2 border-white rounded-full align-middle">
                <span class="{{ $logoTextClasses }}text-3xl tracking-tight py-px2 pl-2 align-middle">
                    Elliot Derhay
                </span>
            </a>
        </div>

        @if ($fullHeader)

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
