<div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2><?php echo isset($header_title) ? $header_title : '';?></h2>
                <p></p>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> ATMI</a></li>
                    <li class="breadcrumb-item active"><?php echo isset($sub_header_title) ? $sub_header_title : '';?></li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
            <div class="col-lg-5 col-md-6 col-sm-12">   
            <div class="float-right">
                    <div class="chat-about">
                        <div class="chat-with"><strong id="usrLogin"><?php echo isset($username) ? $username : '';?> </strong> &nbsp;| &nbsp;<a href="<?php echo base_url();?>login/logout">Logout</a></div>
                        <div class="chat-num-messages"><small>Last Login: <?php echo isset($lastlogin) ? $lastlogin : '';?></small></div>
                    </div>
            </div>             
            </div>
        </div>
    </div>