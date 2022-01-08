<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{

    use WithPagination;

    //variable responsible for the content of the tweet
    public $content = "";

    //tweet sending rules
    protected $rules = [
            'content' => 'required|min:1|max:255',
    ];

    //translation of messages to portuguese
    protected $messages = [
            'content.required' => 'É necessário preencher uma descrição para o tweet',
            'content.min' => 'É necessário preencher pelo menos um caracter'
    ];


    //function that displays performed tweets
    public function render()
    {
        $tweets = Tweet::with('user')->orderByDesc('created_at')->paginate(8);
        return view('livewire.show-tweets',[
            'tweets'=>$tweets
        ]);
    }

    //funcition responsible for creating new tweet
    public function create()
    {
        $this->validate();
        Auth()->user()->tweets()->create([
            'content' => $this->content
        ]);
        $this->content = '';
    }

    //function responsible for likes
    public function like(int $idTweet)
    {
        $tweet = Tweet::findOrFail($idTweet);

        $tweet->likesUser()->create([
            'user_id'=> auth()->user()->id
        ]);
    }

    //function responsible for dislikes
    public function dislike(int $idTweet)
    {
        $tweet = Tweet::findOrFail($idTweet);

        $tweet->likesUser()->delete();
    }

}
