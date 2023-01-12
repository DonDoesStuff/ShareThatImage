<!DOCTYPE html>
<html>
<head>
    <title>ShareThatImage</title>
    <style>
        body {
            background-color: #36393f;
            font-family: 'Fancy Font', sans-serif;
        }
        input[type="submit"] {
            background-color: #7289da;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #5f73bc;
        }
        .download-btn {
            background-color: #7289da;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-right:10px;
        }
        .download-btn:hover {
            background-color: #5f73bc;
        }
        .copy-btn {
            background-color: #7289da;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .copy-btn:hover {
            background-color: #5f73bc;
        }
        .bar {
            position:absolute;
            top:50%;
            left:50%;
            
          
          translate(-50%,-50%);
            width:80%;
            height:4px;
            background:#acece6;
            overflow:hidden;
        }
        .bar div:before {
            content:"";
            position:absolute;
            top:0px;
            left:0px;
            bottom:0px;
            background:#26a69a;
            animation:box-1 2100ms cubic-bezier(0.65,0.81,0.73,0.4) infinite;
        }
        .bar div:after {
            content:"";
            position:absolute;
            top:0px;
            left:0px;
            bottom:0px;
            background:#26a69a;
            animation:box-2 2100ms cubic-bezier(0.16,0.84,0.44,1) infinite;
            animation-delay:1150ms;
        }
        @keyframes box-1 {
            0% {
                left:-35%;
                right:100%;
            }
            60%,100% {
                left:100%;
                right:-90%;
            }
        }
        @keyframes box-2 {
            0% {
                left:-200%;
                right:100%;
            }
            60%,100% {
                left:107%;
                right:-8%;
            }
        }
        .custom-file-upload {
            border: 1px solid #ccc;
            display: inline-block;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
            background-color: #7289da;
            color: white;
        }
        .custom-file-upload:hover {
            background-color: #5f73bc;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            if(isset($_FILES['image'])){
                $file = $_FILES['image'];
                $file_name = $file['name'];
                $file_tmp = $file['tmp_name'];
                $file_size = $file['size'];
                $file_error = $file['error'];

                if($file_size < 20971520){
                    if($file_error === 0){
                        $file_name_new = uniqid('', true) . '.' . explode('.', $file_name)[1];
                        $file_destination = 'uploads/' . $file_name_new;
                        if(move_uploaded_file($file_tmp, $file_destination)){
                            $now = time();
                            $expiration_time = $now + (7 * 24 * 60 * 60);
                            file_put_contents($file_destination.'.txt', $expiration_time);
                            $fileExpiration = file_get_contents($file_destination.'.txt');
                            if($fileExpiration < time()){
                                unlink($file_destination);
                                unlink($file_destination.'.txt');
                                echo 'File is expired';
                            }else{
                                echo '<div class="bar" style="display: block;"></div>';
                                echo '<script>setTimeout(function(){ document.querySelector(".bar").style.display = "none"; }, 450);</script>';
                                echo '<center><a href="' . $file_destination . '" class="download-btn" download>Download</a></center>';
                                echo '<br></br>';
                                echo '<br></br>';
                            }
                        }
                    }
                }
            }
        }
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="document.querySelector('.bar').style.display = 'block'; setTimeout(function(){ document.querySelector('.bar').style.display = 'none'; }, 4000);">
        <center><label for="image" class="custom-file-upload">Choose file</label>
        <input type="file" name="image" id="image" style="display: none;">
          <input type="submit" name="submit" value="Upload"></center>
    </form>
</body>
</html>
<br></br>
<br></br>
<center><iframe src="http://ads.xeryiar.gq" style="border:0px #ffffff none;" name="myiFrame" scrolling="no" frameborder="0" marginheight="0px" marginwidth="0px" height="100px" width="400px" allowfullscreen></iframe></center> // You can remove this if you want
<html>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous">
    <style>
        button#view-source {
            font-size: 12px;
            text-align: center;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            margin: auto;
            padding: 8px 16px;
            background-color: #262626;
            color: white;
            border: none;
            border-radius: 4px;
            transition: all 0.2s ease-in-out;
        }

        #view-source:active {
            transform: scale(0.95);
        }

        #view-source .fa {
            font-size: 14px;
            margin-left: 5px;
            color: white;
        }
    </style>
</head>
<body>
    <button id="view-source" target="_blank">View source <i class="fa fa-github"></i></button>
    <script>
        // Add event listener to the "View source" button
        document.getElementById("view-source").addEventListener("click", function() {
            // Redirect to GitHub repository
            window.open("https://github.com/lgamerlive/ShareThatImage/", "_blank");
        });
    </script>
</body>
</html>
