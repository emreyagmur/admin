<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Dashboard</title>
    
    <link href="<?=base_url()?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link href="<?=base_url()?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <script src="<?=base_url()?>assets/vendor/jquery/jquery.min.js"></script>
    <script src="<?=base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="<?=base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    
</head>

<body id="page-top">
    
    <div id="wrapper">
        
        <?php $this->load->view("leftbar"); ?>
        
        <div id="content-wrapper" class="d-flex flex-column">
            
            <div id="content">
            
                <?php $this->load->view("navbar"); ?>
                
                <div class="container-fluid">
                
                    <?php $this->load->view("{$viewFolder}/content"); ?>
                    
                </div>
                
            </div>
            
            <?php $this->load->view("footer"); ?>
            
        </div>    
        
    </div>
    
    <script src="<?=base_url()?>assets/js/sb-admin-2.min.js"></script>
    
</body>

</html>    
