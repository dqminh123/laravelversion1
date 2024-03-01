// npm package: ace-builds (Ajax.org Cloud9 Editor)
// github link: https://github.com/ajaxorg/ace-builds

$(function() {
    'use strict';
  
    var HT = {};

    //lấy vị trí
    HT.getLocation = () => {
        $(document).on('change', '.location', function () {
           let _this = $(this)
           let province_id = _this.val()
           let option = {
                'data' : {
                    'location_id': _this.val(), 
                },
                'target' : _this.attr('data-target')
            }
            HT.SendDataTogetLocation(option);
        
        });
    }
    // gửi vị trí và load lại vị trí cũ khi load
    HT.SendDataTogetLocation = (option) =>{
        let url = "http://localhost/laravelversion1.com/ajax/location/getLocation";
        $.ajax({
            url: url,
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function (res) {
                $('.'+option.target).html(res.html)

                if(district_id != '' && option.target == 'districts'){
                    $('.districts').val(district_id).trigger('change');
                }
                if(ward_id != '' && option.target == 'wards'){
                    $(".wards").val(ward_id).trigger('change');
                }
            },
          });
    }

    //load thành phố
    HT.loadcity = () => {
        if(province_id != ''){
            $(".province").val(province_id).trigger('change');
        }
    }

    $(document).ready(function () {
        HT.getLocation();
        HT.loadcity();
    });
  
  });