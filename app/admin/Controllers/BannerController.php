<?php

namespace App\admin\Controllers;

use App\admin\Models\BannerModel;

class BannerController extends Controller
{
    protected $bannerModel;

    public function __construct()
    {
        $this->bannerModel = new BannerModel();
    }

    public function editBanner()
    {
        $this->render('custom/editBanner');
    }

    public function saveBannerImage()
    {
        if (!empty($_FILES['croppedImage'])) {
            $image = $_FILES['croppedImage'];
            $imagePath = '../public/assets/images/bandeau/' . uniqid() . '.png';

            if (move_uploaded_file($image['tmp_name'], $imagePath)) {
                $this->bannerModel->saveBannerImagePath($imagePath);


                $_SESSION['banner_update_success'] = "L'image du bandeau a été mise à jour avec succès.";

                echo json_encode(['success' => true, 'message' => 'Image enregistrée avec succès.', 'path' => $imagePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Échec de l\'enregistrement de l\'image.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Aucune image fournie.']);
        }
    }
}
