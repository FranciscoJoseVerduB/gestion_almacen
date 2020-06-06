<?php

function setActive($ruta){
    return request()->routeIs($ruta) ? 'active': '';
}

function setSelectedCombobox($idEntidadInicial = 0, $idEntidadAComparar = 0){
    return $idEntidadInicial === $idEntidadAComparar? 'selected': '';
}