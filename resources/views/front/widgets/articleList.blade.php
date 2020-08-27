@forelse($articles as $article)
    <div class="post-preview">
        <a href="{{ route('single', [$article->getCategory->slug, $article->slug]) }}">
            <h2 class="post-title">
                {{ $article->title }}
            </h2>
            <img class="img-thumbnail" src="{{ $article->image }}" alt="">
            <h3 class="post-subtitle">
                {!! Str::limit($article->content, 50) !!}
            </h3>
        </a>
        <p class="post-meta">
            <a href="#">{{ $article->getCategory->name }}</a><span class="float-right">{{ $article->created_at->diffForHumans() }}</span></p>
    </div>
    @if(!$loop->last)
        <hr>
    @else
        {{ $articles->links() }}
    @endif
@empty
    <div class="alert alert-danger">
        <h1>Herhangi bir yazı bulunamadı</h1>
    </div>
@endforelse
