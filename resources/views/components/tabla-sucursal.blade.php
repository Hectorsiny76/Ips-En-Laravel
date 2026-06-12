@props(['columnas' => [], 'filas' => []])

<div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition-all hover:shadow-md">
    <div class="overflow-x-auto">
        <table class="w-full border-collapse text-left text-sm text-gray-500">
            <thead class="bg-gradient-to-r from-green-700 to-green-600 text-white">
                <tr>
                    @foreach($columnas as $col)
                        <th scope="col" class="px-6 py-4 font-semibold uppercase tracking-wider">
                            {{ $col['label'] }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 border-t border-gray-100">
                @forelse($filas as $fila)
                    <tr class="transition-colors hover:bg-green-50/50">
                        @foreach($columnas as $col)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-medium text-gray-700">
                                    {{ data_get($fila, $col['key']) ?? '—' }}
                                </span>
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ count($columnas) }}" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center space-y-2">
                                <svg class="h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p class="text-gray-400 italic">No se encontraron resultados</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
