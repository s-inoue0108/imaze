@foreach ($quizzes as $quiz)
<div class="quiz-modal">
    <!--画像の全画面表示-->
    <input type="checkbox" id="image-modal-{{ $quiz->id }}" class="modal-toggle" />
    <label for="image-modal-{{ $quiz->id }}" class="modal cursor-pointer">
        <div class="flex flex-col md:w-3/4 lg:w-1/2">
            <p class="bg-primary p-2 text-xs text-white font-semibold text-center">「{{ $quiz->title }}」</p>
            <figure><img src="{{ asset($quiz->image_path) }}" class="w-full h-auto" /></figure>
            <p class="bg-primary p-2 text-xs text-white font-semibold flex justify-center items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                画面をタップして閉じる
            </p>
        </div>
    </label>

    <!--解説-->
    <div>
        <input type="checkbox" id="quiz-modal-{{ $quiz->id }}" class="modal-toggle" />
        <label for="quiz-modal-{{ $quiz->id }}" class="modal cursor-pointer">
            <label class="modal-box relative bg-yellow-400" for="">
                <h3 class="text-black text-center text-lg font-bold quiz-answer-modal">「{{ $quiz->title }}」</h3>
                <div class="border-2 border-yellow-100 rounded mt-2"></div>
                <p class="text-lg text-center text-black font-semibold underline underline-offset-8 pt-4">答え：{{ $quiz->answer }}</p>
                @if ($quiz->explanation === null)
                <p class="text-black text-center py-8">このクイズの解説はありません</p>
                @else
                <p class="text-black py-8">{{ $quiz->explanation }}</p>
                @endif
                <p class="text-xs text-gray-400 flex justify-center items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-4 h-4 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    画面外をタップして閉じる
                </p>
            </label>
        </label>
    </div>
    
    <!--削除の確認-->
    <div>
        <input type="checkbox" id="delete-confirm-modal-{{ $quiz->id }}" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box relative bg-yellow-400">
                <h3 class="text-black text-center font-bold delete-confirm-modal">「{{ $quiz->title }}」を削除しますか？</h3>
                <div class="border-2 border-yellow-100 rounded mt-2"></div>
                <div class="flex justify-center gap-4 pt-4">
                    <label for="delete-confirm-modal-{{ $quiz->id }}" class="btn btn-primary">キャンセル</label>
                    <form method="POST" action="{{ route('quiz.destroy', $quiz) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-error text-white">この投稿を削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<!--正解通知-->
<div class="answer-alert">
    <div class="fixed bottom-0 w-screen p-4 bg-red-600" style="opacity: 0; z-index: -1">
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="text-white underline underline-offset-3">Notice</label>
                <button class="btn btn-circle btn-xs text-white alert-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <p class="text-xl text-white text-center font-bold bg-red-400 rounded-3xl px-4 py-1"><i class="fa-solid fa-circle-xmark mr-2"></i>残念！不正解！</p>
        </div>
    </div>

    <div class="fixed bottom-0 w-screen p-4 bg-green-600" style="opacity: 0; z-index: -2">
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="text-white underline underline-offset-3">Notice</label>
                <button class="btn btn-circle btn-xs text-white alert-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <p class="text-xl text-white text-center font-bold bg-green-400 rounded-3xl px-4 py-1"><i class="fa-solid fa-circle-check mr-2"></i>すばらしい！正解！</p>
        </div>
    </div>

    <div class="fixed bottom-0 w-screen p-4 bg-purple-600" style="opacity: 0; z-index: -3">
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="text-white underline underline-offset-3">Notice</label>
                <button class="btn btn-circle btn-xs text-white alert-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <p class="text-xl text-white text-center font-bold bg-purple-400 rounded-3xl px-4 py-1"><i class="fa-solid fa-crown mr-2"></i>あなたが初の正解者です！</p>
        </div>
    </div>

    <div class="fixed bottom-0 w-screen p-4 bg-yellow-600" style="opacity: 0; z-index: -4">
        <div class="flex flex-col gap-2">
            <div class="flex justify-between items-center">
                <label class="text-white underline underline-offset-3">Notice</label>
                <button class="btn btn-circle btn-xs text-white alert-close">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            <p class="text-xl text-white text-center font-bold bg-yellow-400 rounded-3xl px-4 py-1"><i class="fa-solid fa-triangle-exclamation mr-2"></i>解答期限を過ぎています</p>
        </div>
    </div>
</div>
