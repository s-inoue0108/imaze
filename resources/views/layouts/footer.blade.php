<footer class="footer justify-center sm:justify-normal items-center p-4 bg-yellow-400 text-black mt-8">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('welcome') }}">
                <x-application-logo width="100" class="block h-9 w-auto fill-current" />
            </a>
            <div class="flex flex-col lg:flex-row ml-4 font-semibold">
                <p>Copyright &copy; <?php echo date('Y'); ?></p>
                <p class="lg:ml-2"><a href="http://si-library.net" target="_blank" rel="noopener noreferrer" class="link link-hover">S.Inoue</a>
                <span class="ml-2">All rights reserved.</span></p>
            </div>
        </div>
    </div>
    <div class="flex gap-8">
        <a href="{{ route('info.privacy') }}" class="text-xs link link-hover">プライバシーポリシー</a>
        <a href="{{ route('info.about') }}" class="text-xs link link-hover">このサイトについて</a>
    </div>
    <div class="grid-flow-col gap-8 items-center justify-self-center sm:justify-self-end">
        <a href="https://twitter.com/Rebel_in_math" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-2xl fa-twitter"></i></a> 
        <a href="https://www.youtube.com/channel/UCpW3S0yT0SSrUhz76Xmf8Hg" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-2xl fa-youtube"></i></a>
        <a href="http://si-library.net" target="_blank" rel="noopener noreferrer"><i class="fa-solid fa-2xl fa-paperclip"></i></a>
        <a href="https://sv-evolve-lab.com" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-2xl fa-wordpress"></i></a>
    </div>
</footer>