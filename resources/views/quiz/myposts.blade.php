@section('title', 'あなたの投稿')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('あなたの投稿') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

        <!--過去の投稿-->
        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:justify-around lg:items-center">

            @if ($quizzes->isEmpty())
            
            <div class="flex flex-col mt-12 gap-4 px-6">
                <i class="fa-solid fa-8x fa-circle-exclamation mx-auto"></i>
                <p class="text-center text-2xl font-semibold">アーカイブがありません</p>
                <p class="text-center font-semibold text-primary mt-12"><i class="fa-regular fa-circle-check mr-1"></i>クイズを投稿してみましょう</p>
                <button class="btn btn-primary">
                    <a href="{{ route('quiz.create') }}">
                        <i class="fa-solid fa-plus mr-2"></i>投稿を作成
                    </a>
                </button>
            </div>

            @else

            @foreach ($quizzes as $quiz)

            <div id="quiz_{{ $quiz->id }}">
                <div class="mt-12 px-6 flex flex-col">
                    <div class="mt-1 lg:mt-2 flex justify-center">
                        <div class="card card-compact w-96 bg-yellow-400 shadow-xl">
                            <label for="image-modal-{{ $quiz->id }}">
                                <figure><img src="{{ asset($quiz->image_path) }}" class="object-cover w-full h-64 rounded-t-2xl" /></figure>
                            </label>
                            <div class="card-body">
                                <h2 class="card-title">
                                    <p class="text-center text-black font-bold">{{ $quiz->title }}</p>
                                </h2>
                                
                                <div class="answer-section">
                                    <div class="flex justify-center items-center px-8">
                                        <label for="quiz-modal-{{ $quiz->id }}" class="btn btn-primary w-full max-w-xs">解説を見る</label>
                                        <label for="delete-confirm-modal-{{ $quiz->id }}" class="btn btn-circle btn-error text-white ml-4"><i class="fa-solid fa-lg fa-trash-can"></i></label>
                                    </div>
                                </div>
    
                                <div class="border-2 border-yellow-100 rounded mt-2"></div>
    
                                <div class="card-actions justify-between items-center mt-2">
                                    <div class="bookmark-state">
                                        @if ($quiz->bookmarks->where('user_id', Auth::id()) == '[]')
                                            <button class="btn btn-primary btn-xs btn_bookmark" id="bookmark">
                                                ブックマーク
                                            </button>
                                        @else
                                            <div class="badge badge-primary text-yellow-400"><i class="fa-solid fa-star"></i></div>
                                        @endif
                                    </div>
                                    <div class="font-semibold text-black" id="create">
                                        {{ $quiz->created_at }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endforeach

            @endif

        </div>

    <!--ぺジネーションリンク-->
    <div class="mt-12 mx-6">
        {!! $quizzes->links('vendor.pagination.tailwind') !!}
    </div>

    </div>

    <!--モーダルウィンドウ-->
    @include('quiz.modal')

</x-app-layout>