<div class="container mx-auto p-6">
    <h1 class="text-4xl font-bold mb-8 text-center">Calendrier et Événements Étudiants</h1>

    <!-- Section Networking et Soirées Étudiantes -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold mb-4">Networking et Soirées Étudiantes</h2>
        <p class="mb-4">Rejoignez les soirées étudiantes et rencontrez d'autres étudiants locaux :</p>
        <ul class="space-y-3">
            <li class="bg-white p-4 rounded-lg shadow">
                <strong>Soirée de bienvenue :</strong> Organisée par les associations étudiantes à la rentrée, idéal pour faire des rencontres.
                <span class="text-sm text-gray-500">Date : 20 septembre 2023</span>
            </li>
            <li class="bg-white p-4 rounded-lg shadow">
                <strong>Soirée internationale :</strong> Une soirée pour rencontrer des étudiants internationaux.
                <span class="text-sm text-gray-500">Date : 25 octobre 2023</span>
            </li>
        </ul>
    </section>

    <!-- Section Sorties Culturelles et Activités Locales -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold mb-4">Sorties Culturelles et Activités Locales</h2>
        <p class="mb-4">Découvrez les événements culturels et les sorties locales à Limoges :</p>
        <ul class="space-y-3">
            <li class="bg-white p-4 rounded-lg shadow">
                <strong>Festival du Cinéma :</strong> Profitez de films classiques et indépendants au festival local.
                <span class="text-sm text-gray-500">Lieu : Cinéma Grand Écran | Date : 5 - 10 novembre 2023</span>
            </li>
            <li class="bg-white p-4 rounded-lg shadow">
                <strong>Exposition d’Art Moderne :</strong> Visitez l'exposition temporaire au Musée des Beaux-Arts de Limoges.
                <span class="text-sm text-gray-500">Date : Jusqu’au 30 novembre 2023</span>
            </li>
            <li class="bg-white p-4 rounded-lg shadow">
                <strong>Concert au Parc Victor-Thuillat :</strong> Concert gratuit de musique jazz en plein air.
                <span class="text-sm text-gray-500">Date : 15 octobre 2023</span>
            </li>
        </ul>
    </section>

    <!-- Section Créer ou Rejoindre des Groupes d'Intérêts Communs -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold mb-4">Groupes d'Intérêts Communs</h2>
        <p class="mb-4">Créez ou rejoignez des groupes selon vos centres d’intérêt :</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold">Groupe de Sport</h3>
                <p class="text-gray-700">Rejoignez les sorties sportives : running, randonnée, et plus encore !</p>
                <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Rejoindre</button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold">Club de Lecture</h3>
                <p class="text-gray-700">Participez aux discussions mensuelles autour d’un livre sélectionné.</p>
                <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Rejoindre</button>
            </div>
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-xl font-bold">Atelier d’Arts</h3>
                <p class="text-gray-700">Pour les amateurs de peinture, sculpture et autres arts créatifs.</p>
                <button class="mt-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Rejoindre</button>
            </div>
        </div>
    </section>

    <!-- Section Ajouter un Événement -->
    <section class="mb-10">
        <h2 class="text-2xl font-bold mb-4">Ajouter un Événement ou Groupe</h2>
        <p class="mb-4">Vous souhaitez organiser un événement ou créer un groupe ? Remplissez le formulaire ci-dessous :</p>
        <form action="ajouter_evenement.php" method="POST" class="bg-white p-6 rounded-lg shadow">
            <div class="mb-4">
                <label for="titre" class="block text-gray-700">Titre de l'événement ou groupe</label>
                <input type="text" id="titre" name="titre" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700">Description</label>
                <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
            </div>
            <div class="mb-4">
                <label for="date" class="block text-gray-700">Date de l'événement</label>
                <input type="date" id="date" name="date" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Ajouter</button>
        </form>
    </section>
</div>