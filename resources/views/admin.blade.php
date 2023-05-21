@section('title', '管理者ページ')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('管理者ページ') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

        <x-headline>アプリステータス</x-headline>

        <div class="flex justify-center my-8">
            <div class="stats stats-vertical lg:stats-horizontal shadow">
  
                <div class="stat">
                    <div class="stat-title">ユーザー数総計</div>
                    <div class="stat-value">{{ $all_users }}</div>
                    <div class="stat-desc">{{ $now }}</div>
                </div>
                
                <div class="stat">
                    <div class="stat-title">投稿数総計</div>
                    <div class="stat-value">{{ $all_posts }}</div>
                    <div class="stat-desc">{{ $now }}</div>
                </div>
                
                <div class="stat">
                    <div class="stat-title">正解数総計</div>
                    <div class="stat-value">{{ $all_corrects }}</div>
                    <div class="stat-desc">{{ $now }}</div>
                </div>

                <div class="stat">
                    <div class="stat-title">ブックマーク数総計</div>
                    <div class="stat-value">{{ $all_bookmarks }}</div>
                    <div class="stat-desc">{{ $now }}</div>
                </div>
                
            </div>
        </div>

        <x-headline>全ての投稿</x-headline>

        <div class="flex flex-col lg:flex-row lg:flex-wrap lg:justify-around lg:items-center">

            @if ($quizzes->isEmpty())

            <div class="flex flex-col mt-12 gap-4 px-6">
                <i class="fa-solid fa-8x fa-circle-exclamation mx-auto"></i>
                <p class="text-center text-2xl font-semibold">投稿はありません</p>
            </div>
            
            @else

            @foreach ($quizzes as $quiz)

            <div id="quiz_{{ $quiz->id }}">
                <div class="mt-12 px-6 flex flex-col">
                    <div class="flex items-center justify-between" id="post_header">
                        <div class="flex items-center">
                            <div class="avatar">
                                <div class="w-8 sm:w-10 lg:w-12 rounded-full">
                                    <img src="{{ asset($quiz->user->status->icon_path) }}" />
                                </div>
                            </div>
                            <p class="text-gray-600 text-base md:text-xl lg:text-2xl font-bold ml-2 lg:ml-3">
                                {{ $quiz->user->name }}
                            </p>
                        </div>
                        <div class="status-badge">
                            <div class="font-semibold text-black" id="create">
                                {{ $quiz->created_at }}
                            </div>
                        </div>
                    </div>
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
                                        <div class="badge badge-primary">POST &#035;{{ $quiz->id }}</div>
                                    </div>
                                    @if ($quiz->created_at->diffInHours($now) <= 3)
                                        <div class="badge badge-primary absolute right-4 hidden deadline-notice" id="deadline">
                                            NEW !
                                        </div>
                                        <div class="font-semibold text-black absolute right-4 hidden deadline-notice" id="deadline">
                                            {{ $quiz->deadline }} まで
                                        </div>
                                    @elseif ($now->diffInHours($quiz->deadline) <= 3)
                                        <div class="badge badge-primary absolute right-4 hidden deadline-notice" id="deadline">
                                            あと{{ $now->diffInMinutes($quiz->deadline) }}分
                                        </div>
                                        <div class="font-semibold text-black absolute right-4 hidden deadline-notice" id="deadline">
                                            {{ $quiz->deadline }} まで
                                        </div>
                                    @else
                                        <div class="font-semibold text-black" id="deadline">
                                            {{ $quiz->deadline }} まで
                                        </div>
                                    @endif
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