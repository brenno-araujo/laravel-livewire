<div>
    BOA NOITE
    <p>{{$message}}</p>
    <input type="text" class="form-control" id="message" placeholder="text" wire:model="message">

</tr>

@foreach ($tweets as $tweet)
    <p>{{$tweet->user->name}} - {{$tweet->content}}</p>
@endforeach
</div>
