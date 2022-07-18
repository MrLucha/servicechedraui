<?php
include ('simple_html_dom.php');
include ('conection.php');

require('Product.php');

//Iniciar conexion a la BD
$conexion= new Conection();
$mysqli=$conexion->connect();

//Se hace un arreglo para lista de objetos PRODUCTO
$lista_productos = array();

//Se hace la consulta a la BD de los productos con el ID de la tienda
$idTienda=5;
$query = $mysqli->query("SELECT * FROM list_items where id_list=".$idTienda);

//Se recorre cada uno de los resultados
foreach ($query as $q) {
    //Se crea un objeto PRODUCTO formado de la base de datos
    $producto = new Product();
    $producto->setIdList(intval($q['id_list']));
    $producto->setIdProduct(intval($q['id_product']));
    $producto->setPrice($q['price']);
    $producto->setLink($q['link']);
    //Se hace push al arreglo para agragar el producto
    array_push($lista_productos, $producto);
}

//Se hace un foreach para recorrer el array de PRODUCTOS
foreach ($lista_productos as $p) {
    //Se hace get link y get price
    $idList=$p->idList;
    $idProduct=$p->idProduct;
    $price=floatval($p->price);
    $link=$p->link;

    //Se hace el scrap con el link del producto
    $newPrice=floatval(scrapProducts($link));

    //Se evalua si el precio es diferente al de la BD
    if ($price!=$newPrice) {
        //Si es diferente, se ejecuta la funcion updatePrice
        updatePrice($newPrice,$idList,$idProduct);
    }else{
    }

    //Fin de un producto
}

//Se acaba el arreglo y acaba la tarea

//Cerrar conexion a la BD
$conexion->close();



function scrapProducts($link){
    //igualar url a link del objeto
    $url=$link;
    $html=file_get_html($url);

    $buscador = $html->find('script[type=application/ld+json]',0);
    if ($buscador!=null) {
        $script = ltrim($buscador, '<script type="application/ld+json">');
        $script = rtrim($script, '</script>');
        $obj = json_decode($script, true);
        $precio=$obj['offers']['lowPrice'];
        $eliminar = array("\t", "$", " ");
        $precio_producto = str_replace ( $eliminar, '', $precio);
    }
    return $precio_producto;
}

function updatePrice($newPrice,$idList,$idProduct){
    //Se hace la consulta para insertar price en list items de acuerdo 
    //al id del proudcto y id de tienda (falta crear query)
    //query
    $newPrice=number_format((float)$newPrice, 2, '.', '');
    $query="UPDATE list_items SET price=$newPrice WHERE  id_list=$idList AND id_product=$idProduct";
    try {
        $GLOBALS['mysqli']->query($query);
        echo("se ha actualizado el producto $idProduct correctamente");
        echo('<br>');
    } catch (\Throwable $th) {
        echo("error: $th");
    }
}

?>