<?php
$exportData = str_replace('ñ', '/', $exportData);
$decryption=openssl_decrypt ($exportData, "AES-128-CTR",
    "34567890odxcvbnko8765", 0, '1234567891011121');
$filters = explode(",", $decryption);
$providers = DB::select('SELECT * FROM providers');
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
<p style="font-size:30px;font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">Productos</p>
<table class="w-full divide-y divide-gray-200 " style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;background:rgb(39, 39, 42);padding:20px;">
    <thead class="" style="border-bottom: red solid;color:white;">

    <tr>
        @if(in_array('fieldId', $filters))
        <th scope="col" style="padding:5px;width:100%"
            wire:click="sortBy('id')">
            <div class="flex">Id</div>
        </th>
        @endif
        @if(in_array('fieldProviders_id', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('providers_id')">
            <div class="flex">Id del Proveedor</div>
        </th>
        @endif
        @if(in_array('fieldBills_id', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('bills_id')">
            <div class="flex">Numero de factura</div>
        </th>
        @endif
        @if(in_array('fieldName', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('name')">
            <div class="flex">Nombre</div>
        </th>
        @endif
        @if(in_array('fieldAmmount', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('ammount')">
            <div class="flex">Cantidad</div>
        </th>
        @endif
        @if(in_array('fieldPrice', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('price')">
            <div class="flex">Precio</div>
        </th>
        @endif
        @if(in_array('fieldDate', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('date')">
            <div class="flex">Fecha</div>
        </th>
        @endif
        @if(in_array('fieldType', $filters))
        <th scope="col" style="padding:5px;width:100%;"
            wire:click="sortBy('type')">
            <div class="flex">Tipo</div>
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
    @foreach($products as $product)
    @if(in_array($product->id, $filters))
    <tr class="">
        @if(in_array('fieldId', $filters))
        <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->id }}</div></td>
        @endif
        @if(in_array('fieldProviders_id', $filters))
        <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">
        

@foreach($providers as $provider)
                    @if($provider->id == $product->providers_id)
                    {{$provider->name}}
                    @else
                    @endif
                    @endforeach

        </div></td>
        @endif

        @if(in_array('fieldBills_id', $filters))
        <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->bills_id }}</div></td>
        @endif
        @if(in_array('fieldName', $filters))
        <td style="padding:10px;border:0px;" class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->name }}</div></td>
        @endif
        @if(in_array('fieldAmmount', $filters))
        <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->ammount }}</div></td>
        @endif
        @if(in_array('fieldPrice', $filters))
        <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->price }}</div></td>
        @endif
        @if(in_array('fieldDate', $filters))
        <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->updated_at}}</div></td>
        @endif
        @if(in_array('fieldType', $filters))
        <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">
                @if($product->type=='C')
                Compra
                @elseif($product->type=='I')
                Insumo
                @endif
            </div>
        </td>
        @endif
        @if(in_array('fieldStatus', $filters))
        <td class="px-6 py-4 whitespace-nowrap">
            @if($product->status=='1')
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