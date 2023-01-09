<table class="w-full divide-y divide-gray-200 ">
                  <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">

                    <tr>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('id')">
                        <div class="flex">Id<svg class="h-4 w-4
                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('type')">
                        <div class="flex">Tipo de documento<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('cc')">
                        <div class="flex">Numero de documento<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('name')">
                        <div class="flex">Nombre<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('job')">
                        <div class="flex">Cargo<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('email')">
                        <div class="flex">Correo<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('phone')">
                        <div class="flex">Telefono<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800">
                        <div class="flex">Pregunta clave<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800">
                        <div class="flex">Respuesta<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('status')">
                        <div class="flex">Estado<svg class="h-4 w-4

                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                          </svg></div>
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="">
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->id }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->type }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->cc }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->name }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">
                      @if($user->job=='A')
                        Administrador
                        @elseif($user->job=='T')
                        Trabajador
                        @elseif($user->job=='M')
                        Mecanico
                        @endif
                      </div>
                      </td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->email }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->phone }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->question }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap"><div class="max-w-[12rem] overflow-x-auto">{{ $user->answer }}</div></td>
                      <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->status=='1')
                        Activo
                        @else
                        Inactivo
                        @endif
                      </td>
                      
                    </tr>
                    @endforeach
                    <!-- More items... -->
                  </tbody>
                </table>