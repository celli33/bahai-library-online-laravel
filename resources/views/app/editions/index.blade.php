<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.editions.index_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">
                            <form>
                                <div class="flex items-center w-full">
                                    <x-inputs.text
                                        name="search"
                                        value="{{ $search ?? '' }}"
                                        placeholder="{{ __('crud.common.search') }}"
                                        autocomplete="off"
                                    ></x-inputs.text>

                                    <div class="ml-1">
                                        <button
                                            type="submit"
                                            class="button button-primary"
                                        >
                                            <i class="icon ion-md-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Edition::class)
                            <a
                                href="{{ route('editions.create') }}"
                                class="button button-primary"
                            >
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table class="w-full max-w-full mb-4 bg-transparent">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.title')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.subtitle')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.title_parent')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.volume')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.page_range')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.page_total')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.publisher_name')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.publisher_city')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.date')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.isbn')
                                </th>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.editions.inputs.document_id')
                                </th>
                                <th class="px-4 py-3 text-right">
                                    @lang('crud.common.actions')
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($editions as $edition)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->title ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->subtitle ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->title_parent ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->volume ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->page_range ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->page_total ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->publisher_name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->publisher_city ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->date ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ $edition->isbn ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ optional($edition->document)->slug ?? '-'
                                    }}
                                </td>
                                <td
                                    class="px-4 py-3 text-center"
                                    style="width: 134px;"
                                >
                                    <div
                                        role="group"
                                        aria-label="Row Actions"
                                        class="relative inline-flex align-middle"
                                    >
                                        @can('update', $edition)
                                        <a
                                            href="{{ route('editions.edit', $edition) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-create"
                                                ></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $edition)
                                        <a
                                            href="{{ route('editions.show', $edition) }}"
                                            class="mr-1"
                                        >
                                            <button
                                                type="button"
                                                class="button"
                                            >
                                                <i class="icon ion-md-eye"></i>
                                            </button>
                                        </a>
                                        @endcan @can('delete', $edition)
                                        <form
                                            action="{{ route('editions.destroy', $edition) }}"
                                            method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                        >
                                            @csrf @method('DELETE')
                                            <button
                                                type="submit"
                                                class="button"
                                            >
                                                <i
                                                    class="icon ion-md-trash text-red-600"
                                                ></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="12">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="12">
                                    <div class="mt-10 px-4">
                                        {!! $editions->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
