<div class="w-full flex justify-center items-center p-5 dark:text-white">
  <div class="sm:w-[70%] max-sm:w-[95%] pt-20 flex flex-col gap-5">
    <div class="flex justify-between">
      <p class="text-3xl">Reporte</p>
      <div class="bg-white dark:bg-zinc-700 rounded-xl shadow-xl p-3 flex gap-2">
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
    @if($this->goFacturate==false)
    <section class="w-full flex justify-center">
      <div class="w-[90%] ">
        <p class="text-xl">Buscar reporte</p>
        <div class="w-full shadow-xl rounded-xl p-5 bg-white dark:bg-zinc-700 flex flex-col gap-5">
          <div class="flex gap-2">
            <p class="text-xl">Cliente</p>
            <p class="text-red-500 text-2xl">*</p>
          </div>
          <div class="flex gap-5 flex-wrap bg-zinc-200 dark:bg-zinc-600 p-5 rounded-xl">
            <div class="">
              <p>Numero de documento</p>
              <div>
                <div class="flex gap-2">
                  <input type="text" list="customers" value="{{$customer}}"
                    class="border-0 border-black dark:border-white bg-zinc-200 dark:bg-zinc-600 border-b ring-0 focus:ring-0 focus:border-black"
                    wire:change="setCustomer($event.target.value)">
                  @if($this->customer)
                  <button button class="rounded w-15 h-6 text-white bg-red-800 px-2 rounded hover:bg-red-900 active:bg-red-700 duration-200" wire:click="resetCustomer()">X</button>
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
            <div class="flex flex-col gap-2">
              <p>Nombre</p>
              <div class="bg-zinc-100 dark:bg-zinc-500 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10 max-sm:w-[14rem]">
                {{$customerName}}
              </div>
            </div>
            <div class="flex flex-col gap-2">
              <p>Email</p>
              <div class="bg-zinc-100 dark:bg-zinc-500 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10 max-sm:w-[14rem]">
                {{$customerEmail}}
              </div>
            </div>
            <div class="flex flex-col gap-2">
              <p>Telefono</p>
              <div class="bg-zinc-100 dark:bg-zinc-500 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10 max-sm:w-[14rem]">
                {{$customerPhone}}
              </div>
            </div>
          </div>
          <div class="flex gap-5 flex-wrap bg-zinc-200 dark:bg-zinc-600 p-5 rounded-xl">

            <div class="">
              <div class="flex gap-2">
                <p class="text-xl">Vehiculo</p>
                <p class="text-red-500 text-2xl">*</p>
              </div>
              <div class="flex flex-wrap">
                <div class="">
                  <p>Placa</p>
                  <div class="flex gap-2 pr-5">
                    <input type="text" list="vehicles" value="{{$vehicle}}"
                      wire:change="setVehicle($event.target.value)"
                      class="border-0 border-black dark:border-white bg-zinc-200 dark:bg-zinc-600 border-b ring-0 focus:ring-0 focus:border-black">
                    @if($this->vehicle)
                    <button button class="rounded w-15 h-6 text-white bg-red-800 px-2 rounded hover:bg-red-900 active:bg-red-700 duration-200" wire:click="resetVehicle()">X</button>
                    @endif
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
                    <div
                      class="bg-zinc-100 dark:bg-zinc-500 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10 max-sm:w-[14rem]">
                      {{$this->vehicleModel}}
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="flex gap-5 flex-wrap bg-zinc-200 dark:bg-zinc-600 p-5 rounded-xl flex-col">
          <div class="flex gap-2">
            <p class="text-xl">Reporte</p>
            <p class="text-red-500 text-2xl">*</p>
          </div>
            <div class="flex gap-5 flex-wrap">
            <div class="">
              <p>ID/Fecha</p>
              <div>
                <div class="flex gap-2">
                  <input type="text" list="reports" value="{{$this->report}}" wire:change="setReport($event.target.value)"
                    class="border-0 border-black dark:border-white bg-zinc-200 dark:bg-zinc-600 border-b ring-0 focus:ring-0 focus:border-black">
                  @if($this->report)
                  <button button class="rounded w-15 h-6 text-white bg-red-800 px-2 rounded hover:bg-red-900 active:bg-red-700 duration-200" wire:click="resetReport()">X</button>
                  @endif
                </div>
              </div>
              <datalist id="reports">
                @foreach($reports as $report)
                @if($this->customerId)
                @if($report->customer_id==$this->customerId)
                <option value="{{$report->id}}">{{$report->created_at}}</option>
                @endif
                @elseif($this->customerId && $this->vehicleId)
                @if($report->customer_id==$this->customerId && $report->vehicle_id==$this->vehicleId)
                <option option value="{{$report->id}}">{{$report->created_at}}</option>
                @endif
                @else
                <option value="{{$report->id}}">{{$report->created_at}}</option>
                @endif
                @endforeach
              </datalist>
            </div>
            <div class="flex flex-col gap-2">
              <p>Fecha</p>
              <div class="bg-zinc-100 dark:bg-zinc-500 w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10 max-sm:w-[14rem]">
                {{$this->report_Created_At}}
              </div>
            </div>
            </div>
            
          </div>
          <div class="w-full mt-5 flex justify-end">
          @if($this->reportSearch)
          <x-jet-button wire:click="facturate()" class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                      Facturar
                    </x-jet-button>
          @endif
          </div>
        </div>
      </div>
    </section>
    @endif

    @if($this->goFacturate==true)
    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-col">
        <div class="flex gap-2">
          <p class="text-xl"></p>
        </div>
        <div class="flex justify-center items-center gap-5 sm:flex-wrap">
        <div class="flex gap-5 w-[22rem] h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] bg-white dark:bg-zinc-700 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
              <div class="w-10">
              <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Person</title><path d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6zM432 480H80a31 31 0 01-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75 1.94 10.73-.68 21.34-7.18 29.11A31 31 0 01432 480z"/></svg>
              </div>
              <p class="font-bold text-2xl">Cliente</p>
              <p>
                Nombre: {{$this->customerName}}
              </p>
              <p>
                <?php
                echo $this->searchCustomer($this->customerId, 'type');
                echo ': ';
                echo $this->searchCustomer($this->customerId, 'cc');
                ?>
              </p>
            </div>
            
          </div>
          
        </div>


        <div class="flex gap-5 w-[22rem] h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] bg-white dark:bg-zinc-700 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
              <div class="w-10">
              <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Car</title><path d="M447.68 220.78a16 16 0 00-1-3.08l-37.78-88.16C400.19 109.17 379 96 354.89 96H157.11c-24.09 0-45.3 13.17-54 33.54L65.29 217.7A15.72 15.72 0 0064 224v176a16 16 0 0016 16h32a16 16 0 0016-16v-16h256v16a16 16 0 0016 16h32a16 16 0 0016-16V224a16.15 16.15 0 00-.32-3.22zM144 320a32 32 0 1132-32 32 32 0 01-32 32zm224 0a32 32 0 1132-32 32 32 0 01-32 32zM104.26 208l28.23-65.85C136.11 133.69 146 128 157.11 128h197.78c11.1 0 21 5.69 24.62 14.15L407.74 208z"/></svg>
              </div>
              <p class="font-bold text-2xl">Vehiculo</p>
              <p>
                Placa: 
                <?php
                echo $this->searchVehicle($this->vehicleId, 'plate');
                ?>
              </p>
              <p>
                Modelo: 
                <?php
                echo $this->searchVehicle($this->vehicleId, 'model');
                ?>
              </p>
            </div>
            
          </div>
          
        </div>


        <div class="flex gap-5 w-[22rem] h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] bg-white dark:bg-zinc-700 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
              <div class="w-10">
              <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Document</title><path d="M428 224H288a48 48 0 01-48-48V36a4 4 0 00-4-4h-92a64 64 0 00-64 64v320a64 64 0 0064 64h224a64 64 0 0064-64V228a4 4 0 00-4-4z"/><path d="M419.22 188.59L275.41 44.78a2 2 0 00-3.41 1.41V176a16 16 0 0016 16h129.81a2 2 0 001.41-3.41z"/></svg>
              </div>
              <p class="font-bold text-2xl">Reporte</p>
              <p>
                <?php
                echo $this->searchReport('created_at');
                ?>
              </p>
            </div>
            
          </div>
          
        </div>
      </div>
    </section>

    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] min-h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-wrap xl:flex-nowrap">
        
      
        <div class="w-full flex justify-center items-center gap-5 flex-col">
          <p class="">Reporte de ingreso</p>
          <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
            <div class="w-full h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
              <div class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
                <?php
                  echo $this->searchReport('prev');
                ?>
              </div>
              
            </div>
            
          </div>
            
        </div>


          <div class="w-full flex justify-center items-center gap-5 flex-col">
            <p class="">Reporte de salida</p>
            <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
              <div class="w-full h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
                <div
                  class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
                  
                  <?php
                    echo $this->searchReport('post');
                    ?>
                </div>
                
              </div>
              
            </div>  
          </div>
      </div>
    </section>


    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] min-h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-col">
        <div class="flex gap-2">
          <p class="text-xl"></p>
        </div>
        <div class="flex justify-center items-center gap-5 flex-wrap xl:flex-nowrap">
        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col justify-center items-center rounded-xl gap-5">
              <div class="spc w-[10rem] h-[10rem] flex justify-center items-center rounded-[250px] p-5">
                <div class="billoil w-full h-full rounded-[250px] bg-white dark:bg-zinc-700 flex justify-center items-center">
                  <div class="w-5 drop">
                <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 30 30" version="1.1" id="svg822" inkscape:version="0.92.4 (f8dce91, 2019-08-02)" sodipodi:docname="drop.svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs816"> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1025" effect="bspline"></inkscape:path-effect> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1021" effect="bspline"></inkscape:path-effect> </defs> <sodipodi:namedview id="base" pagecolor="currentColor" bordercolor="currentColor" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="17.833333" inkscape:cx="15" inkscape:cy="15" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:window-width="1366" inkscape:window-height="713" inkscape:window-x="0" inkscape:window-y="0" inkscape:window-maximized="1" showguides="false" inkscape:guide-bbox="true"> <sodipodi:guide position="21.126168,22.794393" orientation="1,0" id="guide1575" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,23.285047" orientation="1,0" id="guide1635" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,7.6455921" orientation="0,1" id="guide1639" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="18.859863,18.859863" orientation="1,0" id="guide1242" inkscape:locked="false"></sodipodi:guide> <inkscape:grid type="xygrid" id="grid1103"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata819"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title> </dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-289.0625)"> <g id="layer1-3" inkscape:label="Layer 1" style="stroke-width:1.41176474" transform="matrix(0.70833333,0,0,0.70833333,4.3750001,88.684897)"></g> <path style="opacity:1;fill:currentColor;fill-opacity:1;stroke:none;stroke-width:2;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 23,309.0625 c 0,3.86599 -3.581722,7 -8.000001,7 -4.418277,0 -7.9999989,-3.13401 -7.9999989,-7 0,-3.86599 7.9999989,-17 7.9999989,-17 0,0 8.000001,13.13401 8.000001,17 z" id="path919" inkscape:connector-curvature="0" sodipodi:nodetypes="ssscs"></path> </g> </g></svg>
                  </div>
                  <div class="w-20 oil absolute">
                  <svg fill="currentColor" viewBox="0 -64 640 640" xmlns="http://www.w3.org/2000/svg" transform="matrix(-1, 0, 0, 1, 0, 0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier">  <path d="M629.8 160.31L416 224l-50.49-25.24a64.07 64.07 0 0 0-28.62-6.76H280v-48h56c8.84 0 16-7.16 16-16v-16c0-8.84-7.16-16-16-16H176c-8.84 0-16 7.16-16 16v16c0 8.84 7.16 16 16 16h56v48h-56L37.72 166.86a31.9 31.9 0 0 0-5.79-.53C14.67 166.33 0 180.36 0 198.34v94.95c0 15.46 11.06 28.72 26.28 31.48L96 337.46V384c0 17.67 14.33 32 32 32h274.63c8.55 0 16.75-3.42 22.76-9.51l212.26-214.75c1.5-1.5 2.34-3.54 2.34-5.66V168c.01-5.31-5.08-9.15-10.19-7"></path></g></svg>
                  </div>
                </div>
              </div>
              <p class="font-bold text-2xl">Aceite tipo</p>
              <p>
                <?php
                echo $this->searchReport('oilType');
                ?>
              </p>
            </div>
            
          </div>
          
        </div>


        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col justify-center items-center rounded-xl gap-10">
              <div class="spc w-[10rem] h-[10rem] flex justify-center items-center rounded-[250px] p-5">
                <div class="gear w-full h-full rounded-[250px] bg-white dark:bg-zinc-700 flex justify-center items-center">
                  <div class="w-20">
                  <svg fill="currentColor" height="70px" width="80px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M448,387.925V256V124.053c24.768-8.832,42.667-32.277,42.667-60.053c0-35.307-28.715-64-64-64c-35.285,0-64,28.693-64,64 c0,27.776,17.899,51.221,42.667,60.053v110.613h-128V124.053C302.101,115.221,320,91.776,320,64c0-35.307-28.715-64-64-64 s-64,28.693-64,64c0,27.776,17.899,51.221,42.667,60.053v110.613h-128V124.053c24.768-8.832,42.667-32.277,42.667-60.053 c0-35.307-28.715-64-64-64s-64,28.693-64,64c0,27.776,17.899,51.221,42.667,60.053V256c0,11.776,9.536,21.333,21.333,21.333 h149.333v110.592C209.899,396.757,192,420.224,192,448c0,35.285,28.715,64,64,64s64-28.715,64-64 c0-27.776-17.899-51.243-42.667-60.075V277.333h128v110.592c-24.768,8.832-42.667,32.299-42.667,60.075c0,35.285,28.715,64,64,64 c35.285,0,64-28.715,64-64C490.667,420.224,472.768,396.757,448,387.925z"></path> </g> </g> </g></svg>
                  </div>
                  <div class="w-5 absolute gearbox">
                  <svg height="100" width="100" class="">
  <circle cx="50" cy="50" r="12" stroke="currentColor" stroke-width="3" fill="#3f3f46" />
</svg>
                  </div>
                  <div class="w-5 absolute gearbox">
                  <svg height="100" width="100" class="dark:invisible">
  <circle cx="50" cy="50" r="12" stroke="currentColor" stroke-width="3" fill="#FFF" />
</svg>
                  </div>
                </div>
              </div>
              <div class="grid grid-cols-2">
                <p class="font-bold text-2xl">Caja:</p>
                <p class="justify-self-center text-xl">
                  
                <?php
                echo $this->searchReport('boxType');
                ?>
                </p>
                <p class="font-bold text-2xl">Diferencial:</p>
                <p class="justify-self-center text-xl">
                  
                <?php
                echo $this->searchReport('difType');
                ?>
                </p>
              </div>
            </div>
            
          </div>
          
        </div>


        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[22rem] h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col justify-center items-center rounded-xl gap-5">
              <div class="spc w-[10rem] h-[10rem] flex justify-center items-center rounded-[250px] p-5">
                <div class="filbox w-full h-full rounded-[250px] bg-white dark:bg-zinc-700 flex justify-center items-center">
                  <div class="w-20 filter">
                  <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M4.22657 2C2.50087 2 1.58526 4.03892 2.73175 5.32873L8.99972 12.3802V19C8.99972 19.3788 9.21373 19.725 9.55251 19.8944L13.5525 21.8944C13.8625 22.0494 14.2306 22.0329 14.5255 21.8507C14.8203 21.6684 14.9997 21.3466 14.9997 21V12.3802L21.2677 5.32873C22.4142 4.03893 21.4986 2 19.7729 2H4.22657Z" fill="currentColor"></path> </g></svg>
                  </div>
                  <div class="w-5 fildrop absolute">
                <svg xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:cc="http://creativecommons.org/ns#" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" viewBox="0 0 30 30" version="1.1" id="svg822" inkscape:version="0.92.4 (f8dce91, 2019-08-02)" sodipodi:docname="drop.svg" fill="currentColor"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <defs id="defs816"> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1025" effect="bspline"></inkscape:path-effect> <inkscape:path-effect only_selected="false" apply_with_weight="true" apply_no_weight="true" helper_size="0" steps="2" weight="33.333333" is_visible="true" id="path-effect1021" effect="bspline"></inkscape:path-effect> </defs> <sodipodi:namedview id="base" pagecolor="currentColor" bordercolor="currentColor" borderopacity="1.0" inkscape:pageopacity="0.0" inkscape:pageshadow="2" inkscape:zoom="17.833333" inkscape:cx="15" inkscape:cy="15" inkscape:document-units="px" inkscape:current-layer="layer1" showgrid="true" units="px" inkscape:window-width="1366" inkscape:window-height="713" inkscape:window-x="0" inkscape:window-y="0" inkscape:window-maximized="1" showguides="false" inkscape:guide-bbox="true"> <sodipodi:guide position="21.126168,22.794393" orientation="1,0" id="guide1575" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,23.285047" orientation="1,0" id="guide1635" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="22.682243,7.6455921" orientation="0,1" id="guide1639" inkscape:locked="false"></sodipodi:guide> <sodipodi:guide position="18.859863,18.859863" orientation="1,0" id="guide1242" inkscape:locked="false"></sodipodi:guide> <inkscape:grid type="xygrid" id="grid1103"></inkscape:grid> </sodipodi:namedview> <metadata id="metadata819"> <rdf:rdf> <cc:work rdf:about=""> <dc:format>image/svg+xml</dc:format> <dc:type rdf:resource="http://purl.org/dc/dcmitype/StillImage"></dc:type> <dc:title> </dc:title> </cc:work> </rdf:rdf> </metadata> <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(0,-289.0625)"> <g id="layer1-3" inkscape:label="Layer 1" style="stroke-width:1.41176474" transform="matrix(0.70833333,0,0,0.70833333,4.3750001,88.684897)"></g> <path style="opacity:1;fill:currentColor;fill-opacity:1;stroke:none;stroke-width:2;stroke-miterlimit:4;stroke-dasharray:none;stroke-opacity:1" d="m 23,309.0625 c 0,3.86599 -3.581722,7 -8.000001,7 -4.418277,0 -7.9999989,-3.13401 -7.9999989,-7 0,-3.86599 7.9999989,-17 7.9999989,-17 0,0 8.000001,13.13401 8.000001,17 z" id="path919" inkscape:connector-curvature="0" sodipodi:nodetypes="ssscs"></path> </g> </g></svg>
                  </div>
                </div>
              </div>
              <p class="font-bold text-2xl">Filtro</p>
              <p>
                
              <?php
                echo $this->searchReport('oilFilterType');
                ?>
              </p>
            </div>
            
          </div>
          
        </div>
        </div>
      </div>
    </section>

    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] min-h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-col">
        <div class="flex gap-2">
          <p class="text-xl">Productos</p>
        </div>
        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-[25rem] h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col justify-center items-center rounded-xl gap-5">
              <div class="spc w-[10rem] h-[10rem] flex justify-center items-center rounded-[250px] p-5">
                <div class="w-full h-full rounded-[250px] bg-white dark:bg-zinc-700 flex justify-center items-center">
                  <p class="absolute text-[60px] font-bold">{{$this->report_ProductsCant}}</p>
                </div>
              </div>
              <p class="font-bold text-2xl">Productos</p>
            </div>
            <div class="w-full h-[8rem] bg-white dark:bg-zinc-700 rounded-xl flex flex-col">
              <div class="w-full h-full flex justify-center items-center text-xl font-bold">Subtotal</div>
              <div class="w-full h-full flex justify-center items-center text-xl font-bold">
                ${{$this->report_ProductsTotal}}</div>
            </div>
          </div>
          <div class="w-full min-h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl overflow-x-auto">
            <table class="w-full h-full">
              <thead>
                <tr>
                  <th class="p-5">
                    ID
                  </th>
                  <th class="p-5">
                    Nombre
                  </th>
                  <th class="p-5">
                    Valor unitario
                  </th>
                  <th class="p-5">
                    Cantidad
                  </th>
                  <th class="p-5">
                    Subtotal
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($this->report_ProductsAmmountArrFinal as $product)
                <tr>
                  <th class="p-5">
                    {{$product[0]}}
                  </th>
                  <th class="p-5">
                    <?php
                  echo $this->searchProduct($product[0], 'name');
                  ?>
                  </th>
                  <th class="p-5">
                    <?php
                  echo $this->searchProduct($product[0], 'price');
                  ?>
                  </th>
                  <th class="p-5">
                    {{$product[1]}}
                  </th>
                  <th class="p-5">
                    {{$product[2]}}
                  </th>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th>

                  </th>
                  <th>

                  </th>
                  <th>

                  </th>
                  <th class="p-5">
                    Total
                  </th>
                  <th class="p-5">
                    {{$this->report_ProductsTotal}}
                  </th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </section>

    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] min-h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-col">
        <div class="flex gap-2">
          <p class="text-xl">Procedimientos</p>
        </div>
        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-full min-h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl overfloe-x-auto">
            <table class="w-full h-full">
              <thead>
                <tr>
                  <th class="p-5">
                    Trabajo
                  </th>
                  <th class="p-5">
                    Precio
                  </th>
                </tr>
              </thead>
              <tbody>
                @foreach($this->report_ProceduresArrFinal as $procedure)
                <tr>
                  <th class="p-5">
                    {{$procedure[0]}}
                  </th>
                  <th class="p-5">
                    {{$procedure[1]}}
                  </th>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
                <tr>
                  <th class="p-5">
                    Total
                  </th>
                  <th class="p-5">
                    {{$this->report_ProceduresTotal}}
                  </th>
                </tr>
              </tfoot>
            </table>
          </div>
          <div class="w-[25rem] h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col justify-center items-center rounded-xl gap-5">
              <div class="spc w-[10rem] h-[10rem] flex justify-center items-center rounded-[250px] p-5">
                <div class="w-full h-full rounded-[250px] bg-white dark:bg-zinc-700 flex justify-center items-center">
                  <p class="absolute text-[60px] font-bold">{{$this->report_ProceduresCant}}</p>
                </div>
              </div>
              <p class="font-bold text-2xl ">Procedimientos</p>
            </div>
            <div class="w-full h-[8rem] bg-white dark:bg-zinc-700 rounded-xl flex flex-col">
              <div class="w-full h-full flex justify-center items-center text-xl font-bold">Subtotal</div>
              <div class="w-full h-full flex justify-center items-center text-xl font-bold">
                ${{$this->report_ProceduresTotal}}</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="w-full flex justify-center items-center">
      <div class="w-[90%] min-h-[50vh] bg-white dark:bg-zinc-700 p-5 rounded-xl flex shadow-xl gap-5 flex-col">
        <div class="flex gap-2">
          <p class="text-xl">Observaciones</p>
        </div>
        <div class="flex justify-center items-center gap-5 flex-wrap xl:flex-nowrap">
        <div class="flex gap-5 w-full h-full flex-wrap xl:flex-nowrap justify-center items-center">
          <div class="w-full h-[25rem] bg-zinc-200 dark:bg-zinc-600 rounded-xl p-5 flex flex-col gap-5">
            <div
              class=" w-full h-full bg-white dark:bg-zinc-700 flex flex-col p-5 rounded-xl gap-5">
              
              <?php
                echo $this->searchReport('observations');
                ?>
            </div>
            
          </div>
          
        </div>
      </div>
    </section>
    
    @endif
  </div>
  <x-jet-dialog-modal wire:model="showingBillModal">
    <x-slot name="title">Editar usuario</x-slot>
    <x-slot name="content">
      <div class="space-y-8 divide-y divide-gray-200 mt-10">
        ¿Seguro de que desea guardar este informe?<p class="text-red-500 mb-10">>>No se podra editar despues<<< /p>

            @error('customer') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror
            @error('vehicle') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror
            @error('strProcedures') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror
            @error('prev') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror
            @error('post') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror
            @error('strProductsAmmount') <span class="error text-red-500">
              <div class="flex items-center">
                <div class="w-8 h-8"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
                    <title>Alert Circle</title>
                    <path d="M448 256c0-106-86-192-192-192S64 150 64 256s86 192 192 192 192-86 192-192z" fill="none"
                      stroke="currentColor" stroke-miterlimit="10" stroke-width="32" />
                    <path d="M250.26 166.05L256 288l5.73-121.95a5.74 5.74 0 00-5.79-6h0a5.74 5.74 0 00-5.68 6z"
                      fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="32" />
                    <path d="M256 367.91a20 20 0 1120-20 20 20 0 01-20 20z" fill="none" stroke="currentColor"
                      stroke-linecap="round" stroke-linejoin="round" stroke-width="32" />
                  </svg></div>
                {{ $message }}
              </div>
            </span> @enderror

      </div>

    </x-slot>
    <x-slot name="footer">
      <div class="w-full flex gap-5 place-content-between">
        <x-jet-button wire:click="modal(false)" type="button"
          class="bg-zinc-800 dark:bg-zinc-900 dark:bg-zinc-900 hover:bg-zinc-900 active:bg-zinc-700">Cerrar</x-jet-button>

        <x-jet-button wire:click="saveReport"
          class="bg-red-800 hover:bg-red-900 active:bg-red-700">Guardar</x-jet-button>
      </div>
    </x-slot>
  </x-jet-dialog-modal>
</div>