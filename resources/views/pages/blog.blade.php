@extends('layouts.app1')


@section('content')

</head>
<body class="blog wp-embed-responsive has-post-thumbnail foxuries-footer-builder elementor-default">
  @include('inc.header1')
  
  
   
 
    <div id="content" class="site-content" tabindex="-1">
    <div class="col-full">
    <div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    
    @if(count($blogs) > 0)
    @foreach ($blogs as $blog)
    <article id="post-29" class="post-29 post type-post status-publish format-standard has-post-thumbnail hentry category-apartment category-vacation tag-accommodation tag-apartment tag-hotel tag-reservation tag-resort tag-travel">
 
      @if($blog->media != "")
      <img width="1000" height="565" src="{{asset('storage/img/users/'.$blog->user_id.'/blog/'.$blog->media)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> 
      @endif
      <header class="entry-header">
      <h2 class="alpha entry-title">
      <a href="{{url('blog/'.$blog->id)}}" rel="bookmark">{{$blog->title}}</a></h2> 
      <div class="entry-meta">
      <span class="posted-on">On <a href="{{url('blog/'.$blog->id)}}" rel="bookmark"><time class="entry-date published" datetime="{{$blog->created_at}}">{{$blog->created_at}}</time></a></span> <span class="post-author">Posted by <a href="#" rel="author">{{$blog->name}}</a></span><span class="categories-link">In <a href="#" rel="category tag">{{$blog->category}}</a></span> </div>
      </header>
      <div class="entry-content">
        {!!$blog->cnt!!}
    <p><span class="more-link-wrap"> <a href="{{url('blog/'.$blog->id)}}" class="more-link">Read More </a></span></p>
      </div> 
    @endforeach
        
    @else
        <h3>There's no blog post created for this category yet.</h3>
    @endif
    

    
   
    </main>
    </div>
    <div id="secondary" class="widget-area" role="complementary">
    <div id="recent-posts-2" class="widget widget_recent_entries"> <span class="gamma widget-title">Recent Posts</span> <ul>
    
      @foreach ($blogs2 as $blog2)
      
      <li>
        <div class="recent-posts-thumbnail">
        <a href="{{url('blog/'.$blog2->id)}}">
        @if($blog2->media != "")
         <img width="75" height="65" src="{{asset('storage/img/users/'.$blog2->user_id.'/blog/'.$blog2->media)}}" class="attachment-foxuries-recent-post size-foxuries-recent-post wp-post-image" alt="" /> </a>
        @endif
        </div>
        <div class="recent-posts-info">
        <a class="post-title" href="{{url('blog/'.$blog2->id)}}"><span>{{$blog2->title}}</span></a>
        <span class="post-comments"></span> </div>
        </li>

      @endforeach
      

    
    </ul>
    </div>
   </div>
    </div>
    </div>
  
 
    @include('inc.footer1')

    <script src="{{ asset('wp-content/cache/min/1/802f9abd09c8534008aa9a699e0f5ce7.js') }}" data-minify="1" defer></script>
	@endsection