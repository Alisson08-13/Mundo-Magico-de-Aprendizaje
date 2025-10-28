<?php
// (ACTUALIZADO) Lista de vocales con imágenes y palabras asociadas
$vocales = [
    // Usando URLs directas limpiadas
    ['letra' => 'A', 'img' => 'https://i.pinimg.com/736x/f6/9f/dc/f69fdc04248f09912541f5a5bb5cb50c.jpg', 'palabra' => 'Ardilla'],
    ['letra' => 'E', 'img' => 'https://static.vecteezy.com/system/resources/previews/044/841/151/original/cartoon-elephant-animal-illustration-vector.jpg', 'palabra' => 'Elefante'],
    ['letra' => 'I', 'img' => 'https://thumbs.dreamstime.com/z/iglesia-cristiana-de-dibujos-animados-esta-caricatura-clipart-muestra-una-ilustraci%C3%B3n-la-296680804.jpg', 'palabra' => 'Iglesia'],
    ['letra' => 'O', 'img' => 'https://img.freepik.com/fotos-premium/oso-dibujos-animados-sentado-suelo-flores-corazones-ai-generativo_958165-24232.jpg', 'palabra' => 'Oso'],
    ['letra' => 'U', 'img' => 'https://static.vecteezy.com/system/resources/previews/018/931/130/non_2x/cartoon-grapes-icon-png.png', 'palabra' => 'Uvas']
];
// Duplicamos para tener las parejas (No es necesario aquí, se hace en JS)
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>🎵 Memorama Mágico de Vocales 🌈</title>

<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* --- ESTILOS INFANTILES --- */

    body {
        margin: 0;
        font-family: 'Open Sans', sans-serif;
        background: linear-gradient(180deg, #87CEEB 0%, #ADD8E6 50%, #a8e6cf 100%);
        text-align: center;
        padding: 1rem;
        overflow-x: hidden;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        box-sizing: border-box;
        position: relative;
        overflow-y: auto;
    }

    /* Contenedor flotante */
    .main-container {
        max-width: 950px;
        width: 90%;
        margin: 2rem auto;
        background: linear-gradient(145deg, #FFFBDA, #FFFFFF);
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), 0 0 0 8px rgba(255, 255, 255, 0.7);
        padding: clamp(1.5rem, 4vw, 2.5rem);
        border: 4px solid #FFD700;
        position: relative;
        z-index: 10;
        animation: floatEffect 3s ease-in-out infinite;
    }

    @keyframes floatEffect {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    /* Título animado */
    .titulo-memorama {
        font-family: 'Fredoka One', cursive;
        font-size: clamp(2.5em, 6vw, 3.8em);
        color: #FF8C69; /* Coral Suave */
        text-shadow: 4px 4px 0px #FFD700, 6px 6px 0px #87CEEB;
        margin-bottom: 1.5rem;
        margin-top: 0;
        position: relative;
        display: inline-block;
        animation: pulseTitle 2s infinite alternate;
        letter-spacing: normal;
    }
     @keyframes pulseTitle {
        from { transform: scale(1); }
        to { transform: scale(1.05); }
    }


    /* Tablero del juego */
    #game-board {
        display: grid;
        /* (AJUSTE) Por defecto es auto-fit, lo que permite 5 columnas en monitores anchos */
        grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
        max-width: 600px;
        gap: clamp(10px, 2vw, 20px);
        justify-content: center;
        margin: 2rem auto;
        position: relative;
        z-index: 2;
    }

    /* Estilo de las cartas */
    .card {
        aspect-ratio: 1 / 1;
        width: 100%;
        background-color: transparent; /* Fondo transparente para ver caras */
        border-radius: 20px;
        cursor: pointer;
        transition: transform 0.6s ease, box-shadow 0.3s;
        position: relative;
        user-select: none;
        border: none; /* Quitamos borde exterior, lo tienen las caras */
        transform-style: preserve-3d;
        perspective: 1000px;
    }

    /* Hover effect on non-flipped card */
    .card:not(.flipped):hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }
     /* Hover effect on flipped card */
    .card.flipped:hover {
        transform: scale(1.05) rotateY(180deg);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }


    .card .front, .card .back {
        position: absolute;
        width: 100%;
        height: 100%;
        backface-visibility: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 20px; /* Redondeo en las caras */
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.25); /* Sombra en las caras */
        border: 3px solid rgba(255, 255, 255, 0.7); /* Borde blanco en las caras */
        box-sizing: border-box; /* Incluir borde en tamaño */
    }

    .card .front { /* Cara con la imagen */
        background-color: #FFB74D; /* Naranja suave */
        transform: rotateY(180deg);
        padding: 5px;
    }

     .card .back { /* Cara con la letra */
        background-color: #87CEFA; /* Azul cielo */
        font-family: 'Fredoka One', cursive;
        font-size: clamp(2.5em, 8vw, 4em); /* Letra grande */
        color: white;
        text-shadow: 2px 2px rgba(0,0,0,0.2);
    }

    .card.flipped {
        transform: rotateY(180deg);
    }

    .card img {
        max-width: 90%;
        max-height: 90%;
        display: block;
        border-radius: 10px;
        object-fit: contain; /* Importante */
    }

    .card span { /* Estilo general para letras (en back o front si falla img) */
        text-shadow: 2px 2px rgba(0,0,0,0.2);
    }

    /* --- (MODIFICACIÓN 2) --- */
    /* Ahora muestra la cara trasera (letra) al hacer match */
    .card.matched {
        transform: rotateY(0deg) scale(0.95); /* Mantenemos volteada (0deg) */
        cursor: default;
        opacity: 0.7;
         box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Sombra mantenida */
    }
    /* Estilo para ambas caras cuando hacen match */
    .card.matched .front, .card.matched .back {
         background-color: #98D8AA; /* Verde menta */
         border-color: #6EAF8D;
    }


     /* Mensaje de estado */
    #mensaje {
        font-family: 'Fredoka One', cursive;
        position: relative;
        z-index: 2;
        color: #388E3C;
        font-size: clamp(1.2em, 3vw, 1.5em);
        margin-top: 1.5rem;
        min-height: 1.5em;
        text-shadow: 1px 1px #FFD700;
    }

    /* --- ESTILO DEL TEMPORIZADOR --- */
    #timer {
        font-family: 'Fredoka One', cursive;
        font-size: clamp(1.4em, 4vw, 1.8em);
        color: #4682B4; /* Azul para combinar con botón de reinicio */
        text-shadow: 1px 1px #FFFFFF;
        margin-top: 0.5rem;
        font-weight: bold;
        z-index: 2;
        position: relative;
        /* --- (MODIFICACIÓN 1) --- */
        display: none; /* Oculto por defecto */
    }

    /* Mensaje Final */
    #mensajeFinal {
        display: none;
        position: fixed;
        top: 50%; left: 50%;
        transform: translate(-50%, -50%);
        font-family: 'Fredoka One', cursive;
        font-size: clamp(2em, 6vw, 3.5em);
        color: #FF8C69;
        text-shadow: 3px 3px 0px #FFD700;
        z-index: 1001;
        text-align: center;
        padding: 1.5rem;
        background-color: rgba(255, 255, 255, 0.9);
        border-radius: 20px;
        border: 4px dashed #FFD700;
        animation: popIn 0.8s ease-out forwards;
        width: fit-content;
        max-width: 80%;
    }
     @keyframes popIn {
        0% { transform: translate(-50%, -50%) scale(0.5); opacity: 0; }
        70% { transform: translate(-50%, -50%) scale(1.1); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1); }
    }


    /* Confeti Canvas */
    #confetti {
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 1000;
        pointer-events: none;
        display: none;
    }

    /* Burbujas */
    .bubble {
        position: absolute;
        bottom: -150px;
        border-radius: 50%;
        opacity: 0.7;
        animation: subirBubble 10s linear infinite;
        z-index: 1;
        pointer-events: none;
    }
    @keyframes subirBubble {
        0% { transform: translateY(0) scale(1); opacity: 0.7; }
        100% { transform: translateY(-110vh) scale(1.2); opacity: 0; }
    }


     /* Botones de navegación infantiles */
    .navigation-buttons {
        display: none; /* Oculto por defecto */
        gap: 20px;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
        z-index: 10;
        width: 100%;
    }
    .navigation-buttons.show {
        display: flex;
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
    .btn-restart {
        background: linear-gradient(135deg, #87CEFA, #4682B4);
        border: 3px solid #41759E;
    }

    .btn-childish img { height: 1.5em; width: auto; display: block; border-radius: 8px; }
    .btn-childish span { display: block; }


    /* --- Media Queries (AJUSTE RESPONSIVO) --- */

    /* Tablet (y móvil horizontal) */
    @media (max-width: 768px) {
        body { padding: 0.5rem; }
        .main-container { padding: 1.5rem 1rem; width: 95%; }
        .titulo-memorama { font-size: 2.8em; }
        
        /* (AJUSTE) Cambiamos de 4 a 2 columnas para una cuadrícula 2x5, que es simétrica */
        #game-board {
            grid-template-columns: repeat(2, minmax(100px, 1fr)); 
            max-width: 300px; /* Ancho máximo para 2 columnas */
            gap: 15px; /* Espacio entre tarjetas */
        }
        .card { border-radius: 15px; }
         /* Ajustamos tamaño de letra para tablet */
         .card .back { font-size: clamp(2.5em, 7vw, 3.5em); }
        #mensaje { font-size: 1.3em; }
        #timer { font-size: 1.5em; }
        #mensajeFinal { font-size: 2.5em; padding: 1rem; }
        .navigation-buttons {
            flex-direction: column;
            gap: 15px;
            margin-top: 1.5rem;
        }
        .navigation-buttons.show { display: flex; }
        .btn-childish { width: 100%; padding: 1rem 1.5rem; font-size: 1.2em; box-sizing: border-box;}
    }

    /* Móvil (vertical) */
    @media (max-width: 480px) {
        .titulo-memorama { font-size: 2.2em; }
        
        /* (AJUSTE) Mantenemos 2 columnas, pero las hacemos más pequeñas */
        #game-board {
            grid-template-columns: repeat(2, minmax(80px, 1fr));
            max-width: 220px;
            gap: 10px;
        }
        .card { border-radius: 10px;}
        /* (OK) Tamaño de letra para móvil */
        .card .back { font-size: clamp(2em, 7vw, 3.5em); }
        #mensaje { font-size: 1.1em; }
        #timer { font-size: 1.3em; }
        #mensajeFinal { font-size: 2em; }
         .btn-childish { padding: 0.8rem 1rem; font-size: 1.1em; gap: 10px;}
        .btn-childish img { height: 1.3em; }
    }

</style>
</head>
<body>

<div class="main-container">

    <h1 class="titulo-memorama">Memorama Mágico de Vocales</h1>

    <div id="game-board">
        </div>
    <div id="mensaje">¡Encuentra todas las parejas! 🥳</div>
    
    <div id="timer">Tiempo: 1:00</div>

    <div class="navigation-buttons" id="nav-buttons">
        <a href="inicio.html" class="btn-childish btn-menu">
            <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
            <span>Ir al Inicio</span>
        </a>
        <a href="#" class="btn-childish btn-restart" id="btn-restart">
             <img src="https://cdn-icons-png.flaticon.com/512/6097/6097933.png" alt="Volver a Jugar">
            <span>Jugar de Nuevo</span>
        </a>
    </div>

</div>

<canvas id="confetti"></canvas>
<div id="mensajeFinal">🎉 ¡Felicidades, lo lograste! 🎉</div>

<audio id="flipSound" src="https://cdn.pixabay.com/audio/2022/03/15/audio_16db7fb135.mp3" preload="auto"></audio>
<audio id="matchSound" src="https://cdn.pixabay.com/audio/2022/11/17/audio_7065b49869.mp3" preload="auto"></audio>
<audio id="winSound" src="https://cdn.pixabay.com/audio/2022/01/18/audio_735a266a2e.mp3" preload="auto"></audio>
<audio id="timeUpSound" src="https://cdn.pixabay.com/audio/2022/03/10/audio_c61c8a8d4a.mp3" preload="auto"></audio>


<script>
    // --- ELEMENTOS DEL DOM ---
    const gameBoard = document.getElementById('game-board');
    const mensajeDiv = document.getElementById('mensaje');
    const mensajeFinalDiv = document.getElementById('mensajeFinal');
    const restartButton = document.getElementById('btn-restart');
    const navButtons = document.getElementById('nav-buttons');
    const flipSound = document.getElementById('flipSound');
    const matchSound = document.getElementById('matchSound');
    const winSound = document.getElementById('winSound');
    const timeUpSound = document.getElementById('timeUpSound'); // Sonido tiempo fuera
    const confettiCanvas = document.getElementById('confetti');
    const confettiCtx = confettiCanvas.getContext('2d');
    
    // --- Elemento del timer ---
    const timerDisplay = document.getElementById('timer');

    // --- DATOS DEL JUEGO ---
    const vocalesData = <?php echo json_encode($vocales); ?>;
    const palabraPorVocal = vocalesData.reduce((map, vocal) => {
        map[vocal.letra] = vocal.palabra;
        return map;
    }, {});

    const numPairs = vocalesData.length;
    let cardsArray = [];
    let flippedCards = [];
    let matchedCount = 0;
    let lockBoard = false;

    // --- Variables del timer ---
    let timerInterval = null;
    let timeRemaining = 60; // 60 segundos
    
    // --- (MODIFICACIÓN 1) ---
    // Variable para rastrear si es el primer juego
    let isFirstGame = true;

    // --- FUNCIONES DEL JUEGO ---

    function shuffle(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function createBoard() {
        // --- Detener timer anterior ---
        stopTimer();
        
        // --- (MODIFICACIÓN 1) ---
        // Lógica del temporizador
        if (isFirstGame) {
            // Si es el primer juego, nos aseguramos que el timer esté oculto
            timerDisplay.style.display = 'none';
            isFirstGame = false; // Marcamos que el primer juego ya pasó
        } else {
            // Si NO es el primer juego (es un reinicio), mostramos y activamos el timer
            timerDisplay.style.display = 'block'; // Mostrar timer
            timeRemaining = 60;
            timerDisplay.textContent = 'Tiempo: 1:00'; // Resetear visualmente
            timerDisplay.style.color = '#4682B4'; // Color normal
            startTimer(); // Iniciar el timer
        }
        
        // --- Resto del reseteo del tablero ---
        gameBoard.innerHTML = '';
        flippedCards = [];
        matchedCount = 0;
        lockBoard = false;
        mensajeDiv.textContent = '¡Encuentra todas las parejas! 🥳';
        mensajeFinalDiv.style.display = 'none';
        mensajeFinalDiv.textContent = '🎉 ¡Felicidades, lo lograste! 🎉'; 
        navButtons.classList.remove('show');
        stopConfettiAnimation();

        cardsArray = [];
        vocalesData.forEach(vocal => {
             cardsArray.push({ value: vocal.letra, img: vocal.img, id: `${vocal.letra}-1` }); // Par 1
             cardsArray.push({ value: vocal.letra, img: vocal.img, id: `${vocal.letra}-2` }); // Par 2
        });

        const shuffledCards = shuffle(cardsArray);

        const fragment = document.createDocumentFragment();
        shuffledCards.forEach((cardData) => {
            const cardElement = document.createElement('div');
            cardElement.className = 'card';
            cardElement.dataset.value = cardData.value;
            cardElement.dataset.id = cardData.id;


            const backFace = document.createElement('div');
            backFace.className = 'back';
            const span = document.createElement('span');
            span.textContent = cardData.value;
            backFace.appendChild(span);


            const frontFace = document.createElement('div');
            frontFace.className = 'front';
            const img = document.createElement('img');
            img.src = cardData.img; // Usa la URL de la imagen
            img.alt = `Imagen de ${cardData.value}`;
            img.loading = 'lazy';
            img.onerror = function() {
                // Respaldo: mostrar letra si falla imagen
                frontFace.innerHTML = `<span>${cardData.value}</span>`;
                const errorSpan = frontFace.querySelector('span');
                 if(errorSpan) errorSpan.style.cssText = 'font-size: 1.5em; color: #555;';
            };
            frontFace.appendChild(img);


            cardElement.appendChild(backFace);
            cardElement.appendChild(frontFace);

            cardElement.addEventListener('click', flipCard);
            fragment.appendChild(cardElement);
        });
        gameBoard.appendChild(fragment);

        // (NOTA: Ya no iniciamos el timer aquí, se hace en el bloque condicional de arriba)
    }

    function flipCard() {
        if (lockBoard || this.classList.contains('flipped') || this.classList.contains('matched')) return;

        this.classList.add('flipped');
        playSound(flipSound);

        flippedCards.push(this);

        if (flippedCards.length === 2) {
            lockBoard = true;
            checkMatch();
        }
    }

    function checkMatch() {
        const [card1, card2] = flippedCards;
        const isMatch = card1.dataset.value === card2.dataset.value;
        const letra = card1.dataset.value;

        if (isMatch) {
            const palabra = palabraPorVocal[letra] || '';
            mensajeDiv.textContent = `¡Bien! ${letra} ${palabra ? 'de ' + palabra : ''} 🎉`;
            playSound(matchSound);
            hablar(`${letra} de ${palabra}`);
            matchedCount++;
            disableCards(); 
            if (matchedCount === numPairs) {
                // --- Detener el timer al ganar ---
                stopTimer();
                setTimeout(gameOver, 800);
            }
        } else {
            mensajeDiv.textContent = 'Intenta otra vez 😅';
            unflipCards();
        }
    }

    function disableCards() {
        flippedCards.forEach(card => {
            card.classList.add('matched');
        });
        if (matchedCount < numPairs) {
            resetTurn();
        }
    }


    function unflipCards() {
        requestAnimationFrame(() => {
            setTimeout(() => {
                flippedCards.forEach(card => {
                    if (!card.classList.contains('matched')) {
                        card.classList.remove('flipped');
                    }
                });
                resetTurn();
            }, 1000);
        });
    }

    function resetTurn() {
        flippedCards = [];
        lockBoard = false;
    }

    function gameOver() {
         mensajeDiv.textContent = '¡Felicidades! 🥳 ¡Encontraste todas!';
         playSound(winSound);
         mensajeFinalDiv.style.display = 'block';
         navButtons.classList.add('show');
         startConfettiAnimation();
         lockBoard = true; // Bloqueo final
    }

    // --- FUNCIONES DEL TEMPORIZADOR ---

    function stopTimer() {
        if (timerInterval) {
            clearInterval(timerInterval);
            timerInterval = null;
        }
    }

    function updateTimerDisplay() {
        const minutes = Math.floor(timeRemaining / 60);
        const seconds = timeRemaining % 60;
        timerDisplay.textContent = `Tiempo: ${minutes}:${seconds.toString().padStart(2, '0')}`;
        
        // Poner en rojo los últimos 10 seg
        if (timeRemaining <= 10) {
            timerDisplay.style.color = '#D32F2F'; // Rojo
        }
    }

    function startTimer() {
        stopTimer(); // Asegurarse de que no haya timers duplicados
        
        timerInterval = setInterval(() => {
            timeRemaining--;
            updateTimerDisplay();

            if (timeRemaining <= 0) {
                timeUp();
            }
        }, 1000);
    }

    function timeUp() {
        stopTimer();
        lockBoard = true;
        mensajeDiv.textContent = '¡Oh no! 😟 Se acabó el tiempo.';
        // --- Mensaje final de tiempo agotado ---
        mensajeFinalDiv.textContent = '¡Inténtalo de nuevo! ⏰';
        mensajeFinalDiv.style.display = 'block';
        navButtons.classList.add('show'); // Mostrar botones
        playSound(timeUpSound); // Reproducir sonido de "perder"
    }

    // --- FIN DE FUNCIONES DEL TEMPORIZADOR ---


    function hablar(texto) {
        if ('speechSynthesis' in window && texto) {
            try {
                speechSynthesis.cancel();
                const voz = new SpeechSynthesisUtterance(texto);
                voz.lang = 'es-MX';
                voz.rate = 0.95; 
                voz.pitch = 1.3;  
                speechSynthesis.speak(voz);
            } catch (error) { /* Silencio */ }
        }
    }


    function playSound(audioElement) {
        if(audioElement && typeof audioElement.play === 'function') {
            audioElement.currentTime = 0;
            audioElement.volume = 0.4;
            audioElement.play().catch(e => { /* Silencio */ });
        }
    }

    // --- Burbujas ---
    function createBubbles() {
        const body = document.body;
        body.querySelectorAll('.bubble').forEach(b => b.remove());
        const fragment = document.createDocumentFragment();
        for (let i = 0; i < 20; i++) {
            const bubble = document.createElement("div");
            bubble.className = "bubble";
            const size = Math.random() * 50 + 15;
            bubble.style.cssText = `
                width: ${size}px; height: ${size}px;
                left: ${Math.random() * 100}vw;
                background: hsla(${Math.random()*360}, 80%, 75%, 0.6);
                animation-duration: ${Math.random() * 8 + 7}s;
                animation-delay: ${Math.random() * 4}s;
            `;
            fragment.appendChild(bubble);
        }
        body.insertBefore(fragment, body.firstChild);
    }

    // --- Confeti ---
    let confettiAnimationId = null;
    let pieces = [];
    const numberOfPieces = 120;
    let width, height;

    const confettiColors = ['#FF8C69', '#98D8AA', '#87CEFA', '#C3A9E1', '#FFB74D', '#FFD700'];
    function randomColorConfetti() {
        return confettiColors[Math.floor(Math.random() * confettiColors.length)];
    }

    function resizeConfetti() {
        if (!confettiCanvas) return;
        width = window.innerWidth;
        height = window.innerHeight;
        confettiCanvas.width = width;
        confettiCanvas.height = height;
    }

    function initConfetti() {
        pieces = [];
        if (typeof width === 'undefined' || typeof height === 'undefined') { resizeConfetti(); }
        for (let i = 0; i < numberOfPieces; i++) {
            pieces.push({
                x: Math.random() * width, y: Math.random() * height - height,
                radius: Math.random() * 7 + 4, color: randomColorConfetti(),
                velocity: Math.random() * 3.5 + 2.5, tilt: Math.random() * 15 - 7.5,
                opacity: Math.random() * 0.4 + 0.5
            });
        }
    }

    function drawConfetti() {
         if (!confettiCtx) return;
        confettiCtx.clearRect(0, 0, width, height);
        for (const p of pieces) {
            confettiCtx.save();
            confettiCtx.globalAlpha = p.opacity;
            confettiCtx.beginPath();
            confettiCtx.arc(p.x, p.y, p.radius, 0, Math.PI * 2, false);
            confettiCtx.fillStyle = p.color;
            confettiCtx.fill();
            confettiCtx.restore();
        }
        updateConfetti();
    }

     function updateConfetti() {
         if (typeof height === 'undefined') return;
        for (let i = 0; i < pieces.length; i++) {
            const p = pieces[i];
            p.y += p.velocity;
            p.x += Math.sin(p.y * 0.1 + i) * 1.5;
             if (p.y > height - 40) p.opacity -= 0.025;
            if (p.y > height + p.radius || p.opacity <= 0) {
                 p.y = -p.radius; p.x = Math.random() * width;
                 p.opacity = Math.random() * 0.4 + 0.5;
                 p.velocity = Math.random() * 3.5 + 2.5;
            }
        }
    }

    function loopConfetti() {
        drawConfetti();
        confettiAnimationId = requestAnimationFrame(loopConfetti);
    }

    function startConfettiAnimation() {
         if (!confettiCanvas) return;
        stopConfettiAnimation();
        resizeConfetti();
        initConfetti();
        confettiCanvas.style.display = 'block';
        loopConfetti();
    }

    function stopConfettiAnimation() {
         if (confettiAnimationId) {
            cancelAnimationFrame(confettiAnimationId);
            confettiAnimationId = null;
         }
         if (confettiCtx && typeof width !== 'undefined' && typeof height !== 'undefined') {
             confettiCtx.clearRect(0, 0, width, height);
         }
         if (confettiCanvas) confettiCanvas.style.display = 'none';
    }

    window.addEventListener('resize', resizeConfetti, { passive: true });

    // --- INICIALIZACIÓN ---
    createBubbles();
    createBoard(); // Inicia el primer juego (sin timer)

    restartButton.addEventListener('click', (e) => {
        e.preventDefault();
        createBoard(); // Reinicia el tablero (ahora sí con timer)
    });

</script>

</body>
</html>
