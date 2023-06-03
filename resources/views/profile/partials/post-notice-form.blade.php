<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('投稿の通知') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('登録したメールアドレスで新規投稿の通知を受け取ることができます．') }}
        </p>
    </header>

    <form method="POST" action="{{ route('profile.notice') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if ($post_notice_status === 'OFF')
        <input class="hidden" name="post_notice" value="ON">
            <div class="flex justify-center items-center gap-4">
                <p class="text-black">現在の設定：{{ $post_notice_status }}</p>
                <x-primary-button>通知をONにする</x-primary-button>
            </div>
        @elseif ($post_notice_status === 'ON')
            <input class="hidden" name="post_notice" value="OFF">
            <div class="flex justify-center items-center gap-4">
                <p class="text-black">現在の設定：{{ $post_notice_status }}</p>
                <x-primary-button>通知をOFFにする</x-primary-button>
            </div>
        @endif
    </form>
</section>