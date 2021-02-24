<?php if( ! defined('BASEPATH')) exit('Akses langsung tidak diperkenankan');
$config['institution'] = 'alto';
$config['cardbase_prefix'] = '010';
$config['cardless_prefix'] = '041';
$config['realtime_version'] = '5';
//berkas wrapper untuk sisi publik
$config['public_view'] = 'login/login_view';
//restrict page after login 
$config['restrict_view'] = 'restricted_screen';
//captcha word
$config['captcha_word'] = array(
                                'kopi'
                                ,'teh'
                                ,'lab'
                                ,'sel'
                                ,'pena'
                                ,'korek'
                                ,'obat'
                                ,'resep'
                                ,'kaki'
                                ,'kafe'
                                ,'tablet'
                                ,'kapsul'
                                ,'kafe'
                                );
//captcha number
$config['captcha_num'] = array(
                                '123'
                                ,'234'
                                ,'345'
                                ,'456'
                                ,'567'
                                ,'678'
                                ,'789'
                                ,'890'
                                ,'901'
                                ,'012'
                                );

/**
* SISI ADMINISTRASI
*/
//tingkatan pengguna
$config['user_level'] = array(
                            1 => '1'
                            ,2 => '2' //view terminal monitor
                            ,3 => '3' //view 
                            ,4 => '4' //view 
                            ,5 => '5'
                            ,6 => '6'
                            ,7 => '7'
                            ,8 => '8' //administrator
                            ,9 => '9' //highest administrator
                            );
//nilai standar tingkatan pengguna saat registrasi
$config['default_user_level'] = 1;
//direktori view admin
$config['admin_view'] = "admin/";
?>