<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Basic Card Example</h6>
        <div class="float-right">
            <a href="#" class="btn btn-primary btn-sm"><?=_ADD?></a>
        </div>
    </div>
    <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center"><?=_NAME_LASTNAME?></th>
                        <th class="text-center"><?=_EMAIL?></th>
                        <th class="text-center"><?=_USERNAME?></th>
                        <th class="text-center"><?=_ACTIVE?></th>
                        <th class="text-center"><?=_ACTIONS?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getUsers = $dbi->get('users');
                    
                    foreach($getUsers as $key => $user)
                    {
                        ?>
                        <tr>
                            <td class="text-center"><?=$key + 1?></td>
                            <td class="text-center"><?=$user["name"] . " " . $user["lastName"]?></td>
                            <td class="text-center"><?=$user["email"]?></td>
                            <td class="text-center"><?=$user["userName"]?></td>
                            <td class="text-center"><?=$user["active"]?></td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="actions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?=_ACTIONS?>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right animated--fade-in" aria-labelledby="actions">
                                        <a class="dropdown-item text-warning" href="#"><i class="fa fa-edit fa-fw"></i> <?=_EDIT?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item text-danger" href="#"><i class="fa fa-trash fa-fw"></i> <?=_DELETE?></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
    </div>
</div>