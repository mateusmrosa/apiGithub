<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo TITLESITE; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <table class="table table-striped table-responsive">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>URL</th>
                            <th>Stargazers Count</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($viewVar['repositories'] as $repository) { ?>
                            <tr>
                                <td><?php echo $repository['name']; ?></td>
                                <td><?php echo $repository['description']; ?></td>
                                <td><a href="<?php echo $repository['url']; ?>"><?php echo $repository['url']; ?></a></td>
                                <td><?php echo $repository['stargazers_count']; ?></td>
                                <td><?php echo \App\Util\Funcoes::formatarDataBR($repository['created_at']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>