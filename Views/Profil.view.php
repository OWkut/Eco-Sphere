<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-5 mt-10 border border-blue-300">
    <div class="p-4 bg-blue-300 text-gray-800">
        <h2 class="text-2xl font-bold text-center">Profil de <?php echo htmlspecialchars($user['prenom'] . ' ' . $user['nom']); ?></h2>
    </div>
    <div class="p-6 bg-gray-50 border-b border-blue-300">
        <div class="mb-4 flex items-center">
            <span class="material-icons text-blue-500 mr-2">email</span>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        </div>
        
        <div class="mb-4 flex items-center">
            <span class="material-icons text-blue-500 mr-2">phone</span>
            <p><strong>Téléphone :</strong> <?php echo htmlspecialchars($user['tel']); ?></p>
        </div>
        
        <div class="mb-4 flex items-center">
            <span class="material-icons text-blue-500 mr-2">account_circle</span>
            <p><strong>Rôle :</strong> <?php echo htmlspecialchars($user['role']); ?></p>
        </div>
    </div>
    <form action="modifier_info" method="POST" class="p-6">
        <input type="hidden" name="email" value="<?= $user['email'] ?>">
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="infos">Infos</label>
            <textarea name="infos" id="infos" rows="4" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-blue-200"><?= htmlspecialchars($user['infos']); ?></textarea>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-600">
            Sauvegarder les modifications
        </button>
    </form>
</div>