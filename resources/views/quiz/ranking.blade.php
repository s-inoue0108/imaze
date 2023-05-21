@section('title', 'ランキング')

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('ランキング') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

        @if ($ranks->isEmpty())

            <div class="flex flex-col mt-12 gap-4 px-6">
                <i class="fa-solid fa-8x fa-circle-exclamation mx-auto"></i>
                <p class="text-center text-2xl font-semibold">ランキングはありません</p>
                <p class="text-center font-semibold text-primary mt-12"><i class="fa-regular fa-circle-check mr-1"></i>クイズを投稿してみましょう</p>
                <button class="btn btn-primary">
                    <a href="{{ route('quiz.create') }}">
                        <i class="fa-solid fa-plus mr-2"></i>投稿を作成
                    </a>
                </button>
            </div>
        
        @else

        <div class="flex flex-col bg-yellow-400 gap-4 mt-12 p-4">
            <div class="flex flex-col items-center gap-2 bg-primary p-1 rounded-3xl">
                <p class="text-center text-white text-lg font-semibold">{{ $header_column }}ランキング</p>
                <p class="text-center text-white text-sm font-semibold">
                    <i class="fa-solid fa-clock-rotate-left mr-1"></i>{{ $now }}
                </p>
            </div>

            <div class="border-2 border-yellow-100 rounded"></div>

            <div class="flex justify-center items-center gap-2">
                <form method="GET" action="{{ route('ranking') }}">
                    <div class="flex items-center gap-2">
                        @if (request()->query('sort'))
                            @if (request()->query('sort') === 'top')
                                <select name="sort" class="select select-bordered select-primary">
                                    <option value="top">トップ数</option>
                                    <option value="corrects">正解数</option>
                                    <option value="posts">投稿数</option>
                                </select>
                            @elseif (request()->query('sort') === 'corrects')
                                <select name="sort" class="select select-bordered select-primary">
                                    <option value="corrects">正解数</option>
                                    <option value="posts">投稿数</option>
                                    <option value="top">トップ数</option>
                                </select>
                            @else
                                <select name="sort" class="select select-bordered select-primary">
                                    <option value="posts">投稿数</option>
                                    <option value="top">トップ数</option>
                                    <option value="corrects">正解数</option>
                                </select>
                            @endif
                        @else
                            <select name="sort" class="select select-bordered select-primary">
                                <option value="top">トップ数</option>
                                <option value="corrects">正解数</option>
                                <option value="posts">投稿数</option>
                            </select>
                        @endif
                        <button class="btn btn-primary"><i class="fa-solid fa-rotate-right mr-1"></i>変更</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col mt-12">
            <div class="bg-yellow-400 py-2 mb-4">
                <div class="flex justify-around">
                    <p class="text-center text-black font-semibold">順位</p>
                    <p class="text-center text-black font-semibold">ユーザー名</p>
                    <p class="text-center text-black font-semibold">{{ $header_column }}</p>
                </div>
            </div>

            @foreach ($ranks as $rank)

                <div class="bg-yellow-400 rounded-3xl p-2 mx-4 my-2">
                    <div class="relative">
                        <div class="flex items-center gap-4">
                            @if (request()->query('page'))
                                @php
                                    $position = $loop->iteration + $onepage * ( request()->query('page') - 1 );
                                @endphp
                            @else
                                @php
                                    $position = $loop->iteration;
                                @endphp
                            @endif
                            @if ($position === 1 || $position === 2 || $position === 3)
                                <p class="text-xl text-center text-black font-semibold">
                                    <i class="fa-solid fa-award mr-1"></i>{{ $position }}
                                </p>
                            @else
                                <p class="text-xl text-center text-black font-semibold">
                                    &#035; {{ $position }}
                                </p>
                            @endif
                            <div class="flex justify-start items-center">
                                <div class="avatar">
                                    <div class="w-12 lg:w-20 sm:w rounded-full">
                                        <img src="{{ asset($rank->icon_path) }}" />
                                    </div>
                                </div>
                                <p class="text-gray-600 text-xl sm:text-2xl lg:text-3xl font-bold ml-2 lg:ml-4">
                                    {{ $rank->user->name }}
                                </p>
                            </div>
                        </div>
                        <div class="absolute top-1/2 -translate-y-1/2 right-4">
                            @if ($header_column === 'トップ数')
                                <p class="text-2xl text-center text-gray-600 font-semibold">{{ $rank->number_of_top }}</p>
                            @elseif ($header_column === '正解数')
                                <p class="text-2xl text-center text-gray-600 font-semibold">{{ $rank->number_of_corrects }}</p>
                            @else
                                <p class="text-2xl text-center text-gray-600 font-semibold">{{ $rank->number_of_posts }}</p>
                            @endif
                        </div>
                    </div>
                </div>

            @endforeach

            <div class="bg-yellow-400 py-2 mt-4">
                <div class="flex justify-around">
                    <p class="text-center text-black font-semibold"><i class="fa-solid fa-ranking-star"></i></p>
                    <p class="text-center text-black font-semibold"><i class="fa-solid fa-user"></i></p>
                    <p class="text-center text-black font-semibold"><i class="fa-solid fa-signal"></i></p>
                </div>
            </div>

            @endif
            
        </div>

        <!--ぺジネーションリンク-->
        <div class="mt-12 mx-6">
            {!! $ranks->links('vendor.pagination.tailwind') !!}
        </div>

    </div>

</x-app-layout>