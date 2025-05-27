<x-layout>
    <h1></h1>
    <form action="{{ route('user.confirm_delete') }}" method="POST">
    @csrf
        <a href="{{ route('posts') }}">Ga Jadi</a>
        <input type="submit" value="Iya">
    </form>
</x-layout>