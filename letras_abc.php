<?php
// --- SECCIÓN PHP (Sin cambios) ---
$letters = [
    ['A','Águila'],
    ['B','Ballena'],
    ['C','Conejo'],
    ['D','Delfín'],
    ['E','Elefante'],
    ['F','Foca'],
    ['G','Gato'],
    ['H','Hipopótamo'],
    ['I','Iguana'],
    ['J','Jirafa'],
    ['K','Koala'],
    ['L','León'],
    ['M','Mono'],
    ['N','Nutria'],
    ['O','Oso'],
    ['P','Perro'],
    ['Q','Quetzal'],
    ['R','Ratón'],
    ['S','Serpiente'],
    ['T','Tigre'],
    ['U','Urraca'],
    ['V','Vaca'],
    ['W','Wapití'],
    ['X','Xoloitzcuintle'],
    ['Y','Yacaré'],
    ['Z','Zorro']
];
shuffle($letters);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>¡Atrapa el Abecedario Mágico! ✨</title>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
<style>
    /* ... (Todo el CSS anterior se mantiene igual) ... */
    
    /* Fuentes divertidas para niños */
    body {
        margin: 0;
        font-family: 'Open Sans', sans-serif; /* Texto general */
        /* --- (CAMBIO) Verde de fondo más suave --- */
        background: linear-gradient(180deg, #87CEEB 0%, #ADD8E6 50%, #a8e6cf 100%); /* Cielo a pasto suave */
        text-align: center;
        padding: 1rem;
        overflow-x: hidden;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    /* Contenedor principal estilo "tarjeta flotante" */
    .main-container {
        max-width: 950px;
        width: 100%;
        margin: 1rem auto;
        background: linear-gradient(145deg, #FFFBDA, #FFFFFF); /* Fondo cremoso y cálido */
        border-radius: 30px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2), 0 0 0 8px rgba(255, 255, 255, 0.7);
        padding: 2rem;
        border: 4px solid #FFD700; /* Borde dorado brillante (Este se mantiene, es cálido) */
        position: relative;
        z-index: 10;
        animation: floatEffect 3s ease-in-out infinite;
    }

    @keyframes floatEffect {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }

    /* Título principal con fuente grande y divertida */
    h1 {
        font-family: 'Fredoka One', cursive;
        font-size: 3.5em;
        /* --- (CAMBIO) Rosa neón a Coral suave --- */
        color: #FF8C69; /* Coral suave */
        text-shadow: 4px 4px 0px #FFD700, 6px 6px 0px #87CEEB; /* Borde amarillo y azul */
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
        animation: pulseTitle 2s infinite alternate;
    }

    @keyframes pulseTitle {
        from { transform: scale(1); }
        to { transform: scale(1.05); }
    }

    /* Área de juego: un lienzo verde con nubes */
    #game-area {
        position: relative;
        width: 95%;
        height: 60vh;
        margin: 2rem auto 1.5rem;
        background: linear-gradient(to bottom, #87CEEB 0%, #ADD8E6 20%, #B0E0E6 40%, #E0FFFF 100%); /* Fondo de cielo suave (Este está bien) */
        border-radius: 25px;
        border: 5px dashed #FFD700;
        overflow: hidden;
        box-shadow: inset 0 0 15px rgba(0,0,0,0.1);
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Las letras voladoras: más gordas y coloridas */
    .letter {
        position: absolute;
        font-family: 'Fredoka One', cursive;
        font-size: 3.5em;
        font-weight: bold;
        color: #FFFFFF;
        padding: 15px 20px;
        border-radius: 50%;
        cursor: pointer;
        user-select: none;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        transition: transform 0.1s ease-out;
        border: 4px solid rgba(255,255,255,0.7);
        background: radial-gradient(circle at 30% 30%, #FFD700, #FFA500); /* Color base (Naranja/Amarillo) */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 80px;
        height: 80px;
    }
    .letter::after {
        content: '';
        position: absolute;
        top: 10%;
        left: 10%;
        width: 80%;
        height: 80%;
        background: radial-gradient(circle, rgba(255,255,255,0.8) 0%, transparent 70%);
        border-radius: 50%;
        opacity: 0.6;
    }

    /* --- (CAMBIO) Paleta de colores más suave para las burbujas --- */
    
    /* Red -> Coral suave */
    .letter[data-color="red"] { background: radial-gradient(circle at 30% 30%, #FF8C69, #E07A5F); border-color: rgba(255, 160, 140, 0.7); }
    /* Green -> Menta suave */
    .letter[data-color="green"] { background: radial-gradient(circle at 30% 30%, #98D8AA, #6EAF8D); border-color: rgba(180, 230, 190, 0.7); }
    /* Blue -> (Este ya era suave) */
    .letter[data-color="blue"] { background: radial-gradient(circle at 30% 30%, #87CEFA, #4682B4); border-color: rgba(150,200,250,0.7); }
    /* Purple -> Lavanda suave */
    .letter[data-color="purple"] { background: radial-gradient(circle at 30% 30%, #C3A9E1, #9A86B3); border-color: rgba(210, 190, 230, 0.7); }
    /* Orange -> Durazno suave */
    .letter[data-color="orange"] { background: radial-gradient(circle at 30% 30%, #FFB74D, #FB8C00); border-color: rgba(255, 200, 120, 0.7); }


    .letter:hover { transform: scale(1.15); }
    .letter:active { transform: scale(1.05) translateY(3px); box-shadow: 0 4px 10px rgba(0,0,0,0.2); }

    /* Estilos de puntuación */
    #score {
        font-family: 'Fredoka One', cursive;
        font-size: 2.5em;
        font-weight: bold;
        /* --- (CAMBIO) Verde más oscuro y menos saturado --- */
        color: #388E3C; /* Verde bosque */
        text-shadow: 2px 2px 0px #FFD700;
        margin-bottom: 1rem;
    }
    
    #final-message {
        font-family: 'Fredoka One', cursive;
        font-size: 2.8em;
        /* --- (CAMBIO) Rosa neón a Coral suave --- */
        color: #FF8C69; /* Coral suave */
        text-shadow: 3px 3px 0px #FFD700;
        margin: 1.5rem auto;
        padding: 1rem;
        background-color: rgba(255,255,255,0.8);
        border-radius: 20px;
        border: 3px dashed #FFD700;
        animation: popIn 0.8s ease-out forwards;
        display: flex;
        justify-content: center;
        align-items: center;
        width: fit-content;
        max-width: 90%;
    }

    @keyframes popIn {
        0% { transform: scale(0.5); opacity: 0; }
        70% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); }
    }

    /* Confeti (sin cambios) */
    canvas.confetti {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 999;
    }

    /* Botones de navegación con el nuevo estilo infantil */
    .navigation-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        margin-top: 2rem;
        flex-wrap: wrap;
        z-index: 10;
    }
    
    /* --- (MODIFICADO) --- */
    .btn-childish {
        font-family: 'Fredoka One', cursive;
        font-size: 1.5em;
        font-weight: bold;
        border: none;
        border-radius: 15px;
        /* (CAMBIO) Ajuste de padding */
        padding: 1rem 2rem; 
        transition: all 0.2s ease-out;
        cursor: pointer;
        user-select: none;
        text-decoration: none;
        color: #FFFFFF;
        box-shadow: 0 8px 0 0 rgba(0,0,0,0.3);
        position: relative;
        top: 0;
        /* (CAMBIO) Añadido Flexbox */
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 15px; /* Espacio entre imagen y texto */
    }

    .btn-childish:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 0 0 rgba(0,0,0,0.3);
    }

    .btn-childish:active {
        transform: translateY(3px);
        box-shadow: 0 2px 0 0 rgba(0,0,0,0.3);
    }

    /* --- (CAMBIO) Colores de botones más suaves --- */
    .btn-menu {
        /* Verde Menta */
        background: linear-gradient(135deg, #98D8AA, #6EAF8D);
        border: 3px solid #5A8F73;
    }
    
    /* --- ¡NUEVO! Color para el botón de reiniciar --- */
    .btn-restart {
        /* Azul Cielo Suave */
        background: linear-gradient(135deg, #87CEFA, #4682B4);
        border: 3px solid #41759E;
        flex-direction: row-reverse; /* Pone la imagen a la derecha */
    }

    .btn-next-game {
        /* Coral Suave */
        background: linear-gradient(135deg, #FF8C69, #E07A5F);
        border: 3px solid #B5654D;
        display: none;
        /* (CAMBIO) Para poner la imagen a la derecha */
        flex-direction: row-reverse;
    }

    /* --- ¡NUEVO! CSS para las imágenes dentro de los botones --- */
    .btn-childish img {
        height: 1.5em; /* La altura se basa en el tamaño de la fuente */
        width: auto;
        display: block;
        /* ¡NUEVO! Para que las imágenes con fondo blanco se vean bien */
        border-radius: 8px; 
    }
    
    .btn-childish span {
        display: block;
    }
    /* --- Fin de CSS Nuevo --- */


    /* Estrellita de recompensa (sin cambios) */
    .estrellita {
        position: absolute;
        font-size: 50px;
        animation: subirPop 1.5s ease-out forwards;
        z-index: 100;
        pointer-events: none;
        text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
    }

    @keyframes subirPop {
        0% { opacity: 1; transform: translateY(0) scale(1); }
        50% { transform: translateY(-50px) scale(1.3); }
        100% { opacity: 0; transform: translateY(-120px) scale(1.5); }
    }
    
    /* Nubes de fondo (sin cambios) */
    .cloud {
        position: absolute;
        background: #fff;
        border-radius: 50%;
        box-shadow: 0 0 15px rgba(255,255,255,0.8);
        opacity: 0.8;
        animation: moveClouds 20s linear infinite;
    }
    .cloud:nth-child(1) { width: 100px; height: 60px; top: 10%; left: -10%; animation-delay: 0s; transform: scale(0.8); }
    .cloud:nth-child(2) { width: 150px; height: 90px; top: 30%; right: -15%; animation-delay: 5s; transform: scale(1.2); }
    .cloud:nth-child(3) { width: 80px; height: 50px; bottom: 20%; left: -5%; animation-delay: 10s; transform: scale(0.7); }
    .cloud:nth-child(4) { width: 120px; height: 70px; top: 50%; right: -10%; animation-delay: 15s; transform: scale(1); }

    .cloud::before, .cloud::after {
        content: '';
        position: absolute;
        background: #fff;
        border-radius: 50%;
    }
    .cloud::before {
        width: 60%; height: 60%; top: -30%; left: 20%;
    }
    .cloud::after {
        width: 80%; height: 80%; top: -10%; right: -10%;
    }

    @keyframes moveClouds {
        0% { transform: translateX(-100%) scale(var(--scale, 1)); }
        100% { transform: translateX(calc(100% + var(--width, 150px))) scale(var(--scale, 1)); }
    }


    /* Media Queries para Responsividad (Sin cambios) */
    @media (max-width: 768px) {
        body {
            padding: 0.5rem;
        }
        .main-container {
            padding: 1rem;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15), 0 0 0 5px rgba(255, 255, 255, 0.7);
        }
        h1 {
            font-size: 2.5em;
            text-shadow: 3px 3px 0px #FFD700, 4px 4px 0px #87CEEB;
            margin-bottom: 1rem;
        }
        #score {
            font-size: 2em;
        }
        #game-area {
            height: 55vh;
            margin: 1.5rem auto 1rem;
            border-radius: 20px;
            border: 4px dashed #FFD700;
        }
        .letter {
            font-size: 2.8em;
            padding: 10px 15px;
            width: 70px;
            height: 70px;
            border: 3px solid rgba(255,255,255,0.7);
        }
        .letter::after {
            top: 5%; left: 5%; width: 90%; height: 90%;
        }
        #final-message {
            font-size: 2.2em;
            padding: 0.8rem;
            border: 2px dashed #FFD700;
        }
        .navigation-buttons {
            flex-direction: column;
            gap: 15px;
            margin-top: 1.5rem;
        }
        .btn-childish {
            width: 100%;
            /* (CAMBIO) padding en móvil */
            padding: 1rem 1.5rem; 
            font-size: 1.2em;
            box-sizing: border-box; /* Importante para que el padding no rompa el ancho */
        }
        /* ¡NUEVO! Ajuste para móviles */
        .btn-restart {
            flex-direction: row; /* En móvil, ponemos la imagen a la izquierda para reiniciar */
        }
        .btn-next-game {
            flex-direction: row-reverse; /* Mantenemos la flecha a la derecha */
        }
        
        .estrellita {
            font-size: 40px;
        }
        .cloud:nth-child(1) { width: 80px; height: 50px; }
        .cloud:nth-child(2) { width: 120px; height: 70px; }
        .cloud:nth-child(3) { width: 60px; height: 40px; }
        .cloud:nth-child(4) { width: 100px; height: 60px; }
    }

</style>
</head>
<body>

<div class="main-container">

    <h1>¡Atrapa el Abecedario Mágico! ✨</h1>
    <div id="score">Puntuación: 0</div>
    
    <div id="game-area">
        <div class="cloud" style="--scale:0.8; --width:100px;"></div>
        <div class="cloud" style="--scale:1.2; --width:150px; animation-delay:5s; animation-duration:25s;"></div>
        <div class="cloud" style="--scale:0.7; --width:80px; animation-delay:10s; animation-duration:18s;"></div>
        <div class="cloud" style="--scale:1; --width:120px; animation-delay:15s; animation-duration:22s;"></div>
    </div>
    
    <div id="final-message"></div>

    <div class="navigation-buttons">
        <a href="inicio.html" class="btn-childish btn-menu">
            <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
            <span>Ir al Inicio</span>
        </a>
        
        <a href="#" class="btn-childish btn-restart" id="btn-restart">
             <img src="https://cdn.pixabay.com/photo/2023/02/07/00/42/return-7772977_1280.png" alt="Volver a Jugar">
            <span>Jugar de Nuevo</span>
        </a>
        
        <a href="siguiente_juego.html" class="btn-childish btn-next-game" id="btn-next">
            <img src="https://www.nicepng.com/png/detail/80-803298_boton-de-siguiente-png.png" alt="Siguiente">
            <span>¡Siguiente Reto!</span>
        </a>
    </div>
    </div>

<canvas id="confetti" class="confetti"></canvas>

<audio id="bg-music" src="https://cdn.pixabay.com/audio/2022/05/27/audio_1878f0434c.mp3" loop preload="auto"></audio>


<script>
// --- SELECCIÓN DE ELEMENTOS ---
const gameArea = document.getElementById('game-area');
const scoreDisplay = document.getElementById('score');
const confettiCanvas = document.getElementById('confetti');
const confettiCtx = confettiCanvas.getContext('2d');
const finalMessage = document.getElementById('final-message');
const nextButton = document.getElementById('btn-next');
const bgMusic = document.getElementById('bg-music');
const restartButton = document.getElementById('btn-restart'); // ¡NUEVO!

let score = 0;
let targetIndex = 0;
const letters = <?= json_encode($letters) ?>;

// --- Colores para las burbujas (más infantil) ---
const letterColors = ["red", "green", "blue", "purple", "orange"];

// --- Funciones de Confeti y Redimensión ---
confettiCanvas.width = window.innerWidth;
confettiCanvas.height = window.innerHeight;
window.addEventListener('resize', () => {
    confettiCanvas.width = window.innerWidth;
    confettiCanvas.height = window.innerHeight;
});

let confettiParticles = [];
function startConfetti(){
    confettiParticles=[];
    const W = confettiCanvas.width;
    const H = confettiCanvas.height;
    for(let i=0;i<200;i++){
        confettiParticles.push({
            x:Math.random()*W,
            y:Math.random()*H-H,
            vx:(Math.random()-0.5)*5,
            vy:Math.random()*5+2,
            size:Math.random()*6+4,
            color:`hsl(${Math.random()*360},80%,60%)`
        });
    }
    requestAnimationFrame(confettiLoop);
}
function confettiLoop(){
    confettiCtx.clearRect(0,0,confettiCanvas.width, confettiCanvas.height);
    confettiParticles.forEach(p=>{
        p.x+=p.vx;
        p.y+=p.vy;
        confettiCtx.fillStyle=p.color;
        confettiCtx.beginPath();
        confettiCtx.arc(p.x,p.y,p.size,0,Math.PI*2);
        confettiCtx.fill();
    });
    confettiParticles = confettiParticles.filter(p=>p.y<confettiCanvas.height+50);
    if(confettiParticles.length>0) requestAnimationFrame(confettiLoop);
}

// --- Funciones de Audio ---
function playLetter(letterObj){
    if ('speechSynthesis' in window) {
        speechSynthesis.cancel();
        const text = letterObj[0] + " de " + letterObj[1];
        const utterance = new SpeechSynthesisUtterance(text);
        utterance.lang = 'es-ES';
        utterance.rate = 1; 
        utterance.pitch = 1.2;
        speechSynthesis.speak(utterance);
    }
}

function playSound(){
    try {
        const audioCtx = new (window.AudioContext||window.webkitAudioContext)();
        const oscillator = audioCtx.createOscillator();
        const gain = audioCtx.createGain();
        oscillator.type='sine';
        oscillator.frequency.value=600; 
        gain.gain.value=0.2; 
        oscillator.connect(gain);
        gain.connect(audioCtx.destination);
        oscillator.start();
        oscillator.stop(audioCtx.currentTime + 0.15);
    } catch(e) {
        console.log("Error al reproducir sonido:", e);
    }
}

// --- Función Estrellita ---
function lanzarEstrellita(elemento) {
    const estrella = document.createElement('div');
    estrella.textContent = '⭐';
    estrella.className = 'estrellita';
    const rect = elemento.getBoundingClientRect();
    estrella.style.left = (rect.left + rect.width / 2 - 25) + 'px';
    estrella.style.top = (rect.top + window.scrollY - 40) + 'px';
    document.body.appendChild(estrella);
    setTimeout(() => estrella.remove(), 1500);
}

// --- Lógica del Juego ---
function createLetter(){
    if(targetIndex >= letters.length) {
        showMessage();
        return;
    }
    
    const letterObj = letters[targetIndex];
    const letterDiv = document.createElement('div');
    letterDiv.className = 'letter';
    letterDiv.textContent = letterObj[0];
    letterDiv.dataset.color = letterColors[Math.floor(Math.random() * letterColors.length)];
    
    const x = Math.random() * (gameArea.offsetWidth - 100);
    letterDiv.style.left = `${x}px`;
    letterDiv.style.top = `-120px`;
    gameArea.appendChild(letterDiv);

    const speed = 1.5 + Math.random()*2.5;
    const interval = setInterval(()=>{
        let top = parseFloat(letterDiv.style.top);
        if(top + speed < gameArea.offsetHeight + 100){
            letterDiv.style.top = (top + speed) + 'px';
        } else {
            gameArea.removeChild(letterDiv);
            clearInterval(interval);
            targetIndex++; 
            createLetter();
        }
    },20);

    letterDiv.addEventListener('click',()=>{
        
        if (bgMusic.paused) {
            bgMusic.volume = 0.3;
            bgMusic.play().catch(e => console.log("La música no se pudo iniciar:", e));
        }

        playLetter(letterObj);
        
        score++;
        scoreDisplay.textContent = 'Puntuación: ' + score;
        
        playSound();
        lanzarEstrellita(letterDiv);
        
        gameArea.removeChild(letterDiv);
        clearInterval(interval);
        targetIndex++;
        
        if(targetIndex === letters.length){
            showMessage();
        } else {
            createLetter();
        }
    });
}

// --- Mensaje Final ---
function showMessage(){
    gameArea.innerHTML = ''; 
    const messageDiv = document.createElement('div');
    messageDiv.id = 'final-message';
    messageDiv.textContent = "¡Lo lograste! ¡Completaste el Abecedario! 🎉";
    gameArea.appendChild(messageDiv);

    nextButton.style.display = 'inline-block';
    if (window.innerWidth <= 768) {
        nextButton.style.display = 'block';
    }

    startConfetti();
    playLetter({0: 'Felicidades', 1: 'Completaste el abecedario'});
    
    // Opcional: Detener la música al final
    // bgMusic.pause();
}

// Inicia juego
createLetter();

// ¡NUEVO! Event listener para reiniciar
restartButton.addEventListener('click', (e) => {
    e.preventDefault(); // Evita que el enlace '#' navegue
    location.reload(); // Recarga la página para reiniciar el juego
});
</script>

</body>
</html>
