<form id="createProductForm">
    <label for="title">Product Name:</label>
    <input type="text" id="title" name="title" required><br><br>
    <label for="body_html">Product Body</label>
    <input type="text" id="body_html" name="body_html" required><br><br>

    <label for="vendor">Vendor</label>
    <input type="text" id="vendor" name="vendor" required><br><br>

    <label for="product_type">Product Type</label>
    <input type="text" id="product_type" name="product_type" required><br><br>

    <label for="status">Product Status</label>
    <select name="status" required>
        <option value="active">Active</option>
        <option value="draft">Draft</option>
        <option value="archived">Archived</option>
    </select>

{{--    <label for="image">Product Image:</label>--}}
{{--    <input type="file" id="image" name="image"><br><br>--}}

    <button type="submit">Submit</button>
</form>
