<!--?xml version="1.0" encoding="UTF-8"?-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xml:lang="cs" lang="cs"><head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Objednávka #{{$order->order_id}}</title>
    <style type="text/css">
        body {
            background: #FFFFFF;
        }
        body, td, th, input, select, textarea, option, optgroup {
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #000000;
        }
        h1 {
            text-transform: uppercase;
            color: #CCCCCC;
            text-align: right;
            font-size: 24px;
            font-weight: normal;
            padding-bottom: 5px;
            margin-top: 0px;
            margin-bottom: 15px;
            border-bottom: 1px solid #CDDDDD;
        }
        .div1 {
            width: 100%;
            margin-bottom: 20px;
        }
        .div2 {
            float: left;
            display: inline-block;
        }
        .div3 {
            float: right;
            display: inline-block;
            padding: 5px;
        }
        .heading td {
            background: #E7EFEF;
        }
        .address, .product {
            border-collapse: collapse;
        }
        .address {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #CDDDDD;
            border-right: 1px solid #CDDDDD;
        }
        .address th, .address td {
            border-left: 1px solid #CDDDDD;
            border-bottom: 1px solid #CDDDDD;
            padding: 5px;
        }
        .address td {
            width: 50%;
        }
        .product {
            width: 100%;
            margin-bottom: 20px;
            border-top: 1px solid #CDDDDD;
            border-right: 1px solid #CDDDDD;
        }
        .product td {
            border-left: 1px solid #CDDDDD;
            border-bottom: 1px solid #CDDDDD;
            padding: 5px;
        }
    </style>
</head>
<body style="position:relative;padding-bottom:6.5em;">
<h1>Faktura - daňový doklad</h1>
<div class="div1">
    <table width="100%">
        <tbody><tr><th align="left">{{$eshop}}<br>Dodavatel:</th></tr>
        <tr>
            <td>
                Kateřina Hunková<br>
                Panenský Týnec 81<br>
                43905 Panenský Týnec<br>
                IČ:  88038335<br>
                DIČ: CZ8758302960<br>
                Telefon +420 604 304 650<br>
                {{"info@" . $eshopSmall}}<br>
                č.ú. 2700251053 / 2010<br>
                {{$order->domain}}</td>
            <td valign="top" align="right"><table>
                    <tbody><tr>
                        <td align="right"><b>Číslo faktury:</b></td>
                        <td>{{$order->invoice_id}}</td>
                    </tr>
                    <tr>
                        <td align="right"><b>Datum vystavení:</b></td>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <td align="right"><b>Datum splatnosti:</b></td>
                        <td>{{$date14}}</td>
                    </tr>

                    <tr>
                        <td align="right"><b>Datum zdanitelného plnění:</b></td>
                        <td>{{$date}}</td>
                    </tr>
                    <tr><td></td></tr>
                    <tr>
                        <td align="right"><b>Var. symbol:</b></td>
                        <td>{{$order->order_id}}</td>
                    </tr>
                    <tr>
                        <td align="right"><b>Způsob platby:</b></td>
                        <td>{{$order->payment_method}}</td>
                    </tr>
                    <!--
                              <tr>
                                <td align="right"><b>Spec. symbol:</b></td>
                                <td></td>
                              </tr>
                              <tr>
                                <td align="right"><b>Konst. symbol:</b></td>
                                <td></td>
                              </tr>
                    -->
                    </tbody></table></td>
        </tr>
        </tbody></table>
</div>
<table class="address">
    <tbody><tr class="heading">
        <td width="50%"><b>Odběratel</b></td>
        @if(!$same)
            <td width="50%"><b>Dodací adresa (pokud je jiná adresa)</b></td>
        @endif
    </tr>
    <tr>
        <td>
            @if($order->payment_company != '')
                {{$order->payment_company}}
                <br>IČ: {{$order->regNum}}
                <br>DIČ: {{$order->taxRegNum}}<br>
            @endif
            {{$order->payment_address_1}}
            <br>{{$order->payment_city}}
            <br>{{$order->payment_country}}</td>
        @if(!$same)
        <td>
            @if($order->payment_company != '')
                {{$order->shipping_company}}<br>
            @endif
            {{$order->shipping_address_1}}
            <br>{{$order->shipping_city}}
            <br>{{$order->shipping_country}}</td>
        @endif
    </tr>
    </tbody></table>
<table class="product">
    <tbody><tr class="heading">
        <td><b>Produkt</b></td>
        <td><b>Model</b></td>
        <td align="right"><b>Záruka</b></td>    <td align="right"><b>Počet</b></td>
        <td align="right"><b>Cena / kus</b></td>
        <td align="right"><b>DPH %</b></td>
        <td align="right"><b>Cena</b></td>
        <td align="right"><b>DPH</b></td>
        <td align="right"><b>Celkem s DPH</b></td>
    </tr>
    @php
        $order->currency === 'CZK' ? $c = ' Kč' : $c = '€';
        $totalsSum = 0;
        $taxesSum = 0;
    @endphp
    @foreach ($order_products as $order_product)
        @php
            $total = round($order_product->total * $order->value, 1);
            $totalsSum += $total;
            $taxCoeficient = $order_product->tax / 100;
            $tax = round($order_product->total * $taxCoeficient * $order->value, 1);
            $taxesSum += $tax;
        @endphp
        <tr>
            @if($order_product->is_transfer == 0)
                <td>{{$order_product->name}}</td>
                <td>{{$order_product->model}}</td>
                <td align="right">{{$order_product->warranty}}</td>
            @else
                <td colspan="2">{{$order_product->name}}</td>
                <td align="right">-</td>
            @endif
            <td align="right">{{$order_product->quantity}}</td>
            <td style="white-space: nowrap;" align="right">
                {{str_replace('.', ',', round($order_product->price * $order->value, 1).$c)}}</td>
            <td align="right">{{round($order_product->tax, 0)}}</td>
            <td style="white-space: nowrap;" align="right">{{str_replace('.', ',', $total.$c)}}</td>
            <td style="white-space: nowrap;" align="right">{{str_replace('.', ',', $tax.$c)}}</td>
            <td style="white-space: nowrap;" align="right">{{str_replace('.', ',', ($total+$tax).$c)}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="8" align="right">
            Cena celkem bez DPH

        </td>
        <td style="white-space: nowrap;" align="right">

            {{str_replace('.', ',', $totalsSum.$c)}}

        </td>
    </tr>
    <tr>
        <td colspan="8" align="right">
            DPH 21%

        </td>
        <td style="white-space: nowrap;" align="right">

            {{str_replace('.', ',', $taxesSum.$c)}}

        </td>
    </tr>
    <tr>
        <td colspan="8" align="right">
            <strong>            Cena celkem s DPH          </strong>

        </td>
        <td style="white-space: nowrap;" align="right">
            <strong>
                {{($totalsSum + $taxesSum).$c}}         </strong>

        </td>
    </tr>
    </tbody></table>
<div style="text-align:center;page-break-inside:avoid;">Živnostenský list, číslo jednací ŽÚ/2700/2011/EFF<br>
    Jsme plátci DPH | Faktura slouží jako podklad pro případnou reklamaci či vrácení zboží<br>
    Zboží lze v souladu s občanským zákoníkem vrátit bez udání důvodu v ochranné lhůtě 14 dní od převzetí.<br>
    Cena elektroniky je vždy uváděna včetně recyklačního poplatku<br>
    Děkujeme, že jste si vybrali {{$eshop}}</div>

</body></html>
