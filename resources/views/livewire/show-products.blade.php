<div>
    <input wire:model="search" type="search" placeholder="Search products by name...">
    {{ $this->form }}
 
    <h1>Search Results:</h1>
    <ul>
        @foreach($products as $product)
        <li>{{ $product->name }}</li>
        @endforeach
    </ul>
</div>