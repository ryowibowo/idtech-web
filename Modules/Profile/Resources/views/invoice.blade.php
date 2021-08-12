<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Invoice</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            body{
                page-break-after: always;
                page-break-inside: avoid;
                font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
                color:#333;
                text-align:left;
                font-size:15px;
                margin:0;
                width: 100%;
            }
            .container{
                margin:0 auto;
                margin-top:35px;
                padding:40px;
                width:100%;
                height:auto;
                background-color:#fff;
            }
            caption{
                font-size:28px;
                margin-bottom:15px;
            }
            table{
                border:1px solid #333;
                border-collapse:collapse;
                margin:0 auto;
                width:100%;
                table-layout:fixed;
            }
            td, tr, th{
                padding:12px;
                border:1px solid rgb(209, 209, 209);
                width:185px;
            }
            th{
                background-color: #f0f0f0;
            }
            h4, p{
                margin:0px;
            }
        </style>

        <div class="container">
            <table>
                <caption>
                    {{-- Daengweb Invoice App --}}
                </caption>
                <thead>
                    <tr>
                        <th colspan="2">No. Tagihan <br>
                            {{$transaction_detail->billing_code}}<br>
                            Tanggal Pesanan <br>
                            {{date('d-m-Y', strtotime($transaction_detail->order_date))}}
                        </th>
                        <th colspan="2"> Kode Pesanan<br>
                            {{$transaction_detail->order_code}}
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h4>Pengirim: </h4>
                            <p>
                                {{$transaction_detail->sender_address['company_name']}}<br>
                                {{$transaction_detail->sender_address['company_address']}}<br>
                                {{$transaction_detail->sender_address['company_number']}}<br>
                            </p>
                        </td>
                        <td colspan="2">
                            <h4>Pelanggan: </h4>
                                @if ($transaction_detail->pic != null )
                                    <p>{{ $transaction_detail->buyer_org}}<br>
                                        {{$address->detail}}, <br/>
                                        {{$address->district}}<br/>
                                        Kecamatan {{$address->regency}}<br/>
                                        kab/Kota {{$address->village}}<br/>
                                        Provinsi {{$address->province}}<br/>
                                        Kode Pos {{$address->postal_code}}<br/>
                                        {{$transaction_detail->pic}} <br>
                                        {{$transaction_detail->buyer_user_phone_number}} <br>
                                        {{$transaction_detail->buyer_user_email}}
                                    </p>
                                @else
                                    <p>{{ $transaction_detail->buyer_user_name}}<br>
                                        {{$address->detail}}, <br/>
                                        {{$address->district}}<br/>
                                        Kecamatan {{$address->regency}}<br/>
                                        kab/Kota {{$address->village}}<br/>
                                        Provinsi {{$address->province}}<br/>
                                        Kode Pos {{$address->postal_code}}<br/>
                                        {{$transaction_detail->buyer_user_phone_number}} <br>
                                        {{$transaction_detail->buyer_user_email}}
                                    </p>
                                @endif        
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Produk</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                    @foreach ($order_detail as $row)
                    <tr>
                        <td>{{$row["product_name"]}}</td>
                        <td>Rp.{{$row["purchased_price"]}}</td>
                        <td>{{$row["purchased_quantity"]}}</td>
                        <td>Rp.{{$row["total_order"]}}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <th colspan="3">Subtotal</th>
                        <td>Rp.{{$transaction_detail->total_price}}</td>
                    </tr>
                    @if ($transaction_detail->pricing_include_tax == true)
                        <tr>
                            <th colspan="3">Dasar Pengenaan Pajak</th>
                            <td>Rp.{{$transaction_detail->tax_basis}}</td>
                        </tr>
                        <tr>
                            <th colspan="3">PPN</th>
                            <td>Rp.{{$transaction_detail->national_income_tax}}</td>
                        </tr>
                    @else
                        <tr>
                            <th colspan="3">PPN</th>
                            <td>Rp.{{$transaction_detail->national_income_tax}}</td>
                        </tr>
                    @endif  
                    
                    <tr>
                        <th colspan="3">Ongkos Kirim</th>
                        <td>Rp.{{$transaction_detail->delivery_fee}}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Biaya Admin</th>
                        <td>Rp.{{$transaction_detail->detail_payment['payment_amount']}}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Asuransi</th>
                        <td>Rp.{{$transaction_detail->asuransi}}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Voucher</th>
                        <td> - Rp.{{$transaction_detail->discount}}</td>
                    </tr>
                    @if(intval($transaction_detail->detail_payment['balance_used']) > 0 && $transaction_detail->grandtotal_payment != "0")
                    <tr>
                        <th colspan="3">Saldo terpakai</th>
                        <td>- Rp.{{ $transaction_detail->detail_payment['balance_used'] }}</td>
                    </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3">Total</th>
                        <td><b>Rp.{{$transaction_detail->grandtotal_payment}}</b></td>
                    </tr>
                </tfoot>
            </table><br><br>
            <p style="text-align:center"><i>"Terima kasih telah melakukan transaksi di toko kami. Semoga Anda senang dengan pelayanan kami."</i></p>
        </div>
        <script>
            window.print();
        </script>
    </body>
</html>