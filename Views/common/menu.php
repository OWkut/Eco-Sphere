<nav class="bg-white shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16">
        <div class="flex">
          <a href="#" class="flex-shrink-0 flex items-center">
            <span class="text-xl font-bold text-blue-600">Eco-Sphere</span>
          </a>
          <div class="flex items-center hidden sm:ml-6 sm:flex sm:space-x-8">
            <a href="<?= URL ?>accueil" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Home</a>
            <?php if(!empty($_SESSION['profil']['role']) && $_SESSION['profil']['role']==="Utilisateurs") : ?>
              <a href="<?= URL ?>echange" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Echanges</a>
            <?php endif; ?>
          </div>
        </div>
        <div class="flex items-center">
            <?php if(!empty($_SESSION['profil']['role']) && $_SESSION['profil']['role']==="Admin") : ?>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="<?= URL ?>droits" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Gestion des comptes</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="flex items-center">
            <?php if(!empty($_SESSION['profil'])) : ?>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="<?= URL ?>evenement" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Evenement</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="<?= URL ?>profil" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Profil</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="<?= URL ?>logement" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Recherche de logement</a>
                </div>
                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <a href="<?= URL ?>aides" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Conseils Pratiques</a>
                </div>
            <?php endif; ?>
        </div>
        <div class="flex items-center">
            <?php if(empty($_SESSION['profil'])) : ?>
          <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <a href="<?= URL ?>connexion" class="text-gray-900 hover:text-blue-500 px-3 py-2 rounded-md text-sm font-medium">Login</a>
            <a href="<?= URL ?>inscription" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Sign Up</a>
          </div>
          <?php else: ?>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <a href="<?= URL ?>deconnexion" class="ml-4 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Déconnexion</a>
          <?php endif; ?>
          <div class="-mr-2 flex sm:hidden">
            <button type="button" class="bg-blue-600 inline-flex items-center justify-center p-2 rounded-md text-white hover:bg-blue-700 focus:outline-none">
              <span class="sr-only">Open menu</span>
              <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    </div>
</nav>