<?php
namespace Horoshop\Test\Controllers;



use Horoshop\Test\src\Models\Template;
use Horoshop\Test\View\View;

/**
 * Class Homepage
 *
 * @package Controllers
 */
class TemplateController extends BaseController
{
    public function actionIndex()
    {
        $this->view->generate('add_template_page.php');
    }

    public function actionAddTemplate()
    {

        $title = '';
        if( isset($_POST['title']) ){
            $title = $_POST['title'];
        }//if

        $matches = array();

        $check = preg_match('/^[а-яa-z0-9\s]{3,50}$/iu', $title , $matches );

        if( !$check ){


            $this->json( 400 , array(
                'title_err' => $title
            ) );

            return;

        }//if

        $number = -1;
        if( isset($_POST['number']) ){
            $number = $_POST['number'];
        }//if

        if(! filter_var($number , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^[0-9]{1,9}$/"))
        )){

            $this->json( 400 , array(
                'number_err' => $number
            ) );

            return;

        }//if

        $link = '';
        if( isset($_POST['link']) ){
            $link = $_POST['link'];
        }//if




            $files = array();

            $upload_dir = './uploads/';

            if( !is_dir($upload_dir)){
                mkdir($upload_dir, 0777);
            }//if


            foreach ($_FILES as $file){

                $uploadOk = 1;

                $check = getimagesize($file["tmp_name"]);
                if ($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;

                }

                if (file_exists($upload_dir.basename($file['name']))) {

                    $uploadOk = 0;
                    continue;
                }
                $imageFileType = strtolower(pathinfo($upload_dir.basename($file['name']), PATHINFO_EXTENSION));
                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif") {

                    $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    $this->json( 400 , array(
                        'file_err' => $file
                    ) );

                    return;
                }
                else{
                    if(move_uploaded_file($file['tmp_name'], $upload_dir.basename($file['name'])) ){
                        $files[] = $upload_dir.$file['name'];

                    }
                    else{
                        $this->json( 400 , array(
                            'file_err' => $file
                        ) );

                        return;
                    }
                }

            }

        try{
            $template = new Template();


            $result = $template->AddTemplate([
                'title' => $title,
                'number' => $number,
                'link' => $link,
                'pages' => $files
            ]);


            $this->json( 200 , array(
                'code' => 200,
                'template' => $result
            ) );


        }//try
        catch( \Exception $ex ){

            $this->json( 500 , array(
                'code' => 500,
                'template' => $ex
            ) );

        }//catch
    }//actionAddTemplate

    public function actionGetTemplateByID()
    {
        $id = '';
        if( isset($_POST['idTemplate']) ){
            $id = $_POST['idTemplate'];
        }//if

        $template = new Template();

        $result = $template->GetTemplateById($id);
//echo('<pre>');print_r($result);echo('<pre>');
        $this->view->generate('update_template_page.php', ['template' => $result]);
    }

    public function actionUpdateTemplate()
    {
        $id = '';
        if( isset($_POST['templateId']) ){
            $id = $_POST['templateId'];
        }//if

        $title = '';
        if( isset($_POST['title']) ){
            $title = $_POST['title'];
        }//if

        $matches = array();

        $check = preg_match('/^[а-яa-z0-9\s]{3,50}$/iu', $title , $matches );

        if( !$check ){


            $this->json( 400 , array(
                'title_err' => $title
            ) );

            return;

        }//if

        $number = -1;
        if( isset($_POST['number']) ){
            $number = $_POST['number'];
        }//if

        if(! filter_var($number , FILTER_VALIDATE_REGEXP , array(
                "options" => array("regexp"=>"/^[0-9]{1,9}$/"))
        )){

            $this->json( 400 , array(
                'number_err' => $number
            ) );

            return;

        }//if

        $link = '';
        if( isset($_POST['link']) ){
            $link = $_POST['link'];
        }//if




        $files = array();

        $upload_dir = './uploads/';

        if( !is_dir($upload_dir)){
            mkdir($upload_dir, 0777);
        }//if


        foreach ($_FILES as $file){

            $uploadOk = 1;

            $check = getimagesize($file["tmp_name"]);
            if ($check !== false) {
                $uploadOk = 1;
            } else {
                $uploadOk = 0;

            }

            if (file_exists($upload_dir.basename($file['name']))) {

                $uploadOk = 0;
                continue;
            }
            $imageFileType = strtolower(pathinfo($upload_dir.basename($file['name']), PATHINFO_EXTENSION));
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif") {

                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $this->json( 400 , array(
                    'file_err' => $file
                ) );

                return;
            }
            else{
                if(move_uploaded_file($file['tmp_name'], $upload_dir.basename($file['name'])) ){
                    $files[] = $upload_dir.$file['name'];

                }
                else{
                    $this->json( 400 , array(
                        'file_err' => $file
                    ) );

                    return;
                }
            }

        }

        try{
            $template = new Template();


            $result = $template->UpdateTemplate([
                'templateId' => $id,
                'title' => $title,
                'number' => $number,
                'link' => $link,
                'pages' => $files
            ]);


            $this->json( 200 , array(
                'code' => 200,
                'template' => $result
            ) );


        }//try
        catch( \Exception $ex ){

            $this->json( 500 , array(
                'code' => 500,
                'template' => $ex
            ) );

        }//catch
    }//actionAddTemplate
}