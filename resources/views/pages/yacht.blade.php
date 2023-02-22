@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->
        <style id='foxuries-style-inline-css' type='text/css'>
            div.foxuries-yacht{
              background-image: url({{ asset('storage/img/bg/yacht_2.jpg') }});
            }
            </style>
	</head>
  <body class="archive post-type-archive post-type-archive-hb_room wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default"> 
		@include('inc.header1')

    
        <div class="foxuries-yacht foxuries-breadcrumb">
            <h1 class="breadcrumb-heading">
            Yacht	</h1>
            
        
          </div>



          

    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <ul class="rooms tp-hotel-booking hb-catalog-column-3">
    @if(count($services) > 0)
    @foreach ($services as $service)
        
    <li id="room-{{$service->id}}" class="hb_room post-56 type-hb_room status-publish has-post-thumbnail hentry hb_room_type-balcony hb_room_type-lake-view">
    <div class="summary entry-summary">
    <div class="media">
    <a href="{{ url('service/'.$service->id) }}">
        @if ($service->img != "")
        <img src="{{ asset('storage/img/services/'.$service->img) }}" width="500" height="575" alt="" /> </a>
        @endif
    
    </div>
    <div class="room-caption">
    <div class="title">
    <h4>
    <a href="{{ url('service/'.$service->id) }}">{{ $service->title }}</a>
    </h4>
    </div>
    <div class="room-meta"><span class="room-type"><span><a href="#">{{ $service->about }}</a></span></span></div>
    @if ($service->price != "")
    <div class="price">
    <span class="title-price">Price</span>
    <span class="price_value price_min">{{$service->curr}}{{$service->price}}</span>
    <span class="unit">{{$service->duration}}</span>
    </div>
    @endif
    <div class="rating">
    <div itemprop="reviewRating" itemscope itemtype="" class="star-rating" title="">
    <span style="width:80%"></span>
    </div>
    </div>
    <a href="{{ url('service/'.$service->id) }}" class="room-button"><i class="foxuries-icon-long-arrow-right"></i><span>See details</span></a> </div>
    </div>
    </li>
    @endforeach

    @else

    <li><h2 align="center">There's no data created for yachts yet.</h2></li>
        
    @endif

    </ul>

  @if (count($services) > 9)
    <nav class="rooms-pagination">
    <ul class='page-numbers'>
    <li><span aria-current="page" class="page-numbers current">1</span></li>
    <li><a class="page-numbers" href="{{ url('yacht?page') }}">2</a></li>
    <li><a class="next page-numbers" href="{{ url('yacht?page') }}">Next</a></li>
    </ul>
    </nav>
    @endif


    </div>
    </div>
    @include('inc.footer1')
    <script src="{{ asset('wp-content/cache/min/1/26ca0b884dacc351c317d05fa6222447.js') }}" data-minify="1" defer></script>
		@endsection