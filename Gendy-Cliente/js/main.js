let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById("abrir");
let cerrar = document.getElementById("close");


abrir.addEventListener('click', function(){
    modal.style.display = "block";
});

cerrar.addEventListener('click', function(){
    modal.style.display='none';
});


/*
            <div id="miMidodal" class="modal">
                <div class="flex"id="flex">
                    <div class="contenido-modal">
                            <div class="modal-header flex">
                                <h2>Ingrese datos</h2>
                                <span class="close" id="close">&times;</span>
                            </div>
                            <div class="modal-body">
                                <p>
                                    
                                Los desastres y amenazas pueden incluir a todas las ramas del saber, en las que así sea un pequeño aporte, podrían ayudar a salvar vidas y a prevenir las pérdidas materiales de gran escala. Si bien la ingeniería de sistemas no será la rama del saber que va a levantar las piedras en caso de un derrumbe, si podrá ayudar a implementar diversas opciones para la prevención de los desastres, para la difusión de la información en caso de una inminente catástrofe, o generar algoritmos para intentar predecir de acuerdo con la información que se tenga donde hay mayor probabilidad de encontrar a alguien con vida luego de una catástrofe.

                                </p>
                            </div>
                            <div class="footer">
                                <h3>&copy; Gendy Inc</h3>
                            </div>
                    </div>
                </div>
            </div>

            <script src="js/main.js"></script> 
*/

