<?php

namespace App\Http\Livewire;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Livewire\Component;

class ShowTweets extends Component
{
    public $content = "";

    protected $rules = [
            'content' => 'required|min:1|max255',
    ];

    protected $messages = [
            'content.required' => 'É necessário preencher uma descrição para o tweet',
            'content.min' => 'É necessário preencher pelo menos um caracter'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->get();
        return view('livewire.show-tweets',[
            'tweets'=>$tweets
        ]);
    }

    public function create()
    {
        $this->validate();

        Tweet::create([
            'content'=> $this->content,
            'user_id' => 1,
        ]);

        $this->content = '';
    }
}
