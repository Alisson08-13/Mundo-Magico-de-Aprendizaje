<?php
// adivina_letra.php
session_start();
header('Content-Type: text/html; charset=utf-8');

// Incluye la conexión (ajusta ruta si necesario)
require_once 'conexion.php';

// ARRAY DE IMÁGENES (igual que tu primer código)
$imagenes = [
    ['letra' => 'A', 'img' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRAyDXeAjLUR_ziv0UIc4A6pGJv61VtFtTyjF9fkAQcypig5KjitGxiMpuxZi7Bcp8KhvM&usqp=CAU', 'nombre' => 'Árbol'],
    ['letra' => 'B', 'img' => 'https://static.vecteezy.com/system/resources/previews/047/304/391/original/a-cartoon-whale-with-a-big-smile-on-its-face-vector.jpg', 'nombre' => 'Ballena'],
    ['letra' => 'C', 'img' => 'https://static.vecteezy.com/system/resources/previews/025/902/045/non_2x/house-cartoon-style-illustration-ai-generated-vector.jpg', 'nombre' => 'Casa'],
    ['letra' => 'D', 'img' => 'https://static.vecteezy.com/system/resources/previews/047/554/026/original/a-cartoon-dolphin-is-swimming-in-the-ocean-vector.jpg', 'nombre' => 'Delfín'],
    ['letra' => 'E', 'img' => 'https://static.vecteezy.com/system/resources/previews/044/841/151/original/cartoon-elephant-animal-illustration-vector.jpg', 'nombre' => 'Elefante'],
    ['letra' => 'F', 'img' => 'https://img.freepik.com/vector-premium/dibujo-dibujos-animados-flor-rosa-centro-amarillo_1167562-3170.jpg', 'nombre' => 'Flor'],
    ['letra' => 'G', 'img' => 'https://png.pngtree.com/png-clipart/20231005/original/pngtree-cat-animal-cartoon-character-png-image_13123346.png', 'nombre' => 'Gato'],
    ['letra' => 'H', 'img' => 'https://png.pngtree.com/png-clipart/20230708/original/pngtree-ice-cream-cold-drink-cartoon-illustration-png-image_9278427.png', 'nombre' => 'Helado'],
    ['letra' => 'I', 'img' => 'https://static.vecteezy.com/system/resources/previews/000/456/246/original/vector-island-cartoon-sea-and-sun.jpg', 'nombre' => 'Isla'],
    ['letra' => 'J', 'img' => 'https://i.pinimg.com/originals/9f/39/34/9f393437789e63ab1b969cf24da8654d.jpg', 'nombre' => 'Jirafa'],
    ['letra' => 'K', 'img' => 'https://img.freepik.com/vector-premium/dibujos-animados-lindo-bebe-koala-sentado_29190-6358.jpg', 'nombre' => 'Koala'],
    ['letra' => 'L', 'img' => 'https://cdn.pixabay.com/photo/2022/04/02/01/44/lion-7106027_1280.png', 'nombre' => 'León'],
    ['letra' => 'M', 'img' => 'https://png.pngtree.com/png-clipart/20231109/original/pngtree-monkey-cartoon-animal-png-image_13520014.png', 'nombre' => 'Mono'],
    ['letra' => 'N', 'img' => 'https://static.vecteezy.com/system/resources/previews/024/190/108/non_2x/cute-cartoon-cloud-kawaii-weather-illustrations-for-kids-free-png.png', 'nombre' => 'Nube'],
    ['letra' => 'Ñ', 'img' => 'https://img.freepik.com/vector-premium/nu-animal-dibujos-animados-selva_29190-3177.jpg', 'nombre' => 'Ñu'],
    ['letra' => 'O', 'img' => 'https://img.freepik.com/fotos-premium/oso-dibujos-animados-sentado-suelo-patas-cruzadas-generativo-ai_900958-105372.jpg', 'nombre' => 'Oso'],
    ['letra' => 'P', 'img' => 'https://static.vecteezy.com/system/resources/previews/036/627/741/original/ai-generated-cute-chibi-dog-cartoon-dog-character-free-png.png', 'nombre' => 'Perro'],
    ['letra' => 'Q', 'img' => 'https://cdn.pixabay.com/photo/2023/02/18/20/20/cheese-7798617_1280.png', 'nombre' => 'Queso'],
    ['letra' => 'R', 'img' => 'https://img.freepik.com/vector-gratis/lindo-ratoncito-personaje-dibujos-animados-orejas-grandes_1308-133011.jpg', 'nombre' => 'Ratón'],
    ['letra' => 'S', 'img' => 'https://img.freepik.com/vector-premium/sonriente-personaje-dibujos-animados-sol-ilustracion-vectorial_444196-870.jpg', 'nombre' => 'Sol'],
    ['letra' => 'T', 'img' => 'https://png.pngtree.com/png-clipart/20231109/original/pngtree-cute-tiger-cartoon-illustration-for-kids-png-image_13520653.png', 'nombre' => 'Tigre'],
    ['letra' => 'U', 'img' => 'https://static.vecteezy.com/system/resources/previews/018/931/130/non_2x/cartoon-grapes-icon-png.png', 'nombre' => 'Uvas'],
    ['letra' => 'V', 'img' => 'https://img.freepik.com/vector-premium/linda-vaca-dibujos-animados_160606-325.jpg', 'nombre' => 'Vaca'],
    ['letra' => 'W', 'img' => 'https://img.freepik.com/vector-premium/ilustracion-dibujos-animados-bocadillos-waffle_850687-780.jpg', 'nombre' => 'Waffle'],
    ['letra' => 'X', 'img' => 'https://static.vecteezy.com/system/resources/previews/002/161/606/non_2x/mini-xylophone-illustration-hand-drawing-vector.jpg', 'nombre' => 'Xilófono'],
    ['letra' => 'Y', 'img' => 'https://static.vecteezy.com/system/resources/previews/000/607/546/original/vector-yoyo-in-three-different-colors.jpg', 'nombre' => 'Yoyo'],
    ['letra' => 'Z', 'img' => 'https://i.pinimg.com/originals/a8/df/6e/a8df6e97bed63c6b252f5fee386bfa22.png', 'nombre' => 'Zorro']
];

// Mensajes
$frases_victoria = [
    "¡Eres un genio! 🧠",
    "¡Qué inteligente eres! 🌟",
    "¡Sabes todas las letras! 📚",
    "¡Sigue así de listo/a! 👍",
    "¡Excelente trabajo! 🏆"
];

$mensajes_error = [
    "¡Uy! Esa no es. ¡Intenta otra vez! 😅",
    "¡Casi! Pero no. 🤔",
    "Esa letra no es, ¡sigue buscando! 🧐",
    "¡Oh, oh! Prueba con otra. 😟",
    "No te rindas, ¡tú puedes! 💪"
];
$mensajes_exito_prefix = [
    "¡Perfecto!", "¡Maravilloso!", "¡Genial!", "¡Increíble!", "¡Súper!", "¡Excelente!"
];

$total_letras = count($imagenes);

// Session helpers
if (!isset($_SESSION['letras_vistas'])) $_SESSION['letras_vistas'] = [];
if (!isset($_SESSION['error_streak'])) $_SESSION['error_streak'] = 0;

// Reiniciar via AJAX
if (isset($_GET['action']) && $_GET['action'] == 'reset') {
    header('Content-Type: application/json');
    $_SESSION['letras_vistas'] = [];
    $_SESSION['error_streak'] = 0;
    echo json_encode(['success' => true, 'message' => 'Juego reiniciado']);
    exit;
}

// Petición AJAX: intento de adivinar
if (isset($_GET['guess'])) {
    header('Content-Type: application/json'); 
    $letraAdivinada = $_GET['guess'];
    $letraCorrecta = $_SESSION['letra_actual'] ?? '';
    $response = [];

    if ($letraAdivinada === $letraCorrecta) {
        $_SESSION['error_streak'] = 0;
        if (!in_array($letraCorrecta, $_SESSION['letras_vistas'])) {
            $_SESSION['letras_vistas'][] = $letraCorrecta;
        }
        $correctas_count = count($_SESSION['letras_vistas']);
        $response['correct'] = true;
        $response['correctas_count'] = $correctas_count;

        if ($correctas_count >= $total_letras) {
            // JUEGO COMPLETADO: guardar avance en BD
            $response['game_over'] = true;
            $response['frase_victoria'] = $frases_victoria[array_rand($frases_victoria)];

            // Guardar en tabla 'avances'
            $nombre_usuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Invitado';
            $tipo_usuario = isset($_SESSION['tipo_usuario']) ? $_SESSION['tipo_usuario'] : 'Niño';
            $nivel = 'Adivina la letra';
            // Progreso como porcentaje (100%)
            $progreso_percent = 100;

            // Intentamos insertar (con prepared statements)
            if (isset($conn) && $conn instanceof mysqli) {
                $stmt = $conn->prepare("INSERT INTO avances (nombre, tipo_usuario, nivel, progreso, fecha) VALUES (?, ?, ?, ?, NOW())");
                if ($stmt) {
                    $stmt->bind_param("sssi", $nombre_usuario, $tipo_usuario, $nivel, $progreso_percent);
                    $stmt->execute();
                    $stmt->close();
                }
            }

            // Reiniciar juego en sesión
            $_SESSION['letras_vistas'] = [];
            $_SESSION['error_streak'] = 0;
        } else {
            $response['game_over'] = false;
            // Elegir siguiente imagen que no esté vista
            $imagenes_disponibles = array_filter($imagenes, function ($img) {
                return !in_array($img['letra'], $_SESSION['letras_vistas']);
            });
            $indice_nuevo = array_rand($imagenes_disponibles);
            $siguiente_imagen = $imagenes_disponibles[$indice_nuevo];
            $_SESSION['letra_actual'] = $siguiente_imagen['letra'];
            $_SESSION['nombre_actual'] = $siguiente_imagen['nombre'];
            $_SESSION['img_actual'] = $siguiente_imagen['img'];

            $response['next_image'] = $siguiente_imagen;
        }

    } else {
        // INCORRECTO
        $_SESSION['error_streak']++;
        $response['correct'] = false;
        $response['error_streak'] = $_SESSION['error_streak'];
    }

    echo json_encode($response);
    exit;
}

// Preparar ronda inicial (si es necesario)
$correctas_count = count($_SESSION['letras_vistas']);
$imagenes_disponibles = array_filter($imagenes, function ($img) {
    return !in_array($img['letra'], $_SESSION['letras_vistas']);
});

if (empty($imagenes_disponibles)) {
    // Si ya no hay, reinicia
    $_SESSION['letras_vistas'] = [];
    $_SESSION['error_streak'] = 0;
    $correctas_count = 0;
    $imagenes_disponibles = $imagenes;
}

$indice = array_rand($imagenes_disponibles);
$imagenActual = $imagenes_disponibles[$indice];
$_SESSION['letra_actual'] = $imagenActual['letra'];
$_SESSION['nombre_actual'] = $imagenActual['nombre'];
$_SESSION['img_actual'] = $imagenActual['img'];

$letraCorrectaDisplay = $_SESSION['letra_actual'];
$nombreDisplay = $_SESSION['nombre_actual'];
$imgURLDisplay = $_SESSION['img_actual'];
$letras = range('A', 'Z');
array_splice($letras, 14, 0, 'Ñ');

// URL de la imagen de la casa (botón Inicio)
$url_img_casa = 'https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg';

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>🎵 ¡Adivina la Letra! — Silabario Mágico</title>

<!-- Fuentes / estilos combinados (tomado del "segundo código" como referencia) -->
<style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@700;900&display=swap');

    :root {
        --card-bg: #ffffff;
        --accent-blue: #0288d1;
        --accent-light: #b2ebf2;
    }

    html,body { box-sizing: border-box; }
    *,*::before,*::after{ box-sizing: inherit; }

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
    }
    @keyframes gentleGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .main-container {
        max-width: 950px;
        width: 100%;
        margin: 0 auto;
        background: var(--card-bg);
        border-radius: 24px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.12);
        padding: clamp(1.2rem, 3vw, 2.2rem);
        position: relative;
        .main-container
        text-align: center;
    }

.titulo-juego {
    font-size: 2.5rem;
    color: #fdaaaaff;
    margin-top: 20px;
}



    .top-row {
        display:flex;
        justify-content: space-between;
        align-items: center;
        gap: 10px;
        margin-bottom: 1rem;
    }

    .titulo-juego {
        font-weight: 900;
        font-size: clamp(1.6rem, 4vw, 2.6rem);
        color: var(--accent-blue);
        margin: 0;
        border-bottom: 4px solid #fff59d;
        padding-bottom: 0.3rem;
    }

    /* boton menu estilo 3D */
    .btn-top-menu {
        background: #bbdefb;
        color: #1976d2;
        border-radius: 12px;
        border: 3px solid rgba(25,118,210,0.15);
        padding: 8px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        box-shadow: 0 6px 0 0 #1976d2;
        text-decoration:none;
    }
    .btn-top-menu img { height: 2rem; width:auto; border-radius:6px; display:block; }

    .progreso {
        background-color: rgba(255,255,255,0.95);
        padding: 8px 14px;
        border-radius: 12px;
        font-weight: 800;
        color: #0277bd;
        border: 3px solid #b2ebf2;
        box-shadow: 0 6px 0 rgba(0,0,0,0.08);
    }

    .game-content {
        display:flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }

    .game-image {
        width: clamp(180px, 40vw, 320px);
        height: clamp(180px, 40vw, 320px);
        border-radius: 18px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        background: white;
        padding: 8px;
        object-fit: contain;
        border: 3px solid var(--accent-light);
        cursor: pointer;
        transition: transform .18s ease;
    }
    .game-image:hover { transform: scale(1.03); }

    .pista {
        font-size: clamp(1.0rem, 2.8vw, 1.3rem);
        font-weight: 800;
        color: #444;
    }
    .pista span { color: var(--accent-blue); }

    /* GRID de letras - adaptado con botones 3D del segundo codigo */
    .letras-grid {
        display:grid;
        grid-template-columns: repeat(9,1fr);
        gap: 10px;
        max-width: 820px;
        width: 100%;
        margin-top: 0.8rem;
    }

    .btn-letra {
        font-family: 'Nunito', sans-serif;
        font-weight: 900;
        font-size: clamp(1.1rem, 2.6vw, 1.4rem);
        border: 3px solid transparent;
        border-radius: 12px;
        padding: 12px;
        aspect-ratio: 1/1;
        color: white;
        cursor:pointer;
        display:flex;
        align-items:center;
        justify-content:center;
        transition: transform .15s, box-shadow .15s, background-color .2s;
        box-shadow: 0 5px 0 0 rgba(0,0,0,0.18);
        user-select:none;
    }
    .btn-letra:active { transform: translateY(3px); box-shadow: 0 2px 0 0 rgba(0,0,0,0.18); }

    /* Paleta infantil (similar a la que tenías) */
    .btn-letra:nth-child(8n+1) { background: #FF6B6B; box-shadow: 0 6px 0 0 #e05252; }
    .btn-letra:nth-child(8n+2) { background: #4ECDC4; box-shadow: 0 6px 0 0 #3aa89f; }
    .btn-letra:nth-child(8n+3) { background: #45B7D1; box-shadow: 0 6px 0 0 #3c9cb0; }
    .btn-letra:nth-child(8n+4) { background: #FFA07A; box-shadow: 0 6px 0 0 #e08560; }
    .btn-letra:nth-child(8n+5) { background: #FFD166; box-shadow: 0 6px 0 0 #e0b44f; color:#333; }
    .btn-letra:nth-child(8n+6) { background: #BAE67E; box-shadow: 0 6px 0 0 #9ec961; color:#333; }
    .btn-letra:nth-child(8n+7) { background: #B39DDB; box-shadow: 0 6px 0 0 #967ec2; }
    .btn-letra:nth-child(8n+8) { background: #FF96C5; box-shadow: 0 6px 0 0 #e07aa8; }

    .btn-letra:hover { transform: translateY(-4px) scale(1.02); }

    .btn-letra:disabled {
        background: #ddd !important;
        box-shadow: 0 5px 0 0 #bbb !important;
        cursor: default;
        opacity: 0.85;
        transform: none;
    }

    #mensaje {
        margin-top: 0.8rem;
        font-size: clamp(1rem, 2.6vw, 1.3rem);
        font-weight: 800;
        color: #333;
        min-height: 1.2em;
    }

    /* Modal y mensaje final */
    #milestoneModal, #mensajeFinal {
        display: none;
        position: fixed;
        top:50%; left:50%;
        transform: translate(-50%,-50%);
        z-index: 9999;
        padding: 1.6rem;
        border-radius: 16px;
        background: rgba(255,255,255,0.98);
        border: 4px dashed #b2ebf2;
        text-align:center;
    }
    #mensajeFinal { color: #d32f2f; border-color: #ffcdd2; }

    .navigation-buttons {
        display: none;
        gap: 12px;
        justify-content:center;
        margin-top: 1.6rem;
    }
    .navigation-buttons.show { display:flex; }

    .btn-childish {
        font-weight:900;
        border:none;
        border-radius:12px;
        padding: 10px 18px;
        color: #fff;
        text-decoration:none;
        display:inline-flex;
        gap:10px;
        align-items:center;
        justify-content:center;
        box-shadow: 0 7px 0 0 rgba(0,0,0,0.25);
    }
    .btn-menu { background:#bbdefb; color:#1976d2; box-shadow: 0 7px 0 0 #1976d2; }
    .btn-restart { background:#ffcdd2; color:#d32f2f; box-shadow: 0 7px 0 0 #d32f2f; }

    /* burbujas efímeras (decoración) */
    .bubble {
        position:absolute; bottom:-150px; border-radius:50%; opacity:0.6;
        animation: subirBubble 10s linear infinite; z-index:1; pointer-events:none;
    }
    @keyframes subirBubble {
        0% { transform: translateY(0) scale(1); opacity:0.6; }
        100% { transform: translateY(-110vh) scale(1.1); opacity:0; }
    }

    /* Confetti canvas */
    #confetti { position: fixed; top:0; left:0; width:100%; height:100%; z-index:1000; pointer-events:none; display:none; }

    /* Responsive */
    @media (max-width: 768px) {
        .letras-grid { grid-template-columns: repeat(6,1fr); gap:8px; }
        .titulo-juego { font-size: clamp(1.4rem,4vw,2.2rem); }
        .btn-top-menu img { height:1.6rem; }
        .progreso { font-size: .95rem; }
    }
    @media (max-width: 480px) {
        .letras-grid { grid-template-columns: repeat(4,1fr); gap:6px; }
        .game-image { width: clamp(140px, 45vw, 220px); height: clamp(140px,45vw,220px); }
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


<div style="position:fixed; right:18px; top:18px;" class="progreso">
    Progreso: <span id="progreso-actual"><?= $correctas_count ?></span> / <span id="progreso-total"><?= $total_letras ?></span>
</div>

<div class="main-container">
    <div class="top-row">
        <h1 class="titulo-juego">¡Adivina la Letra!</h1>
    </div>

    <div class="game-content">
        <img id="gameImage" src="<?= htmlspecialchars($imgURLDisplay) ?>" alt="Imagen del juego" class="game-image">

        <p class="pista"><strong>Pista:</strong> Empieza con la letra de <span id="pistaNombre"><?= htmlspecialchars($nombreDisplay) ?></span></p>

        <div class="letras-grid" id="letrasGrid">
            <?php foreach ($letras as $letra): ?>
                <button class="btn-letra" data-letra="<?= $letra ?>"><?= $letra ?></button>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="mensaje">¡Adivina la letra! 🧐</div>

    <div class="navigation-buttons" id="nav-buttons">
        <a href="inicio.html" class="btn-childish btn-menu">
            <img src="<?= htmlspecialchars($url_img_casa) ?>" alt="Inicio" style="height:1.4rem;border-radius:6px;">
            <span>Ir al Inicio</span>
        </a>
        <a href="#" class="btn-childish btn-restart" id="btn-restart">
            <img src="https://cdn-icons-png.flaticon.com/512/6097/6097933.png" alt="Volver a Jugar" style="height:1.4rem;border-radius:6px;">
            <span>Jugar de Nuevo</span>
        </a>
    </div>

</div>

<canvas id="confetti"></canvas>
<div id="mensajeFinal"></div>

<div id="milestoneModal">
    🎉 ¡Felicidades! 🎉
    <div id="milestoneMessage" style="font-size:1rem; margin-top:.6rem;">¡Llevas 5 correctas!</div>
</div>

<!-- Audios -->
<audio id="bgMusic" src="https://cdn.pixabay.com/audio/2022/10/04/audio_331602a640.mp3" loop preload="auto"></audio>
<audio id="milestoneSound" src="https://cdn.pixabay.com/audio/2022/03/10/audio_1c50e25a29.mp3" preload="auto"></audio>
<audio id="errorSound" src="https://cdn.pixabay.com/audio/2022/03/15/audio_16db7fb135.mp3" preload="auto"></audio>
<audio id="matchSound" src="https://cdn.pixabay.com/audio/2022/11/17/audio_7065b49869.mp3" preload="auto"></audio>
<audio id="winSound" src="https://cdn.pixabay.com/audio/2022/01/18/audio_735a266a2e.mp3" preload="auto"></audio>
<audio id="errorStreakSound" src="https://cdn.pixabay.com/audio/2021/08/04/audio_1c50e25a29.mp3" preload="auto"></audio>
<audio id="winGameSound" src="https://cdn.pixabay.com/audio/2022/08/02/audio_82133a8a3b.mp3" preload="auto"></audio>

<script>
    // Datos desde PHP
    const phpData = {
        letraCorrecta: "<?= $letraCorrectaDisplay ?>",
        nombreActual: "<?= $nombreDisplay ?>",
        imgURLActual: "<?= $imgURLDisplay ?>",
        correctasCount: <?= $correctas_count ?>,
        totalLetras: <?= $total_letras ?>,
        mensajesError: <?= json_encode($mensajes_error) ?>,
        mensajesExitoPrefix: <?= json_encode($mensajes_exito_prefix) ?>
    };

    // Estado JS
    let audioUnlocked = false;
    let errorStreak = <?= $_SESSION['error_streak'] ?>;
    let pendingNextImage = null;

    const bgColors = [
        'linear-gradient(135deg, #a8edea, #fed6e3)',
        'linear-gradient(180deg, #D4F0D4 0%, #A9D9A9 50%, #FFEBCC 100%)',
        'linear-gradient(180deg, #FFF8DC 0%, #FFECB3 50%, #D1C4E9 100%)',
        'linear-gradient(180deg, #FFE0E6 0%, #FFC2C2 50%, #B2EBF2 100%)',
        'linear-gradient(180deg, #BDE0FE 0%, #A2D2FF 50%, #FFC8DD 100%)'
    ];
    let currentColorIndex = 0;
    function changeBackground(){
        currentColorIndex = (currentColorIndex + 1) % bgColors.length;
        document.body.style.background = bgColors[currentColorIndex];
    }

    document.addEventListener('DOMContentLoaded', () => {
        const mensajeDiv = document.getElementById('mensaje');
        const mensajeFinalDiv = document.getElementById('mensajeFinal');
        const navButtons = document.getElementById('nav-buttons');
        const restartButton = document.getElementById('btn-restart');
        const gameImage = document.getElementById('gameImage');
        const pistaNombre = document.getElementById('pistaNombre');
        const letrasGrid = document.getElementById('letrasGrid');
        const progresoActualSpan = document.getElementById('progreso-actual');

        // Modal
        const milestoneModal = document.getElementById('milestoneModal');
        const milestoneMessage = document.getElementById('milestoneMessage');

        // Audios
        const bgMusic = document.getElementById('bgMusic');
        const milestoneSound = document.getElementById('milestoneSound');
        const matchSound = document.getElementById('matchSound');
        const winSound = document.getElementById('winSound');
        const errorSound = document.getElementById('errorSound');
        const errorStreakSound = document.getElementById('errorStreakSound');
        const winGameSound = document.getElementById('winGameSound');

        const confettiCanvas = document.getElementById('confetti');
        const confettiCtx = confettiCanvas.getContext('2d');

        function unlockAudio() {
            if (audioUnlocked) return;
            try {
                const audios = [matchSound, errorSound, winSound, errorStreakSound, winGameSound, bgMusic, milestoneSound];
                audios.forEach(audio => {
                    audio.play().catch(e => {});
                    audio.pause();
                    audio.currentTime = 0;
                });
                bgMusic.volume = 0.08;
                bgMusic.play().catch(e => {});
                if ('speechSynthesis' in window) {
                    let primer = new SpeechSynthesisUtterance(' ');
                    primer.volume = 0;
                    speechSynthesis.speak(primer);
                }
            } catch(e){}
            audioUnlocked = true;
        }

        function playSound(audioElement, volume = 0.4) {
            if (!audioUnlocked) return;
            if (audioElement && typeof audioElement.play === 'function') {
                audioElement.currentTime = 0;
                audioElement.volume = volume;
                audioElement.play().catch(e => {});
            }
        }

        function hablar(texto) {
            if (!audioUnlocked) return;
            if ('speechSynthesis' in window && texto) {
                try {
                    speechSynthesis.cancel();
                    const voz = new SpeechSynthesisUtterance(texto);
                    voz.lang = 'es-ES';
                    voz.rate = 1.0;
                    voz.pitch = 1.2;
                    speechSynthesis.speak(voz);
                } catch(e) {}
            }
        }

        function disableLetterButtons() {
            letrasGrid.querySelectorAll('.btn-letra').forEach(b => b.disabled = true);
        }
        function enableLetterButtons() {
            letrasGrid.querySelectorAll('.btn-letra').forEach(b => b.disabled = false);
        }

        function gameOver(fraseVictoria) {
            mensajeDiv.textContent = '¡Felicidades! 🥳 ¡Completaste el abecedario!';
            mensajeFinalDiv.innerHTML = `🎉 ¡Lo lograste! 🎉<span style="display:block;margin-top:.6rem;">${fraseVictoria}</span>`;
            mensajeFinalDiv.style.display = 'block';
            navButtons.classList.add('show');
            playSound(winGameSound, 0.6);
            setTimeout(()=>playSound(winSound,0.4), 500);
            hablar(fraseVictoria);
            startConfettiAnimation();
            disableLetterButtons();
        }

        function showNextRound(next_image) {
            if (!next_image) return;
            phpData.letraCorrecta = next_image.letra;
            phpData.nombreActual = next_image.nombre;
            phpData.imgURLActual = next_image.img;
            changeBackground();
            gameImage.src = phpData.imgURLActual;
            pistaNombre.textContent = phpData.nombreActual;
            mensajeDiv.innerHTML = "¡Adivina la letra! 🧐";
            enableLetterButtons();
        }

        function showMilestoneModal(count, next_image) {
            pendingNextImage = next_image;
            const mensaje = `¡Increíble! ¡Llevas ${count} correctas! 🥳`;
            const vozMensaje = `¡Increíble! ¡Llevas ${count} correctas! ¿Quieres continuar o ir al menú?`;
            milestoneMessage.textContent = mensaje;
            milestoneModal.style.display = 'block';
            playSound(milestoneSound, 0.6);
            hablar(vozMensaje);
        }

        function checkAnswer(chosenLetter) {
            unlockAudio();
            disableLetterButtons();

            if (chosenLetter === phpData.letraCorrecta) {
                errorStreak = 0;
                const prefix = phpData.mensajesExitoPrefix[Math.floor(Math.random() * phpData.mensajesExitoPrefix.length)];
                const audioText = `${prefix}, ${phpData.letraCorrecta} de ${phpData.nombreActual}`;
                mensajeDiv.innerHTML = `¡${prefix}! Es la <strong>${phpData.letraCorrecta}</strong> de <strong>${phpData.nombreActual}</strong>. 🎉`;
                playSound(matchSound);
                hablar(audioText);

                fetch(`?guess=${chosenLetter}`)
                    .then(res => res.json())
                    .then(data => {
                        if (!data.correct) return;
                        phpData.correctasCount = data.correctas_count;
                        progresoActualSpan.textContent = phpData.correctasCount;

                        if (data.game_over) {
                            setTimeout(() => {
                                gameOver(data.frase_victoria);
                            }, 1600);
                        } else if (data.correctas_count % 5 === 0) {
                            setTimeout(()=> {
                                showMilestoneModal(data.correctas_count, data.next_image);
                            }, 1200);
                        } else {
                            setTimeout(()=> {
                                showNextRound(data.next_image);
                            }, 1200);
                        }
                    })
                    .catch(err => {
                        console.error('Error fetch:', err);
                        mensajeDiv.textContent = "Error de conexión. Intenta de nuevo.";
                        enableLetterButtons();
                    });

            } else {
                errorStreak++;
                const errorMsg = phpData.mensajesError[Math.floor(Math.random() * phpData.mensajesError.length)];
                mensajeDiv.innerHTML = errorMsg;
                hablar(errorMsg);

                if (errorStreak >= 3) {
                    playSound(errorStreakSound, 0.5);
                    errorStreak = 0;
                } else {
                    playSound(errorSound, 0.3);
                }

                setTimeout(() => {
                    enableLetterButtons();
                    mensajeDiv.innerHTML = "¡Adivina la letra! 🧐";
                }, 1400);
            }
        }

        // Eventos
        letrasGrid.addEventListener('click', (e) => {
            unlockAudio();
            if (e.target.classList.contains('btn-letra') && !e.target.disabled) {
                checkAnswer(e.target.dataset.letra);
            }
        });

        restartButton.addEventListener('click', (e) => {
            e.preventDefault();
            unlockAudio();
            hablar("Reiniciando el juego");
            fetch('?action=reset')
                .then(res => res.json())
                .then(data => {
                    if (data.success) window.location.reload();
                });
        });

        if (gameImage) {
            gameImage.addEventListener('click', () => {
                unlockAudio();
                hablar(phpData.nombreActual);
            });
        }

        // Modal click para continuar (simula "continuar")
        milestoneModal.addEventListener('click', (e) => {
            if (e.target.closest('a')) return;
            milestoneModal.style.display = 'none';
            if (pendingNextImage) {
                showNextRound(pendingNextImage);
                pendingNextImage = null;
            }
        });

        // Burbujas decorativas
        function crearBubble() {
            if (document.hidden) return;
            const bubble = document.createElement('div');
            bubble.className = 'bubble';
            const size = Math.random() * 60 + 20;
            bubble.style.width = `${size}px`;
            bubble.style.height = `${size}px`;
            bubble.style.left = `${Math.random() * 100}vw`;
            bubble.style.animationDuration = `${Math.random() * 5 + 8}s`;
            const cat = Math.random();
            if (cat < 0.33) {
                bubble.style.background = `rgba(178, 235, 242, ${Math.random() * 0.4 + 0.3})`;
                bubble.style.border = "1px solid rgba(77, 208, 225, 0.5)";
            } else if (cat < 0.66) {
                bubble.style.background = `rgba(254, 214, 227, ${Math.random() * 0.4 + 0.3})`;
                bubble.style.border = "1px solid rgba(255, 179, 179, 0.5)";
            } else {
                bubble.style.background = `rgba(255, 245, 157, ${Math.random() * 0.4 + 0.3})`;
                bubble.style.border = "1px solid rgba(255, 236, 179, 0.5)";
            }
            document.body.appendChild(bubble);
            setTimeout(()=> bubble.remove(), 13000);
        }
        setInterval(crearBubble, 1200);

        // Confetti en canvas
        let particles = [], animId;
        function startConfettiAnimation() {
            confettiCanvas.style.display = 'block';
            resizeCanvas();
            particles = [];
            for (let i=0;i<140;i++) particles.push(createParticle());
            drawConfetti();
        }
        function drawConfetti(){
            confettiCtx.clearRect(0,0,confettiCanvas.width, confettiCanvas.height);
            particles.forEach(p => {
                p.y += p.speed;
                p.x += Math.sin(p.y * p.drift) * p.driftAmp;
                p.rotation += p.rotationSpeed;
                confettiCtx.save();
                confettiCtx.translate(p.x,p.y);
                confettiCtx.rotate(p.rotation * Math.PI/180);
                confettiCtx.fillStyle = p.color;
                confettiCtx.fillRect(-p.size/2, -p.size/2, p.size, p.size);
                confettiCtx.restore();
                if (p.y > confettiCanvas.height) { p.y = -20; p.x = Math.random() * confettiCanvas.width; }
            });
            animId = requestAnimationFrame(drawConfetti);
        }
        function createParticle(){
            const colors = ['#FF6B6B','#4ECDC4','#45B7D1','#FFA07A','#FFD166','#BAE67E','#B39DDB','#FF96C5'];
            return {
                x: Math.random() * confettiCanvas.width,
                y: Math.random() * confettiCanvas.height - confettiCanvas.height,
                size: Math.random() * 10 + 5,
                speed: Math.random() * 3 + 2,
                color: colors[Math.floor(Math.random() * colors.length)],
                rotation: Math.random() * 360,
                rotationSpeed: Math.random() * 10 - 5,
                drift: Math.random() * 0.1,
                driftAmp: Math.random() * 2 + 1
            };
        }
        function resizeCanvas() {
            confettiCanvas.width = window.innerWidth;
            confettiCanvas.height = window.innerHeight;
        }
        window.addEventListener('resize', resizeCanvas);

    });
</script>

</body>
</html>
