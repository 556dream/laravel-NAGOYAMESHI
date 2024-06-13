<div class="container">
    <h2>カテゴリー</h2>
    @foreach ($categories as $category)
    <label class="block"><a href="{{ route('shops.index', ['category' => $category->id]) }}">{{ $category->name }}</a></lavel>
    @endforeach
</div>



