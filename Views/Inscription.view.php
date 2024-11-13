<!-- Inscription Section -->
<section class="min-h-screen bg-gray-100 pt-16">
<div class="container mx-auto px-4 py-10">
    <div class="flex justify-center items-center min-h-full">
      <div class="w-full max-w-md">
        <div class="bg-white shadow-lg rounded-lg p-8">
          <h3 class="text-2xl font-semibold text-center mb-4">S'inscrire</h3>

          <form action="validation_inscription" method="post" onsubmit="return encryptPassword();">
            
            <hr class="my-6 border-gray-300">
            
            <!-- Email input -->
            <div class="mb-4">
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse mail</label>
              <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Entrez votre adresse mail" required />
            </div>

            <!-- Password input -->
            <div class="mb-4">
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
              <div class="relative">
                <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Entrez votre mot de passe" required />
                <button type="button" id="togglePassword" class="absolute inset-y-0 right-3 flex items-center text-gray-500">
                  <i class="fa-solid fa-eye-slash" id="eyeIcon"></i>
                </button>
              </div>
            </div>

            <!-- Submit button -->
            <button class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition" type="submit">S'inscrire</button>
          </form>
        </div>
      </div>
    </div>
  </div>>
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
