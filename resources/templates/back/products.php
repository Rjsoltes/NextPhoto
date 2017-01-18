<!-- Products Table -->
<h1 class="page-header text-center">All Products</h1>
<h4 class="text-center bg-success"><?php display_message(); ?></h4>
<table class="table table-hover">
    <thead>
        <tr>
            <th>Action</th>
            <th>Id</th>
            <th>Title</th>
            <th>Photo</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
    </thead>
    <tbody>
        <?php display_products(); ?>
    </tbody>
</table>
