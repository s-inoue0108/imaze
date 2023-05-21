@section('title', 'このサイトについて')

<!--登録ユーザー-->
@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('このサイトについて') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        推奨環境
    </h3>

    <div class="flex justify-center">
        <ul style="font-size: 18px; font-weight: bold; list-style: none; padding: 1rem; color: black;">
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-chrome mr-2"></i>Google Chrome</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-edge mr-2"></i>Microsoft Edge</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-firefox-browser mr-2"></i>Mozilla Firefox</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-safari mr-2"></i>Safari</li>
        </ul>
    </div>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        あそびかた
    </h3>

    <p>
        iMAZEは，オリジナルの画像付きクイズ（謎解き）を投稿したり，ほかの人が作った謎解きに解答することができる掲示板アプリです．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-user mr-1"></i>マイページ</span>では，あなたが投稿・解答したクイズの統計を見たり，あなたの過去の投稿やブックマークしたクイズを振り返ることができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-plus mr-1"></i>投稿を作成</span>では，あなたのオリジナルクイズを期限付きで投稿することができます．また，OpenAI社の生成AI「ChatGPT」を使って自動でクイズを投稿することができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-clock-rotate-left mr-1"></i>みんなの投稿</span>では，ほかのユーザーが投稿したクイズを閲覧したり，解答することができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-ranking-star mr-1"></i>ランキング</span>では，クイズの解答数や投稿数についてのランキングを掲載しています．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        お問い合わせについて
    </h3>

    <p>
        当サイト（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>）に関するお問い合わせは，Gメールアドレス：
    </p>
    <br>
    <div class="flex justify-center">
        <p class="px-2 font-bold">imaze.adm0108(at)gmail.com</p>
    </div>
    <br>
    <p>
        までお寄せください（迷惑メール防止のため，<span class="px-1 font-bold">&#064;</span>を<span class="px-1 font-bold">(at)</span>に置き換えて表示しています）．
        <br>
        お寄せいただいた問い合わせへの対応にはお時間をいただく場合がございます．また，お問い合わせの内容によっては回答いたしかねる場合があります．予めご了承ください．
    </p>

    </div>

    <style>
        p {
            font-size: 14px;
            line-height: 1.7;
            padding: 0 1.2rem;
            color: black;
        }
    </style>
</x-app-layout>
@endauth

<!--ゲストユーザー-->
@guest
<x-guest-layout>

    <div class="fixed z-20 bottom-4 right-4 top-btn">
        <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
    </div>
    
    <h2 class="text-black text-center text-xl font-bold my-8">このサイトについて</h2>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        推奨環境
    </h3>

    <div class="flex justify-center">
        <ul style="font-size: 18px; font-weight: bold; list-style: none; padding: 1rem; color: black;">
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-chrome mr-2"></i>Google Chrome</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-edge mr-2"></i>Microsoft Edge</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-firefox-browser mr-2"></i>Mozilla Firefox</li>
            <li style="padding-top: 0.5rem;"><i class="fa-brands fa-safari mr-2"></i>Safari (iOS/iPadOS/macOS)</li>
        </ul>
    </div>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        あそびかた
    </h3>

    <p>
        iMAZEは，オリジナルの画像付きクイズ（謎解き）を投稿したり，ほかの人が作った謎解きに解答することができる掲示板アプリです．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-user mr-1"></i>マイページ</span>では，あなたが投稿・解答したクイズの統計を見たり，あなたの過去の投稿やブックマークしたクイズを振り返ることができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-plus mr-1"></i>投稿を作成</span>では，あなたのオリジナルクイズを期限付きで投稿することができます．また，OpenAI社の生成AI「ChatGPT」を使って自動でクイズを投稿することができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-clock-rotate-left mr-1"></i>みんなの投稿</span>では，ほかのユーザーが投稿したクイズを閲覧したり，解答することができます．
    </p>
    <br>
    <p>
        <span class="font-bold mr-1"><i class="fa-solid fa-ranking-star mr-1"></i>ランキング</span>では，クイズの解答数や投稿数についてのランキングを掲載しています．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        お問い合わせについて
    </h3>

    <p>
        当サイト（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>）に関するお問い合わせは，Gメールアドレス：
    </p>
    <br>
    <div class="flex justify-center">
        <p class="px-2 font-bold">imaze.adm0108(at)gmail.com</p>
    </div>
    <br>
    <p>
        までお寄せください（迷惑メール防止のため，<span class="px-1 font-bold">&#064;</span>を<span class="px-1 font-bold">(at)</span>に置き換えて表示しています）．
        <br>
        お寄せいただいた問い合わせへの対応にはお時間をいただく場合がございます．また，お問い合わせの内容によっては回答いたしかねる場合があります．予めご了承ください．
    </p>



    <style>
        p {
            font-size: 14px;
            line-height: 1.7;
            padding: 0 1.2rem;
            color: black;
        }
    </style>
</x-guest-layout>
@endguest