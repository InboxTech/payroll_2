    /* Only Numbers */
    $('.only_numbers').keyup(function(e)
    {
        if (/\D/g.test(this.value))
        {
            // Filter non-digits from input value.
            this.value = this.value.replace(/\D/g, '');
        }
    });

    /* Float Number */
    $(".float_numbers").keyup(function() {
        var $this = $(this);
        $this.val($this.val().replace(/[^\d.]/g, ''));
    });

    // Change Status 
    $(document).on('change', '.jsStatus', function(){
        var status_id = $(this).val();
        var status = 0;
        
        if($(this).is(":checked")) {
            status=1;
        }

        $.ajax({
            url:status_url,
            method:"post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data:{status_id:status_id,status:status},
            success:function(data){
                if (data.status==true) {
                    var success_html=SUCCESS_MESSAGE;
                    $(".jsFlashMessage").html(success_html.replace("FLASH_MESSAGE", data.message));

                    if ($("html, body").animate({ scrollTop: 0 }, "slow")) {
                        setTimeout(function() { $('.alert').alert('close'); }, 5000);
                    }
                }
                else
                {
                    var error_html=ERROR_MESSAGE;
                    $(".jsFlashMessage").html(error_html.replace("FLASH_MESSAGE", data.message));
                    if ($("html, body").animate({ scrollTop: 0 }, "slow")) {
                        setTimeout(function() { $('.alert').alert('close'); }, 5000);
                    }
                }
            }
        });
    });
    
    /* All Chechkbox Check */
    $('.jsCheckAll').on('change', function(){
        $('.jsCheckBoxes:checkbox').prop('checked', $(this).prop('checked'));
    });

    $(document).on('change', '.jsCheckBoxes', function() {
        if ($(this).is(':checked'))
        {
            if ($('.jsCheckBoxes:checked').length == $('.jsCheckBoxes').length)
            {
                $('.jsCheckAll').prop('checked', true);
            }
            else
            {
                $('.jsCheckAll').prop('checked', false);
            }
        }
        else
        {
            $('.jsCheckAll').prop('checked', false);
        }
    });

    //================= MULTIPLE DELETE START=================//
    $(document).on('click','.delete_records',function(){
        var data_id=[];

        $('.jsCheckBoxes').each(function(){
            if ($(this).is(":checked")) {
                data_id.push($(this).val());
            }
        });

        if (data_id.length > 0)
        {
            if (confirm("are you sure you want to delete record ?")) {
                $.ajax({
                    url:delete_url,
                    method:"POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data:{data_id:JSON.stringify(data_id)},
                    success:function(data){
                        table_id.DataTable().ajax.reload();
                        if (data.status==true)
                        {
                            var success_html=ERROR_MESSAGE;
                            $(".jsFlashMessage").html(success_html.replace("FLASH_MESSAGE", data.message));

                            if ($("html, body").animate({ scrollTop: 0 }, "slow"))
                            {
                                setTimeout(function() { $('.alert').alert('close'); }, 5000);
                            }
                        }
                        else
                        {
                            var error_html=ERROR_MESSAGE;
                            $(".jsFlashMessage").html(error_html.replace("FLASH_MESSAGE", data.message));

                            if ($("html, body").animate({ scrollTop: 0 }, "slow"))
                            {
                                setTimeout(function() { $('.alert').alert('close'); }, 5000);
                            }
                        }
                    }
                });
            }
        }
        else
        {
            var error_html=ERROR_MESSAGE;

            $(".flash_messages").html(error_html.replace("FLASH_MESSAGE", "Please select at least one record"));

            if ($("html, body").animate({ scrollTop: 0 }, "slow")) {
                setTimeout(function() { $('.alert').alert('close'); }, 5000);
            }

            return false;
        }
    });
    //================= MULTIPLE DELETE END=================//
    