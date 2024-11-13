<h1 class="text-5xl text-center py-8 font-extrabold text-gray-900">Gestion des droits des utilisateurs</h1>

<div class="max-w-7xl mx-auto p-6 bg-white shadow-2xl rounded-2xl">
    <div class="overflow-x-auto bg-white rounded-2xl shadow-lg">
        <table class="min-w-full table-auto mx-auto text-gray-600">
            <thead>
                <tr class="bg-gray-100 text-gray-700">
                    <th class="px-6 py-4 text-left text-lg font-semibold text-indigo-600">Login</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold text-indigo-600">Role</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold text-indigo-600">Supprimer</th>
                    <th class="px-6 py-4 text-left text-lg font-semibold text-indigo-600"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($utilisateurs as $utilisateur) : ?>
                    <tr class="border-t hover:bg-gray-50 transition duration-300">
                        <td class="px-6 py-4 text-lg font-medium"><?= $utilisateur['email'] ?></td>
                        <?php if($utilisateur['role'] === "Admin") :?>
                            <td class="px-6 py-4 text-lg text-green-600">Administrateur</td>
                            <td class="px-6 py-4"></td>
                        <?php else : ?>
                            <td class="px-6 py-4">
                                <form action="<?= URL ?>validation_modificationRole" method="POST" class="inline">
                                    <input type="hidden" name="email" value="<?= $utilisateur['email'] ?>" />
                                    <select name="rol" class="form-select bg-white border border-gray-300 rounded-lg py-2 px-5 text-lg focus:ring-2 focus:ring-blue-500 hover:bg-indigo-50 transition duration-300" onchange="confirm('Confirmez-vous la modification ?') ? submit() : document.location.reload()">
                                        <option value="Utilisateurs" <?= $utilisateur['role'] === "Utilisateurs" ? "selected" : ""?>>Utilisateur</option>
                                        <option value="Admin" <?= $utilisateur['role'] === "Admin" ? "selected" : ""?>>Administrateur</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-6 py-4">
                                <form action="supprimer_utilisateur" method="post" class="inline">
                                    <input type="hidden" name="email" value="<?= $utilisateur['email'] ?>" />
                                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition duration-300 text-lg font-semibold">
    <span class="fa fa-remove"></span> Supprimer
</button>


                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
