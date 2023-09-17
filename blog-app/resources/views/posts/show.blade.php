@extends('layouts.app')

@section('content')
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <!-- bootstrap.min css -->
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <!-- Icon Font Css -->
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/themify/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/magnific-popup/dist/magnific-popup.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/slick-carousel/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('import/assets/plugins/slick-carousel/slick/slick-theme.css') }}">
  
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('import/assets/css/style.css') }}">
  
  </head>
  
  <body>

<section class="section blog-wrap bg-gray">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
	<div class="col-lg-12">
		<div class="single-blog-item">
			<div class="">
				<img src="{{ asset('images/'.$post->image) }}" width="100%" height="100%"alt="" class="img-fluid rounded">
			</div>
			<div class="blog-item-content bg-white p-5">
				<div class="blog-item-meta bg-gray py-1 px-2">
					<span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i>5 Comments</span>
					<span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i>{{ $post->created_at->translatedFormat('j F Y') }}</span>
				</div> 

				<h2 class="mt-3 mb-4"><a href="blog-single.html">{{ $post->title }}</a></h2>

				<p class="mb-4">{{ $post->content }}</p>
				

				<div class="tag-option mt-5 clearfix">       

				        <h5 class="float-right list-inline mb-0 mt-4">{{ $userName }}</h5>
				    
			    </div>
			</div>
		</div>
	</div>

    

	<div class="col-lg-12 mb-5">
		<div class="comment-area card border-0 p-5">
			<h4 class="mb-4"> {{ $numComments }} Comments</h4>
			<ul class="comment-tree list-unstyled">
                @foreach ( $comments as $comment )
				<li class="mb-5">
					<div class="comment-area-box">
						<img alt="" src="images/blog/test1.jpg" class="img-fluid float-left mr-3 mt-2">

						<h5 class="mb-1">{{ $comment->users->userName }}</h5>

						<div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
							<span class="date-comm">{{ $comment->created_at }}</span>
						</div>

						<div class="comment-content mt-3">
							<p>{{ $comment->content }}</p>
						</div>
					</div>
				</li>
                @endforeach
			</ul>
		</div>
	</div>
    
	<div class="col-lg-12">
		<form action="{{ route('posts.comment', ['post' => $post]) }}" class="contact-form bg-white rounded p-5" id="comment-form" method="POST">
			@csrf
            <h4 class="mb-4">Écrire un commentaire</h4>
			<textarea class="form-control mb-3" name="content" id="content" cols="30" rows="5" placeholder="Commentaire"></textarea>

			<input class="btn btn-main btn-round-full" type="submit" name="submit-contact" id="submit_contact" value="Envoyer">
		</form>
	</div>
</div>
            </div>
            {{-- <div class="col-lg-4">
                <div class="sidebar-wrap">

	<div class="sidebar-widget card border-0 mb-3">
		<img src="images/blog/blog-author.jpg" alt="" class="img-fluid">
		<div class="card-body p-4 text-center">
			<h5 class="mb-0 mt-4">{{ $userName }}</h5>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Incidunt, dolore.</p>

			<ul class="list-inline author-socials">
				<li class="list-inline-item mr-3">
					<a href="#"><i class="fab fa-facebook-f text-muted"></i></a>
				</li>
				<li class="list-inline-item mr-3">
					<a href="#"><i class="fab fa-twitter text-muted"></i></a>
				</li>
				<li class="list-inline-item mr-3">
					<a href="#"><i class="fab fa-linkedin-in text-muted"></i></a>
				</li>
				<li class="list-inline-item mr-3">
					<a href="#"><i class="fab fa-pinterest text-muted"></i></a>
				</li>
				<li class="list-inline-item mr-3">
					<a href="#"><i class="fab fa-behance text-muted"></i></a>
				</li>
			</ul>
		</div>
	</div>

</div>
            </div> --}}   
        </div>
    </div>
</section>
@endsection

<!-- Main jQuery -->
<script src="{{ asset('import/assets/plugins/jquery/jquery.js') }}"></script>
<script src="{{ asset('import/assets/js/contact.js') }}"></script>
<!-- Bootstrap 4.3.1 -->
<script src="{{ asset('import/assets/plugins/bootstrap/js/popper.js') }}"></script>
<script src="{{ asset('import/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
<!--  Magnific Popup-->
<script src="{{ asset('import/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
<!-- Slick Slider -->
<script src="{{ asset('import/assets/plugins/slick-carousel/slick/slick.min.js') }}"></script>
<!-- Counterup -->
<script src="{{ asset('import/assets/plugins/counterup/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('import/assets/plugins/counterup/jquery.counterup.min.js') }}"></script>

<!-- Google Map -->
<script src="{{ asset('import/assets/plugins/google-map/map.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkeLMlsiwzp6b3Gnaxd86lvakimwGA6UA&callback=initMap"></script>    

<script src="{{ asset('import/assets/js/script.js') }}"></script>
  </body>