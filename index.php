<?php
    include 'Calculate.php';
    $calculate = new Calculate();

    $results = NULL;
    if(isset($_POST['submit'])) {
        $results = $calculate->postData($_POST);
    }

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Witch Saga</title>

        <link rel="stylesheet" href="/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="display-4">Geekseat Witch Saga</h1>
                    <p class="lead">Return of The Coder!</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    Input Data
                </div>
                <div class="card-body">
                    <form action="index.php" method="POST">
                        <h5> Person 1</h5>
                        <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label">Age of death</label>
                            <div class="col-sm-10">
                                <input type="number" name="person[0][age]" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label">Year of death</label>
                            <div class="col-sm-10">
                                <input type="number" name="person[0][death]" class="form-control" required>
                            </div>
                        </div>
                        <h5> Person 2</h5>
                        <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label">Age of death</label>
                            <div class="col-sm-10">
                                <input type="number" name="person[1][age]" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="colFormLabelLg" class="col-sm-2 col-form-label">Year of death</label>
                            <div class="col-sm-10">
                                <input type="number" name="person[1][death]" class="form-control" required>
                            </div>
                        </div>
                        <hr>
                        <input type="submit" name="submit" value="Submit" class="btn btn-primary float-right">
                    </form>
                </div>
            </div>
            <?php if(isset($_POST['submit'])) { ?>
            <hr>
            <div class="card">
                <div class="card-header">
                    Result
                </div>
                <div class="card-body">

                    <?php if ($results['status']) { ?>

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th>Person</th>
                                    <th>Age of death</th>
                                    <th>Year of death</th>
                                    <th>Born on year</th>
                                    <th>People killed on year</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results['person'] as $key=>$result) { ?>

                                    <tr>
                                        <td>Person <?php echo $key+1 ?></td>
                                        <td><?php echo $result['age'] ?></td>
                                        <td><?php echo $result['death'] ?></td>
                                        <td><?php echo $result['born'] ?></td>
                                        <td><?php echo $result['tempKilled'] ?> = <?php echo $result['killed'] ?></td>
                                    </tr>

                                <?php } ?>
                            </tbody>
                        </table>

                        <div class="alert alert-info" role="alert">
                            <h4>The average is: <?php echo $results['average'] ?></h4>
                        </div>
                    </div>

                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                            <h4><?php echo $results['message'] ?></h4>
                            <h5>Result: <?php echo $results['average'] ?></h5>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </body>
</html>