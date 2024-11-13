<h1 id="Titre" class="text-center py-4">Page de gestion des thèmes</h1>
<div class="p-4 pt-2" style="background-color: rgba(0, 0, 0, 8%);">
    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th class="fs-5" style="min-width: 100px; width: 20%;">Intitulé</th>
                    <th class="fs-5" style="min-width: 200px; width: 40%;">Description</th>
                    <th class="fs-5" style="min-width: 150px; width: 20%;">Matières et Profs</th>
                    <th class="fs-5" style="min-width: 150px; width: 20%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($themes as $id => $theme) : ?>
                    <tr>
                        <th>
                            <?= htmlspecialchars($theme['intitule']) ?>
                        </th>
                        <td>
                            <?= htmlspecialchars($theme['description']) ?>
                        </td>
                        <td>
                            <?php if (!empty($theme['Matieres']) && is_array($theme['Matieres'])) : ?>
                                <ul>
                                    <?php foreach ($theme['Matieres'] as $matiere) : ?>
                                        <li>
                                            <strong><?= htmlspecialchars($matiere['intitule']) ?></strong>
                                            <ul>
                                                <?php if (!empty($matiere['Profs']) && is_array($matiere['Profs'])) : ?>
                                                    <?php foreach ($matiere['Profs'] as $prof) : ?>
                                                        <li><?= htmlspecialchars($prof) ?></li>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <li><em>Aucun prof associé</em></li>
                                                <?php endif; ?>
                                            </ul>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else : ?>
                                <em>Aucune matière</em>
                            <?php endif; ?>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#modalModifier<?= $id ?>">
                                Modifier
                            </button>
                            <form method="POST" action="supprimer_theme" id="formSupprimer<?= $id ?>" style="display:none;">
                                <input type="hidden" name="intitule" value="<?= htmlspecialchars($theme['intitule']) ?>">
                            </form>

                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmerSuppression(<?= $id ?>)">Supprimer</button>

                            <script>
                                function confirmerSuppression(id) {
                                    if (confirm("Êtes-vous sûr de vouloir supprimer ce thème ?")) {
                                        document.getElementById('formSupprimer' + id).submit();
                                    }
                                }
                            </script>
                        </td>
                    </tr>

                    <div class="modal fade" id="modalModifier<?= $id ?>" tabindex="-1" aria-labelledby="modalModifierLabel<?= $id ?>" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalModifierLabel<?= $id ?>">Modifier le thème : <?= htmlspecialchars($theme['intitule']) ?></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" id="formPrincipal" action="validation_modifier_theme">
                                        <div class="mb-3">
                                            <input type="hidden" name="intitule_actuel" value="<?= htmlspecialchars($theme['intitule']) ?>">
                                            <label for="intitule<?= $id ?>" class="form-label">Intitulé</label>
                                            <input type="text" class="form-control" id="intitule<?= $id ?>" name="nouvel_intitule" value="<?= htmlspecialchars($theme['intitule']) ?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description<?= $id ?>" class="form-label">Description</label>
                                            <textarea class="form-control" id="description<?= $id ?>" name="description" required><?= htmlspecialchars($theme['description']) ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Matières existantes et Profs</label>
                                            <div id="matieresExistantesContainer<?= $id ?>">
                                                <?php if (isset($theme['Matieres']) && !empty($theme['Matieres'])) : ?>
                                                    <?php foreach ($theme['Matieres'] as $matiereIndex => $matiere) : ?>
                                                        <div class="matiere-block mb-3" id="matiereExistanteBlock<?= $matiereIndex ?>">
                                                            <label class="form-label">Matière</label>
                                                            <input type="text" class="form-control mb-2" name="matieres[<?= $matiereIndex ?>][intitule]" value="<?= htmlspecialchars($matiere['intitule']) ?>" required>

                                                            <label class="form-label">Professeurs</label>
                                                            <div class="mb-2">
                                                                <?php foreach ($profs as $prof) : ?>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox" name="matieres[<?= $matiereIndex ?>][Profs][]" value="<?= htmlspecialchars($prof['email']) ?>"
                                                                            <?php if (isset($matiere['Profs']) && is_array($matiere['Profs']) && in_array($prof['email'], $matiere['Profs'])) echo 'checked'; ?>>
                                                                        <label class="form-check-label"><?= htmlspecialchars($prof['email']) ?></label>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            </div>

                                                            <button type="button" class="btn btn-danger btn-sm" onclick="supprimerMatiereExistante('<?= $matiereIndex ?>', '<?= htmlspecialchars($matiere['intitule']) ?>')">Supprimer cette matière</button>


                                                        </div>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Ajouter de nouvelles matières</label>
                                            <div id="nouvelleMatieresContainer<?= $id ?>"></div>
                                            <button type="button" class="btn btn-success btn-sm" onclick="ajouterMatiere('<?= $id ?>')">Ajouter une matière</button>
                                        </div>

                                        <button type="submit" class="btn btn-success" onclick="prepareFormSubmission('<?= $id ?>')">Enregistrer les modifications</button>
                                    </form>

                                    <script>
                                        let nouvellesMatieresData = [];
                                        let matieresASupprimer = [];

                                        function ajouterMatiere(themeId) {
                                            const container = document.getElementById(`nouvelleMatieresContainer${themeId}`);
                                            const currentIndex = container.children.length;
                                            const newMatiereBlock = document.createElement('div');
                                            newMatiereBlock.classList.add('matiere-block', 'mb-3');
                                            newMatiereBlock.innerHTML = `
                            <label class="form-label">Matière</label>
                            <input type="text" class="form-control mb-2" name="matieres_nouvelles[${currentIndex}][intitule]" required>
                            
                            <label class="form-label">Professeurs</label>
                            <div class="mb-2">
                                <?php foreach ($profs as $prof) : ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="matieres_nouvelles[${currentIndex}][Profs][]" value="<?= htmlspecialchars($prof['email']) ?>">
                                        <label class="form-check-label"><?= htmlspecialchars($prof['email']) ?></label>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        `;
                                            container.appendChild(newMatiereBlock);
                                            nouvellesMatieresData.push({
                                                intitule: '',
                                                Profs: []
                                            });
                                        }

                                        function supprimerMatiereExistante(matiereIndex, matiereIntitule) {
                                            const matiereBlock = document.getElementById(`matiereExistanteBlock${matiereIndex}`);
                                            matiereBlock.style.display = 'none';
                                            matieresASupprimer.push(matiereIntitule);
                                        }

                                        function prepareFormSubmission(themeId) {
                                            const nouvellesMatieresContainer = document.getElementById(`nouvelleMatieresContainer${themeId}`);
                                            const nouvellesMatieres = nouvellesMatieresContainer.querySelectorAll('.matiere-block');
                                            nouvellesMatieres.forEach((matiereBlock, index) => {
                                                const intituleInput = matiereBlock.querySelector('input[name^="matieres_nouvelles"][name*="[intitule]"]');
                                                const profInputs = matiereBlock.querySelectorAll('input[name^="matieres_nouvelles"][name*="[Profs][]"]');

                                                nouvellesMatieresData[index].intitule = intituleInput.value;
                                                nouvellesMatieresData[index].Profs = Array.from(profInputs).filter(input => input.checked).map(input => input.value);
                                            });
                                            const nouvellesMatieresInput = document.createElement('input');
                                            nouvellesMatieresInput.type = 'hidden';
                                            nouvellesMatieresInput.name = 'matieres_nouvelles_data';
                                            nouvellesMatieresInput.value = JSON.stringify(nouvellesMatieresData);
                                            document.getElementById('formPrincipal').appendChild(nouvellesMatieresInput);
                                            const matieresSupprimerInput = document.createElement('input');
                                            matieresSupprimerInput.type = 'hidden';
                                            matieresSupprimerInput.name = 'matieres_a_supprimer';
                                            matieresSupprimerInput.value = JSON.stringify(matieresASupprimer);
                                            document.getElementById('formPrincipal').appendChild(matieresSupprimerInput);
                                        }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-end">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAjouterTheme">
            Ajouter un thème
        </button>
    </div>
    <div class="modal fade" id="modalAjouterTheme" tabindex="-1" aria-labelledby="modalAjouterThemeLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAjouterThemeLabel">Ajouter un nouveau thème</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="AjouterTheme" action="ajouter_theme">
                        <div class="mb-3">
                            <label for="nouvelIntitule" class="form-label">Intitulé</label>
                            <input type="text" class="form-control" id="nouvelIntitule" name="intitule" required>
                        </div>
                        <div class="mb-3">
                            <label for="nouvelleDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="nouvelleDescription" name="description" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Ajouter des matières</label>
                            <div id="nouvelleMatieresContainer"></div>
                            <button type="button" class="btn btn-success btn-sm" onclick="ajouterMatiere('')">Ajouter une matière</button>
                        </div>

                        <button type="submit" class="btn btn-primary" onclick="prepareFormSubmission('formAjouterTheme', 'nouvelleMatieresContainerAjouter')">Enregistrer le thème</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>