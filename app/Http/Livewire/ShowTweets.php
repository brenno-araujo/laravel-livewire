<?php

namespace App\Http\Livewire;

use App\Http\Requests\TweetRequest;
use App\Models\Tweet;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{

    use WithPagination;

    public $content = "";

    protected $rules = [
            'content' => 'required|min:1|max:255',
    ];

    protected $messages = [
            'content.required' => 'É necessário preencher uma descrição para o tweet',
            'content.min' => 'É necessário preencher pelo menos um caracter'
    ];

    public function render()
    {
        $tweets = Tweet::with('user')->orderByDesc('created_at')->paginate(8);
        return view('livewire.show-tweets',[
            'tweets'=>$tweets
        ]);
    }

    public function create()
    {
        $this->validate();

        // Tweet::create([
        //     'content'=> $this->content,
        //     'user_id' => auth()->user()->id,
        // ]);

        Auth()->user()->tweets()->create([
            'content' => $this->content
        ]);

        $this->content = '';
    }
}
