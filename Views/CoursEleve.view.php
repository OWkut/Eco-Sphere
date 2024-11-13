<style>
  .sidebar {
    background-color: #ff8f5e;
    /* couleur de fond du menu */
    border-radius: 8%;
    /* coins arrondis */
    border-right: 1px solid #dee2e6;
    /* bordure à droite */
    padding: 20px;
    /* espacement interne */
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.1);
    /* ombre légère */
    height: 100%;
    /* s'assure que la sidebar prend toute la hauteur */

  }

  .sidebar h4 {
    color: #3e3e3e;
    /* couleur du titre du menu */
    font-size: 1.5em;
    /* taille du texte */
    margin-bottom: 15px;
    /* espacement en bas */
    font-weight: bold;
    /* mettre en gras */
  }

  .nav-links {
    display: block;
    /* pour que chaque lien prenne toute la largeur */
    padding: 10px;
    /* espacement interne */
    border-radius: 5px;
    /* coins arrondis pour les liens */
    text-decoration: none;
    /* pas de soulignement */
    color: #3e3e3e;
    /* couleur du texte des liens */
    margin-bottom: 10px;
    /* espacement entre les liens */
    transition: background-color 0.3s, color 0.3s;
    /* transition pour les effets */
  }

  .nav-links:hover {
    background-color: #ffa45e;
    /* couleur de fond au survol */
    color: #ffffff;
    /* couleur du texte au survol */
  }

  .nav-links.active {
    background-color: #e78155;
    /* couleur de fond pour le lien actif */
    color: #ffffff;
    /* couleur du texte pour le lien actif */
  }

  /* Styles pour les liens PDF */
  .pdf-link {
    display: block;
    /* pour que les liens aient la forme de rectangles */
    background-color: #ff8f5e;
    /* couleur de fond des liens PDF */
    color: #3e3e3e;
    /* couleur du texte */
    padding: 15px 20px;
    /* espacement interne */
    border-radius: 5px;
    /* coins arrondis */
    text-decoration: none;
    /* pas de soulignement */
    text-align: center;
    margin: 10px 0;
    /* espacement vertical entre les liens */
    transition: background-color 0.3s, color 0.3s;
    /* transition pour les effets */
  }

  .pdf-link:hover {
    background-color: #ffa45e;
    /* couleur de fond au survol */
    color: #ffffff;
    /* couleur du texte au survol */
  }

  .pdf-link:active {
    background-color: #e78155;
    /* couleur de fond au clic */
    color: #ffffff;
    /* couleur du texte au clic */
  }

  .sidebar ul {
    margin-top: 0px;
  }

  .modal-header {
    background-color: #003366;
    /* Couleur de fond du header */
    color: white;
    /* Couleur du texte */
    border-bottom: 2px solid #0056b3;
    /* Bordure pour le header */
  }

  .question-section {
    background-color: #f8f9fa;
    /* Couleur de fond des questions */
    padding: 15px;
    border-radius: 5px;
    /* Coins arrondis */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    /* Ombre légère */
  }

  .form-check-input:checked {
    background-color: #007bff;
    /* Couleur pour les réponses sélectionnées */
    border-color: #007bff;
  }

  .pdf-link {
    text-decoration: none;
    color: inherit;
    display: flex;
    align-items: normal;
  }
</style>
<div class="container bootstrap snippets bootdeys" style="margin-top: 80px;">
  <div class="filter-container" id="filtre">
    <div class="row">
      <div class="col-md-4">
        <select id="categoryFilter" class="form-select">
          <option value="All">Toutes les catégories</option>
          <?php foreach ($matieres as $matieresId => $mat) : ?>
            <option value="<?= $mat['themeIntitule'] ?>"><?= $mat['themeIntitule'] ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-8">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher...">
      </div>
    </div>
  </div>
  <div class="row">
    <?php if (!empty($matieres)) : ?>
      <?php foreach ($matieres as $matieresId => $mat) : ?>
        <div class="col-md-4 col-sm-6 content-cards" id="themes<?= $matieresId ?>">
          <a class="card-link" onclick="allerMatiere('<?= $matieresId ?>')"
            data-id="<?= $matieresId ?>"
            data-matiere="<?= $mat['matiere'] ?>"
            data-description="<?= $mat['description'] ?>"
            data-theme="<?= $mat['themeIntitule'] ?>"
            style="display: block; text-decoration:none;">
            <div class="cards-big-shadow">
              <div class="cards cards-just-text" data-background="color" data-color="blue" data-radius="none">
                <div class="content">
                  <h6 class="category"><?= $mat['themeIntitule'] ?></h6>
                  <h4 class="title"><?= $mat['matiere'] ?></h4>
                  <p class="description"><?= $mat['description'] ?></p>
                </div>
              </div>
            </div>
          </a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <?php if (!empty($matieres)) : ?>
    <?php foreach ($matieres as $matieresId => $mat) : ?>
      <div class="container" id="matiere<?= $matieresId ?>" style="margin-top: 170px; margin-bottom: 50px; display: none;">
        <div class="row">
          <nav class="col-md-3 d-none d-md-block sidebar">
            <div class="sidebar-sticky">
              <h4><?= $mat['matiere'] ?></h4>
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-links pdf-link" href="#" onclick="showSection('pdf', <?= $matieresId ?>)">Voir PDFs</a>
                </li>
                <li class="nav-item">
                  <a class="nav-links video-link" href="#" onclick="showSection('video', <?= $matieresId ?>)">Voir vidéos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-links quiz-link" href="#" onclick="showSection('quiz', <?= $matieresId ?>)">Faire un quizz</a>
                </li>
                <li class="nav-item">
                  <a class="nav-links forum-link" href="#" onclick="showSection('forum', <?= $matieresId ?>)">Forum</a>
                </li>
                <li class="nav-item">
                  <button type="button" class="btn btn-danger" onclick="retour()">Retour</button>
                </li>
              </ul>
            </div>
          </nav>

          <div class="col-md-9">
            <div class="content-section" id="pdfSection<?= $matieresId ?>" style="display: none;">
              <h5>Fichiers PDF disponibles :</h5>
              <div class="pdf-list" style="max-width: 600px; margin-bottom: 20px;">
                <?php if (!empty($mat['contenu'])) : ?>
                  <?php foreach ($mat['contenu'] as $pdfName): ?>
                    <?php
                    $matchingPdf = array_filter($pdf, function ($pdfItem) use ($pdfName) {
                      return $pdfItem['name'] === $pdfName;
                    });
                    if (!empty($matchingPdf)) :
                      $matchingPdf = reset($matchingPdf);
                    ?>
                      <div class="pdf-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                        <a href="<?= $matchingPdf['link'] ?>" target="_blank" class="pdf-link" style="text-decoration: none; color: inherit;">
                          <div class="pdf-icon" style="display: inline-block; margin-right: 10px;">
                            <i class="fas fa-file-pdf fa-1x"></i>
                          </div>
                          <div class="pdf-name" style="display: inline-block; font-weight: bold;"><?= htmlspecialchars($matchingPdf['name']) ?></div>
                        </a>
                        <button class="btn btn-secondary" onclick="showPdf('<?= $matchingPdf['link'] ?>')">Voir le PDF</button>
                      </div>
                    <?php endif; ?>
                  <?php endforeach; ?>
                <?php else : ?>
                  <p>Aucun fichier PDF n'est disponible pour cette matière.</p>
                <?php endif; ?>
              </div>
            </div>
            <div id="pdfViewer" style="display:none; margin-top: 20px;">
              <h4>PDF affiché :</h4>
              <iframe id="pdfFrame" src="" width="100%" height="1000px" style="border: none;"></iframe>
              <button class="btn btn-danger" onclick="closePdf()">Fermer le PDF</button>
            </div>
            <div class="content-section" id="videoSection<?= $matieresId ?>" style="display: none;">
              <h5>Vidéos disponibles :</h5>
              <div class="video-list" style="max-width: 600px; margin-bottom: 20px;">
                <?php if (!empty($mat['video'])) : ?>
                  <?php foreach ($mat['video'] as $video): ?>
                    <div class="video-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                      <div class="video-name text-center" style="font-weight: bold;"><strong><?= htmlspecialchars($video['nom']) ?></strong></div>
                      <?php
                      preg_match("/(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/", $video['lien'], $matches);
                      $videoId = $matches[1] ?? null;
                      ?>
                      <?php if ($videoId): ?>
                        <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?= $videoId ?>" frameborder="0" allowfullscreen></iframe>
                      <?php else: ?>
                        <p>Impossible de lire la vidéo ici</p>
                      <?php endif; ?>
                      <a href="<?= htmlspecialchars($video['lien']) ?>" target="_blank" class="btn btn-secondary w-100">Voir la vidéo</a>
                    </div>
                  <?php endforeach; ?>
                <?php else : ?>
                  <p>Aucune vidéo disponible pour cette matière.</p>
                <?php endif; ?>
              </div>
            </div>
            <div class="content-section" id="forumSection<?= $matieresId ?>" style="display: none;">
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
            <div class="content-section" id="quizSection<?= $matieresId ?>" style="display: none;">
              <h5>Quiz disponibles :</h5>
              <div class="quiz-list" style="max-width: 600px; margin-bottom: 20px;">
                <?php if (!empty($mat['quizz'])) : ?>
                  <?php foreach ($mat['quizz'] as $quizzId => $quiz): ?>
                    <script>
                      const quiz<?= $quizzId ?> = <?= json_encode($quiz, JSON_HEX_QUOT | JSON_HEX_TAG | JSON_UNESCAPED_UNICODE) ?>;
                    </script>
                    <div class="quiz-item mb-3" style="border: 1px solid #ccc; padding: 15px; border-radius: 5px;">
                      <div class="quiz-name text-center" style="font-weight: bold;">
                        <strong><?= htmlspecialchars($quiz['titre']) ?></strong>
                      </div>
                      <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#quizModal<?= $quizzId ?>">Commencer le quiz</button>
                    </div>

                    <div class="modal fade" id="quizModal<?= $quizzId ?>" tabindex="-1" aria-labelledby="quizModalLabel<?= $quizzId ?>" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="quizModalLabel<?= $quizzId ?>"><?= htmlspecialchars($quiz['titre']) ?></h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div id="question-container<?= $quizzId ?>" class="mb-3">
                              <?php foreach ($quiz['questions'] as $index => $question): ?>
                                <div class="question-section mb-4" data-index="<?= $index ?>">
                                  <label for="question<?= $index ?><?= $quizzId ?>" class="form-label fw-bold">Question <?= $index + 1 ?>:</label>
                                  <p class="mb-3"><?= htmlspecialchars($question['texte']) ?></p>
                                  <div class="row">
                                    <?php foreach ($question['reponses'] as $i => $reponse): ?>
                                      <div class="col-6 mb-3 form-check">
                                        <input type="radio" class="form-check-input" id="response<?= $index ?><?= $quizzId ?>" name="questions[<?= $index ?>][response]" value="<?= $i ?>" required>
                                        <label class="form-check-label" for="response<?= $index ?><?= $quizzId ?>"><?= htmlspecialchars($reponse) ?></label>
                                      </div>
                                    <?php endforeach; ?>
                                  </div>
                                </div>
                              <?php endforeach; ?>
                            </div>
                          </div>
                          <div id="resultsContainer<?= $quizzId ?>" style="display: none;">
                            <h5>Résultats :</h5>
                            <div id="resultsMessage<?= $quizzId ?>" class="alert alert-info"></div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                            <button type="button" class="btn btn-primary" id="submitButton<?= $quizzId ?>" onclick="evaluateQuiz(quiz<?= $quizzId ?>, <?= $quizzId ?>)">Soumettre</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php else : ?>
                  <p>Aucun quiz disponible pour cette matière.</p>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
</div>
<?php endforeach; ?>
<?php endif; ?>
</div>

<script>
  function allerMatiere(id) {
    document.querySelectorAll('[id^="matiere"]').forEach(function(matiere) {
      matiere.style.display = 'none';
    });
    document.querySelectorAll('[id^="themes"]').forEach(function(theme) {
      theme.style.display = 'none';
    });
    document.getElementById('filtre').style.display = 'none';
    document.getElementById('matiere' + id).style.display = 'block';
  }

  function showSection(sectionType, matieresId) {
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => section.style.display = 'none');
    const sectionToShow = document.getElementById(sectionType + 'Section' + matieresId);
    sectionToShow.style.display = 'block';
  }

  function showPdf(pdfUrl) {
    var pdfViewer = document.getElementById('pdfViewer');
    var pdfFrame = document.getElementById('pdfFrame');
    pdfFrame.src = pdfUrl;
    pdfViewer.style.display = 'block';
  }

  function closePdf() {
    var pdfViewer = document.getElementById('pdfViewer');
    var pdfFrame = document.getElementById('pdfFrame');
    pdfFrame.src = '';
    pdfViewer.style.display = 'none';
  }

  function evaluateQuiz(quiz, quizId) {
    const questions = quiz.questions;
    const userResponses = {};
    questions.forEach((question, index) => {
      const userResponse = document.querySelector(`input[name="questions[${index}][response]"]:checked`);
      if (userResponse) {
        userResponses[index] = userResponse.value;
      }
    });
    let score = 0;
    questions.forEach((question, index) => {
      if (userResponses[index] === question.bonne_reponse.toString()) {
        score++;
      }
    });
    const totalQuestions = questions.length;
    const resultsMessage = `Vous avez obtenu ${score} sur ${totalQuestions}.`;
    document.getElementById('resultsContainer' + quizId).style.display = 'block';
    document.getElementById('resultsMessage' + quizId).innerText = resultsMessage;
    document.getElementById('question-container' + quizId).style.display = 'none';
    document.getElementById('submitButton' + quizId).style.display = 'none';
  }

  function retour() {
    document.querySelectorAll('[id^="themes"]').forEach(function(theme) {
      theme.style.display = 'block';
    });
    document.querySelectorAll('[id^="matiere"]').forEach(function(matiere) {
      matiere.style.display = 'none';
    });
    document.getElementById('filtre').style.display = 'block';
  }
</script>