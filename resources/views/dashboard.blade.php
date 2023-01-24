<style>
.bg{
    background-color: #000000;
background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='100%25' height='100%25' viewBox='0 0 1600 800'%3E%3Cg %3E%3Cpolygon fill='%23220000' points='1600 160 0 460 0 350 1600 50'/%3E%3Cpolygon fill='%23440000' points='1600 260 0 560 0 450 1600 150'/%3E%3Cpolygon fill='%23660000' points='1600 360 0 660 0 550 1600 250'/%3E%3Cpolygon fill='%23880000' points='1600 460 0 760 0 650 1600 350'/%3E%3Cpolygon fill='%23A00' points='1600 800 0 800 0 750 1600 450'/%3E%3C/g%3E%3C/svg%3E");
background-attachment: fixed;
background-size: cover;
}
</style>
<x-app-layout>

    <div class="py-12 relative bg h-full max-sm:h-auto flex">
    
        <div class=" mx-auto sm:px-6 lg:px-8 text-white flex flex-col gap-10 justify-center items-center">
            <div class="w-full flex justify-center items-center"><x-jet-application-mark class="block h-40 w-auto" /></div>
            <div class=" overflow-hidden sm:rounded-lg flex flex-col justify-between items-center w-full gap-2">
            
            @if(Auth::user()->job!='M')
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Users">
                    <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Person</title><path d="M332.64 64.58C313.18 43.57 286 32 256 32c-30.16 0-57.43 11.5-76.8 32.38-19.58 21.11-29.12 49.8-26.88 80.78C156.76 206.28 203.27 256 256 256s99.16-49.71 103.67-110.82c2.27-30.7-7.33-59.33-27.03-80.6zM432 480H80a31 31 0 01-24.2-11.13c-6.5-7.77-9.12-18.38-7.18-29.11C57.06 392.94 83.4 353.61 124.8 326c36.78-24.51 83.37-38 131.2-38s94.42 13.5 131.2 38c41.4 27.6 67.74 66.93 76.18 113.75 1.94 10.73-.68 21.34-7.18 29.11A31 31 0 01432 480z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Usuarios
                    </div>
                    </div>
                </a>
                <a href="/Providers">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Bag</title><path d="M454.65 169.4A31.82 31.82 0 00432 160h-64v-16a112 112 0 00-224 0v16H80a32 32 0 00-32 32v216c0 39 33 72 72 72h272a72.22 72.22 0 0050.48-20.55 69.48 69.48 0 0021.52-50.2V192a31.75 31.75 0 00-9.35-22.6zM176 144a80 80 0 01160 0v16H176z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Proveedores
                    </div>
                </div>
                </a>
            </div>
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Customers">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>People</title><path d="M336 256c-20.56 0-40.44-9.18-56-25.84-15.13-16.25-24.37-37.92-26-61-1.74-24.62 5.77-47.26 21.14-63.76S312 80 336 80c23.83 0 45.38 9.06 60.7 25.52 15.47 16.62 23 39.22 21.26 63.63-1.67 23.11-10.9 44.77-26 61C376.44 246.82 356.57 256 336 256zm66-88zM467.83 432H204.18a27.71 27.71 0 01-22-10.67 30.22 30.22 0 01-5.26-25.79c8.42-33.81 29.28-61.85 60.32-81.08C264.79 297.4 299.86 288 336 288c36.85 0 71 9 98.71 26.05 31.11 19.13 52 47.33 60.38 81.55a30.27 30.27 0 01-5.32 25.78A27.68 27.68 0 01467.83 432zM147 260c-35.19 0-66.13-32.72-69-72.93-1.42-20.6 5-39.65 18-53.62 12.86-13.83 31-21.45 51-21.45s38 7.66 50.93 21.57c13.1 14.08 19.5 33.09 18 53.52-2.87 40.2-33.8 72.91-68.93 72.91zM212.66 291.45c-17.59-8.6-40.42-12.9-65.65-12.9-29.46 0-58.07 7.68-80.57 21.62-25.51 15.83-42.67 38.88-49.6 66.71a27.39 27.39 0 004.79 23.36A25.32 25.32 0 0041.72 400h111a8 8 0 007.87-6.57c.11-.63.25-1.26.41-1.88 8.48-34.06 28.35-62.84 57.71-83.82a8 8 0 00-.63-13.39c-1.57-.92-3.37-1.89-5.42-2.89z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Clientes
                    </div>
                </div>
                </a>
                <a href="/Products">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Storefront</title><path d="M480 448h-12a4 4 0 01-4-4V273.51a4 4 0 00-5.24-3.86 104.92 104.92 0 01-28.32 4.78c-1.18 0-2.3.05-3.4.05a108.22 108.22 0 01-52.85-13.64 8.23 8.23 0 00-8 0 108.18 108.18 0 01-52.84 13.64 106.11 106.11 0 01-52.46-13.79 8.21 8.21 0 00-8.09 0 108.14 108.14 0 01-53.16 13.8 106.19 106.19 0 01-52.77-14 8.25 8.25 0 00-8.16 0 106.19 106.19 0 01-52.77 14c-1.09 0-2.19 0-3.37-.05h-.06a104.91 104.91 0 01-29.28-5.09 4 4 0 00-5.23 3.8V444a4 4 0 01-4 4H32.5c-8.64 0-16.1 6.64-16.48 15.28A16 16 0 0032 480h447.5c8.64 0 16.1-6.64 16.48-15.28A16 16 0 00480 448zm-256-68a4 4 0 01-4 4h-88a4 4 0 01-4-4v-64a12 12 0 0112-12h72a12 12 0 0112 12zm156 68h-72a4 4 0 01-4-4V316a12 12 0 0112-12h56a12 12 0 0112 12v128a4 4 0 01-4 4zM492.57 170.28l-42.92-98.49C438.41 47.62 412.74 32 384.25 32H127.7c-28.49 0-54.16 15.62-65.4 39.79l-42.92 98.49c-9 19.41 2.89 39.34 2.9 39.35l.28.45c.49.78 1.36 2 1.89 2.78.05.06.09.13.14.2l5 6.05a7.45 7.45 0 00.6.65l5 4.83.42.36a69.65 69.65 0 009.39 6.78v.05a74 74 0 0036 10.67h2.47a76.08 76.08 0 0051.89-20.31l.33-.31a7.94 7.94 0 0110.89 0l.33.31a77.3 77.3 0 00104.46 0 8 8 0 0110.87 0 77.31 77.31 0 00104.21.23 7.88 7.88 0 0110.71 0 76.81 76.81 0 0052.31 20.08h2.49a71.35 71.35 0 0035-10.7c.95-.57 1.86-1.17 2.78-1.77A71.33 71.33 0 00488 212.17l1.74-2.63q.26-.4.48-.84c1.66-3.38 10.56-20.76 2.35-38.42z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Inventario
                    </div>
                </div>
                </a>
            </div>
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Vehicles">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Car</title><path d="M447.68 220.78a16 16 0 00-1-3.08l-37.78-88.16C400.19 109.17 379 96 354.89 96H157.11c-24.09 0-45.3 13.17-54 33.54L65.29 217.7A15.72 15.72 0 0064 224v176a16 16 0 0016 16h32a16 16 0 0016-16v-16h256v16a16 16 0 0016 16h32a16 16 0 0016-16V224a16.15 16.15 0 00-.32-3.22zM144 320a32 32 0 1132-32 32 32 0 01-32 32zm224 0a32 32 0 1132-32 32 32 0 01-32 32zM104.26 208l28.23-65.85C136.11 133.69 146 128 157.11 128h197.78c11.1 0 21 5.69 24.62 14.15L407.74 208z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Vehiculos
                    </div>
                </div>
                </a>
                <a href="/Reports">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Document</title><path d="M428 224H288a48 48 0 01-48-48V36a4 4 0 00-4-4h-92a64 64 0 00-64 64v320a64 64 0 0064 64h224a64 64 0 0064-64V228a4 4 0 00-4-4z"/><path d="M419.22 188.59L275.41 44.78a2 2 0 00-3.41 1.41V176a16 16 0 0016 16h129.81a2 2 0 001.41-3.41z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Reportes
                    </div>
                </div>
                </a>
            </div>
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Billing">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Cash</title><path d="M448 400H64a16 16 0 010-32h384a16 16 0 010 32zM416 448H96a16 16 0 010-32h320a16 16 0 010 32zM32 272H16v48a32 32 0 0032 32h48v-16a64.07 64.07 0 00-64-64z"/><path d="M480 240h16v-64h-16a96.11 96.11 0 01-96-96V64H128v16a96.11 96.11 0 01-96 96H16v64h16a96.11 96.11 0 0196 96v16h256v-16a96.11 96.11 0 0196-96zm-224 64a96 96 0 1196-96 96.11 96.11 0 01-96 96z"/><circle cx="256" cy="208" r="64"/><path d="M416 336v16h48a32 32 0 0032-32v-48h-16a64.07 64.07 0 00-64 64zM480 144h16V96a32 32 0 00-32-32h-48v16a64.07 64.07 0 0064 64zM96 80V64H48a32 32 0 00-32 32v48h16a64.07 64.07 0 0064-64z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Facturación
                    </div>
                </div>
                </a>
            </div>
            @else
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Customers">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>People</title><path d="M336 256c-20.56 0-40.44-9.18-56-25.84-15.13-16.25-24.37-37.92-26-61-1.74-24.62 5.77-47.26 21.14-63.76S312 80 336 80c23.83 0 45.38 9.06 60.7 25.52 15.47 16.62 23 39.22 21.26 63.63-1.67 23.11-10.9 44.77-26 61C376.44 246.82 356.57 256 336 256zm66-88zM467.83 432H204.18a27.71 27.71 0 01-22-10.67 30.22 30.22 0 01-5.26-25.79c8.42-33.81 29.28-61.85 60.32-81.08C264.79 297.4 299.86 288 336 288c36.85 0 71 9 98.71 26.05 31.11 19.13 52 47.33 60.38 81.55a30.27 30.27 0 01-5.32 25.78A27.68 27.68 0 01467.83 432zM147 260c-35.19 0-66.13-32.72-69-72.93-1.42-20.6 5-39.65 18-53.62 12.86-13.83 31-21.45 51-21.45s38 7.66 50.93 21.57c13.1 14.08 19.5 33.09 18 53.52-2.87 40.2-33.8 72.91-68.93 72.91zM212.66 291.45c-17.59-8.6-40.42-12.9-65.65-12.9-29.46 0-58.07 7.68-80.57 21.62-25.51 15.83-42.67 38.88-49.6 66.71a27.39 27.39 0 004.79 23.36A25.32 25.32 0 0041.72 400h111a8 8 0 007.87-6.57c.11-.63.25-1.26.41-1.88 8.48-34.06 28.35-62.84 57.71-83.82a8 8 0 00-.63-13.39c-1.57-.92-3.37-1.89-5.42-2.89z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Clientes
                    </div>
                </div>
                </a>
                <a href="/Vehicles">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Car</title><path d="M447.68 220.78a16 16 0 00-1-3.08l-37.78-88.16C400.19 109.17 379 96 354.89 96H157.11c-24.09 0-45.3 13.17-54 33.54L65.29 217.7A15.72 15.72 0 0064 224v176a16 16 0 0016 16h32a16 16 0 0016-16v-16h256v16a16 16 0 0016 16h32a16 16 0 0016-16V224a16.15 16.15 0 00-.32-3.22zM144 320a32 32 0 1132-32 32 32 0 01-32 32zm224 0a32 32 0 1132-32 32 32 0 01-32 32zM104.26 208l28.23-65.85C136.11 133.69 146 128 157.11 128h197.78c11.1 0 21 5.69 24.62 14.15L407.74 208z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Vehiculos
                    </div>
                </div>
                </a>
            </div>
            <div class="flex justify-between  max-sm:flex-col max-sm:w-full  gap-2">
                <a href="/Products">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Storefront</title><path d="M480 448h-12a4 4 0 01-4-4V273.51a4 4 0 00-5.24-3.86 104.92 104.92 0 01-28.32 4.78c-1.18 0-2.3.05-3.4.05a108.22 108.22 0 01-52.85-13.64 8.23 8.23 0 00-8 0 108.18 108.18 0 01-52.84 13.64 106.11 106.11 0 01-52.46-13.79 8.21 8.21 0 00-8.09 0 108.14 108.14 0 01-53.16 13.8 106.19 106.19 0 01-52.77-14 8.25 8.25 0 00-8.16 0 106.19 106.19 0 01-52.77 14c-1.09 0-2.19 0-3.37-.05h-.06a104.91 104.91 0 01-29.28-5.09 4 4 0 00-5.23 3.8V444a4 4 0 01-4 4H32.5c-8.64 0-16.1 6.64-16.48 15.28A16 16 0 0032 480h447.5c8.64 0 16.1-6.64 16.48-15.28A16 16 0 00480 448zm-256-68a4 4 0 01-4 4h-88a4 4 0 01-4-4v-64a12 12 0 0112-12h72a12 12 0 0112 12zm156 68h-72a4 4 0 01-4-4V316a12 12 0 0112-12h56a12 12 0 0112 12v128a4 4 0 01-4 4zM492.57 170.28l-42.92-98.49C438.41 47.62 412.74 32 384.25 32H127.7c-28.49 0-54.16 15.62-65.4 39.79l-42.92 98.49c-9 19.41 2.89 39.34 2.9 39.35l.28.45c.49.78 1.36 2 1.89 2.78.05.06.09.13.14.2l5 6.05a7.45 7.45 0 00.6.65l5 4.83.42.36a69.65 69.65 0 009.39 6.78v.05a74 74 0 0036 10.67h2.47a76.08 76.08 0 0051.89-20.31l.33-.31a7.94 7.94 0 0110.89 0l.33.31a77.3 77.3 0 00104.46 0 8 8 0 0110.87 0 77.31 77.31 0 00104.21.23 7.88 7.88 0 0110.71 0 76.81 76.81 0 0052.31 20.08h2.49a71.35 71.35 0 0035-10.7c.95-.57 1.86-1.17 2.78-1.77A71.33 71.33 0 00488 212.17l1.74-2.63q.26-.4.48-.84c1.66-3.38 10.56-20.76 2.35-38.42z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Inventario
                    </div>
                </div>
                </a>
                <a href="/Reports">
                <div class=" w-[20rem] h-[8rem]  max-sm:w-[70vw] max-sm:h-[10rem] bg-white/10 backdrop-blur-lg rounded hover:bg-white/40 active:bg-white/50 duration-200 cursor-pointer grid grid-cols-2 text-[20px]">
                    <div class="h-[8rem]  max-sm:h-[10rem] p-10 flex justify-center items-center"><svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><title>Document</title><path d="M428 224H288a48 48 0 01-48-48V36a4 4 0 00-4-4h-92a64 64 0 00-64 64v320a64 64 0 0064 64h224a64 64 0 0064-64V228a4 4 0 00-4-4z"/><path d="M419.22 188.59L275.41 44.78a2 2 0 00-3.41 1.41V176a16 16 0 0016 16h129.81a2 2 0 001.41-3.41z"/></svg>
                    </div>
                    <div class="h-[8rem]  max-sm:h-[10rem] p-y-10 flex justify-start items-center">
                        Reportes
                    </div>
                </div>
                </a>
            </div>
            @endif
    </div>
</x-app-layout>
