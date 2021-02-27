<section class="content">
<?php $this->load->view($header_view);?>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                        <ul class="nav nav-tabs pl-0 pr-0">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#list_view"><i class="zmdi zmdi-view-carousel"></i> Cardbase </a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#grid_view"><i class="zmdi zmdi-view-dashboard"></i> Cardless</a></li>
                        </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="list_view">
                        <div class="container-fluid">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon allterminal">
                                        <div class="body l-purple">
                                            <h6 style="color:black">ALL TERMINAL</h6>
                                            <h2 style="color:black"><?php echo $all_terminal; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon offline">
                                        <div class="body l-offline">
                                            <h6 style="color:black">OFFLINE</h6>
                                            <h2 style="color:black"><?php echo $offline; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>offline/detail" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon tutup">
                                        <div class="body l-blush">
                                            <h6 style="color:black">CLOSE</h6>
                                            <h2 style="color:black"><?php echo $close; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon inservice">
                                        <div class="body l-green">
                                            <h6 style="color:black">IN SERVICE</h6>
                                            <h2 style="color:black"><?php echo $inservice; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon cardretain">
                                        <div class="body l-blue">
                                            <h6 style="color:black">CARD RETAIN</h6>
                                            <h2 style="color:black"><?php echo $cardretain; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon saldomin">
                                        <div class="body l-amber">
                                            <h6 style="color:black">SALDO < 2 MILLION</h6>
                                            <h2 style="color:black"><?php echo $saldomin; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon tranidle">
                                        <div class="body l-khaki">
                                            <h6 style="color:black">TRAN IDLE</h6>
                                            <h2 style="color:black"><?php echo $tranidle; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                    <div class="card widget_2 big_icon faulty">
                                        <div class="body l-cyan">
                                            <h6 style="color:black">FAULTY</h6>
                                            <h2 style="color:black"><?php echo $faulty; ?></h2>
                                            <hr/>
                                            <a href="<?php echo base_url();?>terminalcardbase/terminal_monitor" style="color:white"><small>Details</small></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="tab-pane file_manager" id="grid_view">
                        <div class="container-fluid">
                            <div class="row clearfix">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon allterminal">
                                        <div class="body xl-blue">
                                            <h4 class="mt-0 mb-0"><?php echo $all_terminal_crm; ?></h4>
                                            <p class="mb-0">All Terminal</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon offline">
                                        <div class="body xl-blush">
                                            <h4 class="mt-0 mb-0"><?php echo $offline_crm; ?></h4>
                                            <p class="mb-0">Off-line</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon tutup">
                                        <div class="body xl-amber">
                                            <h4 class="mt-0 mb-0"><?php echo $close_crm; ?></h4>
                                            <p class="mb-0">Closed</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon inservice">
                                        <div class="body xl-green">
                                            <h4 class="mt-0 mb-0"><?php echo $inservice_crm; ?></h4>
                                            <p class="mb-0">In Service</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon cardretain">
                                        <div class="body xl-cyan">
                                            <h4 class="mt-0 mb-0"><?php echo $cardretain_crm; ?></h4>
                                            <p class="mb-0">Card Retain</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon saldomin">
                                        <div class="body xl-purple">
                                            <h4 class="mt-0 mb-0"><?php echo $saldomin_crm; ?></h4>
                                            <p class="mb-0">Saldo Min 2 Million</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon tranidle">
                                        <div class="body xl-pink">
                                            <h4 class="mt-0 mb-0"><?php echo $tranidle_crm; ?></h4>
                                            <p class="mb-0">Trand Idle</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-3 col-md-6">
                                    <div class="card big_icon faulty">
                                        <div class="body xl-khaki">
                                            <h4 class="mt-0 mb-0"><?php echo $faulty_crm; ?></h4>
                                            <p class="mb-0">Faulty</p> 
                                            <hr/>
                                            <a href="#" style="color:white"><small>Details</small></a>                       
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