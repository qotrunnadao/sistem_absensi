function get_bulan(id)
{
  var quart={
      '01':'Januari',
      '02':'Februari',
      '03':'Maret',
      '04':'April',
      '05':'Mei',
      '06':'Juni',
      '07':'Juli',
      '08':'Agustus',
      '09':'September',
      '10':'Oktober',
      '11':'November',
      '12':'Desember'
    };
  
  return quart[id];

}

function get_option(schema_ctrl,select_id,id=null,keyval=false)
{
    // console.log('tes');

    var url=site_url+"/"+schema_ctrl;
    select_id=select_id.replace('[','\\[');
    select_id=select_id.replace(']','\\]');

    
    $.ajax({
      type: "GET",
      url: url,
      dataType: "json",

      success: function(hasil){
        //
        $(select_id).children('option:not(:first)').remove();

        // console.log(hasil);
        $.each(hasil, function(key, value){
            
            if(id==key)
            {
                //
                if(keyval==true)
                {
                    $(select_id).append('<option  value="'+key+'"  selected>'+key+" - "+value+'</<option>');
                }else{
                    $(select_id).append('<option value="'+key+'"  selected>'+value+'</<option>');
                }
            }else{
                //
                if(keyval==true)
                {
                    $(select_id).append('<option value="'+key+'" >'+key+" - "+value+'</<option>');    
                }else{
                    $(select_id).append('<option value="'+key+'" >'+value+'</<option>');
                }
                
            }
        
        });
      }
        
    });
}


function get_option_server_side(schema_ctrl,select_id,value=null,keyval=false,placeholder=null)
{
    select_id=select_id.replace('[','\\[');
    select_id=select_id.replace(']','\\]');
    
    var id_option='';
    var val_option='- Pilih -';
    if(value!=null){
    
      if(value['id']!=null && value['label']!=null)
      {
        id_option=value['id'];
        if(keyval==false)
        {
          val_option=value['label'];  
        }else{
          val_option=value['id']+' - '+value['label'];
        }
        

      }      
      
    }

    $(function(){
          $(select_id).children('option').remove();


          option = new Option(val_option, id_option, true, true);
          option.selected = true;
          $(select_id).append(option);
          
          
          $(select_id).select2({
            
            
            minimumInputLength: 3,
            placeholder: placeholder,
            allowClear: false,
          
            ajax: {
              dataType: 'json',
              url: site_url+'/'+schema_ctrl,
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function(data) {
                // console.log(data);
                var results=[];
                $.each(data, function(index, item) {
                  if(keyval==false){
                    results.push({
                      id: index,
                      text: item
                    });
                  }else{
                    results.push({
                      id: index,
                      text: index+' - '+item
                    });
                  }
                  
                });
                return {
                  results: results
                };

              },
            }
          });


    });
}

function get_multi_option_server_side(schema_ctrl,fungsi,select_id,value=null,keyval=false,placeholder=null)
{
  
    select_id=select_id.replace('[','\\[');
    select_id=select_id.replace(']','\\]');
    
    var id_option='';
    var val_option='- Pilih -';
    if(value!=null){
    

      if(value['id']!=null && value['label']!=null)
      {
        id_option=value['id'];
        val_option=value['label'];
      }      
      
    }

    $(function(){
          $(select_id).children('option').remove();

          if (value!=null) {

            $.each(value,function(key,val){
              if(val.id!='')
              {
                option = new Option(val.label, val.id, true, true);
              
                $(select_id).append(option);    
              }

            });
              
          }

          
          
          $(select_id).select2({
            
            
            minimumInputLength: 3,
            placeholder: placeholder,
            allowClear: false,
          
            ajax: {
              dataType: 'json',
              url: site_url+schema_ctrl+'/'+fungsi,
              delay: 800,
              data: function(params) {
                return {
                  search: params.term
                }
              },
              processResults: function(data) {
                // console.log(data);
                var results=[];
                $.each(data, function(index, item) {
                  if(keyval==false){
                    results.push({
                      id: index,
                      text: item
                    });
                  }else{
                    results.push({
                      id: index,
                      text: index+' - '+item
                    });
                  }
                  
                });
                return {
                  results: results
                };

              },
            }
          });
          

    });
}

function formatMoney(amount, decimalCount = 2, decimal = ",", thousands = ".") {
  try {
    decimalCount = Math.abs(decimalCount);
    decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

    const negativeSign = amount < 0 ? "-" : "";

    let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
    let j = (i.length > 3) ? i.length % 3 : 0;

    return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
  } catch (e) {
    console.log(e)
  }
};

String.prototype.replaceAll = function(str1, str2, ignore) 
{
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
}

//function by irving 

function addDay(date1, day){  

  var date = new Date(date1);
  var newdate = new Date(date);

  newdate.setDate(newdate.getDate() + parseInt(day,10));
  
  var dd = ('0' + newdate.getDate()).slice(-2);
  var mm = ('0' + (newdate.getMonth()+1)).slice(-2);
  var y = newdate.getFullYear();

  var someFormattedDate = y + '-' + mm + '-' + dd;
  return someFormattedDate;
  
}

function addWeek(date1, _week){  

  var date = new Date(date1);
  var newdate = new Date(date);
  var total_weeks = parseInt(_week,10) * 7;
  newdate.setDate(newdate.getDate() + total_weeks);
  
  var dd = ('0' + newdate.getDate()).slice(-2);
  var mm = ('0' + (newdate.getMonth()+1)).slice(-2);
  var y = newdate.getFullYear();

  var someFormattedDate = y + '-' + mm + '-' + dd;
  return someFormattedDate;
  
}

function addMonth(date1, _month){  

  var date = moment(date1);
  var futureMonth = moment(date).add(_month, 'M');
  var futureMonthEnd = moment(futureMonth).endOf('month');

  if(date.date() != futureMonth.date() && futureMonth.isSame(futureMonthEnd.format('YYYY-MM-DD'))) {
      futureMonth = futureMonth.add(1, 'd');
  }
  
  return futureMonth.format('YYYY-MM-DD');
}

function last_dayof_month(){
  var date = new Date();
  const endOfMonth  = moment(date).endOf('month').format('YYYY-MM-DD');  
  return endOfMonth;
}



