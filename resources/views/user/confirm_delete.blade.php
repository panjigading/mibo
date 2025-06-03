<x-layout>
    <div class="max-w-xl mx-auto">
        <h1 class="text-2xl text-center mb-4">Beneran mau hapus Akun?</h1>
        <form action="{{ route('user.confirm_delete') }}" method="POST" class="flex gap-2 w-fit mx-auto ">
        @csrf
            <a href="{{ route('posts') }}" class="p-1 px-4 bg-black text-white rounded-sm mr-4 cursor-pointer">Ga Jadi</a>
            <input type="submit" value="Iya" class="p-1 px-4 border rounded-sm mr-4 border-red-500 text-red-500 cursor-pointer">
        </form>
    </div>
</x-layout>