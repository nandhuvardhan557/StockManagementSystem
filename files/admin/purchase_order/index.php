<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">List of Purchase Orders</h3>
        <div class="card-tools">
            <a href="<?php echo base_url ?>admin/?page=purchase_order/manage_po" class="btn btn-primary btn-flat"><span class="fas fa-plus"></span> Create New</a>
        </div>
    </div>
    <div class="card-body">
        <div class="container-fluid">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="20%">
                    <col width="20%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                </colgroup>
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Date Created</th>
                        <th>PO Code</th>
                        <th>Supplier</th>
                        <th>Items</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    $qry = $conn->query("SELECT p.*, s.name as supplier FROM `purchase_order_list` p inner join supplier_list s on p.supplier_id = s.id order by p.`date_created` desc");
                    while($row = $qry->fetch_assoc()):
                        $row['items'] = $conn->query("SELECT count(item_id) as `items` FROM `po_items` where po_id = '{$row['id']}' ")->fetch_assoc()['items'];
                    ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td><?php echo date("Y-m-d H:i", strtotime($row['date_created'])) ?></td>
                            <td><?php echo $row['po_code'] ?></td>
                            <td><?php echo $row['supplier'] ?></td>
                            <td class="text-right"><?php echo number_format($row['items']) ?></td>
                            <td class="text-center">
                                <?php if ($row['status'] == 0): ?>
                                    <span class="badge badge-primary rounded-pill">Pending</span>
                                <?php elseif ($row['status'] == 1): ?>
                                    <span class="badge badge-warning rounded-pill">Partially received</span>
                                <?php elseif ($row['status'] == 2): ?>
                                    <span class="badge badge-success rounded-pill">Received</span>
                                <?php else: ?>
                                    <span class="badge badge-danger rounded-pill">N/A</span>
                                <?php endif; ?>
                            </td>
                            <td align="center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <?php if ($row['status'] == 0): ?>
                                            <a class="dropdown-item" href="<?php echo base_url.'admin?page=receiving/manage_receiving&po_id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-boxes text-dark"></span> Receive</a>
                                            <div class="dropdown-divider"></div>
                                        <?php endif; ?>
                                        <a class="dropdown-item" href="<?php echo base_url.'admin?page=purchase_order/view_po&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo base_url.'admin?page=purchase_order/manage_po&id='.$row['id'] ?>" data-id="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
