<?php
/*
 Generador de plantillas de codigo de php... en php
*/
//$OUT = <<<HEREDOC
//HERE	DOC;
$AR = ''; //inicializar para no confundir con array
// PARAMETROS

$HOST = "localhost";
$USER = "test";
$PASS = "testing";
$DB   = "sistema1";

/* GENERADOR DE FUNCIONES MYSQL */

$FUNC = array (
    array( 'tipo' => 'selectall', 'funcnom' => 'selec', 'tabla' => 'tor'),
    array( 'tipo' => 'selectall', 'funcnom' => 'seleccion', 'tabla' => 'copy')
);

/* PROCESAR ARRAY DE FUNCIONES */

foreach ( $FUNC as $bloque )
{
    switch ($bloque['tipo'])
    {
        case 'selectall':
            $AR=$AR.'
function '.$bloque["funcnom"].'()
{
    $linkConexion = conexion();
    return $linkConexion->query("SELECT * FROM '.$bloque["tabla"].'")->fetch_assoc();
}
';
            break;
    }
}

/* SALIDA */
echo '<?php
/*
    GENERADOR CON GENCOD
*/
function conexion()
{
        $servername = "'.$HOST.'";
        $username   = "'.$USER.'";
        $password   = "'.$PASS.'";
        $dbselected = "'.$DB.'";

        $connection = new mysqli($servername, $username, $password);
        if ($connection->connect_error) {
            die(\'<h1 class="failed">Connection failed: \' . $connection->connect_error). \'</h1>\';
        }
        mysqli_select_db($connection,$dbselected);
        return $connection;
}
'.$AR.'
?>';?>
