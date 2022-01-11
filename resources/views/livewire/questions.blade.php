<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-2">
            <div class="card">
                <div class="card-header">
                    Categories
                </div>
                <ul class="list-group list-group-flush">
                  @foreach ($categories as $category)
                    <li class="list-group-item">{{ $category->name }} ({{ $category->questions->count() }})</li>
                  @endforeach
                </ul>
              </div>
        </div>
        <div class="col-md-10">
            <div class="card">
                <div style="text-align: center" class="card-header">
                    Questions
                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Add New Question
                    </button>
                    <!-- Add Question Modal -->
                    <div class="modal fade" wire:ignore.self id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form wire:submit.prevent='addQuestion'>
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Question</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if (session('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Question Body</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea1" wire:model='body'
                                                rows="3"></textarea>
                                            @error('body') <span class="error text-danger mt-1">{{ $message }}</span> @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPassword1" class="form-label">Category</label>
                                            <select class="form-select" aria-label="Default select example"
                                                wire:model='category'>
                                                <option selected>Select Category</option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category') <span class="error text-danger mt-1">{{ $message }}</span>
                                            @enderror
                                        </div>
            
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <ul class="list-group">
                        @if (!$questions->isEmpty())
                            @foreach ($questions as $question)
                                <li class="list-group-item">
                                    <a style="text-decoration: none; color:black;" href="">{{ $question->body }}</a>
                                    <button type="button" class="btn btn-danger btn-sm float-end"
                                        wire:click="deleteQuestion({{ $question->id }})"><i class="fas fa-trash"></i>
                                    </button>
                                    <a style="margin-right: 5px" href="/question/{{ $question->id }}" type="button"
                                        class="btn btn-success btn-sm float-end">View</a>
                                </li>
                            @endforeach
                            <div class="pagination mt-2">
                                {{ $questions->links() }}
                            </div>
                        @else
                            <p style="text-align: center">No Questions Found</p>
                        @endif
            
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

