<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\EventInterface;
use Cake\Log\Log;
use Cake\ORM\TableRegistry;

/**
 * Graphs Controller
 *
 * @method \App\Model\Entity\Graph[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class GraphsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function index()
    {
        //$graphs = $this->paginate($this->Graphs);

        //$this->set(compact('graphs'));

    }
    public function sparrow()
    {
    }
    public function notify()
    {

        if (isset($_POST['image'])) {

            //----------Create Json File For Post Image
            if (file_exists(WWW_ROOT . '/graph/graphImg.json')) {
                unlink(WWW_ROOT . '/graph/graphImg.json');
            }
            $json_file = fopen(WWW_ROOT . '/graph/graphImg.json', "a") or die("Unable to open file!");
            $current_data = file_get_contents(WWW_ROOT . '/graph/graphImg.json');
            $array_data = json_decode($current_data, true);
            $extra = array(
                'imageURL' => $_POST['image']
            );
            $array_data[] = $extra;
            $final_data = json_encode($array_data);
            file_put_contents(WWW_ROOT . '/graph/graphImg.json', $final_data);
            fclose($json_file);
            //----------End Create Json File

            //----------Convert Json to Image with Base64 Decoder
            $imgContents = file_get_contents(WWW_ROOT . '/graph/graphImg.json');
            $str_length = strlen($imgContents);
            $sparrow = substr($imgContents, 37, $str_length - 40);
            $decoder = base64_decode($sparrow);
            $img = imagecreatefromstring($decoder);

            if (!$img) {
                die('base 64 value is not a valid image');
            } else {
                header('Content-Type:image/jpeg');
                imagejpeg($img, WWW_ROOT . '/graph/graphImage.jpeg');
                imagedestroy($img);
            }
            //----------End Convert Json to Image 

            //----------Line Message Notify
            $line_api = 'https://notify-api.line.me/api/notify';
            //$access_token = "k4rGxe8pDwINs1POVZQo1nniV7hGn9ibu4SiIoLSh9R"; // For My Personal Account
            $access_token = "pzV5k7fagBKn3agMGDmamUdUPkLPwStRsKqXVrP5yBG"; //For LineTest Group

            $message = 'CO2 Level Message';    //text max 1,000 charecter
            $image_thumbnail_url = 'https://dummyimage.com/1024x1024/f598f5/fff.jpg';  // max size 240x240px JPEG
            $image_fullsize_url = 'https://dummyimage.com/1024x1024/844334/fff.jpg'; //max size 1024x1024px JPEG
            $file_name_with_full_path = WWW_ROOT . '/graph/graphImage.jpeg';
            $imageFile = curl_file_create($file_name_with_full_path);
            $sticker_package_id = '';  // Package ID sticker
            $sticker_id = '';    // ID sticker
            $message_data = array(
                'imageThumbnail' => $image_thumbnail_url,
                'imageFullsize' => $image_fullsize_url,
                'message' => $message,
                'imageFile' => $imageFile,
                'stickerPackageId' => $sticker_package_id,
                'stickerId' => $sticker_id
            );

            $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer ' . $access_token);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $line_api);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $result = curl_exec($ch);
            //----------End Line Message Notify

        } //end of isset IF
    } //end of notify function

}//end of controller class
