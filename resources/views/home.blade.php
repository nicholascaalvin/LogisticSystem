@extends('layout')

@section('header')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">
    body{
        background-color: #fafafa;
    }
    .card{
        margin: 10px;
        padding: 10px;
        border: none;
        border-radius: 0.6em;
    }
    .edit-btn:hover{
        cursor: pointer;
    }
    #DataTables_Table_0_filter{
        margin-bottom: 1em;
    }
    .dropdown a{
        color: black;
    }
    .dropdown a:active{
        color: black;
    }
    .mid-content{
        display: flex;
    }
    .transactions-card{
        width: 50%;
    }
    .items-card{
        width: 25%;
    }
    .stock-card{
        width: 25%;
    }
</style>
@endsection

@section('content')

<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <h1 style="margin-bottom: 0">Dashboard</h1>
    </div>
</div>

<div class="card shadow p-3 mb-3 bg-body">
    <div class="card-header" style="border-bottom: none">
        <h3 style="margin-bottom: 0">Let's Start</h3>
    </div>
</div>

@endsection

@section('footer')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
<script type="text/javascript">
    
</script>

@endsection
