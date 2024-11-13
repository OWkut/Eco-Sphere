<h1 id="Titre" class="text-center py-4">Page de gestion des droits des utilisateurs</h1>

<div class="p-4 pt-2" style="background-color: rgba(0, 0, 0, 8%);">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>

                <tr>
                    <th class="fs-5" style="min-width: 100px; width: 20%;">Login</th>
                    <th class="fs-5" style="min-width: 200px; width: 40%;">Rôle</th>
                    <th class="fs-5" style="min-width: 150px; width: 20%;"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur) : ?>
                    <tr>
                        <th>
                            <?= $utilisateur['email'] ?>
                        </th>
                        <?php if ($utilisateur['role'] === "administrateur") : ?>
                            <td>
                                Administrateur
                            </td>
                            <td>
                            </td>
                        <?php else : ?>
                            <td>
                                <form action="modification_role" method="POST">
                                    <input type="hidden" name="email" value="<?= $utilisateur['email'] ?>" />
                                    <select name="role" class="form-select" onchange="confirm('confirmez vous la modification ?') ? submit() : document.location.reload()">
                                        <option value="Eleves" <?= $utilisateur['role'] === "Eleves" ? "selected" : "" ?>>Eleves</option>
                                        <option value="Profs" <?= $utilisateur['role'] === "Profs" ? "selected" : "" ?>>Profs</option>
                                        <option value="Admins" <?= $utilisateur['role'] === "Admins" ? "selected" : "" ?>>Admins</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <form action="supprimer_utilisateur" method="post">
                                    <input class="d-none" name="email" value="<?= $utilisateur['email'] ?>" />
                                    <input class="d-none" name="role" value="<?= $utilisateur['role'] ?>" />
                                    <button type="submit" class="btn btn-danger btn-sm"><span class="fa fa-remove"></span> Supprimer</button>
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>