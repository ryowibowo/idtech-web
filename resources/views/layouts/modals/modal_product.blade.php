<!-- modal product -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="container">
                    <div class="row">
                        <div class="col-3 no-padding">
                            <div class="img-product-modal">
                                <img id="product_image" class="img-thumbnail card-img-top smallimg" src="assets/img/img-default.jpg" alt="" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="card-block card-modal no-padding">
                                <h4 id="product_name" style="margin-bottom: 5px;">Lorem Ipsum</h4>
                                <span id="product_price_before_discount" style="font-size: 12px; margin-left: 5px; text-decoration-line: line-through;">Rp 20.000 - Rp 25.000</span>
                                <h5 id="product_price_after_discount" style="margin-top: 0px;">Rp 20.000 - Rp 25.000</h5>
                                <p class="color-red" id="product_stock">Stok: Pilih varian terlebih dulu</p>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container no-padding">
                    <div class="btn-group-toggle" data-toggle="buttons">
                        <div class="varian-wrap">
                            <h4 class="color-primary">Lokasi Gudang <span class=""></span></h4>
                            <div id="varian_product"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <p>Total</p>
                                    </div>
                                    <div class="col-sm-8 no-padding">
                                        <div class="add-cart">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <button type="button" id="minus" class="btn btn-default btn-number btn-left" data-type="minus">
                                                        <i class="ic-cart-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" id="quantity" name="quantity" class="form-control input-number" onchange="ubahQuantity()" />
                                                <span class="input-group-btn">
                                                    <button type="button" id="plus" class="btn btn-default btn-number btn-right" data-type="plus">
                                                        <i class="ic-cart-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-sm-12" style="text-align: center;">
                        <span style="color: red; font-size: 12px; font-family: sans-serif; text-align: center;" id="status_message_add_tocart"></span>
                    </div>
                </div>
                <form action="#" id="form_submit_add_cart" method="POST">
                    <input type="hidden" id="warehouse_id" name="warehouse_id" />
                    <input type="hidden" id="warehouse_name" name="warehouse_name" />
                    <input type="hidden" id="product_id" name="product_id" />
                    <input type="hidden" id="product_names" name="product_names" />
                    <input type="hidden" id="product_images" name="product_images" />
                    <input type="hidden" id="price_before_discounts" name="price_before_discounts" />
                    <input type="hidden" id="price" name="price" />
                    <input type="hidden" id="stock" name="stock" />
                    <input type="hidden" id="qty" name="qty" />
                    <input type="hidden" id="oums" name="oums" />
                    <input type="hidden" id="oum_values" name="oum_values" />
                    <input type="hidden" id="url_existing" name="url_existing" />
                    <div class="modal-footer no-border">
                        <button type="submit" id="add_cart" class="btn btn-primary btn-block">Tambahkan di Keranjang</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    var user_id = "{{Session::get('user_id')}}";
    $(document).on('click', '.open_modal_product', function () {
        if(user_id == ""){
            $('#modal-must-login').modal('show');
        }else{
            var product_stock = $(this).data('stock');
            if(product_stock != "0"){
                $('body').removeClass('loaded');
                $('#stock').val(0);
                $('#quantity').val(1);
                $('#qty').val(1);
                $('#add_cart').attr("disabled", true);
                $('#minus').attr("disabled", true);
                $('#plus').attr("disabled", true);
                $('#minus').attr("style", "cursor: not-allowed;"); 
                $('#plus').attr("style", "cursor: not-allowed;"); 

                var product_id = $(this).data('id');

                var url = "{{env('URL_API')}}/" + "productbyid/0";
                $.post(url, {
                    product_id: product_id,
                }).done(function (data) {
                    $('#product_image').attr("src", data.data[0].product_image);
                    $('#product_name').text(data.data[0].product_name);
                    $('#product_price_before_discount').text(data.data[0].product_price_before_discount);
                    if (data.data[0].product_discount == 0) {
                        $('#product_price_before_discount').css("display", "none");
                    } else {
                        $('#product_price_before_discount').css("display", "block");
                    }
                    $('#product_price_after_discount').text(data.data[0].product_price_after_discount);
                    $('#product_stock').text("Stok: Pilih varian terlebih dulu");

                    //warehouse
                    var i;
                    var html = "";
                    console.log(data.data[0].warehouse.length);
                    for (i = 0; i < data.data[0].warehouse.length; i++) {
                        var product_image = data.data[0].product_image;
                        var product_name = data.data[0].product_name;
                        var warehouse_kota_name = data.data[0].warehouse[i].warehouse_kota_name == null ? "" : data.data[0].warehouse[i].warehouse_kota_name;
                        var warehouse_provinsi_name = data.data[0].warehouse[i].warehouse_provinsi_name == null ? "" : data.data[0].warehouse[i].warehouse_provinsi_name;
                        html += '<h5>' + data.data[0].warehouse[i].warehouse_name + '</h5>';
                        html += '<p>' + warehouse_kota_name.toLowerCase() + ', ' + warehouse_provinsi_name.toLowerCase() + '</p>';
                        html += '<div class="toggle-wrap">';
                        html += '<div class="container no-padding">';
                        html += '<div class="row row-toggle ">';
                        var j;
                        for (j = 0; j < data.data[0].warehouse[i].varian.length; j++) {
                            var str = data.data[0].warehouse[i].warehouse_name;
                            var warehouse_name = str.replace(" ", "_");
                            var oum = data.data[0].warehouse[i].varian[j].varian_uom;
                            var oum_value = data.data[0].warehouse[i].varian[j].varian_weight;
                            html += '<div class="col-sm-6 padding-selected" onclick="chooseVarian(' + data.data[0].warehouse[i].varian[j].warehouse_id + ', ' + data.data[0].warehouse[i].varian[j].product_id + ', ' + data.data[0].warehouse[i].varian[j].varian_price_before_discount + ', ' + data.data[0].warehouse[i].varian[j].varian_price_after_discount + ', ' + data.data[0].warehouse[i].varian[j].varian_stock + ', ' + "'" + data.data[0].warehouse[i].warehouse_name + "'" + ', ' + "'" + product_image + "'" + ', ' + "'" + product_name + "'" + ', ' + "'" + oum + "'" + ', ' + "'" + oum_value + "'" + ')">';
                            html += '<label class="btn btn-block btn-selected">';
                            html += '<input type="radio" name="options" id="option1"> ' + data.data[0].warehouse[i].varian[j].varian_name + ' ' + data.data[0].warehouse[i].varian[j].varian_weight + '' + data.data[0].warehouse[i].varian[j].varian_uom;
                            html += '</label>';
                            html += '</div>';
                        }
                        html += '</div>';
                        html += '</div>';
                        html += '</div>';
                    }
                    $('#exampleModalLong').modal('show');
                    $('#varian_product').html(html);
                    $('body').addClass('loaded');
                });
            }
        }
    });
</script>

<script>
    $(document).on('click', '#plus', function () {
        var quantity = $('#quantity').val();
        var stock_plus = $('#stock').val();
        $('#minus').removeAttr('disabled');
        $('#minus').attr("style", "cursor: normal;");
        document.getElementById("status_message_add_tocart").innerHTML = "";
        if(parseInt(quantity) >= parseInt(stock_plus)){
            $('#plus').attr("disabled", true);
            $('#plus').attr("style", "cursor: not-allowed;"); 
        }else{
            $('#plus').removeAttr('disabled');
            $('#plus').attr("style", "cursor: normal;"); 

            var qtyplus = parseInt(quantity)+1;
            $('#quantity').val(qtyplus);
            $('#qty').val(qtyplus);
        }
    });

    $(document).on('click', '#minus', function () {
        var quantity = $('#quantity').val();
        var stock_minus = $('#stock').val();
        $('#plus').removeAttr('disabled');
        $('#plus').attr("style", "cursor: normal;");
        if(parseInt(quantity) <= 1){
            $('#minus').attr("disabled", true);
            $('#minus').attr("style", "cursor: not-allowed;"); 
        }else{
            if(parseInt(quantity) >= parseInt(stock_minus)+1){
                console.log('masuk sini ajg');
                $('#plus').attr("disabled", true);
                $('#plus').attr("style", "cursor: not-allowed;"); 
                $('#add_cart').attr("disabled", true);
                document.getElementById("status_message_add_tocart").innerHTML = "Jumlah tidak boleh melebihi stock";
            }else{
                $('#plus').removeAttr('disabled');
                $('#plus').attr("style", "cursor: normal;");
                $('#minus').removeAttr('disabled');
                $('#minus').attr("style", "cursor: normal;");
                $('#add_cart').removeAttr("disabled");
                document.getElementById("status_message_add_tocart").innerHTML = "";
            }
            var qtyminus = parseInt(quantity)-1;
            $('#quantity').val(qtyminus);
            $('#qty').val(qtyminus);
        }
    });
</script>

<script>
    function ubahQuantity(){
        var quantity = $('#quantity').val();
        var stock_edit = $('#stock').val();
        if(parseInt(quantity) >= parseInt(stock_edit)){
            document.getElementById("status_message_add_tocart").innerHTML = "Jumlah tidak boleh melebihi stock";
            $('#add_cart').attr("disabled", true);
            $('#minus').removeAttr("disabled");
            $('#plus').attr("disabled", true);
            $('#minus').attr("style", "cursor: normal;"); 
            $('#plus').attr("style", "cursor: not-allowed;"); 
        }
    }
</script>

<script>
    function chooseVarian(warehouse_id, product_id, price_before_discount, price_after_discount, stock, warehouse_name, product_image, product_name, oum, oum_value) {
        $('body').removeClass('loaded');
        $('#plus').removeAttr('disabled');
        if(stock > 0 ){
            $('#quantity').val(1);
            $('#add_cart').removeAttr('disabled');
        }else{
            $('#quantity').val(0);
            $('#add_cart').attr("disabled", true);
        }
        $('#qty').val(1); 
        $('#plus').attr("style", "cursor: normal;"); 
        //change view
        $('#product_price_before_discount').text("Rp. " + numberWithCommas(price_before_discount));
        $('#product_price_after_discount').text("Rp. " + numberWithCommas(price_after_discount));
        $('#product_stock').text(stock);

        //for post to cart
        $('#warehouse_id').val(warehouse_id);
        $('#warehouse_name').val(warehouse_name);
        $('#product_id').val(product_id);
        $('#product_names').val(product_name);
        $('#product_images').val(product_image);
        $('#price_before_discounts').val(price_before_discount);
        $('#price').val(price_after_discount);
        $('#stock').val(stock);
        $('#oums').val(oum);
        $('#oum_values').val(oum_value);

        var url_existing = window.location.href;
        $('#url_existing').val(url_existing);

        $('body').addClass('loaded');
//        $('#exampleModalLong').modal('show');
    }
</script>

<script>
    $('#form_submit_add_cart').submit(function (e) {
        e.preventDefault();
        console.log($(this).serialize());
        var user_id = "{{Session::get('user_id')}}";
        e.preventDefault();
        if (user_id == "") {
            $('#modal-must-login').modal('show');
        }else{
            $('body').removeClass('loaded');
            $.ajax({
                type: "POST",
                url: "{{url('beranda/addToCart')}}",
                data: $(this).serialize(),
                success: function (r) {
                    $('body').addClass('loaded');
                    if (r.code != 200) {
                        document.getElementById("status_message_add_tocart").innerHTML = r.message;
                    } else {
                        if(r.isSuccess == true){
                            //$('#exampleModalLong').modal('hide');
                            //document.getElementById("status_message_add_tocart").innerHTML = "";
                            window.location = window.location.href;
                        }else{
                            $('#exampleModalLong').modal('show');
                            document.getElementById("status_message_add_tocart").innerHTML = r.message;
                        }
                    }
                }
            });
        }
    });
</script>


<div class="modal fade" id="modal-must-login" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-400 modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header no-border">
                <h4 class="modal-title w-100 text-center color-primary" id="exampleModalLabel">Konfirmasi </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <center><p> Anda belum login, silahkan login terlebih dahulu</p></center>
            </div>
            <div class="modal-footer no-border">
                <a class="btn btn-primary btn-block" data-dismiss="modal" id="button_warning_ok">OK</a>
            </div>
        </div>
    </div>
</div>
<script>
    $('#button_warning_ok').click(function (e){
        $('#modal-must-login').modal('hide');
        $('#modal-login').modal('show');
    });
</script>