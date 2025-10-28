<?php
?>

<!doctype html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Traza las vocales — Mayúsculas y minúsculas</title>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Nunito:wght@700;900&display=swap" rel="stylesheet">
<style>
body {
  font-family: 'Nunito', sans-serif;
  margin: 0;
  background: #f0f4f8;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: flex-start;
  min-height: 100vh;
  padding: 2rem;
  overflow-x: hidden;
}

h1 {
  font-family: 'Fredoka One', cursive;
  font-weight: 900;
  font-size: 2.5rem;
  color: #1d4ed8;
  margin-bottom: 1rem;
}

#canvas-container {
  position: relative;
  background: #fff;
  border-radius: 12px;
  border: 3px solid #ccc;
  margin: 1.5rem 0;
  width: 500px;
  height: 500px;
  overflow: hidden;
}

#guide-text {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  font-size: 14em;
  font-weight: 900;
  color: rgba(200,200,200,0.3);
  pointer-events: none;
}

canvas {
  width: 100%;
  height: 100%;
  touch-action: none;
}

.controls {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  justify-content: center;
  margin-bottom: 1rem;
}

.btn-childish {
  font-family: 'Fredoka One', cursive;
  font-weight: bold;
  border: none;
  border-radius: 15px;
  padding: 1rem 1.5rem;
  cursor: pointer;
  user-select: none;
  text-decoration: none;
  color: #fff;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  box-shadow: 0 6px 0 rgba(0,0,0,0.2);
  transition: all 0.2s ease-out;
}

.btn-childish:hover { transform: translateY(-4px); box-shadow: 0 10px 0 rgba(0,0,0,0.2); }
.btn-childish:active { transform: translateY(2px); box-shadow: 0 3px 0 rgba(0,0,0,0.2); }

.btn-clear { background: linear-gradient(90deg, #f87171, #ef4444); }
.btn-next { background: linear-gradient(90deg, #34d399, #10b981); }
.btn-menu { background: linear-gradient(90deg, #60a5fa, #2563eb); }

#final-message {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  background: rgba(255,255,255,0.97);
  padding: 2rem 3rem;
  border-radius: 20px;
  color: #16a34a;
  font-size: 2em;
  font-weight: 900;
  box-shadow: 0 10px 20px rgba(0,0,0,0.2);
  display: none;
  z-index: 1001;
  animation: fadeIn 1s ease forwards;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translate(-50%, -60%); }
  to { opacity: 1; transform: translate(-50%, -50%); }
}

#confetti-canvas {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  pointer-events: none;
  z-index: 1000;
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

<h1>Traza la Vocal ✍️</h1>


    <div class="controls">
  <button class="btn-childish btn-clear" id="clear-btn">
    <img src="https://cdn-icons-png.flaticon.com/512/109/109602.png" alt="Borrar" style="height:1.2em;">
    Borrar
  </button>
  <button class="btn-childish btn-next" id="next-btn">
    Siguiente
    <span style="font-size:1.5em; margin-left:5px;">➡️</span>
  </button>

</div>

</div>

<div id="canvas-container">
  <div id="guide-text">A</div>
  <canvas id="drawing-canvas"></canvas>
</div>

        <div class="navigation-buttons">
            <a href="inicio.html" class="btn-childish btn-menu">
                <img src="https://static.vecteezy.com/system/resources/previews/011/795/207/non_2x/cartoon-house-and-the-sun-in-the-grass-field-vector.jpg" alt="Inicio">
                <span>Ir al Inicio</span>
            </a>
        </div>

<div id="final-message">🎉 ¡Felicidades! Lo hiciste muy bien 👏</div>
<canvas id="confetti-canvas"></canvas>

<script>
const canvas = document.getElementById('drawing-canvas');
const ctx = canvas.getContext('2d');
const guideText = document.getElementById('guide-text');
const clearBtn = document.getElementById('clear-btn');
const nextBtn = document.getElementById('next-btn');
const menuBtn = document.getElementById('menu-btn');
const confettiCanvas = document.getElementById('confetti-canvas');
const confettiCtx = confettiCanvas.getContext('2d');
const finalMessage = document.getElementById('final-message');

const LETTERS = ['A', 'E', 'I', 'O', 'U'];
let currentIndex = 0;
let drawing = false;

function resizeCanvas() {
  canvas.width = 500;
  canvas.height = 500;
  confettiCanvas.width = window.innerWidth;
  confettiCanvas.height = window.innerHeight;
}
window.addEventListener('load', resizeCanvas);
window.addEventListener('resize', resizeCanvas);

canvas.addEventListener('mousedown', e => startDraw(e));
canvas.addEventListener('mousemove', e => draw(e));
canvas.addEventListener('mouseup', stopDraw);
canvas.addEventListener('mouseout', stopDraw);
canvas.addEventListener('touchstart', e => startDraw(e));
canvas.addEventListener('touchmove', e => draw(e));
canvas.addEventListener('touchend', stopDraw);

function getPos(e){
  const rect = canvas.getBoundingClientRect();
  const x = (e.touches ? e.touches[0].clientX : e.clientX) - rect.left;
  const y = (e.touches ? e.touches[0].clientY : e.clientY) - rect.top;
  return {x, y};
}

function startDraw(e){
  drawing = true;
  ctx.beginPath();
  const {x, y} = getPos(e);
  ctx.moveTo(x, y);
}

function draw(e){
  if(!drawing) return;
  const {x, y} = getPos(e);
  ctx.lineWidth = 15;
  ctx.lineCap = "round";
  ctx.strokeStyle = "#1e40af";
  ctx.lineTo(x, y);
  ctx.stroke();
}

function stopDraw(){
  drawing = false;
  ctx.closePath();
}

clearBtn.addEventListener('click', () => ctx.clearRect(0,0,canvas.width,canvas.height));

nextBtn.addEventListener('click', () => {
  if(currentIndex < LETTERS.length - 1){
    currentIndex++;
    guideText.textContent = LETTERS[currentIndex];
    ctx.clearRect(0,0,canvas.width,canvas.height);
  } else {
    showFinal();
  }
});

menuBtn.addEventListener('click', () => window.location.href = "menu.php");

function showFinal(){
  finalMessage.style.display = "block";
  startConfetti();
}

let confettiPieces = [];
let animationId;

function startConfetti(){
  confettiPieces = [];
  for(let i=0; i<200; i++){
    confettiPieces.push({
      x: Math.random() * confettiCanvas.width,
      y: Math.random() * confettiCanvas.height - confettiCanvas.height,
      size: Math.random() * 8 + 4,
      color: `hsl(${Math.random()*360},80%,60%)`,
      speed: Math.random() * 3 + 2
    });
  }
  cancelAnimationFrame(animationId);
  animateConfetti();
}

function animateConfetti(){
  confettiCtx.clearRect(0,0,confettiCanvas.width,confettiCanvas.height);
  confettiPieces.forEach(p=>{
    p.y += p.speed;
    if(p.y > confettiCanvas.height) p.y = -10;
    confettiCtx.fillStyle = p.color;
    confettiCtx.fillRect(p.x, p.y, p.size, p.size);
  });
  animationId = requestAnimationFrame(animateConfetti);
}
</script>

</body>
</html>
