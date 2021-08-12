<!-- SHOPPING CART -->
<div class="modal modal-right fade" id="shoppingCart" tabindex="-1" role="dialog" aria-labelledby="shoppingCartLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shoppingCartLabel">Keranjang Belanja</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="border-bottom">
                    <a href="{{url('product')}}" class="add-product float-right"><i class="ic-add-cart"></i> Tambah lagi</a>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
                <ul class="list-group">
                    <?php $i = 0; $out_of_stock=0; ?>

                    @foreach($cart as $data_cart)
                    <li class="list-group-item">
                        <h4 class="color-primary">{{$data_cart['warehouse_name']}}</h4>
                        <?php $j = 0; ?>
                        @foreach($data_cart['cart'] as $data_varian)
                        <div class="row">
                            <div class="col-md-3">
                                @if($data_varian['product_image'] == '' || $data_varian['product_image'] == null || config('app.just_url_api') == $data_varian['product_image'])
                                    @if($data_varian['product_stock'] == "0" || $data_varian['product_stock'] == 0)
                                        <img class="img-circle img-responsive" style="height: 100px;opacity:0.5" src="<?php echo URL::to('/'); ?>/assets/img/no-image.png">
                                    @else
                                        <img class="img-circle img-responsive" style="height: 100px;" src="<?php echo URL::to('/'); ?>/assets/img/no-image.png">
                                    @endif
                                @else
                                    @if($data_varian['product_stock'] == "0" || $data_varian['product_stock'] == 0)
                                        <img class="img-circle img-responsive" src="{{$data_varian['product_image']}}" style="opacity:0.5">
                                    @else
                                        <img class="img-circle img-responsive" alt="" src="{{$data_varian['product_image']}}" />
                                    @endif
                                @endif
                            </div>
                            <div class="col-md-9 item-amount">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>{{$data_varian['product_name']}}</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="float-right">{{$data_varian['qty']}} x Rp. {{number_format($data_varian['product_price_after_discount'])}}</label>
                                    </div>
                                </div>
                                <div class="container no-padding">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>{{$data_varian['qty']}} x {{$data_varian['product_pack_uom_value']}} {{$data_varian['product_pack_uom_name']}}</p>
                                        </div>
                                        <div class="col-sm-6">
                                            <label class="float-right">Rp {{number_format($data_varian['qty']*$data_varian['product_price_after_discount'])}}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="container no-padding">
                                    <div class="row">
                                        <div class="col-sm-10">
                                            <div class="input-group">
                                                <span class="input-group-btn">
                                                    <form action="#" method="post" id="form_minus_<?php echo $data_cart['warehouse_id']."_".$data_varian['product_id'];?>">
                                                        <input type="hidden" name="warehouse_id" value="{{$data_cart['warehouse_id']}}">
                                                        <input type="hidden" name="product_id" value="{{$data_varian['product_id']}}">
                                                        <input type="hidden" name="amount" value="{{$data_varian['product_price_after_discount']}}">
                                                        <input type="hidden" name="status" value="1">
                                                        <button type="button" class="btn btn-default btn-left buttonminus" data-warehouse="{{$data_cart['warehouse_id']}}" data-product="{{$data_varian['product_id']}}">
                                                            <i class="ic-cart-minus"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                                <!--<form action="#" method="post" id="form_input_<?php echo $data_cart['warehouse_id']."_".$data_varian['product_id'];?>" class="input-number qty_cart">
                                                    <input type="hidden" name="warehouse_id" value="{{$data_cart['warehouse_id']}}">
                                                    <input type="hidden" name="product_id" value="{{$data_varian['product_id']}}">
                                                    <input type="hidden" name="amount" value="{{$data_varian['product_price_after_discount']}}">
                                                    <input type="hidden" name="status" value="0">
                                                    <input type="text" name="quantity" class="form-control input-number qty-cart" value="{{$data_varian['qty']}}" maxlength="3" onchange="upcart(<?php echo $data_cart['warehouse_id'];?>, <?php echo $data_varian['product_id'];?>)"/>
                                                </form> -->
                                                <input type="text" name="quant[1]" disabled class="form-control input-number" value="{{$data_varian['qty']}}" min="1" max="10">
                                                <span class="input-group-btn">
                                                    <form action="#" method="post" id="form_plus_<?php echo $data_cart['warehouse_id']."_".$data_varian['product_id'];?>">
                                                        <input type="hidden" name="warehouse_id" value="{{$data_cart['warehouse_id']}}">
                                                        <input type="hidden" name="product_id" value="{{$data_varian['product_id']}}">
                                                        <input type="hidden" name="amount" value="{{$data_varian['product_price_after_discount']}}">
                                                        <input type="hidden" name="status" value="0">
                                                        <button type="button" class="btn btn-default btn-right buttonplus" data-warehouse="{{$data_cart['warehouse_id']}}" data-product="{{$data_varian['product_id']}}">
                                                            <i class="ic-cart-plus"></i>
                                                        </button>
                                                    </form>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <form action="#" id="delete_cart_<?php echo $data_cart['warehouse_id']."_".$data_varian['product_id'];?>" method="post">
                                                <input type="hidden" name="warehouse_id" value="{{$data_cart['warehouse_id']}}">
                                                <input type="hidden" name="product_id" value="{{$data_varian['product_id']}}">
                                                <button type="button" class="float-right btn-trash buttonsubmit" data-warehouse="{{$data_cart['warehouse_id']}}" data-product="{{$data_varian['product_id']}}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @if($data_varian['out_of_stock'])
                                    @php $out_of_stock++; @endphp
                                    <div class="container no-padding">
                                        <label class="text-danger">Stok tidak tersedia!</label>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <?php $j++; ?>
                        @endforeach
                    </li>
                    <?php $i++; ?>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <div class="total">
                    <label class="total-text mr-md-auto">Total Belanja</label>
                    @if($total_cart != 0)
                    <label class="total-price float-right">Rp {{number_format($subtotal)}}</label>
                    @else
                    <label class="total-price float-right">Rp 0</label>
                    @endif
                </div>
                @if($total_cart != 0)
                    <button class="btn btn-success btn-block" id="btn-buy">Beli</button>
                    
                @else
                    <button type="button" disabled class="btn btn-success btn-block">Beli</button>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    ///$('.qty-cart').change( function(){ 
    function upcart(warehouseId, productId){      
        var warehouse_id = $(this).data('warehouse');
        var product_id = $(this).data('product');
        //console.log(warehouse_id);
        textUpdateCart(warehouse_id, product_id);
    }//});

    function textUpdateCart(warehouseId, productId){
        var uniqid = "#form_input_"+warehouseId+"_"+productId;
        var formData = $(uniqid).serialize();
        console.log(formData);
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{url('beranda/addUpdateCart')}}",
            data: formData,
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    alert('Opps, error code : '+r.code+', '+r.message);
                } else {
                    if(r.isSuccess == true){
                        console.log("masuk sini "+r.message);
                        window.location = window.location.href;
                    }else{
                        alert('Opps, something wrong : '+r.message);
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            } 
        });
    }
</script>

<script>
    $('.buttonplus').click( function(){       
        var warehouse_id = $(this).data('warehouse');
        var product_id = $(this).data('product');
        plusCart(warehouse_id, product_id);
    });

    function plusCart(warehouseId, productId){
        var uniqid = "#form_plus_"+warehouseId+"_"+productId;
        var formData = $(uniqid).serialize();
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{url('beranda/addUpdateCart')}}",
            data: formData,
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    alert('Opps, error code : '+r.code+', '+r.message);
                } else {
                    if(r.isSuccess == true){
                        window.location = window.location.href;
                    }else{
                        alert('Opps, something wrong : '+r.message);
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            } 
        });
    }
</script>

<script>
    $('.buttonminus').click( function(){       
        var warehouse_id = $(this).data('warehouse');
        var product_id = $(this).data('product');
        minusCart(warehouse_id, product_id);
    });
    
    function minusCart(warehouseId, productId){
        var uniqid = "#form_minus_"+warehouseId+"_"+productId;
        var formData = $(uniqid).serialize();
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{url('beranda/addUpdateCart')}}",
            data: formData,
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    alert('Opps, error code : '+r.code+', '+r.message);
                } else {
                    if(r.isSuccess == true){
                        window.location = window.location.href;
                    }else{
                        alert('Opps, something wrong : '+r.message);
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('body').addClass('loaded');
                alert("Status: " + textStatus); 
                alert("Error: " + errorThrown); 
            } 
        });
    }
</script>

<script>
    $('.buttonsubmit').click( function(){    
        var warehouse_id = $(this).data('warehouse');
        var product_id = $(this).data('product');
        deleteCart(warehouse_id, product_id);
    });

    $('#btn-buy').click( function(){
        @if($out_of_stock > 0)
            Swal.fire(
                'Gagal!',
                'Stok tidak tersedia',
                'error'
            );
        @else
            window.location.href = "{{url('transaction/shipping')}}";
        @endif
        
    });

    function deleteCart(warehouseId, productId){
        var uniqid = "#delete_cart_"+warehouseId+"_"+productId;
        var formData = $(uniqid).serialize();
        $('body').removeClass('loaded');
        $.ajax({
            type: "POST",
            url: "{{url('beranda/deleteCart')}}",
            data: formData,
            success: function (r) {
                $('body').addClass('loaded');
                if (r.code != 200) {
                    alert('Opps, error code : '+r.code+', '+r.message);
                } else {
                    if(r.isSuccess == true){
                        window.location = window.location.href;
                    }else{
                        alert('Opps, something wrong : '+r.message);
                    }
                }
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $('body').addClass('loaded');
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }
        });
    }
</script>