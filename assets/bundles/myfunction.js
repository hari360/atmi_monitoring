function myFunction() {
  var x = document.getElementById("v_pass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}

function add_person(value_this,prm1,prm2){
    pValueThis = value_this;
    pTerminalID = prm1;
    $("#sVendor").empty();
    if(value_this=='SLM'){
      $('#sVendor').append('<option value=\'\'>Select Vendor</option>');
      $('#sVendor').append('<option value="1. NCR">1. NCR</option>');
      $('#sVendor').append('<option value="2. Telkomsel">2. Telkomsel</option>');
    }else{
      $('#sVendor').append('<option value=\'\'>Select Vendor</option>');
      $('#sVendor').append('<option value="1. CMS">1. CMS</option>');
      $('#sVendor').append('<option value="2. Gedung">2. Gedung</option>');
    }

    if(prm2=='Modify' && (value_this=='FLM' || value_this=='SLM')){
      // alert(pTerminalID);
      get_data_flm_slm(pTerminalID.split("|",1));
    }

    save_method = 'add';
    pTerminalID = prm1;
    pStatusFlm = prm2;
    $('#form')[0].reset(); 
    $('#modal_form').modal('show');
    $('.modal-title').text(value_this + " (Terminal ID : " + pTerminalID.split("|",1) + ")"); 
}

function get_data_flm_slm(terminal_id){
  var url = baseURL + "terminalcardbase/ajax_get_data_flm_slm";
  var datapost = {
      term_id: terminal_id,
  };
	
  $.getJSON( url, datapost )
      .done(function( data ) {
        $.each(data, function(index, element) {		
            $('[name="txtdescription"]').val(element.description);
            $('[name="txtdatetime"]').val(element.date_time_problem);
            $('[name="cmbProblem"]').val(element.atmi_problem);
            $('[id="sVendor"]').val(element.vendor);
          });
      })
      .fail(function( jqxhr, textStatus, error ) {
        var err = textStatus + ", " + error;
        alert( "Request Failed: " + err );
  });
}

function save(){

    var myVariable;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'html',
        'url': baseURL + "terminalcardbase/get_datetime_server",
        'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
        'success': function (data) {
            myVariable = data;
        }
    });

    var pDateInsert = myVariable;
    var url;
    var $form = $('form');
    var data = {
      'foo' : 'bar'
    };

    if(pStatusFlm == 'Submit') 
    {
        url = baseURL + "terminalcardbase/ajax_add";
    }
    else
    {
        url = baseURL + "terminalcardbase/ajax_update";
    }
    
    sUsrLogin = $("#usrLogin").html();
    sProblem = $("#sProblem option:selected").val();
    sVendor = $("#sVendor option:selected").val();
    data = $form.serialize() + '&' + $.param({ ajaxTerminalID:pTerminalID, ajaxProblem:sProblem, 
                                                ajaxVendor:sVendor, ajaxUser:sUsrLogin, 
                                                ajaxStatusFLM_SLM:pStatusFlm,ajaxDateInsert:pDateInsert, ajaxTable:pValueThis});
    $.ajax({
        url : url,
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function(data)
        {
            $('#modal_form').modal('hide');
            location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');               
        }
    });
}

var v_global_1 = '';
var v_global_2 = '';

function format() {
  return '<table border="1" >' +
              '<tr style="background-color:#DCDCDC;color:black;">' +
                  '<th style="width:50px;padding-left:10px;font-weight:bold" >Event ID</th>' +
                  '<th style="width:300px;padding-left:10px;font-weight:bold" >Data Time</th>' +
                  '<th style="width:800px;padding-left:10px;font-weight:bold" >Description</th>' +
              '</tr>' +               
              v_global_1 +
          '</table>';       
}

$(document).ready(function(){

  // $( "#dup_datetimepick" ).keyup(function() {

  //   $(".datetimepicker").val($( "#dup_datetimepick" ).val());
  //   // alert( "Handler for .change() called." );
  // });

  // $( ".datetimepicker" ).change(function() {

  //   $("#dup_datetimepick").val($( ".datetimepicker" ).val());
  //   // alert( "Handler for .change() called." );
  // });

  $("body").toggleClass("ls-toggle-menu");

  var table_cardbase = $('#dt_terminal_cardbase').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    // scrollY:        "350px",
  });

  var table_card_retain = $('#dt_card_retain_cardbase').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
    // scrollY:        "350px",
  });

  var table_count_trx_atm = $('#dt_count_trx_cardbase').DataTable({
    iDisplayLength:20,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
    // scrollY:        "350px",
  });

  var table_offline = $('#dt_offline').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_closed = $('#dt_closed').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_inservice = $('#dt_inservice').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_inservice = $('#dt_faulty').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_inservice = $('#dt_idle_term').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_inservice = $('#dt_saldo_min').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    columnDefs: [
      { width: '20%', targets: 0 }
    ],
    fixedColumns: true,
  });

  var table_cardbase = $('#dt_terminal_crm').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
    // scrollY:        "350px",
    // scrollX:        true,
  });

  var table = $('#dt_terminal_log').DataTable({
      iDisplayLength:100,
      paging: true, 
      info: true, 
      searching: true,
      // scrollY:        "350px",
  });

  $('#dt_terminal_log tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
    var html = '';
    var arr_offline = [];
    var arr_inservice = [];
    var datetime_offline = '';
    var datetime_inservice = '';
    var value_duration = '';
    v_global_1 = '';
    v_global_2 = '';

    if ( row.child.isShown() ) {
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
                 
        var v_terminal_id = $(this).attr("title");                      
        var v_url = baseURL + "log/ajax_get_history_offline/" + v_terminal_id; 
        $.ajax({
            url : v_url,
            type: "GET",
            async: false,
            dataType: "JSON",
            success: function(result)
            {            
                $.each(result, function (i, item) {  
                  v_global_1 += '<tr><td>'+item.event_id+'</td><td>'+item.date_time+'</td><td ' + (item.description_event == 'The ATM changed mode from In Service to Off-Line. ' ? 'style="color:red;font-weight:bold"' : (item.description_event == 'The ATM changed mode from Closed to In Service. ' ? 'style="color:green;font-weight:bold"' : '')) + '>'+item.description_event+'</td></tr>' ;
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error get data from ajax');
            }
        });      
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
  });



  var table = $('#dt_terminal_log_crm').DataTable({
    iDisplayLength:100,
    paging: true, 
    info: true, 
    searching: true,
});

$('#dt_terminal_log_crm tbody').on('click', 'td.details-control', function () {
  var tr = $(this).closest('tr');
  var row = table.row( tr );
  var html = '';
  var arr_offline = [];
  var arr_inservice = [];
  var datetime_offline = '';
  var datetime_inservice = '';
  var value_duration = '';
  v_global_1 = '';
  v_global_2 = '';

  if ( row.child.isShown() ) {
      row.child.hide();
      tr.removeClass('shown');
  }
  else {
               
      var v_terminal_id = $(this).attr("title");                      
      var v_url = baseURL + "log/ajax_get_history_offline_crm/" + v_terminal_id; 
      $.ajax({
          url : v_url,
          type: "GET",
          async: false,
          dataType: "JSON",
          success: function(result)
          {            
              $.each(result, function (i, item) {  
                v_global_1 += '<tr><td>'+item.event_id+'</td><td>'+item.date_time+'</td><td ' + (item.description_event == 'The ATM changed mode from In Service to Off-Line. ' ? 'style="color:red;font-weight:bold"' : (item.description_event == 'The ATM changed mode from Closed to In Service. ' ? 'style="color:green;font-weight:bold"' : '')) + '>'+item.description_event+'</td></tr>' ;
              });
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });      
      row.child( format(row.data()) ).show();
      tr.addClass('shown');
  }
});

});