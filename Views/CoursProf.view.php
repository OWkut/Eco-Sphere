<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar">
            <div class="position-sticky">
                <ul class="nav flex-column">
                    <?php if (!empty($matieres)) : ?>
                        <?php
                        $themesUniques = [];
                        foreach ($matieres as $mat) {
                            $themeIntitule = $mat['themeIntitule'];
                            if (!isset($themesUniques[$themeIntitule])) {
                                $themesUniques[$themeIntitule] = [];
                            }
                            $themesUniques[$themeIntitule][] = $mat;
                        }
                        ?>
                        <?php foreach ($themesUniques as $theme => $matieresAssociees) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#" onclick="showTheme('<?= htmlspecialchars($theme) ?>')">
                                    <?= htmlspecialchars($theme) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <li class="nav-item">
                            <p>Aucun thème disponible.</p>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <?php if (!empty($themesUniques)) : ?>
                <?php foreach ($themesUniques as $theme => $matieresAssociees) : ?>
                    <div class="theme-section" id="theme-<?= htmlspecialchars($theme) ?>" style="display: none;">
                        <h2>Thème : <span id="theme-title"><?= htmlspecialchars($theme) ?></span></h2>
                        <?php foreach ($matieresAssociees as $matId => $mat) : ?>
                            <p><?= $mat['description'] ?></p>
                            <h3>Matières liées au thème</h3>
                            <div class="content-section">
                                <h4><?= $mat['matiere'] ?></h4>

                                <?php if (!empty($mat['contenu'])) : ?>
                                    <h5>Fichiers PDF disponibles :</h5>
                                    <div class="pdf-list" style="max-width: 600px; margin-bottom: 20px;">
                                        <?php foreach ($mat['contenu'] as $pdfName): ?>
                                            <?php
                                            // Chercher dans $pdf la correspondance avec le fichier de contenu
                                            $matchingPdf = array_filter($pdf, function ($pdfItem) use ($pdfName) {
                                                return $pdfItem['name'] === $pdfName;
                                            });

                                            if (!empty($matchingPdf)) :
                                                $matchingPdf = reset($matchingPdf); // Prendre le premier élément
                                            ?>
                                                <div class="pdf-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                                                    <a href="<?= $matchingPdf['link'] ?>" target="_blank" class="pdf-link" style="text-decoration: none; color: inherit;">
                                                        <div class="pdf-icon" style="display: inline-block; margin-right: 10px;">
                                                            <i class="fas fa-file-pdf fa-1x"></i>
                                                        </div>
                                                        <div class="pdf-name" style="display: inline-block; font-weight: bold;"><?= $matchingPdf['name'] ?></div>
                                                    </a>
                                                    <button class="btn btn-secondary" onclick="showPdf('<?= $matchingPdf['link'] ?>')">Voir le PDF</button>
                                                    <form action="supprimer_pdf" method="POST" class="d-inline">
                                                        <input type="hidden" name="pdf_nom" value="<?= $matchingPdf['name'] ?>">
                                                        <input type="hidden" name="matiere" value="<?= $mat['matiere'] ?>">
                                                        <input type="hidden" name="theme" id="themeInputPdf">
                                                        <button type="button" class="btn btn-danger w-100" onclick="confirmDelete(this.form, '<?= $mat['themeIntitule'] ?>','pdf')">Supprimer le pdf</button>
                                                    </form>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <p>Aucun fichier PDF n'est disponible pour cette matière.</p>
                                <?php endif; ?>
                                <div id="pdfViewer" style="display:none; margin-top: 20px;">
                                    <h4>PDF affiché :</h4>
                                    <iframe id="pdfFrame" src="" width="100%" height="1000px" style="border: none;"></iframe>
                                    <button class="btn btn-danger" onclick="closePdf()">Fermer le PDF</button>
                                </div>
                                <script>
                                    function showPdf(pdfUrl) {
                                        var pdfViewer = document.getElementById('pdfViewer');
                                        var pdfFrame = document.getElementById('pdfFrame');
                                        pdfFrame.src = pdfUrl;
                                        pdfViewer.style.display = 'block';
                                    }

                                    function closePdf() {
                                        var pdfViewer = document.getElementById('pdfViewer');
                                        var pdfFrame = document.getElementById('pdfFrame');

                                        // Vider la source de l'iframe et cacher le div
                                        pdfFrame.src = '';
                                        pdfViewer.style.display = 'none';
                                    }

                                    function confirmDelete(form, themeTitle) {
                                        form.querySelector('input[name="theme"]').value = themeTitle;
                                        if (confirm("Êtes-vous sûr de vouloir supprimer ce PDF ?")) {
                                            form.submit();
                                        } else {
                                            return false;
                                        }
                                    }
                                </script>
                                <p>Gestion des fichiers PDF:</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pdfModal" onclick="setThemeTitle('<?= $mat['themeIntitule'] ?>','pdf')">Ajouter un fichier PDF</button>
                                <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="pdfUploadModalLabel">Télécharger un fichier PDF</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="ajouter_pdf" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="matiere" value="<?= $mat['matiere'] ?>">
                                                    <input type="hidden" name="theme" id="themeInputPdf">
                                                    <div class="mb-3">
                                                        <label for="pdfFile" class="form-label">Sélectionner un fichier PDF :</label>
                                                        <input type="file" class="form-control" id="pdfFile" name="pdfFile" accept=".pdf" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Télécharger</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5>Vidéos disponibles :</h5>
                                <div class="video-list" style="max-width: 600px; margin-bottom: 20px;">
                                    <?php if (!empty($mat['video'])) : ?>
                                        <?php foreach ($mat['video'] as $video): ?>
                                            <div class="video-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                                                <div class="video-name text-center" style="font-weight: bold;"><strong><?= $video['nom'] ?></strong></div>
                                                <?php
                                                // Extraire l'ID de la vidéo de l'URL YouTube
                                                preg_match("/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/", $video['lien'], $matches);
                                                $videoId = $matches[1] ?? null;
                                                ?>
                                                <?php if ($videoId): ?>
                                                    <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $videoId ?>" frameborder="0" allowfullscreen></iframe>
                                                <?php else: ?>
                                                    <p>Impossible de lire la vidéo ici</p>
                                                <?php endif; ?>

                                                <a href="<?= $video['lien'] ?>" target="_blank" class="btn btn-secondary w-100">Voir la vidéo</a>
                                                <form action="supprimer_video" method="POST" class="d-inline">
                                                    <input type="hidden" name="video_nom" value="<?= $video['nom'] ?>">
                                                    <input type="hidden" name="video_lien" value="<?= $video['lien'] ?>">
                                                    <input type="hidden" name="matiere" value="<?= $mat['matiere'] ?>">
                                                    <input type="hidden" name="theme" id="themeInputVideo">
                                                    <button type="button" class="btn btn-danger w-100" onclick="confirmDelete(this.form, '<?= $mat['themeIntitule'] ?>','video')">Supprimer la vidéo</button>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Aucune vidéo disponible pour cette matière.</p>
                                    <?php endif; ?>
                                </div>

                                <p>Gestion des vidéos:</p>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal" onclick="setThemeTitle('<?= $mat['themeIntitule'] ?>','video')">Ajouter une vidéo</button>
                                <div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="videoUploadModalLabel">Télécharger une vidéo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="ajouter_video" method="POST">
                                                    <input type="hidden" name="matiere" value="<?= $mat['matiere'] ?>">
                                                    <input type="hidden" name="theme" id="themeInputVideo">
                                                    <div class="mb-3">
                                                        <label for="video_lien" class="form-label">Lien de la vidéo :</label>
                                                        <input type="url" class="form-control" id="video_lien" name="video_lien" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="video_nom" class="form-label">Nom de la vidéo :</label>
                                                        <input type="text" class="form-control" id="video_nom" name="video_nom" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-success">Ajouter la vidéo</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h5>Quiz disponibles :</h5>
                                <div class="quiz-list" style="max-width: 600px; margin-bottom: 20px;">
                                    <?php if (!empty($mat['quizz'])) : ?>
                                        <?php foreach ($mat['quizz'] as $quizzId => $quiz): ?>
                                            <div class="quiz-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                                                <div class="quiz-name text-center" style="font-weight: bold;">
                                                    <strong><?= htmlspecialchars($quiz['titre']) ?></strong>
                                                </div>
                                                <button type="button" class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#editQuizModal<?= $quizzId ?>">Modifier le quiz</button>

                                                <!-- Modal de Modification du Quiz -->
                                                <div class="modal fade" id="editQuizModal<?= $quizzId ?>" tabindex="-1" aria-labelledby="editQuizModalLabel<?= $quizzId ?>" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editQuizModalLabel<?= $quizzId ?>">Modifier le Quiz</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="modifier_quizz" method="POST" id="editQuizForm<?= $quizzId ?>">
                                                                    <input type="hidden" name="matiere" value="<?= htmlspecialchars($mat['matiere']) ?>">
                                                                    <input type="hidden" name="theme" value="<?= htmlspecialchars($mat['themeIntitule']) ?>">
                                                                    <div class="mb-3">
                                                                        <label for="editQuizTitre<?= $quizzId ?>" class="form-label">Titre du quiz</label>
                                                                        <input type="text" class="form-control" id="editQuizTitre<?= $quizzId ?>" name="quiz_titre" placeholder="Titre du quiz" value="<?= htmlspecialchars($quiz['titre']) ?>" required>
                                                                    </div>

                                                                    <div id="editQuestion-container<?= $quizzId ?>" class="mb-3">
                                                                        <?php foreach ($quiz['questions'] as $index => $question): ?>
                                                                            <div class="question-section mb-3" data-index="<?= $index ?>">
                                                                                <label for="editQuestion<?= $index ?><?= $quizzId ?>" class="form-label">Question <?= $index + 1 ?>:</label>
                                                                                <input type="text" class="form-control" id="editQuestion<?= $index ?><?= $quizzId ?>" name="questions[<?= $index ?>][texte]" value="<?= htmlspecialchars($question['texte']) ?>" placeholder="Entrez la question" required>

                                                                                <div class="reponses mt-3">
                                                                                    <?php foreach ($question['reponses'] as $i => $reponse): ?>
                                                                                        <div class="row mb-2">
                                                                                            <div class="col-6">
                                                                                                <input type="text" class="form-control" name="questions[<?= $index ?>][reponses][]" value="<?= htmlspecialchars($reponse) ?>" placeholder="Réponse <?= $i + 1 ?>" required>
                                                                                            </div>
                                                                                            <div class="col-6 text-center">
                                                                                                <input type="radio" name="questions[<?= $index ?>][bonne_reponse]" value="<?= $i ?>" <?= $question['bonne_reponse'] == $i ? 'checked' : '' ?>> Correcte
                                                                                            </div>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                </div>

                                                                                <button type="button" class="btn btn-danger mt-2" onclick="removeQuestion(this)">Supprimer cette question</button>
                                                                            </div>
                                                                        <?php endforeach; ?>
                                                                    </div>

                                                                    <button type="button" class="btn btn-success mb-3" onclick="addQuestion(<?= $quizzId ?>)">Ajouter une question</button>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Formulaire de Suppression du Quiz -->
                                                <form action="supprimer_quizz" method="POST" class="d-inline">
                                                    <input type="hidden" name="matiere" value="<?= htmlspecialchars($mat['matiere']) ?>">
                                                    <input type="hidden" name="theme" value="<?= htmlspecialchars($mat['themeIntitule']) ?>">
                                                    <input type="hidden" name="quiz_id" value="<?= htmlspecialchars($quizzId) ?>">
                                                    <button type="button" class="btn btn-danger w-100" onclick="confirmDelete(this.form, '<?= htmlspecialchars($quiz['titre']) ?>', 'quizz')">Supprimer le quiz</button>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <p>Aucun quiz disponible pour cette matière.</p>
                                    <?php endif; ?>
                                </div>

                                <script>
                                    function addQuestion(quizzId) {
                                        const container = document.getElementById(`editQuestion-container${quizzId}`);
                                        const questionIndex = container.children.length; // Get current question count

                                        // Create a new question section
                                        const questionSection = document.createElement('div');
                                        questionSection.className = 'question-section mb-3';
                                        questionSection.setAttribute('data-index', questionIndex);

                                        // Create the question input
                                        questionSection.innerHTML = `
            <label for="editQuestion${questionIndex}${quizzId}" class="form-label">Question ${questionIndex + 1}:</label>
            <input type="text" class="form-control" id="editQuestion${questionIndex}${quizzId}" name="questions[${questionIndex}][texte]" placeholder="Entrez la question" required>
            <div class="reponses mt-3">
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" class="form-control" name="questions[${questionIndex}][reponses][]" placeholder="Réponse 1" required>
                    </div>
                    <div class="col-6 text-center">
                        <input type="radio" name="questions[${questionIndex}][bonne_reponse]" value="0"> Correcte
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" class="form-control" name="questions[${questionIndex}][reponses][]" placeholder="Réponse 2" required>
                    </div>
                    <div class="col-6 text-center">
                        <input type="radio" name="questions[${questionIndex}][bonne_reponse]" value="1"> Correcte
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" class="form-control" name="questions[${questionIndex}][reponses][]" placeholder="Réponse 3" required>
                    </div>
                    <div class="col-6 text-center">
                        <input type="radio" name="questions[${questionIndex}][bonne_reponse]" value="2"> Correcte
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <input type="text" class="form-control" name="questions[${questionIndex}][reponses][]" placeholder="Réponse 4" required>
                    </div>
                    <div class="col-6 text-center">
                        <input type="radio" name="questions[${questionIndex}][bonne_reponse]" value="3"> Correcte
                    </div>
                </div>
            </div>
        `;

                                        container.appendChild(questionSection);
                                    }

                                    function removeQuestion(button) {
                                        const questionSection = button.closest('.question-section');
                                        questionSection.remove();
                                    }

                                    function confirmDelete(form, title, type) {
                                        const confirmation = confirm(`Êtes-vous sûr de vouloir supprimer le ${type} "${title}" ?`);
                                        if (confirmation) {
                                            form.submit();
                                        }
                                    }
                                </script>

                                <p>Gestion des quiz:</p>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#quizModal" onclick="setThemeTitle('<?= $mat['themeIntitule'] ?>','quizz')">
                                    Créer un quiz
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="quizModal" tabindex="-1" aria-labelledby="quizModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="quizModalLabel">Créer un quiz</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Formulaire du modal pour créer un quiz -->
                                                <form action="ajouter_quizz" method="POST" id="quizForm">
                                                    <div class="mb-3">
                                                        <label for="quizTitre" class="form-label">Titre du quiz</label>
                                                        <input type="text" class="form-control" id="quizTitre" name="quiz_titre" placeholder="Titre du quiz" required>
                                                        <input type="hidden" name="matiere" value="<?= $mat['matiere'] ?>">
                                                        <input type="hidden" name="theme" id="themeInputQuizz">
                                                    </div>

                                                    <div id="question-container" class="mb-3">
                                                        <div class="question-section mb-3">
                                                            <label for="question1" class="form-label">Question 1:</label>
                                                            <input type="text" class="form-control" id="question1" name="questions[]" placeholder="Entrez la question" required>
                                                            <div class="reponses mt-3">
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <input type="text" class="form-control" name="reponses[0][]" placeholder="Réponse 1" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" name="bonne_reponse[0]" value="0" required> Correcte
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <input type="text" class="form-control" name="reponses[0][]" placeholder="Réponse 2" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" name="bonne_reponse[0]" value="1"> Correcte
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <input type="text" class="form-control" name="reponses[0][]" placeholder="Réponse 3" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" name="bonne_reponse[0]" value="2"> Correcte
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-2">
                                                                    <div class="col-6">
                                                                        <input type="text" class="form-control" name="reponses[0][]" placeholder="Réponse 4" required>
                                                                    </div>
                                                                    <div class="col-6">
                                                                        <input type="radio" name="bonne_reponse[0]" value="3"> Correcte
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Bouton pour ajouter une nouvelle question -->
                                                    <button class="btn btn-secondary" id="addQuestionBtn" type="button">Ajouter une question</button>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Enregistrer le quiz</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    let questionCount = 1;
                                    document.getElementById('addQuestionBtn').addEventListener('click', function() {
                                        const questionContainer = document.getElementById('question-container');
                                        const questionSection = document.createElement('div');
                                        questionSection.classList.add('question-section', 'mb-3');
                                        const questionId = `question${questionCount + 1}`;
                                        const answerName = `reponses[${questionCount}][]`;
                                        const correctAnswerName = `bonne_reponse[${questionCount}]`;

                                        questionSection.innerHTML = `
      <label for="${questionId}" class="form-label">Question ${questionCount + 1}:</label>
      <input type="text" class="form-control" id="${questionId}" name="questions[]" placeholder="Entrez la question" required>
      <div class="reponses mt-3">
        <div class="row mb-2">
          <div class="col-6">
            <input type="text" class="form-control" name="${answerName}" placeholder="Réponse 1" required>
          </div>
          <div class="col-6">
            <input type="radio" name="${correctAnswerName}" value="0" required> Correcte
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <input type="text" class="form-control" name="${answerName}" placeholder="Réponse 2" required>
          </div>
          <div class="col-6">
            <input type="radio" name="${correctAnswerName}" value="1"> Correcte
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <input type="text" class="form-control" name="${answerName}" placeholder="Réponse 3" required>
          </div>
          <div class="col-6">
            <input type="radio" name="${correctAnswerName}" value="2"> Correcte
          </div>
        </div>
        <div class="row mb-2">
          <div class="col-6">
            <input type="text" class="form-control" name="${answerName}" placeholder="Réponse 4" required>
          </div>
          <div class="col-6">
            <input type="radio" name="${correctAnswerName}" value="3"> Correcte
          </div>
        </div>
      </div>
    `;
                                        questionContainer.appendChild(questionSection);
                                        questionCount++;
                                    });
                                </script>
                            </div>
                            <h5>Forum :</h5>
                            <div class="content-section" id="forumSection<?= $matId ?>">
                                <div class="questions">
                                    <?php if (!empty($mat['forum'])) : ?>
                                        <?php foreach ($mat['forum'] as $forumId => $forum): ?>
                                            <div class="question">
                                                <h3><?= $forum['titre'] ?></h3>
                                                <p><?= $forum['question'] ?></p>
                                                <p>De : <?= $forum['mecQuiPoseLaQuestion'] ?></p>
                                                <div class="replies">
                                                    <?php if (!empty($forum['reponse'])) : ?>
                                                        <?php foreach ($forum['reponse'] as $forumReponseId => $forumReponse): ?>
                                                            <div class="reply">
                                                                <p>De: <?= $forumReponse['mecQuiRepond'] ?></p>
                                                                <p><?= $forumReponse['reponse'] ?></p>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <!-- Formulaire pour répondre à la question -->
                                                <form action="repondre_forum" method="POST" class="reply-form">
                                                    <input hidden name="titre" type="text" value="<?= $forum['titre'] ?>">
                                                    <input hidden name="matiere" type="text" value="<?= $mat['matiere'] ?>">
                                                    <input hidden name="theme" type="text" value="<?= $mat['themeIntitule'] ?>">
                                                    <textarea name="reponse" placeholder="Écrire une réponse..."></textarea>
                                                    <button type="submit" class="reply-button">Répondre</button>
                                                </form>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Section pour poser une nouvelle question -->
                                    <form action="creer_forum" method="POST" class="new-question pt-3">
                                        <input name="titre" class="mb-2" type="text" placeholder="Sujet de la question...">
                                        <input hidden name="matiere" type="text" value="<?= $mat['matiere'] ?>">
                                        <input hidden name="theme" type="text" value="<?= $mat['themeIntitule'] ?>">
                                        <textarea name="question" placeholder="Poser une nouvelle question..."></textarea>
                                        <button type="submit" class="question-button">Poser la question</button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <h2>Aucun thème ou matière disponible.</h2>
            <?php endif; ?>
        </main>
    </div>
</div>



<script>
    function showTheme(index) {
        const themes = document.querySelectorAll('.theme-section');
        themes.forEach(function(theme) {
            theme.style.display = 'none';
        });
        const selectedTheme = document.getElementById('theme-' + index);
        if (selectedTheme) {
            selectedTheme.style.display = 'block';
        }
    }

    function setThemeTitle(themeTitle, type) {
        if (type === 'pdf') {
            document.getElementById('themeInputPdf').value = themeTitle;
        } else if (type === 'video') {
            document.getElementById('themeInputVideo').value = themeTitle;
        } else if (type === 'quizz') {
            document.getElementById('themeInputQuizz').value = themeTitle;
        }
    }
</script>