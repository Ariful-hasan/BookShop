<?php include_once('./views/layouts/header.php') ?>


<div class="card">
      <div class="card-body">
      <h5 class="card-title text-center"><?php echo SITE_TITLE?></h5>
        <div class="card">
          <div class="card-body">
          <h5 class="card-title">Search</h5>
            <?php if (isset($data['error'])) { ?>
              <div class="alert alert-danger" role="alert"><?php echo $data['error']?></div>
            <?php } ?>
            <form method="POST" action="<?php echo baseUrl() ?>">
              <div class="form-row">
                <div class="form-group col-md-4">
                  <label for="inputEmail4">Customer</label>
                  <input type="text" name="customer" value="<?php echo $_REQUEST['customer']?>" class="form-control" placeholder="Customer">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPassword4">Product</label>
                  <input type="text" name="product" value="<?php echo $_REQUEST['product']?>" class="form-control" placeholder="Product">
                </div>
                <div class="form-group col-md-4">
                  <label for="inputPassword4">Price</label>
                  <input type="text" name="price" value="<?php echo $_REQUEST['price']?>" class="form-control" placeholder="Price">
                </div>
              </div>

              <button type="submit" class="btn btn-primary pull-right">Search</button>
            </form>
          </div>
        </div>

        <div class="card mt-4">
          <div class="card-body">
          <h5 class="card-title">Sales</h5>
            <table class="table table-hover table-bordered">
              <thead>
              <?php if (!empty($data['data'])) { ?>
                <tr>
                  <th scope="col" class="text-center">Customer</th>
                  <th scope="col" class="text-center">Product</th>
                  <th scope="col" class="text-center">Price</th>
                </tr>
              <?php } ?>
              </thead>
              <tbody>
                <?php if (!empty($data['data'])) { ?>
                  <?php foreach ($data['data'] as $item) { ?>
                    <tr>
                      <td class="text-left"><?php echo $item['customer'] ?></td>
                      <td class="text-left"><?php echo $item['product'] ?></td>
                      <td class="text-center"><?php echo $item['price'] ?></td>
                    </tr>
                  <?php } ?>

                  <tr class="table-active">
                    <td class="text-center"><?php echo '' ?></td>
                    <td class="text-right font-weight-bold"><?php echo 'Total' ?></td>
                    <td class="text-center font-weight-bold"><?php echo $data['total'] ?></td>
                  </tr>
                <?php } else { ?>
                  <tr><td class="text-center">No record found!</td></tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>


      </div>
    </div>


<?php include_once('./views/layouts/footer.php') ?>