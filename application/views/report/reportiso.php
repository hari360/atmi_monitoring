<section class="content">

<?php 
            $flashmessage = $this->session->flashdata('messageinsertflm'); 
            if (isset($flashmessage)) { 
          ?>
            <div class="alert alert-success" >
                <strong>Well done!</strong> FLM Has Been Submit Succesfully
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <?php } ?>

<?php $this->load->view($header_view);?>
    <!-- <div class="block-header">
        <div class="row">
            <div class="col-lg-7 col-md-6 col-sm-12">
                <h2>Monitoring</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i> Terminal</a></li>
                    <li class="breadcrumb-item active">Cardbase</li>
                </ul>
                <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
            </div>
        </div>
    </div>   -->
        
    <!-- <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><strong>Terminal Monitoring</strong> Cardless </h2>
                </div>
                <div class="body">
                    <div class="table-responsive" style="font-size: 12px;font-family:Arial, Helvetica, sans-serif">
                    <?php echo ! empty($table) ? $table : '';?>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                        <ul class="nav nav-tabs pl-0 pr-0">
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_generate">Generate Report</a></li>
                            <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#tab_card_retain">Card Retain</a></li> -->
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#tab_upload">Upload Raw Terminal</a></li>
                        </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="tab_generate">
                        <div class="container-fluid">
                            <div class="row clearfix">

                            <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="header">
                            <!-- <h2><strong>Color</strong> Pickers</h2> -->
                            
                        </div>
                        <div class="body">
                            <!-- <p>Taken from <a href="https://github.com/mjolnic/bootstrap-colorpicker/" target="_blank">github.com/mjolnic/bootstrap-colorpicker</a></p> -->
                            <div class="row clearfix">
                            <?php
                                $attributes = array('name' => 'report_iso_frm'
                                                    ,'id' => 'formiso'
                                                    ,'autocomplete' => 'off'
                                                    ,'enctype' => 'multipart/form-data'
                                                    ,'class' => 'card auth_form');
                                echo form_open('reportiso/pdf', $attributes);
                            ?>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Bsndate</label>
                                        <div class="input-group colorpicker">
                                        <select class="form-control show-tick ms select2" data-placeholder="Select">
                                            <option></option>
                                            <option>20210305</option>
                                            <option>20210306</option>
                                            <option>20210307</option>
                                        </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label>Terminal Name</label>
                                        <div class="input-group colorpicker">
                                            <select class="form-control show-tick ms select2" data-placeholder="Select">
                                                <option></option>
                                                <option>ATM Pasar Klender</option>
                                                <option>ATM Alfamart Karawang</option>
                                                <option>ATM Indomaret Depok</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                <button id="" type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Submit</button>
                                </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                                
                            </div>
                        </div>
                    </div>

                    <!-- <div class="tab-pane file_manager" id="tab_card_retain">
                        <div class="container-fluid">
                            <div class="row clearfix">

                            </div> 
                        </div>
                    </div> -->
                    <div class="tab-pane active" id="tab_upload">
                    <div class="container-fluid">
            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <!-- <div class="alert alert-warning" role="alert">
                        <strong>Bootstrap</strong> Better check yourself, <a target="_blank" href="https://getbootstrap.com/docs/4.2/components/forms/">View More</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"><i class="zmdi zmdi-close"></i></span>
                        </button>
                    </div> -->
                    <div class="card">
                        <div class="header">
                            <!-- <h2><strong>Vertical</strong> Layout</h2> -->
                            <!-- <ul class="header-dropdown">
                                <li class="dropdown"> <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="zmdi zmdi-more"></i> </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                                <li class="remove">
                                    <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <!-- <form method="POST" action="" id="uploadForm" enctype="multipart/form-data"> -->
                            <?php
                                $attributes = array('name' => 'login_form'
                                                    ,'id' => 'formupload'
                                                    ,'autocomplete' => 'off'
                                                    ,'enctype' => 'multipart/form-data'
                                                    ,'class' => 'card auth_form');
                                echo form_open('reportiso/upload_files', $attributes);
                            ?>
                                <input type="hidden" name="id_upload" id="v_id_upload">
                                <label for="email_address">Only files with extension csv</label>
                                <div class="form-group">                                
                                    <input type="file" name="file_csv[]" id="fileInput" class="form-control" multiple required>
                                    <div class="progress m-b-5">
                                        <div id="v_progress" class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 0%"> <span class="sr-only">40% Complete (success)</span> </div>
                                    </div>
                                </div>
                                <!-- <label for="password">Password</label>
                                <div class="form-group">                                
                                    <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                </div> -->
                                <!-- <div class="checkbox">
                                    <input id="remember_me" type="checkbox">
                                    <label for="remember_me">
                                            Remember Me
                                    </label>
                                </div> -->
                                <button id="btn_upload_csv" type="submit" class="btn btn-raised btn-primary btn-round waves-effect">Upload Files</button>
                                <button id="btn_show_table" type="button" class="btn btn-raised btn-primary btn-round waves-effect">Clear</button> 
                            </form>
                            <div id="alert_upload">
                                <p>Success</p>
                                <ul id="succes_notif">
                                    <!-- <li>test</li>
                                    <li>test</li>
                                    <li>test</li> -->
                                </ul>
                                <p>Failed</p>
                                <ul id="failed_notif"></ul>
                            </div>

                            <div class="table-responsive" style="font-size: 12px;font-family:Arial, Helvetica, sans-serif">

                            <table class="table table-bordered table-striped table-hover nowrap" id="item-list" width="100%" style="font-size: 12px;font-family:Arial, Helvetica, sans-serif">
                            <!-- <table id="item-list" class="table table-bordered table-striped table-hover"> -->
                                <thead>
                                    <tr>
                                        <th>Terminal ID</th>
                                        <th>Terminal Name</th>
                                        <th>Terminal City</th>
                                        <th>Location</th>
                                        <th>Date Insert</th>
                                        <th>Status Upload</th> 
                                        <th>User Upload</th>
                                        <th>File Name</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>


                                </tbody>
                            </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>


<style>
#succes_notif {
  list-style-image: url('<?php echo base_url();?>assets/images/checklist.png');
}
#failed_notif {
  list-style-image: url('<?php echo base_url();?>assets/images/failed_upload.png');
}
</style>


