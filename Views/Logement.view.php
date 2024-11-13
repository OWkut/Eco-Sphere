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
    <form action="ajouter_annonce.php" method="POST" class="bg-white p-6 rounded-lg shadow-md mb-8">
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
            <label for="prix" class="block text-gray-700">Prix</label>
            <input type="number" id="prix" name="prix" class="w-full p-2 border border-gray-300 rounded" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" class="w-full p-2 border border-gray-300 rounded" required></textarea>
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
    <form method="GET" action="" class="mb-8">
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

  
    <?php
}
?>
</div>