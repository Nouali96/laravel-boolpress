@extends ("admin.layouts.base")

@section("content")
    <div class="container">

        <h1>Dettagli post</h1>

        <div class="d-flex justify-content-between align-items-center">
            
            <ul class="list-unstyled">
                <li class="my-3">
                    <strong>Titolo: </strong> {{$post->title}}
                </li>
                <li class="my-3">
                    <strong>Contenuto: </strong> {{ $post->content }}
                </li>
                <li class="my-3">
                    <strong>Slug: </strong> {{$post->slug}}
                </li>
                <li class="my-3">
                    <strong>Categoria: </strong> {{isset($post->category) ? $post->category->name : "NULL"}}
                </li>
                <li class="my-3">
                    <strong>Il post è stato creato </strong> 
                    
                    @if ($diff["unit"] == "m")
                        {{$diff["difference"]}} minuti fa
                    @else
                        {{$diff["difference"]}} giorni fa
                    @endif
                        
                
                </li>
    
                <li class="my-3">
                    @foreach ($post->tags as $tag)
                        <a href="{{route('admin.tags.show', $tag->id)}}" class="badge badge-pill text-white mJS_badge_color my-3">{{$tag->name}}</a>
                    @endforeach
                </li>
                
            </ul>
        
            <div class="img_post">
                
                @if ($post->cover)
                    <img class="img-fluid" src="{{asset('storage/' . $post->cover)}}" alt="Img {{$post->title}}">
                @else
                    <img class="img-fluid" src="{{asset('img/libri.jpg')}}" alt="Img default">
                @endif
               
            </div>

        </div>

        <a href="{{ url()->previous()}}" class="btn btn-primary">Indietro</a>
        <a href="{{ route('admin.posts.edit', $post->id)}}" class="btn btn-warning">Modifica</a>

        
    </div>
@endsection