<script>
    $(document).on('click', '.btn-wishlist', function () {
        var user_id = "{{Session::get('user_id')}}";
        var button = $(this)
        var listed = button.hasClass( "not_listed" );
        if(user_id == ""){
            $('#modal-must-login').modal('show');
        }else{
            var product_id = $(this).closest(".product-card-wrap").data('id');
            var url = "{{env('URL_API')}}/" + "updateWishlist";
            $.post(url, {
                product_id: product_id,
                customer_id: user_id,
            }).done(function (data) {
                if(data.isSuccess){
                    if(data.update == 1){
                        button.removeClass('not_listed');
                        button.addClass('listed');
                        Swal.fire({
                        icon: 'success',
                        title: 'Produk berhasil ditambahkan ke wishlist'
                    })
                    }else{
                        button.removeClass('listed');
                        button.addClass('not_listed');
                        Swal.fire({
                        icon: 'success',
                        title: 'Produk berhasil dihapus dari wishlist'
                    })
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'
                    })
                }
            });
        }
    });
</script>