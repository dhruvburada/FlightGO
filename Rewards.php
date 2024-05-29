<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rewards</title>


    <script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </script>
</head>

<style>
body {
            margin: 0;
            padding: 0;
            font-family: 'Roboto';
            overflow-x: hidden;
            overflow-y: hidden;
            height: 100vh;  

        }

        .header { 
            width: 100%;
            padding: 40px 0;  
            display: flex;
            flex-direction: column; 
            justify-content: center;
            align-items: center; 

        }

        .title {
            font-weight: 400;
            color: #333; /* Set title color to dark */
        }

        .info {
            padding-top: 4px;
            font-size: 12px;
            font-weight: 400;
            color: #333;}

.container {
  background-color: rgb(255, 255, 0);
  width: 100vw;
  height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  align-items: center;
}   

.center {
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
}

.myButton {
	-moz-box-shadow:inset 0px -3px 7px 0px #29bbff;
	-webkit-box-shadow:inset 0px -3px 7px 0px #29bbff;
	box-shadow:inset 0px -3px 7px 0px #29bbff;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #2dabf9), color-stop(1, #0688fa));
	background:-moz-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
	background:-webkit-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
	background:-o-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
	background:-ms-linear-gradient(top, #2dabf9 5%, #0688fa 100%);
	background:linear-gradient(to bottom, #2dabf9 5%, #0688fa 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#2dabf9', endColorstr='#0688fa',GradientType=0);
	background-color:#2dabf9;
	-moz-border-radius:3px;
	-webkit-border-radius:3px;
	border-radius:3px;
	border:1px solid #0b0e07;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	padding:9px 23px;
	text-decoration:none;
	text-shadow:0px 1px 0px #263666;
}

.footer {
  width: 100%;
}

.text {
  font-size: 14px;
  font-weight: 500;
  color: #333;
  padding-bottom: 2px;
}

.description {
  font-size: 10px;
  font-weight: 300;
  color: #333;

}

.box-wrapper {
  width: 170px;
  height: 170px;
  display: flex;
  justify-content: center;
  align-items: center;
  background: indianred;
  border-bottom-left-radius: 8px;
  border-bottom-right-radius: 8px;
  user-select: none;
  transition: 400ms ease-out all;
}

#bms-logo {
  width: 40px;
  height: 40px;
  user-select: none;
}

.scale-down {
  transform: scale(0.5);
}

.box-container {
  display: flex;
  justify-content: center;
  align-items: center;
}

.box-cover {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 40px;
  background-color: #fb5052;
}

.giftbox {
	width: 160px;
	height: 137px;
	position: absolute;
	bottom: 160px;
	z-index: 10;
	cursor: pointer;
  transform: translateX(0px);
}

.animate-box {
  animation: move 0.6s;
  animation-fill-mode: forwards;
}

.content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  padding: 20px 0;
  border-top:  1px solid gray;
  margin: 0 16px;
}

.giftbox::after {
   content: '';
    display: block;
    position: absolute;
    bottom: -1px;
    width: 100%;
    max-width: 210px;
    height: 19px;
    background: transparent;
    border-radius: 50%;
    box-shadow: 0 50px 61px rgba(0,0,0,0.5);
}

.giftbox > div {
	background: #fb5052;
	position: absolute;
}

.trapezoid {
	border-bottom: 30px solid #555;
	border-left: 25px solid transparent;
	border-right: 25px solid transparent;
	height: 0;
	width: 70%;
  z-index: 3;
}

.giftbox .cover {
	top: -25px;
	left: 0;
	height: 25%;
	width: 100%;
	z-index: 2;
  border-bottom-left-radius: 4px;
  border-bottom-right-radius: 4px;
}

.animate-cover {
  animation: open-box 1s;
  animation-fill-mode: forwards;
}

.giftbox .box {
	bottom: 0;
	height: 96%;
	left: 5%;
	right: 5%;
	z-index: 1;
  border-bottom-left-radius: 10px;
  border-bottom-right-radius: 10px;
}

.giftbox > div::after,
.giftbox > div::before {
	content: '';
	position: absolute;
	top: 0;
} 

/* ribbon */
.giftbox > div::before {
	background: #ffce00;
	width: 10px;
	left: 50%;
	height: 100%;
	-webkit-transform: translateX(-50%);
	transform: translateX(-50%);
}

/* shadow */
.giftbox .box::after {
	background: rgba(0,0,0,0.2);
	left: 0;
	height: 20px;
	width: 100%;
}

.giftbox .cover div {
	position: absolute;
	height: 60px;
	width: 60px;
	bottom: 100%;
	left: 50%;
	margin-left: -30px;
}

.giftbox .cover div::before,
.giftbox .cover div::after {
	position: absolute;
  width: 111%;
  height: 52%;
	content: '';
	background: transparent;
	border-radius: 80%;
	box-shadow: inset 0 0 0 4px #ffce00;
}

.giftbox .cover div::before {
  transform: translateX(-52%) translateY(97%) skewY(17deg);
}

.giftbox .cover div::after {
  transform: translateX(43%) translateY(97%) skewY(-17deg);
}

.box {
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}

.line {
  width: 2px;
  height: 100%;
  background-color: #fd6165;
  border-left: 1px solid #f7575b;
}

.logo {
  position: absolute;
  width: 80px;
  height: 80px;
  z-index: 4;
  background: white;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  user-select: none;
}

.logo > img {
  width: 40px;
  height; 40px;
}

@keyframes move {
  0% { 
    transform: translateY(0px) scale(1);
  }
  100% {
    transform: translateY(120px) scale(0.4);
  }
}

@keyframes open-box{
  0% { 
    transform: translateY(0px);
  }
  50% {
    transform: translateY(-200px);
  }
  100% {
    transform: translateY(0px) rotate(-16deg)  
  }
}


.abc {
  position: relative;
  min-height: 100vh;
}

[class|="confetti"] {
  position: absolute;
}

$colors: (#d13447, #ffbf00, #263672);

@for $i from 0 through 150 {
  $w: random(8);
  $l: random(100);
  .confetti-#{$i} {
    width: #{$w}px;
    height: #{$w*0.4}px;
    background-color: nth($colors, random(3));
    bottom: 0;
    left: unquote($l+"%");
    opacity: random() + 0.5;
    transform: rotate(#{random()*360}deg);
    animation: drop-#{$i} unquote(0.8+random()+"s") unquote(random()+"s") forwards;
  }

  @keyframes drop-#{$i} {
    0% {
      bottom: 0;
      left: unquote($l+random(15)+"%");
    }
    50% {
      bottom: 50%;
    }
    100% {
      bottom: 0;
      left: unquote($l+random(15)+"%");
    }
  }
}

.rewards-text {
            padding: 16px;
            width: 2%;
            height: 400px;
            background-color: #fffff0; /* Set background color to white */
            border-radius: 4px;
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            box-shadow: 0px 0px 10px #333; /* Set box shadow color to dark */
        }
        .open-rewards-text {
            visibility: visible;
            animation: animate-rewards-text 0.8s;
            animation-fill-mode: forwards;
        }

        @keyframes animate-rewards-text {
            0% {
                width: 2%;
                height: 20px;
            }
            
            100% {
                width: 80%;
                height: 400px;
                visibility: visible;
            }
        }

</style>

<body>
<body>
  <div class='container'>
  <div class='container'>
        <div class='header'>
            <div class='title'>Yay! You've Earned Rewards Points</div>
            <div class='info'>Tap to Claim Your Rewards</div>
        </div>
        <div id='rewards' class='rewards-text'>Earned 20 rewards points can be used for future flight bookings</div> <!-- Modify text content -->
        <div id='fa' style='height:100%; width:100%;'></div>
    <div id='btn' class="giftbox">
      <div id='top' class="cover">
        <div></div>
      </div>
      <div class="box">
        <div class='logo'>
          <img src='https://in.bmscdn.com/webin/common/favicon.png'>
      </div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
        <div class='line'></div>
      </div>
    </div>
    <div class='footer'>
    <div class='content'>
        <div class='text'></div>
        <div class='description'>Continue to Flight Booking</div>
        <a href="TicketDetails.php" class="btn btn-primary">Next</a>
    </div>
</div>
  </div>
  <div class="confetti-wrapper">
   <span class="confetti">
  </div>
  <canvas id='canvas'></canvas>
</body>

<script>


window.requestAnimFrame = ( function() {
	return window.requestAnimationFrame ||
				window.webkitRequestAnimationFrame ||
				window.mozRequestAnimationFrame ||
				function( callback ) {
					window.setTimeout( callback, 1000 / 60 );
				};
})();

// now we will setup our basic variables for the demo
var canvas = document.getElementById( 'canvas' ),
		ctx = canvas.getContext( '2d' ),
		// full screen dimensions
		cw = window.innerWidth,
		ch = window.innerHeight,
		// firework collection
		fireworks = [],
		// particle collection
		particles = [],
		// starting hue
		hue = 120,
		// when launching fireworks with a click, too many get launched at once without a limiter, one launch per 5 loop ticks
		limiterTotal = 5,
		limiterTick = 0,
		// this will time the auto launches of fireworks, one launch per 80 loop ticks
		timerTotal = 80,
		timerTick = 0,
		mousedown = false,
		// mouse x coordinate,
		mx,
		// mouse y coordinate
		my;
		
// set canvas dimensions
canvas.width = cw;
canvas.height = ch;

// now we are going to setup our function placeholders for the entire demo

// get a random number within a range
function random( min, max ) {
	return Math.random() * ( max - min ) + min;
}

// calculate the distance between two points
function calculateDistance( p1x, p1y, p2x, p2y ) {
	var xDistance = p1x - p2x,
			yDistance = p1y - p2y;
	return Math.sqrt( Math.pow( xDistance, 2 ) + Math.pow( yDistance, 2 ) );
}

// create firework
function Firework( sx, sy, tx, ty ) {
	// actual coordinates
	this.x = sx;
	this.y = sy;
	// starting coordinates
	this.sx = sx;
	this.sy = sy;
	// target coordinates
	this.tx = tx;
	this.ty = ty;
	// distance from starting point to target
	this.distanceToTarget = calculateDistance( sx, sy, tx, ty );
	this.distanceTraveled = 0;
	// track the past coordinates of each firework to create a trail effect, increase the coordinate count to create more prominent trails
	this.coordinates = [];
	this.coordinateCount = 3;
	// populate initial coordinate collection with the current coordinates
	while( this.coordinateCount-- ) {
		this.coordinates.push( [ this.x, this.y ] );
	}
	this.angle = Math.atan2( ty - sy, tx - sx );
	this.speed = 2;
	this.acceleration = 1.05;
	this.brightness = random( 50, 70 );
	// circle target indicator radius
	this.targetRadius = 1;
}

// update firework
Firework.prototype.update = function( index ) {
	// remove last item in coordinates array
	this.coordinates.pop();
	// add current coordinates to the start of the array
	this.coordinates.unshift( [ this.x, this.y ] );
	
	// cycle the circle target indicator radius
	if( this.targetRadius < 8 ) {
		this.targetRadius += 0.3;
	} else {
		this.targetRadius = 1;
	}
	
	// speed up the firework
	this.speed *= this.acceleration;
	
	// get the current velocities based on angle and speed
	var vx = Math.cos( this.angle ) * this.speed,
			vy = Math.sin( this.angle ) * this.speed;
	// how far will the firework have traveled with velocities applied?
	this.distanceTraveled = calculateDistance( this.sx, this.sy, this.x + vx, this.y + vy );
	
	// if the distance traveled, including velocities, is greater than the initial distance to the target, then the target has been reached
	if( this.distanceTraveled >= this.distanceToTarget ) {
		createParticles( this.tx, this.ty );
		// remove the firework, use the index passed into the update function to determine which to remove
		fireworks.splice( index, 1 );
	} else {
		// target not reached, keep traveling
		this.x += vx;
		this.y += vy;
	}
}

// draw firework
Firework.prototype.draw = function() {
	ctx.beginPath();
	// move to the last tracked coordinate in the set, then draw a line to the current x and y
	ctx.moveTo( this.coordinates[ this.coordinates.length - 1][ 0 ], this.coordinates[ this.coordinates.length - 1][ 1 ] );
	ctx.lineTo( this.x, this.y );
	ctx.strokeStyle = 'hsl(' + hue + ', 100%, ' + this.brightness + '%)';
	ctx.stroke();
	
	ctx.beginPath();
	// draw the target for this firework with a pulsing circle
	ctx.arc( this.tx, this.ty, this.targetRadius, 0, Math.PI * 2 );
	ctx.stroke();
}

// create particle
function Particle( x, y ) {
	this.x = x;
	this.y = y;
	// track the past coordinates of each particle to create a trail effect, increase the coordinate count to create more prominent trails
	this.coordinates = [];
	this.coordinateCount = 5;
	while( this.coordinateCount-- ) {
		this.coordinates.push( [ this.x, this.y ] );
	}
	// set a random angle in all possible directions, in radians
	this.angle = random( 0, Math.PI * 2 );
	this.speed = random( 1, 10 );
	// friction will slow the particle down
	this.friction = 0.95;
	// gravity will be applied and pull the particle down
	this.gravity = 1;
	// set the hue to a random number +-20 of the overall hue variable
	this.hue = random( hue - 20, hue + 20 );
	this.brightness = random( 50, 80 );
	this.alpha = 1;
	// set how fast the particle fades out
	this.decay = random( 0.015, 0.03 );
}

// update particle
Particle.prototype.update = function( index ) {
	// remove last item in coordinates array
	this.coordinates.pop();
	// add current coordinates to the start of the array
	this.coordinates.unshift( [ this.x, this.y ] );
	// slow down the particle
	this.speed *= this.friction;
	// apply velocity
	this.x += Math.cos( this.angle ) * this.speed;
	this.y += Math.sin( this.angle ) * this.speed + this.gravity;
	// fade out the particle
	this.alpha -= this.decay;
	
	// remove the particle once the alpha is low enough, based on the passed in index
	if( this.alpha <= this.decay ) {
		particles.splice( index, 1 );
	}
}

// draw particle
Particle.prototype.draw = function() {
	ctx. beginPath();
	// move to the last tracked coordinates in the set, then draw a line to the current x and y
	ctx.moveTo( this.coordinates[ this.coordinates.length - 1 ][ 0 ], this.coordinates[ this.coordinates.length - 1 ][ 1 ] );
	ctx.lineTo( this.x, this.y );
	ctx.strokeStyle = 'hsla(' + this.hue + ', 100%, ' + this.brightness + '%, ' + this.alpha + ')';
	ctx.stroke();
}

// create particle group/explosion
function createParticles( x, y ) {
	// increase the particle count for a bigger explosion, beware of the canvas performance hit with the increased particles though
	var particleCount = 30;
	while( particleCount-- ) {
		particles.push( new Particle( x, y ) );
	}
}

// main demo loop
function loop() {
	// this function will run endlessly with requestAnimationFrame
	requestAnimFrame( loop );
	
	// increase the hue to get different colored fireworks over time
	hue += 0.5;
	
	// normally, clearRect() would be used to clear the canvas
	// we want to create a trailing effect though
	// setting the composite operation to destination-out will allow us to clear the canvas at a specific opacity, rather than wiping it entirely
	ctx.globalCompositeOperation = 'destination-out';
	// decrease the alpha property to create more prominent trails
	ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
	ctx.fillRect( 0, 0, cw, ch );
	// change the composite operation back to our main mode
	// lighter creates bright highlight points as the fireworks and particles overlap each other
	ctx.globalCompositeOperation = 'lighter';
	
	// loop over each firework, draw it, update it
	var i = fireworks.length;
	while( i-- ) {
		fireworks[ i ].draw();
		fireworks[ i ].update( i );
	}
	
	// loop over each particle, draw it, update it
	var i = particles.length;
	while( i-- ) {
		particles[ i ].draw();
		particles[ i ].update( i );
	}
	
	// launch fireworks automatically to random coordinates, when the mouse isn't down
	if( timerTick >= timerTotal ) {
		if( !mousedown ) {
			// start the firework at the bottom middle of the screen, then set the random target coordinates, the random y coordinates will be set within the range of the top half of the screen
			fireworks.push( new Firework( cw / 2, ch, random( 0, cw ), random( 0, ch / 2 ) ) );
			timerTick = 0;
		}
	} else {
		timerTick++;
	}
	
	// limit the rate at which fireworks get launched when mouse is down
	if( limiterTick >= limiterTotal ) {
		if( mousedown ) {
			// start the firework at the bottom middle of the screen, then set the current mouse coordinates as the target
			fireworks.push( new Firework( cw / 2, ch, mx, my ) );
			limiterTick = 0;
		}
	} else {
		limiterTick++;
	}
}

window.onload=function(){
  var merrywrap=document.getElementById("merrywrap");
  var box=merrywrap.getElementsByClassName("giftbox")[0];
  var step=1;
  var stepMinutes=[2000,2000,1000,1000];
  function init(){
          box.addEventListener("click",openBox,false);
  }
  function stepClass(step){
    merrywrap.className='merrywrap';
    merrywrap.className='merrywrap step-'+step;
  }
  function openBox(){
    if(step===1){
      box.removeEventListener("click",openBox,false); 
    }  
    stepClass(step); 
    if(step===3){ 
    } 
    if(step===4){
        reveal();
       return;
    }     
    setTimeout(openBox,stepMinutes[step-1]);
    step++;  
  }
   
  init();
 
}

function reveal() {
  document.querySelector('.merrywrap').style.backgroundColor = 'transparent';
  
  loop();
  
  var w, h;
  if(window.innerWidth >= 1000) {
    w = 295; h = 185;
  }
  else {
    w = 255; h = 155;
  }
  
  var ifrm = document.createElement("iframe");
        ifrm.setAttribute("src", "https://www.youtube.com/embed/KDxJlW6cxRk?controls=0&loop=1&autoplay=1");
        //ifrm.style.width = `${w}px`;
        //ifrm.style.height = `${h}px`;
        ifrm.style.border = 'none';
        document.querySelector('#video').appendChild(ifrm);
}


/*
@utlilty function
@description - Adds class to a element
*/
function addClass(elementId, classname) {
  var element, name, arr;
  element = document.getElementById(elementId);
  name = classname;
  arr = element.className.split(" ");
  if (arr.indexOf(name) == -1) {
    element.className += " " + name;
  }
}
 
/*
@utlilty function
@description - Removes class to a element
*/
function removeClass(id, className) {
  var element = document.getElementById(id);
  element.classList.remove(className);
}

var flyingMen = [];
var text = `&#9734;`; 
var button = document.getElementById('btn');
text.value = "0";
//emoji object
  function emoji(face, startx, starty, flour, fs, flyUpMax) {
    this.isAlive = true;
    this.face = face;
    this.x = startx;
    this.y = starty;
    this.flourLevel = flour;
    this.increment = -Math.floor((Math.random()*flyUpMax)+10);
    this.xincrement = Math.floor((Math.random()*10)+1);
    this.xincrement *= Math.floor(Math.random()*2) == 1 ? 1 : -1;
    this.element = document.createElement('div');
    this.element.innerHTML = face;
    this.element.style.position = "absolute";
    this.element.style.fontSize = fs + "px";
    this.element.style.color = "red";
    document.getElementById("fa").appendChild(this.element);

    this.refresh = function(){
      if (this.isAlive) {
        //------Y axis-----
        
        this.y += this.increment;
        this.x += this.xincrement;
        this.increment += 0.25;
        
        if (this.y >= this.flourLevel) {
          if (this.increment <=5) {
            this.isAlive = false;
          }
         this.increment = -this.increment + 5;
        }
        
        this.element.style.transform = "translate(" + this.x + "px, " + this.y + "px)";
      } else {
        this.element.style.transform = "translate(px, px)";
      }
    }
  }

button.addEventListener("click", startAnimation);

function startAnimation(){
  addClass('btn', 'animate-box');
  setTimeout(function(){
    addClass('top', 'animate-cover');
    addClass('rewards', 'open-rewards-text');
    goB();
  }, 600); 
}

function goB() {
  var xv = (button.getBoundingClientRect().left + button.clientWidth/2) - (12);
  var yv = (button.getBoundingClientRect().top + button.clientHeight/2) - (12);
  var fl = button.getBoundingClientRect().top + 100;
  // var face = '*';
  // var face = '&#9734;';
  // var face  = '&#127775;';
  var face = '&#9733;';
  for (var i = 0; i < 80; i++) {
    var coolGuy = new emoji(face, xv, yv, fl, 10, 26);
    flyingMen.push(coolGuy);
  }
} 


//Rendering
function render() {
  for (var i = 0; i < flyingMen.length; i++) {
    if (flyingMen[i].isAlive == true) {
      flyingMen[i].refresh();
    } else {
      flyingMen[i].element.remove();
      flyingMen.splice(i, 1);
    }
  }
  requestAnimationFrame(render);
}



render();
</script>
</html>