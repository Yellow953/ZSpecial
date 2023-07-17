@extends('admin.app')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header border-rounded mt-4"
        style="background-image: url({{asset('assets/images/bg.png')}}); height: 300px; width: 100%; background-repeat: no-repeat; background-size: 100%; background-position: center;">
    </div>

    <div class="card card-body m-3 mx-md-4 mt-n6">
        <h1 class="text-center">ZSpecial</h1>
        <div class="row my-3">
            <div class="col-md-3">
                <img src="{{asset('/assets/images/logo.png')}}" alt="" class="rounded img-responsive w-100 h-auto">
            </div>
            <div class="col-md-9">
                <p class="my-3">
                    Welcome to the special shop, where we curate a unique collection of items from around the world! Our
                    mission is to bring you a variety of special products that you won't find anywhere else. From
                    kitchen to bar accessories, special gadgets and tools to solve daily problems with a limited edition
                    collectibles, we ensure that every item in our shop is special and carefully selected for its
                    distinctiveness. Whether you're a collector, an adventurer, or simply someone who appreciates the
                    extraordinary, we offer a one-of-a-kind shopping experience just for you. So come on in and let us
                    surprise you with the wonders of the world!
                </p>
            </div>
        </div>
    </div>
</div>

@endsection