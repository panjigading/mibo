<x-layout>
    <h1 class="text-3xl text-center my-4 mb-10">Postingan Terbaru</h1>
    @auth
        <p class="my-4">
            <a href="{{ route('post.make') }}" class="p-2 px-3 bg-yellow-300 rounded-sm">Buat Post</a>
        </p>
    @endauth
    @if ($posts->isEmpty())
        <p class="text-center italic">Belum ada post</p>
    @else
        <ul class="border border-b-0">
            @foreach ($posts as $post)
            <li class="p-6 border-b">
                <p class="mb-2">
                    <a class="underline" href="{{ route('user', ['username' => $post->username]) }}">u/{{ $post->username }}</a>
                    - {{ $post->display_name }}
                </p>
                <h2 class="mb-2"><a class="font-semibold" href="{{ route('post', ['id' => $post->id]) }}"">{{ $post->title }}</a></h2>
                <p>{{ Str::limit($post->body, 200, '...', preserveWords: true) }}</p>
            </li>
            @endforeach
        </ul>
    @endif
</x-layout>