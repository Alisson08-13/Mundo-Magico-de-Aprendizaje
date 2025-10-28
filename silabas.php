<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>¡El Mundo del Abecedario y las Sílabas!</title>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.4.0/dist/confetti.browser.min.js"></script>

    <style>
        /* (Todos tus estilos CSS se mantienen exactamente igual) */
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700;900&display=swap');
        body {
            font-family: 'Nunito', sans-serif;
            background: linear-gradient(135deg, #e0f7fa, #b2ebf2, #e0f7fa, #ffffff);
            background-size: 400% 400%;
            animation: gentleGradient 25s ease infinite;
            text-align: center;
            margin: 0;
            padding: 1.5rem;
            overflow-x: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }
        @keyframes gentleGradient { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        .main-container { max-width: 950px; width: 100%; margin: 0 auto; background: #ffffff; border-radius: 24px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.12); padding: 2rem 2.5rem; box-sizing: border-box; }
        h1 { font-weight: 900; font-size: clamp(2.2em, 5vw, 2.8em); color: #0288d1; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 4px solid #fff59d; padding-bottom: 0.5rem; }
        h2 { font-weight: 700; color: #0277bd; margin-bottom: 0.5rem; }
        p { color: #555; font-size: 1.1em; }
        .letter-selector-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap: 1rem; margin-top: 1.5rem; margin-bottom: 2rem; }
        .btn-3d { font-family: 'Nunito', sans-serif; font-weight: 900; border: 3px solid transparent; border-radius: 12px; padding: 0.8rem; transition: all 0.15s ease; cursor: pointer; user-select: none; -webkit-tap-highlight-color: transparent; box-shadow: 0 5px 0 0 var(--shadow-color, #00000030); animation: shine 2.5s infinite ease-in-out; }
        .btn-3d:active { transform: translateY(3px); box-shadow: 0 2px 0 0 var(--shadow-color, #00000030); animation: none; }
        .btn-3d:not(:active):hover { animation: jiggle 0.3s; }
        @keyframes shine { 0% { box-shadow: 0 5px 0 0 var(--shadow-color), 0 0 4px transparent; } 50% { box-shadow: 0 5px 0 0 var(--shadow-color), 0 0 15px var(--shadow-color); } 100% { box-shadow: 0 5px 0 0 var(--shadow-color), 0 0 4px transparent; } }
        @keyframes jiggle { 0%, 100% { transform: rotate(0deg); } 25% { transform: rotate(-3deg); } 75% { transform: rotate(3deg); } }
        .letra-btn { font-size: clamp(2em, 6vw, 2.8em); }
        .letra-btn:nth-child(5n+1) { background: #ffcdd2; color: #d32f2f; --shadow-color: #d32f2f; }
        .letra-btn:nth-child(5n+2) { background: #c8e6c9; color: #388e3c; --shadow-color: #388e3c; }
        .letra-btn:nth-child(5n+3) { background: #bbdefb; color: #1976d2; --shadow-color: #1976d2; }
        .letra-btn:nth-child(5n+4) { background: #fff9c4; color: #b5830e; --shadow-color: #b5830e; }
        .letra-btn:nth-child(5n+5) { background: #e1bee7; color: #7b1fa2; --shadow-color: #7b1fa2; }
        .letra-btn:nth-child(5n+0) { background: #ffccbc; color: #e65100; --shadow-color: #e65100; }
        .navigation-buttons { margin-top: 2.5rem; display: flex; justify-content: center; gap: 1rem; }
        .btn-menu { font-size: clamp(1.2em, 4vw, 1.5em); padding: 1rem 2rem; text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 10px; background: #bbdefb; color: #1976d2; --shadow-color: #1976d2; animation: none; }
        .btn-menu img { height: 1.5em; width: auto; display: block; border-radius: 8px; }
        .btn-menu span { display: block; }
        .btn-menu:not(:active):hover { animation: jiggle 0.3s; }
        .sound-display-area { margin-top: 1rem; background: #f9f9f9; border: 3px dashed #ccc; border-radius: 20px; min-height: 300px; padding: 1rem; display: flex; justify-content: center; align-items: center; transition: background-color 0.4s, border-color 0.4s; overflow: hidden; }
        #animatedLetterDisplay { font-weight: 900; font-size: clamp(8em, 30vw, 15em); color: #ccc; transition: color 0.4s; user-select: none; }
        #animatedLetterDisplay.initial { font-size: clamp(1.5em, 5vw, 2.2em); font-weight: 700; color: #777; padding: 0 1rem; }
        .animated-letter { animation: boing 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        @keyframes boing { 0% { transform: scale(0.1) rotate(-30deg); opacity: 0; } 50% { transform: scale(1.2) rotate(10deg); opacity: 1; } 70% { transform: scale(0.9) rotate(-5deg); } 100% { transform: scale(1) rotate(0deg); opacity: 1; } }
        .estrellita { position: absolute; font-size: 40px; animation: subir 1.5s ease-out forwards; z-index: 100; pointer-events: none; }
        @keyframes subir { 0% { opacity: 1; transform: translateY(0) scale(1); } 100% { opacity: 0; transform: translateY(-100px) scale(1.5); } }
        .hidden { display: none; }
        #syllableContainer { width: 100%; animation: fadeIn 0.3s ease-out; }
        @keyframes fadeIn { from { opacity: 0; transform: scale(0.95); } to { opacity: 1; transform: scale(1); } }
        .syllable-title { font-size: clamp(4em, 15vw, 6em); font-weight: 900; margin: 0.5rem 0 1.5rem 0; animation: boing 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards; }
        .syllable-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(80px, 1fr)); gap: 1rem; justify-content: center; }
        .syllable-btn { font-size: clamp(1.5em, 5vw, 2.2em); padding: 0.8rem; }
        
        @media (max-width: 900px) {
             .letter-selector-grid { grid-template-columns: repeat(auto-fit, minmax(70px, 1fr)); }
        }
        @media (max-width: 600px) {
            body { padding: 0.5rem; }
            .main-container { padding: 1.5rem 1rem; }
            .letter-selector-grid { grid-template-columns: repeat(auto-fit, minmax(55px, 1fr)); gap: 0.5rem; }
             .btn-3d { padding: 0.6rem; }
             .letra-btn { font-size: clamp(1.8em, 5vw, 2.2em); }
            .sound-display-area { min-height: 200px; }
            #animatedLetterDisplay { font-size: clamp(6em, 25vw, 12em); }
             #animatedLetterDisplay.initial { font-size: clamp(1.2em, 4vw, 1.8em); }
            .navigation-buttons { flex-direction: column; margin-top: 2rem; }
            .btn-menu { width: 100%; box-sizing: border-box; padding: 1rem 1.5rem; }
            .syllable-grid { grid-template-columns: repeat(auto-fit, minmax(55px, 1fr)); gap: 0.5rem; }
            .syllable-btn { font-size: clamp(1.4em, 4vw, 1.8em); padding: 0.6rem; }
            .syllable-title { font-size: clamp(3em, 12vw, 5em); }
        }
    </style>
</head>

<body>
    <div class="main-container">

        <h1>¡Abecedario y Sílabas!</h1>
        <h2>¡Escucha y Aprende!</h2>
        <p>Toca una letra para oír su sonido o ver sus sílabas.</p>

        <section class="letter-selector">
            <div class="letter-selector-grid">
                <button class="letra-btn btn-3d" data-letra="a">A</button>
                <button class="letra-btn btn-3d" data-letra="b">B</button>
                <button class="letra-btn btn-3d" data-letra="c">C</button>
                <button class="letra-btn btn-3d" data-letra="d">D</button>
                <button class="letra-btn btn-3d" data-letra="e">E</button>
                <button class="letra-btn btn-3d" data-letra="f">F</button>
                <button class="letra-btn btn-3d" data-letra="g">G</button>
                <button class="letra-btn btn-3d" data-letra="h">H</button>
                <button class="letra-btn btn-3d" data-letra="i">I</button>
                <button class="letra-btn btn-3d" data-letra="j">J</button>
                <button class="letra-btn btn-3d" data-letra="k">K</button>
                <button class="letra-btn btn-3d" data-letra="l">L</button>
                <button class="letra-btn btn-3d" data-letra="m">M</button>
                <button class="letra-btn btn-3d" data-letra="n">N</button>
                <button class="letra-btn btn-3d" data-letra="ñ">Ñ</button>
                <button class="letra-btn btn-3d" data-letra="o">O</button>
                <button class="letra-btn btn-3d" data-letra="p">P</button>
                <button class="letra-btn btn-3d" data-letra="q">Q</button>
                <button class="letra-btn btn-3d" data-letra="r">R</button>
                <button class="letra-btn btn-3d" data-letra="s">S</button>
                <button class="letra-btn btn-3d" data-letra="t">T</button>
                <button class="letra-btn btn-3d" data-letra="u">U</button>
                <button class="letra-btn btn-3d" data-letra="v">V</button>
                <button class="letra-btn btn-3d" data-letra="w">W</button>
                <button class="letra-btn btn-3d" data-letra="x">X</button>
                <button class="letra-btn btn-3d" data-letra="y">Y</button>
                <button class="letra-btn btn-3d" data-letra="z">Z</button>
            </div>
        </section>

        <section class="sound-display-area" id="soundDisplay">
            <span id="animatedLetterDisplay" class="initial">¡Bienvenido al Abecedario!</span>
            <div id="syllableContainer" class="hidden">
                <h2 id="syllableTitle" class="syllable-title"></h2>
                <div id="syllableGrid" class="syllable-grid"></div>
            </div>
        </section>

        <div class="navigation-buttons">
            <a href="inicio.html" class="btn-3d btn-menu">
                <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
                <span>Ir al Inicio</span>
            </a>
        </div>
        </div>

    <audio id="aplausos" src="https://cdn.pixabay.com/audio/2022/03/15/audio_b8c58a0b30.mp3" preload="auto"></audio>

<script>
    // --- VARIABLES GLOBALES ---
    const displayColoresVocales = ['#e57373', '#81c784', '#64b5f6', '#ffb74d', '#ba68c8'];
    const vocales = ['a', 'e', 'i', 'o', 'u'];
    // (Mapa de sílabas especiales se mantiene igual)
    const specialSyllables = {
        'c': ['ca', 'ce', 'ci', 'co', 'cu'], 
        'g': ['ga', 'ge', 'gi', 'go', 'gu'], 
        'h': ['ha', 'he', 'hi', 'ho', 'hu'], 
        'q': ['que', 'qui'],                 
        'y': ['ya', 'ye', 'yi', 'yo', 'yu'], 
        'z': ['za', 'ze', 'zi', 'zo', 'zu']
    };

    // --- ELEMENTOS ---
    const aplausos = document.getElementById('aplausos');
    const letterButtons = document.querySelectorAll('.letra-btn');
    const soundDisplay = document.getElementById('soundDisplay');
    const animatedLetterDisplay = document.getElementById('animatedLetterDisplay');
    const syllableContainer = document.getElementById('syllableContainer');
    const syllableTitle = document.getElementById('syllableTitle');
    const syllableGrid = document.getElementById('syllableGrid');


    // --- ⬇️ FUNCIÓN HABLAR (CORREGIDA) ⬇️ ---
    function hablar(texto, esSilaba = false) {
        if (!('speechSynthesis' in window)) {
            console.error("Tu navegador no soporta la síntesis de voz.");
            return;
        }
        speechSynthesis.cancel();
        
        const voz = new SpeechSynthesisUtterance();
        voz.lang = 'es-MX'; // Español (México)
        voz.rate = 0.9;
        voz.pitch = 1.1;

        if (esSilaba) {
            let textoHack = texto;

            // --- INICIO DE NUEVAS REGLAS DE PRONUNCIACIÓN ---
            
            // 1. Reglas para W (forzar sonido 'u' + vocal) - CORREGIDO
            if (texto === 'wa') textoHack = 'uá';
            else if (texto === 'we') textoHack = 'ué';
            else if (texto === 'wi') textoHack = 'uí';
            else if (texto === 'wo') textoHack = 'uó';
            else if (texto === 'wu') textoHack = 'uú';

            // 2. Reglas para R (forzar sonido 'rr')
            else if (texto === 'ra') textoHack = 'rrá';
            else if (texto === 're') textoHack = 'rré';
            else if (texto === 'ri') textoHack = 'rrí';
            else if (texto === 'ro') textoHack = 'rró';
            else if (texto === 'ru') textoHack = 'rrú';

            // 3. Reglas existentes (se mantienen)
            else if (texto === 'que') textoHack = 'qué';
            else if (texto === 'qui') textoHack = 'quí';
            else if (texto === 'ge') textoHack = 'jé';
            else if (texto === 'gi') textoHack = 'jí';

            // 4. Lógica genérica (se mantiene para el resto)
            else {
                let vocalIndex = -1;
                for (let i = 0; i < texto.length; i++) {
                    if ('aeiou'.includes(texto[i].toLowerCase())) {
                        vocalIndex = i;
                        break;
                    }
                }

                if (vocalIndex !== -1) {
                    let charArray = texto.split('');
                    let vowel = charArray[vocalIndex];
                    
                    if (vowel === 'a') charArray[vocalIndex] = 'á';
                    else if (vowel === 'e') charArray[vocalIndex] = 'é';
                    else if (vowel === 'i') charArray[vocalIndex] = 'í';
                    else if (vowel === 'o') charArray[vocalIndex] = 'ó';
                    else if (vowel === 'u') charArray[vocalIndex] = 'ú';
                    
                    textoHack = charArray.join('');
                }
            }
            
            voz.text = textoHack;
            // --- FIN DE REGLAS DE PRONUNCIACIÓN ---

        } else {
            // --- LÓGICA PARA NOMBRES DE LETRAS (CORREGIDA) ---
            const letraMinuscula = texto.toLowerCase();
            voz.text = texto; // Por defecto (para vocales A, E, I, O, U)

            // Casos especiales para pronunciación de nombres de letras
            if (letraMinuscula === 'b') { voz.text = 'be'; }
            else if (letraMinuscula === 'c') { voz.text = 'ce'; }
            else if (letraMinuscula === 'd') { voz.text = 'de'; }
            else if (letraMinuscula === 'f') { voz.text = 'efe'; } // <-- CORREGIDO
            else if (letraMinuscula === 'g') { voz.text = 'ge'; }
            else if (letraMinuscula === 'h') { voz.text = 'hache'; }
            else if (letraMinuscula === 'j') { voz.text = 'jota'; }
            else if (letraMinuscula === 'k') { voz.text = 'ka'; }
            else if (letraMinuscula === 'l') { voz.text = 'ele'; }
            else if (letraMinuscula === 'm') { voz.text = 'eme'; }
            else if (letraMinuscula === 'n') { voz.text = 'éne'; } 
            else if (letraMinuscula === 'ñ') { voz.text = 'eñe'; }
            else if (letraMinuscula === 'p') { voz.text = 'pe'; }
            else if (letraMinuscula === 'q') { voz.text = 'cú'; }  
            else if (letraMinuscula === 'r') { voz.text = 'erre'; }
            else if (letraMinuscula === 's') { voz.text = 'ese'; }
            else if (letraMinuscula === 't') { voz.text = 'te'; }
            else if (letraMinuscula === 'v') { voz.text = 'uve'; }
            else if (letraMinuscula === 'w') { voz.text = 'doble u'; } 
            else if (letraMinuscula === 'x') { voz.text = 'equis'; }
            else if (letraMinuscula === 'y') { voz.text = 'i griega'; }
            else if (letraMinuscula === 'z') { voz.text = 'zeta'; }
        }

        speechSynthesis.speak(voz);
    }
    // --- ⬆️ FIN FUNCIÓN HABLAR (CORREGIDA) ⬆️ ---


    // --- (El resto de funciones y la lógica principal son idénticas) ---

    function playAplausos() {
        aplausos.currentTime = 0;
        aplausos.volume = 0.4;
        aplausos.play().catch(e => console.log("Error al reproducir audio:", e));
    }

    function lanzarEstrellita(elemento) {
        const estrella = document.createElement('div');
        estrella.textContent = '✨';
        estrella.className = 'estrellita';
        const rect = elemento.getBoundingClientRect();
        estrella.style.left = (rect.left + rect.width / 2 - 20) + 'px';
        estrella.style.top = (rect.top + window.scrollY + rect.height / 2 - 50) + 'px';
        document.body.appendChild(estrella);
        setTimeout(() => estrella.remove(), 1500);
    }

    function triggerConfetti(element) {
        const rect = element.getBoundingClientRect();
        const originX = (rect.left + rect.width / 2) / window.innerWidth;
        const originY = (rect.top + rect.height / 2) / window.innerHeight;
        confetti({
            particleCount: 50,
            spread: 70,
            origin: { x: originX, y: originY },
            colors: displayColoresVocales
        });
    }

    // --- LÓGICA PRINCIPAL ---
     document.addEventListener('DOMContentLoaded', () => {
       setTimeout(() => {
            // Asegurarnos de que las voces estén cargadas antes de hablar
            if (speechSynthesis.getVoices().length === 0) {
                speechSynthesis.onvoiceschanged = () => {
                    hablar('Toca una letra para escucharla.');
                };
            } else {
                hablar('Toca una letra para escucharla.');
            }
       }, 500);
    });

    letterButtons.forEach(v => {
        v.addEventListener('click', () => {
            const letra = v.dataset.letra;
            const style = window.getComputedStyle(v);
            const bgColor = style.backgroundColor;
            const defaultTextColor = style.color;

            // --- LÓGICA DE BIFURCACIÓN ---
            if (vocales.includes(letra.toLowerCase())) {
                
                // --- 1. SI ES VOCAL (Comportamiento original) ---
                syllableContainer.classList.add('hidden');
                animatedLetterDisplay.classList.remove('hidden');
                animatedLetterDisplay.classList.remove('initial');
                
                hablar(letra, false); 
                playAplausos();
                triggerConfetti(v);

                const displayColor = displayColoresVocales[Math.floor(Math.random() * displayColoresVocales.length)];
                animatedLetterDisplay.textContent = letra.toUpperCase();
                animatedLetterDisplay.style.color = displayColor;
                soundDisplay.style.borderColor = displayColor;
                soundDisplay.style.backgroundColor = bgColor;

                animatedLetterDisplay.classList.remove('animated-letter');
                setTimeout(() => {
                    animatedLetterDisplay.classList.add('animated-letter');
                    lanzarEstrellita(animatedLetterDisplay);
                }, 10);
            
            } else {

                // --- 2. SI ES CONSONANTE (Nuevo comportamiento de sílabas) ---
                animatedLetterDisplay.classList.add('hidden');
                animatedLetterDisplay.classList.remove('initial');
                syllableContainer.classList.remove('hidden');

                hablar(letra, false); // Habla el nombre de la letra (be, ce, de...)
                playAplausos();
                triggerConfetti(v);
                
                soundDisplay.style.borderColor = defaultTextColor;
                soundDisplay.style.backgroundColor = bgColor;
                
                syllableTitle.textContent = letra.toUpperCase();
                syllableTitle.style.color = defaultTextColor;
                
                syllableGrid.innerHTML = '';

                // Determinar qué sílabas mostrar
                let silabasParaMostrar = [];
                const l = letra.toLowerCase();

                if (specialSyllables[l]) {
                    silabasParaMostrar = specialSyllables[l]; // Usar lista especial
                } else {
                    // Crear sílabas por defecto (ej. b + a, b + e...)
                    silabasParaMostrar = vocales.map(vocal => l + vocal);
                }

                // Generar los botones de sílabas
                silabasParaMostrar.forEach(silaba => {
                    const btn = document.createElement('button');
                    btn.className = 'btn-3d syllable-btn'; 
                    btn.textContent = silaba;
                    
                    btn.style.setProperty('--shadow-color', defaultTextColor);
                    btn.style.background = '#ffffff'; 
                    btn.style.color = defaultTextColor; 
                    
                    btn.onclick = () => {
                        hablar(silaba, true); // HABLAR LA SÍLABA (ej. "ba")
                        lanzarEstrellita(btn);
                        
                        btn.style.animation = 'jiggle 0.3s';
                        setTimeout(() => btn.style.animation = '', 300);
                    };
                    syllableGrid.appendChild(btn);
                });
            }
        });
    });

</script>
</body>
</html>
