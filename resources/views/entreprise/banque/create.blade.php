@extends('layouts.entreprise.entreprise')

@section('content')
<div class="row">
    <div class="col-12">
        @include('layouts.entreprise.required.includes.alert')
    </div>
</div>
<div class="grid grid-cols-12 gap-6 mt-8">
    <div class="col-span-12 lg:col-span-12 xxl:col-span-12">
        <!-- BEGIN: File Manager Filter -->
        <div class="intro-y flex flex-col-reverse sm:flex-row items-center">
            <div class="w-full sm:w-auto relative mr-auto mt-3 sm:mt-0">
                <i class="w-4 h-4 absolute my-auto inset-y-0 ml-3 left-0 z-10 text-gray-700 dark:text-gray-300"
                    data-feather="search"></i>
                <input type="text"
                    class="form-control w-full sm:w-64 box px-10 text-gray-700 dark:text-gray-300 placeholder-theme-8"
                    placeholder="Search files">
                <div class="inbox-filter dropdown absolute inset-y-0 mr-3 right-0 flex items-center"
                    data-placement="bottom-start">
                    <i class="dropdown-toggle w-4 h-4 cursor-pointer text-gray-700 dark:text-gray-300" role="button"
                        aria-expanded="false" data-feather="chevron-down"></i>
                    <div class="inbox-filter__dropdown-menu dropdown-menu pt-2">
                        <div class="dropdown-menu__content box p-5">
                            <div class="grid grid-cols-12 gap-4 gap-y-3">
                                <div class="col-span-12 flex items-center mt-3">
                                    <button class="btn btn-primary w-32 ml-2">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-auto flex">
                <a href="{{route('banques.index')}}" class="btn btn-primary shadow-md mr-2"><i class="w-4 h-4 mr-2"
                        data-feather="list"></i>Liste banque</a>
            </div>
        </div>
        <!-- END: File Manager Filter -->
        <!-- BEGIN: Directory & Files -->
        <div class="intro-y grid grid-cols-12 gap-3 sm:gap-12 mt-5">
            <div class="intro-y col-span-12 lg:col-span-6">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    <form action="{{ route('banques.store')}}" method="POST">
                        @csrf
                        <div class="m-2 mb-3">
                            <label for="crud-form-1" class="form-label">Nom <span class="text-danger" style="color: red">*</span></label>
                            <input id="crud-form-1" type="text" name="nom"
                                class="form-control w-full @error('nom') is-invalid @enderror" placeholder="Ex: BICIS">
                            @error('nom')
                            <span class="invalid-feedback" style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="m-2 mb-3">
                            <label for="crud-form-2" class="form-label">Numero Compte <span
                                    class="text-danger" style="color: red">*</span></label>
                            <input id="crud-form-2" name="numero_compte" type="number" class="form-control w-full @error('numero_compte') is-invalid @enderror"
                                placeholder="Ex: 1248791499864">
                                @error('numero_compte')
                            <span class="invalid-feedback" style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="m-2 mb-3">
                            <label for="crud-form-3" class="form-label">Logo</label>
                            <input id="crud-form-3" type="file" name="logo_banque" class="form-control w-full @error('logo_banque') is-invalid @enderror"
                                placeholder="Input text">
                                @error('logo_banque')
                            <span class="invalid-feedback " style="color: red" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="text-right mt-5">
                            <a href="{{route('banques.index')}}" class="btn btn-outline-danger w-24 mr-1">Annuler</a>
                            <button type="submit" class="btn btn-primary w-24">Enregistrer</button>
                        </div>
                    </form>
                </div>
                <!-- END: Form Layout -->
            </div>
            <div class="intro-y col-span-12 lg:col-span-6">
                <table class="table table-report -mt-2">
                    <thead>
                        <tr>
                            <th class="whitespace-nowrap">IMAGES</th>
                            <th class="whitespace-nowrap">Nom</th>
                            <th class="text-center whitespace-nowrap">Numéro banque</th>
                            <th class="whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($banques as $banque)
                        <tr class="intro-x">
                            <td class="w-40">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    <img alt="Icewall Tailwind HTML Admin Template" class="tooltip rounded-full" src="{{asset( $banque->logo_entreprise ?? 'assets/entreprise/images/preview-11.jpg')}}">
                                </div>
                            </td>
                            <td>
                                {{ $banque->nom ?? '-' }}
                            </td>
                            <td class="text-center">{{ $banque->numero_compte ?? '-' }}</td>
                            <td style="display: flex; justify-content: center">
                                <a href="{{ route('banques.edit', $banque)}}" class="btn btn-info"
                                    title="Edit"><i data-feather="edit"></i></a>
                                <form
                                    action="{{ route('banques.destroy', $banque) }}"
                                    method="POST"
                                    onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger js-sweetalert dltBtn ml-2" title="Delete"><i
                                        data-feather="trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <p>Pas de banque disponible
                        @endforelse
                    </tbody>

                    <tfoot>
                        <tr>
                            <td colspan="5">
                                <div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-nowrap items-center">
                                    <ul class="pagination">
                                        <li class="pagination__link">
                                            {!! $banques->render() !!}
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- END: Directory & Files -->
        <!-- BEGIN: Pagination -->

        <!-- END: Pagination -->
    </div>
</div>
@endsection
