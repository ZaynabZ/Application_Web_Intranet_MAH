@extends('layouts.app')

@section('style')

<link rel="stylesheet" href="{{ asset('assets/css/splide.min.css') }}">
<style>

.splide {
  width: 100%;
  height:75%;
}

.splide__slide img {
  width: 100%;
  height:100%;
}
</style>


@endsection

@section('content')


<div id="image-slider" class="splide">
  <div class="splide__track">
		<ul class="splide__list">
			<li class="splide__slide">
				<img src="{{ asset('assets/images/myopla/m1.jpg') }}" alt="">
			</li>
			<li class="splide__slide">
				<img src="{{ asset('assets/images/myopla/m2.jpg') }}" alt="">
			</li>
            <li class="splide__slide">
				<img src="{{ asset('assets/images/myopla/m3.jpg') }}" alt="">
			</li>
            <li class="splide__slide">
				<img src="{{ asset('assets/images/myopla/m4.jpg') }}" alt="">
			</li>
		</ul>
  </div>
</div>

    
@endsection


@section('javascript')

<script src="{{ asset('assets/js/splide.min.js') }}"></script>
<script >


var splide = new Splide( '.splide', {
    rewind:true,
  perPage:3,
  speed:5000,
  autoplay    : true,
  rewind      : true,
  pauseOnHover: false,
  pauseOnFocus: false,
} );

splide.mount();
</script>


@endsection