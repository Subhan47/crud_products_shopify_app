<div>
    <h2>{{ @$product['title'] }}</h2>
    <p class="product-card-text"><strong>Vendor:</strong> {{ @$product['vendor'] }}</p>
    <p class="product-card-text"><strong>Product Type:</strong> {{ @$product['product_type'] }}</p>
    <p class="product-card-text"><strong>Published Date:</strong> {{ @$product['published_at'] }}</p>

    <hr>

    <div class="product-card-text">
        {!! @$product['body_html'] !!}
    </div>

    <hr>

    <div class="product-card-text">
        <strong>Tags:</strong>
        @if(@$product['tags'])
            @foreach(explode(',', $product['tags']) as $tag)
                <span class="product-tag">{{ $tag }}</span>
            @endforeach
        @else
            <span class="product-tag">No tags available</span>
        @endif
    </div>

    <hr>

    <p class="product-card-text"><strong>Status:</strong> {{ @$product['status'] }}</p>
</div>






