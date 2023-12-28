<form id="editProductForm">
    <input type="hidden" value="{{ $product['id'] }}" name="id">
    <label for="title">Product Name:</label>
    <input type="text" id="title" name="title" value="{{ @$product['title'] }}" required><br><br>
    <label for="body_html">Product Body</label>
    <input type="text" id="body_html" name="body_html" value="{!! @$product['body_html'] !!}" required><br><br>

    <label for="vendor">Vendor</label>
    <input type="text" id="vendor" name="vendor" value="{{ @$product['vendor'] }}" required><br><br>

    <label for="product_type">Product Type</label>
    <input type="text" id="product_type" name="product_type" value="{{ @$product['product_type'] }}" required><br><br>

    <label for="status">Product Status</label>
    <select id="status" name="status" required>
        <option value="active" {{ @$product['status'] === 'active' ? 'selected' : '' }}>Active</option>
        <option value="draft" {{ @$product['status'] === 'draft' ? 'selected' : '' }}>Draft</option>
        <option value="archived" {{ @$product['status'] === 'archived' ? 'selected' : '' }}>Archived</option>
    </select>

    {{--    <label for="image">Product Image:</label>--}}
    {{--    <input type="file" id="image" name="image"><br><br>--}}

    <button type="submit">Submit</button>
</form>
