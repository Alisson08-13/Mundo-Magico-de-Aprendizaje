<?php
include("conexion.php");

// Guardar avance en la base de datos (si se envía por POST)
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $tipo = $_POST['tipo'] ?? 'Niño';
    $puntaje = intval($_POST['puntaje'] ?? 0);
    $nivel = "Abecedario";

    $sql = "INSERT INTO avances (nombre, tipo_usuario, nivel, progreso)
            VALUES ('$nombre', '$tipo', '$nivel', '$puntaje')
            ON DUPLICATE KEY UPDATE progreso = '$puntaje', fecha = NOW()";
    $conn->query($sql);
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>¡Juego del Abecedario! 🔤</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700;900&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap');

    body {
      font-family: 'Nunito', sans-serif;
      background: linear-gradient(135deg, #f0f4f8, #ffffff, #f0f4f8);
      background-size: 400% 400%;
      animation: bgShine 15s ease infinite;
      text-align: center;
      margin: 0;
      padding: 1.5rem;
      overflow-x: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      flex-direction: column;
    }

    .main-container {
      max-width: 900px;
      width: 100%;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 24px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 1.5rem 2rem;
    }

    h1 {
      font-weight: 900;
      font-size: 2.8em;
      color: #3b82f6;
      margin-bottom: 1rem;
      border-bottom: 4px solid #facc15;
      padding-bottom: 0.5rem;
    }

    .game-stats {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      gap: 1rem;
      background: #f0f4f8;
      padding: 1rem;
      border-radius: 16px;
      margin-bottom: 1.5rem;
    }

    .stat-item {
      font-size: 1.5em;
      font-weight: 700;
      color: #1d4ed8;
    }

    #letraObjetivo {
      color: #3b82f6;
      font-weight: 900;
      font-size: 1.3em;
      background: #fff;
      padding: 5px 15px;
      border-radius: 10px;
      box-shadow: 0 4px 0 #facc15;
    }

    .btn-3d {
      font-family: 'Nunito', sans-serif;
      font-weight: 700;
      border: none;
      border-radius: 12px;
      padding: 1rem;
      transition: all 0.15s ease;
      cursor: pointer;
      user-select: none;
      box-shadow: 0 5px 0 0 var(--shadow-color, #00000030);
      position: relative;
      overflow: hidden;
    }

    .btn-3d::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 75%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
      transform: skewX(-25deg);
      transition: left 0.5s ease;
    }

    .btn-3d:hover::before { left: 150%; }
    .btn-3d:active { transform: translateY(3px); box-shadow: 0 2px 0 0 var(--shadow-color, #00000030); }

    .btn-3d.shake { animation: shake 0.5s ease-in-out; }

    .letter-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
      gap: 15px;
      margin-top: 1.5rem;
    }

    .letter-btn {
      font-size: 2.5em;
      animation: popIn 0.4s ease-out forwards;
      opacity: 0;
    }

    .color-1 { background: #fecaca; color: #b91c1c; --shadow-color: #b91c1c; }
    .color-2 { background: #bbf7d0; color: #166534; --shadow-color: #166534; }
    .color-3 { background: #bfdbfe; color: #1e40af; --shadow-color: #1e40af; }
    .color-4 { background: #fed7aa; color: #b45309; --shadow-color: #b45309; }
    .color-5 { background: #e9d5ff; color: #581c87; --shadow-color: #581c87; }

    #mensaje {
      font-size: 1.5rem;
      margin-top: 1.5rem;
      min-height: 2.2rem;
      font-weight: 700;
    }

    #reiniciarBtn {
      font-size: 1.3em;
      background: #facc15;
      color: #a16207;
      --shadow-color: #a16207;
      margin-top: 1.5rem;
    }

    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      20%, 60% { transform: translateX(-8px); }
      40%, 80% { transform: translateX(8px); }
    }

    @keyframes bgShine {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    @keyframes popIn {
      0% { opacity: 0; transform: scale(0.5); }
      100% { opacity: 1; transform: scale(1); }
    }

    @keyframes correctPulse {
      0% { transform: scale(1); }
      50% { transform: scale(1.15); box-shadow: 0 0 20px var(--shadow-color); }
      100% { transform: scale(1); }
    }

    .letter-btn.correct { animation: correctPulse 0.4s ease-out; }

    .navigation-buttons {
      display: flex;
      justify-content: center;
      gap: 25px;
      margin-top: 2rem;
      flex-wrap: wrap;
    }

    .btn-childish {
      font-family: 'Fredoka One', cursive;
      font-size: 1.5em;
      font-weight: bold;
      border: none;
      border-radius: 15px;
      padding: 1.2rem 2.5rem;
      transition: all 0.2s ease-out;
      cursor: pointer;
      user-select: none;
      text-decoration: none;
      color: #FFFFFF;
      box-shadow: 0 8px 0 0 rgba(0,0,0,0.3);
      position: relative;
      top: 0;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 15px;
    }
    .btn-childish:hover { transform: translateY(-5px); box-shadow: 0 12px 0 0 rgba(0,0,0,0.3); }
    .btn-childish:active { transform: translateY(3px); box-shadow: 0 2px 0 0 rgba(0,0,0,0.3); }
    .btn-menu { background: linear-gradient(135deg, #98D8AA, #6EAF8D); border: 3px solid #5A8F73; }
    .btn-reiniciar { background: linear-gradient(135deg, #FFD580, #FFB347); border: 3px solid #ECA13C; }
    .btn-childish img { height: 1.5em; width: auto; border-radius: 8px; }
  </style>
</head>
<body>

  <!-- sonidos -->
  <audio id="sonido-correcto" src="https://cdn.pixabay.com/audio/2022/03/15/audio_166d73e21a.mp3" preload="auto"></audio>
  <audio id="sonido-incorrecto" src="https://cdn.pixabay.com/audio/2022/03/10/audio_c8c8a67930.mp3" preload="auto"></audio>
  <audio id="sonido-victoria" src="https://cdn.pixabay.com/audio/2022/11/20/audio_161208119c.mp3" preload="auto"></audio>

  <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>

  <!-- CUADRO PRINCIPAL -->
  <div class="main-container">
    <h1>¡Juego del Abecedario! 🔤</h1>

    <header class="game-stats">
      <div class="stat-item">Puntaje: <span id="puntaje">0</span></div>
      <div class="stat-item">Escucha: <span id="letraObjetivo">—</span></div>
      <div class="stat-item">Tiempo: <span id="tiempo">60</span></div>
    </header>

    <div id="letter-grid" class="letter-grid"></div>
    <div id="mensaje">¡Toca la letra correcta!</div>
  </div>

  <!-- BOTONES ABAJO -->
  <div class="navigation-buttons">
        <a href="inicio.html" class="btn-childish btn-menu">
      <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
      <span>Ir al Inicio</span>
    </a>
    <button id="reiniciarBtn" class="btn-childish btn-reiniciar">🔁 Reiniciar</button>
  </div>

  <script>
    const letras = "ABCDEFGHIJKLMNÑOPQRSTUVWXYZ".split('');
    const coloresCSS = ["color-1","color-2","color-3","color-4","color-5"];
    const grid = document.getElementById('letter-grid');
    const letraSpan = document.getElementById('letraObjetivo');
    const mensajeDiv = document.getElementById('mensaje');
    const puntajeSpan = document.getElementById('puntaje');
    const tiempoSpan = document.getElementById('tiempo');
    const reiniciarBtn = document.getElementById('reiniciarBtn');
    const sonidoCorrecto = document.getElementById('sonido-correcto');
    const sonidoIncorrecto = document.getElementById('sonido-incorrecto');
    const sonidoVictoria = document.getElementById('sonido-victoria');
    let letraObjetivo = '';
    let puntaje = 0;
    let tiempo = 60;
    let juegoActivo = true;
    let timerInterval;

    function reproducirTexto(texto) {
      if ('speechSynthesis' in window) {
        speechSynthesis.cancel();
        const voz = new SpeechSynthesisUtterance(texto);
        voz.lang = 'es-ES';
        voz.rate = 0.8;
        speechSynthesis.speak(voz);
      }
    }

    function playSonido(id) {
      const sonidos = { correcto: sonidoCorrecto, incorrecto: sonidoIncorrecto, victoria: sonidoVictoria };
      const sonido = sonidos[id];
      if (sonido) { sonido.currentTime = 0; sonido.volume = 0.5; sonido.play(); }
    }

    function lanzarConfeti() {
      confetti({ particleCount: 100, spread: 70, origin: { y: 0.6 }, zIndex: 9999 });
    }

    function mezclarArray(arr) {
      for (let i = arr.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [arr[i], arr[j]] = [arr[j], arr[i]];
      }
      return arr;
    }

    function crearBotonesLetras() {
      grid.innerHTML = '';
      let opciones = [letraObjetivo];
      while (opciones.length < 5) {
        const aleatoria = letras[Math.floor(Math.random() * letras.length)];
        if (!opciones.includes(aleatoria)) opciones.push(aleatoria);
      }
      opciones = mezclarArray(opciones);
      opciones.forEach((letra, index) => {
        const boton = document.createElement('button');
        const colorAleatorio = coloresCSS[Math.floor(Math.random() * coloresCSS.length)];
        boton.className = `btn-3d letter-btn ${colorAleatorio}`;
        boton.textContent = letra;
        boton.style.animationDelay = `${index * 0.05}s`;
        boton.onclick = manejarClickLetra;
        grid.appendChild(boton);
      });
    }

    function manejarClickLetra(e) {
      if (!juegoActivo) return;
      const boton = e.currentTarget;
      const letraClicada = boton.textContent;
      reproducirTexto(letraClicada);

      if (letraClicada === letraObjetivo) {
        juegoActivo = false;
        puntaje++;
        puntajeSpan.textContent = puntaje;
        mensajeDiv.textContent = '¡Muy bien! ✔️';
        mensajeDiv.style.color = '#166534';
        boton.classList.add('correct');
        lanzarConfeti();
        playSonido('correcto');
        guardarAvance();
        setTimeout(() => nuevaRonda(), 1000);
      } else {
        mensajeDiv.textContent = 'Intenta otra vez ❌';
        mensajeDiv.style.color = '#b91c1c';
        playSonido('incorrecto');
        boton.classList.add('shake');
        setTimeout(() => boton.classList.remove('shake'), 500);
      }
    }

    function nuevaLetraObjetivo() {
      letraObjetivo = letras[Math.floor(Math.random() * letras.length)];
      letraSpan.textContent = letraObjetivo;
      setTimeout(() => reproducirTexto("Selecciona la letra " + letraObjetivo), 300);
    }

    function nuevaRonda() {
      mensajeDiv.textContent = '¡Toca la letra correcta!';
      mensajeDiv.style.color = '#333';
      nuevaLetraObjetivo();
      crearBotonesLetras();
      juegoActivo = true;
    }

    function iniciarTemporizador() {
      timerInterval = setInterval(() => {
        if (!juegoActivo) return;
        tiempo--;
        tiempoSpan.textContent = tiempo;
        if (tiempo <= 0) finalizarJuego();
      }, 1000);
    }

    function finalizarJuego() {
      juegoActivo = false;
      clearInterval(timerInterval);
      mensajeDiv.textContent = `¡Tiempo terminado! Tu puntaje: ${puntaje} 🎉`;
      mensajeDiv.style.color = '#1d4ed8';
      playSonido('victoria');
      lanzarConfeti();
      reproducirTexto(`¡Juego terminado! Tu puntaje fue ${puntaje}.`);
    }

    function iniciarJuego() {
      puntaje = 0;
      tiempo = 60;
      juegoActivo = true;
      puntajeSpan.textContent = puntaje;
      tiempoSpan.textContent = tiempo;
      mensajeDiv.textContent = '';
      if (timerInterval) clearInterval(timerInterval);
      nuevaRonda();
      iniciarTemporizador();
    }

    function guardarAvance() {
      const nombre = localStorage.getItem('nombreUsuario') || 'Invitado';
      const tipo = localStorage.getItem('tipoUsuario') || 'Niño';
      fetch('juego_abc.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: `nombre=${encodeURIComponent(nombre)}&tipo=${encodeURIComponent(tipo)}&puntaje=${puntaje}`
      });
    }

    reiniciarBtn.onclick = iniciarJuego;

    window.onload = () => {
      setTimeout(() => {
        reproducirTexto("¡Hola! ¡Vamos a jugar con las letras!");
        iniciarJuego();
      }, 500);
    };
  </script>
</body>
</html>

