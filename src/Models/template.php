<?php
    namespace Horoshop\Test\src\Models;
    use Horoshop\Test\src\Utils\MySQL;

    class Template{

        public $templateId;
        public $title;
        public $number;
        public $link;
        public $pages = array();

        public function GetTemplates( $limit = 10 , $offset = 0 ){

            $stm = MySQL::$pdo->prepare("SELECT * FROM templates LIMIT :offset,:limit");
            $stm->bindParam(':offset' , $offset , \PDO::PARAM_INT);
            $stm->bindParam(':limit' , $limit , \PDO::PARAM_INT);

            $templates = array();
            if ($stm->execute()) {
                while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {
                    $template = new Template();
                    $template->templateId = $row['templateId'];
                    $template->title = $row['title'];
                    $template->number = $row['number'];


                    $templates[] = $template;
                }
            }

            return $templates;

        }//GetTemplates

        public function GetTemplatesWithPage($limit = 10 , $offset = 0){

            $templates = $this->GetTemplates($limit , $offset);

            foreach ($templates as &$template){

                $stm = MySQL::$pdo->prepare("SELECT * FROM pages WHERE templateId = :id");
                $stm->bindParam(':id' , $template->templateId , \PDO::PARAM_INT);

                $template->pages = array();
                if ($stm->execute()) {
                    while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {

                        $template->pages[] = $row['url'];;
                    }
                }

            }//foreach


            return $templates;


        }//GetTemplatesWithPage

        public function GetTemplateById($id){

            $stm = MySQL::$pdo->prepare("SELECT * FROM templates WHERE templateId = :id");
            $stm->bindParam(':id' , $id , \PDO::PARAM_INT);
            $stm->execute();

            $template = $stm->fetch(\PDO::FETCH_OBJ);


            $stm = MySQL::$pdo->prepare("SELECT * FROM pages WHERE templateId = :id");
            $stm->bindParam(':id' , $template->templateId , \PDO::PARAM_INT);

            $template->pages = array();
            if ($stm->execute()) {
                while ($row = $stm->fetch(\PDO::FETCH_ASSOC)) {

                    $template->pages[] = $row['url'];;
                }
            }

            return $template;

        }//GetTemplateById

        public function AddTemplate($params = []){

            $stm = MySQL::$pdo->prepare("INSERT INTO templates VALUES( DEFAULT  , :title , :number , :link)");
            $stm->bindParam(':title' , $params['title'] , \PDO::PARAM_STR);
            $stm->bindParam(':number' ,  $params['number'] , \PDO::PARAM_INT);
            $stm->bindParam(':link' ,  $params['link'] , \PDO::PARAM_STR);


            $stm->execute();

            $templateId =  MySQL::$pdo->lastInsertId();

            if( $templateId == 0 ){

                $exception = new \stdClass();
                $exception->errorCode = MySQL::$pdo->errorCode ();
                $exception->errorInfo = MySQL::$pdo->errorInfo ();

                return $exception;

            }//if





                $files =  $params['pages'];

                foreach ($files as $file) {



                    $stm = MySQL::$pdo->prepare("INSERT INTO pages VALUES( DEFAULT  , :templateId , :url)");
                    $stm->bindParam(':templateId' , $templateId , \PDO::PARAM_INT );
                    $stm->bindParam(':url' , $file , \PDO::PARAM_STR );
                    $result = $stm->execute();

                    if( $result === false ){

                        $exception = new \stdClass();
                        $exception->errorCode = MySQL::$pdo->errorCode ();
                        $exception->errorInfo = MySQL::$pdo->errorInfo ();

                        return $exception;

                    }//if
                }















            return $templateId;



        }//AddTemplate

        public function UpdateTemplate($params = []){
            $stm = MySQL::$pdo->prepare("UPDATE books SET title= :title, number= :number, link= :link WHERE templateId= :templateId");
            $stm->bindParam(':title' , $params['title'] , \PDO::PARAM_STR);
            $stm->bindParam(':number' ,  $params['number'] , \PDO::PARAM_INT);
            $stm->bindParam(':link' ,  $params['link'] , \PDO::PARAM_STR);
            $stm->bindParam(':templateId', $params['templateId'], \PDO::PARAM_INT);
            $result = $stm->execute();

            if( $result === false ){

                $exception = new \stdClass();
                $exception->errorCode = MySQL::$pdo->errorCode ();
                $exception->errorInfo = MySQL::$pdo->errorInfo ();

                return $exception;

            }//if

            $stm = MySQL::$pdo->prepare("DELETE FROM pages WHERE templateId= :templateId");
            $stm->bindParam(':templateId' , $params['templateId'] , \PDO::PARAM_INT );

            $result = $stm->execute();

            if( $result === false ){

                $exception = new \stdClass();
                $exception->errorCode = MySQL::$pdo->errorCode ();
                $exception->errorInfo = MySQL::$pdo->errorInfo ();

                return $exception;

            }//if
            $files =  $params['pages'];

            foreach ($files as $file) {

                $stm = MySQL::$pdo->prepare("INSERT INTO pages VALUES( DEFAULT  , :templateId , :url)");
                $stm->bindParam(':templateId' , $params['templateId'] , \PDO::PARAM_INT );
                $stm->bindParam(':url' , $file , \PDO::PARAM_STR );
                $result = $stm->execute();

                if( $result === false ){

                    $exception = new \stdClass();
                    $exception->errorCode = MySQL::$pdo->errorCode ();
                    $exception->errorInfo = MySQL::$pdo->errorInfo ();

                    return $exception;

                }//if


            }


            $result = $stm->execute();

            return $result;
        }//UpdateTemplate

    }
