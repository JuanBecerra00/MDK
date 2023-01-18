<?php
$exportData = str_replace('ñ', '/', $exportData);
$decryption=openssl_decrypt ($exportData, "AES-128-CTR",
    "34567890odxcvbnko8765", 0, '1234567891011121');
$filters = explode(",", $decryption);
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
<p style="font-size:30px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Vehiculos</p>
<table class="w-full divide-y divide-gray-200 " style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:rgb(39, 39, 42);padding:20px;">
    <thead class="" style="border-bottom: red solid;color:white;">

    <tr>
        @if(in_array('fieldId', $filters))
            <th scope="col" style="padding:5px;width:100%"
                wire:click="sortBy('id')">
                <div class="flex">Id</div>
            </th>
        @endif
        @if(in_array('fieldCustomers_id', $filters))
            <th scope="col" style="padding:5px;width:100%;"
                wire:click="sortBy('customers_id')">
                <div class="flex">Id del Cliente</div>
            </th>
        @endif
        @if(in_array('fieldPlate', $filters))
            <th scope="col" style="padding:5px;width:100%;"
                wire:click="sortBy('plate')">
                <div class="flex">Placa</div>
            </th>
        @endif
        @if(in_array('fieldModel', $filters))
            <th scope="col" style="padding:5px;width:100%;"
                wire:click="sortBy('model')">
                <div class="flex">Modelo</div>
            </th>
        @endif
        @if(in_array('fieldStatus', $filters))
            <th scope="col" style="padding:5px;width:100%;"
                wire:click="sortBy('status')">
                <div class="flex">Estado</div>
            </th>
        @endif
    </tr>
    </thead>
    <tbody style="background:white;">
    @foreach($vehicles as $vehicle)
        @if(in_array($vehicle->id, $filters))
            <tr class="">
                @if(in_array('fieldId', $filters))
                    <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $vehicle->id }}</div></td>
                @endif
                @if(in_array('fieldCustomers_id', $filters))
                    <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $vehicle->customers_id }}</div></td>
                @endif
                @if(in_array('fieldPlate', $filters))
                    <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $vehicle->plate }}</div></td>
                @endif
                @if(in_array('fieldModel', $filters))
                    <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $vehicle->model }}</div></td>
                @endif
                @if(in_array('fieldStatus', $filters))
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($vehicle->status=='1')
                            Activo
                        @else
                            Inactivo
                        @endif
                    </td>
                @endif

            </tr>
        @endif
    @endforeach
    <!-- More items... -->
    </tbody>
</table>
