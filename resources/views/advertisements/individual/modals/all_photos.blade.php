<div id="photos-modal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-black bg-opacity-75 flex items-center justify-center">
    <div class="relative bg-white rounded-lg max-w-6xl w-full mx-auto max-h-[90vh] overflow-y-auto my-4">
        <!-- Header -->
        <div class="sticky top-0 bg-white p-4 border-b flex justify-between items-center z-10">
            <h3 class="text-xl font-bold text-gray-800">
                <i class="bi bi-images text-secondary mr-2"></i>
                Todas as fotos ({{ count($images) }})
            </h3>
            <button id="closePhotosModal" class="p-2 hover:bg-gray-100 rounded-full transition-colors">
                <i class="bi bi-x-lg text-gray-600 text-xl"></i>
            </button>
        </div>

        <!-- Photos Grid -->
        <div class="p-4 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 photos-container">
            @foreach($images as $index => $image)
                <div class="photo-item relative aspect-square cursor-pointer overflow-hidden rounded-lg shadow hover:shadow-md transition-all hover:scale-[1.02]"
                     data-index="{{ $index }}">
                    <img src="{{ $image->getUrl('preview') }}"
                         class="w-full h-full object-cover"
                         loading="lazy"
                         alt="Fotografia {{ $index + 1 }}">
                </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    body.modal-open {
        overflow: hidden;
    }

    #photos-modal {
        display: none !important;
    }

    #photos-modal.modal-visible {
        display: flex !important;
    }

    .photos-container {
        max-height: calc(90vh - 80px); /* Altura máxima menos o header */
        overflow-y: auto;
    }

    .photo-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40%;
        background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);
        opacity: 0;
        transition: opacity 0.2s;
    }

    .photo-item:hover::after {
        opacity: 1;
    }
</style>
