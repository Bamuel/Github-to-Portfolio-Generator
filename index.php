<?php
//https://api.github.com/users/Bamuel/repos
$GitHubusername = "Bamuel";

?>
<?php
$url = "https://api.github.com/users/" . $GitHubusername . "/repos";

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/vnd.github.v3+json",
    "Content-Type: text/plain",
    "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 YaBrowser/16.3.0.7146 Yowser/2.5 Safari/537.36"
));
curl_setopt($ch, CURLOPT_HTTPGET, true);
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$queryresult = json_decode($result, true);

$queryresultcount = count($queryresult);//number of projects

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="<?php echo $GitHubusername ?>">
    <title><?php echo $GitHubusername ?> PROJECTS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css"/>
</head>

<body>
<div class="container">
    <!-- Page Heading -->
    <h1 class="my-4"><?php echo $GitHubusername ?>
        <small>Projects</small>
    </h1>
    <div class="row">
        <?php
        for ($x = 0; $x <= $queryresultcount - 1; $x++) {
            if ($queryresult[$x]['fork'] == 1) {
                $fork = "<img src=\"repo-forked.svg\" alt=\"github fork symbol\"> project been forked";
            } else {
                $fork = "";
            }

            echo "
<div class=\"col-lg-4 col-sm-6 portfolio-item\">
            <div class=\"card h-100\">
                <div class=\"card-body\">
                    <h4 class=\"card-title\">
                        <a target='_blank' href=\"".$queryresult[$x]['html_url']."\">" . $queryresult[$x]['name'] . "</a><h6>$fork</h6>
                    </h4>
                    <p class=\"card-text\">" . $queryresult[$x]['description'] . "</p>
                </div>
            </div>
        </div>";
        }

        ?>

       <!-- <div class="col-lg-4 col-sm-6 portfolio-item">
            <div class="card h-100">
                <a href="#"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="#"><?php /*echo $queryresult[0]['name']; */ ?></a><h6> - Owner Bamuel</h6>
                    </h4>
                    <p class="card-text"><?php /*echo $queryresult[0]['description']; */?></p>
                </div>
            </div>
        </div>-->

    </div>
    <!-- /.row -->
</div>
<!-- /.container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>

