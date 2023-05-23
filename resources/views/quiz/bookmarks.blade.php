@section('title', 'ブックマーク')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('ブックマークしたクイズ') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>
    
        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:justify-around lg:items-center">

            @if ($bookmarks->isEmpty())
            
            <div class="flex flex-col mt-12 gap-4 px-6">
                <i class="fa-solid fa-8x fa-circle-exclamation mx-auto"></i>
                <p class="text-center text-2xl font-semibold">ブックマークはありません</p>
                <p class="text-center font-semibold text-primary mt-12"><i class="fa-regular fa-circle-check mr-1"></i>クイズをブックマークしてみましょう</p>
                <button class="btn btn-primary">
                    <a href="{{ route('quiz.index') }}">
                        <i class="fa-solid fa-clock-rotate-left mr-2"></i>みんなの投稿
                    </a>
                </button>
            </div>

            @else

            @foreach ($bookmarks as $bookmark)

            <div id="quiz_{{ $bookmark->quiz->id }}">
                <div class="mt-12 px-6 flex flex-col">
                    <div class="flex items-center justify-between" id="post_header">
                        <div class="flex items-center">
                            <div class="avatar">
                                <div class="w-8 sm:w-10 lg:w-12 rounded-full">
                                    <img src="{{ asset($bookmark->quiz->user->status->icon_path) }}" />
                                </div>
                            </div>
                            <p class="text-gray-600 text-base md:text-xl lg:text-2xl font-bold ml-2 lg:ml-3">
                                {{ $bookmark->quiz->user->name }}
                            </p>
                        </div>
                        <div class="status-badge">
                            @if ($bookmark->quiz->corrects->where('user_id', Auth::id()) != '[]')
                                <div class="badge badge-secondary lg:badge-lg check">
                                    正答済み
                                </div>
                            @endif
                            @if ($bookmark->quiz->automaticity === 'true')
                                <div class="badge badge-accent lg:badge-lg check">
                                    自動生成
                                </div>
                            @elseif ($bookmark->quiz->user->id == Auth::id())
                                <div class="badge badge-accent lg:badge-lg check">
                                    あなたの投稿
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="mt-1 lg:mt-2 flex justify-center">
                        <div class="card card-compact w-96 bg-yellow-400 shadow-xl">
                            <label for="image-modal-{{ $bookmark->quiz->id }}">
                                <figure><img src="{{ asset($bookmark->quiz->image_path) }}" class="object-cover w-full h-64 rounded-t-2xl" /></figure>
                            </label>
                            <div class="card-body">
                                <h2 class="card-title">
                                    <p class="text-center text-black font-bold">{{ $bookmark->quiz->title }}</p>
                                </h2>
                                
                                <div class="answer-section">
                                    @if ($bookmark->quiz->user->id == Auth::id())
                                        <div class="flex justify-center items-center px-8">
                                            <label for="quiz-modal-{{ $bookmark->quiz->id }}" class="btn btn-primary w-full max-w-xs">解説を見る</label>
                                            <label for="delete-confirm-modal-{{ $bookmark->quiz->id }}" class="btn btn-circle btn-error text-white ml-4"><i class="fa-solid fa-lg fa-trash-can"></i></label>
                                        </div>
                                    @elseif ($bookmark->quiz->user->id != Auth::id())
                                        @if ($bookmark->quiz->automaticity === 'true' || $bookmark->quiz->corrects->where('user_id', Auth::id()) != '[]' || $bookmark->quiz->deadline > $now)
                                            <div class="flex justify-center items-center px-8">
                                                <label for="quiz-modal-{{ $bookmark->quiz->id }}" class="btn btn-primary w-full max-w-xs">解説を見る</label>
                                            </div>
                                        @else
                                            <div class="flex justify-center items-center">
                                                <input type="text" name="solution" placeholder="解答を入力" class="input input-bordered input-primary w-full max-w-xs" />
                                                <button class="btn btn-primary btn_solution ml-2">解答する</button>
                                            </div>
                                        @endif
                                    @endif
                                </div>
    
                                <div class="border-2 border-yellow-100 rounded mt-2"></div>
    
                                <div class="card-actions justify-between items-center mt-2">
                                    <div class="bookmark-state">
                                        <div class="badge badge-primary text-yellow-400"><i class="fa-solid fa-star"></i></div>
                                    </div>
                                    <div class="font-semibold text-black" id="create">
                                        {{ $bookmark->quiz->created_at }}
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
            {!! $bookmarks->links('vendor.pagination.tailwind') !!}
        </div>
        
    </div>

    <!--モーダルウィンドウ-->
    @include('quiz.bookmark-modal')

</x-app-layout>
