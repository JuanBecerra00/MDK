<?php
$exportData = str_replace('ñ', '/', $exportData);
$report=openssl_decrypt ($exportData, "AES-128-CTR", 
"34567890odxcvbnko8765", 0, '1234567891011121');
?>
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
<table style="width:100%;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
  <thead>
    <tr>
      <th>Cliente</th>
      <th>Vehiculo</th>
      <th>Reporte</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th style="text-align: left; width:33%;">Nombre: 
        @foreach($customers as $customer)
          {{ $customer->name }}
        @endforeach</th>
      <th style="text-align: left; width:33%;">Placa: 
        @foreach($vehicles as $vehicle)
          {{ $vehicle->plate }}
        @endforeach</th>
      <th style="text-align: left; width:33%;">Reporte</th>
    </tr>
  </tbody>
</table>



{{$report}}
@foreach($reports as $report)
{{ $report->created_at }}
@endforeach
U


V
/////////
@foreach($products as $product)
{{ $product->id }}
@endforeach