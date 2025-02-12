<!Doctype html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }}</title>
    <link rel="shortcut icon" href="{{ env('APP_URL').config('settings.application.company_icon') }}" />
    <link rel="apple-touch-icon" href="{{ env('APP_URL').config('settings.application.company_icon') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ env('APP_URL').config('settings.application.company_icon') }}" />
    <script defer>
        import 'bootstrap/dist/css/bootstrap.css'
    </script>


    {{-- @include('layouts.includes.header')--}}
    <style>


        .box-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }

        .box {
            border: 1px solid #000; /* Set your desired border style and color here */
        
        }

        .address-info {
            text-align: left;
        }

        .address-header {
            font-weight: bold;
        }

        .info-item {
            margin-top: 5px;
        }


        /* dev */
        .t {
            border: 1px solid red;
        }

        .bg-t {
            background-color: #e1e5e1;
        }

        .bg-dark {
            background-color: #d9251c !important;
        }

        .bg-blue{
            background-color: #221357 !important;
        }

        .bg-secondary {
            background-color: #dddddd !important;
        }

        .bg-transparent {
            background-color: transparent !important;
        }

        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            
        }

        /*common*/
        .m-0 {
            margin: 0;
        }

        .m-1 {
            margin: 5px;
        }

        .m-2 {
            margin: 10px;
        }

        .m-3 {
            margin: 15px;
        }

        .m-4 {
            margin: 20px;
        }

        .m-5 {
            margin: 25px;
        }

        .mx-1 {
            margin: 0 5px;
        }

        .mx-2 {
            margin: 0 10px;
        }

        .mx-3 {
            margin: 0 15px;
        }

        .mx-4 {
            margin: 0 20px;
        }

        .mx-5 {
            margin: 0 25px;
        }

        .my-1 {
            margin: 5px 0;
        }

        .my-2 {
            margin: 10px 0;
        }

        .my-3 {
            margin: 15px 0;
        }

        .my-4 {
            margin: 20px 0;
        }

        .my-5 {
            margin: 25px 0;
        }

        .mt-1 {
            margin-top: 5px
        }

        .mt-2 {
            margin-top: 10px
        }

        .mt-3 {
            margin-top: 15px
        }

        .mt-4 {
            margin-top: 20px
        }

        .mt-5 {
            margin-top: 25px
        }

        .mb-1 {
            margin-bottom: 5px
        }

        .mb-2 {
            margin-bottom: 10px
        }

        .mb-3 {
            margin-bottom: 15px
        }

        .mb-4 {
            margin-bottom: 20px
        }

        .mb-5 {
            margin-bottom: 25px
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 5px;
        }

        .p-2 {
            padding: 10px;
        }

        .p-3 {
            padding: 15px;
        }

        .p-4 {
            padding: 20px;
        }

        .p-5 {
            padding: 25px;
        }

        .px-1 {
            padding: 0 5px;
        }

        .px-2 {
            padding: 0 10px;
        }

        .px-3 {
            padding: 0 15px;
        }

        .px-4 {
            padding: 0 20px;
        }

        .px-5 {
            padding: 0 25px;
        }

        .py-1 {
            padding: 5px 0;
        }

        .py-2 {
            padding: 10px 0;
        }

        .py-3 {
            padding: 15px 0;
        }

        .py-4 {
            padding: 20px 0;
        }

        .py-5 {
            padding: 25px 0;
        }

        .w-10 {
            width: 10%;
        }

        .w-15 {
            width: 15%;
        }

        .w-45 {
            width: 45%;
        }

        .w-25 {
            width: 25%;
        }

        .w-50 {
            width: 50%;
        }

        .w-75 {
            width: 75%;
        }

        .w-100 {
            width: 100%;
        }

        .h-100 {
            height: 100%;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }

        .f-clear {
            clear: both;
        }

        .text-left {
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .text-secondary {
            color: #666666;
        }

        .text-light {
            color: #fff;
        }

        .text-black {
            color: #000;
        }
        .text-red {
            color: #d9251c;
        }

        .text-capital {
            text-transform: uppercase;
        }

        .thin {
            font-weight: lighter;
        }

        .bold {
            font-weight: bold;
        }

        .font-xm {
            font-size: x-small
        }

        .font-md {
            font-size: medium
        }

        .font-lg {
            font-size: large
        }

        .table-strip {}

        .table-strip tr:nth-child(even) {
            background-color: #f8f8f8;
        }

        /*layout*/
        .invoice_container {}

        .invoice_container * {
            box-sizing: content-box;
        }

        .invoice_container__item {}

        .logo {
            width: 96px;
        }

        .hr {
            background-color: #999999;
            border: none;
            height: 1px;
        }

        .currency-symbol {
            font-family: DejaVu Sans;
            font-size: 16px;
            line-height: 1;
        }

    </style>
</head>

<body>
    <div class="invoice_container">
        <div class="invoice_container__item mx-5 text-black">
            <div class="w-100 f-left p-1">
                <div>
                    <img style="width:99%" src="{{public_path('receipt.jpg')}}" alt="Sai Packers And Movers">
                </div>
            </div>
        </div>
    </div>
    <div class="f-clear"> </div>

    <!-- Receipt details -->
    <div class="invoice_container__item mx-5 box ">
        <table class="w-100 " border="1" cellspacing="0" cellpadding="0">
            <thead>
                <tr class="bg-dark text-light ">
                    <!-- Client name -->
                    <th class="w-50 p-1 text-center bold">Receipt</th>
                </tr>
            </thead>
        </table>
        <div class="f-clear"> </div>

        <table class="w-100" border="0" cellspacing="0" cellpadding="1">
            
            <tbody>
                <tr><br></tr>
                <tr>
                    <td class="w-50 p-1">
                        <div class="invoice_container__item text-black px-5">
                            <p class="cus-mt-3">
                                <span class="bold"> Receipt No: </span>  {{$receipt->id}}
                            </p>
                        </div>
                    </td> 
                    <td class="w-50 p-1">
                        <div class="invoice_container__item  text-black px-5">
                            <p class="cus-mt-3  text-right">
                                <span class="bold">{{ "Date" }}: </span> {{ \Carbon\Carbon::parse($receipt->date)->format('d/m/Y')}}
                            </p>
                        </div>
                    </td> 
                </tr>
                <tr><br></tr>
                <tr>
                    <td class="w-50 p-1">
                        <div class="invoice_container__item text-black px-5">
                            <p class="cus-mt-3">
                                <span class="bold"> Received From M/S: </span>  {{$receipt->client_name}}
                            </p>
                        </div>
                    </td> 
                    <td class="w-50 p-1">
                        <div class="invoice_container__item  text-black px-5">
                            <p class="cus-mt-3 ">
                                <span class="bold"> Phone: </span> {{$receipt->client_phone}}
                            </p>
                        </div>
                    </td> 
                </tr>
                <tr><br></tr>
                <tr>
                    <td class="w-50 p-1">
                        <div class="invoice_container__item  text-black px-5">
                            <p class="cus-mt-3">
                                <span class="bold"> From: </span> {{$receipt->from}}
                            </p>
                        </div>
                    </td> 
                    <td class="w-50 p-1">
                        <div class="invoice_container__item  text-black px-5">
                            <p class="cus-mt-3  ">
                                <span class="bold"> To: </span> {{$receipt->to}}
                            </p>
                        </div>
                    </td> 
                   
                </tr>
                <tr><br></tr>
                <tr>
                    <td class="w-50 p-1">
                        <div class="invoice_container__item text-black px-5">
                            <p class="cus-mt-3">
                                <span class="bold"> Paid In: </span>  {{$receipt->paymentMethod}}
                            </p>
                        </div>
                    </td> 
                </tr>

                <tr><br></tr>

                <tr>    
                    <td class="w-50 p-1">
                        <div class="invoice_container__item  text-black px-5">
                            <p class="">
                                <span class="bold"> Amount In Words: </span> {{$receipt->amount_words}}
                            </p>
                        </div>
                    </td> 
                   
                </tr>

                <tr><br></tr>

                <tr>    
                    <td class="w-50 p-1">
                        <div class="invoice_container__item text-black px-5">
                            <p class="cus-mt-3 currency-symbol ">
                                <span class="bold "> Amount: </span> {{ number_with_currency_symbol($receipt->amount) }}
                            </p>
                        </div>
                    </td> 
                   
                </tr>
            <tbody>
        </table>
        <div class="f-clear"> </div>
        <table class="w-100 font-xm" border="1" cellspacing="0" cellpadding="0">
           
            <tbody>
                
                <tr>
                    <td>
                        <div class="invoice_container__item m-1 text-black px-5">
                            <p class="cus-mt-3">
                                <span class="bold"> </span> 
                        </div>
                    </td> 
                    <!-- Cell for the image -->
                    <td class ="w-25">
                        <div class="invoice_container__item m-1 text-black font-xm">
                            <div class="f-center p-1">
                                <img style="width:75%" src="{{ public_path('Stamp.png') }}" alt="receipt">
                            </div>
                            <p class="cus-mt-3">
                                <span class="bold text-red">{{ "SAI PACKERS AND MOVERS" }}</span>
                            </p>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>      
    </div> 


    {{--@include('layouts.includes.footer')--}}
</body>