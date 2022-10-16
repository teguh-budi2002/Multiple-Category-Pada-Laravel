@extends('app')
@section('content')
<div class="w-full h-full">
    <!-- component -->
    <div class="flex flex-col items-center justify-center p-12">
        @if ($errors->any())
        <div class="bg-red-300 rounded text-red-600 p-2">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
        @endif
        <div class="mx-auto w-full max-w-[550px]">
            @foreach ($posts as $post)
                <form action="{{ URL('/post/' . $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-5">
                        <label for="name" class="mb-3 block text-base font-medium text-gray-500">
                            Tittle
                        </label>
                        <input type="text" name="title" id="name" placeholder="Your title post..."
                            value="{{ old('title', $post->title) }}"
                            class="w-full rounded-md border border-white bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-violet-500 focus:shadow-md" />
                    </div>
                    <div class="select-categories mb-5">
                        <label for="selectCategory" class="mb-3 block text-base font-medium text-gray-500">Category</label>
                        <select class="js-example-basic-multiple w-full" name="category_id[]" multiple="multiple"
                            id="selectCategory">
                            @foreach ($post->categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, $post->categories->pluck('id')->toArray()) ? "selected" : '' }}>
                                {{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-5">
                        <label for="email" class="mb-3 block text-base font-medium text-gray-500">
                            Description
                        </label>
                        <textarea rows="4" name="description" id="description" placeholder="Type your article"
                            class="w-full resize-none rounded-md border border-white bg-white py-3 px-6 text-base font-medium text-gray-500 outline-none focus:border-violet-500 focus:shadow-md">{{ $post->description }}</textarea>
                    </div>
                    <div>
                        <button type="submit"
                            class="hover:shadow-form rounded-md bg-violet-500 py-3 px-8 text-base font-semibold text-white outline-none">
                            Submit
                        </button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.js-example-basic-multiple').select2();
    });

</script>
@endsection
