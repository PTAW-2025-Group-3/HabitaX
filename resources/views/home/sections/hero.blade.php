{{-- PAGE: Home / Hero Section
<section class="relative w-full h-[80vh] bg-gray-100 overflow-hidden">

  <div class="absolute inset-0 z-0 animate-slide bg-cover bg-center transition-all duration-1000"
       style="background-image: url('{{ asset('images/img1.jpg') }}');"
       id="hero-bg">
  </div>

  <div class="absolute inset-0 bg-black bg-opacity-50 z-10"></div>

  <div class="relative z-20 flex flex-col items-center justify-center h-full text-center text-white px-4">
      <h1 class="text-4xl sm:text-5xl font-bold mb-4 drop-shadow-lg">
          Your Space, <span class="text-indigo-400">Your Choice</span>
      </h1>
      <p class="text-lg sm:text-xl mb-6 text-gray-200 max-w-2xl drop-shadow-md">
          Find or publish the perfect real estate listing across Portugal with HabitaX.
      </p>

      <div class="w-full max-w-3xl bg-white rounded-xl shadow-lg overflow-hidden flex flex-col sm:flex-row items-stretch">
          <input type="text"
                 placeholder="Location, City, Zone"
                 class="w-full p-4 text-gray-800 text-sm focus:outline-none"
          />
          <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 text-sm font-semibold transition">
              Search
          </button>
      </div>
  </div>
</section>

<script>
  const images = [
      "{{ asset('images/img1.jpg') }}",
      "{{ asset('images/img2.jpg') }}",
      "{{ asset('images/img3.jpg') }}",
      "{{ asset('images/img4.jpg') }}",
      "{{ asset('images/img5.jpg') }}",
      "{{ asset('images/img6.jpg') }}"
  ];

  let i = 1;
  setInterval(() => {
      const el = document.getElementById('hero-bg');
      el.style.backgroundImage = `url('${images[i]}')`;
      i = (i + 1) % images.length;
  }, 5000);
</script> --}}
