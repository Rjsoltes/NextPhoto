<!-- Payment Page -->
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "header.php"); ?>

<div class="container">
    <div class="row">
        <h1>Checkout</h1>
        <h4 class="bg-danger"><?php display_message(); ?></h4>
    </div>
    <!-- Payment Form -->
    <div class="col-xs-4">
        <form action="" method="post">
           <?php process_order(); ?>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>Name on Card</label>
                    <input name="cardName" class='form-control' size='4' type='text' required autofocus>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>Card Number</label>
                    <input name="cardNumber" autocomplete='off' class='form-control' size='16' type='text' maxlength="16" pattern=".{16,}" required>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-4'>
                    <label class='control-label'>CVC</label>
                    <input name="cvcNumber" autocomplete='off' class='form-control' placeholder='ex. 311' size='3' type='text' maxlength="3" pattern=".{3,}" required>
                </div>
                <div class='col-xs-4 form-group'>
                    <label class='control-label'>Expiration</label>
                    <input name="expMM" autocomplete='off' class='form-control' placeholder='MM' size='2' type='text' maxlength="2" pattern=".{2,}" required>
                </div>
                <div class='col-xs-4 form-group'>
                    <label class='control-label'> </label>
                    <input name="expYY" autocomplete='off' class='form-control' placeholder='YYYY' size='4' type='text' maxlength="4" pattern=".{4,}" required>
                </div>
            </div>
           <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>Address</label>
                    <input name="address" class='form-control' size='4' type='text' required>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>City</label>
                    <input name="city" class='form-control' size='20' type='text' required>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>State</label>
                    <select name="state" class="form control" required>
                    	<option value="AL">Alabama</option>
                    	<option value="AK">Alaska</option>
                    	<option value="AZ">Arizona</option>
                    	<option value="AR">Arkansas</option>
                    	<option value="CA">California</option>
                    	<option value="CO">Colorado</option>
                    	<option value="CT">Connecticut</option>
                    	<option value="DE">Delaware</option>
                    	<option value="DC">District Of Columbia</option>
                    	<option value="FL">Florida</option>
                    	<option value="GA">Georgia</option>
                    	<option value="HI">Hawaii</option>
                    	<option value="ID">Idaho</option>
                    	<option value="IL">Illinois</option>
                    	<option value="IN">Indiana</option>
                    	<option value="IA">Iowa</option>
                    	<option value="KS">Kansas</option>
                    	<option value="KY">Kentucky</option>
                    	<option value="LA">Louisiana</option>
                    	<option value="ME">Maine</option>
                    	<option value="MD">Maryland</option>
                    	<option value="MA">Massachusetts</option>
                    	<option value="MI">Michigan</option>
                    	<option value="MN">Minnesota</option>
                    	<option value="MS">Mississippi</option>
                    	<option value="MO">Missouri</option>
                    	<option value="MT">Montana</option>
                    	<option value="NE">Nebraska</option>
                    	<option value="NV">Nevada</option>
                    	<option value="NH">New Hampshire</option>
                    	<option value="NJ">New Jersey</option>
                    	<option value="NM">New Mexico</option>
                    	<option value="NY">New York</option>
                    	<option value="NC">North Carolina</option>
                    	<option value="ND">North Dakota</option>
                    	<option value="OH">Ohio</option>
                    	<option value="OK">Oklahoma</option>
                    	<option value="OR">Oregon</option>
                    	<option value="PA">Pennsylvania</option>
                    	<option value="RI">Rhode Island</option>
                    	<option value="SC">South Carolina</option>
                    	<option value="SD">South Dakota</option>
                    	<option value="TN">Tennessee</option>
                    	<option value="TX">Texas</option>
                    	<option value="UT">Utah</option>
                    	<option value="VT">Vermont</option>
                    	<option value="VA">Virginia</option>
                    	<option value="WA">Washington</option>
                    	<option value="WV">West Virginia</option>
                    	<option value="WI">Wisconsin</option>
                    	<option value="WY">Wyoming</option>
                    </select>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>Zip Code</label>
                    <input name="zipcode" class='form-control' size='20' type='text' maxlength="5" pattern=".{5,}" required>
                </div>
            </div>
            <div class='form-row'>
                <div class='col-xs-12 form-group'>
                    <label class='control-label'>Email</label>
                    <input name="email" class='form-control' size='20' type='email' required>
                </div>
            </div>
            <div class='form-row center-block'>
                <div class='col-md-12 form-group center-block'>
                    <button name="processorder" class='form-control btn btn-primary center-block' type='submit'>Complete Payment</button>
                </div>
            </div>

        </form>
    </div>
    <!-- Cart Total -->
    <div class="col-xs-4 pull-left">
        <h2 class="text-center">Cart Totals</h2>
        <table class="table table-bordered" cellspacing="0">
            <tr class="cart-subtotal">
                <th>Items:</th>
                <td><span class="amount"><?php echo $_SESSION['cart_total_quantity'];?></span></td>
            </tr>
            <tr class="order-total">
                <th>Order Total</th>
                <td><strong><span class="amount">&#36;<?php echo $_SESSION['cart_total']; ?></span></strong> </td>
            </tr>
        </table>
    </div>
</div>

<?php require_once("../resources/close_conn.php"); ?>
<?php include(TEMPLATE_FRONT . DS . "footer.php"); ?>
