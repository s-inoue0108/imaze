@section('title', 'マイページ')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>
        
    <x-headline>おしらせ</x-headline>
        
    <div class="pt-6 px-6 flex justify-center">
        <div class="bg-yellow-400 rounded-3xl">
            <p class="text-gray-700 p-2"><span class="font-bold">不具合のお詫び：</span>
            ランキングに関する不具合があったため，2023-05-25 11:20ごろ以前のステータスパラメータをリセットしました．すみません．反省してまーす．</p>
        </div>
    </div>

    <x-headline>ユーザーステータス</x-headline>

    <!--ユーザーのスタッツ-->
    <div class="pt-6 px-6 flex justify-center">
        <div class="artboard artboard-horizontal phone-2 bg-yellow-400 rounded-3xl">

            <div class="flex justify-between items-center p-4">
                <div class="flex items-center">
                    <div class="avatar">
                        <div class="w-12 sm:w-16 lg:w-20 rounded-full">
                            <img src="{{ asset($my_status->icon_path) }}" />
                        </div>
                    </div>
                    <p class="text-black text-xl sm:text-2xl lg:text-3xl font-bold ml-2 lg:ml-4">
                        {{ Auth::user()->name }}
                    </p>
                </div>
                <button class="btn btn-primary btn-circle">
                    <a href="{{ route('profile.edit') }}"><i class="fa-solid fa-lg fa-address-card"></i></a>
                </button>
            </div>

            <div class="border-2 border-yellow-100 rounded mx-4"></div>

            <div class="flex justify-around mt-4 mx-2 sm:mx-8 lg:mx-16">

                <div class="status flex flex-col mx-1 lg:mx-2">
                    <p class="badge badge-primary p-4 text-white text-center text-sm sm:text-base lg:text-xl font-bold" id="posts">
                        投稿
                    </p>
                    <div class="text-white text-center text-xl sm:text-2xl lg:text-3xl font-semibold mt-2">
                        {{ $my_status->number_of_posts }}
                    </div>
                </div>
                
                <div class="status flex flex-col mx-1 lg:mx-2">
                    <p class="badge badge-primary p-4 text-white text-center text-sm sm:text-base lg:text-xl font-semibold" id="corrects">
                        正解
                    </p>
                    <div class="text-white text-center text-xl sm:text-2xl lg:text-3xl font-bold mt-2">
                        {{ $my_status->number_of_corrects }}
                    </div>
                </div>

                <div class="status flex flex-col mx-1 lg:mx-2">
                    <p class="badge badge-primary p-4 text-white text-center text-sm sm:text-base lg:text-xl font-semibold" id="top">
                        トップ
                    </p>
                    <div class="text-white text-center text-xl sm:text-2xl lg:text-3xl font-bold mt-2">
                        {{ $my_status->number_of_top }}
                    </div>
                </div>

            </div>

            <div class="border-2 border-yellow-100 rounded mt-4 mx-4"></div>

            @php
            $icon_id = $my_status->id;
            @endphp
                
            <form method="POST" action="{{ route('dashboard.icon', $icon_id) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')

                <div class="flex flex-col lg:flex-row justify-center lg:justify-between mt-4 mx-4 lg:mx-8">

                    <div class="form-control status">
                        <p class="text-black text-base font-semibold" id='icon'>
                            アイコンを変更する
                        </p>
                        <input type="file" name="icon" class="file-input file-input-bordered file-input-primary w-full max-w-xs mt-2"/>
                    </div>

                    <button disabled class="btn btn-primary mt-4" id="btn_upload">適用する</button>

                </div>

            </form>

        </div>
    </div>

    <x-headline>メニュー</x-headline>

    <div class="flex justify-center">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-4 lg:gap-8 pt-6">
            <a href="{{ route('myposts') }}">
                <button class="btn btn-primary btn-wide"><i class="fa-solid fa-box-archive mr-2"></i>あなたの投稿</button>
            </a>
            <a href="{{ route('bookmarks') }}">
                <button class="btn btn-primary btn-wide"><i class="fa-solid fa-bookmark mr-2"></i>ブックマーク</button>
            </a>
            <a href="{{ route('info.about') }}">
                <button class="btn btn-primary btn-wide"><i class="fa-solid fa-circle-info mr-2"></i>このサイトについて</button>
            </a>
            @if (auth()->user()->role === 'admin')
                <a href="{{ route('admin') }}">
                    <button class="btn btn-primary btn-wide"><i class="fa-solid fa-lock mr-2"></i>管理者ページ</button>
                </a>
            @endif
        </div>
    </div>

    <x-headline>外部コンテンツ</x-headline>

    <div class="flex justify-center">
        <div class="flex flex-col lg:flex-row lg:justify-between gap-4 lg:gap-8 pt-6">
            <div class="flex justify-center">
                <div class="flex flex-col gap-4">
                    <div class="flex flex-col gap-1">
                        <label class="text-xs"><i class="fa-solid fa-circle-check mr-1"></i>管理人のWebサイト</label>
                        <a href="https://si-library.net" target="_blank" rel="noopener noreferrer">
                            <button class="btn btn-primary btn-wide"><i class="fa-solid fa-paperclip mr-2"></i>S.I's Library</button>
                        </a>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="text-xs"><i class="fa-solid fa-circle-check mr-1"></i>管理人が運営に関わってるTCGのブログ</label>
                        <a href="https://sv-evolve-lab.com" target="_blank" rel="noopener noreferrer">
                            <button class="btn btn-primary btn-wide"><i class="fa-brands fa-wordpress mr-2"></i>EVOLVE LAB</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

        
</x-app-layout>
