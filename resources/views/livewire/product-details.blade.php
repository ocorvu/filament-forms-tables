<div class="w-3/4 m-auto mt-10 p-6 border-2 border-indigo-300 rounded-md">
    <div class="flex justify-between">
        <div>
            <h1 class="text-xl font-bold">{{ $name }}</h1>
            <h2 class="italic font-sans text-sm">GTIN: {{ $barcode }}</h2>
            <h3><a href="{{ route('categories.details', $category->id) }}" class="rounded-lg bg-cyan-300 px-2 border-2 border-cyan-500">{{ $category->name }}</a></h3>
        </div>
        <div>
            <img class="w-24" src="{{ $thumbnail ? asset("{$thumbnail}") : asset("storage/thumbnails/placeholder-thumbnail-document.png")}}" alt="{{ $name }} thumbnail">
            <img class="w-24 mt-2" src="{{$barcode_image}}" alt="">
        </div>
    </div>

    <p class="mt-2">Quantity: {{ $quantity }}</p>
    <p class="mt-2">Price: {{ $price }}</p>
    <p class="mt-10 italic">{{ $description }}</p>
</div>
