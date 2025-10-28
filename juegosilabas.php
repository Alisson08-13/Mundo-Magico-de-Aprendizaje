<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silabario Mágico | ¡A Jugar!</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <style>
        /* (Todos los estilos CSS se mantienen) */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;900&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .main-container {
            background: linear-gradient(145deg, #ffffff, #f0f4f8);
        }
        .syllable-button, .option-button {
            transition: all 0.15s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
            box-shadow: 0 6px 0 0 #0000004d;
            user-select: none;
            -webkit-tap-highlight-color: transparent;
            position: relative;
            overflow: hidden;
        }
        .syllable-button::before, .option-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 75%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.4),
                transparent
            );
            transform: skewX(-25deg);
            transition: left 0.6s ease;
        }
        .syllable-button:hover::before, .option-button:hover::before {
            left: 150%;
        }
        .syllable-button:active, .option-button:active {
            transform: translateY(4px) scale(0.98);
            box-shadow: 0 2px 0 0 #0000004d;
        }
        .word-segment {
            font-size: 2.5rem;
            font-weight: 900;
            color: #1e40af;
            background: #dbeafe;
            padding: 0.5rem 1rem;
            border-radius: 1rem;
            margin: 0 0.25rem;
            min-width: 5rem;
            text-align: center;
            border: 3px dashed #60a5fa;
            transition: background 0.3s, transform 0.3s;
        }
        .missing-syllable {
            color: #e5e7eb;
            background: #4b5563;
            border: 3px dashed #fcd34d;
            animation: pulse-placeholder 1.5s infinite;
        }
        @keyframes pulse-placeholder {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
            z-index: 60;
        }
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f0f;
            opacity: 0;
            transform-origin: 50% 50%;
        }
        @keyframes fall {
            0% {
                opacity: 0;
                transform: translate(0, -100px) rotate(0deg);
            }
            10% { opacity: 1; }
            100% {
                transform: translate(0, 100vh) rotate(720deg);
                opacity: 0;
            }
        }
        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -10;
        }
         .navigation-buttons {
  display: flex; gap: 20px; justify-content: center;
   margin-top: 2rem; flex-wrap: wrap; z-index: 10;
        }
        .btn-childish {
            font-family: 'Fredoka One', cursive; font-size: 1.5em; font-weight: bold;
            border: none; border-radius: 15px; padding: 1.2rem 2.5rem;
            transition: all 0.2s ease-out; cursor: pointer; user-select: none;
            text-decoration: none; color: #FFFFFF;
            box-shadow: 0 8px 0 0 rgba(0,0,0,0.3); position: relative; top: 0;
            display: inline-flex; align-items: center; justify-content: center; gap: 15px;
        }
        .btn-childish:hover { transform: translateY(-5px); box-shadow: 0 12px 0 0 rgba(0,0,0,0.3); }
        .btn-childish:active { transform: translateY(3px); box-shadow: 0 2px 0 0 rgba(0,0,0,0.3); }

        .btn-menu {
             background: linear-gradient(135deg, #98D8AA, #6EAF8D);
             border: 3px solid #5A8F73;
        }
        .btn-childish img { height: 1.5em; width: auto; display: block; border-radius: 8px; }
        .btn-childish span { display: block; }
    </style>
    <script type="module">
        // (El código de Firebase se mantiene igual)
        import { initializeApp } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-app.js";
        import { getAuth, signInAnonymously, signInWithCustomToken } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-auth.js";
        import { getFirestore } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";
        import { setLogLevel } from "https://www.gstatic.com/firebasejs/11.6.1/firebase-firestore.js";

        const appId = typeof __app_id !== 'undefined' ? __app_id : 'default-app-id';
        const firebaseConfig = typeof __firebase_config !== 'undefined' ? JSON.parse(__firebase_config) : {};
        const initialAuthToken = typeof __initial_auth_token !== 'undefined' ? __initial_auth_token : null;

        if (Object.keys(firebaseConfig).length > 0) {
            setLogLevel('Debug');
            window.app = initializeApp(firebaseConfig);
            window.db = getFirestore(window.app);
            window.auth = getAuth(window.app);

            async function authenticate() {
                try {
                    if (initialAuthToken) {
                        await signInWithCustomToken(window.auth, initialAuthToken);
                    } else {
                        await signInAnonymously(window.auth);
                    }
                    console.log("Firebase Auth successful. User ID:", window.auth.currentUser.uid);
                } catch (error) {
                    console.error("Firebase authentication error:", error);
                }
            }

            authenticate();
        } else {
            console.warn("Firebase configuration not found. Firestore features are disabled.");
        }
    </script>
</head>
<body class="min-h-screen p-4 sm:p-8">

    <button id="enable-sound"
        class="fixed bottom-6 right-6 z-50 bg-yellow-400 hover:bg-yellow-500 text-gray-900 font-bold px-6 py-3 rounded-full shadow-xl border-2 border-yellow-600 animate-bounce">
        🔊 Activar Sonido
    </button>
    <div id="confetti-container" class="confetti-container hidden"></div>

    <audio id="sonido-correcto" src="https://cdn.pixabay.com/audio/2022/03/15/audio_166d73e21a.mp3"></audio>
    <audio id="sonido-incorrecto" src="https://cdn.pixabay.com/audio/2022/03/10/audio_c8c8a67930.mp3"></audio>
    <audio id="sonido-victoria" src="https://cdn.pixabay.com/audio/2022/11/20/audio_161208119c.mp3"></audio>

    <canvas id="bg-canvas"></canvas>

    <div class="w-full max-w-5xl main-container p-6 sm:p-10 rounded-3xl shadow-2xl z-10 border-4 border-white">

        <h1 class="text-4xl sm:text-5xl font-black text-center text-red-500 mb-8 border-b-4 border-orange-400 pb-3">
            🧠 Silabario Mágico - ¡A Jugar! 🧩
        </h1>

        <section class="p-6 sm:p-8 bg-purple-100 rounded-2xl border-4 border-purple-500 shadow-xl">
            <h2 class="text-3xl font-extrabold text-purple-700 mb-6 text-center">
                ✏️ ¡A Jugar con las Palabras!
            </h2>

            <div class="mb-6 p-4 bg-white rounded-xl shadow-lg flex justify-center">
                <p class="text-xl font-bold text-gray-700">
                    ¡Completa 5 para ganar! Llevas
                    <span id="correct-count" class="text-green-600 text-3xl font-black mx-1">0</span>/5.
                    <span id="streak-indicator" class="text-yellow-500 ml-2"></span>
                </p>
            </div>

            <div id="activity-area" class="flex flex-col items-center justify-center min-h-[300px]">
                <div class="text-center mb-8">
                    <div id="word-image-container" class="w-40 h-40 bg-gray-200 rounded-xl mb-4 flex items-center justify-center text-4xl font-bold text-gray-600 border-4 border-white shadow-lg overflow-hidden">
                    </div>
                    <p class="text-xl font-semibold text-gray-600">Completa la palabra:</p>
                </div>

                <div id="current-word" class="flex items-center justify-center mb-10">
                </div>

                <div id="options-container" class="flex flex-wrap justify-center gap-4 sm:space-x-8">
                </div>
            </div>

            <div id="feedback-message" class="mt-6 text-center text-2xl font-bold min-h-[40px]">
            </div>
        </section>

        <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
            <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-sm border-4 border-purple-500 transition duration-300">
                <h3 id="modal-title" class="text-3xl font-black mb-4 text-purple-700">¡Súper!</h3>
                <p id="modal-text" class="text-xl text-gray-600 mb-6">¡Lo hiciste genial!</p>
                <div class="flex flex-col space-y-3">
                    <button id="modal-continue-button" onclick="closeModal()" class="px-6 py-3 bg-green-500 text-white font-bold rounded-xl shadow-lg hover:bg-green-600 transition duration-150">
                        Continuar Jugando
                    </button>
                    <button id="modal-restart-button" onclick="restartGame()" class="px-6 py-3 bg-yellow-500 text-gray-800 font-bold rounded-xl shadow-lg hover:bg-yellow-600 transition duration-150 hidden">
                        Volver a Jugar 🎉
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        // --- 1. CONFIGURACIÓN GLOBAL Y UTILIDADES ---

        let audioEnabled = false;
        let audioContextInitialized = false; // <-- VARIABLE AÑADIDA

        let currentActivityIndex = 0;
        let correctAnswersCount = 0;
        const GOAL_COUNT = 5;
        let correctStreakCount = 0; // Contador de racha

        const activities = [
            // (La lista de actividades se mantiene igual)
            { id: 13, word: 'ANILLO', syllables: ['A', 'NI', 'LLO'], missingIndex: 0, options: ['A', 'E'], image: 'https://i.pinimg.com/736x/9d/f2/39/9df239374dc3255eba83e65aae107d69.jpg' },
            { id: 1, word: 'BOCA', syllables: ['BO', 'CA'], missingIndex: 0, options: ['BO', 'PO'], image: 'https://us.123rf.com/450wm/grgroup/grgroup1609/grgroup160902090/63146446-mouth-cartoon-icon-female-sexy-and-lips-theme-colorful-design-vector-illustration.jpg' },
            { id: 2, word: 'CARRO', syllables: ['CA', 'RRO'], missingIndex: 1, options: ['RRO', 'LLO'], image: 'https://png.pngtree.com/png-clipart/20230421/original/pngtree-car-orange-cute-cartoon-illustration-png-image_9072132.png' },
            { id: 3, word: 'DEDO', syllables: ['DE', 'DO'], missingIndex: 0, options: ['DE', 'FE'], image: 'https://st.depositphotos.com/1526816/3423/v/450/depositphotos_34231791-stock-illustration-a-finger-pointing.jpg' },
            { id: 4, word: 'FOCA', syllables: ['FO', 'CA'], missingIndex: 1, options: ['CA', 'TA'], image: 'https://img.freepik.com/vector-gratis/icono-vectorial-dibujos-animados-foca-linda-bebiendo-te-ilustracion-icono-bebida-animal-vector-plano-aislado_138676-14706.jpg?semt=ais_hybrid&w=740&q=80' },
            { id: 5, word: 'GATO', syllables: ['GA', 'TO'], missingIndex: 0, options: ['GA', 'JA'], image: 'https://img.freepik.com/vector-gratis/personaje-dibujos-animados-lindo-gato-arco-iris-aislado_1308-140976.jpg?semt=ais_hybrid&w=740&q=80' },
            { id: 14, word: 'OLA (del mar)', syllables: ['O', 'LA'], missingIndex: 0, options: ['O', 'HO'], image: 'https://i.pinimg.com/736x/41/f7/50/41f75008b93c239f48742898409f6ca9.jpg' },
            { id: 15, word: 'HOLA (de saludo)', syllables: ['HO', 'LA'], missingIndex: 0, options: ['O', 'HO'], image: 'https://img.freepik.com/vector-free/happy-girl-butterfly_1450-103.jpg?semt=ais_hybrid&w=740&q=80' },
            { id: 6, word: 'JAULA', syllables: ['JAU', 'LA'], missingIndex: 1, options: ['LA', 'SA'], image: 'https://png.pngtree.com/png-vector/20230728/ourlarge/pngtree-birdcage-clipart-bird-cage-with-flowers-isolated-illustration-cartoon-vector-png-image_6804437.png' },
            { id: 7, word: 'LUNA', syllables: ['LU', 'NA'], missingIndex: 1, options: ['NA', 'RA'], image: 'https://png.pngtree.com/png-clipart/20250103/original/pngtree-hand-drawn-cartoon-moon-sleeping-png-image_5455611.png' },
            { id: 8, word: 'MANO', syllables: ['MA', 'NO'], missingIndex: 0, options: ['MA', 'NA'], image: 'https://previews.123rf.com/images/kahovsky/kahovsky1912/kahovsky191200060/135373349-cute-smiling-happy-human-hand-vector-flat-cartoon-character-illustration-isolated-on-white.jpg' },
            { id: 16, word: 'ÑU', syllables: ['ÑU'], missingIndex: 0, options: ['ÑU', 'NU'], image: 'https://i.pinimg.com/736x/f3/77/db/f377dbfe62161c8042aa5dd31f5d9403.jpg' },
            { id: 9, word: 'PATO', syllables: ['PA', 'TO'], missingIndex: 1, options: ['TO', 'DO'], image: 'https://i.pinimg.com/736x/6e/31/28/6e3128c0eac15d3aa05b3e23a4c6d9c5.jpg' },
            { id: 10, word: 'RAMA', syllables: ['RA', 'MA'], missingIndex: 0, options: ['RA', 'LA'], image: 'http://us.123rf.com/450wm/clairev/clairev1201/clairev120100004/11918016-dibujos-animados-rama-de-rbol-con-hojas-1--ilustraci-n-vectorial.jpg?ver=6' },
            { id: 11, word: 'SOPA', syllables: ['SO', 'PA'], missingIndex: 1, options: ['PA', 'FA'], image: 'https://png.pngtree.com/png-clipart/20240506/original/pngtree-soup-icon-cartoon-vector-dish-food-asian-menu-transparent-background-png-image_15017713.png' },
            { id: 12, word: 'TORO', syllables: ['TO', 'RO'], missingIndex: 0, options: ['TO', 'DO'], image: 'https://www.shutterstock.com/image-vector/cute-baby-cow-cartoon-vector-600nw-1827191426.jpg' },
            { id: 17, word: 'VACA', syllables: ['VA', 'CA'], missingIndex: 1, options: ['CA', 'GA'], image: 'https://st3.depositphotos.com/4207741/37525/v/450/depositphotos_375256862-stock-illustration-cute-cartoon-little-bull-green.jpg' },
        ];

        // --- FRASES POR RACHA ---
        const correctStreak1Phrases = [ "¡Correcto! 👍", "¡Muy bien! ✨", "¡Eso es! ✅", "¡Bien hecho!" ];
        const correctStreak2Phrases = [ "¡Genial! 🔥", "¡Sigue así! 🚀", "¡Dos seguidas!", "¡Vas muy bien!" ];
        const correctStreak3PlusPhrases = [ "¡Increíble! 🤩", "¡Fascinante! ⭐", "¡Eres imparable! 🏆", "¡Qué racha!", "¡Eres genial!" ];
        const correctModalSpeakPhrases = [ "¡Lo haces muy bien!", "¡Eso es, maravilloso!", "¡Qué genial!", "¡Fantástico, sigue así!", "¡Súper!" ];
        const correctModalTitles = [ "🌟 ¡Maravilloso!", "🎉 ¡Excelente!", "🚀 ¡Genial!", "🤩 ¡Lo haces muy bien!", "🧠 ¡Qué Listo!" ];
        const wrongTryAgainPhrases = [ "¡Uy, esa no es! ¡Inténtalo otra vez! 💪", "¡Casi! ¡Tú puedes! 🚀", "¡No te rindas! Prueba con la otra 😺", "¡Ánimo! Intenta de nuevo ✨", "¡Estuviste cerca! Vamos otra vez 👍" ];

        function getRandomPhrase(phraseArray) {
            return phraseArray[Math.floor(Math.random() * phraseArray.length)];
        }

        // --- ESTRUCTURA DE AUDIO ---
        function playSound(id) {
            if (!audioEnabled) return;
            const s = document.getElementById(id);
            if (s) {
                s.currentTime = 0;
                s.volume = 0.6;
                s.play().catch(e => console.warn(`Error al reproducir sonido '${id}':`, e));
            }
        }

        function speak(text) {
            if (!audioEnabled || !('speechSynthesis' in window)) {
                console.warn("TTS omitido o no soportado.");
                return;
            }
            window.speechSynthesis.cancel();
            const u = new SpeechSynthesisUtterance(text);
            u.lang = "es-MX";
            u.rate = 1;
            window.speechSynthesis.speak(u);
        }

        // --- ⬇️ FUNCIÓN DE SONIDO MODIFICADA (toggleAudio) ⬇️ ---
        function toggleAudio() {
            const soundButton = document.getElementById("enable-sound");

            // 1. Si es el primer clic, inicializa el AudioContext (requerido por navegadores)
            if (!audioContextInitialized) {
                audioContextInitialized = true;
                audioEnabled = true; // Activa el sonido por defecto en el primer clic
                console.log("Audio Context inicializado y sonido ACTIVADO.");

                // --- Código de inicialización de audio (de tu función original) ---
                try {
                    let audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    let buffer = audioCtx.createBuffer(1, 1, 22050);
                    let source = audioCtx.createBufferSource();
                    source.buffer = buffer;
                    source.connect(audioCtx.destination);
                    source.start(0);
                } catch (e) {
                    console.error("Error al iniciar AudioContext:", e);
                }
                
                if ('speechSynthesis' in window) {
                    window.speechSynthesis.getVoices();
                }
                // --- Fin de inicialización ---

                // Mensaje de bienvenida
                speak("¡Hola! Soy tu voz mágica. ¡Vamos a jugar a completar palabras!");
                
                // Actualiza el botón al estado "ON" (Silenciar)
                soundButton.textContent = "🔇 Silenciar";
                soundButton.classList.remove("animate-bounce"); // Quita la animación
                soundButton.classList.remove("bg-yellow-400", "hover:bg-yellow-500", "border-yellow-600");
                soundButton.classList.add("bg-red-500", "hover:bg-red-600", "border-red-700"); // Rojo = Mute

                // Lee la primera actividad (después de un retraso para no solaparse)
                const activity = activities[currentActivityIndex];
                if (activity) {
                    const completeWord = activity.word;
                    setTimeout(() => {
                        if(audioEnabled) { // Solo si el audio sigue activo
                            speak(`Escucha con atención. La palabra es ${completeWord}. ¿Qué sílaba falta?`);
                        }
                    }, 3000); // 3 segundos de espera
                }

            } else {
                // Si no es el primer clic, solo activa/desactiva
                audioEnabled = !audioEnabled; // Invierte el estado

                if (audioEnabled) {
                    // ENCENDIENDO EL SONIDO
                    console.log("Sonido ACTIVADO.");
                    soundButton.textContent = "🔇 Silenciar";
                    soundButton.classList.remove("bg-green-500", "hover:bg-green-600", "border-green-700");
                    soundButton.classList.add("bg-red-500", "hover:bg-red-600", "border-red-700");
                    speak("Sonido activado.");

                } else {
                    // APAGANDO EL SONIDO
                    console.log("Sonido DESACTIVADO.");
                    window.speechSynthesis.cancel(); // Detiene cualquier audio
                    soundButton.textContent = "🔊 Activar Sonido";
                    soundButton.classList.remove("bg-red-500", "hover:bg-red-600", "border-red-700");
                    soundButton.classList.add("bg-green-500", "hover:bg-green-600", "border-green-700"); // Verde = Activar
                }
            }
        }
        // --- ⬆️ FIN DE LA NUEVA FUNCIÓN toggleAudio ⬆️ ---

        // --- 2. LÓGICA DE INTERFAZ Y CONTENIDO ---
        function getRandomColorClasses() { /* ... (se mantiene) ... */ }

        // --- 3. LÓGICA DE LA ACTIVIDAD ---
        function startConfetti(particleCount = 50) { /* ... (se mantiene) ... */ }

        function showModal(title, message, isCorrect, completedWord = '') {
            // (Esta función se mantiene igual que en tu versión)
            const modal = document.getElementById('modal');
            const modalTitle = document.getElementById('modal-title');
            const modalText = document.getElementById('modal-text');
            const continueButton = document.getElementById('modal-continue-button');
            const restartButton = document.getElementById('modal-restart-button');

            modalTitle.textContent = title;
            modalText.textContent = message;

            continueButton.classList.remove('hidden');
            restartButton.classList.add('hidden');
            modal.querySelector('div').classList.remove('animate-bounce', 'border-red-500', 'border-green-500', 'border-yellow-500');

            if (isCorrect) {
                modalTitle.className = 'text-3xl font-black mb-4 text-green-700';
                continueButton.className = 'px-6 py-3 bg-green-500 text-white font-bold rounded-xl shadow-lg hover:bg-green-600 transition duration-150';
                modal.querySelector('div').classList.add('border-green-500');

                if (correctAnswersCount >= GOAL_COUNT) {
                    modalTitle.textContent = '🏆 ¡ERES UN SÚPER CAMPEÓN! 🌟';
                    modalText.textContent = '¡Completaste 5 palabras! ¿Quieres volver a jugar?';
                    continueButton.classList.add('hidden');
                    restartButton.classList.remove('hidden');
                    modal.querySelector('div').classList.remove('border-green-500');
                    modal.querySelector('div').classList.add('border-yellow-500');

                    startConfetti(100);
                    playSound('sonido-victoria');
                    speak("¡Felicidades! Completaste todas las palabras. ¡Eres genial!");
                } else {
                    // VOZ AL ACERTAR (USA FRASE DE RACHA)
                    let streakPhrase = '';
                    if (correctStreakCount >= 3) {
                        streakPhrase = getRandomPhrase(correctStreak3PlusPhrases);
                    } else if (correctStreakCount === 2) {
                        streakPhrase = getRandomPhrase(correctStreak2Phrases);
                    } else {
                        streakPhrase = getRandomPhrase(correctStreak1Phrases);
                    }
                    speak(`${streakPhrase} Completaste ${completedWord}.`);
                }
            } else {
                modalTitle.className = 'text-3xl font-black mb-4 text-red-700';
                continueButton.className = 'px-6 py-3 bg-red-500 text-white font-bold rounded-xl shadow-lg hover:bg-red-600 transition duration-150';
                modal.querySelector('div').classList.add('border-red-500');
                speak("Inténtalo de nuevo, tú puedes.");
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        window.closeModal = function() {
            // (Esta función se mantiene igual)
            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            nextActivity();
        }

        window.restartGame = function() {
            // (Esta función se mantiene igual que en tu versión)
            correctStreakCount = 0;
            updateStreakIndicator(); 

            const modal = document.getElementById('modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');

            correctAnswersCount = 0;
            currentActivityIndex = 0;
            activities.sort(() => Math.random() - 0.5);
            updateCounterDisplay();
            renderActivity();
            document.querySelectorAll('.option-button').forEach(btn => btn.disabled = false);
            speak("¡Empezamos un nuevo juego! Completa la siguiente palabra.");
        }

        function updateCounterDisplay() {
            // (Esta función se mantiene igual)
            const counterElement = document.getElementById('correct-count');
            if (counterElement) {
                counterElement.textContent = correctAnswersCount;
            }
        }

        function updateStreakIndicator() {
            // (Esta función se mantiene igual que en tu versión)
             const streakElement = document.getElementById('streak-indicator');
             if (streakElement) {
                  if (correctStreakCount >= 2) {
                      streakElement.textContent = `🔥 Racha x${correctStreakCount}`;
                  } else {
                      streakElement.textContent = ''; // Oculta si la racha es < 2
                  }
             }
        }

        function renderActivity() {
            // (Esta función se mantiene igual que en tu versión)
            if (currentActivityIndex >= activities.length) {
                currentActivityIndex = 0;
            }
            const activity = activities[currentActivityIndex];
            const currentWordContainer = document.getElementById('current-word');
            const optionsContainer = document.getElementById('options-container');
            const feedbackMessage = document.getElementById('feedback-message');
            const imageContainer = document.getElementById('word-image-container');

            feedbackMessage.textContent = '';
            currentWordContainer.innerHTML = '';
            optionsContainer.innerHTML = '';

            const imageValue = activity.image;
            imageContainer.innerHTML = '';
            imageContainer.classList.remove('emoji-image');

            const img = document.createElement('img');
            img.id = 'activity-image';
            img.classList.add('w-full', 'h-full', 'object-contain', 'rounded-xl');

            if (imageValue && imageValue.startsWith('uploaded:')) {
                const filename = imageValue.replace('uploaded:', '');
                img.src = filename;
            } else if (imageValue) {
                img.src = imageValue;
            } else {
                img.src = '';
            }

            img.onerror = () => {
                img.remove();
                imageContainer.classList.add('emoji-image');
                imageContainer.textContent = '❓';
            };
            imageContainer.appendChild(img);

            activity.syllables.forEach((syllable, index) => {
                const span = document.createElement('span');
                span.classList.add('word-segment');

                if (index === activity.missingIndex) {
                    span.classList.add('missing-syllable');
                    span.textContent = '___';
                } else {
                    span.textContent = syllable;
                }
                currentWordContainer.appendChild(span);
            });

            const shuffledOptions = [...activity.options].sort(() => Math.random() - 0.5);

            shuffledOptions.forEach(option => {
                const button = document.createElement('button');
                button.textContent = option;
                button.classList.add('option-button', 'p-4', 'sm:p-6', 'text-2xl', 'sm:text-3xl', 'font-black', 'rounded-2xl', 'border-b-4', 'w-32', 'sm:w-40');
                button.classList.add('bg-purple-500', 'hover:bg-purple-600', 'border-purple-700', 'text-white');

                const isCorrect = (option === activity.syllables[activity.missingIndex]);
                button.onclick = (event) => checkAnswer(option, isCorrect, event.currentTarget);

                optionsContainer.appendChild(button);
            });

             // Llama a speak con la palabra completa al inicio
             if(audioEnabled && !audioContextInitialized) { // Solo si el audio está habilitado PERO AÚN NO se ha inicializado (para evitar doble lectura)
                // Nota: La lectura ahora se maneja en toggleAudio en el primer clic
             } else if (audioEnabled && audioContextInitialized) {
                // Si el audio ya estaba activo, lee la siguiente palabra
                const completeWord = activity.word;
                speak(`Escucha con atención. La palabra es ${completeWord}. ¿Qué sílaba falta?`);
             }
        }

        function checkAnswer(selectedSyllable, isCorrectOption, clickedButton) {
            // (Esta función se mantiene igual que en tu versión)
            const activity = activities[currentActivityIndex];
            const feedbackMessage = document.getElementById('feedback-message');
            const currentWordContainer = document.getElementById('current-word');
            const missingSpan = currentWordContainer.querySelector('.missing-syllable');

            document.querySelectorAll('.option-button').forEach(btn => btn.disabled = true);

            if (clickedButton) {
                clickedButton.classList.add('scale-[1.1]', 'duration-100');
                setTimeout(() => {
                    clickedButton.classList.remove('scale-[1.1]', 'duration-100');
                }, 150);
            }

            if (isCorrectOption) {
                correctAnswersCount++;
                correctStreakCount++; // Incrementa racha
                updateCounterDisplay();
                updateStreakIndicator(); // Actualiza indicador visual

                playSound('sonido-correcto');
                startConfetti();

                // Selecciona frase de feedback según la racha
                let feedbackPhrase = '';
                if (correctStreakCount >= 3) {
                    feedbackPhrase = getRandomPhrase(correctStreak3PlusPhrases);
                } else if (correctStreakCount === 2) {
                    feedbackPhrase = getRandomPhrase(correctStreak2Phrases);
                } else {
                    feedbackPhrase = getRandomPhrase(correctStreak1Phrases);
                }

                feedbackMessage.classList.remove('text-red-600');
                feedbackMessage.classList.add('text-green-600');
                feedbackMessage.textContent = feedbackPhrase; // Muestra frase de racha

                if (missingSpan) {
                    missingSpan.textContent = selectedSyllable;
                    missingSpan.classList.remove('missing-syllable', 'bg-gray-400', 'animate-pulse-placeholder');
                    missingSpan.classList.add('bg-yellow-300', 'text-blue-700', 'animate-pulse');
                }

                const message = `¡Completaste: ${activity.word}!`; // Mensaje del modal
                const randomTitle = getRandomPhrase(correctModalTitles);
                const completeWord = activity.word;

                setTimeout(() => {
                    showModal(randomTitle, message, true, completeWord);
                }, 700);

            } else {
                correctStreakCount = 0; // Reinicia racha al fallar
                updateStreakIndicator(); // Limpia indicador visual
                playSound('sonido-incorrecto');

                const randomWrongPhrase = getRandomPhrase(wrongTryAgainPhrases);
                feedbackMessage.classList.remove('text-green-600');
                feedbackMessage.classList.add('text-red-600');
                feedbackMessage.textContent = randomWrongPhrase; 

                speak(randomWrongPhrase); 

                setTimeout(() => {
                    document.querySelectorAll('.option-button').forEach(btn => btn.disabled = false);
                }, 1000);
            }
        }

        window.nextActivity = function() {
            // (Esta función se mantiene igual)
            currentActivityIndex = (currentActivityIndex + 1) % activities.length;
            renderActivity();
            document.querySelectorAll('.option-button').forEach(btn => btn.disabled = false);
        }

        // --- 4. ANIMACIÓN DE FONDO (THREE.JS) ---
        let scene, camera, renderer, particles;
        let particleCount = 100;
        function initBackgroundAnimation() {
             // (Esta función se mantiene igual)
            const canvas = document.getElementById('bg-canvas');
            if (!canvas) {
                console.error("Canvas element not found!");
                return;
            }
            scene = new THREE.Scene();
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setClearColor(0x000000, 0);

            const particleGeometry = new THREE.BufferGeometry();
            const positions = [];
            const colors = [];
            const baseColors = [
                new THREE.Color(0xff69b4), // Rosa
                new THREE.Color(0x00bfff), // Azul
                new THREE.Color(0xffff00), // Amarillo
                new THREE.Color(0x32cd32)  // Verde
            ];

            for (let i = 0; i < particleCount; i++) {
                positions.push((Math.random() - 0.5) * 20); // x
                positions.push((Math.random() - 0.5) * 20); // y
                positions.push((Math.random() - 0.5) * 20); // z

                const color = baseColors[Math.floor(Math.random() * baseColors.length)];
                colors.push(color.r, color.g, color.b);
            }
            particleGeometry.setAttribute('position', new THREE.Float32BufferAttribute(positions, 3));
            particleGeometry.setAttribute('color', new THREE.Float32BufferAttribute(colors, 3));
            
            const particleMaterial = new THREE.PointsMaterial({
                size: 0.1,
                vertexColors: true,
                transparent: true,
                opacity: 0.6,
                sizeAttenuation: true
            });
            
            particles = new THREE.Points(particleGeometry, particleMaterial);
            scene.add(particles);

            camera.position.z = 10;
            window.addEventListener('resize', onWindowResize, false);
        }

        function onWindowResize() {
            // (Esta función se mantiene igual)
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            // (Esta función se mantiene igual)
            requestAnimationFrame(animate);
            if (particles) {
                particles.rotation.x += 0.0005;
                particles.rotation.y += 0.001;
            }
            renderer.render(scene, camera);
        }

        // --- 5. INICIALIZACIÓN ---
        
        // ⬇️ LISTENER MODIFICADO ⬇️
        document.getElementById("enable-sound").addEventListener("click", toggleAudio);

        window.onload = function () {
            // (Esta función se mantiene igual)
            activities.sort(() => Math.random() - 0.5);
            renderActivity();
            updateCounterDisplay();
            initBackgroundAnimation();
            animate();
        }

    </script>
                   <div class="navigation-buttons">
            <a href="inicio.html" class="btn-childish btn-menu">
                <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
                <span>Ir al Inicio</span>
            </a>
        </div>
</body>
</html>
