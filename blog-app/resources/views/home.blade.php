@extends('layouts.app')

@section('content')
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
    <title>Blogging</title>
  
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
                @foreach ($posts as $post)
                <div class="col-lg-6 col-md-6 mb-5">
                    <div class="blog-item">
                        <img src="{{ asset('images/'.$post->image) }}" width="100%" height="100%" alt="" class="img-fluid rounded">
            
                        <div class="blog-item-content bg-white p-5">
                            <div class="blog-item-meta bg-gray py-1 px-2">
                                <!--<span class="text-muted text-capitalize mr-3"><i class="ti-pencil-alt mr-2"></i>Creativity</span>-->
                                <span class="text-muted text-capitalize mr-3"><i class="ti-comment mr-2"></i>{{-- {{ $post->comments->where('postId', $post->id)->count() }} --}} Comments</span>
                                <span class="text-black text-capitalize mr-3"><i class="ti-time mr-1"></i> {{ $post->created_at->translatedFormat('j F Y') }}</span>
                            </div> 
            
                            <h4 class="mt-3 mb-3 custom-height"><a href="{{ route('posts.show',$post->id) }}">{{ $post->title }}</a></h4>
                            <p class="mb-4">{{ Str::limit($post->content, 120) }}</p>
            
                            <a href="{{ route('posts.show',$post->id) }}" class="btn btn-small btn-main btn-round-full">Voir plus</a>
                        </div>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div> 
    </section>
@endsection

<!-- 
    Essential Scripts
    =====================================-->

    
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
