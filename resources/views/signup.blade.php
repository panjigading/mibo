<x-layout>
    <h1 class="text-center text-3xl block mb-8">Sign Up</h1>
    <form action="{{ route('signup') }}" method="POST" enctype=multipart/form-data x-data="imgPreview" class="max-w-xl mx-auto">
        @csrf
        <img :src="url" alt="" class="w-40 h-40 block mx-auto mb-6 object-cover border border-transparent bg-gray-100 rounded-full">
        <div class="flex gap-4 mx-auto w-fit">
            <label for="imgInput" id="uploadBtn" class="p-2 px-3 bg-black text-white rounded-sm cursor-pointer">Upload Foto</label>
            <input type="file" name="profile_picture" id="imgInput" x-on:change="setImg" class="hidden">
            <div x-show="url">
                <button x-on:click=" url='' " class="p-2 px-3 bg-black text-white rounded-sm cursor-pointer">Hapus</button>
            </div>
        </div>
        <div class="grid gap-4 mt-6">
            <label for="display_name">Display Name</label>
            <input type="text" name="display_name" id="display_name" class="p-3 bg-gray-100 rounded-sm">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="p-3 bg-gray-100 rounded-sm">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="p-3 bg-gray-100 rounded-sm">
            <input type="submit" value="Sign Up" class="p-3 bg-black text-white rounded-sm cursor-pointer mt-4">
        </div>
    </form>
        <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('imgPreview', (imgUrl = '') => ({
                url: '',
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