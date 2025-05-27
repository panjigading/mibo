<x-layout>
    <h1 class="text-center text-3xl block mb-8">Edit Postingan Lama</h1>
    <form action="{{ route('post.update', ['id' => $post->id]) }}" method="POST" enctype=multipart/form-data x-data="imgPreview"  class="max-w-xl mx-auto">
        @csrf
        <img x-show="url" :src="url" alt="" class="mt-6 w-full max-h-80 block mx-auto object-contain border border-transparent bg-gray-100">
        <div class="flex gap-4 mx-auto w-fit mt-4">
            <label for="imgInput" id="uploadBtn" class="p-2 px-3 bg-black text-white rounded-sm cursor-pointer">Upload Foto</label>
            <input type="file" name="image" id="imgInput" x-on:change="setImg" class="hidden">
            <div x-show="url">
                <a href="{{ route('post.remove_image', ['id' => $post->id]) }}">
                    <button x-on:click=" url='' " class="p-2 px-3 bg-black text-white rounded-sm cursor-pointer">Hapus</button>
                </a>
            </div>
        </div>
        <div class="grid gap-4 mt-6">
            <label for="title">Judul</label>
            <input type="text" name="title" id="title" value="{{ $post->title }}"   class="p-3 bg-gray-100 rounded-sm">
            <label for="body">Isi</label>
            <textarea name="body" id="body" class="p-3 bg-gray-100 rounded-sm h-md">{{ $post->body }}</textarea>
            <input type="submit" value="Posting" class="p-3 bg-black text-white rounded-sm cursor-pointer mt-4">
        </div>
    </form>
        <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imgPreview', (imgUrl = '') => ({
                url: '{{ $post->image ? Storage::url($post->image): "" }}',
                setImg() {
                    if (this.url) {
                        URL.revokeObjectURL(this.url);
                    }
                    const file = document.getElementById('imgInput').files[0];
                    this.url = URL.createObjectURL(file);
                }
            }))
        });
        const imgInput = document.getElementById('imgInput');
        const uploadBtn = document.getElementById('uploadBtn');

        uploadBtn.addEventListener('click', () => {
            imgInput.click();
        });
    </script>
</x-layout>