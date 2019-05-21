<?php


function reset_add_candidates()
{
    register_rest_route(
        'reset_add_candidates', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_add_candidat'
        )
    );
}

function reset_add_candidat($request_param)
{

    global $wpdb;
    $parameters = $request_param->get_params();

    $candidat = null;

    $candidat->FIO = $parameters['FIO'];

    if( !preg_match('/^[а-яa-z\s]{3,50}$/ui', $candidat->FIO , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"FIO incorrect"
        );


    }//if

    $candidat->city = $parameters['city'];

    if( !preg_match('/^[а-яa-z0-9\s]{3,50}$/ui', $candidat->city , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"City incorrect"
        );


    }//if

    $candidat->age = $parameters['age'];

    if( !preg_match('/^[0-9\s]{1,2}$/i', $candidat->age , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Age incorrect"
        );


    }//if

    $candidat->position = $parameters['position'];
    $candidat->langsEN = $parameters['langsEN'];
    $candidat->langsDE = $parameters['langsDE'];
    $candidat->experience = $parameters['experience'];
    $candidat->phone = $parameters['phone'];

    if( !preg_match('/^\+\d{2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/i', $candidat->phone , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Phone incorrect"
        );


    }//if

    $candidat->email = $parameters['email'];

    if( !preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i', $candidat->email , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Email incorrect"
        );

    }//if

    $candidat->websait = $parameters['websait'];
    $candidat->passport = $parameters['passport'];
    $candidat->about = $parameters['about'];

    $mobile = $parameters['mobile'];

    date_default_timezone_set('Europe/Minsk');
    $date = date('d/m/Y H:i:s ', time());

    $data = array(
        "FIO"=>$candidat->FIO,
        'city' =>$candidat->city,
        'age'=>$candidat->age,
        'positions'=>$candidat->position,
        'langsEN'=>$candidat->langsEN,
        'langsDE'=>$candidat->langsDE,
        'experience'=>$candidat->experience,
        'phone'=>$candidat->phone,
        'email'=>$candidat->email,
        'photo'=>null,
        'websait'=>$candidat->websait,
        'date'=>$date,
        'status_id'=>1,
        'description'=>"",
        'passport'=>$candidat->passport,
        'about'=>$candidat->about ,
    );


    $format = array( '%s', '%s', '%d', '%s','%s', '%s','%s','%s','%s','%s','%s', '%s','%d','%s','%s', '%s' );

    $text = $wpdb->insert( 'candidates', $data, $format );

    $idCand = $wpdb->insert_id;

    if($text!== 1){
        return array(
            'status'=>401,
            'massage'=>"Error add database",
        );
    }

    if($mobile == 1){

        $data = $parameters['photo'];

        if($data){
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                    return array(
                        'status'=>400,
                        'massage'=>"Type image no correct"
                    );
                };

                $data = base64_decode($data);

                if ($data === false) {
                    return array(
                        'status'=>400,
                        'massage'=>"Error decode image"
                    );
                }
            } else {
                return array(
                    'status'=>400,
                    'massage'=>"Type image incorrect  base64"
                );
            }

            $name = time() . "_$idCand";

            if( !file_exists("/home/rhscom/of-w.com/candidates/img")){
                mkdir("/home/rhscom/of-w.com/candidates/img");
            }//if

            mkdir("/home/rhscom/of-w.com/candidates/img/{$idCand}");

            $path = "/home/rhscom/of-w.com/candidates/img/{$idCand}/{$name}.{$type}";

            $resultImage = file_put_contents($path, $data);

            if($resultImage){
                $path = "/candidates/img/{$idCand}/{$name}.{$type}";

                $wpdb->update( 'candidates',
                    array( 'photo' => $path ),
                    array( 'id' => $idCand ),
                    array( '%s', '%d' ),
                    array( '%d' )
                );
            }
            else{
                return array(
                    'status'=>400,
                    'massage'=>"Error add img in directory"
                );
            }


        }//if data

    }//if mobile
    else{

        if( isset( $_FILES['photo'] ) ){

            $name =  $_FILES['photo']['name'];

            $name = time() . "_$name";

            if( !file_exists("/home/rhscom/of-w.com/candidates/img")){
                mkdir("/home/rhscom/of-w.com/candidates/img");
            }//if

            mkdir("/home/rhscom/of-w.com/candidates/img/{$idCand}");

            $path = "/home/rhscom/of-w.com/candidates/img/{$idCand}/{$name}";

            if( !move_uploaded_file($_FILES['photo']['tmp_name'] , $path) ){

                return array(
                    'status'=>400,
                    'massage'=>"Error add image in derictory"
                );

            }//if

            $path = "/candidates/img/{$idCand}/{$name}";

            $resultPut = $wpdb->update( 'candidates',
                array( 'photo' => $path ),
                array( 'id' => $idCand ),
                array( '%s', '%d' ),
                array( '%d' )
            );

            if(!$resultPut){
                return array(
                    'status'=>400,
                    'massage'=>"Error put path image in database"
                );
            }
        }//if
    }//else

    return array(
        'status'=>200,
        'massage'=>"Add candidate"
    );

}

//добавление кагдидата в базу smallForm
add_action('rest_api_init', 'reset_add_candidates_small');

function reset_add_candidates_small()
{
    register_rest_route(
        'reset_add_candidates_small', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_add_candidat_small'
        )
    );
}

function reset_add_candidat_small($request_param)
{

    global $wpdb;
    $parameters = $request_param->get_params();

    $candidat = null;

    $small = filter_var( $parameters['small'], FILTER_VALIDATE_INT);

    $candidat->FIO = $parameters['FIO'];

    if( !preg_match('/^[а-яa-z\s]{3,50}$/ui', $candidat->FIO , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"FIO incorrect"
        );


    }//if

    if($small !== 1) {
        $candidat->city = $parameters['city'];

        if (!preg_match('/^[а-яa-z0-9\s]{3,50}$/ui', $candidat->city, $matches)) {

            return array(
                'status' => 403,
                'massage' => "City incorrect"
            );


        }//if

        $candidat->age = $parameters['age'];

        if (!preg_match('/^[0-9\s]{1,2}$/i', $candidat->age, $matches)) {

            return array(
                'status' => 403,
                'massage' => "Age incorrect"
            );


        }//if

        $candidat->position = $parameters['position'];
        $candidat->langsEN = $parameters['langsEN'];
        $candidat->langsDE = $parameters['langsDE'];
        $candidat->experience = $parameters['experience'];
        $candidat->websait = $parameters['websait'];
        $candidat->passport = $parameters['passport'];
        $candidat->about = $parameters['about'];
    }//if small
    else{
        $candidat->city = "";

        $candidat->age = 0;

        $candidat->position = '';
        $candidat->langsEN = '';
        $candidat->langsDE = '';
        $candidat->experience = '';
        $candidat->websait = '';
        $candidat->passport = '';
        $candidat->about = '';
    }

    $candidat->phone = $parameters['phone'];

    if( !preg_match('/^\+\d{2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/i', $candidat->phone , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Phone incorrect"
        );


    }//if

    $candidat->email = $parameters['email'];

    if( !preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/i', $candidat->email , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Email incorrect"
        );

    }//if

    $mobile = $parameters['mobile'];

    date_default_timezone_set('Europe/Minsk');
    $date = date('d/m/Y H:i:s ', time());

    $data = array(
        "FIO"=>$candidat->FIO,
        'city' =>$candidat->city,
        'age'=>$candidat->age,
        'positions'=>$candidat->position,
        'langsEN'=>$candidat->langsEN,
        'langsDE'=>$candidat->langsDE,
        'experience'=>$candidat->experience,
        'phone'=>$candidat->phone,
        'email'=>$candidat->email,
        'photo'=>null,
        'websait'=>$candidat->websait,
        'date'=>$date,
        'status_id'=>1,
        'description'=>"",
        'passport'=>$candidat->passport,
        'about'=>$candidat->about ,
    );


    $format = array( '%s', '%s', '%d', '%s','%s', '%s','%s','%s','%s','%s','%s', '%s','%d','%s','%s', '%s' );

    $idCand = null;
    if($small !== 1){
        $idCand = $parameters['idCand'];

        $resultPut = $wpdb->update( 'candidates',
            $data,
            array( 'id' => $idCand ),
            $format,
            array( '%d' )
        );

        if(!$resultPut){
            return array(
                'status'=>400,
                'massage'=>"Error put candidate"
            );
        }
    }
    else{
        $text = $wpdb->insert( 'candidates', $data, $format );

        $idCand = $wpdb->insert_id;

        if($text !== 1){
            return array(
                'status'=>401,
                'massage'=>"Error add database",
            );
        }

        $userEmails = [ 'hr@of-w.com', 'niko@rh-s.com'];

        foreach ($userEmails as $userEmail){

            $verificationSubject = "RemoteHelper";
            $verificationTemplate = "<h3>Добавился кандидат {$candidat->FIO}</h3> ";
            $header = "From: sales@rh-s.com\r\n";
            $header .='X-Mailer: PHP/' . phpversion();
            $header .= "MIME-Version: 1.0\r\n";
            $header .="Content-type: text/html; charset=iso-8859-1\r\n";

            $mailres = mail($userEmail , $verificationSubject,$verificationTemplate,$header);

        }//foreach $userEmails
    }

    if($mobile == 1){

        $data = $parameters['photo'];

        if($data){
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif

                if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                    return array(
                        'status'=>400,
                        'massage'=>"Type image no correct"
                    );
                };

                $data = base64_decode($data);

                if ($data === false) {
                    return array(
                        'status'=>400,
                        'massage'=>"Error decode image"
                    );
                }
            } else {
                return array(
                    'status'=>400,
                    'massage'=>"Type image incorrect  base64"
                );
            }

            $name = time() . "_$idCand";

            if( !file_exists("/home/rhscom/of-w.com/candidates/img")){
                mkdir("/home/rhscom/of-w.com/candidates/img");
            }//if

            mkdir("/home/rhscom/of-w.com/candidates/img/{$idCand}");

            $path = "/home/rhscom/of-w.com/candidates/img/{$idCand}/{$name}.{$type}";

            $resultImage = file_put_contents($path, $data);

            if($resultImage){
                $path = "/candidates/img/{$idCand}/{$name}.{$type}";

                $wpdb->update( 'candidates',
                    array( 'photo' => $path ),
                    array( 'id' => $idCand ),
                    array( '%s', '%d' ),
                    array( '%d' )
                );
            }
            else{
                return array(
                    'status'=>400,
                    'massage'=>"Error add img in directory"
                );
            }


        }//if data

    }//if mobile
    else{

        if( isset( $_FILES['photo'] ) ){

            $name =  $_FILES['photo']['name'];

            $name = time() . "_$name";

            if( !file_exists("/home/rhscom/of-w.com/candidates/img")){
                mkdir("/home/rhscom/of-w.com/candidates/img");
            }//if

            mkdir("/home/rhscom/of-w.com/candidates/img/{$idCand}");

            $path = "/home/rhscom/of-w.com/candidates/img/{$idCand}/{$name}";

            if( !move_uploaded_file($_FILES['photo']['tmp_name'] , $path) ){

                return array(
                    'status'=>400,
                    'massage'=>"Error add image in derictory"
                );

            }//if

            $path = "/candidates/img/{$idCand}/{$name}";

            $resultPut = $wpdb->update( 'candidates',
                array( 'photo' => $path ),
                array( 'id' => $idCand ),
                array( '%s', '%d' ),
                array( '%d' )
            );

            if(!$resultPut){
                return array(
                    'status'=>400,
                    'massage'=>"Error put path image in database"
                );
            }
        }//if
    }//else





    return array(
        'status'=>200,
        'message'=>"Add candidate",
        'id'=>$idCand,
        'resmail'=>$mailres
    );


}

//получение кандидатов с лимитом и офсетом
add_action('rest_api_init', 'reset_get_candidat');

function reset_get_candidat()
{
    register_rest_route(
        'reset_get_candidate', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_candidate'
        )
    );
}

function reset_get_candidate($request_param)
{

    global $wpdb;
    $parameters = $request_param->get_params();

    $limit = $parameters['limit'];
    $offset = $parameters['offset'];

    $query = "SELECT * FROM `candidates` ORDER BY id DESC LIMIT {$offset}, {$limit}";


    $text = $wpdb->get_results( $query );


    return $text;

}

// Получение всех статусов кандидатов
add_action('rest_api_init', 'reset_get_status_candidat');

function reset_get_status_candidat()
{
    register_rest_route(
        'reset_get_status_candidate', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_status_candidate'
        )
    );
}

function reset_get_status_candidate($request_param)
{

    global $wpdb;

    $query = 'SELECT * FROM `status_candidates` ';


    $text = $wpdb->get_results( $query );

    return $text;
}

// Получение всех отелей кандидатов
add_action('rest_api_init', 'reset_get_hotel');

function reset_get_hotel()
{
    register_rest_route(
        'reset_get_hotels', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_hotels'
        )
    );
}

function reset_get_hotels($request_param)
{

    global $wpdb;

    $query = 'SELECT * FROM `hotels` ';


    $text = $wpdb->get_results( $query );

    return $text;
}

//изменение отеля кандидата
add_action('rest_api_init', 'reset_put_hotel');

function reset_put_hotel()
{
    register_rest_route(
        'reset_put_hotel', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_put_hotelId'
        )
    );
}

function reset_put_hotelId($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $idCand = $parameters['idCand'];
    $idHotel = $parameters['idHotel'];

    $text = $wpdb->update( 'candidates',
        array( 'hotel_id' => $idHotel ),
        array( 'id' => $idCand ),
        array( '%d' ),
        array( '%d' )
    );

    return [
        '$idCand'=>$idCand,
        '$idHotel'=>$idHotel,
        "result"=>$text
    ];
}

//изменение статуса кандидата
add_action('rest_api_init', 'reset_put_status_candidat');

function reset_put_status_candidat()
{
    register_rest_route(
        'reset_put_status_candidate', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_put_status_candidate'
        )
    );
}

function reset_put_status_candidate($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $idCand = $parameters['idCand'];
    $idStatus = $parameters['idStatus'];

    $text = $wpdb->update( 'candidates',
        array( 'status_id' => $idStatus ),
        array( 'id' => $idCand ),
        array( '%d', '%d' ),
        array( '%d' )
    );

    return $text;
}

//изменение комментариев кандидата
add_action('rest_api_init', 'reset_put_description_candidat');

function reset_put_description_candidat()
{
    register_rest_route(
        'reset_put_desc_candidate', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_put_desc_candidate'
        )
    );
}

function reset_put_desc_candidate($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $idCand = $parameters['idCand'];
    $desc = $parameters['desc'];

    $text = $wpdb->update( 'candidates',
        array( 'description' => $desc ),
        array( 'id' => $idCand ),
        array( '%s', '%d' ),
        array( '%d' )
    );

    return $text;
}


//получение кандидатов которые согласны и нет еще в базе
add_action('rest_api_init', 'reset_get_candidat_inDatabase');

function reset_get_candidat_inDatabase()
{
    register_rest_route(
        'reset_get_candidat_inDatabase', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_candidat_inDB'
        )
    );
}

function reset_get_candidat_inDB($request_param)
{

    global $wpdb;

    //Предварительное согласие
    $statusPreliminary = 2;
    //Полное согласие
    $statusAgreed = 3;


    $query = "SELECT * FROM `candidates` WHERE (status_id = {$statusAgreed} OR status_id = {$statusPreliminary}) AND isDB = 0";


    $candidates = $wpdb->get_results( $query );

    if(count($candidates)>0){

        $textInFile = 'ID,Тип,Артикул,Имя,Опубликован,рекомендуемый?,"Видимость в каталоге","Короткое описание",Описание,"Дата начала действия продажной цены","Дата окончания действия продажной цены","Статус налога","Налоговый класс","В наличии?",Запасы,"Малое количество на складе","Задержанный заказ возможен?","Продано индивидуально?","Вес (kg)","Длина (cm)","Ширина (cm)","Высота (cm)","Разрешить отзывы от клиентов?","Примечание к покупке","Цена распродажи","Базовая цена",Категории,Метки,"Класс доставки",Изображения,"Лимит загрузок","Число дней до просроченной загрузки",Родительский,"Сгруппированные товары",Апсейл,Кросселы,"Внешний URL","Текст кнопки",Позиция,"Имя атрибута 1","Значение(-я) аттрибута(-ов) 1","Видимость атрибута 1","Глобальный атрибут 1","Мета: _isa_wc_max_qty_product_max"';

        foreach ( $candidates as $candidate ){

//        $candidate = $candidates[8];

            $id = filter_var( $candidate->id , FILTER_VALIDATE_INT) + 2000;

            $textInFile .= "\n$id,";
            $textInFile .= "simple,,";

            $arrayFIO = explode(" ", trim($candidate->FIO));

            $lastName = substr($arrayFIO[0], 0, 2);
            $lastName .= ".";

            $firstName = $arrayFIO[1];

            if(!$firstName){
                $firstName = $arrayFIO[2];
            }
            $textInFile .= "\"{$candidate->id} - {$firstName} {$lastName}\",";

            $textInFile .= "1,0,visible,";
            $textInFile .= "{$candidate->positions},";

            $textInFile .= "\"Age: {$candidate->age} years old 
                                \nУровень владения иностранными языками: 
                                \nАнглийский язык - {$candidate->langsEN}
                                \nНемецкий язык - {$candidate->langsDE}
                                \",";

            $textInFile .= ",,taxable,,1,,,0,0,,,,,0,,,,";

            $category = "";

            switch ($candidate->positions){
                case 'Бармен':
                    $category = "Бармены";
                    break;
                case 'Официант':
                    $category = "Официанты";
                    break;
                case 'Аниматор':
                    $category = "Аниматоры";
                    break;
                case 'Повар':
                    $category = "Повара";
                    break;
                case 'Горничная':
                    $category = "Горничные";
                    break;
                case 'Портье':
                    $category = "Портье";
                    break;
                case 'Разнорабочий':
                    $category = "Разнорабочие";
                    break;
                case 'Электрик':
                    $category = "Электрики";
                    break;
                case 'Посудомойщица':
                    $category = "Посудомойщики";
                    break;
                case 'Спасатель':
                    $category = "Спасатели";
                    break;
                case 'Танцор':
                    $category = "Танцоры";
                    break;
            }//switch
            $textInFile .= "{$category},,,";

            $rootPath = '/home/rhscom/of-w.com';

            if(!$candidate->photo){
                $textInFile .= ",,,,,,,,,0,\"Work experience\",";
            }
            else{
                $baseNAme =  basename($candidate->photo);

                $contentPath = "/wp-content/uploads/2019/01/{$baseNAme}";
                $currentImage = file_get_contents("{$rootPath}{$candidate->photo}");

                $rsult = file_put_contents("{$rootPath}{$contentPath}", $currentImage);

                $textInFile .= "http://of-w.com{$contentPath},,,,,,,,,0,\"Work experience\",";
            }


            $textInFile .= "\"{$candidate->experience}\",1,0,";


        }//foreach


        date_default_timezone_set('Europe/Minsk');
        $date = date('d-m-Y H-i-s ', time());

        if( !file_exists("/home/rhscom/of-w.com/candidates/files")){
            mkdir("/home/rhscom/of-w.com/candidates/files");
        }//if

        $file = "/home/rhscom/of-w.com/candidates/files/{$date}_candidates.csv";

        $data = mb_convert_encoding($textInFile, 'UTF-8', 'OLD-ENCODING');
        $resultfile = file_put_contents($file, $data);

        if(!$resultfile){
            return array(
                'status'=>202,
                'message'=>"Не удалось записать файл"
            );
        }
        else{
            if (file_exists($file)) {

                foreach ($candidates as $candidate){

                    $resultPut = $wpdb->update( 'candidates',
                        array( 'isDB' => 1 ),
                        array( 'id' => $candidate->id ),
                        array( '%d' ),
                        array( '%d' )
                    );
                }//foreach

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }//if file exist

            return array(
                'status'=>202,
                'message'=>"File add",
                '$rsult'=>$rsult,

            );
        }//else write in file



    }//if
    else{
        return array(
            'status'=>202,
            'message'=>"Нет данных для добавления в базу"
        );
    }//else



}


//статистика
add_action('rest_api_init', 'reset_statistics');

function reset_statistics()
{
    register_rest_route(
        'reset_statistics', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_statistics_candidates'
        )
    );
}

function reset_statistics_candidates($request_param)
{

    global $wpdb;

    $query = "SELECT city, COUNT(city) as countCity FROM candidates GROUP BY city";

    $staticCity= $wpdb->get_results( $query );

    $query = "SELECT date FROM candidates ORDER BY id DESC";

    $staticAll= $wpdb->get_results( $query );

    $arrDateStatistic = [];

    $yearDateCheck = '';
    $monthDateCheck = '';
    $dayDateCheck = '';

    foreach ($staticAll as $cand){

        $date = trim($cand->date);

        $hello = '';

        $arrDate = date_parse_from_format("d/m/Y H:i:s ", $date);

        $yearDate = $arrDate['year'];
        $monthDate = $arrDate['month'];
        $dayDate = $arrDate['day'];

        if($dayDate<10){
            $dayDate = "0{$dayDate}";
        }//if

        if($monthDate<10){
            $dateString = "{$dayDate}-0{$monthDate}-{$yearDate}";
        }
        else{
            $dateString = "{$dayDate}-{$monthDate}-{$yearDate}";
        }


        if( $yearDate == $yearDateCheck && $monthDate == $monthDateCheck && $dayDate == $dayDateCheck){

            continue;
        }
        else{
            $yearDateCheck = $yearDate;
            $monthDateCheck = $monthDate;
            $dayDateCheck =  $dayDate;
        }

        $count = 0;

        foreach ($staticAll as $candDate){

            $dateCount = trim($candDate->date);

            $arrDateCount = date_parse_from_format("d/m/Y H:i:s ", $dateCount);

            $yearDateCount = $arrDateCount['year'];
            $monthDateCount = $arrDateCount['month'];
            $dayDateCount = $arrDateCount['day'];


            if($yearDate == $yearDateCount && $monthDate == $monthDateCount && $dayDate == $dayDateCount){
                $count++;
            }//if

        }//foreach

        $arrDateStatistic[] = [
            'date'=>$dateString,
            'count'=>$count
        ];


    }//foreach


    return  [
        'dateStatistic'=>$arrDateStatistic,
        'cityStatistic'=>$staticCity

    ]
        ;
}


//получение всех кандидатов в excel
add_action('rest_api_init', 'reset_get_candidat_inExcel');

function reset_get_candidat_inExcel()
{
    register_rest_route(
        'reset_get_candidat_inExcel', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_candidats_inExcel'
        )
    );
}

function reset_get_candidats_inExcel($request_param)
{

    global $wpdb;

    $query = "SELECT * FROM `candidates` ORDER BY id DESC";

    $candidates = $wpdb->get_results( $query );

    if(count($candidates)>0){

        $textInFile = 'Дата;ФИО;Город;Возраст;Должность;ЗнаиеАглийского;ЗнаниеНемецкого;Наличие паспорта;ОпытРаботы;Телефон;E-mail;СоцСеть;ОткудаУзнали;Photo';

        foreach ( $candidates as $candidate ){


            $textInFile .= "\n{$candidate->date};";
            $textInFile .= "{$candidate->FIO};";
            $textInFile .= "{$candidate->city};";
            $textInFile .= "{$candidate->age};";
            $textInFile .= "{$candidate->positions};";
            $textInFile .= "{$candidate->langsEN};";
            $textInFile .= "{$candidate->langsDE};";
            $textInFile .= "{$candidate->passport};";
//            $textInFile .= "{$candidate->experience};";
            $expresion = str_replace(["\n","\r","\n\r"], "", $candidate->experience);
            $expresionEnd = str_replace([";"], ",", $expresion);
            $textInFile .= "{$expresionEnd};";
            $textInFile .= "{$candidate->phone};";
            $textInFile .= "{$candidate->email};";
            $textInFile .= "{$candidate->websait};";
            $textInFile .= "{$candidate->about};";

            if(!$candidate->photo){
                $textInFile .= "{$candidate->photo}";
            }
            else{

                $textInFile .= "http://of-w.com{$candidate->photo}";
            }

        }//foreach


        date_default_timezone_set('Europe/Minsk');
        $date = date('d-m-Y H-i-s ', time());

        if( !file_exists("/home/rhscom/of-w.com/candidates/files")){
            mkdir("/home/rhscom/of-w.com/candidates/files");
        }//if

        if( !file_exists("/home/rhscom/of-w.com/candidates/files/all")){
            mkdir("/home/rhscom/of-w.com/candidates/files/all");
        }//if

        $file = "/home/rhscom/of-w.com/candidates/files/all/{$date}_all_candidates.csv";

//        $data = mb_convert_encoding($textInFile, 'UTF-8', 'OLD-ENCODING');

        $bom = "\xEF\xBB\xBF";
        $resultfile = file_put_contents($file, $bom.$textInFile);

        if(!$resultfile){
            return array(
                'status'=>202,
                'message'=>"Не удалось записать файл"
            );
        }
        else{
            if (file_exists($file)) {

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }//if file exist

            return array(
                'status'=>202,
                'message'=>"File add",

            );
        }//else write in file



    }//if




}

//количество записей
add_action('rest_api_init', 'reset_count_candidate');

function reset_count_candidate()
{
    register_rest_route(
        'reset_get_count_candidate', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_count_candidate'
        )
    );
}

function reset_get_count_candidate($request_param)
{

    global $wpdb;

    $query = "SELECT COUNT(*) as count FROM `candidates`";

    $countCandidate = $wpdb->get_results( $query );

    return array(
        'status'=>200,
        'count'=>$countCandidate,
        'message'=>"Количество кандидатов"
    );

}

//------------------------кандидаты Харьков

//добавление кагдидата в базу smallForm
add_action('rest_api_init', 'reset_add_candidates_small_harkov');

function reset_add_candidates_small_harkov()
{
    register_rest_route(
        'reset_add_candidates_small_harkov', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_add_candidat_small_harkov'
        )
    );
}

function reset_add_candidat_small_harkov($request_param)
{

    global $wpdb;
    $parameters = $request_param->get_params();

    $candidat = null;

    $candidat->FIO = $parameters['FIO'];

    if( !preg_match('/^[а-яa-z\s]{3,50}$/ui', $candidat->FIO , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"FIO incorrect"
        );


    }//if

    $candidat->age = $parameters['age'];

    if (!preg_match('/^[0-9\s]{1,2}$/i', $candidat->age, $matches)) {

        return array(
            'status' => 403,
            'massage' => "Age incorrect"
        );


    }//if

    $candidat->position = $parameters['position'];
    $candidat->langsEN = $parameters['langsEN'];

    $candidat->phone = $parameters['phone'];

    if( !preg_match('/^\+\d{2}\(\d{3}\)\d{3}-\d{2}-\d{2}$/i', $candidat->phone , $matches ) ){

        return array(
            'status'=>403,
            'massage'=>"Phone incorrect"
        );


    }//if


    date_default_timezone_set('Europe/Minsk');
    $date = date('d/m/Y H:i:s ', time());

    $data = array(
        "FIO"=>$candidat->FIO,
        'age'=>$candidat->age,
        'positions'=>$candidat->position,
        'langsEN'=>$candidat->langsEN,
        'phone'=>$candidat->phone,
        'date'=>$date
    );


    $format = array( '%s', '%d', '%s','%s', '%s', '%s');

    $idCand = null;

    $text = $wpdb->insert( 'candidates_harkov', $data, $format );

    $idCand = $wpdb->insert_id;

    if($text !== 1){
        return array(
            'status'=>401,
            'message'=>"Error add database",
            'can'=>$candidat
        );
    }

    $userEmails = [ 'hr@of-w.com', 'niko@rh-s.com'];

    foreach ($userEmails as $userEmail){

        $verificationSubject = "RemoteHelper";
        $verificationTemplate = "<h3>Добавился кандидат по Харькову: {$candidat->FIO}</h3> ";
        $header = "From: sales@rh-s.com\r\n";
        $header .='X-Mailer: PHP/' . phpversion();
        $header .= "MIME-Version: 1.0\r\n";
        $header .="Content-type: text/html; charset=iso-8859-1\r\n";

        $mailres = mail($userEmail , $verificationSubject,$verificationTemplate,$header);

    }//foreach $userEmails



    return array(
        'status'=>200,
        'message'=>"Add candidate in Harkov",
        'id'=>$idCand,
    );


}

//получение кандидатов с лимитом и офсетом
add_action('rest_api_init', 'reset_get_candidat_harkov');

function reset_get_candidat_harkov()
{
    register_rest_route(
        'reset_get_candidate_harkov', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_candidate_harkov'
        )
    );
}

function reset_get_candidate_harkov($request_param)
{

    global $wpdb;
    $parameters = $request_param->get_params();

    $limit = $parameters['limit'];
    $offset = $parameters['offset'];

    $query = "SELECT * FROM `candidates_harkov` ORDER BY id DESC LIMIT {$offset}, {$limit}";


    $text = $wpdb->get_results( $query );


    return $text;

}

// Получение всех статусов кандидатов  в харькове
add_action('rest_api_init', 'reset_get_status_candidat_harkov');

function reset_get_status_candidat_harkov()
{
    register_rest_route(
        'reset_get_status_candidate_harkov', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_status_candidate_harkov'
        )
    );
}

function reset_get_status_candidate_harkov($request_param)
{

    global $wpdb;

    $query = 'SELECT * FROM `status_candidates_harkov` ';


    $text = $wpdb->get_results( $query );

    return $text;
}

//изменение статуса кандидата
add_action('rest_api_init', 'reset_put_status_candidat_harkov');

function reset_put_status_candidat_harkov()
{
    register_rest_route(
        'reset_put_status_candidate_harkov', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_put_status_candidate_harkov'
        )
    );
}

function reset_put_status_candidate_harkov($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $idCand = $parameters['idCand'];
    $idStatus = $parameters['idStatus'];

    $text = $wpdb->update( 'candidates_harkov',
        array( 'status_id' => $idStatus ),
        array( 'id' => $idCand ),
        array( '%d', '%d' ),
        array( '%d' )
    );

    return $text;
}

//изменение комментариев кандидата
add_action('rest_api_init', 'reset_put_description_candidat_harkov');

function reset_put_description_candidat_harkov()
{
    register_rest_route(
        'reset_put_desc_candidate_harkov', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_put_desc_candidate_harkov'
        )
    );
}

function reset_put_desc_candidate_harkov($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $idCand = $parameters['idCand'];
    $desc = $parameters['desc'];

    $text = $wpdb->update( 'candidates_harkov',
        array( 'description' => $desc ),
        array( 'id' => $idCand ),
        array( '%s', '%d' ),
        array( '%d' )
    );

    return $text;
}

//получение всех кандидатов в excel
add_action('rest_api_init', 'reset_get_candidat_inExcel_harkov');

function reset_get_candidat_inExcel_harkov()
{
    register_rest_route(
        'reset_get_candidat_inExcel_harkov', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_get_candidats_inExcel_harkov'
        )
    );
}

function reset_get_candidats_inExcel_harkov($request_param)
{

    global $wpdb;

    $query = "SELECT * FROM `candidates_harkov` ORDER BY id DESC";

    $candidates = $wpdb->get_results( $query );

    if(count($candidates)>0){

        $textInFile = 'Дата;ФИО;Город;Возраст;Должность;ЗнаиеАглийского;ЗнаниеИнострЯзык;Наличие паспорта;ОпытРаботы;Телефон;E-mail;СоцСеть;ОткудаУзнали;Photo';

        foreach ( $candidates as $candidate ){


            $textInFile .= "\n{$candidate->date};";
            $textInFile .= "{$candidate->FIO};";
            $textInFile .= "{$candidate->city};";
            $textInFile .= "{$candidate->age};";
            $textInFile .= "{$candidate->positions};";
            $textInFile .= "{$candidate->langsEN};";
            $textInFile .= "{$candidate->langsDE};";
            $textInFile .= "{$candidate->passport};";
//            $textInFile .= "{$candidate->experience};";
            $expresion = str_replace(["\n","\r","\n\r"], "", $candidate->experience);
            $expresionEnd = str_replace([";"], ",", $expresion);
            $textInFile .= "{$expresionEnd};";
            $textInFile .= "{$candidate->phone};";
            $textInFile .= "{$candidate->email};";
            $textInFile .= "{$candidate->websait};";
            $textInFile .= "{$candidate->about};";

            if(!$candidate->photo){
                $textInFile .= "{$candidate->photo}";
            }
            else{

                $textInFile .= "http://of-w.com{$candidate->photo}";
            }

        }//foreach


        date_default_timezone_set('Europe/Minsk');
        $date = date('d-m-Y H-i-s ', time());

        $file = "/home/rhscom/of-w.com/candidates_harkov/files/all/{$date}_all_candidates.csv";

//        $data = mb_convert_encoding($textInFile, 'UTF-8', 'OLD-ENCODING');

        $bom = "\xEF\xBB\xBF";
        $resultfile = file_put_contents($file, $bom.$textInFile);

        if(!$resultfile){
            return array(
                'status'=>202,
                'message'=>"Не удалось записать файл"
            );
        }
        else{
            if (file_exists($file)) {


                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($file).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($file));
                readfile($file);
                exit;
            }//if file exist

            return array(
                'status'=>202,
                'message'=>"File add",

            );
        }//else write in file



    }//if




}


//статистика
add_action('rest_api_init', 'reset_statistics_harkov');

function reset_statistics_harkov()
{
    register_rest_route(
        'reset_statistics_harkov', '/v2', array(
            'methods' => 'GET',
            'callback' => 'reset_statistics_candidates_harkov'
        )
    );
}

function reset_statistics_candidates_harkov($request_param)
{

    global $wpdb;

    $query = "SELECT city, COUNT(city) as countCity FROM candidates_harkov GROUP BY city";

    $staticCity= $wpdb->get_results( $query );

    $query = "SELECT date FROM candidates_harkov ORDER BY id DESC";

    $staticAll= $wpdb->get_results( $query );

    $arrDateStatistic = [];

    $yearDateCheck = '';
    $monthDateCheck = '';
    $dayDateCheck = '';

    foreach ($staticAll as $cand){

        $date = trim($cand->date);

        $hello = '';

        $arrDate = date_parse_from_format("d/m/Y H:i:s ", $date);

        $yearDate = $arrDate['year'];
        $monthDate = $arrDate['month'];
        $dayDate = $arrDate['day'];

        if($dayDate<10){
            $dayDate = "0{$dayDate}";
        }//if

        if($monthDate<10){
            $dateString = "{$dayDate}-0{$monthDate}-{$yearDate}";
        }
        else{
            $dateString = "{$dayDate}-{$monthDate}-{$yearDate}";
        }


        if( $yearDate == $yearDateCheck && $monthDate == $monthDateCheck && $dayDate == $dayDateCheck){

            continue;
        }
        else{
            $yearDateCheck = $yearDate;
            $monthDateCheck = $monthDate;
            $dayDateCheck =  $dayDate;
        }

        $count = 0;

        foreach ($staticAll as $candDate){

            $dateCount = trim($candDate->date);

            $arrDateCount = date_parse_from_format("d/m/Y H:i:s ", $dateCount);

            $yearDateCount = $arrDateCount['year'];
            $monthDateCount = $arrDateCount['month'];
            $dayDateCount = $arrDateCount['day'];


            if($yearDate == $yearDateCount && $monthDate == $monthDateCount && $dayDate == $dayDateCount){
                $count++;
            }//if

        }//foreach

        $arrDateStatistic[] = [
            'date'=>$dateString,
            'count'=>$count
        ];


    }//foreach


    return  [
        'dateStatistic'=>$arrDateStatistic,
        'cityStatistic'=>$staticCity

    ]
        ;
}

add_action('rest_api_init', 'reset_user_auth');

function reset_user_auth()
{
    register_rest_route(
        'reset_user_auth', '/v2', array(
            'methods' => 'POST',
            'callback' => 'reset_get_user_harkov'
        )
    );
}

function reset_get_user_harkov($request_param)
{

    global $wpdb;

    $parameters = $request_param->get_params();

    $login = $parameters['login'];
    $pass = $parameters['password'];

    $query = "SELECT * FROM users WHERE login = {$login} AND password={$pass}";

    if(!$query){
        return [
            'status'=>400,
            'msg'=>"User not found"
        ];
    }
    return [
        'status'=>200,
        'msg'=>"User found"
    ];
}