<div class="max-w-7xl mx-auto px-6 lg:px-8 mt-24 mb-32">
  <div class="grid grid-cols-1 md:grid-cols-2 bg-white shadow-2xl rounded-3xl overflow-hidden transition-all duration-500 hover:scale-[1.01]">

    {{-- Left Info Box --}}
    <div class="bg-gradient-to-br from-indigo-700 to-indigo-900 text-white p-10 flex flex-col justify-between relative overflow-hidden">
      <div>
        <h3 class="text-2xl font-bold mb-4">Contact Information</h3>
        <p class="text-sm text-indigo-200 mb-10">Our contact details</p>
        <div class="space-y-6 text-base font-medium">
          <div class="flex items-center gap-3">
            <span class="text-xl">📞</span>
            <span>+351 912 345 678</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="text-xl">📧</span>
            <span>habitax@project.pt</span>
          </div>
          <div class="flex items-center gap-3">
            <span class="text-xl">📍</span>
            <span>Rua Exemplo, 123, Lisboa, Portugal</span>
          </div>
        </div>
      </div>

      {{-- Decoration --}}
      <div class="absolute bottom-0 left-0 w-32 h-32 bg-indigo-900 rounded-full translate-x-1/2 translate-y-1/2 blur-3xl opacity-40 z-0"></div>
      <div class="absolute bottom-0 right-0 w-48 h-48 bg-indigo-500 rounded-full translate-x-1/3 translate-y-1/2 blur-2xl opacity-30 z-0"></div>
    </div>

    {{-- Right Form --}}
    <div class="p-10 bg-gray-50">
      <form action="#" method="POST" class="space-y-6 relative z-10">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="first_name" class="block text-sm font-semibold text-gray-700">First Name</label>
            <input type="text" id="first_name" name="first_name"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="John">
          </div>
          <div>
            <label for="last_name" class="block text-sm font-semibold text-gray-700">Last Name</label>
            <input type="text" id="last_name" name="last_name"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="Doe">
          </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
            <input type="email" id="email" name="email"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="john.doe@example.com">
          </div>
          <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700">Phone</label>
            <input type="text" id="phone" name="phone"
                   class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                   placeholder="+351 912 345 678">
          </div>
        </div>

        <div>
          <label for="message" class="block text-sm font-semibold text-gray-700">Message</label>
          <textarea id="message" name="message" rows="4"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Write your message here..."></textarea>
        </div>

        <div>
          <button type="submit"
                  class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 rounded-lg shadow-md transition-all duration-300 hover:shadow-xl hover:scale-105">
            Send Message
          </button>
        </div>
      </form>
    </div>

  </div>
</div>
