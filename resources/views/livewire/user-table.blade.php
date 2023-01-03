<div class="max-w-[75vw] mx-auto">
    <div class="flex place-content-between m-2 p-2">

    </div>
    <div>
    </div>
    <div class="m-2 p-2">
      <div class="w-full sm:h-20 bg-zinc-800 sm:flex items-center place-content-between p-5 sm:rounded-tl-lg sm:rounded-tr-lg">

                  <div class="sm:flex gap-5 items-center">
                    <p class="text-white">Buscar</p>
                    <input wire:model="search" type="search" placeholder="Buscar documento de identidad"
                      class="rounded max-sm:w-full">
                    <p class="text-white">paginate</p>
                    <select wire:change="changePaginate($event.target.value)" class="rounded max-sm:w-full">
                      <option value="5">5</option>
                      <option value="10">10</option>
                      <option value="15">15</option>
                    </select>
                    <button wire:click="showFieldsModal" class="rounded max-sm:w-full w-20 h-10 bg-white flex gap-2 items-center justify-center">fields<img src="/assets/textures/icons/chevron-down-outline.svg" alt="" class="w-5"></button>
                  </div>

                  <x-jet-button wire:click="showUserModal" class="bg-red-800 hover:bg-red-900 active:bg-red-700 max-sm:mt-5">Registrar</x-jet-button>
                </div>
      <div class="-my-2 overflow-x-auto">
        <div class="py-2 align-middle inline-block min-w-full
        ">
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl-lg sm:rounded-br-lg">
            
            <table class="w-full divide-y divide-gray-200">
              <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
                
                <tr>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('id')">Id</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('type')">Tipo de documento</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('cc')">Numero de documento</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('name')">Nombre</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('job')">Cargo</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('email')">Correo</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('phone')">Telefono</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800">
                    Pregunta clave</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800">
                    Respuesta</th>
                  <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                    wire:click="sortBy('status')">Estado</th>
                  <th scope="col" class="relative px-6 py-3 bg-zinc-800">Edit</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <tr></tr>
                @foreach($users as $user)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->type }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->cc }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->job }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->question }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->answer }}</td>
                  <td class="px-6 py-4 whitespace-nowrap">{{ $user->status }}</td>
                  <td class="px-6 py-4 text-right text-sm flex gap-2">
                    <x-jet-button wire:click="showEditUserModal({{ $user-> id }})">Editar</x-jet-button>
                    <x-jet-button wire:click="delete({{ $user-> id }})">X</x-jet-button>
                  </td>
                </tr>
                @endforeach
                <!-- More items... -->
              </tbody>
            </table>
            <div class="m-2 p-2">
              {{ $users->links() }}</div>
          </div>
        </div>
      </div>

    </div>
    <div>
      <x-jet-dialog-modal wire:model="showingUserModal">
        @if($isEditMode)
        <x-slot name="title">Editar usuario</x-slot>
        @else
        <x-slot name="title">Registrar usuario</x-slot>
        @endif
        <x-slot name="content">
          <div class="space-y-8 divide-y divide-gray-200 mt-10">
            @if($isFieldsMode)
            <div class="grid grid-cols-2 place-content-center">
              <p class="">Id</p>
              <input type="checkbox" class="">
              <p class="">Type</p>
              <input type="checkbox" class="">
              <p class="">CC</p>
              <input type="checkbox" class="">
              <p class="">Name</p>
              <input type="checkbox" class="">
            </div>
            @else
            <form enctype="multipart/form-data">
              <div class="sm:flex place-content-around m-2">
                <div>
                  <div class="sm:col-span-6">
                    <label for="type" class="block text-sm font-medium text-gray-700"> Tipo de documento </label>
                    <div class="mt-1">
                      <select id="type" wire:model.lazy="type" name="type" placeholder="cc"
                        class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
                        <option value="CC">Cedula</option>
                        <option value="TI">Tarjeta de identidad</option>
                        <option value="CE">Cedula de extranjeria</option>
                        <option value="P">Pasaporte</option>
                      </select>
                    </div>
                  </div>
                  <div class="sm:col-span-6">
                    <label for="cc" class="block text-sm font-medium text-gray-700"> Numero de documento </label>
                    <div class="mt-1">
                      <input type="text" id="cc" wire:model.lazy="cc" name="cc"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('cc') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="name" class="block text-sm font-medium text-gray-700"> Nombre </label>
                    <div class="mt-1">
                      <input type="text" id="name" wire:model.lazy="name" name="name"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="job" class="block text-sm font-medium text-gray-700"> Cargo </label>
                    <div class="mt-1">
                      <select id="job" wire:model.lazy="job" name="job"
                        class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
                        <option value="T">Trabajador</option>
                        <option value="A">Administrador</option>
                        <option value="M">Mecanico</option>
                      </select>
                    </div>
                  </div>
                  <div class="sm:col-span-6">
                    <label for="phone" class="block text-sm font-medium text-gray-700"> Telefono </label>
                    <div class="mt-1">
                      <input type="text" id="phone" wire:model.lazy="phone" name="phone"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('phone') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="email" class="block text-sm font-medium text-gray-700"> Correo </label>
                    <div class="mt-1">
                      <input type="text" id="email" wire:model.lazy="email" name="email"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                </div>
                <div>


                  <div class="sm:col-span-6">
                    <label for="password" class="block text-sm font-medium text-gray-700"> Contraseña </label>
                    <div class="mt-1">
                      <input type="password" id="password" wire:model.lazy="password" name="password"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="cpassword" class="block text-sm font-medium text-gray-700"> Confirmar Contraseña
                    </label>
                    <div class="mt-1">
                      <input type="password" id="cpassword" wire:model.lazy="cpassword" name="cpassword"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('cpassword') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="question" class="block text-sm font-medium text-gray-700"> Pregunta clave </label>
                    <div class="mt-1">
                      <input type="text" id="question" wire:model.lazy="question" name="question"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('question') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="answer" class="block text-sm font-medium text-gray-700"> Respuesta </label>
                    <div class="mt-1">
                      <input type="text" id="answer" wire:model.lazy="answer" name="answer"
                        class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                    </div>
                    @error('answer') <span class="error text-red-500">{{ $message }}</span> @enderror
                  </div>
                  <div class="sm:col-span-6">
                    <label for="status" class="block text-sm font-medium text-gray-700"> Estado </label>
                    <div class="mt-1">
                      <select id="status" wire:model.lazy="status" name="status"
                        class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                      </select>
                    </div>
                  </div>
                </div>
            </form>
            @endif
          </div>

        </x-slot>
        <x-slot name="footer">
          @if($isEditMode)
          <x-jet-button wire:click="updateUser">Actualizar</x-jet-button>
          @else
          <x-jet-button wire:click="saveUser">Guardar</x-jet-button>
          @endif
        </x-slot>
      </x-jet-dialog-modal>

    </div>
  </div>
