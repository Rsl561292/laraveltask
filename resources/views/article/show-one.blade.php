@extends('.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="p-3">
                <h4 class="font-italic">Category</h4>
                <ol class="list-unstyled">
                    <li><a href="{{ route('site.articles') }}">All categories</a></li>
                    @foreach($categories as $key => $value)
                        <li><a href="{{ route('site.articles.category', ['category_slug' => $key]) }}">{{ $value }}</a></li>
                    @endforeach
                </ol>
            </div>
        </div>
        <div class="col-md-9">
            @if(!empty($article))
                <div class="blog-article">
                    <a class="title-article" href="#">{{ $article['title'] }}</a>
                    <div class="list-meta-data">
                        <p class="meta-data div-left">Category: <a href="{{ route('site.articles.category', ['category_slug' => $article['category']['slug']]) }}">{{ $article['category']['name'] }}</a></p>
                        <p class="meta-data div-right">{{ date('F d, Y', strtotime($article['published_at'])) }} by <a href="#">{{ $article['user']['name'] }}</a></p>
                    </div>

                    <div class="content-article">{{ $article['content'] }}</div>

                </div>
            @else
                <center><h4>Articles not found!</h4></center>
            @endif
        </div>
    </div>
@endsection
