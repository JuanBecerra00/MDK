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
              <?php
              //var_dump($this->oilType)
              ?>
              <div class="grid grid-cols-2 gap-2 p-5 relative">
                <div class="w-full h-10 bg-zinc-300 rounded absolute opacity-50 duration-200 flex justify-end items-center px-4
                @if($this->oilType=='1')
                translate-y-[10px]
                @elseif($this->oilType=='2')
                translate-y-[43px]
                @elseif($this->oilType=='3')
                translate-y-[76px]
                @elseif($this->oilType=='4')
                translate-y-[109px]
                @endif
                ">
                  <div class="w-2 opacity-0
                  @if($this->oilType=='1')
                  drop1
                  @elseif($this->oilType=='2')
                  drop2
                  @elseif($this->oilType=='3')
                  drop3
                  @elseif($this->oilType=='4')
                  drop4
                  @endif
                  ">
                  <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 30 30" version="1.1" id="svg822" inkscape:version="0.92.4 (f8dce91, 2019-08-02)" sodipodi:docname="drop.svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs816"> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1025" effect="bspline"></inkscape:path-effect> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1021" effect="bspline"></inkscape:path-effect> </defs> <sodipodi:namedview id="base" pagecolor="#ffffff" bordercolor="#666666" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="17.833333" inkscape:cx="15" inkscape:cy="15" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:window-width="1366" inkscape:window-height="713" inkscape:window-x="0" inkscape:window-y="0" inkscape:window-maximized="1" showguides="false" inkscape:guide-bbox="true"> <sodipodi:guide position="21.126168,22.794393" orientation="1,0" id="guide1575" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,23.285047" orientation="1,0" id="guide1635" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,7.6455921" orientation="0,1" id="guide1639" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="18.859863,18.859863" orientation="1,0" id="guide1242" inkscape:locked="false"></sodipodi:guide> <inkscape:grid type="xygrid" id="grid1103"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata819"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title> </dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-289.0625)"> <g id="layer1-3" inkscape:label="Layer 1" style="fill:#ffffff;stroke-width:1.41176474" transform="matrix(0.70833333,0,0,0.70833333,4.3750001,88.684897)"></g> <path style="opacity:1;fill:#000000;fill-opacity:1;stroke:none;stroke-width:2;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 23,309.0625 c 0,3.86599 -3.581722,7 -8.000001,7 -4.418277,0 -7.9999989,-3.13401 -7.9999989,-7 0,-3.86599 7.9999989,-17 7.9999989,-17 0,0 8.000001,13.13401 8.000001,17 z" id="path919" inkscape:connector-curvature="0" sodipodi:nodetypes="ssscs"></path> </g> </g></svg>
                  </div>

                  <div class="w-8
                  @if($this->oilType=='1')
                  oil1 
                  @elseif($this->oilType=='2')
                  oil2
                  @elseif($this->oilType=='3')
                  oil3
                  @elseif($this->oilType=='4')
                  oil4
                  @endif
                  ">
                  <svg fill="#000000" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">  <path d="M629.8 160.31L416 224l-50.49-25.24a64.07 64.07 0 0 0-28.62-6.76H280v-48h56c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16H176c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16h56v48h-56L37.72 166.86a31.9 31.9 0 0 0-5.79-.53C14.67 166.33 0 180.36 0 198.34v94.95c0 15.46 11.06 28.72 26.28 31.48L96 337.46V384c0 17.67 14.33 32 32 32h274.63c8.55 0 16.75-3.42 22.76-9.51l212.26-214.75c1.5-1.5 2.34-3.54 2.34-5.66V168c.01-5.31-5.08-9.15-10.19-7"></path></g></svg>
                  </div>
                
                </div>
                <p>Aceite</p>
                <input type="radio" name="oilType" value="1" wire:click="setOilType($event.target.value)"
                @if($this->oilType=='1')
                checked
                @endif
                  class="justify-self-center self-center z-40">
                <p>Aire motor</p>
                <input type="radio" name="oilType" value="2" wire:click="setOilType($event.target.value)"
                @if($this->oilType=='2')
                checked
                @endif
                  class="justify-self-center self-center z-40">
                <p>Aire cabina</p>
                <input type="radio" name="oilType" value="3" wire:click="setOilType($event.target.value)"
                @if($this->oilType=='3')
                checked
                @endif
                  class="justify-self-center self-center z-40">
                <p>Combustible</p>
                <input type="radio" name="oilType" value="4" wire:click="setOilType($event.target.value)"
                @if($this->oilType=='4')
                checked
                @endif
                  class="justify-self-center self-center z-40">
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
                        bg-zinc-200 rounded
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
            <?php
            //var_dump($this->productsAmmount);
            //var_dump($this->productsSelected);
            ?>

          </div>
        </div>
      </section>
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Observaciones</p>
          <div class="">
            <div class="bg-zinc-800 w-full p-5 rounded-t-xl flex justify-end">
            </div>
            
            <div class="bg-white p-5 rounded-b-xl flex shadow-xl">
              <textarea class="w-full min-h-[20rem]" wire:model="observations"></textarea>
            </div>

          </div>
        </div>
      </section>
      {{$this->observations}}
    </div>
  </div>