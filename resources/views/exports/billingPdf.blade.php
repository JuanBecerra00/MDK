<?php
$exportData = str_replace('ñ', '/', $exportData);
$report=openssl_decrypt ($exportData, "AES-128-CTR",
"34567890odxcvbnko8765", 0, '1234567891011121');

foreach($reports as $report)
    {$a=$report->productsAmmount;
    $report_oilFilterType = $report->oilFilterType;
    $report_Procedures = $report->procedures;
    $report_ProductsAmmount = $report->productsAmmount;
    $report_searchReport = $report->searchReport;
    }
$oilFilterTypeArr=explode(",", $report_oilFilterType);
$searchReport=explode(",", $report->searchReport);

$report_ProceduresArr=explode("|", $report_Procedures);
$removed = array_pop($report_ProceduresArr);
$report_ProceduresArrFinal=[];
foreach($report_ProceduresArr as $a){
    array_push($report_ProceduresArrFinal, explode(",", $a));
}
$proceduresTotal=0;
foreach($report_ProceduresArrFinal as $r){
  
$proceduresTotal+=$r[1];
}


$report_ProductsAmmountArr=[];
$report_ProductsAmmountArrFinal=[];
$removed = array_shift($report_ProductsAmmountArr);
$report_ProductsAmmountArr = explode("|", $report_ProductsAmmount);
$removed = array_shift($report_ProductsAmmountArr);
foreach($report_ProductsAmmountArr as $a){
    array_push($report_ProductsAmmountArrFinal, explode(",", $a));
}
$productsTotal=0;
foreach($report_ProductsAmmountArrFinal as $r){
  
$productsTotal+=$r[2];
}

?>
<style>
*{
  font-size:10px;
}
</style>
<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <thead style="border-radius:10px;">
    <tr>
      <th style="width:152px;background:rgb(23, 23, 23);">
        <img src="assets/textures/logo.png" style="height:128px;"></img>
      </th>
      <th style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;font-size:30px;">
        MEGA-CHEVROLET
      </th>
      <th>

      </th>
    </tr>
  </thead>
  <tbody>
    <td style="">

    </td>
    <td style="text-align: right; gap:50px;">
    Fecha:
      <?php
      echo date('d/m/y');
      ?>
      <label style="">       </label>Hora:
      <?php
      echo date('h:i A');
      ?>
    </td>
  </tbody>
</table>
<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px; border-style: solid;padding: 8px;margin-top: 15px;">
  <thead >
    <tr>
      <th>Cliente</th>
      <th>Vehiculo</th>
      <th>Reporte</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th style="text-align: left; width:33%;border-radius: 10px; border-style: solid;background-color: rgb(161 161 170);padding: 6px;">Nombre:
        @foreach($customers as $customer)
          {{ $customer->name }}
        @endforeach
          <br>CE:
        @foreach($customers as $customer)
            {{ $customer->cc }}
        @endforeach
      </th>
      <th style="text-align: left; width:33%;border-radius: 10px; border-style: solid;background-color: rgb(161 161 170);padding: 6px;">Placa:
        @foreach($vehicles as $vehicle)
          {{ $vehicle->plate }}
        @endforeach
          <br>Modelo:
        @foreach($vehicles as $vehicle)
            {{ $vehicle->model }}
        @endforeach
      </th>
      <th style="text-align: left; width:33%;border-radius: 10px; border-style: solid;background-color: rgb(161 161 170);padding: 6px;">Reporte:
          @foreach($reports as $report)
              {{ $report->created_at }}
          @endforeach
      </th>
    </tr>
  </tbody>
</table>

<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px; border-style: solid;padding: 6px;margin-top: 5px;">
    <thead>
    <tr>
        <th >Reporte de ingreso</th>

        <th >Reporte de salida</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <th style="text-align: left; width:33%;margin: 4px; border-style: solid; border-radius: 10px;background-color: rgb(161 161 170); padding: 6px;">Ingreso:
            @foreach($reports as $report)
                {{ $report->prev }}
            @endforeach</th>
        <th style="text-align: left; width:33%; margin: 4px; border-style: solid; border-radius: 10px;background-color: rgb(161 161 170); padding: 6px;">Salida:
            @foreach($reports as $report)
                {{ $report->post}}
            @endforeach</th>
    </tr>
    </tbody>
</table>

<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px;border-style: solid;padding: 8px;margin-top: 5px;">
    <thead>
    <tr>
        <th>Aceite tipo</th>
        <th>Caja</th>
        <th>Diferencial</th>
        <th>Filtro</th>
    </tr>
    </thead>
    <tbody >
    <tr>
        <th style="text-align: left; width:33%; padding:5px 2px;">
            @foreach($reports as $report)
                {{ $report->oilType}}
            @endforeach
        </th>
        <th style="text-align: left; width:33%; padding:5px 2px;">
            @foreach($reports as $report)
                @if($report->boxType=='c')
                Cambios
                @elseif($report->boxType=='t')
                Transferencia
                @endif
            @endforeach
        <th style="text-align: left; width:33%; padding:5px 2px;">
            @foreach($reports as $report)
                {{ $report->difType}}
            @endforeach
        </th>
        <th style="text-align: left; width:33%; padding:5px 2px;">
            @if (in_array('1', $oilFilterTypeArr))
                @if ($oilFilterTypeArr[0] == 1)
                    <li class="">Aceite</li>
                @endif
                @if ($oilFilterTypeArr[1] == 1)
                    <li class="">Aire motor</li>
                @endif
                @if ($oilFilterTypeArr[2] == 1)
                    <li class="">Aire cabina</li>
                @endif
                @if ($oilFilterTypeArr[3] == 1)
                    <li class="">Combustible</li>
                @endif
            @else
                Ninguno
            @endif
        </th>
    </tr>
    </tbody>
</table>
<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px;border-style: solid;padding: 8px;margin-top: 5px;">
    <h2>Productos</h2>
    <thead>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Valor unitario</th>
        <th>Cantidad</th>
        <th>Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($report_ProductsAmmountArrFinal as $product)
        <tr>
            <th class="p-2">
                {{$product[0]}}
            </th>
            <th class="p-2">
            @foreach($products as $p)
            @if($p->id==$product[0])
            {{$p->name}}
            @endif
            @endforeach
            </th>
            <th class="p-2">
            @foreach($products as $p)
            @if($p->id==$product[0])
            {{$p->price}}
            @endif
            @endforeach
            </th>
            <th class="p-2">
                {{$product[1]}}
            </th>
            <th class="p-2">
                {{$product[2]}}
            </th>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th>Total: </th>
        <th>{{$productsTotal}}</th>
      </tr>
    </tfoot>
</table>
<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px;border-style: solid;padding: 8px;margin-top: 5px;">
    <h2>Procedimientos</h2>
    <thead>
    <tr>
        <th>Trabajo</th>
        <th>Precio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($report_ProceduresArrFinal as $procedure)
        <tr>
            <th class="p-2">
                {{$procedure[0]}}
            </th>
            <th class="p-2">
                {{$procedure[1]}}
            </th>
        </tr>
    @endforeach
    </tbody>
    <tfoot style="border-top:1px solid black;">
      <tr>
        <th>Total:</th>
        <th>
          @foreach($reports as $report)
              ${{$proceduresTotal}}
          @endforeach
        </th>
      </tr>
    </tfoot>
</table>

<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px;border-style: solid;padding: 8px;margin-top: 5px;">
    <h2>Observaciones</h2>
    <thead>
    </thead>
    <tbody>
    <tr>
        <th style="text-align: left; width:33%; margin: 4px; border-style: solid; border-radius: 10px;background-color: rgb(161 161 170); padding: 6px;">
            @foreach($reports as $report)
                {{ $report->observations }}
            @endforeach</th>
    </tr>
    </tbody>
</table>

<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; border-radius: 20px;border-style: solid;padding: 8px;margin-top: 5px;">
    <h2>Total</h2>
    <thead>
    </thead>
    <tbody>
    <tr>
        <th style="text-align: left; width:33%; margin: 4px; border-style: solid; border-radius: 10px;background-color: rgb(161 161 170); padding: 6px;">
            ${{$proceduresTotal+$productsTotal}}
    </tr>
    </tbody>
</table>