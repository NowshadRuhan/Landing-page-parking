
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
<body>
<div class="container">

</div>


<div class="content">
    <div class="container-fluid">
        
  
                
      <!-- show private places -->
        <div class="content">

            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-12">
                        <!-- <a class="btn btn-primary" data-toggle="" data-target="" id="add_customer" href="<?php //echo base_url()?>"></a> -->
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Services Request List</h4>

                                <h4 class="title"> <?php echo $num_ids;?></h4>

                            </div>
                            <div class="content table-responsive table-full-width">
                              <ul class="pagination pagination-sm justify-content-center">

                                  <li class="page-item <?php //print 'disabled'?>">
                                    <a class="page-link" href="">Prev</a>

                                  </li>
                                </ul>
                                  <?php 

                                  $total_page = 10;
                                  for($i=1; $i<= $total_page; $i++){
                                    ?>
                                    
                                    <ul class="pagination pagination-sm justify-content-center">
                                      <li class="page-item">
                                        <a href="<?php echo $i?>" class="page-link"><?php echo $i;?></a>
                                      </li>
                                      
                                    </ul>
                                  <?php }?>

                                  <ul class="pagination pagination-sm justify-content-center">

                                  <li class="page-item <?php //print 'disabled'?>">
                                    <a class="page-link" href="">Prev</a>

                                  </li>
                                </ul>
                                <table class="table table-striped" id="dataTableMonthlyBooking">
                                     <thead>
                                          <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Address</th>
                                            <th scope="col">Service</th>
                                            <th scope="col">Division</th>
                                            <th scope="col">Area</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                        if($books){
                                                            foreach ($books as $book){
                                            ?>
                                                          <tr>
                                                            <th scope="row"><?php echo $book->id; ?></th>
                                                            <td><?php echo $book->service_name; ?></td>
                                                            <td><?php echo $book->division; ?></td>
                                                            <td><?php echo $book->area_name; ?></td>
                                                            <td><?php echo $book->vehicle_type; ?></td>
                                                            <td><?php echo $book->starting_price; ?></td>
                                                            <td><?php echo $book->ending_price; ?></td>
                                                           
                                                          </tr>

                                            <?php 
                                                }
                                            }
                                            ?>      
                                        
                                        
                                    </tbody>
                                    
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        
    </div>


  

   


  
  
</div>











</body>
</html>