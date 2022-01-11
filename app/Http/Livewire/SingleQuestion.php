<?php

namespace App\Http\Livewire;

use App\Models\Answer;
use App\Models\Question;
use Livewire\Component;

class SingleQuestion extends Component
{

    public $question;
    public $answer;
    public $question_id;

    public function mount($id){
        $this->question = Question::where('id', $id)->first();
        $this->question_id = $id;
    }

    private function resetInputFields(){
        $this->answer = '';
    }

    public function updated($field)
    {
        $this->validateOnly($field, [
            'answer' => 'required|max:255'
        ]);
    }

    public function addAnswer()
    {
        $this->validate([
            'answer' => 'required| max:255'
        ]);

        
        $answer = Answer::create([
            'answer' => $this->answer,
            'question_id' => $this->question_id
        ]);

        session()->flash('success', 'Answer successfully added 😄.');

        $this->resetInputFields();

    }

    public function deleteAnswer($id)
    {
        $answer = Answer::findorFail($id);
        $answer->delete();
        session()->flash('success', 'Successful! Answer deleted successfully');
    }

    public function markAsRight(Answer $answer)
    {
        if($answer->is_correct == false)
        {
            $answer->is_correct = true;
            $answer->save();
            session()->flash('success', 'Successful! Answer unmarked as right');
        }else
        {
            $answer->is_correct = false;
            $answer->save();
            session()->flash('success', 'Successful! Answer marked as Right');
        }
    }

    public function render()
    {
        $answers = Answer::where('question_id', '=', $this->question_id)->get();

        return view('livewire.single-question', compact('answers'))
        ->extends('layouts.app')
        ->section('content');
    }
}
