<?php

include_once 'app/views/share/header.php';

?>
 <h1>Xin chào, <?php echo $_SESSION['username']; ?>!</h1>
<a href="#" class="btn btn-primary btn-icon-split p-1 mb-2 ml-2">
    <span class="icon text-white-50">
        <i class="fas fa-flag"></i>
    </span>
    <span class="text">Add Product</span>
   
</a>

<div class="card shadow mb-4">
    <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
    List Product 
</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <div class="dataTables_length" id="dataTable_length"><label>Show <select name="dataTable_length" aria-controls="dataTable" class="custom-select custom-select-sm form-control form-control-sm">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select> entries</label></div>
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div id="dataTable_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="dataTable"></label></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-bordered dataTable" id="dataTable" width="100%" cellspacing="0" role="grid" aria-describedby="dataTable_info" style="width: 100%;">
                            <thead>
                               <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Price</th>
                                    <th>Action (Edit/Delete)</th>
                               </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th rowspan="1" colspan="1">Name</th>
                                    <th rowspan="1" colspan="1">Position</th>
                                    <th rowspan="1" colspan="1">Office</th>
                                    <th rowspan="1" colspan="1">Age</th>
                                    <th rowspan="1" colspan="1">Start date</th>
                                    <th rowspan="1" colspan="1">Salary</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php while ($row = $products->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>
                                        <td><?=$row['id']?></td>
                                        <td><?=$row['name']?></td>
                                        <td><?=$row['description']?></td>
                                        <td>
                                            
                                            <?php 
                                                if(!empty($row['image']) && file_exists($row['image'])){
                                                    echo "<img src='/TAMTHAITU/" . $row['image'] ."'alt='' height='200' width='200' 'padding: 20px'>";
                                                }else{
                                                    echo "No Image";
                                                }
                                            ?>
                                        </td>
                                        <td><?=$row['price']?></td>
                                        <td>
                                            <a href="/TAMTHAITU/product/edit/<?=$row['id']?>">Edit</a>
                                            /Delete
                                        </td>
                                       
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="dataTable_paginate">
                            <ul class="pagination">
                                <li class="paginate_button page-item previous disabled" id="dataTable_previous"><a href="#" aria-controls="dataTable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li>
                                <li class="paginate_button page-item active"><a href="#" aria-controls="dataTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="3" tabindex="0" class="page-link">3</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="4" tabindex="0" class="page-link">4</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="5" tabindex="0" class="page-link">5</a></li>
                                <li class="paginate_button page-item "><a href="#" aria-controls="dataTable" data-dt-idx="6" tabindex="0" class="page-link">6</a></li>
                                <li class="paginate_button page-item next" id="dataTable_next"><a href="#" aria-controls="dataTable" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php

include_once 'app/views/share/footer.php';
