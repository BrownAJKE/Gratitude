<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Question;
use Livewire\Component;
use Livewire\WithPagination;

class Questions extends Component
{
    public $body;
    public $category;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';


    public function updated($field)
    {
        $this->validateOnly($field, [
            'body' => 'required|max:255|min:5',
            'category' => 'required',
        ]);
    }

    public function addQuestion()
    {
        $this->validate([
            'body' => 'required| max:255|min:5',
            'category' => 'required',
        ]);

        $newComment =  Question::create([
            'body' => $this->body,
            'category' => $this->category,
            'author_id' => auth()->user()->id,
        ]);

        session()->flash('success', 'Question successfully added 😄.');

        $this->body = "";
        $this->category = "";
    }

    public function deleteQuestion($id)
    {
        $comment = Question::find($id);
        $comment->delete();
        session()->flash('success', 'Successful! Question deleted');
    }

    public function mount(){
        $this->post = new Question;
    }

    public function render()
    {
        $questions = Question::latest()->paginate(5);
        $categories = Category::all();
        return view('livewire.questions', compact('questions', 'categories'))->extends('layouts.app')
        ->section('content');

    }
}
