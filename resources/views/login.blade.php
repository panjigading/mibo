<x-layout>
    <h1 class="text-center text-3xl block mb-8">Log In</h1>
    <form action="{{ route('login') }}" method="POST" class="max-w-xl mx-auto grid gap-4">
        @error('username')
        <p class="italic">Pengguna dengan username ini tidak ada di website ini</p>
        @enderror
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" id="username" class="p-3 bg-gray-100 rounded-sm">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="p-3 bg-gray-100 rounded-sm">
        <input type="submit" value="Log In" class="p-3 bg-black text-white rounded-sm cursor-pointer mt-4">
    </form>
</x-layout>