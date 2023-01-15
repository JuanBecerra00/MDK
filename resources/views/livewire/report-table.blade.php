<div class="max-w-[85vw] overflow-auto">

        <h1 style="font-size: 30px;">Facturacion</h1>

        <div class="">

            <div class="m-2 p-2 relative ">


                <div
                    class="w-full bg-zinc-800 sm:flex items-center place-content-between p-5 relative rounded-t-xl">
                    <div class="flex max-sm:flex-col gap-5 items-center">

                    </div>
                    <div class="-my-2 overflow-x-auto">
                        <div class="py-2 align-middle inline-block min-w-full">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl-lg sm:rounded-br-lg">

                                <table class="w-full divide-y divide-gray-200 ">
                                    <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">

                                    <tr>
                                        @if($fieldBills_id)
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                                                wire:click="sortBy('bills_id')">
                                                <div class="flex">Id de la factura<svg class="h-4 w-4 @if($sortField!='bills_id')
                        opacity-0
                        @endif
                        @if($sortDirection=='desc')
                        rotate-180
                        @endif
                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                              clip-rule="evenodd" />
                                                    </svg></div>
                                            </th>
                                        @endif
                                        @if($fieldCustomers_id)
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                                                wire:click="sortBy('customers_id')">
                                                <div class="flex">Id del cliente<svg class="h-4 w-4 @if($sortField!='customers_id')
                        opacity-0
                        @endif
                        @if($sortDirection=='desc')
                        rotate-180
                        @endif
                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                              clip-rule="evenodd" />
                                                    </svg></div>
                                            </th>
                                        @endif
                                        @if($fieldVehicle_id)
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                                                wire:click="sortBy('vehicle_id')">
                                                <div class="flex">Id del vehiculo<svg class="h-4 w-4 @if($sortField!='vehicle_id')
                        opacity-0
                        @endif
                        @if($sortDirection=='desc')
                        rotate-180
                        @endif
                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                              clip-rule="evenodd" />
                                                    </svg></div>
                                            </th>
                                        @endif
                                        @if($fieldDate)
                                            <th scope="col"
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                                                wire:click="sortBy('updated_at')">
                                                <div class="flex">Fecha<svg class="h-4 w-4 @if($sortField!='updated_at')
                        opacity-0
                        @endif
                        @if($sortDirection=='desc')
                        rotate-180
                        @endif
                        " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                              clip-rule="evenodd" />
                                                    </svg></div>
                                            </th>
                                        @endif
                                        <td class="px-6 py-4 text-right text-sm flex justify-center gap-2">
                                            <x-jet-button class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">
                                                <a href="">ver factura</a>
                                            </x-jet-button>
                                        </td>
                                        
                                    </tr>
                                    @endforeach
                                    <!-- More items... -->
                                    </tbody>
                                </table>
                                <div class="m-2 p-2">
                                    {{ $products->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>