<div class="flex justify-center mt-20" style="font-size:{{ $this->fontSize }}px">
    <div class="max-w-[85vw]">
  <h1 style="font-size: 30px;">Usuarios</h1>

      <div class=" sm:flex">

        <div class="m-2 p-2">
          <div
            class="w-full bg-zinc-800 sm:flex items-center place-content-between p-5 sm:rounded-tl-lg sm:rounded-tr-lg relative">
            <div class="sm:flex gap-5 items-center">
              <p class="text-white">Buscar documento</p>
              <input wire:model="search" type="search" placeholder="Ej: 1058351478" class="rounded max-sm:w-full">
              <p class="text-white">Filtrar</p>
              <select wire:change="filter($event.target.value)" class="rounded max-sm:w-full">
                <option value="2">Todos</option>
                <option value="0">Activos</option>
                <option value="1">Inactivos</option>
              </select>
              <p class="text-white">Elementos por pagina</p>
              <select wire:change="changePaginate($event.target.value)" class="rounded max-sm:w-full">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
              </select>
              <button wire:click="showFieldsModal"
                class="rounded max-sm:w-full h-10 bg-red-800 hover:bg-red-900 active:bg-red-700 text-white flex gap-2 items-center justify-center px-3 max-sm:mt-5">Campos<svg
                  class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd"
                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                    clip-rule="evenodd" />
                </svg></button>
            </div>
            @if(Auth::user()->job!='M')
            <x-jet-button wire:click="showUserModal"
              class="bg-red-800 hover:bg-red-900 active:bg-red-700 max-sm:mt-5 max-sm:w-full flex justify-center imtems-center sm:ml-5">Registrar</x-jet-button>
            @endif
            <div class="bg-zinc-800 absolute -right-20 top-0 rounded-xl p-2 flex flex-col gap-2 justify-center items-center text-white invisible opacity-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon w-6" viewBox="0 0 512 512"><title>Text</title><path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M32 415.5l120-320 120 320M230 303.5H74M326 239.5c12.19-28.69 41-48 74-48h0c46 0 80 32 80 80v144"/><path d="M320 358.5c0 36 26.86 58 60 58 54 0 100-27 100-106v-15c-20 0-58 1-92 5-32.77 3.86-68 19-68 58z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
            <button class="w-10 h-10 bg-red-700 rounded text-white text-3xl" wire:click="fontSizeBigger()">+</button>
            <button class="w-10 h-10 bg-red-700 rounded text-white text-3xl" wire:click="fontSizeSmaller()">-</button>
            </div>
          </div>
          <div class="-my-2 overflow-x-auto">
            <div class="py-2 align-middle inline-block min-w-full
          ">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-bl-lg sm:rounded-br-lg">

                <table class="w-full divide-y divide-gray-200 ">
                  <thead class="bg-gray-50 dark:bg-gray-600 dark:text-gray-200">

                    <tr>
                      <th class ="bg-zinc-800">
                        <div>
                          <input type="checkbox" wire:change="selectAll()" class="checked:bg-red-800 focus:ring-red-800 text-red-800">
                        </div>
                      </th>
                      @if($fieldId)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('id')">
                        <div class="flex">Id<svg class="h-4 w-4 @if($sortField!='id')
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
                      @if($fieldType)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('type')">
                        <div class="flex">Tipo de documento<svg class="h-4 w-4 @if($sortField!='type')
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
                      @if($fieldCc)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('cc')">
                        <div class="flex">Numero de documento<svg class="h-4 w-4 @if($sortField!='cc')
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
                      @if($fieldName)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('name')">
                        <div class="flex">Nombre<svg class="h-4 w-4 @if($sortField!='name')
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
                      @if($fieldJob)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('job')">
                        <div class="flex">Cargo<svg class="h-4 w-4 @if($sortField!='job')
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
                      @if($fieldEmail)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('email')">
                        <div class="flex">Correo<svg class="h-4 w-4 @if($sortField!='email')
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
                      @if($fieldPhone)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('phone')">
                        <div class="flex">Telefono<svg class="h-4 w-4 @if($sortField!='phone')
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
                      @if($fieldQuestion)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800">
                        <div class="flex">Pregunta clave<svg class="h-4 w-4 @if($sortField!='question')
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
                      @if($fieldAnswer)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800">
                        <div class="flex">Respuesta<svg class="h-4 w-4 @if($sortField!='answer')
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
                      @if($fieldStatus)
                      <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-200 uppercase tracking-wider bg-zinc-800 cursor-pointer hover:bg-red-800 hover:underline"
                        wire:click="sortBy('status')">
                        <div class="flex">Estado<svg class="h-4 w-4 @if($sortField!='status')
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
                      @if(Auth::user()->job=='A')
                      <th scope="col" class="relative px-6 py-3 bg-zinc-800">Edit</th>
                      @endif
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                      <td class="px-6 py-4 whitespace-nowrap">
                        <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" {{ $this->isCheckedAll }} id="checkbox{{$user->id}}">
                      </td>
                      @if($this->filter!=$user->status)
                      @if($fieldId)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->id }}</td>
                      @endif
                      @if($fieldType)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->type }}</td>
                      @endif
                      @if($fieldCc)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->cc }}</td>
                      @endif
                      @if($fieldName)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                      @endif
                      @if($fieldJob)
                      <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->job=='A')
                        Administrador
                        @elseif($user->job=='T')
                        Trabajador
                        @elseif($user->job=='M')
                        Mecanico
                        @endif
                      </td>
                      @endif
                      @if($fieldEmail)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                      @endif
                      @if($fieldPhone)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->phone }}</td>
                      @endif
                      @if($fieldQuestion)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->question }}</td>
                      @endif
                      @if($fieldAnswer)
                      <td class="px-6 py-4 whitespace-nowrap">{{ $user->answer }}</td>
                      @endif
                      @if($fieldStatus)
                      <td class="px-6 py-4 whitespace-nowrap">
                        @if($user->status=='1')
                        Activo
                        @else
                        Inactivo
                        @endif
                      </td>
                      @endif
                      @if(Auth::user()->job=='A')
                      <td class="px-6 py-4 text-right text-sm flex gap-2">
                        <x-jet-button wire:click="showEditUserModal({{ $user-> id }})"
                          class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">Editar</x-jet-button>
                        <x-jet-button wire:click="delete({{ $user-> id }})"
                          class="bg-red-800 hover:bg-red-900 active:bg-red-700">X</x-jet-button>
                      </td>
                      @endif
                    </tr>
                    @endif
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
            @elseif($isFieldsMode)
            <x-slot name="title">Editar Campos</x-slot>
            @else
            <x-slot name="title">Registrar usuario</x-slot>
            @endif
            <x-slot name="content">
              <div class="space-y-8 divide-y divide-gray-200 mt-10">
                @if($isFieldsMode)
                <div class="grid grid-cols-2 place-content-center">
                  <p class="">Id</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldId) checked @endif wire:change="changeField('fieldId')">
                  <p class="">Tipo de documento</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldType) checked @endif wire:change="changeField('fieldType')">
                  <p class="">Numero de documento</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldCc) checked @endif wire:change="changeField('fieldCc')">
                  <p class="">Nombre</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldName) checked @endif wire:change="changeField('fieldName')">
                  <p class="">Cargo</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldJob) checked @endif wire:change="changeField('fieldJob')">
                  <p class="">Email</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldEmail) checked @endif
                    wire:change="changeField('fieldEmail')">
                  <p class="">Telefono</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldPhone) checked @endif
                    wire:change="changeField('fieldPhone')">
                  <p class="">Pregunta clave</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldQuestion) checked @endif
                    wire:change="changeField('fieldQuestion')">
                  <p class="">Respuesta</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldAnswer) checked @endif
                    wire:change="changeField('fieldAnswer')">
                  <p class="">Estado</p>
                  <input type="checkbox" class="checked:bg-red-800 focus:ring-red-800 text-red-800" @if($fieldStatus) checked @endif
                    wire:change="changeField('fieldStatus')">
                </div>
                @else
                <div class="flex flex-col">
                  <form enctype="multipart/form-data">
                    <p>Información</p>
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
                        @if($isEditMode==false)
                        <div class="sm:col-span-6">
                        <label for="password" class="block text-sm font-medium text-gray-700"> Contraseña </label>
                        <div class="mt-1">
                          <input type="password" id="password" wire:model.lazy="password" name="password"
                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                        @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
                      </div>
                      <div class="sm:col-span-6">
                        <label for="cpassword" class="block text-sm font-medium text-gray-700"> Confirmar Contraseña</label>
                        <div class="mt-1">
                          <input type="password" id="cpassword" wire:model.lazy="cpassword" name="cpassword"
                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                      </div>
                      @error('cpassword') <span class="error text-red-500">{{ $message }}</span> @enderror
                      @endif
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

                </div>
                @if($isEditMode)
                <form>
                  <p>Seguridad</p>
                    <div class="sm:flex place-content-around m-2">
                      <div class="sm:col-span-6">
                        <label for="password" class="block text-sm font-medium text-gray-700"> Contraseña </label>
                        <div class="mt-1">
                          <input type="password" id="password" wire:model.lazy="password" name="password"
                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                        @error('password') <span class="error text-red-500">{{ $message }}</span> @enderror
                      </div>
                      <div class="sm:col-span-6">
                        <label for="cpassword" class="block text-sm font-medium text-gray-700"> Confirmar Contraseña</label>
                        <div class="mt-1">
                          <input type="password" id="cpassword" wire:model.lazy="cpassword" name="cpassword"
                            class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal sm:text-sm sm:leading-5" />
                        </div>
                        @error('cpassword') <span class="error text-red-500">{{ $message }}</span> @enderror
                      </div>
                    </div>
                </form>
              @endif
              </div>
              @endif
        </div>

        </x-slot>
        <x-slot name="footer">
          <div class="w-full flex gap-5 place-content-between">
            @if($isEditMode)
            <x-jet-button wire:click="modalEditFormReset"
              class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">Reset</x-jet-button>
            @elseif($isFieldsMode)
            <x-jet-button wire:click="modalFieldsReset"
              class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">Reset</x-jet-button>
            @else
            <x-jet-button wire:click="modalRegFormReset"
              class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">Reset</x-jet-button>
            @endif
            <div>
              @if($isEditMode)
              <x-jet-button wire:click="updateUser"
                class="bg-red-800 hover:bg-red-900 active:bg-red-700">Actualizar</x-jet-button>
              @elseif($isFieldsMode)
              @else
              <x-jet-button wire:click="saveUser"
                class="bg-red-800 hover:bg-red-900 active:bg-red-700">Guardar</x-jet-button>
              @endif
              <x-jet-button wire:click="hideModal" type="button"
                class="bg-zinc-800 hover:bg-zinc-900 active:bg-zinc-700">Cerrar</x-jet-button>
            </div>
          </div>
        </x-slot>
        </x-jet-dialog-modal>

      </div>
    </div>
  </div>
  </div>