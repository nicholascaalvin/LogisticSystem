@extends("layout")

@section('header')
<style type="text/css">
    body{
        background-color: #fafafa;
    }
    .card{
        margin: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
        display: block;
    }
</style>
@endsection

@section('content')

<div class="card shadow mb-3 bg-body">
    <div class="card-body" style="margin-left: 1em">
      <h1>History Transaction</h1>
    </div>
</div>

<div class="card shadow mb-3 bg-body">
    <div class="card-body">
        <div class="mb-3">
            <label for="item_name" class="form-label">Item Name</label>
            <input type="text" class="form-input" id="item_name" name="item_name">
        </div>

        <button type="submit" class="btn btn-primary" id="searchHT">Search</button>
       
        <div class="" style="width: 30%; min-height: 125px;">
            <table class="table item-stock-table">
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Stock Dus</th>
                        <th>Stock Pcs</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

        <div class="table-responsive">
            <table class="table history-transaction-table">
                <thead>
                    <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">Transaction Number</th>
                    <th scope="col">Transaction Date</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Warehouse Name</th>
                    <th scope="col">Qty Dus</th>
                    <th scope="col">Qty Box</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

@section('footer')
<script type="text/javascript">

    $(document).ready(function() {
        $(".date").flatpickr({
            dateFormat: "Y-m-d",
            mode: "range",
        });
    });

    $('#searchHT').on('click', function(){
        var item_name = $('#item_name').val();
        if(item_name == ''){
            Swal.fire('Item Name cannot be empty!');
        }
        else{
            $.ajax({
                url: 'history-transaction/search',
                data: {
                    'item_name': item_name,
                },
                success: function(data){
                    var row = "";
                    var rowStock = "";
                    var totalStockDus = 0;
                    var totalStockPcs = 0;
                    $('.item-stock-table').find('tbody').empty();
                    $('.history-transaction-table').find('tbody').empty();
                    $.each(data.query, function(key, value){
                        if(value.type == 'penerimaan'){
                            totalStockDus += value.qty_dus;
                            totalStockPcs += value.qty_pcs;
                        }
                        if(value.type == 'pengeluaran'){
                            totalStockDus -= value.qty_dus;
                            totalStockPcs -= value.qty_pcs;
                        }
                        row += "<tr>";
                            row += "<td>";
                                row += key + 1;
                            row += "</td>";
                            row += "<td>";
                                row += value.transaction_number;
                            row += "</td>";
                            row += "<td>";
                                row += value.transaction_date;
                            row += "</td>";
                            row += "<td>";
                                row += value.ProductName;
                            row += "</td>";
                            row += "<td>";
                                row += value.WhsName;
                            row += "</td>";
                            row += "<td>";
                                row += value.qty_dus;
                            row += "</td>";
                            row += "<td>";
                                row += value.qty_pcs;
                            row += "</td>";
                        row += "</tr>";
                    });
                    rowStock += "<tr>";
                        rowStock += "<td>";
                            rowStock += data.itemStock.ProductName;
                        rowStock += "</td>";
                        rowStock += "<td>";
                            rowStock += data.itemStock.qty_dus;
                        rowStock += "</td>";
                        rowStock += "<td>";
                            rowStock += data.itemStock.qty_pcs;
                        rowStock += "</td>";
                    rowStock += "</tr>";
                    $('.item-stock-table').find('tbody').append(rowStock);
                    $('.history-transaction-table').find('tbody').append(row);

                }
            });
        }
        event.preventDefault();
    });

    
</script>
@endsection
