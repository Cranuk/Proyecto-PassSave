<?php

class errorControlador{

    public function enviarError(){
        echo "  <div class='alerta-error sin-pagina'>
                    <i class='bx bx-window-close icono-mediano' style='color: #eae2b7'></i>
                    <br>
                    La pagina que busca no existe
                </div>";
    }
}

?>