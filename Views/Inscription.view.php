<!-- Inscription Section -->
<section class="min-vh-100" style="background-color: #f4f5f7; margin-top: 70px;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow-2-strong" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">

                        <!-- Logo -->
                        <img src="Public/assets/images/logo.png" alt="logo" width="100" class="mb-4">
                        <h3 class="mb-3">S'inscrire</h3>

                        <form action="validation_inscription" method="POST" onsubmit="return encryptPassword();">
                            <button class="btn btn-lg btn-block btn-light text-muted" type="button">
                                <img src="Public/assets/images/Google.png" alt="logoGoogle" width="30"> Créer un compte avec Google
                            </button>
                            <hr class="my-4">

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="email">Adresse mail</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Entrez votre adresse mail" required />
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <label class="form-label" for="password">Mot de passe</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Entrez votre mot de passe" required />
                                    <button class="btn" type="button" id="togglePassword">
                                        <i class="fa-solid fa-eye-slash" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            <script>
                                const password = document.getElementById('password');
                                const togglePassword = document.getElementById('togglePassword');
                                const eyeIcon = document.getElementById('eyeIcon');
                                togglePassword.addEventListener('click', function() {
                                    const isPasswordHidden = password.type === 'password';
                                    password.type = isPasswordHidden ? 'text' : 'password';
                                    eyeIcon.classList.toggle('fa-eye-slash');
                                    eyeIcon.classList.toggle('fa-eye');
                                });
                                function encryptPassword() {
                                    const passwordField = document.getElementById('password');
                                    const hashedPassword = CryptoJS.SHA256(passwordField.value).toString();
                                    passwordField.value = hashedPassword;
                                    return true; 
                                }
                            </script>

                            <!-- Submit button -->
                            <button class="btn btn-primary btn-lg btn-block" type="submit" name="creer_compte">Créer un compte</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>