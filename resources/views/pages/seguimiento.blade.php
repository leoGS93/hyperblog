@extends('../layout/' . $layout)

@section('subhead')
    <title>Dashboard - Midone - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Reporte General</h2>
                    <a href="" class="ml-auto flex text-theme-1 dark:text-theme-10">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Recargar información
                    </a>
                </div>
                <div class="intro-y pr-1">
                    <div class="box p-1">
                        <div class="pos__tabs nav-tabs justify-center flex">
                            <a data-toggle="tab" class="flex-1 py-2 rounded-md text-center active">Potenciales</a>
                            <a data-toggle="tab" class="flex-1 py-2 rounded-md text-center ">Nuevos</a>
                            <a data-toggle="tab" class="flex-1 py-2 rounded-md text-center">Recomendados</a>
                            <a data-toggle="tab" class="flex-1 py-2 rounded-md text-center">Clientes</a>
                        </div>
                    </div>

                </div>
            </div>
            <!-- END: General Report -->

            <!-- BEGIN: Weekly Top Products -->
            <div class="col-span-12 mt-6">
                <div class="intro-y block sm:flex items-center h-10 ">
                    <h2 class="text-lg font-medium truncate mr-5">Listado</h2>
                    <div class="flex items-center sm:ml-auto mt-3  sm:mt-0">
                        <button class="button w-32 box flex items-center bg-theme-1 text-white mr-3 ">
                            <i data-feather="plus" class="hidden sm:block w-4 h-4 mr-2"></i> Registrar
                        </button>

                        <button class="button box flex items-center text-gray-700 dark:text-gray-300">
                            <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Exportar Excel
                        </button>
                        <button class="ml-3 button box flex items-center text-gray-700 dark:text-gray-300">
                            <i data-feather="file-text" class="hidden sm:block w-4 h-4 mr-2"></i> Exportar Pdf
                        </button>
                    </div>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2">
                        <thead>
                            <tr>
                                <th class="whitespace-no-wrap">IMAGES</th>
                                <th class="whitespace-no-wrap">NOMBRE</th>
                                <th class="text-center whitespace-no-wrap">SITIO WEB</th>
                                <th class="whitespace-no-wrap">EQUIPO</th>
                                <th class="text-center whitespace-no-wrap">PRIORIDAD</th>
                                <th class="text-center whitespace-no-wrap">STATUS</th>
                                <th class="text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (array_slice($fakers, 0, 4) as $faker)
                                <tr class="intro-x">
                                    <td class="w-40">
                                        <div class="flex">
                                            <div class="w-10 h-10 image-fit zoom-in">
                                                <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                                    src="{{ asset('dist/images/' . $faker['images'][0]) }}"
                                                    title="Uploaded at {{ $faker['dates'][0] }}">
                                            </div>
                                            <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                                <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full"
                                                    src="{{ asset('dist/images/' . $faker['images'][1]) }}"
                                                    title="Uploaded at {{ $faker['dates'][1] }}">
                                            </div>

                                        </div>
                                    </td>
                                    <td>
                                        <a href=""
                                            class="font-medium whitespace-no-wrap">{{ $faker['products'][0]['name'] }}</a>

                                        <p class="text-gray-600 text-xs whitespace-no-wrap">Email: XXXXX</p>
                                        <p class="text-gray-600 text-xs whitespace-no-wrap">Telefono: XXXXX</p>
                                        <p class="text-gray-600 text-xs whitespace-no-wrap">Direccion: XXXXX</p>
                                    </td>
                                    <td class="text-center">https://tailwindcss.com/</td>
                                    <td>
                                        <a href="" class="font-medium whitespace-no-wrap">GEMINI</a>

                                    </td>
                                    <td class="text-center">{{ $faker['stocks'][0] }}</td>
                                    <td class="w-40">
                                        <div
                                            class="flex items-center justify-center {{ $faker['true_false'][0] ? 'text-theme-9' : 'text-theme-6' }}">
                                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i>
                                            {{ $faker['true_false'][0] ? 'Active' : 'Inactive' }}
                                        </div>
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center items-center">
                                            <a class="flex items-center mr-3" href="">
                                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Editar
                                            </a>
                                            <a class="flex items-center text-theme-6" href="">
                                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="intro-y flex flex-wrap sm:flex-row sm:flex-no-wrap items-center mt-3">
                    <ul class="pagination">
                        <li>
                            <a class="pagination__link" href="">
                                <i class="w-4 h-4" data-feather="chevrons-left"></i>
                            </a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">
                                <i class="w-4 h-4" data-feather="chevron-left"></i>
                            </a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">...</a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">1</a>
                        </li>
                        <li>
                            <a class="pagination__link pagination__link--active" href="">2</a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">3</a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">...</a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">
                                <i class="w-4 h-4" data-feather="chevron-right"></i>
                            </a>
                        </li>
                        <li>
                            <a class="pagination__link" href="">
                                <i class="w-4 h-4" data-feather="chevrons-right"></i>
                            </a>
                        </li>
                    </ul>
                    <select class="w-20 input box mt-3 sm:mt-0">
                        <option>10</option>
                        <option>25</option>
                        <option>35</option>
                        <option>50</option>
                    </select>
                </div>
            </div>
            <!-- END: Weekly Top Products -->
        </div>

    </div>
@endsection
