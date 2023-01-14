<div class="w-full flex justify-center items-center p-5">
    <div class="w-[70%] pt-20 flex flex-col gap-5">
      <div class="flex justify-between">
      <p class="text-3xl">Facturación</p>
      <div class="bg-white rounded-xl shadow-xl p-3 flex gap-2">
        <div>
          <?php
          echo date('d');
          ?>
        </div>
        <p class="text-slate-300">|</p>
        <div>
          <?php
          echo date('m');
          ?>
        </div>
        <p class="text-slate-300">|</p>
        <div>
          <?php
          echo date('y');
          ?>
        </div>
      </div>
      </div>
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Datos del cliente</p>
          <div class="w-full sm:h-[15rem] shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Cliente</p>
              <div>
                <p>Numero de documento</p>
                <div>
                  <div class="flex gap-2 items-center">
                    <input type="text" list="customers" value="{{$customer}}" class="border-0 border-black border-b"
                      wire:change="setCustomer($event.target.value)">
                    @if($customer)
                    <button button class="rounded w-6 h-6 text-zinc-500" wire:click="resetCustomer()">Borrar</button>
                    @endif
                  </div>
                </div>
                <datalist id="customers">
                  @foreach($customers as $customer)
                  <option value="{{$customer->id}}  {{$customer->cc}}">{{$customer->name}}</option>
                  @endforeach
                </datalist>
              </div>
              <div class="flex gap-5 max-sm:flex-wrap">
                <div class="flex flex-col gap-2">
                  <p>Nombre</p>
                  <div class="bg-zinc-200 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerName}}
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <p>Email</p>
                  <div class="bg-zinc-200 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerEmail}}
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <p>Telefono</p>
                  <div class="bg-zinc-200 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerPhone}}
                  </div>
                </div>
              </div>
            </div>
        </div>
      </section>
      ///////////////
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Vehiculo</p>
          <div class="flex gap-5 flex-wrap lg:flex-nowrap">
            <div class="w-full h-[15rem] shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Vehiculo</p>
              <div class="">
                <p>Placa</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="vehicles" value="{{$vehicle}}" wire:change="setVehicle($event.target.value)" class="border-0 border-black border-b">

                  <button class="rounded w-6 h-6 text-zinc-500
                  @if($vehicle=='')
                  invisible
                  @endif
                  " wire:click="resetVehicle()">Borrar</button>
                </div>
                <datalist id="vehicles">
                  @foreach($vehicles as $vehicle)
                  @if($vehicle->customer_id == $customerSelected)
                  <option value="{{$vehicle->id}}  {{$vehicle->plate}}">{{$vehicle->model}}</option>
                  @endif
                  @endforeach
                </datalist>
              </div>
              <div class=" gap-5">
                <div class="flex flex-col gap-2">
                  <p>Modelo</p>
                  <div class="bg-zinc-200 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$this->vehicleModel}}
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Aceites</p>
              <div class="flex flex-col gap-2">
                <p>Tipo</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="vehicles" wire:change="setVehicle($event.target.value)" class="border-0 border-black border-b">
                </div>
              </div>
              <div class="flex gap-5">
              <div class="flex flex-col gap-2">
                <p>Caja</p>
                <div class="flex gap-2 items-center pr-5">
                  <select>
                    <option value="c">de cambios</option>
                    <option value="t">de transferencia</option>
                  </select>
                </div>
              </div>
              <div class="flex flex-col gap-2">
                <p>Diferencial</p>
                <div class="flex gap-2 items-center pr-5">
                  <select>
                    <option value="trans">Trans</option>
                    <option value="del">Del</option>
                  </select>
                </div>
              </div>
              </div>
            </div>

            <div class="w-full shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Filtros</p>
              <div class="grid grid-cols-2 gap-2 p-5">
                <p>Aceite</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)" class="justify-self-center">
                <p>Aire motor</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)" class="justify-self-center">
                <p>Aire cabina</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)" class="justify-self-center">
                <p>Combustible</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)" class="justify-self-center">
              </div>
            </div>
            
          </div>
        </div>
      </section>
      ////////////////
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Procedimientos</p>
          <div class="">
          <div class="bg-zinc-800 w-full p-5 rounded-t-xl flex justify-end">
          </div>
          <table class="w-full shadow-xl">
              <thead class="text-white">
                <tr class="bg-zinc-800">
                  <th class=""><div class="px-6 py-3">Procedimiento</div></th>
                  <th class="w-56"><div class="px-6 py-3">Precio</div></th>
                  <th class="w-56"><div class="px-6 py-3">Acciones</div></th>
                </tr>
              </thead>
              <tbody>
                @foreach($this->procedures as $key => $val)
                <tr class="w-full">
                  <th class="bg-white
                  @if($this->procedureIsEdit==$key)
                  px-6 py-3
                  @elseif($val[0]!='' or  $val[1]!='')
                  px-6 py-3
                  @elseif($val[0]=='' or  $val[1]=='')
                  h-0
                  @endif">
                    @if($this->procedureIsEdit==$key)
                    <input type="text" wire:model.lazy="procedureName" class="">
                    @elseif($val[0] && $val[1])
                    {{$val[0]}}
                    @endif
                  </th>
                  <th class="bg-white 
                  @if($this->procedureIsEdit==$key)
                  px-6 py-3
                  @elseif($val[0]!='' or  $val[1]!='')
                  px-6 py-3
                  @elseif($val[0]=='' or  $val[1]=='')
                  h-0
                  @endif">
                  @if($this->procedureIsEdit==$key)
                    <input type="number" wire:model.lazy="procedurePrice">
                    @elseif($val[0] && $val[1])
                    {{$val[1]}}
                    @endif
                  </th>
                  <th class="bg-white">
                    @if($this->procedureIsEdit==$key)
                    <x-jet-button wire:click="procedureSave()"
                      class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                        Guardar
                    </x-jet-button>
                  @elseif($val[0] && $val[1])
                    <x-jet-button wire:click="procedureEdit({{ $key}})"
                      class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">
                        Editar
                    </x-jet-button>
                    <x-jet-button wire:click="procedureDelete({{ $key}})"
                      class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                        Quitar
                    </x-jet-button>
                    @endif
                  </th>
                </tr>
                @endforeach
              </tbody>
            </table>
          <div class="bg-white w-full p-5 rounded-b-xl flex justify-end shadow-xl">
          </div>
            
          </div>
        </div>
      </section>


      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Productos</p>
          <div class="">
          <div class="bg-zinc-800 w-full p-5 rounded-t-xl flex justify-end">
          </div>
          <table class="w-full shadow-xl">
              <thead class="text-white">
                <tr class="bg-zinc-800">
                  <th class=""><div class="px-6 py-3 flex justify-center">Id</div></th>
                  <th class=""><div class="px-6 py-3">Nombre</div></th>
                  <th class=""><div class="px-6 py-3">Cantidad</div></th>
                  <th class=""><div class="px-6 py-3">Valor Unitario</div></th>
                </tr>
              </thead>
              <tbody>
                @foreach($products as $product)
                  @if($product->type=='C')
                  <tr class="w-full">
                <td class="px-6 py-4 flex justify-center whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->id }}</div></td>
                <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->name }}</div></td>
                <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->ammount }}</div></td>
                <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $product->price }}</div></td>
                </tr>
                  @endif
                @endforeach
              </tbody>
            </table>
          <div class="bg-white w-full p-5 rounded-b-xl flex justify-end shadow-xl">
          </div>
            
          </div>
        </div>
      </section>
      
  </div>
  </div>