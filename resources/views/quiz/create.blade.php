@section('title', '投稿を作成')

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('新しい投稿を作成') }}
        </h2>
    </x-slot>

    <!--ChatGPTのローディング-->
    <div class="fixed z-50 top-0 left-0 w-screen h-screen bg-gray-100 bg-opacity-80 hidden gpt-load">
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
            <div class="flex flex-col gap-8 text-center text-black text-2xl">
                <div class="gpt-spinner"><i class="fa-solid fa-5x fa-spinner"></i></div>
                <p class="whitespace-nowrap font-bold">クイズを生成しています...</p>
            </div>
        </div>
    </div>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

        <x-headline>ChatGPTで自動生成</x-headline>

        @if (session('err_mes'))
            <div class="flex justify-center mt-4 text-xs text-red-400 font-bold">
                <p class="err-mes">
                    {{ session('err_mes') }}
                </p>
            </div>
        @endif

        <div class="flex justify-center">
            <div class="flex flex-col">
                <div class="flex flex-col lg:flex-row justify-center items-center mt-6 gap-4 lg:gap-8">
                    <form method="POST" action="{{ route('quiz.generate') }}">
                        @csrf
                        <textarea name="question" class="hidden">
                            問題文，答えのどちらもが15文字未満の一意な文字列になるような，日本でよく知られている「なぞなぞ」と，その「解答」，「解説」を作成してください．
                            このとき，それぞれの内容は，「なぞなぞ」は「クイズ：」，ほかは「解答：」「解説：」のように，コロンに続けて書き，すべての内容を一文で出力してください．
                        </textarea>
                        <button class="btn btn-primary btn-sm btn-wide gpt-btn"><i class="fa-solid fa-comment mr-1"></i>なぞなぞ</button>
                    </form>
                    <form method="POST" action="{{ route('quiz.generate') }}">
                        @csrf
                        <textarea name="question" class="hidden">
                            問題文，答えのどちらもが15文字未満の一意な文字列になるような，日本でよく知られている「雑学クイズ」と，その「解答」，「解説」を作成してください．
                            このとき，それぞれの内容は，「雑学クイズ」は「クイズ：」，ほかは「解答：」「解説：」のように，コロンに続けて書き，すべての内容を一文で出力してください．
                        </textarea>
                        <button class="btn btn-primary btn-sm btn-wide gpt-btn"><i class="fa-solid fa-comment mr-1"></i>雑学クイズ</button>
                    </form>
                    <form method="POST" action="{{ route('quiz.generate') }}">
                        @csrf
                        <textarea name="question" class="hidden">
                            問題文，答えのどちらもが15文字未満の一意な文字列になるような，「アメリカンジョークのクイズ」と，その「解答」，「解説」を作成してください．
                            このとき，それぞれの内容は，「アメリカンジョークのクイズ」は「クイズ：」，ほかは「解答：」「解説：」のように，コロンに続けて書き，すべての内容を一文で出力してください．
                        </textarea>
                        <button class="btn btn-primary btn-sm btn-wide gpt-btn"><i class="fa-solid fa-comment mr-1"></i>アメリカンジョーク</button>
                    </form>
                    <form method="POST" action="{{ route('quiz.generate') }}">
                        @csrf
                        <textarea name="question" class="hidden">
                            問題文，答えのどちらもが15文字未満の一意な文字列になるような，「ケミストリー（化学）のクイズ」と，その「解答」，「解説」を作成してください．
                            このとき，それぞれの内容は，「ケミストリー（化学）のクイズ」は「クイズ：」，ほかは「解答：」「解説：」のように，コロンに続けて書き，すべての内容を一文で出力してください．
                        </textarea>
                        <button class="btn btn-primary btn-sm btn-wide gpt-btn"><i class="fa-solid fa-comment mr-1"></i>化学クイズ</button>
                    </form>
                </div>
                <div class="bg-yellow-400 rounded-3xl mx-6 mt-8 p-4">
                    <p class="text-sm text-center text-black font-semibold">
                        <i class="fa-solid fa-triangle-exclamation mr-1"></i>クイズの自動生成に関する注意
                    </p>
                    <p class="text-xs text-black pt-4">
                        このシステムはOpenAI社の言語モデル「gpt-3.5-turbo」を用いており，その特性上，適切な文章が生成されない場合があります．また，<span class="font-bold underline underline-offset-2">生成された内容において，誤った情報を含む場合があります．</span>予めご了承ください．
                    </p>
                </div>
            </div>
        </div>

        <x-headline>投稿フォーム</x-headline>

        <!--投稿フォーム-->
        <div class="bg-yellow-400 my-6 mx-6 sm:mx-12 md:mx-36 lg:mx-72 rounded-3xl">
            <form method="POST" action="{{ route('quiz.store') }}" enctype="multipart/form-data">
                @csrf
    
                <div class="flex flex-col px-2 py-4">
    
                    <div class="flex justify-center">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="deadline">期限</span>
                            </label>
                            <select name="deadline" class="select select-bordered select-primary w-full max-w-xs">
                                <option value="one_day">1日</option>
                                <option value="three_days">3日</option>
                                <option value="one_week">1週間</option>
                                <option value="two_weeks">2週間</option>
                                <option value="one_month">1か月</option>
                            </select>
                        </div>
                    </div>
    
                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
                    
                    <div class="flex justify-center mt-2">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="title">タイトル</span>
                             </label>
                            <input type="text" name="title" placeholder="TITLE" class="input input-bordered input-primary w-full max-w-xs" value="{{ old('title') }}" />
                            <div class="flex flex-col items-center gap-2 mt-2 text-xs text-red-400 font-bold">
                                @if ($errors->has('title'))
                                    @foreach ($errors->get('title') as $error)
                                        <p class="err-mes">
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
        
                    <div class="flex justify-center mt-2">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="answer">解答</span>
                            </label>
                            <input type="text" name="answer" placeholder="ANSWER" class="input input-bordered input-primary w-full max-w-xs" value="{{ old('answer') }}" />
                            <div class="flex flex-col items-center gap-2 mt-2 text-xs text-red-400 font-bold">
                                @if ($errors->has('answer'))
                                    @foreach ($errors->get('answer') as $error)
                                        <p class="err-mes">
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
    
                    <div class="flex justify-center mt-2">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="explanation">解説（任意）</span>
                            </label>
                            <textarea rows="5" name="explanation" class="textarea textarea-primary w-full max-w-xs" placeholder="EXPLANATION">{{ old('explanation') }}</textarea>
                            <div class="flex flex-col items-center gap-2 mt-2 text-xs text-red-400 font-bold">
                                @if ($errors->has('explanation'))
                                    @foreach ($errors->get('explanation') as $error)
                                        <p class="err-mes">
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
    
                    <div class="flex justify-center mt-2">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="hint">ヒント（任意）</span>
                            </label>
                            <textarea rows="3" name="hint" class="textarea textarea-primary w-full max-w-xs" placeholder="HINT">{{ old('hint') }}</textarea>
                            <div class="flex flex-col items-center gap-2 mt-2 text-xs text-red-400 font-bold">
                                @if ($errors->has('hint'))
                                    @foreach ($errors->get('hint') as $error)
                                        <p class="err-mes">
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
    
                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
    
                    <div class="flex justify-center mt-2">
                        <div class="form-control w-full max-w-xs">
                            <label class="label">
                                <span class="label-text text-gray-600 font-bold" id="file">画像ファイル</span>
                            </label>
                            <input type="file" name="image" class="file-input file-input-bordered file-input-primary w-full max-w-xs"/>
                        </div>
                    </div>
    
                    <div class="flex justify-center mt-4">
                        <img src="/storage/logo/iMAZE-logo.png" class="h-48" id="preview">
                    </div>
    
                    <div class="border-2 border-yellow-100 rounded mt-4"></div>
                    
                    <div class="flex justify-center mt-4">
                        <button disabled class="btn btn-primary w-full max-w-xs" id="btn_upload">投稿</button>
                    </div>
    
                </div>
                
            </form>
        </div>

    </div>

</x-app-layout>