
  <div class="offers space-y-6">
  <?php if (!empty($offres)) : ?>
  <?php foreach ($offres as $offerId => $offre): ?>
    <div class="offer bg-gray-100 p-4 rounded shadow">
      <h3 class="text-lg font-bold"><?= $offre['item_offert'] ?></h3>
      <p class="text-gray-700"><?= $offre['description'] ?></p>
      <p class="text-sm text-gray-500">Proposé par : <?= $offre['email'] ?></p>
      <p class="text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($offre['date_creation'])) ?></p>
      
      <!-- Affichage des images -->
      <?php if (!empty($offre['images'])) : ?>
        <div class="images-grid grid grid-cols-2 md:grid-cols-3 gap-4 mt-4">
          <?php foreach ($offre['images'] as $image): ?>
            <img src="<?= htmlspecialchars($image) ?>" alt="Image de l'offre" class="rounded shadow w-full h-32 object-cover">
          <?php endforeach; ?>
        </div>
      <?php endif; ?>

      <div class="responses mt-4 space-y-3">
        <?php if (!empty($offre['responses'])) : ?>
          <?php foreach ($offre['responses'] as $responseId => $response): ?>
            <div class="response bg-white p-3 rounded shadow-sm">
              <p class="text-sm font-semibold text-gray-800">Réponse de: <?= $response['userReponder'] ?></p>
              <p class="text-sm text-gray-500"><?= date('d/m/Y H:i', strtotime($response['date'])) ?></p>
              <p class="text-gray-600"><?= $response['message'] ?></p>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <!-- Formulaire pour répondre à une offre -->
      <form action="repondre_echange" method="POST" class="reply-form mt-4">
        <input hidden name="offre" type="text" value="<?= $offre['id'] ?>">
        <textarea name="message" placeholder="Proposez votre article à échanger..." class="w-full border rounded p-2 text-gray-800"></textarea>
        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Proposer un échange</button>
      </form>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

    <!-- Section pour proposer un nouvel échange -->
    <form action="creer_echange" method="POST" class="new-offer bg-white p-4 rounded shadow mt-6">
      <input name="item_offert" class="w-full border-b p-2 mb-4 text-gray-800" type="text" placeholder="Article à échanger...">
      <input type="file" name="images[]" id="images" class="w-full p-2 border border-gray-300 rounded" multiple>
      <textarea name="description" placeholder="Description de l'article à échanger..." class="w-full border rounded p-2 text-gray-800"></textarea>
      <button type="submit" class="mt-3 bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Créer une offre</button>
    </form>
  </div>
