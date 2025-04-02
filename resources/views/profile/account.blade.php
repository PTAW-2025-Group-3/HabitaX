@extends('layout.app')

@section('title', 'My Account')

@section('content')
  {{-- TOP NAVBAR --}}
  <div class="w-full flex justify-center mt-10">
    <div class="flex space-x-1 bg-[#002F5F] px-4 py-3 rounded-xl shadow-md text-white text-sm md:text-base font-medium">
      <a href="#" class="bg-white text-[#002F5F] px-4 py-2 rounded-md shadow font-bold">Account</a>
      <a href="#" class="hover:text-indigo-300 px-4 py-2">My Properties</a>
      <a href="#" class="hover:text-indigo-300 px-4 py-2">My Ads</a>
      <a href="#" class="relative hover:text-indigo-300 px-4 py-2">
        Contact Requests
        <span class="absolute -top-2 -right-3 bg-indigo-400 text-white text-xs w-5 h-5 rounded-full flex items-center justify-center">3</span>
      </a>
      <a href="#" class="hover:text-indigo-300 px-4 py-2">Favorites</a>
    </div>
  </div>

  {{-- PROFILE SECTION --}}
  <div class="max-w-3xl mx-auto mt-10 bg-white p-8 rounded-xl shadow-lg">

    {{-- Name & Email --}}
    <div class="text-center mb-6">
      <h2 class="text-xl font-bold text-gray-900">{{ $user->name }}</h2>
      <p class="text-sm text-gray-500">{{ $user->email }}</p>
    </div>

    <div class="flex flex-col md:flex-row items-start md:items-center md:space-x-8 space-y-6 md:space-y-0">

      {{-- Avatar --}}
      <div class="flex flex-col items-center">
        <div class="w-36 h-36 rounded-full bg-gray-100 border-4 border-[#c9cfff] shadow-inner flex items-center justify-center text-gray-400 text-sm">
          No Image
        </div>
        <p class="text-sm text-gray-500 mt-2">Change Photo</p>
      </div>

      {{-- Account Details --}}
      <div class="flex-1 w-full space-y-4">
        {{-- Name --}}
        <div>
          <label class="text-sm font-semibold text-gray-700 block mb-1">Name</label>
          <div class="flex items-center">
            <input type="text" value="{{ $user->name }}" disabled
                   class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800">
            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2L9 17H7v-2l8-8z" />
            </svg>
          </div>
        </div>

        {{-- Email --}}
        <div>
          <label class="text-sm font-semibold text-gray-700 block mb-1">Email</label>
          <div class="flex items-center">
            <input type="email" value="{{ $user->email }}" disabled
                   class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800">
            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2L9 17H7v-2l8-8z" />
            </svg>
          </div>
        </div>

        {{-- Phone --}}
        <div>
          <label class="text-sm font-semibold text-gray-700 block mb-1">Phone</label>
          <div class="flex items-center">
            <input type="text" value="{{ $user->phone ?? '+351 000 000 000' }}" disabled
                   class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-gray-800">
            <svg class="w-4 h-4 ml-2 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13l6-6m2 2L9 17H7v-2l8-8z" />
            </svg>
          </div>
        </div>

        {{-- Buttons --}}
        <button class="w-full text-left px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm hover:bg-gray-200 transition">
          Change Password
        </button>

        <button class="w-full text-left px-4 py-2 bg-gray-100 border border-gray-300 rounded-md text-sm hover:bg-gray-200 transition">
          Identity Verification
        </button>

        <button class="w-full text-white bg-red-600 hover:bg-red-700 py-2 rounded-md transition font-semibold">
          Delete Account →
        </button>
      </div>
    </div>
  </div>
@endsection
