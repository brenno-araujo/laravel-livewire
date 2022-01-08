<div>
    <h3 class="text-center mb-3 mt-3">Preview do Tweet</h3>
    <p>{{ $content }}</p>

    <hr>

    <form method="post" wire:submit.prevent="create">
        <div class="form-group">
            <div class="mb-3">
                <input type="text" class="form-control @error('content') is-invalid @enderror" id="content"
                    placeholder="text" wire:model="content">
                @error('content')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-dark">Enviar</button>
    </form>

    <hr>

    @foreach ($tweets as $tweet)
        <p>{{ $tweet->user->name }} - {{ $tweet->content }}</p>
    @endforeach

    <div>
        <ul class="pagination justify-content-center">
        {{$tweets->links()}}
    </ul>
    </div>
</div>
