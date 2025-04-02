<div class="mt-10">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">

        @include('pages.moderation.partials.table-sections.section-header', ['title' => $section['title'], 'filters' => $section['filters']])

        <div class="overflow-x-auto">
            @include('pages.moderation.partials.table-sections.section-table', ['headers' => $section['headers'], 'rows' => $section['rows']])
        </div>

        @include('pages.moderation.partials.table-sections.section-pagination')

    </div>
</div>
