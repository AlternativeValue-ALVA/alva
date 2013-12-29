<?php
if ($qls->user_info['username'] == '') {
    header('Location: ' . $site . '/login');
    die;
}
if ($_POST['Submit'] == 'Upload') {
    $id = md5($qls->user_info['username']);
    if (!empty($_FILES['ifile']['tmp_name'])) {
        include_once('app/phpthumb/ThumbLib.inc.php');
        if (!getimagesize($_FILES['ifile']['tmp_name'])) {
            die("Greska: Nije slika");
        }
        $imgtype = array(
            '1' => '.gif',
            '2' => '.jpg',
            '3' => '.png'
        );
        list($width, $height, $type, $attr) = getimagesize($_FILES['ifile']['tmp_name']);
        switch ($type) {
            case 1:
                $ext = '.gif';
                break;
            case 2:
                $ext = '.jpg';
                break;
            case 3:
                $ext = '.png';
                break;
        }
        if ($ext == '.gif') {
            die("Greska - GIF nije dozvoljen. Molimo vas koristite samo PNG ili JPEG format");
        }
        if ($width > 10000 || $height > 10000) {
            die("Greska: Maximalna duzina i visina su prevazidjeni (max 1000x1000px)");
        }
        if ($_FILES['ifile']['size'] > 5000000) {
            die("Greska: prevelik fajl (max 5mb)");
        }
        $uploaddir   = 'crc/';
        $uploadfile  = $uploaddir . "$id.jpg";
        $uploadfile2 = $uploaddir . "$id" . "_s.jpg";
        if (!move_uploaded_file($_FILES['ifile']['tmp_name'], $uploadfile)) {
            die("Greska prilikom pomeranja fajla");
        }
        $thumb = PhpThumbFactory::create($uploadfile);
        $thumb->resize(600, 300);
        $thumb->save($uploadfile);
        $thumb = PhpThumbFactory::create($uploadfile);
        $thumb->resize(29, 29);
        $thumb->save($uploadfile2);
        header('Location: ' . $site . '/profile');
        die;
    }
}
?>