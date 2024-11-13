<!-- Inscription Section -->
<section class="min-h-screen bg-gray-100 flex items-center justify-center mt-16">
    <div class="container max-w-md mx-auto bg-white shadow-lg rounded-lg p-8">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">S'inscrire</h2>

        <form action="validation_inscription" method="POST" onsubmit="return encryptPassword();" class="space-y-6">

            <!-- Email Input -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Adresse mail</label>
                <input type="email" name="email" id="email" placeholder="Entrez votre adresse mail" required
                    class="w-full mt-2 px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Password Input -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <div class="relative mt-2">
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required
                        class="w-full px-4 py-2 bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                        <i id="eyeIcon" class="fa-solid fa-eye-slash"></i>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button type="submit" name="creer_compte" 
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700">
                Créer un compte
            </button>
        </form>
    </div>
</section>

<!-- Password Toggle Script -->
<script>
    const password = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', () => {
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
