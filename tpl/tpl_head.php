<head>
    <title><?=title_web?></title>
    <base href="<?=dir?>" />  
    <link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href='//fonts.googleapis.com/css?family=Playball' rel='stylesheet' type='text/css'>
    <!--slider-->
    <script src="js/jquery.min.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="administrator/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
    tinymce.init({selector: "textarea.tinymce", 
    fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
    theme: "modern",
    entity_encoding : "raw",
    height: 300, 
    menubar:false,
    statusbar:false,
    subfolder:"", 
    plugins: [ 
    "advlist autolink link image lists charmap print preview hr anchor pagebreak", 
    "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
    "table contextmenu directionality emoticons paste textcolor filemanager" 
    ], 
    image_advtab: true, 
    toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link unlink | image media | code | fontselect |  fontsizeselect" 
    });
    </script>
</head>