<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>¡Aprendamos las Vocales! 🌈</title>

  <style>
    /* 1. Importación de Fuente (Nunito: amigable y moderna) */
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700;900&display=swap');

    /* 2. Estilos Base y de Fondo (Inspirado en el Silabario) */
    body {
      /* Fuente principal limpia */
      font-family: 'Nunito', sans-serif;
      /* Fondo claro y limpio */
      background-color: #f0f4f8;
      text-align: center;
      margin: 0;
      padding: 1.5rem; /* Espacio para que la tarjeta respire */
      overflow-x: hidden;
    }

    /* 3. Contenedor Principal (Tarjeta Blanca) */
    .main-container {
      max-width: 900px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 24px;
      /* Sombra suave como la tarjeta del silabario */
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      padding: 1.5rem 2rem;
    }

    /* 4. Título Principal (Alto contraste) */
    h1 {
      font-weight: 900; /* Equivalente a font-black */
      font-size: 2.8em;
      color: #d946ef; /* Rosa/Magenta fuerte */
      margin-bottom: 1rem;
      /* Borde inferior como el silabario */
      border-bottom: 4px solid #facc15; /* Amarillo */
      padding-bottom: 0.5rem;
    }

    /* 5. Encabezados de Sección */
    h2, h3 {
      font-weight: 900;
      color: #1d4ed8; /* Azul oscuro (alto contraste) */
      font-size: 1.8em;
      margin-top: 1.5rem;
    }
    
    h3 {
      font-size: 1.5em;
      color: #059669; /* Verde oscuro para la sección verde */
    }
    
    /* Sección azul h3 */
    .learn-section h3 {
        color: #1e40af; /* Azul más oscuro */
    }

    /* 6. Estilo de Botones 3D (Inspirado en el Silabario) */
    .btn-3d {
      font-family: 'Nunito', sans-serif;
      font-weight: 700;
      border: none;
      border-radius: 12px;
      padding: 1rem;
      transition: all 0.15s ease;
      cursor: pointer;
      user-select: none;
      -webkit-tap-highlight-color: transparent;
      /* Sombra 3D */
      box-shadow: 0 5px 0 0 var(--shadow-color, #00000030);
    }

    .btn-3d:active {
      /* Efecto de presionar */
      transform: translateY(3px);
      box-shadow: 0 2px 0 0 var(--shadow-color, #00000030);
    }

    /* 7. Sección 1: Selector de Vocales */
    .vowel-selector-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
      gap: 15px;
      margin-top: 1.5rem;
    }

    .vocal-btn {
      font-size: 3em; /* Letra grande y clara */
    }

    /* Colores temáticos para cada vocal */
    .vocal-btn[data-vocal="a"] {
      background: #fecaca; /* Rojo claro */
      color: #b91c1c; /* Rojo oscuro */
      --shadow-color: #b91c1c;
    }
    .vocal-btn[data-vocal="e"] {
      background: #bbf7d0; /* Verde claro */
      color: #166534; /* Verde oscuro */
      --shadow-color: #166534;
    }
    .vocal-btn[data-vocal="i"] {
      background: #bfdbfe; /* Azul claro */
      color: #1e40af; /* Azul oscuro */
      --shadow-color: #1e40af;
    }
    .vocal-btn[data-vocal="o"] {
      background: #fed7aa; /* Naranja claro */
      color: #b45309; /* Naranja oscuro */
      --shadow-color: #b45309;
    }
    .vocal-btn[data-vocal="u"] {
      background: #e9d5ff; /* Morado claro */
      color: #581c87; /* Morado oscuro */
      --shadow-color: #581c87;
    }
    
    /* Estado activo (cuando se presiona) */
    .vocal-btn.active {
      transform: translateY(3px);
      box-shadow: 0 2px 0 0 var(--shadow-color);
      filter: brightness(0.95);
    }

    /* 8. Sección 2: Área de Aprendizaje (Minúsculas y Palabras) */
    .learn-section {
      background: #e0f2fe; /* Azul muy claro (como el silabario) */
      border: 2px solid #7dd3fc;
      border-radius: 16px;
      padding: 1.5rem;
      margin-top: 2rem;
    }
    
    .word-panels {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }
    
    .word-panel-content {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 15px;
    }
    
    /* Estilo para las palabras de ejemplo */
    .palabra-con-imagen {
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      background: #fff;
      border-radius: 12px;
      padding: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.08);
      min-width: 130px;
    }

    .palabra-con-imagen img {
      width: 100px;
      height: 100px;
      border-radius: 15px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.1);
      object-fit: cover;
    }
    
    .palabra-btn {
        font-size: 1.8em;
        padding: 10px 25px;
        background: #dbeafe; /* Azul claro */
        color: #1e40af; /* Azul oscuro */
        --shadow-color: #1e40af;
    }

    /* Clase para ajustar el texto formateado con guiones */
    .palabra-formateada {
        font-size: 1.2em; /* Tamaño más pequeño para que quepan palabras largas */
        padding: 12px 15px;
        letter-spacing: 1px; 
        word-break: break-all; 
    }


    /* 9. Sección 3: Actividad de Arrastrar y Soltar */
    .drag-drop-activity {
      /* Fondo verde como el silabario */
      background: #f0fdf4;
      border: 2px solid #86efac;
      border-radius: 16px;
      padding: 1.5rem;
      margin-top: 2rem;
    }

    .zona-imagenes {
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
      gap: 15px;
      margin-top: 1rem;
      background: #fff;
      padding: 1rem;
      border-radius: 12px;
      border: 2px dashed #ccc;
      min-height: 120px;
    }

    .imagen-draggable {
      width: 100px;
      height: 100px;
      cursor: grab;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: transform 0.3s, opacity 0.3s;
      object-fit: cover;
    }
    
    .imagen-draggable:active {
      cursor: grabbing;
      transform: scale(1.1);
      opacity: 0.7;
    }

    .zona-drop {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
      gap: 15px;
      margin-top: 1.5rem;
      padding: 0 1rem;
    }

    .drop-vocal {
      width: 80px;
      height: 80px;
      background: #fff8dc;
      border: 3px dashed #ffa726;
      border-radius: 50%;
      font-size: 2.2em;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s;
      margin: 0 auto;
    }
    
    .drop-vocal.drag-over {
        transform: scale(1.1);
        border-style: solid;
    }

    .drop-vocal.correcto {
      background: #c8e6c9;
      color: green;
      border-color: #4caf50;
      border-style: solid;
      transform: scale(1.1);
    }

    /* 10. Animación de Recompensa (Estrellita) */
    .estrellita {
      position: absolute;
      font-size: 40px;
      animation: subir 1.5s ease-out forwards;
      z-index: 100;
      pointer-events: none; /* No debe interferir con clics */
    }

    @keyframes subir {
      0% { opacity: 1; transform: translateY(0) scale(1); }
      100% { opacity: 0; transform: translateY(-100px) scale(1.5); }
    }
    
    /* 11. Media Queries para Responsividad */
    @media (max-width: 600px) {
        body {
            padding: 0.5rem;
        }
        .main-container {
            padding: 1rem 0.5rem;
        }
        h1 {
            font-size: 2.2em;
        }
        h2 {
            font-size: 1.5em;
        }
        .vowel-selector-grid {
            /* Pasa de 5 columnas a 3 para caber mejor */
            grid-template-columns: repeat(3, 1fr);
        }
        .vocal-btn {
            font-size: 2.5em;
        }
        .zona-drop {
            grid-template-columns: repeat(3, 1fr);
        }
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
</head>

<body>

  <div class="main-container">

    <h1>🎶 ¡Aprendamos las Vocales! 🌈</h1>

    <section class="vowel-selector">
      <h2>✨ Explora las Vocales ✨</h2>
      <div class="vowel-selector-grid">
        <button class="vocal-btn btn-3d" data-vocal="a">A</button>
        <button class="vocal-btn btn-3d" data-vocal="e">E</button>
        <button class="vocal-btn btn-3d" data-vocal="i">I</button>
        <button class="vocal-btn btn-3d" data-vocal="o">O</button>
        <button class="vocal-btn btn-3d" data-vocal="u">U</button>
      </div>
    </section>

    <section class="learn-section">
      <h2>📚 Aprende y Practica 📚</h2>
      <p style="font-size: 1.2em; color: #333;">Vocal seleccionada: <b id="vocalActiva" style="color: #d946ef; font-size: 1.5em;">—</b></p>
      
      <div class="word-panels">
          <div class="word-panel" id="panel-minusculas">
            <h3>🔡 Minúscula</h3>
            </div>
          
          <div class="word-panel" id="panel-palabras">
            <h3>🌳 Palabras de Ejemplo</h3>
            <div class="word-panel-content">
                </div>
          </div>
      </div>
    </section>

    <section class="drag-drop-activity">
      <h3>🎯 ¡A Jugar! Arrastra la imagen</h3>
      <p style="color: #15803d;">Lleva cada imagen a la vocal con la que empieza su nombre.</p>
      
      <div id="contenedorImagenes" class="zona-imagenes">
        </div>
      
      <div id="zonaDrop" class="zona-drop">
        <div class="drop-vocal" data-vocal="a">A</div>
        <div class="drop-vocal" data-vocal="e">E</div>
        <div class="drop-vocal" data-vocal="i">I</div>
        <div class="drop-vocal" data-vocal="o">O</div>
        <div class="drop-vocal" data-vocal="u">U</div>
      </div>
    </section>

  </div> <audio id="aplausos" src="https://cdn.pixabay.com/audio/2022/03/15/audio_b8c58a0b30.mp3" preload="auto"></audio>

  <script>
    // --- SELECCIÓN DE ELEMENTOS (Actualizado a nuevas clases) ---
    const vocales = document.querySelectorAll('.vocal-btn'); // Actualizado
    const vocalActiva = document.getElementById('vocalActiva');
    const contenedorPalabras = document.getElementById('panel-palabras'); // Actualizado
    const contenedorMinusculas = document.getElementById('panel-minusculas'); // Actualizado
    const aplausos = document.getElementById('aplausos');
    const contenedorImagenes = document.getElementById('contenedorImagenes');
    const dropZones = document.querySelectorAll('.drop-vocal');


    // --- DATOS (Actualizados con las URLs que proporcionaste) ---
    const imagenesArrastrables = [
      { nombre: 'Abeja', vocal: 'a', img: 'https://www.shutterstock.com/image-vector/cute-cartoon-bee-childish-vector-600nw-2487566385.jpg' },
      { nombre: 'Elefante', vocal: 'e', img: 'https://i.pinimg.com/1200x/01/6f/aa/016faa2a63adf504ee0f6998ab7ae771.jpg' },
      { nombre: 'Iglesia', vocal: 'i', img: 'https://img.freepik.com/vector-premium/edificio-iglesia-catolica-catedral-caricatura-arquitectura-religiosa-exterior-vector_939711-4327.jpg' },
      { nombre: 'Oso', vocal: 'o', img: 'https://i.pinimg.com/originals/4f/b8/83/4fb883a238a32a441eb330dab9ec090b.png' },
      { nombre: 'Uva', vocal: 'u', img: 'https://img.freepik.com/vector-gratis/icono-dibujos-animados-uva-ilustracion-alimentos-icono-naturaleza-vector-plano-aislado_138676-14373.jpg' },
      { nombre: 'Avión', vocal: 'a', img: 'https://i.pinimg.com/736x/49/a1/2c/49a12cf519b122a911dabf5dee294dea.jpg' },
      { nombre: 'Estrella', vocal: 'e', img: 'https://i.pinimg.com/originals/38/a7/0a/38a70a876ff0d30f5cce29867f13b037.jpg' },
      { nombre: 'Imán', vocal: 'i', img: 'https://i.pinimg.com/474x/d0/1c/27/d01c27f87c0c56601e1b8aba18918a86.jpg' },
      { nombre: 'Olla', vocal: 'o', img: 'https://i.pinimg.com/736x/6d/8b/8d/6d8b8d9b9d321259d59c9061e95d30ca.jpg' },
      { nombre: 'Unicornio', vocal: 'u', img: 'https://i.pinimg.com/736x/a3/d1/c4/a3d1c4a1737af1aad13a82cad19fe427.jpg' },
    ];

    const ejemplosPalabras = {
      a: [
        { palabra: 'árbol', img: 'https://img.freepik.com/vector-premium/ilustracion-vectorial-obra-arte-hermoso-arbol_950295-333.jpg' },
        { palabra: 'abeja', img: 'https://www.shutterstock.com/image-vector/cute-cartoon-bee-childish-vector-600nw-2487566385.jpg' },
        { palabra: 'avión', img: 'https://i.pinimg.com/736x/49/a1/2c/49a12cf519b122a911dabf5dee294dea.jpg' }
      ],
      // --- INICIO DE LA MODIFICACIÓN (JS) ---
      e: [
        { palabra: 'elefante', img: 'https://i.pinimg.com/1200x/01/6f/aa/016faa2a63adf504ee0f6998ab7ae771.jpg' },
        { palabra: 'estrella', img: 'https://i.pinimg.com/originals/38/a7/0a/38a70a876ff0d30f5cce29867f13b037.jpg' },
        { palabra: 'espejo', img: 'https://i.pinimg.com/736x/84/ee/b2/84eeb29e860a76c3ec58939f282b29d2.jpg' }
      ],
      i: [
        { palabra: 'iglesia', img: 'https://img.freepik.com/vector-premium/edificio-iglesia-catolica-catedral-caricatura-arquitectura-religiosa-exterior-vector_939711-4327.jpg' },
        { palabra: 'isla', img: 'https://i.pinimg.com/736x/72/e5/dd/72e5dd93b210b6123eaa1fd0c0f694d2.jpg' },
        { palabra: 'imán', img: 'https://i.pinimg.com/474x/d0/1c/27/d01c27f87c0c56601e1b8aba18918a86.jpg' }
      ],
      o: [
        { palabra: 'oso', img: 'https://i.pinimg.com/originals/4f/b8/83/4fb883a238a32a441eb330dab9ec090b.png' },
        { palabra: 'ojo', img: 'https://us.123rf.com/450wm/wektorygrafika/wektorygrafika1806/wektorygrafika180600072/103239907-cartoon-character-eyes-with-lashes-vector-design-isolated-on-white.jpg' },
        { palabra: 'olla', img: 'https://i.pinimg.com/736x/6d/8b/8d/6d8b8d9b9d321259d59c9061e95d30ca.jpg' }
      ],
      u: [
        { palabra: 'uva', img: 'https://img.freepik.com/vector-gratis/icono-dibujos-animados-uva-ilustracion-alimentos-icono-naturaleza-vector-plano-aislado_138676-14373.jpg' },
        { palabra: 'uno', img: 'https://img.freepik.com/vector-gratis/tarjeta-cumpleanos-o-aniversario-1-ano-dibujada-mano_23-2149289953.jpg' },
        { palabra: 'unicornio', img: 'https://i.pinimg.com/736x/a3/d1/c4/a3d1c4a1737af1aad13a82cad19fe427.jpg' }
      ]
      // --- FIN DE LA MODIFICACIÓN (JS) ---
    };


    // --- FUNCIONES DE AUDIO Y EFECTOS (Sin cambios) ---
    
    function reproducirTexto(texto) {
      if ('speechSynthesis' in window) {
        speechSynthesis.cancel();
        const voz = new SpeechSynthesisUtterance(texto);
        voz.lang = 'es-ES';
        voz.rate = 0.9; 
        voz.pitch = 1.1;
        speechSynthesis.speak(voz);
      } else {
        console.log("Síntesis de voz no soportada.");
      }
    }

    function reproducirPalabraPorLetras(palabra) {
      speechSynthesis.cancel(); 
      const letras = palabra.split('');
      let delay = 0;
      letras.forEach(letra => {
        setTimeout(() => reproducirTexto(letra), delay);
        delay += 450;
      });
      setTimeout(() => reproducirTexto(palabra), delay + 600);
    }

    function lanzarEstrellita(elemento) {
      const estrella = document.createElement('div');
      estrella.textContent = '⭐';
      estrella.className = 'estrellita';
      const rect = elemento.getBoundingClientRect();
      estrella.style.left = (rect.left + rect.width / 2 - 20) + 'px';
      estrella.style.top = (rect.top + window.scrollY) + 'px';
      document.body.appendChild(estrella);
      setTimeout(() => estrella.remove(), 1500);
    }
    
    function playAplausos() {
        aplausos.currentTime = 0;
        aplausos.volume = 0.5;
        aplausos.play().catch(e => console.log("Error al reproducir audio:", e));
    }


    // --- FUNCIONES DE CREACIÓN DE CONTENIDO (Actualizadas) ---
    
    function barajarArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function crearActividadArrastrarYSoltar() {
      contenedorImagenes.innerHTML = '';
      dropZones.forEach(drop => drop.classList.remove('correcto'));

      const imagenesBarajadas = barajarArray([...imagenesArrastrables]);

      imagenesBarajadas.forEach((obj, idx) => {
        const img = document.createElement('img');
        img.src = obj.img;
        img.alt = obj.nombre;
        img.className = 'imagen-draggable';
        img.setAttribute('draggable', true);
        img.dataset.vocal = obj.vocal;
        img.dataset.nombre = obj.nombre;
        img.id = 'img-drag-' + idx;

        img.ondragstart = (e) => {
          e.dataTransfer.setData('text/plain', img.dataset.vocal);
          e.dataTransfer.setData('nombre', img.dataset.nombre);
          e.dataTransfer.setData('id', img.id);
          e.currentTarget.style.opacity = '0.5';
          e.currentTarget.style.transform = 'scale(0.9)';
        };

        img.ondragend = (e) => {
          e.currentTarget.style.opacity = '1';
          e.currentTarget.style.transform = 'scale(1)';
        };

        contenedorImagenes.appendChild(img);
      });

      dropZones.forEach(drop => {
        drop.ondragover = (e) => {
          e.preventDefault();
          drop.classList.add('drag-over'); 
        };

        drop.ondragleave = () => {
          drop.classList.remove('drag-over');
        };

        drop.ondrop = (e) => {
          e.preventDefault();
          drop.classList.remove('drag-over');
          
          const vocalArrastrada = e.dataTransfer.getData('text/plain');
          const nombreImagen = e.dataTransfer.getData('nombre');
          const id = e.dataTransfer.getData('id');
          const imagen = document.getElementById(id);

          if (vocalArrastrada === drop.dataset.vocal) {
            // Correcto
            drop.classList.add('correcto');
            if(imagen) {
                imagen.style.transition = 'opacity 0.5s, transform 0.5s';
                imagen.style.opacity = '0';
                imagen.style.transform = 'scale(0.5)';
                setTimeout(() => imagen.remove(), 500);
            }
            reproducirTexto("¡Muy bien! " + nombreImagen + " empieza con " + vocalArrastrada);
            playAplausos();
            lanzarEstrellita(drop);

            setTimeout(() => {
              if (contenedorImagenes.children.length === 0) {
                reproducirTexto("¡Excelente, completaste toda la actividad!");
                setTimeout(crearActividadArrastrarYSoltar, 3000); 
              }
            }, 1000);

          } else {
            // Incorrecto
            reproducirTexto("¡Oh! " + nombreImagen + " no empieza con " + drop.dataset.vocal + ". Intenta de nuevo.");
            if(imagen) {
                imagen.style.animation = 'shake 0.5s';
                setTimeout(() => imagen.style.animation = '', 500);
            }
          }
        };
      });
    }

    /**
     * Muestra y añade interactividad a la vocal minúscula.
     * (Esta función no se modifica, mantiene el estilo original .palabra-btn)
     */
    function crearMinusculas(vocal) {
      contenedorMinusculas.innerHTML = '<h3>🔡 Minúscula</h3>';
      const minusculas = document.createElement('button');
      minusculas.className = 'palabra-btn btn-3d'; // Clase original
      minusculas.textContent = vocal.toLowerCase();
      minusculas.onclick = () => {
        reproducirTexto(vocal.toLowerCase());
        playAplausos();
        lanzarEstrellita(minusculas);
      };
      contenedorMinusculas.appendChild(minusculas);
    }

    /**
     * Muestra las palabras de ejemplo para la vocal seleccionada.
     * (Función modificada para formatear el texto del botón)
     */
    function crearPalabras(vocal) {
      contenedorPalabras.innerHTML = '<h3>🌳 Palabras de Ejemplo</h3>';
      const contentDiv = document.createElement('div');
      contentDiv.className = 'word-panel-content';
      
      ejemplosPalabras[vocal].forEach(obj => {
        const div = document.createElement('div');
        div.className = 'palabra-con-imagen';

        const img = document.createElement('img');
        img.src = obj.img;
        img.alt = obj.palabra;
        img.onerror = () => img.src = `https://via.placeholder.com/100?text=${obj.palabra}`; 

        const p = document.createElement('button');
        
        // 1. Añade la nueva clase CSS para el estilo de fuente más pequeño
        p.className = 'palabra-btn btn-3d palabra-formateada'; 
        
        // 2. Formatea el texto (ej: "oso" -> "O-S-O")
        const palabraFormateada = obj.palabra.toUpperCase().split('').join('-');
        p.textContent = palabraFormateada;

        p.onclick = () => {
          // Importante: La función de audio SIGUE USANDO la palabra original (obj.palabra)
          reproducirPalabraPorLetras(obj.palabra); 
          playAplausos();
          lanzarEstrellita(p);
        };

        div.appendChild(img);
        div.appendChild(p);
        contentDiv.appendChild(div);
      });
      contenedorPalabras.appendChild(contentDiv);
    }

    // --- EVENT LISTENERS (Lógica principal) ---

    vocales.forEach(v => {
      v.addEventListener('click', () => {
        vocales.forEach(v => v.classList.remove('active'));
        v.classList.add('active');
        
        const vocalSeleccionada = v.dataset.vocal;
        vocalActiva.textContent = vocalSeleccionada.toUpperCase();
        
        reproducirTexto(vocalSeleccionada);
        
        crearPalabras(vocalSeleccionada);
        crearMinusculas(vocalSeleccionada);
      });
    });

    // --- INICIALIZACIÓN ---
    
    crearActividadArrastrarYSoltar();
    
    setTimeout(() => {
        vocales[0].click();
        reproducirTexto("¡Hola! Toca una vocal para empezar.");
    }, 500); 

  </script>
       <div class="navigation-buttons">
            <a href="inicio.html" class="btn-childish btn-menu">
                <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
                <span>Ir al Inicio</span>
            </a>
        </div>
</body>
</html>
