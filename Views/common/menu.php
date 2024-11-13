<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <a href="#" class="flex-shrink-0 flex items-center">
            <span class="text-xl font-bold text-blue-600">Eco-Sphere</span>
          </a>
          <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
            <a href="#" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <a href="#" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">About</a>
            <a href="#" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Services</a>
            <a href="#" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Contact</a>
          </div>
        </div>
        <div class="flex items-center">
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <a href="<?= URL ?>\connexion" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <a href="<?= URL ?>\inscription" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Sign Up</a>
          </div>
          <div class="-mr-2 flex sm:hidden">
            <button type="button" class="bg-blue-600 inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-blue-700 focus:outline-none">
              <span class="sr-only">Open menu</span>
              <!-- Heroicon: Menu -->
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu -->
    <div class="sm:hidden">
      <div class="pt-2 pb-3 space-y-1">
        <a href="#" class="block text-gray-900 hover:bg-gray-50 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Home</a>
        <a href="<?= URL ?>\echange" class="block text-gray-900 hover:bg-gray-50 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Echanges</a>
        <a href="#" class="block text-gray-900 hover:bg-gray-50 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Services</a>
        <a href="#" class="block text-gray-900 hover:bg-gray-50 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Contact</a>
      </div>
      <div class="pt-4 pb-3 border-t border-gray-200">
        <a href="<?= URL ?>\connexion" class="block text-gray-900 hover:bg-gray-50 hover:text-blue-500 px-3 py-2 rounded-md text-base font-medium">Login</a>
        <a href="<?= URL ?>\inscription" class="block bg-blue-600 text-white hover:bg-blue-700 px-4 py-2 rounded-md text-base font-medium mt-2">Sign Up</a>
      </div>
    </div>
</nav>