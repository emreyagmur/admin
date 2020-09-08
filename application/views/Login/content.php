<style>
    .hidden {
        display: none;
    }
    .message {
        margin-top: 5px;
        padding: 5px;
        font-size: 14px;
        height: 31px;
    }
</style>
<div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Admin Login</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="username" id="username" aria-describedby="emailHelp" placeholder="<?=_USERNAME?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="<?=_PASSWORD?>">
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck"><?=_REMEMBER_ME?></label>
                                    </div>
                                </div>
                                <a href="#" class="btn btn-primary btn-user btn-block btn-login">
                                    <?=_LOGIN?>
                                </a>
                                
                                <div class="message text-center">
                                    <span class="text-danger hidden alert-message"></span>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    
    $(function(){
        
        $(".btn-login").off("click").on("click", function(e){
            
            e.preventDefault();
            
            var username = $("#username").val();
            var password = $("#password").val();
            
            if(username == "")
            {
                $(".alert-message").removeClass("hidden");
                $(".alert-message").html("<?=_ENTER_USERNAME?>");
                setTimeout(function(){
                    $(".alert-message").html("");
                    $(".alert-message").addClass("hidden"); 
                }, 3000);
            }
            else if(password == "")
            {
                $(".alert-message").removeClass("hidden");
                $(".alert-message").html("<?=_ENTER_PASSWORD?>");
                setTimeout(function(){
                    $(".alert-message").html("");
                    $(".alert-message").addClass("hidden"); 
                }, 3000);
            }
            else
            {
                $.ajax({
                    type: "POST",
                    url: '<?=base_url("userop/makeLogin")?>',
                    data: { "username":username, "password": password  },
                    cache: false,
                    beforeSend: function() {
                        $(".btn-login").html('<i class="fa fa-spinner fa-spin"></i> <?=_PROCESSING?>');    
                    },
                    success: function(data) {
                        data = $.parseJSON(data);
                        if(data.message.success)
                        {
                            $(".btn-login").html('<i class="fa fa-spinner fa-spin"></i> <?=_LOGIN_SUCCESS?>');
                            window.location.href = '<?=base_url()?>';  
                        }
                        else
                        {
                            $(".btn-login").html('<?=_LOGIN?>');
                            $(".alert-message").removeClass("hidden");
                            $(".alert-message").html(data.message.error);
                            setTimeout(function(){
                                $(".alert-message").html("");
                                $(".alert-message").addClass("hidden"); 
                            }, 3000);    
                        }
                        
                    }
                });
            }
            
        });
        
    });

</script>

