<div class="w-full flex justify-center items-center p-5">
    <div class="w-[70%] pt-20 flex flex-col gap-5">
      <p class="text-3xl">Facturación</p>
      <section class="w-full flex justify-center">
        <div class="sm:w-[90%]">
          <p class="text-xl">Datos del cliente</p>
          <div class="flex gap-5 flex-wrap lg:flex-nowrap">
            <div class="w-full sm:h-[15rem] shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Cliente</p>
              <div>
                <p>Numero de documento</p>
                <div>
                  <div class="flex gap-2 items-center">
                    <input type="text" list="customers" value="{{$customer}}"
                      wire:change="setCustomer($event.target.value)">
                    @if($customer)
                    <button button class="rounded w-6 h-6 text-zinc-500" wire:click="resetCustomer()">Borrar</button>
                    @endif
                  </div>
                </div>
                <datalist id="customers">
                  @foreach($users as $user)
                  <option value="{{$user->id}}  {{$user->cc}}">{{$user->name}}</option>
                  @endforeach
                </datalist>
              </div>
              <div class="flex gap-5 max-sm:flex-wrap">
                <div class="flex flex-col gap-2">
                  <p>Nombre</p>
                  <div class="border-0 border-b border-black w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerName}}
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <p>Email</p>
                  <div class="border-0 border-b border-black w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerEmail}}
                  </div>
                </div>
                <div class="flex flex-col gap-2">
                  <p>Telefono</p>
                  <div class="border-0 border-b border-black w-[16rem] overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$customerPhone}}
                  </div>
                </div>
              </div>
            </div>
            <div class="w-full h-[15rem] shadow-xl rounded-xl p-5 bg-white flex flex-col gap-2">
              <p class="text-xl">Vehiculo</p>
              <div class="">
                <p>Placa</p>
                <div class="flex gap-2 items-center pr-5">
                  <input type="text" list="vehicles" value="{{$vehicle}}" wire:change="setVehicle($event.target.value)">

                  <button class="rounded w-6 h-6 text-zinc-500
                  @if($vehicle=='')
                  invisible
                  @endif
                  " wire:click="resetVehicle()">Borrar</button>
                </div>
                <datalist id="vehicles">
                  @foreach($vehicles as $vehicle)
                  <option value="{{$vehicle->id}}  {{$vehicle->plate}}">{{$vehicle->model}}</option>
                  @endforeach
                </datalist>
              </div>
              <div class=" gap-5">
                <div class="flex flex-col gap-2">
                  <p>Modelo</p>
                  <div class="border-0 border-b border-black w-full overflow-x-auto overflow-y-hidden px-3 py-2 h-10">
                    {{$this->vehicleModel}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      ///////////////
      <section class="bg-red-500 w-full flex justify-center">
        <div class="sm:w-[90%] bg-blue-500 pb-5">
          <p class="text-xl">Trabajos realizados</p>
          <div class="bg-zinc-800 w-full p-5 rounded-t-xl flex justify-end">
            <x-jet-button wire:click="addProcedure()"
              class="bg-red-800 hover:bg-red-900 active:bg-red-700 max-sm:mt-5 max-sm:w-full flex justify-center imtems-center sm:ml-5">Registrar</x-jet-button>
          </div>
          <?php
          var_dump($this->procedures);
          ?>
          {{$this->test}}
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
                  <th class="bg-white px-6 py-3">
                    @if($val[0] && $val[1])
                    {{$val[0]}}
                    @else
                    <input type="text" wire:model.lazy="procedureName">
                    @endif
                  </th>
                  <th class="bg-white px-6 py-3">
                  @if($val[0] && $val[1])
                    {{$val[1]}}
                    @else
                    <input type="number" wire:model.lazy="procedurePrice">
                    @endif
                  </th>
                  <th class="bg-slate-100">
                  @if($val[0] && $val[1])
                    <x-jet-button wire:click="procedureEdit({{ $key}})"
                      class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">
                        Editar
                    </x-jet-button>
                    <x-jet-button wire:click="procedureDelete({{ $key}})"
                      class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                        Quitar
                    </x-jet-button>
                    @else
                    <x-jet-button wire:click="procedureSave()"
                      class="bg-red-800 hover:bg-red-900 active:bg-red-700">
                        Guardar
                    </x-jet-button>
                    @endif
                  </th>
                </tr>
                @endforeach
              </tbody>
            </table>
        </div>
      </section>
      
  </div>
  </div>