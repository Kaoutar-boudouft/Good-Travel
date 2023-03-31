<?php
include_once 'generalTraitement.php';
include_once 'UsersManager.php';
include_once 'trait.php';
$username="";
$password="";
$user="";
if(isset($_COOKIE['user'])){
    $username=$_COOKIE['user'];
}
if (isset($_COOKIE['password'])) {
    $password=$_COOKIE['password'];
}
session_start();
if(isset($_SESSION['user'])){
    $user=$_SESSION['user'];
    $admin=Tvg::CheckIfUserIsAdmin($user);
    $_SESSION['admin']=$admin;
    $profilepicture=UsersManager::getProfilePictureByUserName($user);
    $email=UsersManager::getEmailByUserName($user);
    $pass=UsersManager::getPassByUserName($user);
}
$n=15;
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$randomString = '';

for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
}
$countrycity=shell_exec("pa.py");
$table=explode(" ",$countrycity);
$country=$table[0];
$city=$table[1];
$ip=$_SERVER['REMOTE_ADDR'];
$datev=date('Y-m-d');
$r=Tvg::NoterLesVisiteurs($ip,$datev,$country,$city);
?>
<?php
if(isset($_POST['modi'])){
    $newuser=$_POST['u'];
    $pass=$_POST['p'];
    $newemail=$_POST['e'];
    $newphoto="";
    if($_FILES['im']['name']!=""){
        $fn=$_FILES['im']['name'];
        $locationtemp=$_FILES['im']['tmp_name'];
        if($profilepicture!="im/utilisateur.png"){
            unlink($profilepicture);
        }
        move_uploaded_file($locationtemp,"uploadedimg/$user $fn");
        $newphoto="uploadedimg/$user $fn";
    }
    else{
        $newphoto=$profilepicture;
    }
    $t=UsersManager::Modifier($user,$newuser,$pass,$newemail,$email,$newphoto);

    if($t!=0){
        $_SESSION['user']=$newuser;
        $user=$_SESSION['user'];
        $_SESSION['pass']=$pass;
        $password=$_SESSION['pass'];
        $profilepicture=$newphoto;
        $email=$newemail;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="authoring-tool" content="Adobe_Animate_CC">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Good Travel</title>
    <link href="ass\css\bootstrap-grid.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap-grid.min.css.map" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.css" rel="stylesheet">
    <link href="ass\css\bootstrap-reboot.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.css" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css" rel="stylesheet">
    <link href="ass\css\bootstrap.min.css.map" rel="stylesheet">
    <link href="ass\css\glyphicones.css" rel="stylesheet">
    <link href="ass\cs.css" rel="stylesheet">
    <link href="ass\bootstrap-icons\bootstrap-icons.css" rel="stylesheet">
    <!-- Vendor JS Files -->
    <script src="assets/vendor/purecounter/purecounter.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="ass\js\jquery-3.3.1.slim.min.js"></script>
    <script src="ass\js\jquery-1.11.1.min.js"></script>
    <script src="ass\js\popper.min.js"></script>
    <script src="ass\js\bootstrap.min.js"></script>
    <script src="https://code.createjs.com/createjs-2015.11.26.min.js"></script>
    <script src="goodtravelan.js?1648910649329"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>



    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <script>
        var canvas, stage, exportRoot, anim_container, dom_overlay_container, fnStartAnimation;
        function init() {
            canvas = document.getElementById("canvas");
            anim_container = document.getElementById("animation_container");
            dom_overlay_container = document.getElementById("dom_overlay_container");
            images = images||{};
            var loader = new createjs.LoadQueue(false);
            loader.addEventListener("fileload", handleFileLoad);
            loader.addEventListener("complete", handleComplete);
            loader.loadManifest(lib.properties.manifest);
        }
        function handleFileLoad(evt) {
            if (evt.item.type == "image") { images[evt.item.id] = evt.result; }
        }
        function handleComplete(evt) {
            //This function is always called, irrespective of the content. You can use the variable "stage" after it is created in token create_stage.
            var queue = evt.target;
            var ssMetadata = lib.ssMetadata;
            for(i=0; i<ssMetadata.length; i++) {
                ss[ssMetadata[i].name] = new createjs.SpriteSheet( {"images": [queue.getResult(ssMetadata[i].name)], "frames": ssMetadata[i].frames} )
            }
            exportRoot = new lib.goodtravelan();
            stage = new createjs.Stage(canvas);
            stage.addChild(exportRoot);
            //Registers the "tick" event listener.
            fnStartAnimation = function() {
                createjs.Ticker.setFPS(lib.properties.fps);
                createjs.Ticker.addEventListener("tick", stage);
            }
            //Code to support hidpi screens and responsive scaling.
            function makeResponsive(isResp, respDim, isScale, scaleType) {
                var lastW, lastH, lastS=1;
                window.addEventListener('resize', resizeCanvas);
                resizeCanvas();
                function resizeCanvas() {
                    var w = lib.properties.width, h = lib.properties.height;
                    var iw = window.innerWidth, ih=window.innerHeight;
                    var pRatio = window.devicePixelRatio || 1, xRatio=iw/w, yRatio=ih/h, sRatio=1;
                    if(isResp) {
                        if((respDim=='width'&&lastW==iw) || (respDim=='height'&&lastH==ih)) {
                            sRatio = lastS;
                        }
                        else if(!isScale) {
                            if(iw<w || ih<h)
                                sRatio = Math.min(xRatio, yRatio);
                        }
                        else if(scaleType==1) {
                            sRatio = Math.min(xRatio, yRatio);
                        }
                        else if(scaleType==2) {
                            sRatio = Math.max(xRatio, yRatio);
                        }
                    }
                    canvas.width = w*pRatio*sRatio;
                    canvas.height = h*pRatio*sRatio;
                    canvas.style.width = dom_overlay_container.style.width = anim_container.style.width =  w*sRatio+'px';
                    canvas.style.height = anim_container.style.height = dom_overlay_container.style.height = h*sRatio+'px';
                    stage.scaleX = pRatio*sRatio;
                    stage.scaleY = pRatio*sRatio;
                    lastW = iw; lastH = ih; lastS = sRatio;
                }
            }
            makeResponsive(false,'both',false,1);
            fnStartAnimation();
        }


        (function (lib, img, cjs, ss, an) {

            var p; // shortcut to reference prototypes
            lib.ssMetadata = [];


// symbols:



            (lib.brownwoodentexturedflooringbackground = function() {
                this.initialize(img.brownwoodentexturedflooringbackground);
            }).prototype = p = new cjs.Bitmap();
            p.nominalBounds = new cjs.Rectangle(0,0,5000,3333);// helper functions:

            function mc_symbol_clone() {
                var clone = this._cloneProps(new this.constructor(this.mode, this.startPosition, this.loop));
                clone.gotoAndStop(this.currentFrame);
                clone.paused = this.paused;
                clone.framerate = this.framerate;
                return clone;
            }

            function getMCSymbolPrototype(symbol, nominalBounds, frameBounds) {
                var prototype = cjs.extend(symbol, cjs.MovieClip);
                prototype.clone = mc_symbol_clone;
                prototype.nominalBounds = nominalBounds;
                prototype.frameBounds = frameBounds;
                return prototype;
            }


            (lib.wrongcard = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#FFFFFF").s().p("AggAkQgJgOAAgUQAAgYANgPQAOgPASAAQAOAAAMAMQALANABAYIg2AAQABATAJAMQAHAJAKAAQAHAAAFgEQAFgDAHgKIADADQgIAQgKAHQgKAHgNAAQgWAAgLgRgAgGgoQgHAKABAQIAAAEIAbAAQAAgRgBgHQgCgGgEgDQgDgCgDAAQgFAAgDAFg");
                this.shape.setTransform(68.8,25.7);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#FFFFFF").s().p("AAGBJIAAgEIAGgBIABgDQAAgDgFgGIgTgdIgGAGIAAASQAAALADADQACADAGABIAAAEIgzAAIAAgEQAFgBADgDQACgDAAgLIAAhlQAAgLgCgDQgCgDgGgBIAAgEIAoAAIAABfIAWgXQAIgGABgDQACgDAAgDQAAgDgCgCQgDgCgGgBIAAgEIAtAAIAAAEQgHABgEACQgGADgNAOIgMAKIAYAiIARAYQAEADAGABIAAAEg");
                this.shape_1.setTransform(58.1,23.5);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#FFFFFF").s().p("AALAxQgFgEgBgJQgSAQgOAAQgJABgGgGQgFgGAAgJQAAgLAKgJQAJgJAhgPIAAgKQAAgLgCgDQgBgDgCgCQgEgCgEAAQgHAAgFADQgCACAAACQAAADADADQAEAEAAAFQAAAFgEAEQgEADgGAAQgHAAgFgEQgEgDAAgGQAAgIAGgHQAGgHALgEQALgDALAAQAOAAAIAFQAJAHACAHQACAFAAAPIAAAmIAAAJIACADIACABQADAAADgFIADAEQgFAHgGAEQgGAEgHgBQgJAAgEgDgAgOALQgEAGAAAFQAAAFAEAEQACADAFAAQAGAAAGgFIAAghQgMAGgHAJg");
                this.shape_2.setTransform(46.3,25.7);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#FFFFFF").s().p("Ag8BJIAAgEIAEAAQAHAAADgCQADgCACgEQABgCAAgLIAAhfQAAgLgBgDQgCgDgDgCQgEgCgGAAIgEAAIAAgEIB5AAIAAAqIgEAAQgCgPgFgHQgHgHgLgDQgHgCgSAAIgMAAIAAA8IAEAAQAJAAAGgDQAGgDAEgGQAEgHACgMIADAAIAABIIgDAAQgCgVgJgGQgJgHgLAAIgEAAIAAAtQAAALACADQABADACACQAEACAGAAIAEAAIAAAEg");
                this.shape_3.setTransform(33.7,23.5);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f().s("#000000").ss(1,1,1).p("Almj5ILOAAQg2CvDCgbIAADKQjdgVBRCqIrOAAQBQiZjdAEIAAjKQDHgDg6iRg");
                this.shape_4.setTransform(50,25);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#000099").s().p("AlmD6QBQiZjdAEIAAjKQDHgDg6iRILNAAQg1CvDCgbIAADKQjdgVBQCqgAE6DDQgJgQgFgOIphAAQBEhsi8AEIAAiNQCpgCgxhmIJhAAQgtB6ClgSIAACNQi7gPBDB2QgjhnCvAPIAAihQiuAVAwiMIqGAAQA0B0izADIAAChQDHgEhIB7IKGAAIAAAAg");
                this.shape_5.setTransform(50,25);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#FFFFFF").s().p("AlCDIQBIh7jHAEIAAihQCzgDg0h0IKGAAQgwCMCugVIAAChQivgPAjBnQhDh2C7APIAAiNQilASAth6IphAAQAxBmipACIAACNQC8gEhEBsIJhAAQAFAOAJAQg");
                this.shape_6.setTransform(49,24.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.wrongcard, new cjs.Rectangle(-1,-1,102,52), null);


            (lib.winner = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#FFFFFF").s().p("ABaC1QgcgdgBgvQAAgvAcgeQAcgcAqAAQArAAAcAbQAcAeAAAvQAAAwgcAdQgdAfgqAAQgoAAgdgfgACWARQgIAGgDARQgEAQAAAsQAAAxAFAVQACAPAIAGQAEAEAGAAQAGAAADgDQAIgHADgPQAFgVAAgsQAAgtgFgWQgDgPgHgGQgEgEgHABQgFgBgEAEgAigDUIEammIAnAAIkZGmgAjlgbQgcgcAAgvQAAgwAcgeQAcgfAqABQApAAAdAdQAdAeAAAuQAAAwgdAeQgcAcgrAAQgqAAgbgcgAiqi/QgHAHgEAQQgDARAAAzQAAAqAFAWQADANAHAHQAEAEAGAAQAGAAAFgEQAGgGAEgOQAEgWAAgoQAAgxgEgXQgDgPgIgGQgEgEgGAAQgHAAgEAEg");
                this.shape.setTransform(772.5,86.6);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#FFFFFF").s().p("AgzDAQgXgOgSgcQgNgUgJghQgNgsAAgwQAAhAASg2QAPgtAfgYQAegYAhAAQAjAAAeAYQAeAXAOAoQATA3AABAQAAA8gQAzQgKAggRAUQgRAUgVAMQgWAMgZAAQgcAAgXgPgAgUiyQgLAKgDAaQgEAaAACaQAABUAGAdQAEAVAIAHQAIAHANAAQAOAAAIgKQAMgQACgiIABh+QAAhogBgRQgDgpgLgOQgIgKgPAAQgNAAgHAIg");
                this.shape_1.setTransform(727.4,86.2);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#FFFFFF").s().p("AhlDLIAAgLIALAAQAZAAALgGQALgGAEgKQADgKAAgmIAAjNQAAgbgCgHQgDgHgHgFQgHgFgKAAQgPAAgVAKIgFgLICRhDIAKAAIAAFEQAAAlADAKQADAKAKAGQALAHAWAAIAJAAIAAALg");
                this.shape_2.setTransform(697.1,85.8);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#FFFFFF").s().p("AhvDLIAAgKQASgBAHgDQAIgEAEgIQACgHAAgWIAAi9IgnAAIAAgdIAnAAIAAgUIAAgOQAAgqAfgcQAfgcA0AAQAjAAASANQARAOABAQQAAANgMAKQgLAKgRAAQgPAAgJgIQgKgIAAgKIADgLIABgJQgBgGgDgDQgEgEgIAAQgIAAgFAHQgHAHABAPIABAzIAAAjIAoAAIAAAdIgoAAIAAC9QAAAcAFAHQAKALAZgBIAAAKg");
                this.shape_3.setTransform(660.7,85.7);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f("#FFFFFF").s().p("AikCGQgug6AAhOQAAhYA8g7QA9g7BXADQBegDA8A7QA7A7AABYQAABLgsA5Qg7BMhrAAQhqAAg7hIgAhRiCQgYAuAABUQABBmAjAwQAZAiAsAAQAeAAAVgOQAagTANgpQAPgpAAhDQAAhNgPgnQgOgogXgQQgXgQgdAAQg1AAgdA4g");
                this.shape_4.setTransform(624.3,86.3);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#FFFFFF").s().p("AAJCNIAAgKQAQgCAHgMQAEgHAAgdIAAh4QAAgjgCgIQgDgJgGgFQgHgEgHAAQgYgBgWAlIAACRQAAAfAGAIQAFAJAQACIAAAKIiLAAIAAgKQASgCAHgKQAFgGAAggIAAiaQAAgegGgIQgGgHgSgDIAAgLIBwAAIAAAjQAVgXASgJQAUgLAWAAQAbAAARAPQASAPAGAVQAEARAAAvIAABqQAAAgAGAIQAGAIASACIAAAKg");
                this.shape_5.setTransform(569.3,92);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#FFFFFF").s().p("AheBmQgigsAAg4QAAg7AjgrQAigsA7AAQAjAAAfATQAfASAQAiQAPAiAAAnQAAA7gdAmQgkAwg+AAQg+AAghgrgAgYhwQgKALgEAiQgDAggBA7QAAAfAEAcQAEAUAKALQALALANAAQAMAAAJgHQAMgLAEgRQAFgcAAhUQABgygGgSQgFgSgMgJQgHgGgMAAQgOAAgLALg");
                this.shape_6.setTransform(537.5,92.4);

                this.shape_7 = new cjs.Shape();
                this.shape_7.graphics.f("#FFFFFF").s().p("AiTDNIAAgLQASAAAJgKQAFgHABgcIAAkgQgBgdgGgIQgHgIgTgBIAAgLIBzAAIAAAkQAOgVAPgKQAVgNAYAAQAfAAAZATQAYATANAhQANAiAAAmQAAAqgNAiQgOAigZASQgZASggAAQgWAAgTgKQgOgIgQgSIAABmQAAAVADAIQAEAHAHAEQAHADATAAIAAALgAggh+IAACRQAZAkAbAAQARAAAKgRQAPgYAAhEQAAhHgQgaQgMgSgTAAQgcAAgTArg");
                this.shape_7.setTransform(505.1,98.4);

                this.shape_8 = new cjs.Shape();
                this.shape_8.graphics.f("#FFFFFF").s().p("AhXB/QgSgOgHgUQgFgTAAgvIAAhsQgBgegFgIQgGgHgSgDIAAgLIBwAAIAAC6QAAAdACAJQADAJAGAEQAGAFAIgBQAKABAIgGQAMgIAQgXIAAiSQAAgegGgIQgFgHgSgDIAAgLIBvAAIAADVQABAgAFAIQAGAIASACIAAAKIhwAAIAAgkQgTAXgTALQgTAKgZAAQgXAAgSgOg");
                this.shape_8.setTransform(472.5,92.8);

                this.shape_9 = new cjs.Shape();
                this.shape_9.graphics.f("#FFFFFF").s().p("AheBmQghgsgBg4QABg7AigrQAigsA7AAQAjAAAfATQAeASARAiQAPAiABAnQAAA7geAmQgkAwg/AAQg8AAgigrgAgYhwQgKALgEAiQgDAgAAA7QAAAfADAcQAEAUALALQAKALANAAQAMAAAKgHQALgLADgRQAHgcgBhUQAAgygFgSQgGgSgKgJQgIgGgNAAQgNAAgLALg");
                this.shape_9.setTransform(440.8,92.4);

                this.shape_10 = new cjs.Shape();
                this.shape_10.graphics.f("#FFFFFF").s().p("AhUC2QgxgZgbgwQgbgwAAg2QAAg3AegzQAdgzAzgcQAzgdA3AAQAqAAAvATQAaAKAIAAQAJAAAHgHQAHgHACgPIALAAIAACKIgLAAQgNg2gjgdQgjgcgsAAQgmAAgeAVQgfAWgPAiQgSAsAAA3QAAA0AOAsQANArAdAXQAbAWAvAAQAlAAAfgQQAfgRAjgoIAAAjQghAiglAQQgkAQgwAAQg/AAgxgag");
                this.shape_10.setTransform(403.7,86.2);

                this.shape_11 = new cjs.Shape();
                this.shape_11.graphics.f("#FFFFFF").s().p("AATDLIAAgLIAIAAQAXAAAKgHQAGgEAAgJQAAgFgCgGIgJgWIgVgxIiLAAIgRAmQgIAUAAAMQAAARANAIQAJAFAeACIAAALIiEAAIAAgLQAVgDAPgPQANgOAUguICNk8IAGAAICPFFQAVAuANAMQAKAJASACIAAALgAhfBEIB3AAIg6iIg");
                this.shape_11.setTransform(345.7,85.8);

                this.shape_12 = new cjs.Shape();
                this.shape_12.graphics.f("#FFFFFF").s().p("AAJCNIAAgKQAQgCAHgMQAEgHAAgdIAAh4QAAgjgCgIQgDgJgGgFQgHgEgHAAQgYgBgWAlIAACRQAAAfAGAIQAFAJAQACIAAAKIiLAAIAAgKQASgCAHgKQAFgGAAggIAAiaQAAgegGgIQgGgHgSgDIAAgLIBwAAIAAAjQAVgXASgJQAUgLAWAAQAbAAARAPQASAPAGAVQAEARAAAvIAABqQAAAgAGAIQAGAIASACIAAAKg");
                this.shape_12.setTransform(292.6,92);

                this.shape_13 = new cjs.Shape();
                this.shape_13.graphics.f("#FFFFFF").s().p("AheBmQgigsAAg4QAAg7AjgrQAigsA7AAQAjAAAfATQAfASAQAiQAQAiAAAnQgBA7gdAmQgkAwg+AAQg+AAghgrgAgYhwQgKALgEAiQgDAggBA7QAAAfAEAcQAEAUAKALQALALANAAQAMAAAJgHQAMgLAEgRQAFgcAAhUQABgygGgSQgFgSgMgJQgHgGgMAAQgOAAgLALg");
                this.shape_13.setTransform(260.8,92.4);

                this.shape_14 = new cjs.Shape();
                this.shape_14.graphics.f("#FFFFFF").s().p("ABsDLIhij/IhrD/IgLAAIiDlDQgUgxgIgKQgIgKgSgCIAAgLICrAAIAAALQgUAAgHAGQgHAGAAAIQAAALAPAlIBOC/IA9iVIgPgqQgOgjgIgLQgHgMgJgFQgKgFgTAAIAAgLIDAAAIAAALQgUAAgJADQgGACgEAFQgDAFAAAGQAAAHANAiIBJC7IBAipQAKgaADgKQACgKAAgIQAAgMgIgHQgJgHgXAAIAAgLIBnAAIAAALQgKABgIAFQgIAFgFALIgTAuIh9FGg");
                this.shape_14.setTransform(215.8,86.6);

                this.shape_15 = new cjs.Shape();
                this.shape_15.graphics.f("#FFFFFF").s().p("AhXB/QgSgOgGgUQgHgTAAgvIAAhsQAAgegFgIQgGgHgSgDIAAgLIBvAAIAAC6QAAAdADAJQADAJAGAEQAGAFAIgBQAKABAIgGQAMgIAQgXIAAiSQAAgegFgIQgGgHgSgDIAAgLIBvAAIAADVQAAAgAGAIQAGAIASACIAAAKIhwAAIAAgkQgUAXgSALQgTAKgZAAQgXAAgSgOg");
                this.shape_15.setTransform(154.1,92.8);

                this.shape_16 = new cjs.Shape();
                this.shape_16.graphics.f("#FFFFFF").s().p("AheBmQghgsgBg4QAAg7AjgrQAigsA7AAQAjAAAfATQAfASAQAiQAQAiAAAnQgBA7gdAmQgkAwg+AAQg9AAgigrgAgYhwQgLALgDAiQgEAgABA7QAAAfADAcQAEAUALALQAKALANAAQAMAAAKgHQALgLAEgRQAFgcAAhUQABgygGgSQgFgSgLgJQgIgGgMAAQgPAAgKALg");
                this.shape_16.setTransform(122.4,92.4);

                this.shape_17 = new cjs.Shape();
                this.shape_17.graphics.f("#FFFFFF").s().p("AhuDHIAAgLIAUAAQASAAAKgGQAIgEAEgKQADgHABgeIAAhQIheipQgcgzgMgIQgLgJgSgBIAAgLIC+AAIAAALIgJAAQgRAAgHAFQgHAFAAAGQAAAKAXArIBHCCIBIh2QAbgsgBgPQAAgIgHgFQgKgHgbgCIAAgLIB6AAIAAALQgUADgLAJQgPAMgfA3IhWCPIAABgQAAAfADAHQAEAHAJAGQAJAGAQAAIAXAAIAAALg");
                this.shape_17.setTransform(85.7,86.2);

                this.shape_18 = new cjs.Shape();
                this.shape_18.graphics.f("#006600").s().p("EhDBANhIAA7BMCGDAAAIAAbBg");
                this.shape_18.setTransform(429,86.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_18},{t:this.shape_17},{t:this.shape_16},{t:this.shape_15},{t:this.shape_14},{t:this.shape_13},{t:this.shape_12},{t:this.shape_11},{t:this.shape_10},{t:this.shape_9},{t:this.shape_8},{t:this.shape_7},{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.winner, new cjs.Rectangle(0,0,858,173.1), null);


            (lib.rightcard = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#FFFFFF").s().p("AgaBJIAAgEQAHAAADgEQACgCAAgLIAAhnQAAgLgDgDQgCgDgHAAIAAgEIApAAIAAB8QAAALACADQADACAHABIAAAEg");
                this.shape.setTransform(66.8,23.5);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#FFFFFF").s().p("AALAxQgFgEgBgJQgSAQgOAAQgJABgGgGQgFgGAAgJQAAgLAKgJQAJgJAhgPIAAgKQAAgLgCgDQgBgDgCgCQgEgCgEAAQgHAAgFADQgCACAAACQAAADADADQAEAEAAAFQAAAFgEAEQgEADgGAAQgHAAgFgEQgEgDAAgGQAAgIAGgHQAGgHALgEQALgDALAAQAOAAAIAFQAJAHACAHQACAFAAAPIAAAmIAAAJIACADIACABQADAAADgFIADAEQgFAHgGAEQgGAEgHgBQgJAAgEgDgAgOALQgEAGAAAFQAAAFAEAEQACADAFAAQAGAAAGgFIAAghQgMAGgHAJg");
                this.shape_1.setTransform(58.5,25.7);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#FFFFFF").s().p("AggAkQgJgOAAgUQAAgYANgPQAOgPASAAQAOAAAMAMQALANABAYIg2AAQABATAKAMQAGAJAKAAQAHAAAFgEQAFgDAHgKIADADQgIAQgKAHQgKAHgNAAQgWAAgLgRgAgHgoQgFAKAAAQIAAAEIAbAAQAAgRgBgHQgCgGgEgDQgDgCgDAAQgFAAgEAFg");
                this.shape_2.setTransform(48,25.7);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#FFFFFF").s().p("AAhBJIguhDIgKAAIAAApQAAAMACADQABADADACQAEACAKAAIAAAEIhLAAIAAgEQALAAADgCQAEgCACgDQABgDAAgMIAAhdQAAgMgBgDQgCgDgEgCQgEgCgKAAIAAgEIBFAAQAZAAAMAEQAMADAIAKQAIAKgBANQAAAQgLALQgHAGgNADIAjAxQAGAKADACQAFADAGABIAAAEgAgXAAIAGAAQAPAAAHgDQAHgDAEgHQAFgHgBgMQAAgQgHgIQgJgIgPAAIgMAAg");
                this.shape_3.setTransform(35.3,23.5);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f().s("#000000").ss(1,1,1).p("Almj5ILOAAQg2CvDCgbIAADKQjdgVBRCqIrOAAQBQiZjdAEIAAjKQDHgDg6iRg");
                this.shape_4.setTransform(50,25);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#990000").s().p("AlmD6QBQiZjdAEIAAjKQDHgDg6iRILNAAQg1CvDCgbIAADKQjdgVBQCqgAE6DDQgJgQgFgOIphAAQBEhsi8AEIAAiNQCpgCgxhmIJhAAQgtB6ClgSIAACNQi7gPBDB2QgjhnCvAPIAAihQiuAVAwiMIqGAAQA0B0izADIAAChQDHgEhIB7IKGAAIAAAAg");
                this.shape_5.setTransform(50,25);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#FFFFFF").s().p("AlCDIQBIh7jHAEIAAihQCzgDg0h0IKGAAQgwCMCugVIAAChQivgPAjBnQhDh2C7APIAAiNQilASAth6IphAAQAxBmipACIAACNQC8gEhEBsIJhAAQAFAOAJAQg");
                this.shape_6.setTransform(49,24.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.rightcard, new cjs.Rectangle(-1,-1,102,52), null);


            (lib.play = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#990000").s().p("Ag8BtIAAgGIALAAQAKAAAGgDQAEgCACgGQACgEAAgQIAAgsIgzhdQgQgbgGgFQgGgFgLAAIAAgGIBpAAIAAAGIgFAAQgJAAgEACQgEADAAADQAAAGANAXIAnBIIAnhBQAOgYAAgIQAAgFgEgCQgFgEgPgBIAAgGIBDAAIAAAGQgLABgGAFQgIAHgRAeIgwBOIAAA1QAAARACAEQACAEAFADQAFADAJAAIAMAAIAAAGg");
                this.shape.setTransform(79.9,20.5);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#990000").s().p("AALBwIAAgHIAEAAQANABAEgEQAEgDAAgFIgBgGIgFgMIgLgbIhNAAIgJAVQgEALAAAHQAAAJAIAFQAEACARABIAAAHIhJAAIAAgHQAMgBAHgIQAIgIALgZIBOiuIACAAIBPCzQALAZAIAHQAFAEAKABIAAAHgAg0AmIBBAAIgfhLg");
                this.shape_1.setTransform(56,20.3);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#990000").s().p("AhkBtIAAgGIAHAAQAKAAAFgDQAFgCACgGQACgEAAgQIAAiPQAAgRgCgEQgCgEgFgDQgGgDgJAAIgHAAIAAgGIBzAAIAAAGIgJAAQgJAAgFADQgFACgCAGQgCAEAAAQIAACKQAAARACAFQACAEAGADQAEABAOAAIASAAQASAAALgGQAMgGAJgNQAIgOAHgZIAHAAIgIBMg");
                this.shape_2.setTransform(32.9,20.5);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#990000").s().p("AhaBtIAAgGQAPAAAFgCQAGgDACgFQACgEgBgSIAAiNQABgSgCgEQgCgFgGgDQgFgCgPAAIAAgGIBdAAQAwAAAUARQAVAQgBAZQABAWgNAPQgOAOgXAFQgPAEglAAIAAA9QAAASADAEQACAFAFADQAFACAOAAIAAAGgAgKgBIAIAAQATAAALgMQAKgLAAgZQAAgYgKgLQgLgMgVAAIgGAAg");
                this.shape_3.setTransform(12,20.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.play, new cjs.Rectangle(0,0,94.1,40.6), null);


            (lib.introduce = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#000000").s().p("AhsCRIC/kgIAbAAIjAEggAA+B8QgUgVAAgfQAAghATgUQATgTAcAAQAegBATAUQATATABAhQgBAggTAVQgUAUgcAAQgcAAgTgUgABmALQgFAFgCALQgDALAAAeQAAAiAEAOQACAKAEAEQAEADADAAQAFAAACgCQAEgFADgKQADgPAAgdQAAgggCgOQgDgLgFgEQgDgCgEAAQgEAAgDACgAicgSQgUgTAAggQABgiATgUQAUgUAcAAQAcgBATAVQAUATAAAhQAAAggUAVQgTASgdABQgdAAgSgTgAh0iDQgEAFgDAMQgCALgBAjQABAdADAPQACAJAEAEQAEADAEAAQAEAAADgDQAEgEACgJQAEgPAAgcQAAgigEgOQgCgLgEgFQgDgCgEAAQgEAAgEACg");
                this.shape.setTransform(835.3,85.7);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#000000").s().p("AgjCDQgQgKgMgSQgIgOgHgXQgJgeABghQAAgrAMglQAKgfAVgQQAVgQAWAAQAYAAAUAQQAUAQAKAbQANAmAAArQAAApgLAjQgGAWgMANQgMAOgOAIQgPAIgRAAQgTAAgQgKgAgNh6QgIAHgCASQgDASAABpQAAA5AEAUQADAOAGAFQAFAFAIAAQALAAAEgHQAJgLABgXIABhWQAAhHgBgLQgCgcgIgKQgEgHgLAAQgJAAgEAFg");
                this.shape_1.setTransform(804.5,85.4);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#000000").s().p("AhFCKIAAgHIAIAAQARAAAHgEQAIgEACgHQADgHAAgZIAAiNQAAgSgCgEQgCgGgEgCQgFgEgHAAQgKAAgPAGIgDgHIBjguIAGAAIAADeQAAAZACAGQADAHAHAFQAHAEAPAAIAGAAIAAAHg");
                this.shape_2.setTransform(783.8,85.2);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#000000").s().p("AhMCLIAAgHQANgBAFgCQAFgDACgFQADgFAAgPIAAiBIgcAAIAAgTIAcAAIAAgOIgBgKQAAgcAWgUQAVgTAiAAQAZAAAMAJQAMAJAAAMQAAAJgHAGQgIAHgMAAQgLAAgFgFQgHgGAAgGIABgIIABgGQAAgFgCgCQgEgDgEAAQgGAAgEAFQgDAFAAALIAAAjIAAAYIAcAAIAAATIgcAAIAACBQAAATAEAFQAHAHARAAIAAAHg");
                this.shape_3.setTransform(758.9,85.1);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f("#000000").s().p("AhwBbQgfgnAAg1QAAg8ApgoQApgpA8ACQBAgCApAoQAoApAAA8QAAAzgeAnQgoA0hJAAQhJAAgogygAg3hZQgQAgAAA5QAABFAYAiQARAXAeAAQAVAAAOgKQARgNAKgcQAKgcAAgtQAAg1gKgbQgKgbgQgLQgPgLgUAAQglAAgTAmg");
                this.shape_4.setTransform(734,85.5);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#000000").s().p("AgTB3QgMgKgEgMQgCgHAAgeIAAhkIgZAAIAAgHQAagRASgVQARgTAMgYIAHAAIAABEIAtAAIAAAUIgtAAIAAByQAAARABAFQACAEAEADQADADAEAAQANAAALgTIAHAEQgRAmgkAAQgRAAgMgKg");
                this.shape_5.setTransform(701.1,86.4);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#000000").s().p("AAGBhIAAgIQALgBAEgIQADgEAAgVIAAhSQAAgWgBgHQgCgFgEgEQgEgDgGAAQgQgBgOAZIAABjQAAAWADAFQAEAGALABIAAAIIhfAAIAAgIQAMgBAFgHQADgDAAgXIAAhoQAAgVgEgFQgDgGgNgBIAAgIIBNAAIAAAZQANgQANgHQANgIAPABQATgBALALQAMAKAEAPQAEALAAAhIAABHQAAAXAEAEQADAGANABIAAAIg");
                this.shape_6.setTransform(682.8,89.4);

                this.shape_7 = new cjs.Shape();
                this.shape_7.graphics.f("#000000").s().p("Ag7BXQgNgKgEgNQgEgNAAghIAAhJQAAgVgEgFQgEgFgMgCIAAgHIBMAAIAAB+QAAAVACAFQACAGAEADQAEADAGAAQAGAAAGgEQAIgFALgQIAAhjQAAgVgEgFQgEgFgMgCIAAgHIBMAAIAACRQAAAWAEAFQAEAFAMACIAAAHIhMAAIAAgZQgOAQgMAHQgNAHgRAAQgQAAgMgJg");
                this.shape_7.setTransform(659.8,89.9);

                this.shape_8 = new cjs.Shape();
                this.shape_8.graphics.f("#000000").s().p("AhABGQgXgeAAgnQAAgnAXgeQAYgeAoAAQAYAAAVANQAVAMALAXQALAYAAAaQAAAogVAbQgYAggrAAQgpAAgXgdgAgQhMQgIAIgCAWQgCAXAAAnQAAAWADATQACAOAHAHQAHAIAJAAQAIAAAGgFQAIgHADgMQAEgTAAg5QAAgigEgNQgEgNgHgGQgFgEgJAAQgJAAgHAIg");
                this.shape_8.setTransform(638.2,89.6);

                this.shape_9 = new cjs.Shape();
                this.shape_9.graphics.f("#000000").s().p("Ag3BHQgXgcAAgoQAAglAVgdQAYgjArAAQAdAAARAPQARAOAAASQAAAMgHAGQgHAHgLAAQgMAAgIgIQgHgHgCgUQgBgNgFgFQgFgFgGAAQgIAAgHAKQgLAQAAAfQAAAbAJAXQAIAYAOAMQALAJAPAAQAKAAAIgFQAJgFAMgMIAHAEQgOAZgTAMQgUAMgWAAQglAAgWgcg");
                this.shape_9.setTransform(619.2,89.6);

                this.shape_10 = new cjs.Shape();
                this.shape_10.graphics.f("#000000").s().p("AggBbIgIgCQgGAAgFAKIgHAAIgChEIAGAAQAJAbAQANQAQANANAAQAJAAAGgFQAHgGgBgJQABgJgHgHQgFgIgVgOQgegVgJgKQgNgRAAgTQAAgWAOgRQAPgSAdAAQAOAAAOAHQAFADAEAAQADAAADgBIAHgJIAGAAIAEBAIgHAAQgMgcgOgLQgNgKgMAAQgIAAgFAGQgHAFAAAHQAAAGAFAFQAGAIAdAUQAdAUAJANQAKANAAASQAAAPgIAPQgIAPgOAIQgPAIgRAAQgMAAgXgIg");
                this.shape_10.setTransform(601.9,89.6);

                this.shape_11 = new cjs.Shape();
                this.shape_11.graphics.f("#000000").s().p("AgxCLIAAgHQAMgBAGgGQAEgFAAgUIAAhsQAAgUgFgGQgFgFgMgBIAAgHIBNAAIAACTQAAAUAFAGQAEAFAOABIAAAHgAgVhVQgJgJAAgNQAAgNAJgIQAJgKAMAAQANAAAJAKQAJAIAAANQAAANgJAJQgKAJgMAAQgMAAgJgJg");
                this.shape_11.setTransform(588.3,85.1);

                this.shape_12 = new cjs.Shape();
                this.shape_12.graphics.f("#000000").s().p("AiICIIAAgIIAJAAQAMAAAGgDQAHgEADgGQABgFAAgVIAAixQAAgVgCgFQgCgFgHgEQgGgEgMAAIgJAAIAAgIIB6AAQAvAAAeANQAkARATAhQATAgAAApQAAAcgKAZQgJAYgOAQQgPAPgTAKQgTAJgcAFQgMADgZAAgAggBcQAAAQABAEQACAEAEACQAFADAKAAQAhAAARgXQAYgfAAhBQAAgzgQgfQgNgYgUgJQgPgGggAAg");
                this.shape_12.setTransform(567,85.4);

                this.shape_13 = new cjs.Shape();
                this.shape_13.graphics.f("#000000").s().p("AAGCIIAAgHQAKgCAGgGQADgGAAgUIAAhTQAAgXgCgFQgCgGgEgEQgFgDgFAAQgHAAgIAGQgHAFgIAOIAABjQAAAUADAFQADAHAMACIAAAHIhfAAIAAgHQAMgCAFgGQADgEAAgWIAAi9QAAgVgDgGQgFgFgMgBIAAgIIBNAAIAABtQAPgRAMgGQANgHANAAQASAAAMAKQANAKAEAOQAEANAAAfIAABJQAAAWAEAFQAEAFAMACIAAAHg");
                this.shape_13.setTransform(531.3,85.4);

                this.shape_14 = new cjs.Shape();
                this.shape_14.graphics.f("#000000").s().p("AgTB3QgNgKgDgMQgCgHAAgeIAAhkIgYAAIAAgHQAZgRARgVQATgTAMgYIAGAAIAABEIAtAAIAAAUIgtAAIAAByQAAARACAFQABAEAEADQADADAEAAQANAAAMgTIAGAEQgRAmgkAAQgRAAgMgKg");
                this.shape_14.setTransform(513.1,86.4);

                this.shape_15 = new cjs.Shape();
                this.shape_15.graphics.f("#000000").s().p("AgyCLIAAgHQANgBAGgGQAEgFAAgUIAAhsQAAgUgFgGQgFgFgNgBIAAgHIBOAAIAACTQAAAUAEAGQAFAFANABIAAAHgAgVhVQgJgJAAgNQAAgNAJgIQAJgKAMAAQANAAAJAKQAJAIAAANQAAANgJAJQgKAJgMAAQgMAAgJgJg");
                this.shape_15.setTransform(500.6,85.1);

                this.shape_16 = new cjs.Shape();
                this.shape_16.graphics.f("#000000").s().p("ABKCLIhEiuIhICuIgIAAIhZjdQgOghgFgHQgGgHgNgBIAAgIIB2AAIAAAIQgOAAgFAEQgEAEgBAGQAAAHALAZIA1CDIAqhmIgLgdQgJgYgFgHQgFgJgHgDQgGgDgNAAIAAgIICDAAIAAAIQgOAAgGACQgEABgCAEQgDADAAAEQAAAFAJAXIAyCAIAshzQAHgSACgHIABgMQAAgIgGgFQgFgFgQAAIAAgIIBHAAIAAAIQgIAAgGAEQgEAEgFAHIgMAfIhWDfg");
                this.shape_16.setTransform(474.2,85.7);

                this.shape_17 = new cjs.Shape();
                this.shape_17.graphics.f("#000000").s().p("AAHBhIAAgIQAKgBAFgIQADgEAAgVIAAhSQgBgWgBgHQgCgFgEgEQgFgDgFAAQgQgBgPAZIAABjQABAWAEAFQADAGAKABIAAAIIheAAIAAgIQAMgBAFgHQADgDAAgXIAAhoQAAgVgDgFQgFgGgMgBIAAgIIBMAAIAAAZQAOgQANgHQANgIAQABQARgBAMALQAMAKAFAPQADALAAAhIAABHQAAAXAEAEQADAGANABIAAAIg");
                this.shape_17.setTransform(432.2,89.4);

                this.shape_18 = new cjs.Shape();
                this.shape_18.graphics.f("#000000").s().p("AhABGQgXgeAAgnQAAgnAXgeQAYgeAoAAQAYAAAVANQAVAMALAXQALAYAAAaQAAAogVAbQgYAggrAAQgpAAgXgdgAgQhMQgIAIgCAWQgCAXAAAnQAAAWADATQACAOAHAHQAHAIAJAAQAIAAAGgFQAIgHADgMQAEgTAAg5QAAgigEgNQgEgNgHgGQgFgEgJAAQgJAAgHAIg");
                this.shape_18.setTransform(410.4,89.6);

                this.shape_19 = new cjs.Shape();
                this.shape_19.graphics.f("#000000").s().p("AhkCMIAAgHQAMAAAGgHQAEgFAAgTIAAjEQAAgUgFgGQgEgFgNgBIAAgHIBPAAIAAAYQAJgOAKgHQAOgJARAAQAVAAARANQARANAJAXQAIAXAAAaQAAAdgJAWQgJAYgRAMQgSAMgVAAQgPAAgNgGQgKgGgKgMIAABFQAAAPABAFQADAFAFADQAEACANAAIAAAHgAgVhVIAABjQAQAYATAAQALAAAHgLQAKgRAAgvQAAgwgLgSQgIgMgMAAQgUAAgMAeg");
                this.shape_19.setTransform(388.3,93.7);

                this.shape_20 = new cjs.Shape();
                this.shape_20.graphics.f("#000000").s().p("Ag7BXQgNgKgEgNQgEgNAAghIAAhJQAAgVgEgFQgEgFgMgCIAAgHIBMAAIAAB+QAAAVACAFQACAGAEADQAEADAGAAQAGAAAGgEQAIgFALgQIAAhjQAAgVgEgFQgEgFgMgCIAAgHIBMAAIAACRQAAAWAEAFQAEAFAMACIAAAHIhMAAIAAgZQgOAQgMAHQgNAHgRAAQgQAAgMgJg");
                this.shape_20.setTransform(365.9,89.9);

                this.shape_21 = new cjs.Shape();
                this.shape_21.graphics.f("#000000").s().p("AhABGQgXgeAAgnQAAgnAXgeQAYgeAoAAQAYAAAVANQAVAMALAXQALAYAAAaQAAAogVAbQgYAggrAAQgpAAgXgdgAgQhMQgIAIgCAWQgCAXAAAnQAAAWADATQACAOAHAHQAHAIAJAAQAIAAAGgFQAIgHADgMQAEgTAAg5QAAgigEgNQgEgNgHgGQgFgEgJAAQgJAAgHAIg");
                this.shape_21.setTransform(344.3,89.6);

                this.shape_22 = new cjs.Shape();
                this.shape_22.graphics.f("#000000").s().p("Ag5B9QgigSgSghQgTggAAglQAAgmAVgjQAUgiAjgUQAigTAmAAQAdAAAfAMQATAIAFAAQAGAAAFgFQAFgFABgKIAIAAIAABeIgIAAQgJglgYgTQgYgUgeAAQgaAAgUAPQgVAOgKAYQgMAeAAAlQAAAkAJAeQAJAeAUAPQASAPAfAAQAaAAAVgLQAWgLAXgcIAAAYQgXAYgYAKQgZALghAAQgqAAgigRg");
                this.shape_22.setTransform(318.9,85.4);

                this.shape_23 = new cjs.Shape();
                this.shape_23.graphics.f("#000000").s().p("AANCKIAAgHIAFAAQAQAAAHgEQAEgEAAgFIgBgIIgGgPIgPgiIhfAAIgLAaQgGAOAAAJQAAALAKAGQAFADAVABIAAAHIhaAAIAAgHQAPgCAJgKQAJgKAOgfIBgjYIAEAAIBiDeQAOAgAJAIQAHAGAMABIAAAHgAhBAvIBSAAIgohdg");
                this.shape_23.setTransform(279.3,85.2);

                this.shape_24 = new cjs.Shape();
                this.shape_24.graphics.f("#000000").s().p("AAHBhIAAgIQAKgBAEgIQAEgEAAgVIAAhSQgBgWgBgHQgCgFgEgEQgFgDgEAAQgRgBgPAZIAABjQAAAWAFAFQADAGAKABIAAAIIheAAIAAgIQAMgBAFgHQADgDAAgXIAAhoQAAgVgDgFQgFgGgMgBIAAgIIBMAAIAAAZQAOgQANgHQANgIAQABQARgBANALQALAKAFAPQADALAAAhIAABHQAAAXAEAEQADAGANABIAAAIg");
                this.shape_24.setTransform(243.1,89.4);

                this.shape_25 = new cjs.Shape();
                this.shape_25.graphics.f("#000000").s().p("AgxCLIAAgHQAMgBAGgGQAEgFAAgUIAAhsQAAgUgFgGQgEgFgNgBIAAgHIBNAAIAACTQAAAUAFAGQAEAFAOABIAAAHgAgVhVQgJgJAAgNQAAgNAJgIQAJgKAMAAQANAAAJAKQAJAIAAANQAAANgJAJQgKAJgMAAQgMAAgJgJg");
                this.shape_25.setTransform(226.1,85.1);

                this.shape_26 = new cjs.Shape();
                this.shape_26.graphics.f("#000000").s().p("ABKCLIhDiuIhKCuIgHAAIhZjdQgOghgFgHQgFgHgOgBIAAgIIB3AAIAAAIQgPAAgFAEQgEAEAAAGQgBAHAKAZIA2CDIArhmIgMgdQgJgYgFgHQgFgJgGgDQgHgDgNAAIAAgIICDAAIAAAIQgOAAgGACQgEABgDAEQgCADAAAEQAAAFAJAXIAxCAIAshzQAIgSABgHIACgMQAAgIgFgFQgHgFgPAAIAAgIIBGAAIAAAIQgHAAgFAEQgGAEgDAHIgNAfIhVDfg");
                this.shape_26.setTransform(199.7,85.7);

                this.shape_27 = new cjs.Shape();
                this.shape_27.graphics.f("#000000").s().p("AAWBtQgOARgKAGQgLAHgOgBQgkAAgVgfQgRgaAAgnQAAgeAKgXQALgXASgNQATgMAUAAQANAAAKAGQAKAFAMANIAAg5QAAgVgBgEQgDgHgFgCQgFgDgMAAIAAgJIBSAAIAADXQAAAWABAEQACAGAFADQAEAEAMABIAAAGIhQAPgAgZgjQgIAGgEAQQgFAPAAAfQAAAkAFARQAFARAKAIQAEADAIAAQAQAAAQgbIAAhiQgOgcgVAAQgIAAgEAEg");
                this.shape_27.setTransform(157.9,85.7);

                this.shape_28 = new cjs.Shape();
                this.shape_28.graphics.f("#000000").s().p("AAGBhIAAgIQALgBAFgIQACgEAAgVIAAhSQAAgWgBgHQgCgFgEgEQgFgDgFAAQgQgBgOAZIAABjQAAAWADAFQAEAGALABIAAAIIhfAAIAAgIQAMgBAFgHQADgDAAgXIAAhoQAAgVgDgFQgFgGgMgBIAAgIIBNAAIAAAZQAOgQAMgHQANgIAQABQARgBAMALQANAKAEAPQADALAAAhIAABHQAAAXAEAEQADAGANABIAAAIg");
                this.shape_28.setTransform(134.8,89.4);

                this.shape_29 = new cjs.Shape();
                this.shape_29.graphics.f("#000000").s().p("AANCKIAAgHIAFAAQAQAAAHgEQAEgEAAgFIgBgIIgGgPIgPgiIhfAAIgLAaQgGAOAAAJQAAALAKAGQAFADAVABIAAAHIhaAAIAAgHQAPgCAJgKQAJgKAOgfIBgjYIAEAAIBiDeQAOAgAJAIQAHAGAMABIAAAHgAhBAvIBSAAIgohdg");
                this.shape_29.setTransform(108.4,85.2);

                this.shape_30 = new cjs.Shape();
                this.shape_30.graphics.f("#000000").s().p("AhPCAQgLgJAAgOQAAgLAHgIQAHgIALAAQAKAAAGAHQAGAGAAAOQAAAHACADQABAAAAABQABAAAAAAQABABAAAAQABAAABAAQAEAAAGgGQAIgIALgfIAFgPIg8iKQgOgfgGgIQgHgHgJgDIAAgHIBjAAIAAAHQgJABgEADQgEAEAAAEQAAAIAKAXIAfBJIAWg5QAMgeAAgMQAAgHgFgFQgFgEgNgBIAAgHIA/AAIAAAHQgJABgGAHQgGAGgNAjIg2CKQgTA0gKAMQgOARgVAAQgQAAgKgKg");
                this.shape_30.setTransform(73.2,94.1);

                this.shape_31 = new cjs.Shape();
                this.shape_31.graphics.f("#000000").s().p("AAUBaQgJgHgCgPQghAegcAAQgQAAgKgLQgLgKAAgQQAAgVATgRQASgSA9gbIAAgTQAAgVgCgGQgDgFgFgEQgHgEgIAAQgNAAgIAFQgFAEAAAFQAAAEAFAGQAIAJAAAIQAAAKgHAHQgIAHgLAAQgNAAgIgIQgJgIAAgKQAAgOALgNQAMgOAUgHQAVgHAVAAQAaAAAQAMQAPALAFANQADAJAAAeIAABIQAAAMABAEQABADACACQAAAAABAAQAAABABAAQAAAAABAAQABAAAAAAQAGAAAFgHIAGAFQgKAOgLAHQgKAHgOAAQgQAAgJgIgAgaAVQgIALAAALQAAAJAHAHQAFAFAJAAQAKAAAMgLIAAg+QgXAOgMAQg");
                this.shape_31.setTransform(53.3,89.5);

                this.shape_32 = new cjs.Shape();
                this.shape_32.graphics.f("#000000").s().p("AgyCIIAAgHQANgBAGgHQAEgEAAgUIAAjBQAAgTgFgGQgEgGgOAAIAAgIIBOAAIAADoQAAAUAFAFQAFAGANABIAAAHg");
                this.shape_32.setTransform(37,85.4);

                this.shape_33 = new cjs.Shape();
                this.shape_33.graphics.f("#000000").s().p("AhxCIIAAgIQATAAAHgDQAGgEADgFQADgGAAgWIAAivQAAgWgDgGQgDgGgGgDQgHgDgTAAIAAgIIB1AAQA7AAAZAVQAaAVAAAfQAAAbgRASQgQASgdAHQgTAFguAAIAABLQAAAWADAGQADAGAHADQAGADASAAIAAAIgAgNgCIAKABQAYAAANgPQANgOAAgfQAAgegNgOQgNgOgZAAIgJAAg");
                this.shape_33.setTransform(18.4,85.4);

                this.shape_34 = new cjs.Shape();
                this.shape_34.graphics.f("#FFEA04").s().p("EhDBANhIAA7BMCGDAAAIAAbBg");
                this.shape_34.setTransform(429,86.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_34},{t:this.shape_33},{t:this.shape_32},{t:this.shape_31},{t:this.shape_30},{t:this.shape_29},{t:this.shape_28},{t:this.shape_27},{t:this.shape_26},{t:this.shape_25},{t:this.shape_24},{t:this.shape_23},{t:this.shape_22},{t:this.shape_21},{t:this.shape_20},{t:this.shape_19},{t:this.shape_18},{t:this.shape_17},{t:this.shape_16},{t:this.shape_15},{t:this.shape_14},{t:this.shape_13},{t:this.shape_12},{t:this.shape_11},{t:this.shape_10},{t:this.shape_9},{t:this.shape_8},{t:this.shape_7},{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.introduce, new cjs.Rectangle(0,0,858,173.1), null);


            (lib.gameover = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // Layer 1
                this.shape = new cjs.Shape();
                this.shape.graphics.f("#FFFFFF").s().p("Ah0CNIAAgLQARgBAHgIQAGgIAAglIAAiWQAAgYgCgGQgEgIgFgEQgFgDgOgCIAAgLIBvAAIAAA+QAagrAVgNQAUgOAUAAQAQAAAKAKQAKAKAAASQgBAUgIALQgKALgOAAQgQAAgLgKIgNgLQgDgCgEAAQgIAAgIAGQgMAKgGATQgJAdAAAgIAAA/IAAARQAAARACAEQADAJAHADQAHADAQABIAAALg");
                this.shape.setTransform(577.5,97);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#FFFFFF").s().p("AhYBiQgZgmAAg3QgBhEAmgoQAlgpAwAAQAqAAAfAiQAeAiACBDIiVAAQADA1AbAhQASAXAdAAQASAAAOgJQAOgKARgaIAJAHQgWAugaASQgbATgkAAQg8AAgfgvgAgThuQgRAaAAAuIAAAKIBOAAQABgvgGgSQgFgRgKgKQgHgFgKAAQgOAAgKAPg");
                this.shape_1.setTransform(550.6,97.4);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#FFFFFF").s().p("AgFCNIhcjTQgRgmgKgLQgGgIgNgCIAAgLICQAAIAAALQgNAAgEAFQgIAHAAAIQABALANAeIAsBlIAkhXQAPgmAAgQQAAgJgGgFQgHgHgRAAIAAgLIBaAAIAAALQgNACgIAHQgIAJgRAmIhbDWg");
                this.shape_2.setTransform(521.9,97.8);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#FFFFFF").s().p("AikCGQgug6AAhOQAAhYA8g7QA9g7BXADQBegDA8A7QA7A7AABYQAABLgtA5Qg6BMhrAAQhqAAg7hIgAhRiCQgXAugBBUQABBmAjAwQAZAiAsAAQAfAAAUgOQAZgTAOgpQAPgpAAhDQAAhNgPgnQgOgogXgQQgWgQgeAAQg2AAgcA4g");
                this.shape_3.setTransform(483.7,91.3);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f("#FFFFFF").s().p("AhYBiQgZgmAAg3QAAhEAlgoQAlgpAwAAQAqAAAfAiQAeAiACBDIiVAAQADA1AbAhQASAXAdAAQARAAAPgJQAOgKARgaIAJAHQgWAugaASQgbATgkAAQg8AAgfgvgAgThuQgRAaAAAuIAAAKIBOAAQAAgvgEgSQgFgRgLgKQgHgFgKAAQgOAAgKAPg");
                this.shape_4.setTransform(432.4,97.4);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#FFFFFF").s().p("ABaCNIAAgLQAQgBAIgLQAFgJAAgcIAAh0QAAglgDgKQgCgKgHgFQgGgFgJAAQgNABgNAIQgMAKgOASIAACSQAAAeAGAIQAGALAUAAIAAALIiNAAIAAgLQALAAAHgFQAGgFADgIQABgGAAgZIAAh0QAAglgCgKQgDgJgHgGQgHgFgIAAQgMAAgJAGQgOAJgQAWIAACSQAAAdAGAKQAGAJASABIAAALIiNAAIAAgLQARgBAIgJQAEgHAAggIAAiZQABgggGgHQgGgIgSgCIAAgLIBvAAIAAAkQAXgYATgKQAUgKAWAAQAaAAASAMQARANAKAZQAYgaAVgNQAVgLAYAAQAdAAARANQAQANAGAUQAHAUAAAsIAABvQAAAgAGAHQAGAIASACIAAALg");
                this.shape_5.setTransform(394,97);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#FFFFFF").s().p("AAdCEQgNgLgDgWQgxAsgoAAQgXAAgQgQQgQgPAAgXQAAggAbgYQAbgZBagpIAAgcQAAgfgDgHQgEgJgIgGQgKgGgMAAQgSAAgMAIQgJAGABAHQAAAGAIAJQALANAAALQAAAPgKAKQgMAKgQAAQgTAAgNgLQgMgLAAgPQAAgVARgUQARgTAegKQAdgKAgAAQAmAAAXARQAXAQAHAUQADALAAAtIAABpQAAATACAFQACAEACADQADADAEAAQAIAAAIgMIAIAHQgOAWgQAKQgPAKgVAAQgXAAgNgLgAgnAeQgMAQAAAQQAAAOAKAJQAIAIANAAQAOAAATgQIAAhbQgjAVgRAXg");
                this.shape_6.setTransform(354.5,97.2);

                this.shape_7 = new cjs.Shape();
                this.shape_7.graphics.f("#FFFFFF").s().p("AhWDAQgmgPgcgZQgcgZgRggQgUgoAAgyQAAhZA/g9QA/g+BfAAQAdAAAYAEQANADAcALQAdALAFAAQAIAAAIgGQAHgGAFgRIALAAIAACMIgLAAQgTg5gngeQgogeguAAQgrAAgeAZQgeAZgMAtQgMAtAAAuQAAA5ANArQAOArAdAUQAeAVApgBQAOAAAPgDQAQgCAQgHIAAhSQgBgXgDgHQgDgHgKgGQgKgGgPABIgKAAIAAgLIDBAAIAAALQgWABgJAFQgIAEgFALQgDAFAAAWIAABSQglARgpAKQgqAIgsAAQg4AAglgQg");
                this.shape_7.setTransform(316.3,91.2);

                this.shape_8 = new cjs.Shape();
                this.shape_8.graphics.f("#990000").s().p("EhDBANhIAA7BMCGDAAAIAAbBg");
                this.shape_8.setTransform(429,86.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_8},{t:this.shape_7},{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape}]}).wait(1));

            }).prototype = getMCSymbolPrototype(lib.gameover, new cjs.Rectangle(0,0,858,173.1), null);


// stage content:
            (lib.goodtravelan = function(mode,startPosition,loop) {
                this.initialize(mode,startPosition,loop,{});

                // timeline functions:
                this.frame_0 = function() {
                    let root=this;
                    let fakecards=[root.c1,root.c2,root.c3,root.c4,root.c5,root.c6,root.c7,root.c8,root.c9,root.c10,root.c11,root.c12,root.c13,root.c14,root.c15,root.c16,root.c17,root.c18,root.c19,root.c20,root.c21,root.c22,root.c23,root.c24,root.c25,root.c26,root.c27,root.c28,root.c29,root.c30,root.c31,root.c32,root.c33,root.c34,root.c35,root.c36,root.c37,root.c38,root.c39,root.c40,root.c41,root.c42,root.c43,root.c44,root.c45,root.c46,root.c47,root.c48,root.c49,root.c50,root.c51,root.c52,root.c53,root.c54,root.c55,root.c56,root.c57,root.c58,root.c59,root.c60,root.c61];
                    let rightcard=[root.r1,root.r2,root.r3];
                    let score=0;
                    let countdown=50;
                    root.go.visible=false;
                    root.winner.visible=false;
                    root.start.addEventListener("click",function(){
                        var user="<?=$user?>";
                        var id=$(this).attr('id');
                        if(user==""){
                            $('#echarpeModal').modal('hide');
                            $('#i').html($(this).attr('id'));
                            $('#lo').modal('show');

                        }
                        else{
                            root.intr.visible=false;
                            root.start.visible=false;
                            root.start.x=900;
                            init();
                            createjs.Ticker.interval=300;
                            createjs.Ticker.on("tick",timer);
                            function timer(){
                                countdown-=1;
                                root.countdown.text=countdown;
                                if(countdown==0 && score!=300){
                                    root.go.visible=true;
                                }
                                if(countdown>=0 && score==300){
                                    root.winner.visible=true;
                                    var username="<?=$user?>";
                                    $.ajax({
                                        type: "POST",
                                        url: "addcoupon.php",
                                        data: 'user='+username
                                    })
                                }
                            }
                            function init(){

                                for(let i=0;i<fakecards.length;i++){
                                    let randposx=Math.random()*300+200;
                                    let randposy=Math.random()*180+50;
                                    fakecards[i].x=randposx;
                                    fakecards[i].y=randposy;
                                }
                                for(let i=0;i<rightcard.length;i++){
                                    let randposx=Math.random()*300+200;
                                    let randposy=Math.random()*180+50;
                                    rightcard[i].x=randposx;
                                    rightcard[i].y=randposy;
                                }

                                root.countdown.text=countdown;
                                root.score.text=score;

                            }

                            for(let i=0;i<fakecards.length;i++){
                                fakecards[i].addEventListener('click',function(){
                                    fakecards[i].visible=false;
                                })
                            }

                            for(let i=0;i<rightcard.length;i++){
                                rightcard[i].addEventListener('click',function(){
                                    rightcard[i].visible=false;
                                    score=score+100;
                                    root.countdown.text=countdown;
                                    root.score.text=score;

                                })
                            }
                        }


                    });
                }

                // actions tween:
                this.timeline.addTween(cjs.Tween.get(this).call(this.frame_0).wait(1));

                // Layer 6
                this.start = new lib.play();
                this.start.parent = this;
                this.start.setTransform(401,247.3,1,1,0,0,0,47,20.3);

                this.intr = new lib.introduce();
                this.intr.parent = this;
                this.intr.setTransform(399.9,192,0.932,1,0,0,0,428.9,86.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.intr},{t:this.start}]}).wait(1));

                // Layer 5
                this.winner = new lib.winner();
                this.winner.parent = this;
                this.winner.setTransform(411,192,1,1,0,0,0,428.9,86.5);

                this.timeline.addTween(cjs.Tween.get(this.winner).wait(1));

                // Layer 4
                this.go = new lib.gameover();
                this.go.parent = this;
                this.go.setTransform(382,197,1,1,0,0,0,428.9,86.5);

                this.timeline.addTween(cjs.Tween.get(this.go).wait(1));

                // Layer 1
                this.score = new cjs.Text("", "bold 14px 'Times New Roman'");
                this.score.name = "score";
                this.score.lineHeight = 18;
                this.score.lineWidth = 66;
                this.score.parent = this;
                this.score.setTransform(718,246.5);

                this.countdown = new cjs.Text("", "bold 14px 'Times New Roman'");
                this.countdown.name = "countdown";
                this.countdown.lineHeight = 18;
                this.countdown.lineWidth = 66;
                this.countdown.parent = this;
                this.countdown.setTransform(718,152);

                this.shape = new cjs.Shape();
                this.shape.graphics.f("#000000").s().p("AgJAnQgEgEgBgGQABgGAEgFQAEgEAFAAQAGAAAEAEQAEAFABAGQgBAGgEAEQgEAEgGAAQgFAAgEgEgAgJgRQgFgFAAgGQAAgGAFgEQAEgEAFAAQAGAAAEAEQAEAEABAGQgBAGgEAFQgEAEgGAAQgFAAgEgEg");
                this.shape.setTransform(785.3,225.5);

                this.shape_1 = new cjs.Shape();
                this.shape_1.graphics.f("#000000").s().p("Ag1A7IAAgDIAEAAQAFAAADgBIAEgFQABgCAAgJIAAhOIgBgJQgBgEgCgBQgDgCgGgBIgEAAIAAgCIBjAAIAAAjIgEAAQgCgNgFgGQgFgFgIgDQgFgCgNAAIgMAAIAAAwIADAAQAKABAFgIQAFgGACgOIADAAIAAA9IgDAAQgBgKgEgGQgDgHgFgDQgEgBgIAAIAAAhQAAAKABACQAAAAABABQAAAAAAABQABAAAAABQABAAAAAAQADACAEAAIAHAAQAQAAALgIQAKgIAEgPIADAAIgFAlg");
                this.shape_1.setTransform(771.6,223.7);

                this.shape_2 = new cjs.Shape();
                this.shape_2.graphics.f("#000000").s().p("AAbA7Igmg2IgHAAIAAAiQAAAJABADQAAADADABIAMABIAAADIg9AAIAAgDIALgBQADgCABgDQACgBAAgKIAAhNQAAgJgCgDQgBgDgDgBQgDgBgIgBIAAgCIA3AAQAVAAAKACQAKADAGAIQAGAIAAALQAAAOgJAIQgGAFgLACIAcAoIAIAKQAEADAFAAIAAADgAgSAAIAEAAQANAAAEgDQAHgBADgHQADgFABgJQAAgPgHgGQgGgHgNABIgJAAg");
                this.shape_2.setTransform(759.6,223.7);

                this.shape_3 = new cjs.Shape();
                this.shape_3.graphics.f("#000000").s().p("AgwAoQgOgRAAgXQAAgaASgSQASgSAaABQAcgBASASQARASAAAaQAAAWgNARQgSAXggAAQgfAAgRgWgAgYgmQgGANAAAZQAAAfAKAOQAIAKAMAAQAJAAAGgEQAIgGAEgMQAFgMAAgUQAAgXgFgMQgEgLgHgFQgHgFgJAAQgPAAgJARg");
                this.shape_3.setTransform(745.8,223.7);

                this.shape_4 = new cjs.Shape();
                this.shape_4.graphics.f("#000000").s().p("AgYA3QgPgIgJgOQgIgOAAgRQABgQAIgPQAKgPAPgJQAPgIAQAAQAMAAAOAFIALADQADAAABgCQACgCABgEIAEAAIAAApIgEAAQgDgQgLgJQgKgIgOAAQgLAAgIAGQgKAHgEAKQgGANABAQQAAAPADAOQAEANAJAHQAIAGANAAQALAAAKgFQAKgFAKgMIAAALQgKAKgLAFQgLAEgPAAQgRAAgPgHg");
                this.shape_4.setTransform(732.2,223.6);

                this.shape_5 = new cjs.Shape();
                this.shape_5.graphics.f("#000000").s().p("AgJA9IgNgEQgEgCgDAAQgCAAgDACQgCACgCADIgDAAIAAgtIADAAQAEATALAKQALAKAMAAQAKAAAGgFQAGgGAAgGQAAgFgDgEQgCgEgFgEQgEgDgLgGQgQgIgHgFQgHgFgEgHQgEgHAAgIQAAgPALgJQAKgKAQAAQAFAAAFABIAKAEQAGADADAAQAAAAABAAQAAAAABAAQAAgBAAAAQABAAAAgBQACgBABgFIACAAIABAnIgDAAQgDgOgKgKQgKgJgKAAQgJAAgGAFQgFAFAAAGQAAAEACADQADAEAFAEIASALQAVAKAHAIQAIAJAAAMQAAAPgMAKQgMALgSAAQgEAAgFgBg");
                this.shape_5.setTransform(720.9,223.7);

                this.shape_6 = new cjs.Shape();
                this.shape_6.graphics.f("#000000").s().p("AAhAvIg+hMIAAA6QAAAIAFADQADADAFAAIACAAIAAACIghAAIAAgCQAHAAADgDQAEgDAAgIIAAhAIgCgDIgGgFIgGgBIAAgCIAhAAIAsA4IAAgnQAAgIgCgDQgDgEgIAAIAAgCIAfAAIAAACQgGABgCABQAAAAgBABQAAAAgBABQAAAAAAABQgBAAAAABQgBADAAAGIAABMg");
                this.shape_6.setTransform(792.6,125.5);

                this.shape_7 = new cjs.Shape();
                this.shape_7.graphics.f("#000000").s().p("AAZAvIgWg6IgZA6IgDAAIgehKQgFgMgCgCQgCgDgEAAIAAgCIAoAAIAAACQgEAAgCACQAAAAgBAAQAAABAAAAQAAAAAAABQgBAAAAABIAEALIASAsIAOgiIgDgKIgFgLIgEgEIgHgBIAAgCIAsAAIAAACIgHABIgCABIgBADIADAKIARArIAQgnIACgJIABgEQAAAAAAgBQAAgBAAAAQgBgBAAAAQAAgBgBAAQgCgCgGAAIAAgCIAZAAIAAACQgBAAAAAAQgBAAgBABQAAAAgBAAQAAAAgBABQAAAAAAAAQgBABAAAAQgBABAAAAQAAABgBAAIgEALIgdBLg");
                this.shape_7.setTransform(780.6,125.5);

                this.shape_8 = new cjs.Shape();
                this.shape_8.graphics.f("#000000").s().p("AglAfQgLgNAAgSQAAgUAOgOQAOgOAUABQAVgBAOAOQAOAOAAAUQAAARgKAOQgOARgZAAQgYAAgNgRgAgSgdQgGAKAAATQAAAYAJALQAGAIAJAAQAHAAAFgDQAGgFADgJQADgKAAgPQAAgSgDgJQgDgJgGgEQgFgDgHAAQgMAAgGANg");
                this.shape_8.setTransform(768.1,125.4);

                this.shape_9 = new cjs.Shape();
                this.shape_9.graphics.f("#000000").s().p("AgtAuIAAgCIACAAQAEAAADgCQAAAAABAAQAAgBABAAQAAAAAAgBQABAAAAgBIAAgJIAAg8QAAgHgBgBQAAgBAAAAQAAgBgBAAQAAgBAAAAQgBAAAAgBIgHgBIgCAAIAAgCIApAAQAQAAAJAEQANAGAHALQAFALAAANQAAAKgCAIQgEAIgEAGQgFAFgHADQgGAEgKABIgMABgAgKAfIAAAHIACACIAGABQAKAAAGgIQAIgKAAgWQAAgRgFgLQgFgIgHgDQgFgCgKAAg");
                this.shape_9.setTransform(757.4,125.4);

                this.shape_10 = new cjs.Shape();
                this.shape_10.graphics.f("#000000").s().p("AgXAuIAAgCIADAAQAEAAACgCIADgDQABgCAAgHIAAhGIgHAAQgJAAgFAEQgGAFgBALIgDAAIAAgZIBTAAIAAAZIgDAAQgCgJgDgEQgCgEgFgCQgDgBgGAAIgHAAIAABGQAAAIABABIADADQACACAEAAIADAAIAAACg");
                this.shape_10.setTransform(747.9,125.4);

                this.shape_11 = new cjs.Shape();
                this.shape_11.graphics.f("#000000").s().p("AAhAvIg+hMIAAA6QAAAIAFADQADADAFAAIACAAIAAACIghAAIAAgCQAHAAADgDQAEgDAAgIIAAhAIgCgDIgFgFIgHgBIAAgCIAhAAIAsA4IAAgnQAAgIgCgDQgDgEgIAAIAAgCIAfAAIAAACQgGABgCABQAAAAgBABQAAAAgBABQAAAAAAABQgBAAAAABQgBADAAAGIAABMg");
                this.shape_11.setTransform(738.1,125.5);

                this.shape_12 = new cjs.Shape();
                this.shape_12.graphics.f("#000000").s().p("AgTAsQgIgEgEgHQgDgHAAgLIAAgtQgBgIgBgCIgDgDIgIgBIAAgCIAvAAIAAACIgCAAIgHABIgDADQgBACAAAIIAAAtQAAAMACAEQADAEAEADQAEACAFAAQAIAAAGgDQAEgDADgGQADgGAAgPIAAglQAAgGgBgDQgBAAAAgBQAAAAgBgBQAAAAgBgBQAAAAgBAAQgCgCgHAAIAAgCIAhAAIAAACIgCAAQgEAAgCACQgDABgCADIgBAIIAAAiQAAARgCAHQgBAHgJAGQgIAGgOAAQgMAAgHgDg");
                this.shape_12.setTransform(728.1,125.5);

                this.shape_13 = new cjs.Shape();
                this.shape_13.graphics.f("#000000").s().p("AglAfQgLgNAAgSQAAgUAOgOQAOgOAUABQAVgBAOAOQAOAOAAAUQAAARgKAOQgOARgZAAQgYAAgNgRgAgSgdQgGAKAAATQAAAYAJALQAGAIAJAAQAHAAAFgDQAGgFADgJQADgKAAgPQAAgSgDgJQgDgJgGgEQgFgDgHAAQgMAAgGANg");
                this.shape_13.setTransform(717.6,125.4);

                this.shape_14 = new cjs.Shape();
                this.shape_14.graphics.f("#000000").s().p("AgTArQgLgHgHgKQgGgMAAgMQAAgMAHgNQAHgLALgHQAMgHANAAQAJAAAMAFIAHACQABAAAAAAQABAAAAAAQABAAAAAAQABgBAAAAQACgCAAgEIADAAIAAAhIgDAAQgCgNgJgGQgIgHgKAAQgJAAgHAFQgGAFgEAIQgFAKAAANQAAALAEAKQADALAHAFQAFAFALAAQAIAAAIgEQAIgDAHgKIAAAIQgIAJgIADQgJAEgLgBQgNAAgMgFg");
                this.shape_14.setTransform(707,125.4);

                this.c61 = new lib.wrongcard();
                this.c61.parent = this;
                this.c61.setTransform(405,100,1,1,0,0,0,50,25);

                this.c60 = new lib.wrongcard();
                this.c60.parent = this;
                this.c60.setTransform(99,125,1,1,0,0,0,50,25);

                this.c59 = new lib.wrongcard();
                this.c59.parent = this;
                this.c59.setTransform(115.1,160.5,1,1,0,0,0,50,25);

                this.c58 = new lib.wrongcard();
                this.c58.parent = this;
                this.c58.setTransform(165,185.5,1,1,0,0,0,50,25);

                this.c57 = new lib.wrongcard();
                this.c57.parent = this;
                this.c57.setTransform(409,189.5,1,1,0,0,0,50,25);

                this.c56 = new lib.wrongcard();
                this.c56.parent = this;
                this.c56.setTransform(436,160.5,1,1,0,0,0,50,25);

                this.c54 = new lib.wrongcard();
                this.c54.parent = this;
                this.c54.setTransform(436,260.5,1,1,0,0,0,50,25);

                this.c55 = new lib.wrongcard();
                this.c55.parent = this;
                this.c55.setTransform(457,215.5,1,1,0,0,0,50,25);

                this.c5 = new lib.wrongcard();
                this.c5.parent = this;
                this.c5.setTransform(149,125,1,1,0,0,0,50,25);

                this.c9 = new lib.wrongcard();
                this.c9.parent = this;
                this.c9.setTransform(305,150.5,1,1,0,0,0,50,25);

                this.c8 = new lib.wrongcard();
                this.c8.parent = this;
                this.c8.setTransform(269,160.5,1,1,0,0,0,50,25);

                this.c13 = new lib.wrongcard();
                this.c13.parent = this;
                this.c13.setTransform(583,200.5,1,1,0,0,0,50,25);

                this.c17 = new lib.wrongcard();
                this.c17.parent = this;
                this.c17.setTransform(560,50,1,1,0,0,0,50,25);

                this.c16 = new lib.wrongcard();
                this.c16.parent = this;
                this.c16.setTransform(520,269.5,1,1,0,0,0,50,25);

                this.c25 = new lib.wrongcard();
                this.c25.parent = this;
                this.c25.setTransform(359,235.5,1,1,0,0,0,50,25);

                this.c28 = new lib.wrongcard();
                this.c28.parent = this;
                this.c28.setTransform(55,25,1,1,0,0,0,50,25);

                this.c29 = new lib.wrongcard();
                this.c29.parent = this;
                this.c29.setTransform(205,50,1,1,0,0,0,50,25);

                this.c31 = new lib.wrongcard();
                this.c31.parent = this;
                this.c31.setTransform(384,160.5,1,1,0,0,0,50,25);

                this.c35 = new lib.wrongcard();
                this.c35.parent = this;
                this.c35.setTransform(620,100,1,1,0,0,0,50,25);

                this.c36 = new lib.wrongcard();
                this.c36.parent = this;
                this.c36.setTransform(469,56.5,1,1,0,0,0,50,25);

                this.c38 = new lib.wrongcard();
                this.c38.parent = this;
                this.c38.setTransform(355,50,1,1,0,0,0,50,25);

                this.c39 = new lib.wrongcard();
                this.c39.parent = this;
                this.c39.setTransform(220.1,106.5,1,1,0,0,0,50,25);

                this.c40 = new lib.wrongcard();
                this.c40.parent = this;
                this.c40.setTransform(15.1,180.5,1,1,0,0,0,50,25);

                this.c41 = new lib.wrongcard();
                this.c41.parent = this;
                this.c41.setTransform(532,156.5,1,1,0,0,0,50,25);

                this.c37 = new lib.wrongcard();
                this.c37.parent = this;
                this.c37.setTransform(369,6.5,1,1,0,0,0,50,25);

                this.c42 = new lib.wrongcard();
                this.c42.parent = this;
                this.c42.setTransform(346,369.5,1,1,0,0,0,50,25);

                this.c45 = new lib.wrongcard();
                this.c45.parent = this;
                this.c45.setTransform(326,125,1,1,0,0,0,50,25);

                this.c43 = new lib.wrongcard();
                this.c43.parent = this;
                this.c43.setTransform(132.1,335.5,1,1,0,0,0,50,25);

                this.c47 = new lib.wrongcard();
                this.c47.parent = this;
                this.c47.setTransform(255,25,1,1,0,0,0,50,25);

                this.c48 = new lib.wrongcard();
                this.c48.parent = this;
                this.c48.setTransform(188.1,10.5,1,1,0,0,0,50,25);

                this.c53 = new lib.wrongcard();
                this.c53.parent = this;
                this.c53.setTransform(473,10.5,1,1,0,0,0,50,25);

                this.c49 = new lib.wrongcard();
                this.c49.parent = this;
                this.c49.setTransform(3.1,125,1,1,0,0,0,50,25);

                this.c32 = new lib.wrongcard();
                this.c32.parent = this;
                this.c32.setTransform(473,359.5,1,1,0,0,0,50,25);

                this.c26 = new lib.wrongcard();
                this.c26.parent = this;
                this.c26.setTransform(294,95.5,1,1,0,0,0,50,25);

                this.c34 = new lib.wrongcard();
                this.c34.parent = this;
                this.c34.setTransform(88.1,85.5,1,1,0,0,0,50,25);

                this.c20 = new lib.wrongcard();
                this.c20.parent = this;
                this.c20.setTransform(294,260.5,1,1,0,0,0,50,25);

                this.c23 = new lib.wrongcard();
                this.c23.parent = this;
                this.c23.setTransform(20.1,292.5,1,1,0,0,0,50,25);

                this.c24 = new lib.wrongcard();
                this.c24.parent = this;
                this.c24.setTransform(269,346.5,1,1,0,0,0,50,25);

                this.c27 = new lib.wrongcard();
                this.c27.parent = this;
                this.c27.setTransform(269,56.5,1,1,0,0,0,50,25);

                this.c33 = new lib.wrongcard();
                this.c33.parent = this;
                this.c33.setTransform(176.1,346.5,1,1,0,0,0,50,25);

                this.c51 = new lib.wrongcard();
                this.c51.parent = this;
                this.c51.setTransform(88.1,385.5,1,1,0,0,0,50,25);

                this.c50 = new lib.wrongcard();
                this.c50.parent = this;
                this.c50.setTransform(454,106.5,1,1,0,0,0,50,25);

                this.c44 = new lib.wrongcard();
                this.c44.parent = this;
                this.c44.setTransform(3.1,353.5,1,1,0,0,0,50,25);

                this.c10 = new lib.wrongcard();
                this.c10.parent = this;
                this.c10.setTransform(76.1,235.5,1,1,0,0,0,50,25);

                this.c30 = new lib.wrongcard();
                this.c30.parent = this;
                this.c30.setTransform(355,125,1,1,0,0,0,50,25);

                this.c46 = new lib.wrongcard();
                this.c46.parent = this;
                this.c46.setTransform(32.1,210.5,1,1,0,0,0,50,25);

                this.c52 = new lib.wrongcard();
                this.c52.parent = this;
                this.c52.setTransform(-38.9,65.5,1,1,0,0,0,50,25);

                this.c18 = new lib.wrongcard();
                this.c18.parent = this;
                this.c18.setTransform(309,225,1,1,0,0,0,50,25);

                this.c21 = new lib.wrongcard();
                this.c21.parent = this;
                this.c21.setTransform(409,319.5,1,1,0,0,0,50,25);

                this.c11 = new lib.wrongcard();
                this.c11.parent = this;
                this.c11.setTransform(569,319.5,1,1,0,0,0,50,25);

                this.c7 = new lib.wrongcard();
                this.c7.parent = this;
                this.c7.setTransform(613,396.5,1,1,0,0,0,50,25);

                this.c12 = new lib.wrongcard();
                this.c12.parent = this;
                this.c12.setTransform(176.1,215.5,1,1,0,0,0,50,25);

                this.c15 = new lib.wrongcard();
                this.c15.parent = this;
                this.c15.setTransform(265,391.5,1,1,0,0,0,50,25);

                this.c1 = new lib.wrongcard();
                this.c1.parent = this;
                this.c1.setTransform(309,210.5,1,1,0,0,0,50,25);

                this.c14 = new lib.wrongcard();
                this.c14.parent = this;
                this.c14.setTransform(226,242.5,1,1,0,0,0,50,25);

                this.c3 = new lib.wrongcard();
                this.c3.parent = this;
                this.c3.setTransform(88.1,285.5,1,1,0,0,0,50,25);

                this.c6 = new lib.wrongcard();
                this.c6.parent = this;
                this.c6.setTransform(-34.9,260.5,1,1,0,0,0,50,25);

                this.c22 = new lib.wrongcard();
                this.c22.parent = this;
                this.c22.setTransform(105,269.5,1,1,0,0,0,50,25);

                this.c19 = new lib.wrongcard();
                this.c19.parent = this;
                this.c19.setTransform(330,303.5,1,1,0,0,0,50,25);

                this.c4 = new lib.wrongcard();
                this.c4.parent = this;
                this.c4.setTransform(182.1,269.5,1,1,0,0,0,50,25);

                this.c2 = new lib.wrongcard();
                this.c2.parent = this;
                this.c2.setTransform(176.1,285.5,1,1,0,0,0,50,25);

                this.shape_15 = new cjs.Shape();
                this.shape_15.graphics.f("#8C704B").s().p("AoCffMAAAg+9IQFAAMAAAA+9g");
                this.shape_15.setTransform(751.5,201.5);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.shape_15},{t:this.c2},{t:this.c4},{t:this.c19},{t:this.c22},{t:this.c6},{t:this.c3},{t:this.c14},{t:this.c1},{t:this.c15},{t:this.c12},{t:this.c7},{t:this.c11},{t:this.c21},{t:this.c18},{t:this.c52},{t:this.c46},{t:this.c30},{t:this.c10},{t:this.c44},{t:this.c50},{t:this.c51},{t:this.c33},{t:this.c27},{t:this.c24},{t:this.c23},{t:this.c20},{t:this.c34},{t:this.c26},{t:this.c32},{t:this.c49},{t:this.c53},{t:this.c48},{t:this.c47},{t:this.c43},{t:this.c45},{t:this.c42},{t:this.c37},{t:this.c41},{t:this.c40},{t:this.c39},{t:this.c38},{t:this.c36},{t:this.c35},{t:this.c31},{t:this.c29},{t:this.c28},{t:this.c25},{t:this.c16},{t:this.c17},{t:this.c13},{t:this.c8},{t:this.c9},{t:this.c5},{t:this.c55},{t:this.c54},{t:this.c56},{t:this.c57},{t:this.c58},{t:this.c59},{t:this.c60},{t:this.c61},{t:this.shape_14},{t:this.shape_13},{t:this.shape_12},{t:this.shape_11},{t:this.shape_10},{t:this.shape_9},{t:this.shape_8},{t:this.shape_7},{t:this.shape_6},{t:this.shape_5},{t:this.shape_4},{t:this.shape_3},{t:this.shape_2},{t:this.shape_1},{t:this.shape},{t:this.countdown},{t:this.score}]}).wait(1));

                // Layer 2
                this.r1 = new lib.rightcard();
                this.r1.parent = this;
                this.r1.setTransform(210,269.5,1,1,0,0,0,50,25);

                this.r3 = new lib.rightcard();
                this.r3.parent = this;
                this.r3.setTransform(512,189.5,1,1,0,0,0,50,25);

                this.r2 = new lib.rightcard();
                this.r2.parent = this;
                this.r2.setTransform(375.1,106.5,1,1,0,0,0,50,25);

                this.timeline.addTween(cjs.Tween.get({}).to({state:[{t:this.r2},{t:this.r3},{t:this.r1}]}).wait(1));

                // Layer 3
                this.instance = new lib.brownwoodentexturedflooringbackground();
                this.instance.parent = this;
                this.instance.setTransform(0,0,0.14,0.12);

                this.timeline.addTween(cjs.Tween.get(this.instance).wait(1));

            }).prototype = p = new cjs.MovieClip();
            p.nominalBounds = new cjs.Rectangle(310.6,181,929.5,441);
// library properties:
            lib.properties = {
                width: 800,
                height: 400,
                fps: 24,
                color: "#FFFFFF",
                opacity: 1.00,
                manifest: [
                    {src:"images/brownwoodentexturedflooringbackground.jpg?1648912205353", id:"brownwoodentexturedflooringbackground"}
                ],
                preloads: []
            };




        })(lib = lib||{}, images = images||{}, createjs = createjs||{}, ss = ss||{}, AdobeAn = AdobeAn||{});
        var lib, images, createjs, ss, AdobeAn;
    </script>
    <!-- Template Main CSS File -->
</head>
<script>
    function verifiermodifier(){
        var ok=true;
        let x=document.getElementById('confir').value;
        let y=document.getElementById('config').innerHTML;
        if(x!=y)
        {
            document.getElementById("remarque").innerHTML="<h6 style='color:red;font-size:9pt'>le code est incorrect!</h6>";
            ok=false;
        }
        return ok;
    }




</script>
<body onload="init();" >

<nav class="sticky-top">
    <div  class="logo"><a href="index.php"><img src="im\Good_Travel-removebg-preview.png" height="75px" width="180px" style="padding-bottom: 12px;"></a></div>
    <label for="" class="menu-btn" id="menu">
        <i class="bi bi-list" style="color:  #a11717e8;"></i>
    </label>
    <ul>
        <li><a class="nav-item"  style="text-decoration: none;" class="active" href="#">Home</a></li>
        <li><a class="nav-item" style="text-decoration: none;" href="#booking">Booking</a></li>
        <li><a class="nav-item" style="text-decoration: none;" href="#packages">Package</a></li>
        <li><a class="nav-item" style="text-decoration: none;" href="#gallery">Gallery</a></li>
        <li><a class="nav-item" style="text-decoration: none;" href="#contact">Contact</a></li>
    </ul>
    <?php
    if(empty($user)){
        ?>
        <a class="nav-item" id="login1"  data-toggle="modal" data-target="#lo">Login</a>
        <?php
    }
    else{
        ?>
        <div class="dropdown" style="liste-style:none;margin-top:-10px;font-size: 17px;font-weight: 600;letter-spacing: 1px;">
            <a class="dropdown-toggle"  style="text-decoration: none;color: #263238;font-size: 17px;font-weight: 600;letter-spacing: 1px;" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$user; ?></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a><img src="<?=$profilepicture; ?>" width="50px" height="50px" style="border-radius:50%;border:1px solid black;margin-left:31%"></a>
                <a class="dropdown-item" style="color:black;text-align:center" href=""  data-toggle="modal" data-target="#edit">Settings</a>
                <a class="dropdown-item" style="color:black;text-align:center" href="" data-toggle="modal" data-target="#archive">Archive</a>
                <?php
                if($admin==1){
                    ?>
                    <a class="dropdown-item" style="color:black;text-align:center" href="adminCrud.php" >Admin Mode</a>
                    <?php
                }
                ?>
                <a class="dropdown-item" style="color:black;text-align:center" href="logout.php">Log OUT</a>
            </div>
        </div>
        <?php
    }
    ?>
</nav>
<div class="container container1" id="header">
    <div class="row justify-content-between">
        <div class="col-sm-12 col-lg-6  order-2 order-lg-1 d-flex align-items-center">
            <div  data-aos="zoom-out">
                <div class="content">
                    <h1>Good Travel</h1>
                    <h3>I plan my trips in advance and I take advantage of the best rates...</h3>
                    <h5>Train,Buse Or Flight Everything you need and more...</h5>
                    <a href="#booking"><button>book now</button></a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-lg-6 order-1 order-lg-2 mx-auto"  >
            <div class="mx-auto images">
                <img  src="im/bg.gif" alt="">
                <img src="im/plane1.png" class="plane" alt="">
            </div>
        </div>
    </div>
</div>
<div id="booking" style="height: 100px;"></div>
<div class="container" data-aos="fade-up" data-aos-delay="200">
    <form class="main-form">
        <h3>Find Your Tour</h3>
        <div class="row mx-auto">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label >Comming From ?</label>
                        <br>
                        <input class="form-control" id="location" value="<?=$city?>" type="text" name="example" list="depart" placeholder="Your Depart..." >
                        <datalist id="depart">
                        </datalist>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label style="position: relative;">Going To ?</label>
                        <div id="sugg" class="sugg" style="position: absolute;top: 0;left: 1;background-color: rgba(235, 225, 225);padding: 5px;cursor: pointer;" hidden="hidden">You Don't Decided Yet ?</div>
                        <br>
                        <input class="form-control" id="destinp" type="text" name="example" list="destination" placeholder="Your Destination..." >
                        <datalist id="destination">
                        </datalist>
                    </div>

                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label >Date Of Depart</label>
                        <input class="form-control" id="date" type="date" name="Any">
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">
                        <label >Way Of Travel</label>
                        <select id="way" class="form-control" name="Any">
                            <option value="" disabled selected hidden>Feel Free...</option>
                            <option>Flight</option>
                            <option>Train</option>
                            <option>Bus</option>
                        </select>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-6 col-12">
                        <a style="cursor:pointer" data-toggle="modal"  id="search"><i class="bi bi-search"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div id="serchremarque"></div>
    </form>
</div>
<br>
<br>
<!-- ======= Services Section ======= -->
<section id="services" class="services">
    <div class="container mx-auto" data-aos="fade-up">

        <div class="section-title">
            <h2>Our Services</h2>
            <p>Dear adventures,you would like to take a look about our services.</p>
        </div>

        <div class="row mx-auto">

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch " data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box iconbox-blue">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,521.0016835830174C376.1290562159157,517.8887921683347,466.0731472004068,529.7835943286574,510.70327084640275,468.03025145048787C554.3714126377745,407.6079735673963,508.03601936045806,328.9844924480964,491.2728898941984,256.3432110539036C474.5976632858925,184.082847569629,479.9380746630129,96.60480741107993,416.23090153303,58.64404602377083C348.86323505073057,18.502131276798302,261.93793281208167,40.57373210992963,193.5410806939664,78.93577620505333C130.42746243093433,114.334589627462,98.30271207620316,179.96522072025542,76.75703585869454,249.04625023123273C51.97151888228291,328.5150500222984,13.704378332031375,421.85034740162234,66.52175969318436,486.19268352777647C119.04800174914682,550.1803526380478,217.28368757567262,524.383925680826,300,521.0016835830174"></path>
                        </svg>
                        <i class="bi bi-bicycle"></i>
                    </div>
                    <h4><a href="">Distraction</a></h4>
                    <p>Our all transportation have Ipads to keep you occupied during your journey. </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box iconbox-orange ">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                        </svg>
                        <i class="bi bi-egg-fried"></i>      </div>
                    <h4><a href="">Healthy Food</a></h4>
                    <p>We Don't miss anything to keep you amused dear client</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box iconbox-pink">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,541.5067337569781C382.14930387511276,545.0595476570109,479.8736841581634,548.3450877840088,526.4010558755058,480.5488172755941C571.5218469581645,414.80211281144784,517.5187510058486,332.0715597781072,496.52539010469104,255.14436215662573C477.37192572678356,184.95920475031193,473.57363656557914,105.61284051026155,413.0603344069578,65.22779650032875C343.27470386102294,18.654635553484475,251.2091493199835,5.337323636656869,175.0934190732945,40.62881213300186C97.87086631185822,76.43348514350839,51.98124368387456,156.15599469081315,36.44837278890362,239.84606092416172C21.716077023791087,319.22268207091537,43.775223500013084,401.1760424656574,96.891909868211,461.97329694683043C147.22146801428983,519.5804099606455,223.5754009179313,538.201503339737,300,541.5067337569781"></path>
                        </svg>
                        <i class="bi bi-calendar-week"></i>      </div>
                    <h4><a href="">Time Management</a></h4>
                    <p>We make sure to arrive at your destination in a less time.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="icon-box iconbox-yellow">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                        </svg>
                        <i class="bi bi-dribbble"></i>
                    </div>
                    <h4><a href="">Luxurious Treatment</a></h4>
                    <p>We use only comfortable transportation and All our vehicles have air conditioning.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="200">
                <div class="icon-box iconbox-red">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,532.3542879108572C369.38199826031484,532.3153073249985,429.10787420159085,491.63046689027357,474.5244479745417,439.17860296908856C522.8885846962883,383.3225815378663,569.1668002868075,314.3205725914397,550.7432151929288,242.7694973846089C532.6665558377875,172.5657663291529,456.2379748765914,142.6223662098291,390.3689995646985,112.34683881706744C326.66090330228417,83.06452184765237,258.84405631176094,53.51806209861945,193.32584062364296,78.48882559362697C121.61183558270385,105.82097193414197,62.805066853699245,167.19869350419734,48.57481801355237,242.6138429142374C34.843463184063346,315.3850353017275,76.69343916112496,383.4422959591041,125.22947124332185,439.3748458443577C170.7312796277747,491.8107796887764,230.57421082200815,532.3932930995766,300,532.3542879108572"></path>
                        </svg>
                        <i class="bi bi-shield-check"></i>

                    </div>
                    <h4><a href="">Security</a></h4>
                    <p>With us, you will have a safe travel experience during your travel.</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="zoom-in" data-aos-delay="300">
                <div class="icon-box iconbox-teal">
                    <div class="icon">
                        <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,566.797414625762C385.7384707136149,576.1784315230908,478.7894351017131,552.8928747891023,531.9192734346935,484.94944893311C584.6109503024035,417.5663521118492,582.489472248146,322.67544863468447,553.9536738515405,242.03673114598146C529.1557734026468,171.96086150256528,465.24506316201064,127.66468636344209,395.9583748389544,100.7403814666027C334.2173773831606,76.7482773500951,269.4350130405921,84.62216499799875,207.1952322260088,107.2889140133804C132.92018162631612,134.33871894543012,41.79353780512637,160.00259165414826,22.644507872594943,236.69541883565114C3.319112789854554,314.0945973066697,72.72355303640163,379.243833228382,124.04198916343866,440.3218312028393C172.9286146004772,498.5055451809895,224.45579914871206,558.5317968840102,300,566.797414625762"></path>
                        </svg>
                        <i class="bi bi-bank"></i>

                    </div>
                    <h4><a href="">Destination</a></h4>
                    <p>We only hire experienced and licensed drivers for your tour.</p>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Services Section -->
<br>
<br>
<!-- ======= histoire Section ======= -->
<section id="histoire" style="background: #fff;" class="histoire">
    <div class="container">
        <div class="section-title" data-aos="fade-up">
            <h2>Our Packages</h2>
            <p>Our Specials Tours</p>
        </div>
        <select id="packages" style="padding:8px">
            <option value="1">Students Package</option>
            <option value="2">Families Package</option>
            <option value="3">OnePerson Package</option>
        </select>
        <br>
        <br>
        <div id="result">
            <?php
            Traitement::ShowToursByCateg("1");
            ?>
        </div>


    </div>
</section><!-- End  Section -->
<br>
<br>
<!--hna ba9i khas tji l package hta n3amro database-->
<!--Gallery-->
<section id="gallery" class="gallery section-bg" data-aos="fade-up" data-aos-delay="200">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Our Gallery</h2>
            <p> A lot of people don't see the beauty of Morocco city and there is where our role came to make sure you see the beauty. In fact it is our mission is to make your take you there. Morcco has a lot of magical places.</p>
        </div>

        <div class="row gallery-container" data-aos="fade-up" data-aos-delay="200">

            <div class="col-lg-4 col-md-6 gallery-item filter-app">
                <div class="gallery-wrap">
                    <img src="im\casa2.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Casablanca</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-web">
                <div class="gallery-wrap">
                    <img src="im/chefchaouen.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Chefchaouen</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-app">
                <div class="gallery-wrap">
                    <img src="im/Volubilis.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Valubilis (Meknes)</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-card">
                <div class="gallery-wrap">
                    <img src="im/Rug-960x636-1.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Ouarzazate & Ait Benhaddou Kasbah</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-web">
                <div class="gallery-wrap">
                    <img src="im/mknes1.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Meknes</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-app">
                <div class="gallery-wrap">
                    <img src="im/agadir.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Agadir</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-card">
                <div class="gallery-wrap">
                    <img src="im/sahara.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Merzouga & Erg Chebbi dunes</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-card">
                <div class="gallery-wrap">
                    <img src="im/todgha.jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Toudra Gorges</p>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 gallery-item filter-web">
                <div class="gallery-wrap">
                    <img src="im/fes..jpg" class="img-fluid" alt="">
                    <div class="gallery-info">
                        <h4>Place</h4>
                        <p>Fes</p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<?php
if($user!=""){
    $hascouponornot=UsersManager::hasacouponornot($user);
    if($hascouponornot==false){
        ?>
        <br>
        <center>
            <div id="animation_container" style="background-color:rgba(255, 255, 255, 1.00); width:800px; height:400px;box-shadow:10px 10px 10px">
                <canvas id="canvas" width="800" height="400" style="position: absolute; display: block; background-color:rgba(255, 255, 255, 1.00);"></canvas>
                <div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:800px; height:400px; position: absolute; left: 0px; top: 0px; display: block;">
                </div>
            </div>
        </center>
        <br>
        <?php
    }
}
else{
    ?>
    <br>
    <center>
        <div id="animation_container" style="background-color:rgba(255, 255, 255, 1.00); width:800px; height:400px">
            <canvas id="canvas" width="800" height="400" style="position: absolute; display: block; background-color:rgba(255, 255, 255, 1.00);"></canvas>
            <div id="dom_overlay_container" style="pointer-events:none; overflow:hidden; width:800px; height:400px; position: absolute; left: 0px; top: 0px; display: block;">
            </div>
        </div>
    </center>
    <br>
    <?php
}
?>

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact" data-aos="fade-up" data-aos-delay="200">
    <div class="container">

        <div class="section-title">
            <h2>Contact</h2>
            <p>Contact Us</p>
        </div>

        <div class="row mt-2">

            <div class="col-md-6 mt-4 d-flex align-items-stretch">
                <div class="info-box">
                    <i class="bx bx-envelope"></i>
                    <h3>Email Us</h3>
                    <p>goodtravel@gmail.com</p>
                </div>
            </div>
            <div class="col-md-6 mt-4 d-flex align-items-stretch">
                <div class="info-box">
                    <i class="bx bx-phone-call"></i>
                    <h3>Call Us</h3>
                    <p>+212 06-88683466</p>
                </div>
            </div>
        </div>
        <form class="php-email-form mt-4">
            <div class="row">
                <div class="col-md-6 form-group">
                    <input type="text" id="na" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                    <input type="email" id="g" class="form-control" name="email" id="email" placeholder="Your Email" pattern=".+@gmail.com" required>
                </div>
            </div>
            <div class="form-group mt-3">
                <input type="text" id="sub" class="form-control" name="subject" id="subject" placeholder="Subject" required>
            </div>
            <div class="form-group mt-3">
                <textarea id="mess" class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
            </div>
            <div id="msgremarque"></div>
            <div class="text-center"><button id="send" type="button" style="border: 0;padding: 8px;border-radius: 5px;color: white;background-color: #BC1616">Send Message</button></div>
        </form>
    </div>
</section><!-- End Contact Section -->
<br>
<br>
<footer id="footer">
    <div class="container">
        <h3></h3>
        <p></p>
        <div class="social-links">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
        <div class="copyright">
            All Rights Reserved
        </div>

    </div>
</footer><!-- End Footer -->
<div class="modal fade" id="lo">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="i" hidden="hidden"></div>
                <div class="user-modal">
                    <div class="user-modal-container">
                        <ul class="switcher" style="width:93%">
                            <a id="log" class="checked"><li >Log In</li></a>
                            <a id="sign"><li>Sign In</li></a>
                        </ul>

                        <div id="login" >
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace email" for="signin-email">UserName</label>
                                    <input class="full-width has-padding has-border" id="use" type="text" value="<?=$username; ?>" placeholder="UserName" required>

                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signin-password">Password</label>
                                    <input class="full-width has-padding has-border" id="pass"  type="password" value="<?=$password; ?>"  placeholder="Password" required>

                                </p>

                                <p class="fieldset">
                                    <input type="checkbox" id="remember" checked>
                                    <label for="remember-me">Remember me</label>
                                </p>
                                <div id="remarquelogin"></div>
                                <p class="fieldset">
                                    <input  class="full-width" style=" padding: 16px 0;cursor: pointer;background: #d83d3d;color: #FFF;font-weight: bold;border: none;" type="button" id="cnx" value="Login">
                                </p>
                            </form>

                        </div>

                        <div id="signup" hidden="hidden">
                            <form class="form">
                                <p class="fieldset">
                                    <label class="image-replace username" for="signup-username">Username</label>
                                    <input class="full-width has-padding has-border" id="n-user" type="text" placeholder="Username" required>

                                </p>

                                <p class="fieldset">
                                    <label class="image-replace email" for="signup-email">E-mail</label>
                                    <input class="full-width has-padding has-border" id="mail"  type="email" placeholder="E-mail"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" required>

                                </p>

                                <p class="fieldset">
                                    <input class="full-width has-padding has-border" id="birth" placeholder="Birthday"  type="text" style="position:relative"  required><i class="bi bi-alarm" style="color:rgb(168, 164, 164,0.5);position:absolute;bottom:14px;left:14px"></i>

                                </p>

                                <p class="fieldset">
                                    <label class="image-replace password" for="signup-password">Password</label>
                                    <input class="full-width has-padding has-border" id="pas"  type="password"  placeholder="Password" required>

                                </p>
                                <p class="fieldset">
                                    <label class="image-replace password" for="signup-password">Password Confirmation</label>
                                    <input class="full-width has-padding has-border" id="pasconf"  type="password"  placeholder="Password Confirmation" required>

                                </p>
                                <p class="fieldset">
                                    <input type="checkbox" id="publicitaire" checked>
                                    <label >M'envoyez des annonces de nouveau disponible tours</label>
                                </p>
                                <div id="remarquesignup"></div>
                                <p class="fieldset">
                                    <input class="full-width has-padding" style=" padding: 16px 0;cursor: pointer;background: #d83d3d;color: #FFF;font-weight: bold;border: none;" type="button" id="newacc" value="Create account">
                                </p>
                            </form>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="echarpeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tour Details</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="r"></div>
            </div>
        </div>
    </div>
</div>

<div id="travelsearch" class="modal fade" >
    <div class="modal-dialog" style="max-width:60%">
        <div class="modal-content" >
            <div class="modal-header">
                Search Result
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="r1"></div>
            </div>
        </div>
    </div>
</div>
<div id="walo" hidden="hidden"></div>


<div class="modal fade" id="edit"  >
    <div class="modal-dialog" >
        <div class="modal-content" >
            <div class="modal-body" >
                <form action="index.php" method="POST" enctype="multipart/form-data" onsubmit="return verifiermodifier()">
                    <div class="form-group mt-3">
                        <input type="file" class="form-control"  id="chosefile"   rows="5"  name="im" hidden="hidden"/>
                    </div>
                    <div class="form-group mt-3" style="display:flex">
                        <input  type="text" readonly name="chemaine" id="m5" value="<?=$profilepicture;?>" hidden="hidden" >
                    </div>
                    <br>
                    <img src="<?=$profilepicture;?>" width="100px" height="100px" id="fake" style="margin-left:40%;cursor:pointer;border-radius:100%;border:3px solid #BC1616">
                    <br>
                    <br>
                    <br>
                    <div class="form-group offset-1 row">
                        <label  class="col-sm-4 col-form-label">Utilisateur</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" name="u"  value="<?=$user;?>" placeholder="Password" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group offset-1 row">
                        <label  class="col-sm-4 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <input type="email" class="form-control" style="font-size:14px" value="<?=$email;?>" name="e" placeholder="Email" required>
                        </div>
                    </div>
                    <br>
                    <div class="form-group offset-1 row">
                        <label  class="col-sm-4 col-form-label">Mot De Passe</label>
                        <div class="col-sm-7">
                            <input type="text" class="form-control" value="<?=$pass;?>" placeholder="Password" name="p" required>
                        </div>
                    </div>
                    <br>
                    <br>
                    <div class="form-group offset-2 row">
                        <div class="col-sm-10">
                            <input type="text" id="confir" class="form-control" style="text-align:center" name="conf"    placeholder="Confirmer avec Le code ci dessus" required>
                        </div>
                    </div>
                    <br>
                    <div class="text-center" id="config" style="color:red;"><?=$randomString;?></div>
                    <br>
                    <div id="remarque" class="text-center"></div>
                    <br>
            </div>
            <div class="modal-footer mx-auto" >
                <input class="btn btn-primary" type="submit" style="background-color:#BC1616;border:0" value="Modifier" name="modi">

                </form>
                <button class="btn btn-secondary"  id="dimiss">Fermer</button>
                <script>
                    const b=document.getElementById("dimiss");
                    b.addEventListener("click",function(){
                        window.location="index.php";
                    });
                    const real=document.getElementById("chosefile");
                    const fake=document.getElementById("fake");
                    const chem=document.getElementById("m5");


                    fake.addEventListener("click",function(){
                        real.click();
                    });
                    real.addEventListener("change",function(){
                        if(real.value){
                            chem.value=real.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                            const im=this.files[0];
                            if(im){
                                const reader=new FileReader();
                                reader.addEventListener("load",function(){
                                    fake.setAttribute('src',reader.result);
                                });
                                reader.readAsDataURL(im);
                            }
                        }
                    });
                </script>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="archive">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Reservation's Archive</h5>
                <button class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $r=Traitement::getreservationsbyUser($user);
                ?>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<script >
    $(function(){

        $('#login1').click(function(){
            $('#i').html("");
        })

        $('#birth').focus(function(){
            $(this).attr('type', 'date');
        })

        $('#log').click(function(){
            $('#log').addClass('checked');
            $('#sign').removeClass('checked');
            $('#login').removeAttr('hidden');
            $('#signup').attr('hidden','hidden');

        })

        $('#sign').click(function(){
            $('#sign').addClass('checked');
            $('#log').removeClass('checked');
            $('#signup').removeAttr('hidden');
            $('#login').attr('hidden','hidden');
        })

        $('#sugg').click(function(){
            window.location="map.php"
        })


        $(document).ready(function(){

            $('img').mouseover(function(e){

                var x= e.pageX/6;
                var y =e.pageY/6;
                $('.plane').css({'top':-y,'left':-x});


            });
            $('img').mouseleave(function(e){
                $('.plane').css({'top':0,'left':-10});
            });

        });



        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        // or instead:
        // var maxDate = dtToday.toISOString().substr(0, 10);

        $('#date').attr('min', maxDate);
        $('#birth').attr('max',maxDate);

        $.ajax({
            type: "GET",
            url: "moroccocities.json",
            data: 'ok=ok',
            dataType: 'json'
        }).done(function(data){
            for(var i in data){
                $('#depart').append("<option value='"+data[i].city+"'>");
                $('#destination').append("<option value='"+data[i].city+"'>");


            }

        })
    })
    var x=0;
    $('.nav-item').click(function(){
        document.querySelector("nav ul").style.left="-100%";
        x=0;
    })
    document.getElementById("menu").addEventListener("click",function(){
        if(x==0){
            document.querySelector("nav ul").style.left=0;
            x=1;
        }
        else{
            document.querySelector("nav ul").style.left="-100%";
            x=0;
        }
    })

    $('#destinp').focus(function(){
        $('#sugg').removeAttr('hidden');
    })


    $('#packages').change(function(){
        var type=$('#packages').val();
        $.ajax({
            type: "POST",
            url: "packagesfilter.php",
            data: 'cate='+type
        }).done(function(res){
            $('#result').html(res);
        })

    })


    $('.details').click(function(e){
        var tourid=$(this).attr('id');
        $.ajax({
            type: "POST",
            url: "toursdetails.php",
            data: 'tourid='+tourid
        }).done(function(res){
            $('#r').html(res);
        })
    })


    $('#cnx').click(function(){
        var username=$('#use').val();
        var password=$('#pass').val();
        var id=$('#i').html();
        var x=0;
        if($('#remember').is(':checked')){
            x=1;
        }
        if(username=="" || password==""){
            $('#remarquelogin').html("<h6 style='color:red;font-size:12pt' align='center'>tout les champs sont obligatoires!</h6>");
        }
        else{
            $.ajax({
                type: "POST",
                url: "login.php",
                data: 'username='+username+'&password='+password+'&remember='+x+'&id='+id
            }).done(function(res){
                $('#remarquelogin').html(res);
            })
        }


    })

    $('#newacc').click(function(){
        var username=$('#n-user').val();
        var email=$('#mail').val();
        var birthday=$('#birth').val();
        var password=$('#pas').val();
        var passwordconf=$('#pasconf').val();
        var isChecked="";
        if($('#publicitaire').prop('checked')){
            isChecked=true;
        }

        if(username=="" || password=="" || email=="" || birthday=="" || passwordconf==""){
            $('#remarquesignup').html("<h6 style='color:red;font-size:12pt' align='center'>All fields are necessary!</h6>");
        }
        else{
            $.ajax({
                type: "POST",
                url: "signup.php",
                data: 'username='+username+'&password='+password+'&email='+email+'&birthday='+birthday+'&passwordconf='+passwordconf+'&isChecked='+isChecked
            }).done(function(res){
                $('#remarquesignup').html(res);
            })
        }

    })

    $('#search').click(function(){
        var curlocation=$('#location').val();
        var dstination=$('#destinp').val();
        var tdate=$('#date').val();
        var way=$('#way').val();

        if(curlocation=="" || dstination=="" || tdate=="" || way==""){
            $('#serchremarque').html("<span style='color:white'>vous devez remplir tout les champs!");
        }
        else{
            $(this).attr('data-target','#travelsearch');
            $('#serchremarque').html("");
            $.ajax({
                type: "POST",
                url: "searchTravel.php",
                data: 'curlocation='+curlocation+'&destination='+dstination+'&date='+tdate+'&way='+way
            }).done(function(res){
                $('#r1').html(res);
            })
        }

    })


    $('#send').click(function(){
        var name=$('#na').val();
        var gmail=$('#g').val();
        var subject=$('#sub').val();
        var message=$('#mess').val();
        var emailPattern = /.+@gmail.com/;
        var r=emailPattern.test(gmail);
        if(name=="" || gmail=="" || subject=="" || message==""){
            $('#msgremarque').html("<h6 style='font-size:12pt' align='center'><br>vous devez remplir tout les champs!</h6>");
        }
        if(!r){
            $('#msgremarque').html("<h6 style='font-size:12pt' align='center'><br>vous devez respecter la forme de gmail!</h6>");
        }
        else{
            $('#msgremarque').html("");
            $.ajax({
                type: "POST",
                url: "sendemail.php",
                data: 'name='+name+'&gmail='+gmail+'&subject='+subject+'&message='+message+'&user='+'<?=$user?>'
            }).done(function(res){
                $('#msgremarque').html(res);
            })
        }
    })


    /* hada de animation */







</script>
</body>
</html>