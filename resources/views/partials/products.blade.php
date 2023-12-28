@forelse($products as $product)
    <div class="card columns four product-card" >
        <div class="product-card-content" onclick="showProduct({{ $product['id'] }})">
            <img src="{{ isset($product['image']['src']) ? $product['image']['src'] : 'https://png.pngtree.com/png-clipart/20190831/ourmid/pngtree-transparent-bubble-combination-png-image_1717915.jpg' }}" alt="Denim Jeans" style="width:100%">
            <h1>{{ @$product['title'] }}</h1>
            <p class="price">{{ @$product['variants'][0]['price'] }}</p>
        </div>
        <hr>
        <div class="product-card-footer">
            <button type="button" class="secondary icon-edit product-edit-button"
                    onclick="editProduct({{ $product['id'] }})"
            ></button>
            <button type="button" class="warning icon-trash product-delete-button"
                    onclick="deleteProduct({{ $product['id'] }})"></button>
        </div>
    </div>
@empty
    <p class="">No Products Available</p>
@endforelse


{{ $products->links() }}
