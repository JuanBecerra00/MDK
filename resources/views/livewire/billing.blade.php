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
                @if($customer->status==1)
                <option value="{{$customer->id}}  {{$customer->cc}}">{{$customer->name}}</option>
                @endif
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
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Vehiculo</p>
          <div class="flex gap-5 flex-wrap lg:flex-nowrap">
            <div class="w-full h-[15rem] shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Vehiculo</p>
              <div class="">
                <p>Placa</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="vehicles" value="{{$vehicle}}" wire:change="setVehicle($event.target.value)"
                    class="border-0 border-black border-b">

                  <button class="rounded w-6 h-6 text-zinc-500
                  @if($vehicle=='')
                  invisible
                  @endif
                  " wire:click="resetVehicle()">Borrar</button>
                </div>
                <datalist id="vehicles">
                  @foreach($vehicles as $vehicle)
                  @if($vehicle->customer_id == $customerSelected && $vehicle->status==1)
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
                  <input type="text" list="vehicles" wire:change="setVehicle($event.target.value)"
                    class="border-0 border-black border-b">
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
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)"
                  class="justify-self-center">
                <p>Aire motor</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)"
                  class="justify-self-center">
                <p>Aire cabina</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)"
                  class="justify-self-center">
                <p>Combustible</p>
                <input type="checkbox" list="vehicles" wire:change="setVehicle($event.target.value)"
                  class="justify-self-center">
              </div>
            </div>

          </div>
        </div>
      </section>
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Procedimientos</p>
          <div class="">
            <div class="bg-zinc-800 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            <table class="w-full shadow-xl">
              <thead class="text-white">
                <tr class="bg-zinc-800">
                  <th class="">
                    <div class="px-6 py-3">Procedimiento</div>
                  </th>
                  <th class="w-56">
                    <div class="px-6 py-3">Precio</div>
                  </th>
                  <th class="w-56">
                    <div class="px-6 py-3">Acciones</div>
                  </th>
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
                    <x-jet-button wire:click="procedureSave()" class="bg-red-800 hover:bg-red-900 active:bg-red-700">
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
            <div class="w-full bg-zinc-800 sm:flex items-center place-content-between p-5 relative rounded-t-xl">
              <div class="flex max-sm:flex-col gap-5 items-center">
                <p class="text-white flex items-center">
                  Buscar

                  <button class="w-5 h-5" wire:click="showHowToSearchModal()">
                    <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                      <title>¿Como funciona la busqueda?</title>
                      <path d="M256 80a176 176 0 10176 176A176 176 0 00256 80z" fill="none" stroke="currentColor"
                        stroke-miterlimit="10" stroke-width="32" />
                      <path
                        d="M200 202.29s.84-17.5 19.57-32.57C230.68 160.77 244 158.18 256 158c10.93-.14 20.69 1.67 26.53 4.45 10 4.76 29.47 16.38 29.47 41.09 0 26-17 37.81-36.37 50.8S251 281.43 251 296"
                        fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10"
                        stroke-width="28" />
                      <circle fill="currentColor" stroke="currentColor" cx="250" cy="348" r="20" />
                    </svg>
                  </button>
                </p>
                <input wire:model="search" type="search"
                  placeholder="nombre, cantidad, precio, fecha, id, id del proveedor, id de la factura"
                  class="rounded max-sm:w-full">
                <div class="flex gap-5 max-sm:flex-col items-center justify-center">


                  <x-jet-dropdown align="left" width="48">
                    <x-slot name="trigger">
                      <span class="inline-flex rounded-md">
                        <button type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-800 hover:bg-red-700 focus:bg-red-900 focus:outline-none transition shadow-[0px_8px_10px_0px_rgba(0,0,0,0.3)]">
                          Tipo:
                          @if($filterType=='C')
                          Compras
                          @elseif($filterType=='I')
                          Insumos
                          @else
                          Todos
                          @endif

                          <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg>
                        </button>
                      </span>
                    </x-slot>

                    <x-slot name="content">
                      <!-- Account Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Tipo') }}
                      </div>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="filterType('')">
                        Todos
                      </button>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="filterType('C')">
                        Compras
                      </button>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="filterType('I')">
                        Insumos
                      </button>
                    </x-slot>
                  </x-jet-dropdown>

                  <x-jet-dropdown align="left" width="48">
                    <x-slot name="trigger">
                      <span class="inline-flex rounded-md">
                        <button type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-800 hover:bg-red-700 focus:bg-red-900 focus:outline-none transition shadow-[0px_8px_10px_0px_rgba(0,0,0,0.3)]">
                          Elementos: {{ $paginate }}

                          <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg>
                        </button>
                      </span>
                    </x-slot>

                    <x-slot name="content">
                      <!-- Account Management -->
                      <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Elementos por página') }}
                      </div>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="changePaginate(5)">
                        5
                      </button>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="changePaginate(10)">
                        10
                      </button>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="changePaginate(15)">
                        15
                      </button>
                      <button
                        class="w-full text-start block px-4 py-2 text-sm leading-5 text-white hover:bg-zinc-700 focus:outline-none focus:bg-zinc-900 transition"
                        wire:click="changePaginate('')">
                        Todos
                      </button>
                    </x-slot>
                  </x-jet-dropdown>




                </div>
              </div>

            </div>
            <div class="bg">
              <table class="w-full">
                <thead class="text-white">
                  <tr class="bg-zinc-800">
                    <th class="">
                      <div class="px-6 py-3 flex justify-center"></div>
                    </th>
                    <th class="">
                      <div class="px-6 py-3 flex justify-center">Id</div>
                    </th>
                    <th class="">
                      <div class="px-6 py-3">Nombre</div>
                    </th>
                    <th class="">
                      <div class="px-6 py-3">Valor Unitario</div>
                    </th>
                    <th class="">
                      <div class="px-6 py-3">Cantidad</div>
                    </th>
                    <th class="">
                      <div class="px-6 py-3">Subtotal</div>
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $product)
                  @if($product->status==1)
                  <tr class="w-full bg-white">
                    <td class="bg-white px-6 py-4 whitespace-nowrap">
                      <div class="flex justify-center items-center"><input type="checkbox"
                          wire:change="productAdd($event.target.value, {{$product->id}})" @if(array_search($product->id,
                        $this->productsSelected))
                        checked
                        @endif
                        >
                      </div>
                    </td>
                    <td class="bg-white px-6 py-4 flex justify-center whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->id }}</div>
                    </td>
                    <td class="bg-white px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->name }}</div>
                    </td>
                    <td class="bg-white px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->price }}</div>
                    </td>
                    <td class="bg-white px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">
                        <input type="number" max="{{$product->ammount}}" class="w-full border-0 
                        @if(!array_search($product->id, $this->productsSelected))
                        bg-zinc-200
                        @else
                        border-black border-b
                        @endif
                        "
                        wire:change="productSave({{$product->id}}, {{$product->price}}, $event.target.value)"
                        @if(!array_search($product->id, $this->productsSelected))
                        disabled
                        @else
                        <?php
                          $a=array_search($product->id, $this->productsSelected);
                          $v=$this->productsAmmount[$a][1];
                        ?>
                        value="{{$v}}"
                        @endif
                        >
                      </div>
                    </td>
                    <td class="bg-white px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">
                        <p>
                          <?php
                $a=array_search($product->id, $this->productsSelected);
                if($a){
                  echo $this->productsAmmount[$a][2];
                  $this->total+=$this->productsAmmount[$a][2];
                }
                  ?>
                        </p>
                      </div>
                    </td>
                  </tr>
                  @endif
                  @endforeach
                </tbody>
              </table>
              <div class="m-2 p-2">
                {{ $products->links() }}
              </div>
              <div class="bg-zinc-800 w-full flex justify-end text-white rounded-b-2xl px-6 py-4">
                Total:
                {{$this->total}}
              </div>
            </div>
            {{$this->test}}<br>
            <?php
            var_dump($this->productsAmmount);
            var_dump($this->productsSelected);
            ?>
            <div class="bg-white w-full p-5 rounded-b-xl flex justify-end shadow-xl">
            </div>

          </div>
        </div>
      </section>

    </div>
  </div>