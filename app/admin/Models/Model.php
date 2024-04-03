<?php

namespace App\admin\Models;

use App\admin\Core\DbConnect;
use PDO;

class ColorModel
{
    private $db;

    public function __construct()
    {
        $this->db = DbConnect::getInstance()->getConnection();
    }

    public function getColors()
    {
        $stmt = $this->db->query("SELECT * FROM color_settings WHERE id = 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateColors($textColor, $backgroundColor, $primaryNavbarBackgroundColor, $primaryNavbarTextColor, $secondaryNavbarBackgroundColor, $secondaryNavbarTextColor, $footerColor1, $footerColor2, $footerTextColor)
    {
        $sql = "UPDATE color_settings SET 
                text_color = :textColor, 
                background_color = :backgroundColor, 
                primary_navbar_background_color = :primaryNavbarBackgroundColor, 
                primary_navbar_text_color = :primaryNavbarTextColor, 
                secondary_navbar_background_color = :secondaryNavbarBackgroundColor, 
                secondary_navbar_text_color = :secondaryNavbarTextColor, 
                footer_color_1 = :footerColor1, 
                footer_color_2 = :footerColor2, 
                footer_text_color = :footerTextColor 
                WHERE id = 1";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':textColor' => $textColor,
            ':backgroundColor' => $backgroundColor,
            ':primaryNavbarBackgroundColor' => $primaryNavbarBackgroundColor,
            ':primaryNavbarTextColor' => $primaryNavbarTextColor,
            ':secondaryNavbarBackgroundColor' => $secondaryNavbarBackgroundColor,
            ':secondaryNavbarTextColor' => $secondaryNavbarTextColor,
            ':footerColor1' => $footerColor1,
            ':footerColor2' => $footerColor2,
            ':footerTextColor' => $footerTextColor
        ]);
    }
}
