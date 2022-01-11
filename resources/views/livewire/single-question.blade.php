<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Successful!</strong> {{ session('success') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    Add Answer
                </div>
                <div class="card-body">
                    {{-- <p class="card-text">No Answers Found</p> --}}
                    <form wire:submit.prevent='addAnswer'>
                        <div class="mb-3">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                                wire:model='answer'></textarea>
                            @error('answer') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-success btn-sm">Add</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-7">
            <div class="card mb-2">
                <div class="card-header">
                    Author : {{ $question->author->name }}
                    <a href="/questions" type="button" class="btn btn-secondary btn-sm float-end">Go Back</a>
                </div>
                <div class="card-body">
                    <p class="card-text">{{ $question->body }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    Answers
                </div>
                <div class="card-body">
                   
                    <ul class="list-group list-group-flush">
                        @if ($answers->count() > 0 )
                            @foreach ($answers as $answer => $key)
                            <li class="list-group-item">
                                {{ $key->answer }}
                                <button type="button" class="btn btn-danger btn-sm float-end"
                                    wire:click="deleteAnswer({{ $key->id }})"><i class="fas fa-trash"></i>
                                </button>
                                <button style="margin-right: 5px" type="button"
                                    class="btn {{ $key->is_correct == false  ? 'btn-success' : 'btn-warning'  }} btn-sm float-end" wire:click="markAsRight({{ $key->id }})">{{ $key->is_correct == false  ? 'Mark as Right' : 'Mark as False'  }}</button>
                            </li>
                            @endforeach
                        @else
                            <p class="card-text">No Answers Found</p>
                        @endif
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
