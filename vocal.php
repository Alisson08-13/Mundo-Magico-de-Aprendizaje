<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Aprendamos las Vocales</title>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&family=Nunito:wght@700&display=swap');

    body {
      font-family: 'Comic Neue', 'Nunito', sans-serif;
      background: linear-gradient(180deg, #ffe6a7, #ffd6e0, #a3e4ff);
      background-size: 400% 400%;
      animation: moverFondo 12s ease-in-out infinite;
      text-align: center;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
      position: relative;
    }

    @keyframes moverFondo {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .burbuja {
      position: fixed;
      bottom: -100px;
      border-radius: 50%;
      background: rgba(255,255,255,0.5);
      animation: flotarBurbujas 12s linear infinite;
      z-index: 0;
    }

    @keyframes flotarBurbujas {
      0% { transform: translateY(0) scale(1); opacity: 1; }
      80% { opacity: 0.8; }
      100% { transform: translateY(-120vh) scale(1.3); opacity: 0; }
    }

    h1 {
      font-size: 3.5em;
      color: #ff4081;
      text-shadow: 3px 3px #fff, 0 0 15px #ffb6c1;
      animation: brillo 3s infinite alternate, flotarSuave 4s ease-in-out infinite;
      position: relative;
      z-index: 2;
    }

    @keyframes brillo {
      0% { text-shadow: 0 0 10px #ffb6c1, 0 0 15px #fff; }
      100% { text-shadow: 0 0 25px #fff, 0 0 30px #ff80ab; }
    }

    @keyframes flotarSuave {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .vocales {
      display: flex;
      justify-content: center;
      gap: 25px;
      flex-wrap: wrap;
      margin: 20px;
      position: relative;
      z-index: 2;
    }

    .vocal {
      font-size: 90px;
      border-radius: 25px;
      padding: 25px 35px;
      background: radial-gradient(circle at top left, #fff7ae, #ffd166);
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      cursor: pointer;
      transition: transform 0.4s, background 0.4s;
      position: relative;
      animation: flotarSuave 4s ease-in-out infinite;
    }

    .vocal:hover {
      transform: scale(1.1) rotate(4deg);
      background: radial-gradient(circle at bottom right, #fffaa1, #ffcc80);
      box-shadow: 0 0 20px rgba(255, 193, 7, 0.6);
    }

    .vocal.active {
      animation: rebote 0.6s ease;
      background: radial-gradient(circle, #ffeb3b, #ffd166);
    }

    @keyframes rebote {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-12px); }
    }

    .vocal img {
      width: 60px;
      position: absolute;
      top: -15px;
      right: -15px;
      animation: flotar 2s infinite ease-in-out;
    }

    @keyframes flotar {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-8px); }
    }

    .panel {
      background: rgba(255,255,255,0.85);
      border-radius: 25px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      width: 85%;
      margin: 20px auto;
      padding: 20px;
      max-width: 750px;
      position: relative;
      z-index: 2;
      backdrop-filter: blur(5px);
      animation: aparecer 1s ease forwards;
    }

    @keyframes aparecer {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    h2, h3 {
      color: #ff6f61;
      text-shadow: 1px 1px #fff;
      animation: brillo 3s infinite alternate;
    }

    .palabra-con-imagen {
      display: inline-block;
      text-align: center;
      margin: 15px;
    }

    .palabra-con-imagen img {
      width: 100px;
      border-radius: 15px;
      animation: flotar 2s infinite ease-in-out;
      box-shadow: 0 3px 8px rgba(0,0,0,0.3);
    }

    .palabra {
      display: inline-block;
      margin: 10px;
      padding: 15px 25px;
      border-radius: 15px;
      background: #b3e5fc;
      font-size: 30px;
      color: #333;
      cursor: pointer;
      transition: all 0.3s;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    .palabra:hover {
      transform: scale(1.15) rotate(-2deg);
      background: #81d4fa;
    }

    .estrellita {
      position: absolute;
      font-size: 40px;
      animation: subir 1.5s ease-out forwards;
      z-index: 3;
    }

    @keyframes subir {
      0% { opacity: 1; transform: translateY(0) scale(1); }
      100% { opacity: 0; transform: translateY(-100px) scale(1.5); }
    }

    button {
      margin: 10px;
      padding: 12px 25px;
      font-size: 18px;
      border: none;
      border-radius: 20px;
      cursor: pointer;
      background-color: #ffd166;
      transition: all 0.3s;
      box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    }

    button:hover {
      background-color: #ffb703;
      transform: scale(1.1);
    }

    .chispita {
      position: fixed;
      font-size: 20px;
      color: #fff;
      animation: brillar 2s linear infinite;
    }

    @keyframes brillar {
      0%, 100% { opacity: 0; transform: scale(0.8); }
      50% { opacity: 1; transform: scale(1.3); }
    }

    /* 🎯 Actividad nueva */
    .zona-imagenes {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 20px;
      margin-top: 20px;
    }

    .imagen-draggable {
      width: 100px;
      cursor: grab;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      transition: transform 0.3s;
    }

    .imagen-draggable:active {
      cursor: grabbing;
    }

    .zona-drop {
      display: flex;
      justify-content: center;
      gap: 30px;
      margin-top: 30px;
      flex-wrap: wrap;
    }

    .drop-vocal {
      width: 80px;
      height: 80px;
      background: #fff8dc;
      border: 2px dashed #ffa726;
      border-radius: 50%;
      font-size: 2em;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: background 0.3s;
    }

    .drop-vocal.correcto {
      background: #c8e6c9;
      color: green;
      font-weight: bold;
    }

  </style>
</head>

<body>
  <h1>🎶 ¡Aprendamos las Vocales! 🌈</h1>

  <div class="vocales">
    <div class="vocal" data-vocal="a">A<img src="https://media.tenor.com/iW-TnLRO5zYAAAAi/apple-fruit.gif"></div>
    <div class="vocal" data-vocal="e">E<img src="https://media.tenor.com/n2ABEBtJEEYAAAAi/elephant-animals.gif"></div>
    <div class="vocal" data-vocal="i">I<img src="https://media.tenor.com/mn-2DXbNNHEAAAAi/ice-cream.gif"></div>
    <div class="vocal" data-vocal="o">O<img src="https://media.tenor.com/xLgQeZzYfboAAAAi/orange-fruit.gif"></div>
    <div class="vocal" data-vocal="u">U<img src="https://media.tenor.com/2hLqEqqYtZYAAAAi/unicornio.gif"></div>
  </div>

  <h2>🅰️ Vocal seleccionada: <span id="vocalActiva">—</span></h2>

  <div class="panel" id="actividadVocales">
    <h3>🎯 Actividad: Arrastra la imagen a la vocal correcta</h3>
    <div id="contenedorImagenes" class="zona-imagenes"></div>
    <div id="zonaDrop" class="zona-drop">
      <div class="drop-vocal" data-vocal="a">A</div>
      <div class="drop-vocal" data-vocal="e">E</div>
      <div class="drop-vocal" data-vocal="i">I</div>
      <div class="drop-vocal" data-vocal="o">O</div>
      <div class="drop-vocal" data-vocal="u">U</div>
    </div>
  </div>

  <div class="panel" id="contenedorPalabras">
    <h3>📚 Palabras con la vocal</h3>
  </div>

  <div class="panel" id="contenedorMinusculas">
    <h3>🔡 Vocales minúsculas</h3>
  </div>

  <button id="irSilabas">➡️ Ir a palabras por sílaba</button>

  <audio id="aplausos" src="https://cdn.pixabay.com/audio/2022/03/15/audio_b8c58a0b30.mp3"></audio>

  <script>
    const vocales = document.querySelectorAll('.vocal');
    const vocalActiva = document.getElementById('vocalActiva');
    const contenedorPalabras = document.getElementById('contenedorPalabras');
    const contenedorMinusculas = document.getElementById('contenedorMinusculas');
    const aplausos = document.getElementById('aplausos');
    const contenedorImagenes = document.getElementById('contenedorImagenes');

    for (let i = 0; i < 20; i++) {
      const burbuja = document.createElement('div');
      burbuja.classList.add('burbuja');
      burbuja.style.width = burbuja.style.height = Math.random() * 40 + 10 + 'px';
      burbuja.style.left = Math.random() * 100 + 'vw';
      burbuja.style.animationDuration = (8 + Math.random() * 8) + 's';
      burbuja.style.animationDelay = Math.random() * 10 + 's';
      document.body.appendChild(burbuja);
    }

    setInterval(() => {
      const ch = document.createElement('div');
      ch.className = 'chispita';
      ch.textContent = '✨';
      ch.style.left = Math.random() * 100 + 'vw';
      ch.style.top = Math.random() * 100 + 'vh';
      ch.style.animationDuration = 1 + Math.random() * 2 + 's';
      document.body.appendChild(ch);
      setTimeout(() => ch.remove(), 2500);
    }, 800);

    function reproducirTexto(texto) {
      const voz = new SpeechSynthesisUtterance(texto);
      voz.lang = 'es-ES';
      speechSynthesis.speak(voz);
    }

    function reproducirPalabraPorLetras(palabra) {
      const letras = palabra.split('');
      let delay = 0;
      letras.forEach(letra => {
        setTimeout(() => reproducirTexto(letra), delay);
        delay += 400;
      });
      setTimeout(() => reproducirTexto(palabra), delay + 500);
    }

    function lanzarEstrellita(elemento) {
      const estrella = document.createElement('div');
      estrella.textContent = '⭐';
      estrella.className = 'estrellita';
      const rect = elemento.getBoundingClientRect();
      estrella.style.left = rect.left + rect.width / 2 + 'px';
      estrella.style.top = rect.top + 'px';
      document.body.appendChild(estrella);
      setTimeout(() => estrella.remove(), 1500);
    }

    function crearSilabas(vocal) {
      const imagenes = [
        { nombre: 'Abeja', vocal: 'a', img: 'abeja.gif' },
        { nombre: 'Elefante', vocal: 'e', img: 'elefante.gif' },
        { nombre: 'Iglesia', vocal: 'i', img: 'iglesia.gif' },
        { nombre: 'Oso', vocal: 'o', img: 'oso.gif' },
        { nombre: 'Uva', vocal: 'u', img: 'uva.gif' }
      ];

      contenedorImagenes.innerHTML = '';

      imagenes.forEach((obj, idx) => {
        const img = document.createElement('img');
        img.src = obj.img;
        img.alt = obj.nombre;
        img.className = 'imagen-draggable';
        img.setAttribute('draggable', true);
        img.dataset.vocal = obj.vocal;
        img.id = 'img-' + idx;

        img.ondragstart = (e) => {
          e.dataTransfer.setData('text/plain', img.dataset.vocal);
          e.dataTransfer.setData('id', img.id);
        };

        contenedorImagenes.appendChild(img);
      });

      document.querySelectorAll('.drop-vocal').forEach(drop => {
        drop.ondragover = (e) => e.preventDefault();

        drop.ondrop = (e) => {
          e.preventDefault();
          const vocalArrastrada = e.dataTransfer.getData('text/plain');
          const id = e.dataTransfer.getData('id');
          if (vocalArrastrada === drop.dataset.vocal) {
            drop.classList.add('correcto');
            const imagen = document.getElementById(id);
            imagen.style.display = 'none';
            reproducirTexto("¡Muy bien! " + vocalArrastrada.toUpperCase());
            aplausos.currentTime = 0;
            aplausos.play();
            lanzarEstrellita(drop);
          } else {
            reproducirTexto("Intenta de nuevo");
          }
        };
      });

      crearPalabras(vocal);
      crearMinusculas(vocal);
    }

    function crearMinusculas(vocal) {
      contenedorMinusculas.innerHTML = '<h3>🔡 Vocales minúsculas</h3>';
      const minusculas = document.createElement('div');
      minusculas.className = 'palabra';
      minusculas.textContent = vocal.toLowerCase();
      minusculas.onclick = () => {
        reproducirTexto(vocal.toLowerCase());
        aplausos.currentTime = 0;
        aplausos.play();
        lanzarEstrellita(minusculas);
      };
      contenedorMinusculas.appendChild(minusculas);
    }

    function crearPalabras(vocal) {
      contenedorPalabras.innerHTML = '<h3>📚 Palabras con la vocal</h3>';
      const ejemplos = {
        a: [
          { palabra: 'árbol', img: 'arbol.gif' },
          { palabra: 'abeja', img: 'abeja.gif' },
          { palabra: 'avión', img: 'descarga.gif' }
        ],
        e: [
          { palabra: 'elefante', img: 'elefante.gif' },
          { palabra: 'estrella', img: 'estrella.gif' },
          { palabra: 'espejo', img: 'espejo.gif' }
        ],
        i: [
          { palabra: 'iglesia', img: 'iglesia.gif' },
          { palabra: 'isla', img: 'isla.gif' },
          { palabra: 'imán', img: 'iman.gif' }
        ],
        o: [
          { palabra: 'oso', img: 'oso.gif' },
          { palabra: 'oro', img: 'oro.jfif' },
          { palabra: 'olla', img: 'olla.gif' }
        ],
        u: [
          { palabra: 'uva', img: 'uva.gif' },
          { palabra: 'uno', img: 'uno.gif' },
          { palabra: 'unicornio', img: 'unicornio.gif' }
        ]
      };

      ejemplos[vocal].forEach(obj => {
        const div = document.createElement('div');
        div.className = 'palabra-con-imagen';

        const img = document.createElement('img');
        img.src = obj.img;
        img.alt = obj.palabra;

        const p = document.createElement('div');
        p.className = 'palabra';
        p.textContent = obj.palabra;

        p.onclick = () => {
          reproducirPalabraPorLetras(obj.palabra);
          aplausos.currentTime = 0;
          aplausos.play();
          lanzarEstrellita(p);
        };

        div.appendChild(img);
        div.appendChild(p);
        contenedorPalabras.appendChild(div);
      });
    }

    vocales.forEach(v => {
      v.addEventListener('click', () => {
        vocales.forEach(v => v.classList.remove('active'));
        v.classList.add('active');
        const vocalSeleccionada = v.dataset.vocal;
        vocalActiva.textContent = vocalSeleccionada.toUpperCase();
        reproducirTexto(vocalSeleccionada);
        crearSilabas(vocalSeleccionada);
      });
    });

    document.getElementById('irSilabas').onclick = () => {
      alert('¡Esta sección ha sido integrada en la actividad principal!');
    };
  </script>
</body>
</html>
