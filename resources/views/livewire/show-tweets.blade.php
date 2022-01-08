<div>
    <h3 class="text-center mb-3 mt-3">Tweets</h3>
    <hr>
    <form method="post" wire:submit.prevent="create">
        <div class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control @error('content') is-invalid @enderror"
                    placeholder=" Escreva aqui a sua mensagem" aria-label="Escreva aqui a sua mensagem"
                    aria-describedby="button-addon2" wire:model="content">
                <button class="btn btn-outline-none btn-primary" type="submit" id="submit">
                    <i class="bi bi-send-plus-fill"></i></button>
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </form>
    <hr>
    @foreach ($tweets as $tweet)
        <div class="card m-3">
            <div class="card-title row">
                <div class="m-0 mt-2 col flex">
                    <img src="{{ $tweet->user->profile_photo_url }}" alt="dsds"
                        class="rounded-full h-10 w-10 object-cover ml-3">
                    <span class="mt-2 ml-3">{{ $tweet->user->name }}</span>
                </div>
            </div>
            <div class="card-body pt-1">
                <p class="mb-0">{{ $tweet->content }}</p>
                @if ($tweet->likesUser->count())
                    <a href="#" wire:click.prevent="dislike({{ $tweet->id }})" class="btn btn-sm mb-0 p-0">
                        <i class="bi bi-heart-fill text-danger"></i> {{ $count = $tweet->likes->count() }}
                        {{ $count != 1 ? 'Curtidas' : 'Curtida' }}
                    </a>
                @else
                    <a href="#" wire:click.prevent="like({{ $tweet->id }})" class="btn btn-sm mb-0 p-0">
                        <i class="bi bi-heart text-danger"></i> {{ $count = $tweet->likes->count() }}
                        {{ $count != 1 ? 'Curtidas' : 'Curtida' }}
                    </a>
                @endif
            </div>
        </div>
    @endforeach
    <hr>
    <div>
        <ul class="pagination pagination-sm justify-content-center d-flex align-items-center mb-0 pb-3">
            {{ $tweets->links() }}
        </ul>
    </div>
</div>
