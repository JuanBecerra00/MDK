<div class="max-w-6xl mx-auto">
    <div class="flex justify-end m-2 p-2">
    <input wire:model="search" type="search" placeholder="Search posts by title...">
        <x-jet-button wire:click="showUserModal">Registrar</x-jet-button>
        
    </div>
    <div>
</div>
    <div class="m-2 p-2">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
  <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
      <table class="w-full divide-y divide-gray-200">
        <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">
          <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Id</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Tipo de documento</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Numero de documento</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Nombre</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Cargo</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Correo</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Telefono</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Pregunta clave</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Respuesta</th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider">Estado</th>
            <th scope="col" class="relative px-6 py-3">Edit</th>
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
            <td class="px-6 py-4 text-right text-sm">
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
  <form enctype="multipart/form-data">
    <div class="sm:col-span-6">
      <label for="type" class="block text-sm font-medium text-gray-700"> Tipo de documento </label>
      <div class="mt-1">
        <select id="type" wire:model.lazy="type" name="type" placeholder="cc" class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
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
        <input type="text" id="cc" wire:model.lazy="cc" name="cc" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('cc') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="name" class="block text-sm font-medium text-gray-700"> Nombre </label>
      <div class="mt-1">
        <input type="text" id="name" wire:model.lazy="name" name="name" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('name') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="job" class="block text-sm font-medium text-gray-700"> Cargo </label>
      <div class="mt-1">
        <select id="job" wire:model.lazy="job" name="job" class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
            <option value="T">Trabajador</option>
          <option value="A">Administrador</option>
          <option value="M">Mecanico</option>
        </select>
      </div>
    </div>
    <div class="sm:col-span-6">
      <label for="phone" class="block text-sm font-medium text-gray-700"> Telefono </label>
      <div class="mt-1">
        <input type="text" id="phone" wire:model.lazy="phone" name="phone" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('phone') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="email" class="block text-sm font-medium text-gray-700"> Correo </label>
      <div class="mt-1">
        <input type="text" id="email" wire:model.lazy="email" name="email" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('email') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="password" class="block text-sm font-medium text-gray-700"> Contraseña </label>
      <div class="mt-1">
        <input type="password" id="password" wire:model.lazy="password" name="password" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="cpassword" class="block text-sm font-medium text-gray-700"> Confirmar Contraseña </label>
      <div class="mt-1">
        <input type="password" id="cpassword" wire:model.lazy="cpassword" name="cpassword" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('cpassword') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="question" class="block text-sm font-medium text-gray-700"> Pregunta clave </label>
      <div class="mt-1">
        <input type="text" id="question" wire:model.lazy="question" name="question" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('question') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="answer" class="block text-sm font-medium text-gray-700"> Respuesta </label>
      <div class="mt-1">
        <input type="text" id="answer" wire:model.lazy="answer" name="answer" class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
      </div>
      @error('answer') <span class="error text-red-500">{{ $message }}</span> @enderror
    </div>
    <div class="sm:col-span-6">
      <label for="status" class="block text-sm font-medium text-gray-700"> Estado </label>
      <div class="mt-1">
        <select id="status" wire:model.lazy="status" name="status" class="block w-full bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5">
          <option value="1">Activo</option>
          <option value="0">Inactivo</option>
        </select>
      </div>
  </form>
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
