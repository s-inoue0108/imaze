@section('title', 'プライバシーポリシー')

<!--登録ユーザー-->
@auth
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-black leading-tight">
            {{ __('プライバシーポリシー') }}
        </h2>
    </x-slot>

    <div class="wrapper">

        <div class="fixed z-20 bottom-4 right-4 top-btn">
            <a href="#"><button class="btn btn-circle"><i class="fa-solid fa-chevron-up"></i></button></a>
        </div>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        個人情報について
    </h3>

    <p>
        iMAZE（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>，以降「当サイト」とする）では，当サイトが提供するサービス（ユーザー認証）のために，個人を特定できる情報（メールアドレス，パスワード）を収集しています．
        収集した情報については，当サイトで提供されるサービスの範疇を超えて利用することはありません．
        <br>
        また，<a href="{{ route('profile.edit') }}" class="text-blue-600 link link-hover">アカウントぺージ</a>からユーザーアカウントの削除を行うことで，当サイトのユーザー登録に用いた個人情報の抹消を申請できるものとします．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        サイト利用について
    </h3>

    <p>
        当サイトの利用において，以下の各項の内容に該当するものが発見された場合には，当サイト運営者によって然るべき対応を取らせていただきます．
        <div class="flex justify-center">
            <ul style="font-size: 14px; list-style: disc; padding: 2rem; color: black;">
                <li style="padding-top: 0.5rem;">個人や法人を特定するような内容，または誹謗中傷するようなもの</li>
                <li style="padding-top: 0.5rem;">公序良俗に反するような内容や，犯罪行為を示唆するもの</li>
                <li style="padding-top: 0.5rem;">その他，当サイト管理人が不適切であると判断したもの</li>
            </ul>
        </div>
    </p>


    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        著作権について
    </h3>

    <p>
        当サイトのコンテンツ（文章，画像など）に係る著作権は，原則として当サイトの運営者に帰属します．
        <br>
        万が一，著作権法の制限する範囲を超えて当サイトのコンテンツを利用した場合，著作権者たる当サイトの運営者によって然るべき措置を取らせていただく場合があります．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        リンクについて
    </h3>

    <p>
        当サイトは「リンクフリー」であり，他のサイトからのリンクを行う際，当サイト運営者への許可を不要とします．
        ただし，当サイトで用いられている画像コンテンツにつきましては，リンクを行う際に出典（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>）を必要とするものとします．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        免責事項
    </h3>

    <p>
        当サイトに掲載された内容によって発生した損害につきましては，当サイトの運営者は一切の責任を負いかねます．
        また，当サイトのリンク等から移動した他サイトにおいて発生した損害についても同様に，当サイトの運営者は一切の責任を負いかねます．
        <br>
        加えて，当サイトに掲載されている情報につきましては，必ずしも正確な内容を保証するものではないことをご了承ください．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        プライバシーポリシーの変更について
    </h3>

    <p>
        プライバシーポリシーは予告なく変更される場合がございます．
        変更があった場合，当サイトを利用するユーザーは変更後のプライバシーポリシーに同意したものとみなします．
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

    <h2 class="text-black text-center text-xl font-bold my-8">プライバシーポリシー</h2>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        個人情報について
    </h3>

    <p>
        iMAZE（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>，以降「当サイト」とする）では，当サイトが提供するサービス（ユーザー認証）のために，個人を特定できる情報（メールアドレス，パスワード）を収集しています．
        収集した情報については，当サイトで提供されるサービスの範疇を超えて利用することはありません．
        <br>
        また，<a href="{{ route('profile.edit') }}" class="text-blue-600 link link-hover">アカウントぺージ</a>からユーザーアカウントの削除を行うことで，当サイトのユーザー登録に用いた個人情報の抹消を申請できるものとします．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        サイト利用について
    </h3>

    <p>
        当サイトの利用において，以下の各項の内容に該当するものが発見された場合には，当サイト運営者によって然るべき対応を取らせていただきます．
        <div class="flex justify-center">
            <ul style="font-size: 14px; list-style: disc; padding: 2rem; color: black;">
                <li style="padding-top: 0.5rem;">個人や法人を特定するような内容，または誹謗中傷するようなもの</li>
                <li style="padding-top: 0.5rem;">公序良俗に反するような内容や，犯罪行為を示唆するもの</li>
                <li style="padding-top: 0.5rem;">その他，当サイト管理人が不適切であると判断したもの</li>
            </ul>
        </div>
    </p>


    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        著作権について
    </h3>

    <p>
        当サイトのコンテンツ（文章，画像など）に係る著作権は，原則として当サイトの運営者に帰属します．
        <br>
        万が一，著作権法の制限する範囲を超えて当サイトのコンテンツを利用した場合，著作権者たる当サイトの運営者によって然るべき措置を取らせていただく場合があります．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        リンクについて
    </h3>

    <p>
        当サイトは「リンクフリー」であり，他のサイトからのリンクを行う際，当サイト運営者への許可を不要とします．
        ただし，当サイトで用いられている画像コンテンツにつきましては，リンクを行う際に出典（<a href="https://imaze-app.com" class="text-blue-600 link link-hover">https://imaze-app.com</a>）を必要とするものとします．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        免責事項
    </h3>

    <p>
        当サイトに掲載された内容によって発生した損害につきましては，当サイトの運営者は一切の責任を負いかねます．
        また，当サイトのリンク等から移動した他サイトにおいて発生した損害についても同様に，当サイトの運営者は一切の責任を負いかねます．
        <br>
        加えて，当サイトに掲載されている情報につきましては，必ずしも正確な内容を保証するものではないことをご了承ください．
    </p>

    <h3 class="text-black text-center font-bold underline underline-offset-4 my-8">
        <i class="fa-solid fa-circle-info mr-1"></i>
        プライバシーポリシーの変更について
    </h3>

    <p>
        プライバシーポリシーは予告なく変更される場合がございます．
        変更があった場合，当サイトを利用するユーザーは変更後のプライバシーポリシーに同意したものとみなします．
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