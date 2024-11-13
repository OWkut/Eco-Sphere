<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6"><?php echo htmlspecialchars($annonce[0]['titre']); ?></h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-4">
        <?php foreach ($annonce as $image) : ?>
            <div class="w-full h-64 bg-gray-200">
                <img src="<?=  $image['image_chemin'] ?>" alt="Image de l'annonce" class="w-full h-full object-cover">
            </div>
        <?php endforeach; ?>
    </div>
    <p class="text-lg font-semibold"><?php echo htmlspecialchars($annonce[0]['type_logement']); ?> à <?php echo htmlspecialchars($annonce[0]['ville']); ?></p>
    <p class="text-xl text-gray-700"><?php echo htmlspecialchars($annonce[0]['prix']); ?>€</p>
    <p class="text-gray-500 mt-4"><?php echo nl2br(htmlspecialchars($annonce[0]['description'])); ?></p>
    <p class="text-sm text-gray-500 mt-4">Surface : <?php echo htmlspecialchars($annonce[0]['surface']); ?> m²</p>
    <p class="text-sm text-gray-500">Proximité : <?php echo htmlspecialchars($annonce[0]['proximite']); ?></p>
    <p class="text-sm text-gray-500">Publié le : <?php echo date('d/m/Y', strtotime($annonce[0]['date_publication'])); ?></p>
    <div class="mt-6 bg-gray-100 p-4 rounded-lg">
        <h2 class="text-xl font-semibold text-gray-800">Contact</h2>
        <p class="text-lg text-gray-800 font-semibold">Propriétaire : <?php echo htmlspecialchars($annonce[0]['prenom'] . ' ' . $annonce[0]['nom']); ?></p>
        <p class="text-sm text-gray-600">Email : <a href="mailto:<?php echo htmlspecialchars($annonce[0]['email']); ?>" class="text-blue-500"><?php echo htmlspecialchars($annonce[0]['email']); ?></a></p>
        <p class="text-sm text-gray-600">Téléphone : <a href="tel:<?php echo htmlspecialchars($annonce[0]['tel']); ?>" class="text-blue-500"><?php echo htmlspecialchars($annonce[0]['tel']); ?></a></p>
    </div>
</div>