<? header("Content-Type: text/html; charset=windows-1251"); ?>
<!DOCTYPE HTML>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=windows-1251">
        <script src="/js/view3d/three.js"></script>
        <script src="/js/view3d/Detector.js"></script>
        <script src="/js/view3d/OrbitControls.js"></script>
        <script src="/js/view3d/OBJLoader.js"></script>
        <script src="/js/view3d/MTLLoader.js"></script>
        <style>
            html,body{background: #1a1a1a;}
            /* canvas{position: relative;background: #333;position: 2;}*/
        </style>
    </head>
    <body onload="loadPage()">
        <div id="downloading" style="position: absolute;z-index: 1;left: 45%;top:40%; font-size: 20px;color: #fff;opacity: 0.3;font-family: Arial;">Объект загружается...</div>
        <script>

            if (!Detector.webgl) {
                Detector.addGetWebGLMessage();
            }

            var container;

            var camera, controls, scene, renderer;
            var lighting, ambient, keyLight, fillLight, backLight;

            var windowHalfX = window.innerWidth / 2;
            var windowHalfY = window.innerHeight / 2;

            init();
            animate();


            function init() {

                container = document.createElement('div');
                document.body.appendChild(container);

                /* Camera */

                camera = new THREE.PerspectiveCamera(27, window.innerWidth / window.innerHeight, 2, 1000);
                camera.position.x = 1;
                camera.position.y = 1;
                camera.position.z = 1;

                /* Scene */

                scene = new THREE.Scene();
                lighting = false;

                ambient = new THREE.AmbientLight(0xffffff, 1.0);
                scene.add(ambient);

                keyLight = new THREE.DirectionalLight(new THREE.Color('hsl(30, 50%, 75%)'), 1.0);
                keyLight.position.set(-100, 0, 100);

                fillLight = new THREE.DirectionalLight(new THREE.Color('hsl(40, 100%, 75%)'), 0.75);
                fillLight.position.set(100, 0, 100);

                backLight = new THREE.DirectionalLight(0xffffff, 1.0);
                backLight.position.set(100, 0, -100).normalize();
//                backLight.position.set(110, 0, -110);

                /* Model */

                var mtlLoader = new THREE.MTLLoader();
                mtlLoader.setBaseUrl('/js/view3d/');
                mtlLoader.setPath('/js/view3d/');
                mtlLoader.load('untitled-scene.mtl', function (materials) {
                    materials.preload();

                    if (typeof materials.materials.default !== 'undefined') {
                        materials.materials.default.map.magFilter = THREE.NearestFilter;
                        materials.materials.default.map.minFilter = THREE.LinearFilter;
                    } else {
//                        materials.materials.default = materials.materials.Gray.clone();
                    }
                    console.log(materials.materials.default);
                    var objLoader = new THREE.OBJLoader();
                    objLoader.setMaterials(materials);
                    objLoader.setPath('/js/view3d/');
                    objLoader.load('untitled-scene.obj', function (object) {

                        scene.add(object);
                        //scene.overrideMaterial = new THREE.MeshLambertMaterial({color: 0xffffff});
                        document.getElementById("downloading").remove();
                    });
                });

                /* Renderer */

                renderer = new THREE.WebGLRenderer();
                renderer.setPixelRatio(window.devicePixelRatio);
                renderer.setSize(window.innerWidth * 0.98, window.innerHeight * 0.98);
                renderer.setClearColor(new THREE.Color("hsl(0, 0%, 10%)"));

                container.appendChild(renderer.domElement);

                /* Controls */

                controls = new THREE.OrbitControls(camera, renderer.domElement);
                controls.enableDamping = true;
                controls.dampingFactor = 0.25;
                controls.enableZoom = true;

                /* Events */

                window.addEventListener('resize', onWindowResize, false);
                window.addEventListener('keydown', onKeyboardEvent, false);

            }

            function onWindowResize() {

                windowHalfX = window.innerWidth / 2;
                windowHalfY = window.innerHeight / 2;

                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();

                renderer.setSize(window.innerWidth * 0.99, window.innerHeight * 0.99);

            }

            function onKeyboardEvent(e) {

                if (e.code === 'KeyL') {

                    lighting = !lighting;

                    if (lighting) {

                        ambient.intensity = 0.25;
                        scene.add(keyLight);
                        scene.add(fillLight);
                        scene.add(backLight);

                    } else {

                        ambient.intensity = 1.0;
                        scene.remove(keyLight);
                        scene.remove(fillLight);
                        scene.remove(backLight);

                    }

                }

            }

            function animate() {

                requestAnimationFrame(animate);

                controls.update();

                render();

            }

            function render() {

                renderer.render(scene, camera);

            }
            function loadPage() {

            }

        </script>




    </body>
</html>

