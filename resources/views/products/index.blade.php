@extends('shopify-app::layouts.default')

@section('content')
    <div class="container">
        <h1>Products List</h1>
        <div class="row">
            <div class="navigationButton">
                    <button class="icon-addcircle" id="create-button"></button>
            </div>
        </div>

        @include('partials.sessionMessages')
        <div class="row" id="productsPage">
            @include('partials.products')
        </div>
        @include('partials.showProductModal')
        @include('partials.createProductModal')
        @include('partials.editProductModal')
    </div>



    <script>

        $(document).ready(function () {
            // Create Product Modal on click of create button
            $(document).on('click', '#create-button', function () {
                $('#createProductModal').css('display', 'block');
            });

            // Store a New Product
            $('#createProductForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: '/store-product',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.success,
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: JSON.parse(error.responseText).error,
                            showConfirmButton: true,
                        });
                        console.error('Error creating product:', error);
                    }
                });
            });


            // Close Button and window click Functionality
            $(document).on('click', '.close', function () {
                $('#createProductModal').css('display', 'none');
                $('#editProductModal').css('display', 'none');
                $('#showProductModal').css('display', 'none');
            });
            $(window).on('click', function(event) {
                var modals = $('.modal');
                modals.each(function(index, modal) {
                    if (event.target == modal) {
                        $(modal).css('display', 'none');
                    }
                });
            });


            //Pagination Logic
            $(document).on('click', '.pagination a', function (event) {
                event.preventDefault();
                let page = $(this).attr('href').split('page=')[1];
                $.ajax({
                    url: '/?page=' + page,
                    method: 'GET',
                    success: function(response) {
                        $('#productsPage').empty().html(response);
                    },
                    error: function(error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: 'Something Went Wrong!',
                            showConfirmButton: true,
                        });
                    }
                });
            });


        });

        // Edit Product In Modal
        function editProduct(productID) {
            $.ajax({
                url: '/edit-product/' + productID,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (html) {
                    // Edit Product Modal on click of any Product
                    $('#editProductModalBody').html(html);
                    $('#editProductModal').css('display', 'block');
                },
                error: function (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: JSON.parse(error.responseText).error,
                        showConfirmButton: true,
                    });
                    console.error('Error fetching product details:', error);
                }
            });
        }


        // update the Product
        $(document).on('submit', '#editProductForm', function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: '/update-product',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: response.success,
                        showConfirmButton: true,
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        allowEnterKey: true,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            location.reload();
                        }
                    });
                },
                error: function(error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: JSON.parse(error.responseText).error,
                        showConfirmButton: true,
                    });
                    console.error('Error editing product:', error);
                }
            });
        });




        // Show Product In Modal
        function showProduct(productID) {
            $.ajax({
                url: '/show-product/' + productID,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (html) {
                    // Show Product Modal on click of any Product
                    $('#showProductModalBody').html(html);
                     $('#showProductModal').css('display', 'block');
                },
                error: function (error) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: JSON.parse(error.responseText).error,
                        showConfirmButton: true,
                    });
                    console.error('Error fetching product details:', error);
                }
            });
        }


        // Delete the Product
        function deleteProduct(productId) {
            if (confirm('Are you sure you want to delete this product?')) {
                $.ajax({
                    url: '/delete-product/' + productId,
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function (response) {
                        Swal.fire({
                            icon: 'success',
                            title: response.success,
                            showConfirmButton: true,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: true,
                        }).then((result) => {
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        });
                        console.log('Product deleted successfully:', response);
                    },
                    error: function (error) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: JSON.parse(error.responseText).error,
                            showConfirmButton: true,
                        });
                    }
                });
            }
        }


    </script>
@endsection
