    <div class="login-wrapper">

        <img src="<?php echo base_url('assets/') ?>styles/resources/OADBanner.png" alt="OADBanner.png">

        <form id="formLogin" action="login_staffs_dean_db.php" method="POST">

            <p class="text-danger fw-bold raleway fs-16 text-center mt-3 mb-0 d-none" id="printValidation"></p>

            <div class="form-group mt-4 mb-3">
                <label for="getUsername" class="form-label">Username</label>
                <input type="text" id="getUsername" class="form-control" name="getUsername" autocomplete="on">
            </div>

            <div class="form-group mb-3">
                <label for="getPassword" class="form-label">Password</label>
                <input type="password" id="getPassword" class="form-control" name="getPassword" autocomplete="on">
            </div>

            <div class="login-buttons-wrapper mt-5">
                <button class="btn btn-success poppins w-100 p-3" id="btnLoginEmployees" name="btnLoginEmployees" type="button">Employees</button>
                <div class="divider">
                    <span></span>
                    <p>or</p>
                    <span></span>
                </div>
                <button class="btn btn-primary poppins w-100 p-3" id="btnLoginDean" name="btnLoginDean" type="button">Dean</button>
            </div>

            <p class="poppins text-center text-muted">Copyright © 2021. All rights reserve.</p>

        </form>
    </div>