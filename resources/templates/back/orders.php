<!-- Orders Table -->
<div class="col-md-12">
    <div class="row">
        <h1 class="page-header text-center">All Orders</h1>
    </div>
    <div class="row">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Status</th>
                    <th>Order Name</th>
                    <th>Order Amount</th>
                    <th>Order Date</th>
                </tr>
            </thead>
        <tbody>
            <?php display_orders(); ?>
        </tbody>
        </table>
    </div>
