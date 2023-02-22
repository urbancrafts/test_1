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
            @if(count($blogs) > 0)
            @foreach ($blogs as $blog)
        <article id="post-{{$blog->id}}" class="post-29 post type-post status-publish format-standard has-post-thumbnail hentry category-apartment category-vacation tag-accommodation tag-apartment tag-hotel tag-reservation tag-resort tag-travel">
        <header class="entry-header">
        <div class="entry-meta">
        <span class="posted-on">On <a href="#" rel="bookmark"><time class="entry-date published" datetime="{{$blog->created_at}}">{{$blog->created_at}}</time></a></span> <span class="post-author">Posted by <a href="#" rel="author">{{$blog->name}}</a></span> </div>
        </header>
        @if($blog->media != "")
        <img width="1000" height="565" src="{{asset('storage/img/users/'.$blog->user_id.'/blog/'.$blog->media)}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /> 
        @endif
        <div class="entry-content">
           {!!$blog->cnt!!}
        </div>
        
       
        <section id="comments" class="comments-area" aria-label="Post Comments">
        <div class="comment-list-wrap">
        <h2 class="comments-title">
        {{count($comments)}} Comments </h2>
        
        <ol class="comment-list">

        @foreach ($comments as $comment)
            
        <li class="comment even thread-even depth-1 parent" id="comment-2">
            <div class="comment-body">
            <div class="comment-meta commentmetadata">
            <div class="comment-author vcard">
            @if($comment->uid == $users[0]->id)
            @if ($users[0]->img != "")
            <img alt='' src='{{asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img)}}' srcset='{{asset('storage/img/users/'.$users[0]->id.'/profile/'.$users[0]->img)}} 2x' class='avatar avatar-128 photo' height='128' width='128' /> 
            @else
            <img alt='' src='{{asset('storage/img/users/default.png')}}' srcset='{{asset('storage/img/users/default.png')}} 2x' class='avatar avatar-128 photo' height='128' width='128' /> 
            @endif
            @endif
            <cite class="fn">{{$comment->name}}</cite> </div>
            <a href="index.html#comment-2" class="comment-date">
            <time datetime="{{$comment->created_at}}">{{$comment->created_at}}</time> </a>
            </div>
            <div id="div-comment-2" class="comment-content">
            <div class="comment-text">
            <p>{{$comment->cnt}}</p>
            </div>
            
            </div>
            </div>
            </li>
        @endforeach

        
       

        </ol>

        </div>
       
        </section>
        </article>

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