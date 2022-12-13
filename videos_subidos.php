<?php 

    require_once $_SERVER['DOCUMENT_ROOT'] . '/apis/api_reproductor/db.php';

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");    

    try {
        
        $db = new Db();
        $dbConn = $db->connect();
    
        $query = "  SELECT T1.*, T2.NOMBRE AS INMUEBLE
                    FROM CAT_VIDEOS_4F T1
                    INNER JOIN CAT_TIPO_INMUEBLE T2
                    ON T1.TIPO_INMUEBLE = T2.ID
                    ORDER BY T1.ID DESC";

        $stid = oci_parse($dbConn, $query);
        oci_execute($stid);

        $videos = [];

        while ($data = oci_fetch_array($stid, OCI_ASSOC)) {
            
            $data["PLAYERS"] = [];
            $videos [] = $data;

        }

        echo json_encode($videos);

    } catch (\Throwable $th) {
        //throw $th;
    }

?>