@extends('app')
@section('content')
<div class="w-full h-screen flex flex-col justify-center items-center">
    <div class="w-96 h-auto p-2 text-center  bg-white rounded shadow-md shadow-gray-400">
        <p class="font-semibold text-xl text-gray-600">Your Collection Post</p>
        <a href="{{ URL('/post/create') }}" class="py-2.5 px-5 block mt-2 rounded bg-blue-500 text-white">Create Post</a>
    </div>
    @if ($mess = Session::get('success'))
    <div class="mt-2 w-full flex justify-center">
        <div class="w-3/4 h-auto p-2 rounded bg-green-300 text-green-700">
            <p class="text-center">{{ $mess }}</p>
        </div>
    </div>
    @elseif ($mess = Session::get('update'))
    <div class="mt-2 w-full flex justify-center">
        <div class="w-3/4 h-auto p-2 rounded bg-green-300 text-green-700">
            <p class="text-center">{{ $mess }}</p>
        </div>
    </div>
    @elseif ($mess = Session::get('delete'))
    <div class="mt-2 w-full flex justify-center">
        <div class="w-3/4 h-auto p-2 rounded bg-red-300 text-red-700">
            <p class="text-center">{{ $mess }}</p>
        </div>
    </div>
    @endif
    <div class="table w-full p-2 px-8 mt-5">
        <table class="w-full border shadow-md shadow-gray-400 rounded-md">
            <thead>
                <tr class="bg-white border-b">
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Title
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Slug
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Description
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Category
                        </div>
                    </th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">
                        <div class="flex items-center justify-center">
                            Action
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                            </svg>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="bg-gray-100 text-center border-b text-sm text-gray-600">
                    <td class="p-2 border-r">{{ $post->title }}</td>
                    <td class="p-2 border-r">{{ $post->slug }}</td>
                    <td class="p-2 border-r">{{ $post->description }}</td>
                    <td class="p-2 border-r">
                        @foreach ($post->categories as $category)
                        <span class="py-0.5 px-4 bg-red-500 text-white rounded">{{ $category->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ URL('/post/' . $post->id . '/edit') }}" class="bg-blue-500 p-2 block text-white hover:shadow-lg text-xs font-thin">Edit</a>
                        <form action="{{ URL('/post/' . $post->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 w-full p-2 text-white hover:shadow-lg text-xs font-thin block mt-2 mb-2">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
