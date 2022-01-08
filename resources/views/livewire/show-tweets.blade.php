<div>
    <h3 class="text-center mb-3 mt-3">Novo Tweet</h3>

    <hr>

    <form method="post" wire:submit.prevent="create">
        <div class="form-group">
            <div class="mb-3">
                <input type="text" class="form-control @error('content') is-invalid @enderror" id="content"
                    placeholder="Escreva aqui a sua mensagem" wire:model="content">
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-dark btn-sm">
            <i class="bi bi-send-plus-fill"></i> Enviar
        </button>
    </form>

    <hr>

    @foreach ($tweets as $tweet)
        <p class="mb-0">{{ $tweet->user->name }} - {{ $tweet->content }}</p>
        @if ($tweet->likesUser->count())
            <a href="" class="btn btn-sm mb-2">
                <i class="bi bi-heart-fill text-danger"></i> {{$count = $tweet->likes->count()}} {{$count <> 1 ? 'Curtidas' : 'Curtida'}}
            </a>
        @else
            <a href="#" wire:click.prevent="like({{$tweet->id}})" class="btn btn-sm mb-2">
                <i class="bi bi-heart text-danger"></i> {{$count = $tweet->likes->count()}} {{$count <> 1 ? 'Curtidas' : 'Curtida'}}
            </a>
        @endif
    @endforeach

    <hr>

    <div>
        <ul class="pagination pagination-sm justify-content-center">
        {{$tweets->links()}}
        </ul>
    </div>
</div>
