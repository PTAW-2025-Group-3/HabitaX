{{-- resources/views/home/featured.blade.php --}}

<section class="bg-gray-100 pt-3 pb-20 px-6 lg:px-24">
    <div class="max-w-7xl mx-auto">

      {{-- Section Heading --}}
      <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-14">
        As Nossas <span class="text-indigo-500">Melhores Ofertas</span>
      </h2>

      {{-- Properties Grid --}}
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10">

        @php
          $properties = [
            ['img' => 'img1.jpg', 'location' => 'Mesão Frio (Santo André)', 'price' => '250.000€', 'type' => 'for sale'],
            ['img' => 'img2.jpg', 'location' => 'Espinho, Portugal', 'price' => '78€ / night', 'type' => 'monthly rental'],
            ['img' => 'img3.jpg', 'location' => 'Braga, Portugal', 'price' => '159.000€', 'type' => 'for sale'],
            ['img' => 'img4.jpg', 'location' => 'Vila Nova Poiares, Portugal', 'price' => '325.000€', 'type' => 'for sale'],
            ['img' => 'img5.jpg', 'location' => 'Gemeses, Portugal', 'price' => '176€ / night', 'type' => 'weekly rental'],
            ['img' => 'img6.jpg', 'location' => 'Castelo Branco, Portugal', 'price' => '15€ / night', 'type' => 'weekly rental'],
            ['img' => 'img7.jpg', 'location' => 'Chaves, Portugal', 'price' => '155.000€', 'type' => 'for sale'],
            ['img' => 'img8.jpg', 'location' => 'Gemeses, Portugal', 'price' => '225€ / night', 'type' => 'weekly rental'],
          ];
        @endphp

        @foreach($properties as $property)
          <div
            class="group bg-white rounded-2xl overflow-hidden shadow-[0_20px_60px_-15px_rgba(0,0,0,0.2)] hover:shadow-[0_35px_80px_-20px_rgba(0,0,0,0.3)] transition-all duration-300 transform hover:-translate-y-2 cursor-pointer">

            {{-- Image with zoom effect --}}
            <div class="overflow-hidden h-48">
              <img src="{{ asset('images/' . $property['img']) }}"
                   alt="property image"
                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out" />
            </div>

            {{-- Content --}}
            <div class="p-5">
              <h3 class="text-sm text-gray-700 font-medium mb-1">
                {{ $property['location'] }}
              </h3>
              <p class="text-xl font-bold text-gray-900 leading-tight">
                {{ $property['price'] }}
              </p>
              <p class="text-sm text-gray-500 capitalize mt-1">
                {{ $property['type'] }}
              </p>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </section>
