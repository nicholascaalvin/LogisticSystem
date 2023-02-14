@extends('layout')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
    body{
        background-color: #fafafa;
    }
    .card{
        margin: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .dataTables_scroll{
        width: 100%;
        margin: 0 auto;
    }
    table thead th{
        text-align: center;
    }
    .form-input{
        width: 20em;
        border-radius: 5px;
        border: 1px solid lightgray;
        height: 2.2em;
    }
    .dropdown a{
        color: black;
    }
    .dropdown a:active{
        color: black;
    }
    .edit-btn:hover{
        cursor: pointer;
    }
    #DataTables_Table_0_filter{
        margin-bottom: 1em;
    }
    @media only screen and (max-width: 700px) {
        .table th{
            font-size: 16px;
        }
        .table td{
            font-size: 13px;
        }
    }
</style>
@endsection

@section('content')
<div class="card shadow mb-3 bg-body">
    <div class="card-body" style="margin-left: 1em">
        <h1>{{$title}}</h1>
    </div>
</div>
<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-body">
        <div class="content-body">
            <table class="table cell-border table-bordered" style="border-top: 1px solid lightgray; width: 100%">
                <thead>
                    <tr>
                        <th style="width: 1%;">NO.</th>
                        <th>Supplier Name</th>
                        <th style="width: 1%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contents as $index => $item)
                        <tr>
                            <td class="text-center">{{$index + 1}}</td>
                            <td>{{$item->SupplierName}}</td>
                            <td style="text-align: center">
                                <div class="dropdown">
                                    <a class="" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 0;">
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item detail-btn">Details</a></li>
                                        <li><button class="dropdown-item delete-btn" type="submit">Delete</button></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">
    $('.table').DataTable({
        "lengthChange": false,
        "pageLength": 10,
        "pagingType": "simple_numbers",
        "scrollX": true,
    });
</script>

@endsection
