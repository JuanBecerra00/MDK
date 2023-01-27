
<div class="w-full flex justify-center items-center p-5 dark:text-white">
    <div class="sm:w-[70%] max-sm:w-[95%] pt-20 flex flex-col gap-5">
      <div class="flex justify-between">
        <p class="text-3xl">Reporte</p>
        <div class="bg-white dark:bg-zinc-700 rounded-xl shadow-xl p-3 flex gap-2">
          <div>
          Fecha: 
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
      @if($this->finished==false)
      <div class=" flex flex-col gap-5">
      <section class="w-full flex justify-center">
        <div class="w-[90%] ">
          <p class="text-xl">Datos del cliente</p>
          <div class="w-full shadow-xl rounded-xl p-5 bg-white dark:bg-zinc-700 flex flex-col gap-2">
            <div class="flex gap-2"><p class="text-xl">Cliente</p><p class="text-red-500 text-2xl">*</p></div>
            <div>
              <p>Numero de documento</p>
              <div>
                <div class="flex gap-2 items-center">
                  <input type="text" list="customers" value="{{$customer}}" class="border-0 border-black dark:border-white dark:bg-zinc-700 border-b ring-0 focus:ring-0 focus:border-black"
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
            <div class="flex gap-5 flex-wrap">
              <div class="flex flex-col gap-2">
                <p>Nombre</p>
                <div class="bg-zinc-200 dark:bg-zinc-600 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                  {{$customerName}}
                </div>
              </div>
              <div class="flex flex-col gap-2">
                <p>Email</p>
                <div class="bg-zinc-200 dark:bg-zinc-600 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                  {{$customerEmail}}
                </div>
              </div>
              <div class="flex flex-col gap-2">
                <p>Telefono</p>
                <div class="bg-zinc-200 dark:bg-zinc-600 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                  {{$customerPhone}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="w-full flex justify-center">
        <div class="w-[90%]">
          <p class="text-xl">Vehiculo</p>
          <div class="flex gap-5 flex-wrap 2xl:flex-nowrap items-center">
            <div class="w-full h-[15rem] shadow-xl rounded-xl p-5 bg-white dark:bg-zinc-700 flex flex-col gap-2">
            <div class="flex gap-2"><p class="text-xl">Vehiculo</p><p class="text-red-500 text-2xl">*</p></div>
              <div>
                <p>Placa</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="vehicles" value="{{$vehicle}}" wire:change="setVehicle($event.target.value)"
                    class="border-0 border-black dark:border-white dark:bg-zinc-700 border-b ring-0 focus:ring-0 focus:border-black">

                  <button class="rounded w-6 h-6 text-zinc-500
                  @if($vehicle=='')
                  invisible
                  @endif
                  " wire:click="resetVehicle()">Borrar</button>
                </div>
                <datalist id="vehicles">
                  @foreach($vehicles as $vehicle)
                    @if($this->customerId)
                        @if($vehicle->customer_id == $this->customerId && $vehicle->status==1)
                        <option value="{{$vehicle->id}}  {{$vehicle->plate}}">{{$vehicle->model}}</option>
                        @endif
                    @else
                        <option value="{{$vehicle->id}}  {{$vehicle->plate}}">{{$vehicle->model}}</option>
                    @endif
                  @endforeach
                </datalist>
              </div>
              <div class=" gap-5">
                <div class="flex flex-col gap-2">
                  <p>Modelo</p>
                  <div class="bg-zinc-200 dark:bg-zinc-600 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$this->vehicleModel}}
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full shadow-xl rounded-xl p-5 bg-white dark:bg-zinc-700 flex flex-col gap-2">
              <p class="text-xl">Aceites</p>
              <div class="flex flex-col gap-2">
                <p>Tipo</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="" wire:model="oilType" maxlength="50"
                    class="border-0 border-black dark:border-white dark:bg-zinc-700 border-b ring-0 focus:ring-0 focus:border-black">
                </div>
              </div>
              <div class="flex gap-5 max-sm:flex-wrap">
                <div class="flex flex-col gap-2">
                  <p>Caja</p>
                  <div class="flex gap-2 items-center pr-5">
                    <select wire:model="boxType" class="dark:bg-zinc-700 dark:border-white">
                      <option value="Ninguno">Ninguno</option>
                      <option value="c">De cambios</option>
                      <option value="t">De transferencia</option>
                    </select>
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <p>Diferencial</p>
                  <div class="flex gap-2 items-center pr-5">
                    <select wire:model="difType" class="dark:bg-zinc-700 dark:border-white">
                      <option value="Ninguno">Ninguno</option>
                      <option value="trans">Trans</option>
                      <option value="del">Del</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full shadow-xl rounded-xl p-5 bg-white dark:bg-zinc-700 flex flex-col gap-2">
              <div class="flex gap-2 items-center">
              <p class="text-xl">Filtros</p>
              </div>
              <?php
              //var_dump($this->oilFilterType)
              ?>
              <div class="grid grid-cols-2 gap-2 p-5 relative">
                <div class="w-full h-10 bg-zinc-300 rounded absolute duration-200 flex justify-end items-center px-4 opacity-0
                @if($this->oilFilterType=='')
                -translate-y-[10px]
                opacity-0
                @elseif($this->oilFilterType=='1')
                translate-y-[10px]
                opacity-50
                @elseif($this->oilFilterType=='2')
                translate-y-[43px]
                opacity-50
                @elseif($this->oilFilterType=='3')
                translate-y-[76px]
                opacity-50
                @elseif($this->oilFilterType=='4')
                translate-y-[109px]
                opacity-50
                @endif
                ">
                  <div class="w-2 opacity-0
                  @if($this->oilFilterType=='1')
                  drop1
                  @elseif($this->oilFilterType=='2')
                  drop2
                  @elseif($this->oilFilterType=='3')
                  drop3
                  @elseif($this->oilFilterType=='4')
                  drop4
                  @endif
                  ">
                  <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 30 30" version="1.1" id="svg822" inkscape:version="0.92.4 (f8dce91, 2019-08-02)" sodipodi:docname="drop.svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs816"> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1025" effect="bspline"></inkscape:path-effect> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1021" effect="bspline"></inkscape:path-effect> </defs> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="17.833333" inkscape:cx="15" inkscape:cy="15" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:window-width="1366" inkscape:window-height="713" inkscape:window-x="0" inkscape:window-y="0" inkscape:window-maximized="1" showguides="false" inkscape:guide-bbox="true"> <sodipodi:guide position="21.126168,22.794393" orientation="1,0" id="guide1575" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,23.285047" orientation="1,0" id="guide1635" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,7.6455921" orientation="0,1" id="guide1639" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="18.859863,18.859863" orientation="1,0" id="guide1242" inkscape:locked="false"></sodipodi:guide> <inkscape:grid type="xygrid" id="grid1103"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata819"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title> </dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-289.0625)"> <g id="layer1-3" inkscape:label="Layer 1" style="fill:#ffffff;stroke-width:1.41176474" transform="matrix(0.70833333,0,0,0.70833333,4.3750001,88.684897)"></g> <path style="opacity:1;fill:#000000;fill-opacity:1;stroke:none;stroke-width:2;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 23,309.0625 c 0,3.86599 -3.581722,7 -8.000001,7 -4.418277,0 -7.9999989,-3.13401 -7.9999989,-7 0,-3.86599 7.9999989,-17 7.9999989,-17 0,0 8.000001,13.13401 8.000001,17 z" id="path919" inkscape:connector-curvature="0" sodipodi:nodetypes="ssscs"></path> </g> </g></svg>
                  </div>

                  <div class="w-8
                  @if($this->oilFilterType=='1')
                  oil1 
                  @elseif($this->oilFilterType=='2')
                  oil2
                  @elseif($this->oilFilterType=='3')
                  oil3
                  @elseif($this->oilFilterType=='4')
                  oil4
                  @endif
                  ">
                  <svg fill="#000000" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">  <path d="M629.8 160.31L416 224l-50.49-25.24a64.07 64.07 0 0 0-28.62-6.76H280v-48h56c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16H176c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16h56v48h-56L37.72 166.86a31.9 31.9 0 0 0-5.79-.53C14.67 166.33 0 180.36 0 198.34v94.95c0 15.46 11.06 28.72 26.28 31.48L96 337.46V384c0 17.67 14.33 32 32 32h274.63c8.55 0 16.75-3.42 22.76-9.51l212.26-214.75c1.5-1.5 2.34-3.54 2.34-5.66V168c.01-5.31-5.08-9.15-10.19-7"></path></g></svg>
                  </div>
                
                </div>
                  <p class="z-20 w-[95px]">Aceite</p>
                <input type="checkbox" value="0" wire:click="setOilFilterType($event.target.value)" class="z-20 checked:bg-red-800 focus:ring-red-800 text-red-800 justify-self-center place-self-center"
                  class="justify-self-center self-center z-40">
                <p class="z-20 w-[95px]">Aire motor</p>
                <input type="checkbox" value="1" wire:click="setOilFilterType($event.target.value)" class="z-20 checked:bg-red-800 focus:ring-red-800 text-red-800 justify-self-center place-self-center"
                  class="justify-self-center self-center z-40">
                <p class="z-20 w-[95px]">Aire cabina</p>
                <input type="checkbox" value="2" wire:click="setOilFilterType($event.target.value)" class="z-20 checked:bg-red-800 focus:ring-red-800 text-red-800 justify-self-center place-self-center"
                  class="justify-self-center self-center z-40">
                <p class="z-20 w-[95px]">Combustible</p>
                <input type="checkbox" value="3" wire:click="setOilFilterType($event.target.value)" class="z-20 checked:bg-red-800 focus:ring-red-800 text-red-800 justify-self-center place-self-center"
                  class="justify-self-center self-center z-40">
              </div>
            </div>

          </div>
        </div>
      </section>

      


      <section class="w-full flex justify-center">
        <div class="w-[90%]">
        <div class="flex gap-2"><p class="text-xl">Diagnostico de llegada</p><p class="text-red-500 text-2xl">*</p></div>
          <div class="">
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            
            <div class="bg-white dark:bg-zinc-700 p-5 rounded-b-xl flex shadow-xl">
              <textarea maxlength="2000" class="w-full min-h-[20rem] dark:bg-zinc-800 focus:border-red-800 focus:ring-red-800" wire:model="prev"></textarea>
            </div>

          </div>
        </div>
      </section>


      <section class="w-full flex justify-center">
        <div class="w-[90%]">
        <div class="flex gap-2"><p class="text-xl">Procedimientos</p><p class="text-red-500 text-2xl">*</p></div>
          <div class="">
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            <div class="w-full overflow-x-auto">
            <table class="w-full shadow-xl">
              <thead class="text-white">
                <tr class="bg-zinc-800 dark:bg-zinc-900">
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
                  <th class="bg-white dark:bg-zinc-700
                  @if($this->procedureIsEdit==$key)
                  px-6 py-3
                  @elseif($val[0]!='' or  $val[1]!='')
                  px-6 py-3
                  @elseif($val[0]=='' or  $val[1]=='')
                  h-0
                  @endif">
                    @if($this->procedureIsEdit==$key)
                    <input type="text" wire:model.lazy="procedureName" class="border-0 border-b border-black dark:border-white dark:bg-zinc-700 ring-0 focus:ring-0 focus:border-black">
                    @elseif($val[0] && $val[1])
                    {{$val[0]}}
                    @endif
                  </th>
                  <th class="bg-white dark:bg-zinc-700 
                  @if($this->procedureIsEdit==$key)
                  px-6 py-3
                  @elseif($val[0]!='' or  $val[1]!='')
                  px-6 py-3
                  @elseif($val[0]=='' or  $val[1]=='')
                  h-0
                  @endif">
                    @if($this->procedureIsEdit==$key)
                    <input type="number" wire:model.lazy="procedurePrice" class="border-0 border-b border-black dark:border-white dark:bg-zinc-700 ring-0 focus:ring-0 focus:border-black">
                    @elseif($val[0] && $val[1])
                    {{$val[1]}}
                    @endif
                  </th>
                  <th class="bg-white dark:bg-zinc-700">
                    @if($this->procedureIsEdit==$key)
                    <x-jet-button wire:click="procedureSave()" class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                      Guardar
                    </x-jet-button>
                    @elseif($val[0] && $val[1])
                    <x-jet-button wire:click="procedureEdit({{ $key}})"
                      class="bg-zinc-800 dark:bg-zinc-900 hover:bg-zinc-900 active:bg-zinc-700">
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
            </div>
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full flex justify-end text-white rounded-b-2xl px-6 py-4">
                Total:
                {{$porcedureTotal}}
              </div>

          </div>
        </div>
      </section>

      <section class="w-full flex justify-center">
        <div class="w-[90%]">
          <p class="text-xl">Productos</p>
          <div class="">
            <div class="w-full bg-zinc-800 dark:bg-zinc-900 sm:flex items-center place-content-between p-5 relative rounded-t-xl">
              <div class="flex max-sm:flex-col gap-5 items-center">
                <div class="flex items-center flex-wrap justify-center gap-2">
              <p class="text-white flex items-center">
                Buscar
              </p>
              <input wire:model="search" type="search"
                placeholder="nombre, cantidad, precio, fecha, id, id del proveedor, id de la factura"
                class="rounded max-sm:w-full dark:bg-zinc-800 dark:text-white focus:border-red-800 focus:ring-red-800">
                </div>
                <div class="flex gap-5 max-sm:flex-col items-center justify-center flex-wrap">


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
            <div class="bg overflow-x-auto">
              <table class="w-full">
                <thead class="text-white">
                  <tr class="bg-zinc-800 dark:bg-zinc-900">
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
                      <div class="px-6 py-3">Inventario</div>
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
                  <tr class="w-full bg-white dark:bg-zinc-700">
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="flex justify-center items-center"><input type="checkbox"
                          wire:change="productAdd($event.target.value, {{$product->id}})" class="checked:bg-red-800 focus:ring-red-800 text-red-800 justify-self-center" @if(array_search($product->id,
                        $this->productsSelected))
                        checked
                        @endif
                        >
                      </div>
                    </td>
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 flex justify-center whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->id }}</div>
                    </td>
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->name }}</div>
                    </td>
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->ammount }}</div>
                    </td>
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">{{ $product->price }}</div>
                    </td>
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">
                        <input type="number" min="0" max="{{$product->ammount}}" maxlength='3' class="w-full border-0 focus:border-black
                        @if(!array_search($product->id, $this->productsSelected))
                        dark:bg-zinc-700 rounded
                        @else
                        border-black dark:border-white dark:bg-zinc-700 border-b
                        @endif
                        "
                        wire:change="productSave({{$product->id}}, {{$product->price}}, $event.target.value, {{$product->ammount}})"
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
                    <td class="bg-white dark:bg-zinc-700 px-6 py-4 whitespace-nowrap">
                      <div class="max-w-[12rem] overflow-x-auto">
                        <p>
                          <?php
                $a=array_search($product->id, $this->productsSelected);
                if($a){
                  echo $this->productsAmmount[$a][2];
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
            </div>
              <div class="p-2 bg-zinc-800 dark:bg-zinc-900 mt-2">
                {{ $products->links() }}
              </div>
            
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full flex justify-end text-white rounded-b-2xl px-6 py-4">
                Total:
                {{$this->total}}
              </div>
            <?php
            //var_dump($this->productsAmmount);
            //var_dump($this->productsSelected);
            ?>

          </div>
        </div>
      </section>
      <section class="w-full flex justify-center">
        <div class="w-[90%]">
        <div class="flex gap-2"><p class="text-xl">Diagnostico de salida</p><p class="text-red-500 text-2xl">*</p></div>
          <div class="">
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            
            <div class="bg-white dark:bg-zinc-700 p-5 rounded-b-xl flex shadow-xl">
              <textarea maxlength="2000" class="w-full min-h-[20rem] dark:bg-zinc-800 focus:border-red-800 focus:ring-red-800" wire:model="post"></textarea>
            </div>

          </div>
        </div>
      </section>
      <section class="w-full flex justify-center">
        <div class="w-[90%]">
          <p class="text-xl">Observaciones</p>
          <div class="">
            <div class="bg-zinc-800 dark:bg-zinc-900 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            
            <div class="bg-white dark:bg-zinc-700 p-5 rounded-b-xl flex shadow-xl">
              <textarea maxlength="2000" class="w-full min-h-[20rem] dark:bg-zinc-800 focus:border-red-800 focus:ring-red-800" wire:model="observations"></textarea>
            </div>

          </div>
        </div>
      </section>
      <section class="flex justify-end max-sm:justify-center">
        <div class="">
          <p class="text-xl"></p>
          <div class="">
            
            <div class="bg-white dark:bg-zinc-700 p-5 rounded-xl flex justify-center items-center shadow-xl">
                <p class="text-xl">Total: {{$this->totalFinal}}</p>
                <div class="bg-white dark:bg-zinc-700 rounded-b-xl flex justify-center relative w-10 h-10">
                    <svg fill="#1ca800" height="200px" width="200px" version="1.1" id="Capa_1" class="h-10" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 486.201 486.201" xml:space="preserve" stroke="#1ca800"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g><path d="M397.3,243.097c0-85.2-69-154.2-154.2-154.2s-154.2,69-154.2,154.2s69,154.2,154.2,154.2S397.3,328.297,397.3,243.097z M287.4,303.897c-6.7,8.2-15.5,13.7-25.7,16.5c-4.5,1.2-6.5,3.6-6.2,8.2c0.2,4.5,0,9.1,0,13.7c0,4.1-2.1,6.2-6.1,6.3 c-2.6,0.1-5.2,0.1-7.8,0.1c-2.3,0-4.6,0-6.9-0.1c-4.3-0.1-6.3-2.5-6.4-6.7c0-3.3-0.1-6.7-0.1-10c-0.1-7.3-0.3-7.6-7.4-8.8 c-9-1.4-17.9-3.5-26.2-7.5c-6.5-3.2-7.2-4.8-5.3-11.6c1.4-5.1,2.8-10.1,4.4-15.2c1.2-3.7,2.2-5.3,4.2-5.3c1.1,0,2.6,0.5,4.6,1.6 c9.1,4.8,18.9,7.4,29,8.7c1.7,0.2,3.5,0.3,5.2,0.3c4.8,0,9.4-0.9,13.9-2.8c11.3-4.9,13.1-18.1,3.5-26c-3.3-2.7-7-4.7-10.8-6.4 c-9.9-4.4-20.3-7.7-29.7-13.3c-15.2-9.1-24.9-21.6-23.8-40.2c1.3-21,13.1-34,32.3-41c7.9-2.9,8-2.8,8-11.1c0-2.8,0-5.6,0-8.4 c0.2-6.2,1.2-7.3,7.4-7.5c0.7,0,1.4,0,2.2,0c1.2,0,2.4,0,3.6,0c0.5,0,1,0,1.4,0c11.8,0,11.8,0.5,11.9,13.2c0,9.4,0,9.4,9.4,10.9 c7.1,1.1,14,3.2,20.6,6.1c3.6,1.6,5,4.2,3.9,8c-1.7,5.7-3.2,11.5-5,17.1c-1.1,3.5-2.2,5-4.2,5c-1.1,0-2.5-0.5-4.3-1.4 c-9.2-4.4-18.7-6.6-28.7-6.6c-1.3,0-2.6,0-3.9,0.1c-3,0.2-5.9,0.6-8.7,1.8c-9.9,4.3-11.5,15.2-3.1,21.9c4.2,3.4,9.1,5.9,14.2,8 c8.7,3.6,17.5,7.1,25.8,11.7C298.9,248.097,306,281.297,287.4,303.897z"></path> </g> </g> </g></svg>
                    <!--<svg fill="#1ca800" height="200px" width="200px" version="1.1" id="Capa_1" class="absolute w-10 h-10 animate-spin-slow" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 486.201 486.201" xml:space="preserve" stroke="#1ca800"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M325.5,66.897c6.7-14.4,13.4-28.8,20.5-44.1c-78.2-32.9-154.4-31.3-227.4,12.1c-70.5,42-108.8,105.7-118.6,187.8 c16.8,1.5,32.6,2.8,48.4,4.2C57,102.897,194.1,7.797,325.5,66.897z"></path> <path d="M482.7,201.697c-15.7,2.7-31.4,5.5-47.7,8.3c8.4,56.8-3.2,107.9-37.9,152.8c-34.5,44.6-80.6,69.1-137.1,75.4 c1.4,16,2.7,31.7,4.1,47.3C382.3,481.297,509,362.497,482.7,201.697z"></path> <path d="M47.7,260.997c-15,1.3-30.7,2.7-46.4,4c3.6,99.1,90.1,210.6,220.5,221.2c1.4-16.1,2.8-31.7,4.1-47 C124,422.197,64.9,363.097,47.7,260.997z"></path> a<path d="M397.3,125.097c12.2,15.8,21.5,33,28.8,52.2c15.2-5.5,30.1-10.9,45.7-16.6c-18.1-48-47.5-86.2-89.2-116.2 c-9.3,13.2-18.4,26.2-27.9,39.8C370.8,95.997,385.2,109.397,397.3,125.097z"></path> </g> </g> </g></svg>-->
                </div>
            </div>

          </div>
        </div>
      </section>
      <section class="w-full flex justify-end">
                <div class="flex gap-5">
                <x-jet-button class="w-24 h-12 duration-300 flex justify-center items-center" wire:click="modal(true)">
                    {{ __('Guardar') }}
                </x-jet-button>
                </div>
      </section>
      </div>
      @elseif($this->finished==true)
      <div class="w-full h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex justify-center items-center shadow-xl">
        <div class="flex  h-40">
          <div class="text-green-500 w-40">
          <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Checkmark</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M416 128L192 384l-96-96"/></svg>
          </div>
          <div>
          <div class="text-2xl h-20 flex items-end">
            Reporte terminado
          </div>
          
          <div class="text-xl h-20 flex items-start opacity-50">
            {{Auth::user()->name}}
          </div>
          </div>
        </div>
      </div>
      @endif
    </div>
    <x-jet-dialog-modal wire:model="showingBillModal">
            <x-slot name="title">Guardar reporte</x-slot>
            <x-slot name="content">
              <div class="space-y-8 divide-y divide-gray-200 mt-10">
                ¿Seguro de que desea guardar este informe?<p class="text-red-500 mb-10">>>No se podra editar despues<<</p>
                
                @error('customer') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                @error('vehicle') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                @error('strProcedures') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                @error('prev') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                @error('post') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                @error('strProductsAmmount') <span class="error text-red-500">
                <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Alert Circle</title><path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/><path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/><path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg></div>  
                {{ $message }}
                </div></span> @enderror
                
        </div>

        </x-slot>
        <x-slot name="footer">
          <div class="w-full flex gap-5 place-content-between">
              <x-jet-button wire:click="modal(false)" type="button"
                class="bg-zinc-800 dark:bg-zinc-900 dark:bg-zinc-900 hover:bg-zinc-900 active:bg-zinc-700">Cerrar</x-jet-button>

          <x-jet-button wire:click="saveReport()"
                class="bg-red-800 hover:bg-red-900 active:bg-red-700">Guardar</x-jet-button>
          </div>
        </x-slot>
        </x-jet-dialog-modal>
  </div>
  