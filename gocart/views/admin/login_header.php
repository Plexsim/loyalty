<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Go Cart<?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>


<link type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" />
<link href="<?php echo base_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet" />    
    
<link type="text/css" href="<?php echo base_url('assets/css/animate.css');?>" rel="stylesheet" />
<link type="text/css" href="<?php echo base_url('assets/css/style.css');?>" rel="stylesheet" />


</head>
<body class="gray-bg">


<?php if(!empty($page_title)):?>
    <div class="page-header">
        <h1><?php echo  $page_title; ?></h1>
    </div>
    <?php endif;?>

<div class="container">
    <?php
    //lets have the flashdata overright "$message" if it exists
    if($this->session->flashdata('message'))
    {
        $message    = $this->session->flashdata('message');
    }
    
    if($this->session->flashdata('error'))
    {
        $error  = $this->session->flashdata('error');
    }
    
    if(function_exists('validation_errors') && validation_errors() != '')
    {
        $error  = validation_errors();
    }
    ?>
    
    <div id="js_error_container" class="alert alert-error" style="display:none;"> 
        <p id="js_error"></p>
    </div>
    
    <div id="js_note_container" class="alert alert-note" style="display:none;">
        
    </div>
    
    <?php if (!empty($message)): ?>
        <div class="alert alert-success">
            <a class="close" data-dismiss="alert">X</a>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-error">
            <a class="close" data-dismiss="alert">X</a>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
</div>      


    
    

