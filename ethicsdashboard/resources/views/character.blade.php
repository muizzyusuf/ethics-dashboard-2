@extends('layouts.app')

@section('content')
 
<div>
    <a class="mb-2 btn btn-dark" href="{{route('casestudy.show', $dashboard->caseStudy->id)}}">
        ⏴Case Study
    </a> 
</div>

<div class="container mb-2">
    <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
        <a class="nav-link" href="{{route('dashboard.show', $dashboard->id)}}">Summary</a>
        <a class="nav-link" href="{{route('ethicalissue.show', $dashboard->ethical_issue_id)}}">Ethical Issue</a>
        <a class="nav-link" href="{{route('stakeholdersection.show', $dashboard->stakeholder_section_id)}}">Stakeholders</a>
        <a class="nav-link" href="{{route('utilitarianismsection.show', $dashboard->utilitarianism_section_id)}}">Utilitarianism</a>
        <a class="nav-link active" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Virtue Ethics</a>
        <a class="nav-link" href="{{route('caresection.show', $dashboard->care_section_id)}}">Care Ethics</a>
        <a class="nav-link" href="{{route('deontologysection.show', $dashboard->deontology_section_id)}}">Deontology</a>
        <a class="nav-link" href="{{route('progress.show', $dashboard->id)}}">Progress</a>
    </nav>
</div>

<div class="jumbotron">

    <div class="ml-5 mr-5 pl-5 pr-5 mb-2">
        <nav class="nav nav-pills nav-justified flex-column flex-lg-row">
            <a class="nav-link btn-dark active" href="{{route('virtuesection.character', $dashboard->virtue_section_id)}}">Character</a>
            <a class="nav-link" href="{{route('virtuesection.show', $dashboard->virtue_section_id)}}">Vices and Virtues</a>
            <a class="nav-link" href="{{route('virtuesection.summary', $dashboard->virtue_section_id)}}">Summary</a>
        </nav>
    </div>

    <div class="card">
        <div class="card-body">
            Virtue ethics is a theory that focuses on the character of the
            decision maker. Building a virtuous character requires
            practicing the virtues until the moral agent knows the right thing
            to do in the right time in the right place in the right way. To
            begin, one must achieve a stable equilibrium of the soul by
            balancing various influences – both internal and external that
            might interfere with good judgment. Click and move the cursor to
            balance the balls.
        </div>
    </div>

    
    

    <div class="mt-3 card border-secondary">
    
    
        <div class="card-body">
            
            <div class="container-fluid">
                <section>

                    <div>
                        <canvas style="width: 100%; height: auto;" id="canvas"  width="600" height="400">
                            This text is displayed if your browser does not support HTML5 Canvas.
                        </canvas>
                    </div>
            
                    <script type="text/javascript">
            
                        $(document).ready(function(){
                           var myGamePiece;
                            var myGamePiece1;
                            var myGamePiece2;
                            var myGamePiece3;
                            var myGamePiece4;
                            var myGamePiece5;
            
                            // drag related variables
                            var dragok = false;
                            var startX;
                            var startY;
            
                            var circles = [];
            
                            myGamePiece = new component(100, 80, 50, "#f67280", "traditions");
                            circles.push(myGamePiece);
                            myGamePiece1 = new component(300, 100, 50, "#81d8d0", "desire");
                            circles.push(myGamePiece1);
                            myGamePiece2 = new component(100, 300, 50, "#c3fdb8", "expectations");
                            circles.push(myGamePiece2);
                            myGamePiece3 = new component(500, 250, 50, "#ffffcf", "impulses");
                            circles.push(myGamePiece3);
                            myGamePiece4 = new component(500, 150, 50, "#ccccff", "conventions");
                            circles.push(myGamePiece4);
                            myGamePiece5 = new component(300, 200, 50, "silver", "attachment");
                            circles.push(myGamePiece5);
            
                            var canvas;
                            var ctx;
                            
                            var offsetX;
                            var offsetY;
                            var x = 75;
                            var y = 50;
                            var WIDTH = 600;
                            var HEIGHT = 400;
                            
            
                            //var gravity = 0.25;
                            //var friction = 0.98;
            
                            // const velocity = 3;
                            // const startingAngle = 50;
            
                            // var moveX = Math.cos(Math.PI / 180 * startingAngle) * velocity;
                            // var moveY = Math.sin(Math.PI / 180 * startingAngle) * velocity;
            
                            // var moveX = (Math.random() * 5 + 1) * (Math.floor(Math.random() * 2) || -1);
                            // var moveY = (Math.random() * 5 + 1) * (Math.floor(Math.random() * 2) || -1);
            
            
                            function component(x, y, r, colour, text) {
                                this.x = x;
                                this.y = y;
                                this.r = r;
                                this.colour = colour;
                                this.text = text;
                                this.isDragging = false;
            
                                this.velocity = 2;
                                this.startingAngle = Math.floor(Math.random() * (360 - 0 + 1) + 0);
            
                                this.moveX = Math.cos(Math.PI / 180 * this.startingAngle) * this.velocity;
                                this.moveY = Math.sin(Math.PI / 180 * this.startingAngle) * this.velocity;
            
                                // this.moveX = (Math.random() * 5 + 1) * (Math.floor(Math.random() * 2) || -1);
                                // this.moveY = (Math.random() * 5 + 1) * (Math.floor(Math.random() * 2) || -1);
            
            
                                this.update = function () {
                                    // ctx = myGameArea.context;
                                    ctx.fillStyle = this.colour;
                                    ctx.beginPath();
                                    ctx.arc(this.x, this.y, this.r, 0, 2 * Math.PI);
                                    ctx.fill();
                                    // ctx.closePath();
                                    var font = "bold " + r / 3.5 + "px arial";
                                    ctx.font = font;
                                    ctx.fillStyle = "black";
                                    ctx.textBaseline = "middle";
                                    ctx.textAlign = "center"; 
                                    ctx.fillText(this.text, this.x, this.y);
                                    //this.bounce();
                                }
            
                                this.bounce = function(){
                                            
                                    if (this.x + this.moveX > WIDTH - this.r || this.x + this.moveX < this.r) this.moveX = -this.moveX;
                                    if (this.y + this.moveY > HEIGHT - this.r || this.y + this.moveY < this.r) this.moveY = -this.moveY;
            
                                    this.x += this.moveX;
                                    this.y += this.moveY;
            
                                }
                            }
            
                            function rect(x, y, w, h) {
                                ctx.beginPath();
                                ctx.rect(x, y, w, h);
                                ctx.closePath();
                                ctx.fill();
                            }
            
                            function clear() {
                                ctx.clearRect(0, 0, WIDTH, HEIGHT);
                            }
            
                            function init() {
                                canvas = document.getElementById("canvas");
                                ctx = canvas.getContext("2d");
                                
                                offsetX = canvas.offsetLeft;
                                offsetY = canvas.offsetTop;
            
                                return setInterval(draw, 10);
                                
                            }
            
                            function draw() {
                                clear();
                                ctx.fillStyle = "#FAF7F8";
                                rect(0, 0, WIDTH, HEIGHT);
            
                                for (var i = 0; i < circles.length; i++) {
                                    var temp = circles[i];
                                
                                    temp.update();
                                    temp.bounce();
                                    
                                    
                                }
            
                            
            
                            }
            
                            
            
                            function myDown(e) {
            
                                // tell the browser we're handling this mouse event
                                e.preventDefault();
                                e.stopPropagation();
                                var rect = this.getBoundingClientRect();
                                var scaleX = canvas.width / rect.width;    // relationship bitmap vs. element for X
                                var scaleY = canvas.height / rect.height;
            
                                // get the current mouse position
                                var mx = (e.clientX - rect.left)*scaleX;
                                var my = (e.clientY -rect.top)*scaleY;
                                
                                
            
                                // test each rect to see if mouse is inside
                                dragok = false;
                                for (var i = 0; i < circles.length; i++) {
                                    var c = circles[i];
                                    var dx = mx-c.x;
                                    var dy = my-c.y;

                                   
                                    if (Math.sqrt((dx*dx) + (dy*dy)) < (c.r)) {
                                        // if yes, set that rects isDragging=true
                                        dragok = true;

                                        c.isDragging = true;

                                        // console.log('circle = '+ (Math.sqrt((mx-c.x)**2 + (my-c.y)**2) < c.r);
                                    }
                                }
                                // save the current mouse position
                                startX = mx;
                                startY = my;
                            }
            
            
                            // handle mouseup events
                            function myUp(e) {
                                // tell the browser we're handling this mouse event
                                e.preventDefault();
                                e.stopPropagation();
            
                                // clear all the dragging flags
                                dragok = false;
                                for (var i = 0; i < circles.length; i++) {
                                    circles[i].isDragging = false;
                                }
                            }
            
            
                            // handle mouse moves
                            function myMove(e) {
                                // if we're dragging anything...
                                if (dragok) {
            
                                    // tell the browser we're handling this mouse event
                                    e.preventDefault();
                                    e.stopPropagation();

                                    var rect = this.getBoundingClientRect();
                                    var scaleX = canvas.width / rect.width;    // relationship bitmap vs. element for X
                                    var scaleY = canvas.height / rect.height;
                
                                    // get the current mouse position
                                    var mx = (e.clientX - rect.left)*scaleX;
                                    var my = (e.clientY -rect.top)*scaleY;
            
                                    // get the current mouse position
                                    // var mx = parseInt(e.clientX - offsetX);
                                    // var my = parseInt(e.clientY - offsetY);
            
                                    // calculate the distance the mouse has moved
                                    // since the last mousemove
                                    var dx = mx - startX;
                                    var dy = my - startY;
            
                                    // move each rect that isDragging 
                                    // by the distance the mouse has moved
                                    // since the last mousemove
                                    for (var i = 0; i < circles.length; i++) {
                                        var c = circles[i];
                                        if (c.isDragging) {
                                            c.x += dx;
                                            c.y += dy;
                                        }
                                    }
            
                                    // redraw the scene with the new rect positions
                                    draw();
            
                                    // reset the starting mouse position for the next mousemove
                                    startX = mx;
                                    startY = my;
            
                                }
                            }

                            $('#solve').click(function(){

                                myGamePiece.x = 300;
                                myGamePiece.y = 66;
                                
                                myGamePiece1.x = 300;
                                myGamePiece1.y = 333;

                                myGamePiece2.x = 100;
                                myGamePiece2.y =133;

                                myGamePiece3.x = 500;
                                myGamePiece3.y = 133;

                                myGamePiece4.x = 100;
                                myGamePiece4.y = 266;

                                myGamePiece5.x = 500;
                                myGamePiece5.y = 266;

                                for(var i = 0; i<circles.length; i++){
                                    var temp = circles[i];
                                    temp.moveX = 0;
                                    temp.moveY = 0;
                                }

                                alert("CONGRATULATIONS! Your soul is now in a stable equilibrium which is essential to understanding virtue. However, this achievement is fleeting. Life will constantly challenge your ability to balance the many influences that will make it difficult to see the virtuous path.");

                               

                            });

                            $('#reset').click(function(){

                               

                                for(var i = 0; i<circles.length; i++){
                                    var temp = circles[i];
                                    temp.startingAngle = Math.floor(Math.random() * (360 - 0 + 1) + 0);
                                    temp.moveX = Math.cos(Math.PI / 180 * temp.startingAngle) * temp.velocity;
                                    temp.moveY = Math.sin(Math.PI / 180 * temp.startingAngle) * temp.velocity;
                                }
                               

                            });
            
                            init();
                            
                            canvas.onmousedown = myDown;
                            canvas.onmouseup = myUp;
                            canvas.onmousemove = myMove;
            
                            // call to draw the scene
                        });
                        
                        
                        
            
                    </script>
            
                    <div class="text-center">
                        <button id='solve' class="btn btn-success font-weight-bold">Balance</button>
                        <button id='reset' class="btn btn-secondary font-weight-bold">Reset</button>
                    </div>
                   
                </section>
            </div>
            
        </div>  
        
    </div>
    
</div>



@endsection
            

        
            

                    
                    
                            
                       
                                






                            

                       