<x-layout>
    <div class="flex mb-4 gap-4 items-center">
        <img src="{{ Storage::url($user->profile_picture) }}" alt="" class="w-40 h-40 rounded-full object-cover flex-initial">
        <div class="flex-1">
            <h1 class="text-3xl mb-2"><a href="{{ route('user.edit') }}">{{ $user->display_name }}</a></h1>
            <p class="underline"><a href="{{ route('user', ['username' => $user->username]) }}">u/{{ $user->username }}</a></p>
        </div>
        @if ($currentUser)
        <p class="flex-initial grid text-center gap-2">
            <a href="{{ route('user.logout') }}" class="p-1 px-4 border rounded-sm mr-4">Log Out</a>
            <a href="{{ route('user.confirm_delete') }}" class="p-1 px-4 border rounded-sm mr-4 border-red-500 text-red-500">Hapus</a>
        </p>
        @endif
    </div>
    <h2 class="font-semibold mb-4">Postingan Terbaru</h2>
    <ul class="border border-b-0">
        @if (empty($posts))
        <p>User don't have posts</p>
        @else
        @foreach ($posts as $post)
            <li class="p-6 border-b">
                <p class="mb-2">
                    <a class="underline" href="{{ route('user', ['username' => $user->username]) }}">u/{{ $user->username }}</a>
                    - {{ $user->display_name }}
                </p>
                <h2 class="mb-2"><a class="font-semibold" href="{{ route('post', ['id' => $post->id]) }}"">{{ $post->title }}</a></h2>
                <p>{{ Str::limit($post->body, 200, '...', preserveWords: true) }}</p>
            </li>
        @endforeach
        @endif
    </ul>
</x-layout>