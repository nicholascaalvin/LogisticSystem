@section('header')
<style type="text/css">
    .card{
        margin: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .label{
        width: 20em;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
    }
    .select2-container--bootstrap-5{
        display: inline-block;
    }
</style>
@endsection

@extends('layout')

@section('content')
    <div class="card shadow p-3 mb-3 bg-body">
        <div class="card-header" style="border-bottom: none">
            <div class="header-content d-flex justify-content-between align-items-center">
                <h1>Add New Receiving</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="header">
                <div class="mb-3">
                    <label for="transaction_number" class="label">Transaction Number</label>
                    <input type="text" class="form-input" id="transaction_number" value="{{old('transaction_number')}}">
                </div>
                <div class="mb-3">
                    <label for="supplier" class="label">Supplier</label>
                    <select class="form-input select2" id="supplier">
                        @foreach ($supplier as $item)
                        <option value="{{$item->SupplierPK}}">{{$item->SupplierName}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="transaction_date" class="label">Transaction Date</label>
                    <input class="form-input date" id="transaction_date" value="{{$date}}">
                </div>
                <div class="mb-3">
                    <label for="warehouse" class="label">Warehouse</label>
                    <select class="form-input select2" id="warehouse">
                    @foreach ($warehouse as $item)
                        <option value="{{$item->WhsPK}}">{{$item->WhsName}}</option>
                    @endforeach
                    </select>
                </div>
                <div class="mb-3 d-flex">
                    <label for="transaction_notes" class="label">Transaction Notes</label>
                    <textarea class="form-input" id="transaction_notes"></textarea>
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Qty Dus</th>
                    <th scope="col">Qty Pcs</th>
                    <th scope="col" style="width: 5%">Action</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row">
                            <select class="form-input select2" name="product_id" id="product_id">
                                @foreach ($product as $item)
                                    <option value="{{$item->id}}">{{$item->ProductName}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td scope="row">
                            <input class="form-input" type="number" name="qty_dus" id="qty_dus">
                        </td>
                        <td scope="row">
                            <input class="form-input" type="number" name="qty_pcs" id="qty_pcs">
                        </td>
                        <td class="text-center"><a class="btn btn-primary" id="add">+</a></td>
                    </tr>
                </tbody>
              </table>
            <a class="btn btn-success" id="submit_receiving">Submit</a>
        </div>
    </div>
@endsection

@section('footer')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2({
            theme: 'bootstrap-5',
        });
        $(".date").flatpickr({
            dateFormat: "Y-m-d H:i",
            enableTime: true,
            time_24hr: true,
        });
    });
    $('#add').on('click', function(){
        var product_id = $('#product_id').find(":selected").val();
        var product_name = $('#product_id').find(":selected").text();
        var qty_dus = $('#qty_dus').val();
        var qty_pcs = $('#qty_pcs').val();
        if(qty_dus == '' || qty_pcs == '' || qty_dus == 0 || qty_pcs == 0){
            Swal.fire('Qty cannot be empty or 0');
        }
        else{
            addRow(product_id, product_name, qty_dus, qty_pcs);
        }
        
    });

    function addRow(product_id, product_name, qty_dus, qty_pcs){
        var newRow = '';
        var row = $('.table').find('tbody tr.details');
        var exist = false;
        var first = false;
        if(row.length != 0){
            $.each(row, function(index, value){
                var products_id = $(value).find('input.product_id').val();
                if(products_id == product_id){
                    exist = true;
                    if(first == false){
                        qtys_dus = parseInt($(value).find('input.qty_dus').val());
                        qtys_pcs = parseInt($(value).find('input.qty_pcs').val());
                        totalqty_dus = parseInt(qty_dus) + parseInt(qtys_dus);
                        totalqty_pcs = parseInt(qty_pcs) + parseInt(qtys_pcs);
                        $(value).find('input.qty_dus').val(parseInt(totalqty_dus));
                        $(value).find('td.qty_dus').text(parseInt(totalqty_dus));
                        $(value).find('input.qty_pcs').val(parseInt(totalqty_pcs));
                        $(value).find('td.qty_pcs').text(parseInt(totalqty_pcs));
                    }
                    first = true;
                }
            });
        }
        if(!exist){
            newRow +=
                '<tr class="details">'+
                    '<td style="display: none"><input class="product_id" name="product_id[]" value="'+product_id+'"></td>'+
                    '<td class="product_name">'+product_name+'</td>'+
                    '<td style="display: none"><input class="qty_dus" name="qty_dus[]" value="'+qty_dus+'"></td>'+
                    '<td class="qty_dus">'+qty_dus+'</td>'+
                    '<td style="display: none"><input class="qty_pcs" name="qty_pcs[]" value="'+qty_pcs+'"></td>'+
                    '<td class="qty_pcs">'+qty_pcs+'</td>'+
                    '<td><button class="btn btn-danger" id="delete" onclick="deleteRow(this)">-</button></td>'+
                '</tr>';
        }
        $('.table').append(newRow);
        $('#qty_dus').val('');
        $('#qty_pcs').val('');
    }

    $('#submit_receiving').on('click', function(){
        var row = $('.table').find('tbody tr.details');
        var product_id = $(row).find('input.product_id').val();
        if(row.length < 1){
            Swal.fire('Item details cannot be null');
        }
        else{
            var products_id = [];
            var products_qty_dus = [];
            var products_qty_pcs = [];
            $.each(row, function(index, value){
                products_id.push($(value).find('.product_id').val());
                products_qty_dus.push($(value).find('.qty_dus').val());
                products_qty_pcs.push($(value).find('.qty_pcs').val());
            });
            var transaction_number = $('#transaction_number').val();
            var supplier_id = $('#supplier').val();
            var transaction_date = $('#transaction_date').val();
            var warehouse_id = $('#warehouse').val();
            var transaction_notes = $('#transaction_notes').val();
            $.ajax({
                url: '/receiving/save',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    'transaction_number': transaction_number,
                    'transaction_date': transaction_date,
                    'supplier_id': supplier_id,
                    'warehouse_id': warehouse_id,
                    'transaction_notes': transaction_notes,
                    'products_id': products_id,
                    'products_qty_dus': products_qty_dus,
                    'products_qty_pcs': products_qty_pcs,
                },
                success: function(data){
                    Swal.fire({
                        title: data,
                        confirmButtonText: 'Close',
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.assign('');
                        }
                    });
                },
            });
        }
    }); 
</script>
@endsection
