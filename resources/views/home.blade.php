@extends('layouts.page')

@section('content')
    <div class="block md:flex">

        <div class="block lg:flex lg:w-1/6 pb-8">
            <div class="px-2">

                <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow md:hidden">

            </div>
        </div>

        <div class="md:w-1/2 lg:w-1/3 pb-6">
            <div class="px-2">

                <h1 class="content-title">
                    Test title
                </h1>

                <p class="mb-4">
                    Lorem ipsum dolor sit amet, adhuc cetero aliquid ei sed, usu possim option tincidunt no. Quo an ludus alterum deserunt. Meis paulo pro ex, vitae eligendi cu sit. Alia justo saperet mel cu. Ludus oblique deleniti te vim, iudico nostro incorrupte est in. Ullum quaestio et mel.
                </p>

                <h4 class="content-title">
                    Test small title
                </h4>

                <p class="mb-4">
                    No duo esse signiferumque, at agam iriure cum. Ad ius eirmod fabulas. Ne qui option singulis. Vis porro semper recusabo ei. Utroque graecis corrumpit eu cum, pri quis labore adipiscing no.
                </p>

            </div>
        </div>

        <div class="hidden md:flex md:w-1/2 lg:w-1/3 pb-8">
            <div class="px-2">

                <img src="https://s3.amazonaws.com/elliotderhay-com/Elliot.Color2-hd-v2-square.jpg" title="Elliot Derhay" alt="Photo of Elliot Derhay" class="border-white border-4 rounded-full box-glow">

            </div>
        </div>

    </div>
@endsection
