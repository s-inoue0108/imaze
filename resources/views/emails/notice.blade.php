<x-mail::message>
# 新しい投稿

新しい投稿があります！

<x-mail::panel>
{{ $name }}「{{ $title }}」
（{{ $deadline }} まで）
</x-mail::panel>

<x-mail::button :url="'https://imaze-app.com/quiz'">
このクイズに解答する！
</x-mail::button>

<br>
{{ config('app.name') }}（https://imaze-app.com）
</x-mail::message>
