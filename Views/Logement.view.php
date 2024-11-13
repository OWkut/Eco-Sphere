<?php 
if (isset($_POST['action'])) {
    $_SESSION['action'] = $_POST['action'];
}
if (!isset($_SESSION['action'])) {
    $_SESSION['action'] = 'rechercher';
}
?>

<div class="max-w-4xl mx-auto p-6">

<h1 class="text-3xl font-bold mb-6">Gestion des Annonces</h1>

<div class="flex space-x-4 mb-6">
    <form action="" method="POST">
        <button type="submit" name="action" value="ajouter" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Ajouter une annonce</button>
    </form>
    <form action="" method="POST">
        <button type="submit" name="action" value="rechercher" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Rechercher des annonces</button>
    </form>
</div>


<?php
if ($_SESSION['action'] == 'ajouter') {
    ?>
    <form action="ajouter_annonce" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8" enctype="multipart/form-data">
        <h2 class="text-2xl font-bold mb-4">Ajouter une annonce</h2>

        <div class="mb-4">
            <label for="titre" class="block text-gray-700">Titre de l'annonce</label>
            <input type="text" id="titre" name="titre" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="type_logement" class="block text-gray-700">Type de logement</label>
            <select name="type_logement" id="type_logement" class="w-full p-2 border border-gray-300 rounded" required>
                <option value="chambre">Chambre</option>
                <option value="studio">Studio</option>
                <option value="appartement">Appartement</option>
                <option value="residence_etudiante">Résidence étudiante</option>
                <option value="colocation">Colocation</option>
            </select>
        </div>
        <div class="mb-4">
            <label for="images" class="block text-gray-700">Images de l'annonce</label>
            <input type="file" name="images[]" id="images" class="w-full p-2 border border-gray-300 rounded" multiple>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
        </div>
        <div class="mb-4">
            <label for="prix" class="block text-gray-700">Prix</label>
            <input type="number" id="prix" name="prix" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="surface" class="block text-gray-700">Surface</label>
            <input type="text" name="surface" id="surface" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="proximite" class="block text-gray-700">Proximité</label>
            <input type="text" name="proximite" id="proximite" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="adresse" class="block text-gray-700">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="w-full p-2 border border-gray-300 rounded" required>
        </div>
        <div class="mb-4">
            <label for="ville" class="block text-gray-700">Ville</label>
            <input type="text" name="ville" id="ville" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white font-bold py-2 px-4 rounded hover:bg-blue-600">Ajouter l'annonce</button>
    </form>
    <?php
} else {
    ?>
    <form method="POST" action="logement" class="mb-8">
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-gray-700">Type de logement</label>
                <select name="type_logement" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Tous</option>
                    <option value="chambre">Chambre</option>
                    <option value="studio">Studio</option>
                    <option value="appartement">Appartement</option>
                    <option value="residence_etudiante">Résidence étudiante</option>
                    <option value="colocation">Colocation</option>
                </select>
            </div>
            <div>
                <label class="block text-gray-700">Prix maximum</label>
                <input type="number" name="prix_max" class="w-full p-2 border border-gray-300 rounded" placeholder="€">
            </div>
            <div>
                <label class="block text-gray-700">Ville</label>
                <input type="text" name="ville" class="w-full p-2 border border-gray-300 rounded" placeholder="Ville">
            </div>
        </div>
        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Rechercher</button>
    </form>
    <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">Toutes les annonces</h1>

    <?php if (count($annonces) > 0) : ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($annonces as $annonce) : ?>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <div class="p-4">
                        <h3 class="text-xl font-bold"><?php echo htmlspecialchars($annonce['titre']); ?></h3>
                        <p class="text-gray-700"><?php echo htmlspecialchars($annonce['type_logement']); ?></p>
                        <p class="text-gray-700"><?php echo htmlspecialchars($annonce['ville']); ?> - <?php echo htmlspecialchars($annonce['prix']); ?>€</p>
                        <p class="text-gray-500"><?php echo htmlspecialchars($annonce['description']); ?></p>
                        <p class="text-sm text-gray-500">Surface : <?php echo htmlspecialchars($annonce['surface']); ?> m²</p>
                        <p class="text-sm text-gray-500">Proximité : <?php echo htmlspecialchars($annonce['proximite']); ?></p>
                        <p class="text-sm text-gray-500">Publié le : <?php echo date('d/m/Y', strtotime($annonce['date_publication'])); ?></p>
                        <form action="plus_infos_logement" method="POST">
                            <input type="hidden" name="annonce_id" value="<?php echo $annonce['annonce_id']; ?>">
                            <button type="submit" class="mt-4 inline-block px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Voir plus</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>Aucune annonce disponible pour le moment.</p>
    <?php endif; ?>
</div>
  
    <?php
}
?>
</div>