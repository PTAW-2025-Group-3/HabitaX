<table class="w-full text-sm">
    <thead>
    <tr class="bg-gray-50 text-left text-gray-secondary">
        @foreach ($headers as $header)
            <th class="px-6 py-3 font-medium">{{ $header }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody class="divide-y divide-gray-100">
    @foreach ($rows as $row)
        <tr class="hover:bg-gray-50 transition">
            @foreach ($row as $cell)
                <td class="px-6 py-4 whitespace-nowrap">{!! $cell !!}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
