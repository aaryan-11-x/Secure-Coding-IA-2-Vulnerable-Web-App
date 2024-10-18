<!-- Fixed Code -->
<?php
include('header.php');
if (isset($_GET['page'])) {
   $page = $_GET['page'];
   $allowed_pages = ['dashboard', 'users', 'contact'];
   if (in_array($page, $allowed_pages)) {
      include($page . ".php");
   } else {
      include('header.php');
   }
}

// Vulnerable Code
// if (isset($_GET['page'])) {
//    $page = $_GET['page']; // Get the 'page' parameter from the URL without sanitization
//    if ($page)) {
//       include($page);
//    } else {
//       include('header.php');
//    }
//    

checkUser();
adminArea();

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
   $id = get_safe_value($_GET['id']);
   mysqli_query($con, "delete from category where id=$id");
   echo "<br />Data deleted<br />";
}

$res = mysqli_query($con, "select * from category order by id desc");
?>
<?php
if (mysqli_num_rows($res) > 0) {
?>
   <script>
      setTitle("Category");
      selectLink('category_link');
   </script>
   <div class="main-content">
      <div class="section__content section__content--p30">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
                  <h2>Category</h2>
                  <a href="manage_category.php">Add category</a>
                  <br /><br />
                  <div class="table-responsive table--no-card m-b-30">
                     <table class="table table-borderless table-striped table-earning">
                        <thead>
                           <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th></th>
                           </tr>
                        <tbody>
                           <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                              <tr>
                                 <td><?php echo $row['id']; ?></td>
                                 <td><?php echo $row['name'] ?></td>
                                 <td>
                                    <a href="manage_category.php?id=<?php echo $row['id']; ?>">Edit</a>&nbsp;
                                    <a href="javascript:void(0)" onclick="delete_confir('<?php echo $row['id']; ?>','category.php')">Delete</a>
                                 </td>
                              </tr>
                           <?php } ?>
                        </tbody>
                     </table>
                  <?php } else {
                  echo "No data found";
               }
                  ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
   include('footer.php');
   ?>