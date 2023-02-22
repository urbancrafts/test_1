@extends('layouts.app1')

      @section('content')
		<!-- Page loader -->



    </head>
    <body class="blog wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default">
	@include('inc.header1')
    
        <div id="content" class="site-content" tabindex="-1">
        <div class="col-full">
        <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            
        @if(count($users) > 0)
      
       {{$users[0]->name}}  

        @endif
       
        
       

        </main>
        </div>
        
        

        </div>
        </div>

@include('inc.footer1')
<script src="{{ asset('wp-content/cache/min/1/802f9abd09c8534008aa9a699e0f5ce7.js') }}" data-minify="1" defer></script>
@endsection